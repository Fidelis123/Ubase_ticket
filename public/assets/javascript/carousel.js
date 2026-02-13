const slides = document.querySelectorAll('.bg-slide');
        let currentSlide = 0;
        const slideInterval = 5000; // 5 seconds

function nextSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % slides.length;
    slides[currentSlide].classList.add('active');   
}

setInterval(nextSlide,slideInterval);