<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="" rel="stylesheet">
    <style>
        
        .h1 {
            margin-top: 20px;
            text-align: center;
        }

        .divider {
            width: 100%;
            height: 1px;
            background-color: #ddd;
            margin: 20px 0;
        }

        /* Styling untuk section */
        .section {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 20px;
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
            color: #000; /* Set icon color to black */
            margin-bottom: 15px;
        }

        .section-item .text {
            font-size: 1rem;
            color: #666;
            max-width: 300px; /* Limit text width */
            margin: 0 auto;
        }

        .slideshow-container {
        position: relative;
        max-width: 100%;
        margin-bottom: 20px;
    }

        .mySlides {
            display: none;
        }

        .slide img {
            width: 100%; /* Mengurangi lebar gambar menjadi 80% dari ukuran asli */
            height: auto; /* Menjaga proporsi gambar */
            max-height: 500px; /* Membatasi tinggi gambar */
            object-fit: contain; /* Menyesuaikan gambar agar tetap menutupi area */
            display: block; /* Mengubah gambar menjadi block-level element */
            margin: 0 auto; /* Memusatkan gambar secara horizontal */
        }

        

    </style>

    <title>iBox</title>
</head>
<body>
    
    @include('home.header')

    <!-- Banner Slideshow -->
    <div class="slideshow-container">
        <div class="mySlides fade">
            <div class="slide">
                <img src="https://mir-s3-cdn-cf.behance.net/project_modules/2800_opt_1/7fbb7666101167.5b13b610aabe7.jpg" alt="Slide 1">
            </div>
        </div>



        <div class="mySlides fade">
            <div class="slide">
                <img src="https://ibox.co.id/_next/image?url=https%3A%2F%2Fstorage.googleapis.com%2Feraspacelink%2Fpmp%2Fproduction%2Fbanners%2Fimages%2FcZeczD8aEY1Rr4TdUBwP9vCX2lDuUGvAWAnkU2QF.webp&w=1920&q=85" alt="Slide 2">
            </div>
        </div>
    </div>
    <div class="divider"></div>
    <h1 class="h1">Cek produk terbaru</h1>
    @include('component.produk')

    <div class="divider"></div>

    <div class="section">
        <h1></h1>
      <!-- iPhone Section -->
        <!-- iPhone Section -->
<div class="section-item">
    <div class="icon">
        <i class="fas fa-mobile-alt"></i> <!-- Icon iPhone -->
    </div>
    <p class="text">Temukan iPhone terbaru dengan berbagai fitur canggih yang mempermudah hidup Anda. Mulai dari kamera profesional hingga performa luar biasa.</p>
</div>

<!-- iWatch Section -->
<div class="section-item">
    <div class="icon">
        <i class="fas fa-clock"></i> <!-- Icon iWatch (jika tersedia) -->
    </div>
    <p class="text">Dengan iWatch, pantau kesehatan Anda dengan lebih mudah dan tetap terhubung dengan dunia sekitar. Fitur canggih dan desain elegan.</p>
</div>


    </div>

    <div class="divider"></div>

    <h1 class="h1">Artikel tentang apple</h1>
    @include('component.cardinfo')

    <div class="divider"></div>

    <h1 class="h1">Produk Watch kami</h1>

    @include('component.watch')


    @include('component.footer')

    <script>
        // JavaScript untuk Slideshow
        let slideIndex = 0;

        function showSlides() {
            let slides = document.getElementsByClassName("mySlides");
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1;
            }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 3000); // Change image every 3 seconds
        }

        showSlides();
    </script>
</body>
</html>
