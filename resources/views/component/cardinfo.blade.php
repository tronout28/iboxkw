<style>
.card-container {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 1.5rem;
    margin: 2rem auto;
    max-width: 100%;
    box-sizing: border-box;
}

.info-card {
    display: flex;
    align-items: flex-start;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 2rem;
    transition: transform 0.2s ease;
    width: 100%;   
}

.info-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.card-content {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;  /* Increased gap */
    width: 100%;   /* Ensure content takes full width */
}

.card-title {
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom: 0.5rem;
}

.card-heading {
    font-size: 1.25rem;
    font-weight: 600;
    line-height: 1.4;
}

.card-description {
    font-size: 1rem;
    line-height: 1.5;
}

@media (min-width: 768px) {
    .card-container {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .card-container {
        grid-template-columns: repeat(4, 1fr);
    }
}
</style>

<div class="card-container">
    {{-- Pickup Card --}}
    <div class="info-card">
        <div class="card-content">
            <h3 class="card-title text-gray-500">PICKUP</h3>
            <p class="card-heading text-gray-800">Kirim dan ambil.</p>
            <p class="card-description text-gray-800">Belanja online dan bebas biaya kirim.</p>
        </div>
    </div>

    {{-- Financing Card --}}
    <div class="info-card">
        <div class="card-content">
            <h3 class="card-title text-blue-500">FINANCING</h3>
            <p class="card-heading text-gray-800">Dapatkan harga spesial dan cicilan 0%</p>
            <p class="card-description text-blue-500">untuk produk-produk Apple.</p>
        </div>
    </div>

    {{-- Experience Days Card --}}
    <div class="info-card">
        <div class="card-content">
            <h3 class="card-title text-gray-500">IBOX EXPERIENCE DAYS</h3>
            <p class="card-heading text-gray-800">Maksimalkan penggunaan produk Apple anda</p>
            <p class="card-description text-gray-400">bersama Apple expert</p>
        </div>
    </div>

    {{-- Sale Card --}}
    <div class="info-card">
        <div class="card-content">
            <h3 class="card-title text-green-500">SALE</h3>
            <p class="card-heading">
                <span class="text-green-500">Penawaran terbaik hari ini</span>
                <span class="text-gray-800">untuk Belanja Online dan Click & PickUp</span>
            </p>
        </div>
    </div>
</div>