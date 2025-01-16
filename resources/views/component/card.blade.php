<style>
    .card {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        width: 300px;
        margin: 10px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .card-image {
        width: 100%;
        border-radius: 8px;
        margin-bottom: 15px;
        object-fit: cover;
    }

    .card-content {
        text-align: left;
        width: 100%;
    }

    .card-badge {
        font-size: 12px;
        color: #f26724;
        font-weight: bold;
        margin-bottom: 10px;
        display: block;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        color: #000;
        margin: 8px 0;
    }

    .card-description {
        font-size: 14px;
        color: #666;
        margin: 10px 0;
    }

    .card-price {
        font-size: 16px;
        font-weight: 600;
        color: #000;
        margin-top: 10px;
    }

    .products-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: flex-start;
        /* Align content to the left */
        padding: 20px 10px;
    }
</style>

<div id="product-container" class="products-row"></div>

<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const container = document.getElementById('product-container');

        async function fetchProducts() {
            try {
                const response = await fetch('/api/filtered-products'); // Menggunakan fungsi getFilteredProducts
                if (!response.ok) throw new Error('Failed to fetch products');

                const products = await response.json();
                container.innerHTML = ''; // Kosongkan kontainer sebelum menampilkan produk baru
                products.forEach(product => {
                    const cardHtml = `
                        <div class="card" onclick="navigateToProduct(${product.id})">
                            <img src="${product.image || '/images/default-product.jpg'}" 
                                 alt="${product.name}" 
                                 class="card-image"
                                 onerror="this.src='/images/default-product.jpg'">
                            <div class="card-content">
                                ${product.category ? `<span class="card-badge">${product.category}</span>` : ''}
                                <h3 class="card-title">${product.name}</h3>
                                <p class="card-description">${product.description || 'Deskripsi tidak tersedia'}</p>
                                <p class="card-price">Rp${Number(product.price).toLocaleString('id-ID')}</p>
                            </div>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', cardHtml);
                });
            } catch (error) {
                console.error('Error fetching products:', error);
                container.innerHTML = '<p>Gagal memuat produk. Silakan coba lagi nanti.</p>';
            }
        }

        window.navigateToProduct = (productId) => {
            window.location.href = `/checkout/${productId}`;
        };

        fetchProducts();
    });
</script>