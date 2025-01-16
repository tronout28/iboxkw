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
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --bg-color: #f9fafb;
            --card-bg: #ffffff;
            --text-color: #1f2937;
            --border-color: #e5e7eb;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Inter', -apple-system, sans-serif;
            color: var(--text-color);
            line-height: 1.5;
            margin: 0;
            padding: 2rem;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: var(--card-bg);
            border-radius: 1rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 2rem;
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border-color);
        }

        .form-header h1 {
            color: var(--text-color);
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
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
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 1rem;
            background-color: white;
            cursor: pointer;
        }

        .minuses-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            padding: 1rem;
            background-color: var(--bg-color);
            border-radius: 0.5rem;
        }

        .minus-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem;
            background: white;
            border-radius: 0.375rem;
            border: 1px solid var(--border-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.2s;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .file-upload {
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem;
            background-color: var(--bg-color);
            border: 2px dashed var(--border-color);
            border-radius: 0.5rem;
            cursor: pointer;
            text-align: center;
        }

        .file-upload-label i {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .file-upload input[type="file"] {
            display: none;
        }

        @media (max-width: 640px) {
            .container {
                padding: 1rem;
            }

            .minuses-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
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
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required placeholder="Enter product description"></textarea>
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
                    </label>
                    <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/jpg">
                </div>
            </div>

            <button type="submit" class="btn-primary">
                Jual Iphone dengan harga Rp 0
            </button>
        </form>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function () {
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
    document.getElementById('category_id').addEventListener('change', function () {
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
    productForm.addEventListener('submit', function (event) {
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
                window.location.href = 'sell.sell'; // Change this to your products page URL
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


</body>

</html>
