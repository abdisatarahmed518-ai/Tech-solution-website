// ===============================
// SELECT ELEMENTS
// ===============================

// Navigation links inside header
const navLinks = document.querySelectorAll("header nav a");

// Logo element
const logoLink = document.querySelector(".logo");

// All website sections
const sections = document.querySelectorAll("section");

// Mobile menu elements
const menuIcon = document.getElementById("menu-icon");
const navbar = document.querySelector(".navbar");

// Resume buttons and details
const resumeBtns = document.querySelectorAll(".resume-btn");
const resumeDetails = document.querySelectorAll(".resume-detail");

// Portfolio slider elements
const arrowRight = document.querySelector(".arrow-right");
const arrowLeft = document.querySelector(".arrow-left");
const imgSlide = document.querySelector(".portfolio-carousel .img-slide");
const portfolioDetails = document.querySelectorAll(".portfolio-detail");

// Footer top button
const footerIconTop = document.querySelector(".footer-iconTop a");

// New UI Elements
const cursorDot = document.querySelector(".cursor-dot");
const cursorOutline = document.querySelector(".cursor-outline");
const mouseGlow = document.querySelector(".mouse-glow");
const floatingShapes = document.querySelectorAll(".shape");
const scrollProgress = document.querySelector(".scroll-progress");


// ===============================
// PAGE SWITCH FUNCTION
// ===============================

function activePage() {

    // Header animation
    const header = document.querySelector("header");
    const barBox = document.querySelector(".bars-box");

    // Restart header animation
    header.classList.remove("active");

    setTimeout(() => {
        header.classList.add("active");
    }, 800);

    // Remove active class from all nav links
    navLinks.forEach(link => {
        link.classList.remove("active");
    });

    // Restart bars animation
    barBox.classList.remove("active");

    setTimeout(() => {
        barBox.classList.add("active");
    }, 800);

    // Hide all sections
    sections.forEach(section => {
        section.classList.remove("active");
    });
}


// ===============================
// NAVIGATION LINK CLICK
// ===============================

navLinks.forEach((link, index) => {

    link.addEventListener("click", () => {

        // Ignore if already active
        if (link.classList.contains("active")) return;

        // Reset everything
        activePage();

        // Activate clicked nav link
        link.classList.add("active");

        // Show matching section
        setTimeout(() => {
            sections[index].classList.add("active");
        }, 800);
    });
});


// ===============================
// LOGO CLICK → GO HOME
// ===============================

logoLink.addEventListener("click", () => {

    // If Home already active stop
    if (navLinks[0].classList.contains("active")) return;

    activePage();

    // Activate Home link
    navLinks[0].classList.add("active");

    // Show Home section
    setTimeout(() => {
        sections[0].classList.add("active");
    }, 800);
});


// ===============================
// MOBILE MENU TOGGLE
// ===============================

menuIcon.addEventListener("click", () => {

    // Open / Close navbar
    navbar.classList.toggle("active");

    // Change menu icon
    if (menuIcon.classList.contains("fa-bars")) {
        menuIcon.classList.replace("fa-bars", "fa-xmark");
    } else {
        menuIcon.classList.replace("fa-xmark", "fa-bars");
    }
});


// ===============================
// CLOSE MENU WHEN LINK CLICKED
// ===============================

navLinks.forEach(link => {

    link.addEventListener("click", () => {

        navbar.classList.remove("active");

        menuIcon.classList.replace("fa-xmark", "fa-bars");
    });
});


// ===============================
// CLOSE MENU WHEN CLICK OUTSIDE
// ===============================

document.addEventListener("click", (e) => {

    const clickedMenu = menuIcon.contains(e.target);
    const clickedNavbar = navbar.contains(e.target);

    if (!clickedMenu && !clickedNavbar) {

        navbar.classList.remove("active");

        menuIcon.classList.replace("fa-xmark", "fa-bars");
    }
});


// ===============================
// RESUME TAB SWITCH
// ===============================

resumeBtns.forEach((btn, index) => {

    btn.addEventListener("click", () => {

        // Remove active from all buttons
        resumeBtns.forEach(button => {
            button.classList.remove("active");
        });

        // Hide all details
        resumeDetails.forEach(detail => {
            detail.classList.remove("active");
        });

        // Activate clicked button
        btn.classList.add("active");

        // Show matching detail
        resumeDetails[index].classList.add("active");
    });
});


// ===============================
// PORTFOLIO SLIDER
// ===============================

let currentSlide = 0;

if (imgSlide) {

    const totalSlides = imgSlide.children.length;

    // Update slider position
    function updateSlider() {

        // Move images
        imgSlide.style.transform =
            `translateX(calc(${currentSlide * -100}% - ${currentSlide * 2}rem))`;

        // Hide all portfolio details
        portfolioDetails.forEach(detail => {
            detail.classList.remove("active");
        });

        // Show current detail
        if (portfolioDetails[currentSlide]) {
            portfolioDetails[currentSlide].classList.add("active");
        }

        // Disable buttons at edges
        arrowLeft.disabled = currentSlide === 0;
        arrowRight.disabled = currentSlide === totalSlides - 1;
    }

    // Initial slider setup
    updateSlider();

    // Next slide
    arrowRight.addEventListener("click", () => {

        if (currentSlide < totalSlides - 1) {

            currentSlide++;

            updateSlider();
        }
    });

    // Previous slide
    arrowLeft.addEventListener("click", () => {

        if (currentSlide > 0) {

            currentSlide--;

            updateSlider();
        }
    });
}


// ===============================
// FOOTER TOP BUTTON
// ===============================

if (footerIconTop) {

    footerIconTop.addEventListener("click", () => {

        // If Home already active stop
        if (navLinks[0].classList.contains("active")) return;

        activePage();

        // Activate Home
        navLinks[0].classList.add("active");

        // Show Home section
        setTimeout(() => {
            sections[0].classList.add("active");
        }, 800);
    });
}


// ===============================
// SCROLL REVEAL ANIMATION
// ===============================

function revealOnScroll() {

    // Elements to animate
    const revealElements = document.querySelectorAll(
        ".heading:not(.resume-box .heading), .services-box, .portfolio-detail"
    );

    revealElements.forEach(element => {

        // Apply initial styles only once
        if (!element.dataset.revealed) {

            element.dataset.revealed = "true";

            element.style.opacity = "0";

            element.style.transform = "translateY(30px)";

            element.style.transition =
                "all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275)";
        }

        // Check element position
        const rect = element.getBoundingClientRect();

        const windowHeight = window.innerHeight;

        // If element visible
        if (rect.top < windowHeight * 0.9) {

            element.style.opacity = "1";

            element.style.transform = "translateY(0)";
        }
    });
}


// ===============================
// SCROLL EVENTS
// ===============================

// Run on scroll
window.addEventListener("scroll", revealOnScroll);

// Run after page load
window.addEventListener("load", () => {

    setTimeout(revealOnScroll, 1200);
});

// Run immediately
revealOnScroll();


// ===============================
// CUSTOM CURSOR & MOUSE EFFECTS
// ===============================

// ===============================
// CUSTOM CURSOR & MOUSE EFFECTS
// ===============================

let mouseX = 0, mouseY = 0;
let cursorX = 0, cursorY = 0;
let outlineX = 0, outlineY = 0;

window.addEventListener("mousemove", (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
});

function animateMouse() {
    // Smooth interpolation for the outline
    outlineX += (mouseX - outlineX) * 0.15;
    outlineY += (mouseY - outlineY) * 0.15;

    // Dot follows mouse exactly
    if (cursorDot) {
        cursorDot.style.left = `${mouseX}px`;
        cursorDot.style.top = `${mouseY}px`;
    }

    // Outline follows with smooth interpolation
    if (cursorOutline) {
        cursorOutline.style.left = `${outlineX}px`;
        cursorOutline.style.top = `${outlineY}px`;
    }

    // Mouse Glow follows directly (avoiding root CSS variables)
    if (mouseGlow) {
        mouseGlow.style.left = `${mouseX}px`;
        mouseGlow.style.top = `${mouseY}px`;
    }

    // Parallax effect for shapes (direct style update)
    floatingShapes.forEach((shape, index) => {
        const speed = (index + 1) * 0.02;
        const x = (window.innerWidth / 2 - mouseX) * speed;
        const y = (window.innerHeight / 2 - mouseY) * speed;
        shape.style.transform = `translate(${x}px, ${y}px)`;
    });

    requestAnimationFrame(animateMouse);
}

requestAnimationFrame(animateMouse);

// Cursor Hover Effects
const interactiveElements = document.querySelectorAll("a, button, .services-box, .sci a, .resume-btn");

interactiveElements.forEach(el => {
    el.addEventListener("mouseenter", () => {
        if (cursorOutline) {
            cursorOutline.style.transform = "translate(-50%, -50%) scale(1.5)";
            cursorOutline.style.background = "rgba(0, 242, 254, 0.1)";
            cursorOutline.style.borderColor = "transparent";
        }
    });

    el.addEventListener("mouseleave", () => {
        if (cursorOutline) {
            cursorOutline.style.transform = "translate(-50%, -50%) scale(1)";
            cursorOutline.style.background = "transparent";
            cursorOutline.style.borderColor = "var(--main-color)";
        }
    });
});


// ===============================
// SCROLL PROGRESS BAR
// ===============================

window.addEventListener("scroll", () => {
    const windowScroll = document.body.scrollTop || document.documentElement.scrollTop;
    const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrolled = (windowScroll / height) * 100;
    
    if (scrollProgress) {
        scrollProgress.style.width = scrolled + "%";
    }
});


// ===============================
// MAGNETIC EFFECT (SOCIAL ICONS)
// ===============================

const magneticElements = document.querySelectorAll(".sci a, .btn");

magneticElements.forEach(el => {
    el.addEventListener("mousemove", (e) => {
        const rect = el.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;

        el.style.transform = `translate(${x * 0.3}px, ${y * 0.3}px)`;
    });

    el.addEventListener("mouseleave", () => {
        el.style.transform = `translate(0px, 0px)`;
    });
});


