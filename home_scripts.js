// Slideshow JavaScript
let slideIndex = 0;
showSlides();

function showSlides() {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) { slideIndex = 1; }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
    setTimeout(showSlides, 5000); // Change slide every 5 seconds
}

function plusSlides(n) {
    showSlides(slideIndex += n);
}

// Testimonial Carousel JavaScript
let testimonialIndex = 0;
showTestimonials();

function showTestimonials() {
    let i;
    let testimonials = document.getElementsByClassName("testimonial-item");
    for (i = 0; i < testimonials.length; i++) {
        testimonials[i].style.display = "none";
    }
    testimonialIndex++;
    if (testimonialIndex > testimonials.length) { testimonialIndex = 1; }
    testimonials[testimonialIndex - 1].style.display = "block";
    setTimeout(showTestimonials, 5000); // Change testimonial every 5 seconds
}

// Form Validation for Newsletter Signup
document.addEventListener("DOMContentLoaded", function() {
    const newsletterForm = document.querySelector("#newsletter form");
    newsletterForm.addEventListener("submit", function(event) {
        const emailInput = newsletterForm.querySelector('input[name="email"]');
        if (!validateEmail(emailInput.value)) {
            event.preventDefault();
            alert("Please enter a valid email address.");
        }
    });

    function validateEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }
});
