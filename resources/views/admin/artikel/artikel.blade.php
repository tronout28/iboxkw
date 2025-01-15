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
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        @include('admin.sidebar.sidebar')

        <div class="flex-1 p-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Data Table Example</h2>
                    <button class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        Tambah Artikel
                    </button>
                </div>
                
                <div class="overflow-x-auto">
                    <table id="exampleTable" class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-gray-500">No.</th>
                                <th class="px-6 py-3 text-left text-gray-500">Judul artikel</th>
                                <th class="px-6 py-3 text-left text-gray-500">Penulis</th>
                                <th class="px-6 py-3 text-left text-gray-500">Kategori</th>
                                <th class="px-6 py-3 text-left text-gray-500">Tanggal Publikasi</th>
                                <th class="px-6 py-3 text-left text-gray-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4">1</td>
                                <td class="px-6 py-4">Cara Belajar Efektif</td>
                                <td class="px-6 py-4">John Doe</td>
                                <td class="px-6 py-4">Pendidikan</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-800">Aksi</span>
                                </td>
                                <td class="px-6 py-4 flex space-x-2">
                                    <button class="px-3 py-1 text-sm font-medium text-blue-600 bg-blue-100 rounded-full hover:bg-blue-200 flex items-center">
                                        <i class="fas fa-edit mr-2"></i>Edit
                                    </button>
                                    <button class="px-3 py-1 text-sm font-medium text-red-600 bg-red-100 rounded-full hover:bg-red-200 flex items-center">
                                        <i class="fas fa-trash-alt mr-2"></i>Delete
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">2</td>
                                <td class="px-6 py-4">Jane Smith</td>
                                <td class="px-6 py-4">34</td>
                                <td class="px-6 py-4">Los Angeles</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm bg-red-100 text-red-800">Inactive</span>
                                </td>
                                <td class="px-6 py-4 flex space-x-2">
                                    <button class="px-3 py-1 text-sm font-medium text-blue-600 bg-blue-100 rounded-full hover:bg-blue-200 flex items-center">
                                        <i class="fas fa-edit mr-2"></i>Edit
                                    </button>
                                    <button class="px-3 py-1 text-sm font-medium text-red-600 bg-red-100 rounded-full hover:bg-red-200 flex items-center">
                                        <i class="fas fa-trash-alt mr-2"></i>Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.tailwind.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#exampleTable').DataTable({
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
        });
    </script>
</body>
</html>
