<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        @include('admin.sidebar.sidebar')

        <div class="flex-1 p-8">
            <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-3xl font-bold text-orange-500">2</div>
                    <div class="text-gray-600">Jumlah iphone</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-3xl font-bold text-green-500">5</div>
                    <div class="text-gray-600">Jumlah dealer</div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="text-3xl font-bold text-blue-500">10</div>
                    <div class="text-gray-600">Jumlah user</div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold">Iphone di upload</h2>
                </div>
                <div class="overflow-x-auto">
                    <table id="exampleTable" class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-gray-500">No.</th>

                                <th class="px-8 py-3 text-left text-gray-500">Name</th>
                                <th class="px-8 py-3 text-left text-gray-500">Age</th>
                                <th class="px-8 py-3 text-left text-gray-500">Location</th>
                                <th class="px-8 py-3 text-left text-gray-500">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4">1</td>
                                <td class="px-8 py-4">John Doe</td>
                                <td class="px-8 py-4">29</td>
                                <td class="px-8 py-4">New York</td>
                                <td class="px-8 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm bg-green-100 text-green-800">Active</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4">2</td>

                                <td class="px-8 py-4">Jane Smith</td>
                                <td class="px-8 py-4">34</td>
                                <td class="px-8 py-4">Los Angeles</td>
                                <td class="px-8 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm bg-red-100 text-red-800">Inactive</span>
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
