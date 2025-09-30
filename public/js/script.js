// Slider functionality
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.slider-dot');
    let currentSlide = 0;
    
    if (slides.length > 0) {
        // Show the first slide
        showSlide(currentSlide);
        
        // Set up automatic sliding
        setInterval(nextSlide, 5000);
        
        // Add click events to dots
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
            });
        });
    }
    
    // Mobile menu toggle
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');
    
    if (hamburger && navMenu) {
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
        });
        
        // Close menu when clicking on a link
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });
    }
    
    // Slider functions - using the cached slide and dot elements
    function showSlide(n) {
        // Hide all slides
        slides.forEach(slide => {
            slide.classList.remove('active');
        });
        
        // Remove active class from all dots
        dots.forEach(dot => {
            dot.classList.remove('active');
        });
        
        // Show current slide
        if (slides[n] && dots[n]) {
            slides[n].classList.add('active');
            dots[n].classList.add('active');
        } else if (slides.length > 0) {
            // If index is out of bounds, go to first slide
            slides[0].classList.add('active');
            dots[0].classList.add('active');
            currentSlide = 0;
        }
    }

    function nextSlide() {
        if (slides.length > 0) {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }
    }
});

// Form validation
function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll('input[required], textarea[required], select[required]');
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
            input.classList.add('error');
        } else {
            input.classList.remove('error');
        }
    });
    
    return isValid;
}

// Add error class to form inputs
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(form)) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
        
        // Remove error class on input
        const inputs = form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                if (this.classList.contains('error')) {
                    this.classList.remove('error');
                }
            });
        });
    });
});