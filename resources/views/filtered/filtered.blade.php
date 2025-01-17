<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Manrope', Arial, sans-serif;
            background-color: #f9fafb;
            padding: 2rem;
            color: #333;
        }

        .h1 {
            margin: 2rem auto;
            text-align: center;
            max-width: 1200px;
        }

        .divider {
            width: 100%;
            max-width: 1200px;
            height: 1px;
            background-color: #ddd;
            margin: 2rem auto;
        }

        .section {
            width: 100%;
            max-width: 1200px;
            margin: 2rem auto;
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .filter-menu {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 2rem;
        }

        .filter-menu button {
            padding: 10px 20px;
            border-radius: 5px;
            background-color: black;
            color: gold;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .filter-menu button.active {
            background-color: white;
            color: gold;
        }

        .filter-menu button:hover {
            background-color: white;
            color: black;
        }

        /* Styling untuk section item */
        .section-item {
            flex: 1;
            padding: 20px;
            background-color: #fff;
            text-align: center;
        }

        .section-item .icon {
            font-size: 40px;
            color: #000;
            margin-bottom: 15px;
        }

        .section-item .text {
            font-size: 1rem;
            color: #666;
            max-width: 300px;
            margin: 0 auto;
        }

        .slideshow-container {
            position: relative;
            width: 100%;
            max-width: 1200px;
            margin: 2rem auto;
            box-sizing: border-box;
        }

        .mySlides {
            display: none;
        }

        .slide img {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .search-container {
            text-align: center;
            margin: 80px auto 40px; /* Increased top margin for spacing from header */
            max-width: 600px;
            padding: 0 20px;
            position: relative;
        }

        .search-input-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
            max-width: 500px;
        }

        .search-input {
            padding: 15px 20px 15px 50px;
            font-size: 1rem;
            width: 100%;
            border: 2px solid #ddd;
            border-radius: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            font-family: 'Manrope', sans-serif;
        }

        .search-input:focus {
            outline: none;
            border-color: #000;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            font-size: 1.2rem;
        }

        .search-input::placeholder {
            color: #999;
            font-weight: 500;
        }

        .products-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
        }

        .product-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 250px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-card img {
            width: 100%;
            height: auto;
            max-height: 200px;
            object-fit: contain;
        }

        .product-info {
            padding: 15px;
        }

        .product-name {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-category {
            font-size: 0.9rem;
            color: #888;
            margin-bottom: 5px;
        }

        .product-price {
            font-size: 1.25rem;
            color: #333;
            margin-top: 10px;
            font-weight: bold;
        }
    </style>

    <title>iBox Products</title>
</head>

<body>

    @include('home.header')

    <!-- Search and Filter -->
    <div class="search-container">
        <div class="search-input-wrapper">
            <i class="fas fa-search search-icon"></i>
            <input 
                type="text" 
                class="search-input" 
                id="search-input" 
                placeholder="Cari produk..."
            >
        </div>
    </div>

    <div class="filter-menu">
        <button onclick="filterProducts('All', this)">All</button>
        <button onclick="filterProducts('Iphone X', this)">Iphone X</button>
        <button onclick="filterProducts('Iphone XR', this)">Iphone XR</button>
        <button onclick="filterProducts('Iphone XS', this)">Iphone XS</button>
        <button onclick="filterProducts('Iphone XS Max', this)">Iphone XS Max</button>
        <button onclick="filterProducts('Iphone 11', this)">Iphone 11</button>
        <button onclick="filterProducts('Iphone 11 Pro', this)">Iphone 11 Pro</button>
        <button onclick="filterProducts('Iphone 11 Pro Max', this)">Iphone 11 Pro Max</button>
        <button onclick="filterProducts('Iphone 12', this)">Iphone 12</button>
        <button onclick="filterProducts('Iphone 12 Pro', this)">Iphone 12 Pro</button>
        <button onclick="filterProducts('Iphone 12 Pro Max', this)">Iphone 12 Pro Max</button>
        <button onclick="filterProducts('Iphone 13', this)">Iphone 13</button>
        <button onclick="filterProducts('Iphone 13 Pro', this)">Iphone 13 Pro</button>
        <button onclick="filterProducts('Iphone 13 Pro Max', this)">Iphone 13 Pro Max</button>
        <button onclick="filterProducts('Iphone 14', this)">Iphone 14</button>
        <button onclick="filterProducts('Iphone 14 Pro', this)">Iphone 14 Pro</button>
        <button onclick="filterProducts('Iphone 14 Pro Max', this)">Iphone 14 Pro Max</button>
        <button onclick="filterProducts('Iphone 15', this)">Iphone 15</button>
        <button onclick="filterProducts('Iphone 15 Pro', this)">Iphone 15 Pro</button>
        <button onclick="filterProducts('Iphone 15 Pro Max', this)">Iphone 15 Pro Max</button>
        <button onclick="filterProducts('Watch', this)">Watch</button>
    </div>

    <br>
    <hr style="border: 1px thin black;">
    <br>
    <br>
    <br>

    <div class="products-container" id="products-container">
        <!-- Products will be loaded here dynamically -->
    </div>

    <br>
    <br>
    <br>
    <br>
   <footer>
   @include('component.footer')
   </footer>

    <script>
        // Fungsi untuk memformat harga ke dalam Rupiah
        function formatRupiah(number) {
            return number.toLocaleString('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).replace('IDR', 'Rp ');
        }

        // Fungsi untuk menampilkan semua produk
        async function getProducts() {
            try {
                const response = await fetch('/products');
                const products = await response.json();
                displayProducts(products);
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        }

        // Fungsi untuk menampilkan produk berdasarkan kategori
        async function filterProducts(category, button) {
            try {
                let response;
                if (category === 'All') {
                    response = await fetch('/products');
                } else {
                    response = await fetch(`/products-by-category?category=${category}`);
                }
                const products = await response.json();
                displayProducts(products);
                setActiveButton(button);
            } catch (error) {
                console.error('Error fetching products:', error);
            }
        }

        // Fungsi untuk menampilkan produk di halaman
        // Fungsi untuk menampilkan produk di halaman
        function displayProducts(products) {
            const productsContainer = document.getElementById('products-container');
            productsContainer.innerHTML = '';

            products.forEach(product => {
                const productCard = document.createElement('div');
                productCard.classList.add('product-card');
                productCard.innerHTML = `
            <img src="${product.image}" alt="${product.name}">
            <div class="product-info">
                <h2 class="product-name">${product.name}</h2>
                <p class="product-category">${product.category}</p>
                <p class="product-price">${formatRupiah(product.price)}</p>
            </div>
        `;

                // Event listener untuk mengarahkan ke halaman checkout saat produk diklik
                productCard.addEventListener('click', () => {
                    window.location.href = `/checkout/${product.id}`;
                });

                productsContainer.appendChild(productCard);
            });
        }


        // Fungsi untuk pencarian produk
        document.getElementById('search-input').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const products = document.querySelectorAll('.product-card');
            products.forEach(product => {
                const productName = product.querySelector('.product-name').innerText.toLowerCase();
                if (productName.includes(searchTerm)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        });

        // Fungsi untuk mengaktifkan tombol yang diklik
        function setActiveButton(selectedButton) {
            const buttons = document.querySelectorAll('.filter-menu button');
            buttons.forEach(button => {
                button.classList.remove('active');
            });
            selectedButton.classList.add('active');
        }

        // Memanggil semua produk pada saat halaman pertama kali dimuat
        getProducts();
    </script>
</body>

</html>