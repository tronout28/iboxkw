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
    display: flex; /* Susunan horizontal */
    gap: 20px; /* Jarak antar elemen */
    overflow-x: auto; /* Scroll horizontal */
    padding-top: 20px;
    padding-bottom: 20px;
    padding-left: 150px; /* Padding kiri */
    padding-right: 150px; /* Padding kanan */
    scroll-behavior: smooth; /* Efek scroll mulus */
    white-space: nowrap; /* Mencegah elemen turun ke baris berikutnya */
}


.product-card {
    flex: 0 0 auto;
    text-align: center;
    padding: 10px; /* Spasi dalam elemen */
}

.product-card img {
    width: 100%;
    height: 80px; /* Tinggi gambar */
    object-fit: cover; /* Gambar proporsional tanpa distorsi */
    border-radius: 8px; /* Membulatkan sudut gambar */
}

</style>
<div class="products-grid">
    
    @foreach ($products as $product)
        <div class="product-card">
            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}">
            <h3>{{ $product['name'] }}</h3>
            <p>{{ $product['price'] }}</p>
        </div>
    @endforeach
</div>
