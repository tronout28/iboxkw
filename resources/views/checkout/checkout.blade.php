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

        .price-section .installment span {
            color: #2563eb;
        }

        .price-section a {
            color: #2563eb;
            text-decoration: none;
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

    <div class="container">
        <div class="product-row">
            <!-- Product Image -->
            <div class="product-image">
                <img id="productImage" src="/images/default-product.jpg" alt="Produk Tidak Tersedia">
            </div>

            <!-- Product Details -->
            <div class="product-details">
                <h1 id="productName">Produk Tidak Tersedia</h1>
                <p class="sku" id="productSku">SKU: -</p>

                <!-- Price Section -->
                <div class="price-section" id="priceSection">
                    <p class="original-price"></p>
                    <p class="discounted-price"></p>
                    <p class="installment">atau <span>Rp 0/bln*</span></p>
                    <a href="#">Simulasi cicilan dan Paylater</a>
                </div>

                <!-- Model Dropdown -->
                <div class="product-model">
                    <label for="modelSelect">Model</label>
                    <select id="modelSelect">
                        <option>Pilih Model</option>
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
            // Ambil ID produk dari server-side
            const productId = "{{ $productId ?? 'null' }}";

            // Validasi apakah productId tersedia
            if (!productId || productId === 'null') {
                console.error('Product ID tidak ditemukan.');
                return;
            }

            try {
                // Ambil data produk dari API
                const response = await fetch(`/checkout/${productId}`);
                if (!response.ok) {
                    throw new Error(`Gagal mendapatkan data produk. HTTP Status: ${response.status}`);
                }

                const product = await response.json();

                // Validasi apakah produk ada
                if (!product || !product.id) {
                    throw new Error('Data produk tidak valid atau produk tidak ditemukan.');
                }

                // Update gambar produk
                const productImage = document.getElementById('productImage');
                if (productImage) {
                    productImage.src = product.image || '/images/default-product.jpg';
                }

                // Update nama produk
                const productName = document.getElementById('productName');
                if (productName) {
                    productName.textContent = product.name || 'Produk Tidak Tersedia';
                }

                // Update SKU produk
                const productSku = document.getElementById('productSku');
                if (productSku) {
                    productSku.textContent = `SKU: ${product.id}`;
                }

                // Update bagian harga
                const originalPrice = parseFloat(product.price) || 0;
                const discountedPrice = parseFloat(product.total_price) || originalPrice;

                const priceSection = document.getElementById('priceSection');
                if (priceSection) {
                    priceSection.innerHTML = `
                        <p class="original-price">${originalPrice > discountedPrice ? formatPrice(originalPrice) : ''}</p>
                        <p class="discounted-price">${formatPrice(discountedPrice)}</p>
                        <p class="installment">atau <span>${formatPrice(discountedPrice / 24)}/bln*</span></p>
                        <a href="#">Simulasi cicilan dan Paylater</a>
                    `;
                }

                // Update dropdown model
                const modelSelect = document.getElementById('modelSelect');
                if (modelSelect) {
                    modelSelect.innerHTML = `<option>${product.category || 'Model Tidak Tersedia'}</option>`;
                }
            } catch (error) {
                console.error('Error:', error.message);

                // Tampilkan pesan error di UI
                const productName = document.getElementById('productName');
                if (productName) {
                    productName.textContent = 'Terjadi kesalahan saat memuat data produk.';
                }
            }

            // Helper function untuk format harga
            function formatPrice(price) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                }).format(price).replace('IDR', 'Rp');
            }
        });
    </script>
</body>

</html>
