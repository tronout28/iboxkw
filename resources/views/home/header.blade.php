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
                <!-- Replace the URL below with the actual image URL -->
                <img src="https://www.bing.com/ck/a?!&&p=724a1f6a1754d15d61d31286d31cf9df5c00877a44c24a96eb0d4e4f8fff2cfdJmltdHM9MTczNjk4NTYwMA&ptn=3&ver=2&hsh=4&fclid=003d10f2-e6e9-630e-0bb9-05c8e7bf62bb&u=a1L2ltYWdlcy9zZWFyY2g_cT1sb2dvJTIwYXBwbGUmRk9STT1JUUZSQkEmaWQ9NTc4OEFGRjdGM0UyMUREQ0RDRTdCQzREMTY2NTY4QTdCRUM2RTZERA&ntb=1" alt="Logo">
            </div>


            <div class="icon-links">
                <a href="https://ibox.co.id/">
                    <i class="fa fa-shopping-bag fa-lg" style="color: #000;"></i>
                </a>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav>
            <a href="https://ibox.co.id/iphone">home</a>

            <a href="https://ibox.co.id/iphone">Iphone</a>
            <a href="https://ibox.co.id/watch">Watch</a>
        </nav>
        <div class="divider"></div>

    </div>
</header>
