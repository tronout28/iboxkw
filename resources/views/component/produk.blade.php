<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Auto Scroll</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f9fafb;
            padding: 2rem;
            color: #333;
        }

        .products-container {
            overflow: hidden;
            width: 100%;
            max-width: 1200px;
            margin: 2rem auto;
            box-sizing: border-box;
        }

        .products-slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .product-card {
            min-width: 25%;
            /* Maksimal 4 produk dalam satu layar */
            box-sizing: border-box;
            padding: 15px;
        }

        .product-card-inner {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            cursor: pointer;
        }

        .product-card img {
            width: 100%;
            height: auto;
            max-height: 200px;
            object-fit: contain;
        }

        .partner-badge {
            align-items: center;
            border: 1px solid #d1d5db;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 12px;
            color: red;
        }

        .product-info {
            padding: 15px;
            text-align: left;
            /* Menambahkan text-align kiri */
        }

        .product-info h2,
        .product-info p {
            margin: 0 0 10px;
            /* Menambahkan margin bawah agar lebih teratur */
        }

        .product-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .product-description {
            font-size: 1rem;
            color: #666;
            margin-bottom: 10px;
            word-wrap: break-word;
            white-space: normal;
        }

        .product-category {
            font-size: 0.9rem;
            color: #888;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 1.125rem;
            color: #333;
            margin-top: 10px;
            font-weight: bold;
            text-align: left;
            /* Menambahkan text-align kiri untuk harga */
        }
    </style>
</head>

<body>
    <div class="products-container">
        <div class="products-slider" id="products-slider">
            <!-- Products will be dynamically added here -->
        </div>
    </div>

    <script>
        async function fetchProducts() {
            try {
                const response = await fetch('/filtered-products');
                const products = await response.json();
                const productsSlider = document.getElementById('products-slider');

                // Tambahkan produk ke slider
                products.forEach(product => {
                    const productCard = document.createElement('div');
                    productCard.classList.add('product-card');
                    productCard.innerHTML = `
                        <div class="product-card-inner">
                            <img src="${product.image}" alt="${product.name}">
                            <div class="product-info">
                                <h2 style="text-align: center;">${product.name}</h2>
                                <span class="partner-badge">Star</span>
                                <p>${product.category}</p>
                                <p class="product-description">${product.description}</p>
                                <br>
                                <p class="product-price" style="text-align: right;">${formatRupiah(product.price)}</p>
                            </div>
                        </div>
                    `;
                    productCard.addEventListener('click', () => {
                        window.location.href = `/checkout/${product.id}`;
                    });
                    productsSlider.appendChild(productCard);
                });

                // Aktifkan auto-scroll yg keren
                autoScroll(productsSlider, products.length);
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        }

        // Fungsi untuk memformat angka ke format Rupiah
        function formatRupiah(number) {
            return number.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).replace('IDR', ''); // Hapus IDR, biar cuma ada Rp
        }

        function autoScroll(slider, totalProducts) {
            const cardWidth = slider.children[0].offsetWidth; // Lebar satu card
            let position = 0; // Posisi awal slider
            const totalVisibleCards = 4; // Jumlah kartu yang terlihat di layar
            const intervalTime = 3000; // Interval 3 detik

            setInterval(() => {
                position -= cardWidth; // Geser ke kiri

                // Jika ada 4 produk yang tersisa di layar, reset ke awal
                if (Math.abs(position) >= cardWidth * totalProducts - cardWidth * totalVisibleCards) {
                    position = 0; // Reset ke awal
                }

                slider.style.transform = `translateX(${position}px)`;
            }, intervalTime);
        }

        window.onload = fetchProducts;
    </script>
</body>

</html>