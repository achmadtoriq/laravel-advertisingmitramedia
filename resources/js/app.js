import "./bootstrap";
import AOS from "aos";
import "aos/dist/aos.css";
import Alpine from "alpinejs";
import Lenis from "lenis";

window.Alpine = Alpine;
Alpine.start();

AOS.init({
    duration: 1000,
    once: false,
    mirror: true,
    easing: "ease-out-cubic",
});

const lenis = new Lenis({
    duration: 1.2,
    smoothWheel: true,
});

function raf(time) {
    console.log('test')
    lenis.raf(time);
    requestAnimationFrame(raf);
}

requestAnimationFrame(raf);

window.addEventListener("scroll", () => {
    const scrolled = window.scrollY;
    const bg = document.querySelector(".parallax-bg");

    if (bg) {
        bg.style.transform = `translateY(${scrolled * 0.4}px)`;
    }
});
