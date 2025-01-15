<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Checkout Produk</title>
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
                <img id="productImage" src="{{ $product->image ?? '/images/default-product.jpg' }}" alt="{{ $product->name ?? 'Produk Tidak Tersedia' }}">
            </div>

            <!-- Product Details -->
            <div class="product-details">
                <h1 id="productName">{{ $product->name ?? 'Produk Tidak Tersedia' }}</h1>
                <p class="sku" id="productSku">SKU: {{ $product->id ?? '-' }}</p>

                <!-- Price Section -->
                <div class="price-section" id="priceSection">
                    @if (!empty($product->total_price))
                        <p class="original-price">
                            {{ $product->price > $product->total_price ? 'Rp' . number_format($product->price, 0, ',', '.') : '' }}
                        </p>
                        <p class="discounted-price">Rp{{ number_format($product->total_price, 0, ',', '.') }}</p>
                        <p class="installment">atau <span>Rp{{ number_format($product->total_price / 24, 0, ',', '.') }}/bln*</span></p>
                        <a href="#">Simulasi cicilan dan Paylater</a>
                    @else
                        <p class="discounted-price">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    @endif
                </div>

                <!-- Model Dropdown -->
                <div class="product-model">
                    <label for="modelSelect">Model</label>
                    <select id="modelSelect">
                        <option>{{ $product->category ?? 'Model Tidak Tersedia' }}</option>
                    </select>
                </div>

                <!-- Minus Details -->
                <h3>Daftar Minus</h3>
                @if ($product->minuses->isNotEmpty())
                    <ul>
                        @foreach ($product->minuses as $minus)
                            <li>{{ $minus->minus_product }} - Rp{{ number_format($minus->minus_price, 0, ',', '.') }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>Tidak ada minus terkait dengan produk ini.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('checkout.container')

    <!-- JavaScript -->
     <script>
        document.addEventListener('DOMContentLoaded', async () => {
            // Ambil ID produk dari Blade
            const productId = "{{ $productId ?? 'null' }}";

            // Validasi productId
            if (!productId || productId === 'null') {
                console.error('Product ID tidak ditemukan.');
                return;
            }

            try {
                // Fetch data produk dari server
                const response = await fetch(`/checkout/${productId}`);
                if (!response.ok) {
                    throw new Error(`Gagal mendapatkan data produk. HTTP Status: ${response.status}`);
                }

                const product = await response.json();

                // Validasi data produk
                if (!product || !product.id) {
                    throw new Error('Data produk tidak valid.');
                }

                // Update UI dengan data produk
                document.getElementById('productImage').src = product.image || '/images/default-product.jpg';
                document.getElementById('productName').textContent = product.name || 'Produk Tidak Tersedia';
                document.getElementById('productSku').textContent = `SKU: ${product.id}`;

                // Update harga
                const priceSection = document.getElementById('priceSection');
                priceSection.innerHTML = `
                    <p class="original-price">${product.price > product.total_price ? formatPrice(product.price) : ''}</p>
                    <p class="discounted-price">${formatPrice(product.total_price)}</p>
                    <p class="installment">atau <span>${formatPrice(product.total_price / 24)}/bln*</span></p>
                    <a href="#">Simulasi cicilan dan Paylater</a>
                `;

                // Update dropdown model
                const modelSelect = document.getElementById('modelSelect');
                modelSelect.innerHTML = `<option>${product.category || 'Model Tidak Tersedia'}</option>`;
            } catch (error) {
                console.error('Error:', error.message);

                // Tampilkan error di UI
                document.getElementById('productName').textContent = 'Terjadi kesalahan saat memuat data produk.';
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
