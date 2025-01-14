<style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .product-row {
            display: flex;
            align-items: flex-start;
            gap: 100px;
        }

        .product-image {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .product-image img {
            width: 100%;
            border-radius: 8px;
            object-fit: cover;
        }

        .product-details {
            flex: 1;
        }

        .product-details h1 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-details .sku {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .price-section {
            margin-bottom: 20px;
        }

        .price-section .original-price {
            text-decoration: line-through;
            color: #6b7280;
        }

        .price-section .discounted-price {
            color: #dc2626;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .price-section .discount {
            font-size: 0.9rem;
        }

        .price-section .installment span {
            color: #2563eb;
        }

        .price-section a {
            color: #2563eb;
            text-decoration: none;
        }

        .product-color,
        .product-model,
        .product-capacity {
            margin-bottom: 20px;
        }

        .colors {
            display: flex;
            gap: 10px;
            margin: 10px 0;
        }

        .color {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.2s ease;
        }

        .color.selected {
            border-color: #2563eb;
        }

        .color.gray { background-color: #C0C0C0; }
        .color.black { background-color: #000000; }
        .color.light-gray { background-color: #D3D3D3; }
        .color.white { 
            background-color: #FFFFFF; 
            border: 1px solid #E5E7EB; 
        }

        select {
            width: 100%;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #E5E7EB;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .product-row {
                flex-direction: column;
                gap: 30px;
            }

            .product-image {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>

<div class="container">
        <div class="product-row">
            <div class="product-image">
                <img src="" alt="Product Image" onerror="this.src='/images/default-product.jpg'">
            </div>

            <div class="product-details">
                <h1>Loading...</h1>
                <p class="sku">SKU: Loading...</p>

                <div class="price-section">
                    <p class="original-price">Loading...</p>
                    <p class="discounted-price">Loading...</p>
                    <p class="installment">Loading...</p>
                    <a href="#">Simulasi cicilan dan Paylater</a>
                </div>

                <div class="product-color">
                    <h2>Warna - Natural Titanium</h2>
                    <div class="colors">
                        <span class="color gray selected"></span>
                        <span class="color black"></span>
                        <span class="color light-gray"></span>
                        <span class="color white"></span>
                    </div>
                </div>

                <div class="product-model">
                    <h2>Model</h2>
                    <select>
                        <option>Loading...</option>
                    </select>
                </div>

                <div class="product-capacity">
                    <h2>Kapasitas</h2>
                    <select>
                        <option>128 GB</option>
                        <option>256 GB</option>
                        <option>512 GB</option>
                        <option>1 TB</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
