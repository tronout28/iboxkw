<header class="bg-white shadow-md">
    <style>
        /* Tambahkan font-family global */
        body {
            font-family: 'Manrope', sans-serif;
        }

        /* Header Container */
        header {
            background-color: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 10px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 24px;
        }

        /* Top Section: Logo, Search Bar, Icons */
        .top-section {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        /* Logo */
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo img {
            height: 30px;
        }

        .logo .partner-badge {
            display: flex;
            align-items: center;
            border: 1px solid #d1d5db;
            padding: 2px 8px;
            border-radius: 6px;
            font-size: 12px;
            color: #374151;
        }

        /* Search Box */
        .search-box {
            flex: 1;
            margin: 0 20px;
            position: relative;
            max-width: 600px;
        }

        .search-box input {
            width: 100%;
            padding: 8px 40px;
            border: 1px solid #d1d5db;
            border-radius: 20px;
            background-color: #f9fafb;
            font-size: 14px;
        }

        .search-box svg {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #9ca3af;
            width: 16px;
            height: 16px;
        }

        /* Icon Links */
        .icon-links {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .icon-links a {
            color: #374151;
            font-size: 20px;
            transition: color 0.2s;
        }

        .icon-links a:hover {
            color: #2563eb;
        }

        /* Navigation Menu */
        nav {
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 20px;
            padding-top: 10px;
        }

        nav a {
            text-decoration: none;
            color: #374151;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s;
        }

        nav a:hover {
            color: #2563eb;
        }
    </style>

    <div class="container">
        <!-- Top Section -->
        <div class="top-section">
            <!-- Logo -->
            <div class="logo">
                <img src="path-to-logo.png" alt="Logo">
            </div>

            <!-- Search Box -->
            <div class="search-box">
                <input type="text" placeholder="Cari produk">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </div>

            <div class="icon-links">
    <a href="{{ route('sell') }}">
        <i class="fa fa-shopping-bag fa-lg" style="color: #000;"></i>
    </a>
</div>



        </div>

        <!-- Navigation Menu -->
        <nav>
            <a href="#">Mac</a>
            <a href="#">iPad</a>
            <a href="#">iPhone</a>
            <a href="#">Watch</a>
            <a href="#">Music</a>
            <a href="#">Aksesoris</a>
            <a href="#">Layanan</a>
            <a href="#">Event & Promo</a>
        </nav>
    </div>
</header>
