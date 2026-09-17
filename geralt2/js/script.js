function scrollToContent() {
    document.querySelector("#intro")?.scrollIntoView({
        behavior: "smooth",
    });
}

function scrollToTop() {
    window.scrollTo({ top: 0, behavior: "smooth" });
}

window.addEventListener("scroll", () => {
    const button = document.querySelector(".back-to-top");
    if (button) {
        button.style.display = window.scrollY > 300 ? "block" : "none";
    }

    const header = document.querySelector(".parallax");
    if (header) {
        header.style.backgroundPositionY = `${window.scrollY * 0.7}px`;
    }
}, { passive: true });

let currentImageIndex = 0;
let previousOverflow = "";
let modalIsOpen = false;

function openModal(index) {
    const images = document.querySelectorAll(".gallery-item img");
    const modal = document.getElementById("imageModal");
    const modalImage = document.getElementById("modalImage");
    const caption = document.getElementById("caption");

    if (!images.length || !modal || !modalImage || !caption) return;

    currentImageIndex = (index + images.length) % images.length;
    const image = images[currentImageIndex];

    modalImage.src = image.src;
    modalImage.alt = image.alt;
    caption.textContent = image.nextElementSibling?.textContent || image.alt;

    if (!modalIsOpen) {
        previousOverflow = document.body.style.overflow;
    }

    modalIsOpen = true;
    modal.style.display = "block";
    document.body.style.overflow = "hidden";
}

function closeModal() {
    const modal = document.getElementById("imageModal");
    if (!modal || !modalIsOpen) return;

    modal.style.display = "none";
    document.body.style.overflow = previousOverflow;
    modalIsOpen = false;
}

function plusSlides(step) {
    openModal(currentImageIndex + step);
}

window.addEventListener("click", (event) => {
    const modal = document.getElementById("imageModal");
    if (modal && event.target === modal) closeModal();
});

document.addEventListener("keydown", (event) => {
    if (!modalIsOpen) return;

    if (event.key === "Escape") closeModal();

    if (event.key === "ArrowRight") {
        event.preventDefault();
        plusSlides(1);
    }

    if (event.key === "ArrowLeft") {
        event.preventDefault();
        plusSlides(-1);
    }
});