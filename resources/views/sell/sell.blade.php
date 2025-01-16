<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
            <h1>Add New Product</h1>
            <p>Complete the form below to add a new product to your inventory</p>
        </div>
        
        <form id="productForm" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="form-label" for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" required 
                       placeholder="Enter product name">
            </div>

            <div class="form-group">
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required
                          placeholder="Enter product description"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="category_id">Category</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="">Select a category</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" required
                       placeholder="Enter price">
            </div>

            <div class="form-group">
                <label class="form-label" for="minus">Minus</label>
                <select class="form-select" id="minus" name="minus">
                    <!-- Options will be added dynamically -->
                </select>
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
                Submit Product
            </button>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch categories to populate the category select
        fetch('/api/categories')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(categories => {
                const categorySelect = document.getElementById('category_id');
                categories.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.name_iphone; // assuming 'name_iphone' exists in the API
                    categorySelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching categories:', error);
                alert('Failed to load categories. Please refresh the page.');
            });

        // Handle file input change
        const fileInput = document.getElementById('image');
        const fileLabel = document.querySelector('.file-upload-label span');
        
        fileInput.addEventListener('change', function() {
            if (this.files[0]) {
                fileLabel.textContent = this.files[0].name;
            } else {
                fileLabel.textContent = 'Click to upload or drag and drop';
            }
        });

        // Fetch "minus" data when the category is selected
        document.getElementById('category_id').addEventListener('change', function() {
            const categoryId = this.value;
            
            if (categoryId) {
                fetch(`/api/minus/get-categorycategory_id=${categoryId}`)
                    .then((response) => response.json())
                    .then((data) => {
                        console.log('Data fetched from API:', data); // Debug response
                        const selectElement = document.getElementById('minus');
                        selectElement.innerHTML = ''; // Clear existing options

                        // Populate the select element with "minus" items based on category
                        data.forEach((minus) => {
                            const option = document.createElement('option');
                            option.value = minus.id; // Use minus ID as the value
                            option.textContent = `${minus.minus_product} (${minus.minus_price} USD)`; // Display product name and price
                            selectElement.appendChild(option);
                        });
                    })
                    .catch((error) => {
                        console.error('Error fetching minus data:', error); // Log any errors
                    });
            } else {
                // Clear the minus select options if no category is selected
                document.getElementById('minus').innerHTML = '';
            }
        });

        // Handle form submission
        document.getElementById('productForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch('/api/products', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.message) {
                    alert(data.message);
                    if (data.product) {
                        window.location.href = '/products/' + data.product.id;
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while submitting the product');
            });
        });
    });
</script>

</body>
</html>