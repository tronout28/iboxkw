<!-- resources/views/components/container2.blade.php -->
<div class="container">
    <p class="label-new">NEW</p>
    <h1 class="title">iPhone 15</h1>
    <p class="description">
        Kesegaran baru.<br>
        Kini tersedia. Mulai dari <span class="price">Rp13.249.000</span>
    </p>
    <div class="actions">
        <a href="#" class="link">Lebih lanjut ></a>
        <a href="#" class="button">Beli sekarang</a>
    </div>
    <div class="image-container">
        <img src="https://ibox.co.id/_next/image?url=https%3A%2F%2Fesmeralda.cygnuss-district8.com%2Fmedia%2Fwysiwyg%2Fibox-v4%2Fimages%2Fbanner-product%2Fbanner-product-iphone.webp&w=1920&q=75" alt="iPhone 15">
    </div>
</div>
<style>
    .container {
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
    padding: 50px 20px;
}

.label-new {
    color: #f97316;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    margin-bottom: 0px;
}

.title {
    font-size: 26px;
    font-weight: bold;
    margin-bottom: 0px;
}

.description { 
    font-size: 14px;
    line-height: 1.5;
}


.actions {
    margin-top: 20px;
}

.link {
    color: #2563eb;
    text-decoration: none;
    margin-right: 20px;
}

.link:hover {
    text-decoration: underline;
}

.button {
    background-color: #2563eb;
    color: #fff;
    padding: 10px 20px;
    border-radius: 25px;
    text-decoration: none;
}

.button:hover {
    background-color: #1d4ed8;
}

.image-container {
    margin-top: 30px;
}

.image-container img {
    max-width: 40%;
    height: auto;
}

</style>