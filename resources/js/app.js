import "./bootstrap";
import AOS from "aos";
import "aos/dist/aos.css";
import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()
// document.addEventListener("DOMContentLoaded", function () {

AOS.init({
    duration: 1000,
    once: false,
    mirror: true,
    easing: 'ease-out-cubic'
});

// });

document.addEventListener("scroll", function () {

    const scrolled = window.scrollY;
    const bg = document.querySelector(".parallax-bg");

    if(bg){
        bg.style.transform = "translateY(" + (scrolled * 0.4) + "px)";
    }

});