<div class="slider-container">
    <div class="slider">
        @foreach ($slides as $slide)
            <div class="slide">
                <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}" class="w-full">
                <h2 class="text-3xl font-bold mt-4">{{ $slide['title'] }}</h2>
                <p class="text-gray-600">{{ $slide['description'] }}</p>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
    const slides = document.querySelectorAll(".slide");
    const dots = document.querySelectorAll(".dot");
    let currentIndex = 0;

    function showSlide(index) {
        const slider = document.querySelector(".slider");
        slider.style.transform = `translateX(-${index * 100}%)`;

        dots.forEach(dot => dot.classList.remove("active"));
        dots[index].classList.add("active");
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        showSlide(currentIndex);
    }

    dots.forEach((dot, index) => {
        dot.addEventListener("click", () => {
            currentIndex = index;
            showSlide(index);
        });
    });

    setInterval(nextSlide, 5000); // Slide otomatis setiap 5 detik
    showSlide(currentIndex);
});
</script>

<style>
.slider-container {
    position: relative;
    overflow: hidden;
    width: 100%;
    height: 500px;
    background-color: #000;
}

.slider {
    display: flex;
    transition: transform 0.5s ease-in-out;
    width: 100%;
}

.slide {
    flex: 0 0 100%;
    text-align: center;
    position: relative;
    width: 100%;
    border-radius: 20px; /* Add border radius to the slide itself */
    overflow: hidden; /* Ensure the image stays within the rounded corners */
}

.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 20px; /* Add border radius to the image */
}
.caption {
    position: absolute;
    bottom: 10%;
    left: 50%;
    transform: translateX(-50%);
    color: #fff;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);
    text-align: center;
}

.dots {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

.dot {
    width: 12px;
    height: 12px;
    margin: 0 5px;
    border-radius: 50%;
    background-color: #fff;
    cursor: pointer;
    opacity: 0.5;
    transition: opacity 0.3s;
}

.dot.active {
    opacity: 1;
}
</style>
