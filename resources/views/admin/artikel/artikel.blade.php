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
    <style>
        .dataTables_wrapper .dataTables_paginate {
            display: none !important;
        }
        .dataTables_wrapper .dataTables_info {
            display: none !important;
        }
        .dataTables_wrapper .dataTables_length {
            display: none !important;
        }
    </style>
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
                                <th class="w-16">No</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Content</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
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
                            <input type="file" id="imageInput" name="image" accept="image/*" class="hidden" onchange="previewImage(event)">
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
        $(document).ready(function() {
            var table = $('#exampleTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '/get-artikel',
                paging: false,
                searching: false,
                info: false,
                ordering: true,
                order: [[0, 'asc']],
                columns: [
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        },
                        searchable: false,
                        orderable: false
                    },
                    { data: 'title' },
                    { data: 'subtitle' },
                    { 
                        data: 'content',
                        render: function(data) {
                            return data.length > 100 ? data.substr(0, 100) + '...' : data;
                        }
                    },
                    {
                        data: 'image',
                        render: function(data) {
                            return `<img src="${data}" class="h-24 w-32 object-cover rounded-md" alt="Article image"/>`;
                        },
                        orderable: false
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return `
                            <button class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 flex items-center" 
                                    onclick="deleteArticle(${row.id})">
                                <i class="fas fa-trash mr-2"></i>Delete
                            </button>`;
                        },
                        orderable: false
                    }
                ],
                language: {
                    search: "Search:",
                    zeroRecords: 'No matching records found',
                    emptyTable: 'No data available'
                }
            });

            $('#articleForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: '/artikel',
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
                        table.ajax.reload();
                        $('#articleForm')[0].reset();
                        $('#imagePreview').addClass('hidden');
                        $('#preview').attr('src', '');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });

            window.deleteArticle = function(id) {
                if (!confirm('Apakah Anda yakin ingin menghapus artikel ini?')) return;

                $.ajax({
                    url: `/artikels/${id}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert('Artikel berhasil dihapus');
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        alert('Gagal menghapus artikel: ' + xhr.responseText);
                    }
                });
            };
        });

        function openModal() {
            document.getElementById('articleModal').classList.remove('hidden');
            document.getElementById('articleForm').reset();
            document.getElementById('imagePreview').classList.add('hidden');
            document.getElementById('preview').src = '';
        }

        function closeModal() {
            document.getElementById('articleModal').classList.add('hidden');
        }

        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    const preview = document.getElementById('preview');
                    const imagePreview = document.getElementById('imagePreview');
                    imagePreview.classList.remove('hidden');
                    preview.src = reader.result;
                };
                reader.readAsDataURL(file);
            }
        }

        window.openModal = openModal;
        window.closeModal = closeModal;
        window.previewImage = previewImage;
    </script>
</body>

</html>