<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Lihat Semua iPhone</title>
    <style>
        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .product-row {
            display: flex;
            align-items: flex-start;
            gap: 100px;
        }

        /* Product Image */
        .product-image {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .product-image img {
            width: 100%;
            border-radius: 8px;
            object-fit: cover;
        }

        /* Product Details */
        .product-details {
            flex: 1;
        }

        .product-details h1 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-details .sku {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        /* Price Section */
        .price-section {
            margin-bottom: 20px;
        }

        .price-section .original-price {
            text-decoration: line-through;
            color: #6b7280;
        }

        .price-section .discounted-price {
            color: #dc2626;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .price-section .discount {
            font-size: 0.9rem;
        }

        .price-section .installment span {
            color: #2563eb;
        }

        .price-section a {
            color: #2563eb;
            text-decoration: none;
        }

        /* Color Selection */
        .product-color,
        .product-model,
        .product-capacity {
            margin-bottom: 20px;
        }

        .colors {
            display: flex;
            gap: 10px;
            margin: 10px 0;
        }

        .color {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.2s ease;
        }

        .color.selected {
            border-color: #2563eb;
        }

        .color.gray {
            background-color: #C0C0C0;
        }

        .color.black {
            background-color: #000000;
        }

        .color.light-gray {
            background-color: #D3D3D3;
        }

        .color.white {
            background-color: #FFFFFF;
            border: 1px solid #E5E7EB;
        }

        /* Select Dropdown */
        select {
            width: 100%;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #E5E7EB;
            margin-top: 5px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .product-row {
                flex-direction: column;
                gap: 30px;
            }

            .product-image {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    @include('home.header')

    <!-- Main Product Section -->
    <div class="container">
        <div class="product-row">
            <!-- Product Image -->
            <div class="product-image">
                <img src="/images/default-product.jpg" alt="Product Image" id="productImage">
            </div>

            <!-- Product Details -->
            <div class="product-details">
                <h1 id="productName">Loading...</h1>
                <p class="sku" id="productSku">SKU: Loading...</p>

                <div class="price-section" id="priceSection">
                    <p class="original-price">Loading...</p>
                    <p class="discounted-price">Loading...</p>
                    <p class="installment">Loading...</p>
                    <a href="#">Simulasi cicilan dan Paylater</a>
                </div>

                <!-- Color Selection -->
                <div class="product-color">
                    <h2>Warna</h2>
                    <div class="colors">
                        <span class="color gray selected"></span>
                        <span class="color black"></span>
                        <span class="color light-gray"></span>
                        <span class="color white"></span>
                    </div>
                </div>

                <!-- Model Selection -->
                <div class="product-model">
                    <h2>Model</h2>
                    <select id="modelSelect">
                        <option>Loading...</option>
                    </select>
                </div>

                <!-- Capacity Selection -->
                <div class="product-capacity">
                    <h2>Kapasitas</h2>
                    <select id="capacitySelect">
                        <option>128 GB</option>
                        <option>256 GB</option>
                        <option>512 GB</option>
                        <option>1 TB</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('checkout.container')

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            // Fix: Add quotes for `{{ $productId ?? 'null' }}` and handle 'null' as a string
            const productId = "{{ $productId ?? 'null' }}";

            // Check if productId is valid
            if (!productId || productId === 'null') {
                console.error('Product ID not found');
                return;
            }

            try {
                // Fetch product data from API
                const response = await fetch(`/api/products/${productId}`);
                const product = await response.json();

                // Validate response
                if (!product || !product.id) {
                    throw new Error('Invalid product data received');
                }

                // Update Product Image
                const productImage = document.getElementById('productImage');
                productImage.src = product.image || '/images/default-product.jpg';

                // Update Product Name
                const productName = document.getElementById('productName');
                productName.textContent = product.name || 'Produk Tidak Tersedia';

                // Update Product SKU
                const productSku = document.getElementById('productSku');
                productSku.textContent = `SKU: ${product.id}`;

                // Update Price Section
                const originalPrice = parseFloat(product.price) || 0;
                const discountedPrice = parseFloat(product.total_price) || originalPrice;

                const priceSection = document.getElementById('priceSection');
                priceSection.innerHTML = `
                <p class="original-price">${originalPrice ? formatPrice(originalPrice) : ''}</p>
                <p class="discounted-price">${formatPrice(discountedPrice)}</p>
                <p class="installment">atau <span>${formatPrice(discountedPrice / 24)}/bln*</span></p>
                <a href="#">Simulasi cicilan dan Paylater</a>
            `;

                // Update Model Dropdown
                const modelSelect = document.getElementById('modelSelect');
                modelSelect.innerHTML = `<option>${product.category || 'Model Tidak Tersedia'}</option>`;

            } catch (error) {
                // Handle Errors
                console.error(error.message);
            }

            // Helper Function: Format Price
            function formatPrice(price) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(price).replace('IDR', 'Rp');
            }
        });
    </script>
</body>

</html>