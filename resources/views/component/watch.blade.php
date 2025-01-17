<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        .divider {
            width: 100%;
            height: 1px;
            background-color: #ddd;
            margin: 20px 0;
        }

        .products {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .product {
            text-align: center;
            margin: 2px;
        }

        .product h3 {
            margin: 5px 0;
            font-size: 16px;
        }

        .products-grid {
            display: flex;
            gap: 20px; /* Jarak antar elemen */
            overflow-x: auto;
            padding-top: 20px;
            padding-bottom: 20px;
            justify-content: center; /* Memusatkan grid secara horizontal */
            scroll-behavior: smooth;
            white-space: nowrap;
        }

        /* Styling for the new product card */
        .product-card {
            display: flex;
            flex-direction: column;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 300px;
            margin: 20px auto; /* Memusatkan setiap produk dengan margin otomatis */
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: 200px;
            object-fit: contain; /* Menjaga gambar tetap utuh di dalam kontainer */
        }

        .product-info {
            padding: 20px;
        }

        .product-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .product-description {
            font-size: 1rem;
            color: #666;
            margin-bottom: 10px;
            word-wrap: break-word; 
            white-space: normal;
        }

        .product-category {
            font-size: 0.9rem;
            color: #888;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: 600;
            color: #f56a00;
        }
    </style>
</head>
<body>
    <div class="products-grid">
        <?php
        $products = [
            [
                'image' => 'https://th.bing.com/th?id=OIP.WRYrPU4OoPXDKr6plK6HeQAAAA&w=243&h=256&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2',
                'name' => 'Iwatch Series 6',
                'description' => 'The latest Iwatch series with advanced health tracking features.',
                'category' => 'Iwatch',
                'price' => 399.99
            ],
            [
                'image' => 'https://th.bing.com/th?id=OIP.WRYrPU4OoPXDKr6plK6HeQAAAA&w=243&h=256&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2',
                'name' => 'Iwatch Series 6',
                'description' => 'The latest Iwatch series with advanced health tracking features.',
                'category' => 'Iwatch',
                'price' => 399.99
            ],
            [
                'image' => 'https://th.bing.com/th?id=OIP.WRYrPU4OoPXDKr6plK6HeQAAAA&w=243&h=256&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2',
                'name' => 'Iwatch Series 6',
                'description' => 'The latest Iwatch series with advanced health tracking features.',
                'category' => 'Iwatch',
                'price' => 399.99
            ],
            [
                'image' => 'https://th.bing.com/th?id=OIP.WRYrPU4OoPXDKr6plK6HeQAAAA&w=243&h=256&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2',
                'name' => 'Iwatch Series 6',
                'description' => 'The latest Iwatch series with advanced health tracking features.',
                'category' => 'Iwatch',
                'price' => 399.99
            ],
        ];

        // Loop through and display products
        foreach ($products as $product) {
        ?>
        <div class="product-card">
            <img src="<?= $product['image']; ?>" alt="<?= $product['name']; ?>" class="product-image">
            <div class="product-info">
                <h2 class="product-name"><?= $product['name']; ?></h2>
                <p class="product-description"><?= $product['description']; ?></p>
                <p class="product-category">Category: <?= $product['category']; ?></p>
                <p class="product-price">$<?= number_format($product['price'], 2); ?></p>
            </div>
        </div>
        <?php } ?>
    </div>
</body>
</html>
