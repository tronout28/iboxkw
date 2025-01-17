<style>
    body, html {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%; /* Pastikan halaman memiliki tinggi penuh */
        box-sizing: border-box; /* Untuk memastikan padding dan border dihitung dalam ukuran elemen */
    }

    footer {
        background-color: #f1f1f1; /* Ganti background menjadi abu-abu terang */
        color: #333; /* Ganti teks menjadi warna gelap */
        width: 100%;
        position: relative;
        bottom: 0;
        padding: 40px 0;
        text-align: center;
        font-size: 0.9rem;
    }

    footer a {
        color: #333;
        text-decoration: none;
        margin-left: 10px;
    }

    footer a:hover {
        text-decoration: underline;
    }

    .footer-links {
        display: flex;
        justify-content: space-evenly;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .footer-links .link-column {
        flex: 1;
        max-width: 200px;
        margin: 10px;
    }

    .footer-links h4 {
        margin-bottom: 10px;
        font-size: 1.1rem;
        font-weight: bold;
    }

    .footer-links p {
        margin: 5px 0;
        font-size: 0.9rem;
    }
</style>

<footer>
    <div class="footer-links">
        <!-- Belanja Section -->
        <div class="link-column">
            <h4>Belanja</h4>
            <p><a href="#">iPhone</a></p>
            <p><a href="#">Watch</a></p>
        </div>

        
        <!-- Layanan Section -->
        <div class="link-column">
            <h4>Layanan</h4>
            <p><a href="#">Layanan pelanggan</a></p>
            <p><a href="#">Bisnis</a></p>
            <p><a href="#">Financing</a></p>    
            <p><a href="#">Trade-In</a></p>
            <p><a href="#">In-Store Classes</a></p>
            <p><a href="#">AppleCare</a></p>
            <p><a href="#">iProtect</a></p>
        </div>

        <!-- Tentang iBox Section -->
        <div class="link-column">
            <h4>Tentang iBox</h4>
            <p><a href="#">Tentang iBox</a></p>
            <p><a href="#">Hubungi kami</a></p>
            <p><a href="#">Yang sering ditanyakan</a></p>
            <p><a href="#">Cari toko</a></p>
        </div>

        <!-- Kebijakan Section -->
        <div class="link-column">
            <h4>Kebijakan</h4>
            <p><a href="#">Kebijakan pengiriman</a></p>
            <p><a href="#">Kebijakan privasi</a></p>
        </div>

        <!-- Akun saya Section -->
        <div class="link-column">
            <h4>Akun saya</h4>
            <p><a href="#">Akun saya</a></p>
        </div>
    </div>

    <p>&copy; 2025 iBox. All Rights Reserved.</p>
    <p>Follow us on:
        <a href="#">Facebook</a> |
        <a href="#">Instagram</a>
    </p>
</footer>
