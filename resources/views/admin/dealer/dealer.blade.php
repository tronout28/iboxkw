<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        @include('admin.sidebar.sidebar') <!-- Sidebar -->
        <div class="flex-1 p-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Data Table Example</h2>
                </div>
                <div class="overflow-x-auto">
                    <table id="exampleTable" class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-gray-500">No.</th>
                                <th class="px-6 py-3 text-left text-gray-500">Name</th>
                                <th class="px-6 py-3 text-left text-gray-500">Description</th>
                                <th class="px-6 py-3 text-left text-gray-500">Status</th>
                                <th class="px-6 py-3 text-left text-gray-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.tailwind.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
<script>
    $(document).ready(function () {
        // Initialize DataTable
        const table = $('#exampleTable').DataTable({
            responsive: true,
            pageLength: 5,
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            }
        });

        // Fetch data from API and populate table
        fetch('/products')  // This stays the same since we added a new route for it
            .then(response => response.json())
            .then(data => {
                table.clear();
                data.forEach((product, index) => {
                    const statusLabel = product.status === 'inactive'
                        ? `<span class="px-3 py-1 rounded-full text-sm bg-red-100 text-red-800">${product.status}</span>`
                        : `<span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-800">${product.status || 'Active'}</span>`;

                    table.row.add([ 
                        index + 1,
                        product.name || '<em>No Name</em>',
                        product.description || '<em>No Description</em>',
                        statusLabel,
                        `<div class="flex space-x-2">
                            <button class="edit-btn px-3 py-1 text-sm font-medium text-blue-600 bg-blue-100 rounded-full hover:bg-blue-200 flex items-center" data-id="${product.id}">
                                <i class="fas fa-edit mr-2"></i>Edit
                            </button>
                            <button class="detail-btn px-3 py-1 text-sm font-medium text-yellow-600 bg-yellow-100 rounded-full hover:bg-yellow-200 flex items-center" data-id="${product.id}">
                                <i class="fas fa-eye mr-2"></i>Detail
                            </button>
                            <button class="delete-btn px-3 py-1 text-sm font-medium text-red-600 bg-red-100 rounded-full hover:bg-red-200 flex items-center" data-id="${product.id}">
                                <i class="fas fa-trash-alt mr-2"></i>Delete
                            </button>
                        </div>`
                    ]);
                });
                table.draw();

                // Event listener for Edit button
                $('#exampleTable').on('click', '.edit-btn', function () {
                    const productId = $(this).data('id');
                    window.location.href = `/admin/dealer/${productId}/edit`;
                });

                // Event listener for Detail button
                $('#exampleTable').on('click', '.detail-btn', function () {
                    const productId = $(this).data('id');
                    window.location.href = `/admin/dealer/${productId}/detail`;
                });

                // Event listener for Delete button
                $('#exampleTable').on('click', '.delete-btn', function () {
                    const productId = $(this).data('id');
                    if (confirm(`Are you sure you want to delete product ID ${productId}?`)) {
                        fetch(`/products/${productId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.message) {
                                alert(result.message);
                                table.row($(this).parents('tr')).remove().draw();
                            } else {
                                alert('Failed to delete the product. Please try again.');
                            }
                        })
                        .catch(error => {
                            console.error('Error deleting product:', error);
                            alert('An error occurred while deleting the product.');
                        });
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching products:', error);
                alert('An error occurred while fetching the products.');
            });
    });
</script>