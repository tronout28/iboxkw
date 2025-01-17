<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-color: #f3f4f6;
            --card-bg: #ffffff;
            --text-color: #374151;
            --border-color: #d1d5db;
            --focus-color: rgba(37, 99, 235, 0.2);
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Inter', sans-serif;
            color: var(--text-color);
            margin: 0;
            padding: 1rem;
            line-height: 1.6;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: var(--card-bg);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-header h1 {
            font-size: 2rem;
            font-weight: bold;
            margin: 0;
        }

        .form-header p {
            color: #6b7280;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s ease-in-out;
            background: var(--card-bg);
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px var(--focus-color);
            outline: none;
        }

        .file-upload {
            position: relative;
            text-align: center;
            padding: 1.5rem;
            border: 2px dashed var(--border-color);
            border-radius: 12px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .file-upload:hover {
            background-color: var(--focus-color);
        }

        .file-upload i {
            font-size: 2rem;
            color: var(--primary-color);
        }

        .file-upload span {
            display: block;
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 0.5rem;
        }

        .file-upload input[type="file"] {
            display: none;
        }

        .btn-primary {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: 500;
            color: white;
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .minuses-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .minus-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem;
            background: var(--bg-color);
            border-radius: 8px;
            border: 1px solid var(--border-color);
        }

        @media (max-width: 640px) {
            .container {
                padding: 1rem;
            }

            .form-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    @include('home.header')

    <br>
    <br>
    <br>
    <br>

    <div class="container">
        <div class="form-header">
            <h1>Jual Hpmu</h1>
            <p>Isi form ini yang sesuai</p>
        </div>

        <form id="productForm" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="form-label" for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" required placeholder="Enter product name">
            </div>

            <div class="form-group">
                <label class="form-label" for="category_id">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="">Select a category</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" required placeholder="Enter price">
            </div>

            <div class="form-group">
                <label class="form-label">Select Minus Items</label>
                <div id="minusSelection" class="minus-selection">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Product Image</label>
                <div class="file-upload">
                    <label class="file-upload-label" for="image">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Click to upload or drag and drop</span>
                        <span style="color: #6b7280; font-size: 0.875rem;">JPG, PNG or JPEG (MAX. 2MB)</span>
                    </label>
                    <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required placeholder="Enter product description" style="height: 150px;"></textarea>
            </div>

            <button type="submit" class="btn-primary">
                Jual Iphone dengan harga Rp 0
            </button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const priceInput = document.getElementById('price');
            const minusSelection = document.getElementById('minusSelection');
            const submitButton = document.querySelector('.btn-primary');
            const productForm = document.getElementById('productForm');
            const imageInput = document.getElementById('image');
            let basePrice = 0;

            // Fetch categories
            fetch('/api/categories')
                .then(response => response.json())
                .then(categories => {
                    const categorySelect = document.getElementById('category_id');
                    categories.forEach(category => {
                        const option = document.createElement('option');
                        option.value = category.id;
                        option.textContent = category.name_iphone;
                        categorySelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching categories:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to load categories. Please refresh the page.',
                    });
                });

            // Fetch minus items based on selected category
            document.getElementById('category_id').addEventListener('change', function() {
                const categoryId = this.value;
                if (!categoryId) {
                    minusSelection.innerHTML = '';
                    updateTotalPrice();
                    return;
                }

                fetch(`/api/minuses/category/${categoryId}`)
                    .then(response => response.json())
                    .then(minuses => {
                        minusSelection.innerHTML = '';
                        const minusContainer = document.createElement('div');
                        minusContainer.className = 'minuses-container';

                        minuses.forEach(minus => {
                            const minusItem = document.createElement('div');
                            minusItem.className = 'minus-item';

                            minusItem.innerHTML = `
                        <input type="checkbox" 
                               name="minuses[]" 
                               value="${minus.id}" 
                               class="minus-checkbox"
                               data-price="${minus.minus_price}"
                               id="minus-${minus.id}">
                        <label for="minus-${minus.id}">${minus.minus_product} - Rp ${minus.minus_price.toLocaleString('id-ID')}</label>
                    `;

                            minusContainer.appendChild(minusItem);
                        });

                        minusSelection.appendChild(minusContainer);
                        updateTotalPrice();
                        attachCheckboxListeners();
                    })
                    .catch(error => {
                        console.error('Error fetching minus items:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to load minus items. Please try selecting the category again.',
                        });
                    });
            });

            function attachCheckboxListeners() {
                const checkboxes = minusSelection.querySelectorAll('input[type="checkbox"]');
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', updateTotalPrice);
                });
            }

            function formatPrice(price) {
                return price.toLocaleString('id-ID');
            }

            function updateTotalPrice() {
                basePrice = parseFloat(priceInput.value) || 0;
                let totalDeduction = 0;

                // Calculate total deductions from selected minus items
                const selectedMinus = minusSelection.querySelectorAll('input[name="minuses[]"]:checked');
                selectedMinus.forEach(checkbox => {
                    const minusPrice = parseFloat(checkbox.dataset.price) || 0;
                    totalDeduction += minusPrice;
                });

                // Calculate final price
                const finalPrice = Math.max(0, basePrice - totalDeduction);

                // Update button text with formatted price
                if (basePrice <= 0) {
                    submitButton.textContent = 'Jual Iphone dengan harga Rp 0';
                    submitButton.disabled = true;
                } else {
                    submitButton.textContent = `Jual Iphone dengan harga Rp ${formatPrice(finalPrice)}`;
                    submitButton.disabled = false;
                }
            }

            // Validate image before upload
            imageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                const maxSize = 2 * 1024 * 1024; // 2MB
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];

                if (file) {
                    if (file.size > maxSize) {
                        Swal.fire({
                            icon: 'error',
                            title: 'File terlalu besar',
                            text: 'Ukuran file maksimal 2MB',
                        });
                        this.value = '';
                        return;
                    }

                    if (!allowedTypes.includes(file.type)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Format file tidak sesuai',
                            text: 'Hanya file JPG, JPEG, dan PNG yang diperbolehkan',
                        });
                        this.value = '';
                        return;
                    }
                }
            });

            // Price input validation and formatting
            priceInput.addEventListener('input', function(e) {
                // Remove non-numeric characters
                let value = this.value.replace(/[^\d]/g, '');

                // Ensure it's not negative
                value = Math.max(0, parseInt(value) || 0);

                // Update the input value
                this.value = value;

                // Update total price calculation
                updateTotalPrice();
            });

            // Form validation before submit
            function validateForm() {
                const name = document.getElementById('name').value.trim();
                const description = document.getElementById('description').value.trim();
                const category = document.getElementById('category_id').value;
                const price = parseFloat(priceInput.value) || 0;
                const minusChecked = document.querySelectorAll('input[name="minuses[]"]:checked').length;

                if (!name) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Nama produk harus diisi',
                    });
                    return false;
                }

                if (!description) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Deskripsi produk harus diisi',
                    });
                    return false;
                }

                if (!category) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Kategori harus dipilih',
                    });
                    return false;
                }

                if (price <= 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Harga harus lebih dari 0',
                    });
                    return false;
                }

                if (!imageInput.files[0]) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gambar produk harus diupload',
                    });
                    return false;
                }

                return true;
            }


            // Submit form
            productForm.addEventListener('submit', function(event) {
                event.preventDefault();

                if (!validateForm()) {
                    return;
                }

                const formData = new FormData(this);

                // Log form data before sending
                console.log('Sending Form Data:');
                for (let pair of formData.entries()) {
                    console.log(pair[0] + ':', pair[0] === 'image' ? 'File: ' + pair[1].name : pair[1]);
                }

                // Add CSRF token if needed
                // formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                // Calculate final price with deductions
                const basePrice = parseFloat(priceInput.value) || 0;
                let totalDeduction = 0;
                const selectedMinus = minusSelection.querySelectorAll('input[name="minuses[]"]:checked');
                selectedMinus.forEach(checkbox => {
                    const minusPrice = parseFloat(checkbox.dataset.price) || 0;
                    totalDeduction += minusPrice;
                });
                const finalPrice = Math.max(0, basePrice - totalDeduction);

                // Add final price to form data
                formData.append('final_price', finalPrice);

                // Show loading state
                Swal.fire({
                    title: 'Mohon tunggu...',
                    text: 'Sedang memproses data',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Send request to server
                fetch('/api/products', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            // Remove Content-Type header to let browser set it with boundary for multipart/form-data
                        },
                        body: formData
                    })
                    .then(response => {
                        console.log('Response Status:', response.status);
                        console.log('Response Headers:', response.headers);

                        return response.text().then(text => {
                            try {
                                // Try to parse as JSON
                                const data = JSON.parse(text);
                                console.log('Parsed Response:', data);

                                if (!response.ok) {
                                    throw new Error(data.message || 'Server error occurred');
                                }

                                return data;
                            } catch (e) {
                                console.log('Raw Response:', text);
                                throw new Error('Server Error:\n' + text);
                            }
                        });
                    })
                    .then(data => {
                        // Success handling
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Produk berhasil ditambahkan.',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'home'; // Change this to your products page URL
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error Details:', error);

                        // Error handling with detailed message
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            html: `
                <div style="text-align: left;">
                    <p>Terjadi kesalahan saat mengirim data:</p>
                    <pre style="background: #f8f9fa; padding: 10px; margin-top: 10px; white-space: pre-wrap; word-wrap: break-word;">
                        ${error.message}
                    </pre>
                </div>
            `,
                            confirmButtonText: 'OK'
                        });
                    })
                    .finally(() => {
                        // Log final form data state
                        console.log('Final Form Data:', {
                            name: formData.get('name'),
                            description: formData.get('description'),
                            category_id: formData.get('category_id'),
                            price: formData.get('price'),
                            final_price: formData.get('final_price'),
                            minuses: formData.getAll('minuses[]'),
                            image: formData.get('image')?.name
                        });
                    });
            });

            // Initial price update
            updateTotalPrice();
        });
    </script>

    <br>
    <br>
    <br>
    <br>
    <footer>
        @include('component.footer')

    </footer>
</body>

</html>