<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Artikel</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f8f8;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background: linear-gradient(90deg, #4e54c8, #8f94fb);
            padding: 20px 0;
            text-align: center;
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
        }

        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 20px;
        }

        .article-image img {
            width: 100%;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .article-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .article-header h1 {
            font-size: 2rem;
            margin: 10px 0;
            color: #4e54c8;
        }

        .article-header p {
            font-size: 1rem;
            color: #777;
        }

        .article-content h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #4e54c8;
        }

        .article-content {
            font-size: 1rem;
            line-height: 1.8;
            color: #555;
            text-align: justify;
        }

        .btn-share {
            display: inline-block;
            background: linear-gradient(90deg, #4e54c8, #8f94fb);
            color: white;
            padding: 12px 30px;
            font-size: 1rem;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            text-decoration: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-share:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(78, 84, 200, 0.5);
        }

        @media (max-width: 768px) {
            .article-header h1 {
                font-size: 1.8rem;
            }

            .article-content {
                font-size: 0.9rem;
            }
        }
    </style>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header Section -->
    <header>
        Detail Artikel
    </header>

    <!-- Main Content Section -->
    <div class="container">
        <div class="card">
            <div class="article-image">
                <img src="{{ asset('images-artikel/' . basename($artikel->image)) }}" alt="Gambar Artikel">
            </div>

            <div class="article-header">
                <h1>{{ $artikel->title }}</h1>
                <p>Dipublikasikan: {{ date('d M Y', strtotime($artikel->created_at)) }}</p>
            </div>

            <div class="article-content">
                <h3>Deskripsi</h3>
                <p>{!! nl2br(e($artikel->subtitle)) !!}</p>

                <h3>Konten</h3>
                <p>{!! nl2br(e($artikel->content)) !!}</p>
            </div>

            <div class="text-center mt-4">
                <a href="{{ url()->previous() }}" class="btn-share">Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>
