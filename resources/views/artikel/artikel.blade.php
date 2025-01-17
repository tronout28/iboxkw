<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Artikel</title>
    <link href="/css/artikel/artikel.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Quicksand:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header Section -->
    @include('home.header')

    <!-- Main Content Section -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <!-- Article Header -->
              <!-- Article Header -->
            <div class="article-image mb-5">
                <img src="{{ asset('images-artikel/' . basename($artikel->image)) }}" alt="Gambar Artikel" class="img-fluid w-100 rounded">
            </div>
            <div class="article-header mb-4 text-center">
                <h1 class="display-4">{{ $artikel->title }}</h1>
                <p class="text-muted">Dipublikasikan: {{ date('d M Y', strtotime($artikel->created_at)) }}</p>
            </div>


                <!-- Article Image -->
               

                <!-- Article Subtitle -->
                <div class="article-subtitle mb-4">
                    <h3 class="h4">{{ $artikel->subtitle }}</h3>
                </div>

                <!-- Divider -->
                <div class="my-4 border-top"></div>

                <!-- Article Content -->
                <div class="article-content">
                    <p>{!! nl2br(e($artikel->content)) !!}</p>
                </div>

                <!-- Share Button -->
                <div class="text-center mt-4">
                    <a href="#" class="btn btn-primary">Bagikan Artikel</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
