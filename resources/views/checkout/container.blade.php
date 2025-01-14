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
    flex: 0 0 50%; /* Gambar mengambil 40% lebar */
    max-width: 50%;
}

.product-image img {
    width: 100%;
    border-radius: 8px;
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


.product-model,
.product-capacity {
    margin-bottom: 20px;
}

</style>

<div class="container">
    <div class="product-row">
        <!-- Gambar Produk -->
        <div class="product-image">
            <img src="https://ibox.co.id/_next/image?url=https%3A%2F%2Fcdnpro.eraspace.com%2Fmedia%2Fcatalog%2Fproduct%2Fa%2Fp%2Fapple_iphone_15_pro_max_natural_titanium_1_1_2.jpg&w=1920&q=45" alt="iPhone 15 Pro Max">
        </div>

        <!-- Detail Produk -->
        <div class="product-details">
            <h1>iPhone 15 Pro Max</h1>
            <p class="sku">SKU: 8100122807</p>

            <div class="price-section">
                <p class="original-price">Rp 24.999.000</p>
                <p class="discounted-price">Rp 22.999.000 <span class="discount">[8%]</span></p>
                <p class="installment">atau <span>Rp 958.292/bln*</span> untuk 24 bln.</p>
                <a href="#">Simulasi cicilan dan Paylater</a>
            </div>

            <!-- Warna -->
            <div class="product-color">
                <h2>Warna - Natural Titanium</h2>
                <div class="colors">
                    <span class="color gray selected"></span>
                    <span class="color black"></span>
                    <span class="color light-gray"></span>
                    <span class="color white"></span>
                </div>
            </div>

            <!-- Model -->
            <div class="product-model">
                <h2>Model</h2>
                <select>
                    <option>iPhone 15 Pro</option>
                    <option selected>iPhone 15 Pro Max</option>
                </select>
            </div>

            <!-- Kapasitas -->
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
