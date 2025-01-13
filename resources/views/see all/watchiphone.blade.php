<div class="iphone-container flex overflow-x-auto p-4 space-x-6">
    <div class="iphone-card flex-shrink-0 flex flex-row items-center space-x-4">
        <img src="https://ibox.co.id/_next/image?url=https%3A%2F%2Fstorage.googleapis.com%2Fproductions-ccm-catalogservice%2Fassets%2Fic-dskt-ct-103430432112402240302434141.webp&w=96&q=70" alt="iPhone 15 Pro" class="w-24 h-24 object-contain">
        <div class="text-left">
            <p class="tittle">iPhone 15 Pro</p>
            <p class="desc">Mulai dari Rp18.999.000</p>
        </div>
    </div>
    <div class="iphone-card flex-shrink-0 flex flex-row items-center space-x-4">
        <img src="https://ibox.co.id/_next/image?url=https%3A%2F%2Fstorage.googleapis.com%2Fproductions-ccm-catalogservice%2Fassets%2Fic-dskt-ct-103430432132400402424440433.webp&w=96&q=70" alt="iPhone 15" class="w-24 h-24 object-contain">
        <div class="text-left">
            <p class="tittle">iPhone 15</p>
            <p class="desc">Mulai dari Rp13.249.000</p>
        </div>
    </div>

    <div class="iphone-card hidden flex-shrink-0 flex flex-row items-center space-x-4 new-card">
        <img src="https://ibox.co.id/_next/image?url=https%3A%2F%2Fstorage.googleapis.com%2Fproductions-ccm-catalogservice%2Fassets%2Fic-dskt-ct-103430432132400402424440433.webp&w=96&q=70" alt="iPhone 15" class="w-24 h-24 object-contain">
        <div class="text-left">
            <p class="tittle">iPhone 15</p>
            <p class="desc">Mulai dari Rp13.249.000</p>
        </div>
    </div>

    <div class="iphone-card flex-shrink-0 flex flex-row items-center space-x-4">
        <img src="https://ibox.co.id/_next/image?url=https%3A%2F%2Fstorage.googleapis.com%2Fproductions-ccm-catalogservice%2Fassets%2Fic-dskt-ct-103430432204431334310021241.webp&w=96&q=70" alt="iPhone 14" class="w-24 h-24 object-contain">
        <div class="text-left">
            <p class="tittle">iPhone 14</p>
            <p class="desc">Mulai dari Rp12.499.000</p>
        </div>
    </div>
    <div class="iphone-card flex-shrink-0 flex flex-row items-center space-x-4">
        <img src="https://ibox.co.id/_next/image?url=https%3A%2F%2Fstorage.googleapis.com%2Fproductions-ccm-catalogservice%2Fassets%2Fic-dskt-ct-103430432213432121422303214.webp&w=96&q=70" alt="iPhone 13" class="w-24 h-24 object-contain">
        <div class="text-left">
            <p class="tittle">iPhone 13</p>
            <p class="desc">Mulai dari Rp9.249.000</p>
        </div>
    </div>
    <div class="divider-container flex flex-col items-center justify-center">
        <div class="divider"></div>
        <span class="arrow">&gt;</span>
    </div>
</div>

<style>
    .iphone-container {
        display: flex;
        overflow-x: auto;
        padding: 2rem 6rem;
        gap: 1.5rem;
    }
    .divider-container {
        display: flex;
        flex-direction: row;
        align-items: center;
    }

    .divider {
        width: 2px;
        height: 50px;
        background-color: #d1d1d1;
    }

    .arrow {
        font-size: 30px; 
        color: #6b6b6b;
        cursor: pointer;
        transition: color 0.3s;
    }

    .arrow:hover {
        color: #000;
    }
    .iphone-card {
        flex-shrink: 0;
        display: flex;
        align-items: end;
        width: 250px; 
    }
    .iphone-card img {
        width: 100px; 
        height: auto;
        transition: transform 0.3s;
    }
    .iphone-card img:hover {
        transform: scale(1.1);
    }

    .tittle {
        font-size: 14px;
        font-weight: bold;
        margin: 0;
    }
    .desc {
        font-size: 12px;
        color: #6b6b6b;
        margin: 5;
    }
    .iphone-container::-webkit-scrollbar {
        height: 8px; 
    }
    .iphone-container::-webkit-scrollbar-thumb {
        background: #d1d1d1;
        border-radius: 4px;
    }
    .iphone-container::-webkit-scrollbar-track {
        background: #f1f1f1; 
    }
    @keyframes slide-in {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>
<script>
    const container = document.querySelector('.iphone-container');
    const btnLeft = document.getElementById('slide-left');
    const btnRight = document.getElementById('slide-right');

    let currentScrollPosition = 0; // Posisi scroll horizontal
    const scrollAmount = 300; // Jumlah pixel untuk geser per klik

    btnLeft.addEventListener('click', () => {
        currentScrollPosition = Math.max(currentScrollPosition - scrollAmount, 0); // Hindari scroll negatif
        container.style.transform = `translateX(-${currentScrollPosition}px)`;
    });

    btnRight.addEventListener('click', () => {
        currentScrollPosition = Math.min(
            currentScrollPosition + scrollAmount,
            container.scrollWidth - container.clientWidth // Hindari scroll lebih dari konten
        );
        container.style.transform = `translateX(-${currentScrollPosition}px)`;
    });
</script>