<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="/css/checkout/checkout.css" rel="stylesheet">

    <title>Checkout Produk</title>

    <style>
        .transparent-card {
            background-color: rgba(169, 169, 169, 0.2); /* Transparansi abu-abu */
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .transparent-card p, .transparent-card label {
            margin: 0;
            font-size: 16px;
        }
        .transparent-card p {
            color: #333;
        }
        .transparent-card label {
            font-weight: 500;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50; /* Warna hijau */
            color: white;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            font-size: 16px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #45a049;
        }

        /* Select Dropdown */
        select {
            width: 100%;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #E5E7EB;
            margin-top: 5px;
        }

        /* WhatsApp Button */
        .whatsapp-button {
            display: inline-block;
            background-color: #25D366;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
        }

        .whatsapp-button:hover {
            background-color: #20b958;
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
    <div class="container">
        <div class="product-row">
            <div class="product-image">
                <img id="productImage" src="{{ $product->image ?? '/images/default-product.jpg' }}" alt="{{ $product->name ?? 'Produk Tidak Tersedia' }}">
            </div>

            <div class="product-details">
                <h1 id="productName">{{ $product->name ?? 'Produk Tidak Tersedia' }}</h1>
                <p class="sku" id="productSku">
                    <i class="fas fa-tag"></i>
                    SKU: {{ $product->id ?? '-' }}
                </p>

                <div class="price-section" id="priceSection">
                    @if (!empty($product->total_price))
                        <p class="original-price">
                            {{ $product->price > $product->total_price ? 'Rp' . number_format($product->price, 0, ',', '.') : '' }}
                        </p>
                        <p class="discounted-price">Rp{{ number_format($product->total_price, 0, ',', '.') }}</p>
                        @if($product->price > $product->total_price)
                            <span class="discount-badge">
                                {{ round((($product->price - $product->total_price) / $product->price) * 100) }}% OFF
                            </span>
                        @endif
                    @else
                        <p class="discounted-price">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    @endif
                </div>

                <!-- Menambahkan Deskripsi Produk dengan transparansi abu-abu -->
                <div class="transparent-card description">
                    <i class="fas fa-mobile-alt"></i> Description
                    <p>{{ $product->description ?? 'Deskripsi produk tidak tersedia.' }}</p>
                </div>

                <!-- Mengubah Model menjadi Statik dengan transparansi abu-abu -->
                <div class="transparent-card product-model">
                    <i class="fas fa-mobile-alt"></i> Model
                    <p id="modelSelect">{{ $product->category ?? 'Model Tidak Tersedia' }}</p>
                </div>

                @if ($product->minuses->isNotEmpty())
                    <div class="minus-section">
                        <h3>
                            <i class="fas fa-exclamation-circle"></i>
                            Daftar Minus
                        </h3>
                        <ul>
                            @foreach ($product->minuses as $minus)
                                <li>
                                    <span>{{ $minus->minus_product }}</span>
                                    <span class="minus-price">- Rp{{ number_format($minus->minus_price, 0, ',', '.') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="action-buttons">
                    <a href="https://wa.me/your-number-here" class="contact-admin">
                        <i class="fab fa-whatsapp"></i>
                        Hubungi Admin
                    </a>
                </div>

                <!-- Tombol Kembali -->
                <a href="javascript:history.back()" class="back-button">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <!-- WhatsApp Button -->
                <a class="whatsapp-button" href="https://wa.me/?text={{ urlencode('Saya tertarik dengan produk: ' . ($product->name ?? 'Produk Tidak Tersedia') . ' - Harga: Rp' . number_format($product->total_price ?? $product->price, 0, ',', '.')) }}" target="_blank">
                    Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const productId = "{{ $productId ?? 'null' }}";
            
            if (!productId || productId === 'null') {
                console.error('Product ID tidak ditemukan.');
                return;
            }

            try {
                const response = await fetch(`/checkout/${productId}`);
                if (!response.ok) throw new Error(`HTTP Status: ${response.status}`);

                const product = await response.json();
                if (!product || !product.id) throw new Error('Data produk tidak valid.');

                document.getElementById('productImage').src = product.image || '/images/default-product.jpg';
                document.getElementById('productName').textContent = product.name || 'Produk Tidak Tersedia';
                document.getElementById('productSku').textContent = `SKU: ${product.id}`;

                const priceSection = document.getElementById('priceSection');
                if (product.price > product.total_price) {
                    const discountPercent = Math.round(((product.price - product.total_price) / product.price) * 100);
                    priceSection.innerHTML = ` 
                        <p class="original-price">${formatPrice(product.price)}</p>
                        <p class="discounted-price">
                            ${formatPrice(product.total_price)}
                            <span class="discount-badge">${discountPercent}% OFF</span>
                        </p>
                    `;
                } else {
                    priceSection.innerHTML = `
                        <p class="discounted-price">${formatPrice(product.total_price)}</p>
                    `;
                }

                // Mengubah Model menjadi statik
                document.getElementById('modelSelect').textContent = product.category || 'Model Tidak Tersedia';
            } catch (error) {
                console.error('Error:', error.message);
                document.getElementById('productName').textContent = 'Terjadi kesalahan saat memuat data produk.';
            }

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
