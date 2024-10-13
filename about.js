// homescripts.js

document.addEventListener("DOMContentLoaded", function() {
    // Slideshow Functionality
    let slideIndex = 1;
    showSlides(slideIndex);

    // Next/Previous controls
    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    // Current slide
    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    // Show slides
    function showSlides(n) {
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");

        if (n > slides.length) { slideIndex = 1 }
        if (n < 1) { slideIndex = slides.length }

        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }

        for (let i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }

        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }

    // Slideshow automatic transition
    setInterval(function() {
        plusSlides(1);
    }, 5000);  // Change slide every 5 seconds

    // Testimonial Carousel Functionality
    let testimonialIndex = 0;
    showTestimonials();

    function showTestimonials() {
        let testimonials = document.querySelectorAll(".testimonial-item");
        testimonials.forEach((testimonial, index) => {
            testimonial.style.display = (index === testimonialIndex) ? "block" : "none";
        });
        testimonialIndex++;
        if (testimonialIndex >= testimonials.length) {
            testimonialIndex = 0;
        }
        setTimeout(showTestimonials, 5000);  // Change testimonial every 5 seconds
    }

    // Form Validation for the Newsletter Signup
    const form = document.querySelector("#newsletter form");
    form.addEventListener("submit", function(event) {
        const emailInput = form.querySelector('input[name="email"]');
        if (!validateEmail(emailInput.value)) {
            alert("Please enter a valid email address.");
            event.preventDefault();
        }
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // Mobile Menu Toggle
    const navToggle = document.createElement("button");
    navToggle.className = "nav-toggle";
    navToggle.innerHTML = "&#9776;";
    document.querySelector("header .container").appendChild(navToggle);

    const nav = document.querySelector("header nav");
    navToggle.addEventListener("click", function() {
        nav.classList.toggle("active");
    });

    // Add active class to the current link
    const currentPage = location.pathname.split("/").pop();
    const navLinks = document.querySelectorAll("nav a");
    navLinks.forEach(link => {
        if (link.getAttribute("href") === currentPage) {
            link.classList.add("active");
        }
    });
});
