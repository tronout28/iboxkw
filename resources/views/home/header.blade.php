<header class="bg-white shadow-md">
    <style>
        /* Global Font Family */
        body {
            font-family: 'Manrope', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Header Container */
        header {
            background-color: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 12px 0;
            /* Padding lebih besar untuk memberi ruang */
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
            height: 60px;
            /* Menambah tinggi untuk keseimbangan */
            padding: 0 20px;
        }

        /* Logo */
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo img {
            height: 75px;
            /* Ukuran logo yang sedikit lebih besar */
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
            gap: 20px;
            align-items: center;
        }

        .icon-links a {
            color: #374151;
            font-size: 22px;
            /* Ukuran ikon sedikit lebih besar */
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .icon-links a:hover {
            color: #2563eb;
            transform: scale(1.1);
            /* Efek hover zoom */
        }

        /* Navigation Menu */
        nav {
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 24px;
            padding-top: 10px;
        }

        nav a {
            text-decoration: none;
            color: #374151;
            font-size: 16px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #2563eb;
        }

        /* Divider */
        .divider {
            width: 100%;
            height: 1px;
            background-color: #e5e7eb;
            margin-top: 10px;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .top-section {
                flex-direction: column;
                align-items: flex-start;
                height: auto;
                padding: 10px 0;
            }

            .logo {
                margin-bottom: 10px;
            }

            nav {
                flex-direction: column;
                align-items: center;
                gap: 12px;
            }

            .icon-links {
                margin-top: 10px;
            }
        }
    </style>

    <div class="container">
        <!-- Top Section -->
        <div class="top-section">
            <!-- Logo -->
            <div class="logo">
                <img src="http://127.0.0.1:8000/image/beliseken.jpg" alt="Logo">
            </div>
            <!-- Navigation Menu -->
            <nav>
                <a href="home">home</a>
                <a href="/catalogue">Iphone</a>
                <a href="/catalogue">Watch</a>
                <a href="sell">Jual</a>
            </nav>
        </div>

        <div class="divider"></div>
    </div>
</header>