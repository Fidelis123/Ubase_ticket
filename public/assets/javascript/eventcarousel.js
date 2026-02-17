/* --- event hero --- */

let slideIndex = 1;

// initial call to show first slide
showSlides(slideIndex);

// Next / previous controls 
function plusSlides(n) {
    showSlides(slideIndex += n);
    
}

// Thumbnail image controls

function currentSlide(n) {
    showSlides(slideIndex = n); 
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("slide");
    let dots = document.getElementsByClassName("dot");

    // loop back to start if at end

    if (n > slides.length) {slideIndex = 1}

    // loop back to end if at start
    
if (n < 1) {slideIndex = slides.length}

// hide all slides
for (i = 0; i < slides.length; i++) {
    slides[i]. style.display = "none";
    slides[i].classList.remove("actuive");
}

// Deactive all dots

for (i = 0; i < dots.length; i++){
    dots[i].className = dots[i].className.replace(" active", "");
}

// show current slide and activate dot
slides[slideIndex-1].style.display = "block";
slides[slideIndex-1].classList.add("active");
dots[slideIndex-1].className += "active";

}