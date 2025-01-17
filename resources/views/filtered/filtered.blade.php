<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="css/filtered/filtered.css" rel="stylesheet">

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
                const response = await fetch('/filtered-products');
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
                    response = await fetch('/filtered-products');
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