<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link href="" rel="stylesheet">

    <title>iBox</title>
</head>
<body>
    @include('home.header')

    @php
        $slides = [
            ['image' => 'https://ibox.co.id/_next/image?url=https%3A%2F%2Fstorage.googleapis.com%2Feraspacelink%2Fpmp%2Fproduction%2Fbanners%2Fimages%2FCvO3mb00rqkxRwTgyGp9Qx2gZ2KSLALT95lMzIRN.jpg&w=1920&q=85', 'title' => 'iPhone 16 Pro', 'description' => 'Cek kembali untuk informasi ketersediaan.'],
            ['image' => 'https://ibox.co.id/_next/image?url=https%3A%2F%2Fstorage.googleapis.com%2Feraspacelink%2Fpmp%2Fproduction%2Fbanners%2Fimages%2FjjBQ0PFwuE1ckodQHGFxrg8hpIKBkM3xfdm7CtuC.jpg&w=1920&q=85', 'title' => 'MacBook Pro', 'description' => 'Desain baru yang revolusioner.'],
        ];

        $products = [
            ['image' => 'https://esmeralda.cygnuss-district8.com/media/wysiwyg/ibox-v4/images/berbagai-produk/mac.png', 'name' => 'Mac', 'price' => 'Mulai Rp12 juta'],
            ['image' => 'https://esmeralda.cygnuss-district8.com/media/wysiwyg/ibox-v4/images/berbagai-produk/iphone.png', 'name' => 'Iphone', 'price' => 'Mulai Rp7 Juta'],
            ['image' => 'https://esmeralda.cygnuss-district8.com/media/wysiwyg/iPad_-_Cek_yang_terbaru.webp?rand=1720254832', 'name' => 'Ipad', 'price' => 'Mulai Rp5 Juta'],
            ['image' => 'https://esmeralda.cygnuss-district8.com/media/wysiwyg/ibox-v4/images/berbagai-produk/apple-watch.png', 'name' => 'WATCH', 'price' => 'Mulai Rp4 juta'],
            ['image' => 'https://esmeralda.cygnuss-district8.com/media/wysiwyg/ibox-v4/images/berbagai-produk/music.png', 'name' => 'Music', 'price' => 'Mulai Rp1 juta'],
            ['image' => 'https://esmeralda.cygnuss-district8.com/media/wysiwyg/ibox-v4/images/berbagai-produk/accessories.png', 'name' => 'Aksesori', 'price' => 'Mulai Rp400 ribu'],
            ['image' => 'https://esmeralda.cygnuss-district8.com/media/wysiwyg/ibox-v4/images/berbagai-produk/airtag.png', 'name' => 'AirTag', 'price' => 'Mulai Rp400 ribu'],  
        ];
        $new = [
            ['image' => 'https://cdnpro.eraspace.com/media/.renditions/wysiwyg/banner/1-50e85981.jpg', 'title' => 'iPhone 16 Pro', 'description' => 'Deskripsi.'],
            ['image' => 'https://cdnpro.eraspace.com/media/.renditions/wysiwyg/banner/1-50e85981.jpg', 'title' => 'iPhone 16 Pro', 'description' => 'Deskripsi'],
            ['image' => 'https://cdnpro.eraspace.com/media/.renditions/wysiwyg/banner/1-50e85981.jpg', 'title' => 'iPhone 16 Pro', 'description' => 'Deskripsi.'],
            ['image' => 'https://cdnpro.eraspace.com/media/.renditions/wysiwyg/banner/1-50e85981.jpg', 'title' => 'iPhone 16 Pro', 'description' => 'Deskripsi'],
        ];
    @endphp
    @include('component.slider', ['slides' => $slides])
    <div class="divider my-6 border-t-2 border-gray-200"></div>
    <h2 class="text-2xl font-semibold text-center" style="padding: 0 150px;">Berbagai produk Iphone</h2>
    @include('component.produk', ['products' => $products])
    <div class="divider my-6 border-t-2 border-gray-200"></div>
    <h2 class="text-2xl font-semibold text-center" style="padding: 0 150px;">Cek yang terbaru</h2>
   <div class="products-grid" style="padding: 20px 150px;">
    @foreach ($new as $product)
        @include('component.card', [
            'image' => $product['image'],
            'title' => $product['title'],
            'description' => $product['description'],
            'price' => ''
        ])
    @endforeach
    
</div>
<div class="divider my-6 border-t-2 border-gray-200"></div>
<h2 class="text-2xl font-semibold text-center" style="padding: 0 150px;">Artikel</h2>
<div style="padding: 20px 150px;">
    @include('component.cardinfo')
</div>


</body>
</html>
