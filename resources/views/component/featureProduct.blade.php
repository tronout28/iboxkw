<div style="background-color: #f5f5f7">
    <div class="featured-container">
        <!-- Left Column - iPad Pro -->
        <div class="left-column">
            <div class="product-info">
                <div class="product-name">iPad Pro M4</div>
                <div class="product-tagline">Super. Tipis.</div>
                <div class="product-price">Mulai Rp18.999.000</div>
                <a href="#" class="buy-button">Beli sekarang</a>
            </div>
            <img src="https://cdnpro.eraspace.com/media/.renditions/wysiwyg/banner/1-50e85981.jpg" alt="iPad Pro M4" class="product-image">
        </div>

        <!-- Right Column - iPhone and Apple Watch -->
        <div class="right-column">
            <div class="product-card">
                <div class="product-info">
                    <div class="product-name">iPhone 15 Pro</div>
                    <div class="product-tagline">Titanium.</div>
                    <div class="product-price">Mulai Rp18.999.000</div>
                    <a href="#" class="buy-button">Beli sekarang</a>
                </div>
            </div>

            <div class="product-card">
                <div class="product-info">
                    <div class="new-badge">NEW</div>
                    <div class="product-name">Apple Watch Series 10</div>
                    <div class="product-tagline">Tipis dan tetap klasik.</div>
                    <div class="product-price">Mulai Rp7.299.000</div>
                    <a href="#" class="buy-button">Beli sekarang</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .featured-container {
        display: flex;
        gap: 20px;
        padding: 20px 150px;
        align-items: stretch; 
    }

    .left-column, .right-column {
        flex: 1;
        background: #f5f5f7;
        border-radius: 12px;    
        padding: 30px;
    }

    .left-column {
        background: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .right-column {
        display: flex;
        flex-direction: column;
        gap: 20px; 
    }

    .product-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        text-align: left;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
    }

    .product-info {
        flex: 1;
    }

    .product-name {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .product-tagline {
        color: #666;
        margin-bottom: 8px;
    }

    .product-price {
        font-size: 0.9rem;
        margin-bottom: 16px;
    }

    .buy-button {
        background-color: #0071e3;
        color: white;
        padding: 8px 24px;
        border-radius: 20px;
        text-decoration: none;
        display: inline-block;
        font-weight: 500;
    }

    .product-image {
        flex: 1;
        max-width: 50%;
        height: auto;
        object-fit: contain;
    }

    .new-badge {
        color: #c4302b;
        font-weight: 600;
        margin-bottom: 8px;
    }

    @media (max-width: 1024px) {
        .featured-container {
            flex-direction: column;
            padding: 20px;
        }
    }
</style>
