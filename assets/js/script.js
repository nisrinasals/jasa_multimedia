// Animasi fade-in saat halaman di-load
document.addEventListener("DOMContentLoaded", function () {
    const faders = document.querySelectorAll(".fade-in");
    faders.forEach(el => {
        el.classList.add("visible");
    });
});