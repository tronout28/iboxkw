<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    <h2 class="text-xl font-semibold">Tambah Artikel</h2>
                    <button onclick="openModal()" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        Tambah Artikel
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table id="exampleTable" class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Content</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="articleModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Tambah Artikel Baru</h3>
                <form id="articleForm" class="space-y-4" enctype="multipart/form-data">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Subtitle</label>
                        <input type="text" name="subtitle" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea name="content" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Image</label>
                        <div class="mt-1 flex items-center">
                            <input type="file" id="imageInput" accept="image/*" class="hidden" onchange="previewImage(event)">
                            <label for="imageInput" class="cursor-pointer px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">
                                Choose File
                            </label>
                        </div>
                        <div id="imagePreview" class="mt-2 hidden">
                            <img id="preview" class="max-w-full h-24 object-cover rounded-md">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.tailwind.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize DataTable
            var table = $('#exampleTable').DataTable({
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
                },
                columns: [
                    { data: 'no' },
                    { data: 'title' },
                    { data: 'subtitle' },
                    { data: 'content' },
                    { data: 'image', render: function (data) {
                        return `<img src="${data}" class="h-24 object-cover rounded-md" />`;
                    }},
                    { data: 'action', render: function (data, type, row) {
                        return `
                            <button class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700" onclick="deleteArticle(${row.id})">Delete</button>
                        `;
                    }},
                ]
            });

            $.ajax({
                url: '/get-artikel', 
                type: 'GET',
                success: function (response) {
                    if (response.status === 'success') {
                        let artikels = response.data;
                        let no = 1;
                        artikels.forEach(function (artikel) {
                            table.row.add({
                                no: no++,
                                title: artikel.title,
                                subtitle: artikel.subtitle,
                                content: artikel.content,
                                image: artikel.image_url, 
                                action: ''
                            }).draw();
                        });
                    }
                },
                error: function (xhr, status, error) {
                    alert('Terjadi kesalahan: ' + error);
                }
            });
        });

        function openModal() {
            document.getElementById('articleModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('articleModal').classList.add('hidden');
        }

        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function () {
                const preview = document.getElementById('preview');
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.classList.remove('hidden');
                preview.src = reader.result;
            };
            reader.readAsDataURL(file);
        }

        // Handle form submission
        $('#articleForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: '/artikel', // Your backend endpoint for storing articles
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert('Artikel berhasil ditambahkan');
                    closeModal();
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan: ' + error);
                }
            });
        });
    </script>

    
</body>
</html>