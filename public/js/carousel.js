document.addEventListener("DOMContentLoaded", function () {
    const track = document.querySelector(".carousel-track");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    let index = 0;
    const images = document.querySelectorAll(".carousel-track img");
    const totalImages = images.length;

    function updateCarousel() {
        track.style.transform = `translateX(-${index * 100}%)`;
    }

    function nextImage() {
        index = (index + 1) % totalImages;
        updateCarousel();
    }

    function prevImage() {
        index = (index - 1 + totalImages) % totalImages;
        updateCarousel();
    }

    nextBtn.addEventListener("click", nextImage);
    prevBtn.addEventListener("click", prevImage);

    // Auto slide setiap 3 detik
    setInterval(nextImage, 3000);
    
});
