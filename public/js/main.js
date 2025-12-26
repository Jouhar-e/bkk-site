// Mobile menu and dropdowns
document.addEventListener("DOMContentLoaded", function () {
    const mobileMenuButton = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");
    const mobileDropdownToggles = document.querySelectorAll(
        ".mobile-dropdown-toggle"
    );

    // Toggle mobile menu
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener("click", function () {
            mobileMenu.classList.toggle("hidden");
            // Toggle icon
            const icon = this.querySelector("i");
            if (icon.classList.contains("fa-bars")) {
                icon.classList.replace("fa-bars", "fa-times");
            } else {
                icon.classList.replace("fa-times", "fa-bars");
            }
        });
    }

    // Toggle mobile dropdown
    mobileDropdownToggles.forEach((toggle) => {
        toggle.addEventListener("click", function () {
            const dropdownContent = this.nextElementSibling;
            const icon = this.querySelector(".fa-chevron-down");

            dropdownContent.classList.toggle("hidden");
            icon.classList.toggle("fa-chevron-down");
            icon.classList.toggle("fa-chevron-up");
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener("click", function (event) {
        // Close mobile menu if clicking outside
        if (
            mobileMenu &&
            !mobileMenu.contains(event.target) &&
            mobileMenuButton &&
            !mobileMenuButton.contains(event.target) &&
            !mobileMenu.classList.contains("hidden")
        ) {
            mobileMenu.classList.add("hidden");
            const icon = mobileMenuButton.querySelector("i");
            if (icon.classList.contains("fa-times")) {
                icon.classList.replace("fa-times", "fa-bars");
            }
        }

        // Close desktop dropdowns when clicking outside
        const dropdownMenus = document.querySelectorAll(".dropdown-menu");
        dropdownMenus.forEach((menu) => {
            if (
                !menu.parentElement.contains(event.target) &&
                menu.classList.contains("group-hover:visible")
            ) {
                // We can't directly manipulate the group-hover classes,
                // but we can handle this with additional JavaScript if needed
            }
        });
    });

    // Close mobile dropdowns when a link is clicked
    const mobileLinks = document.querySelectorAll(".mobile-dropdown-content a");
    mobileLinks.forEach((link) => {
        link.addEventListener("click", function () {
            const dropdownContent = this.closest(".mobile-dropdown-content");
            if (
                dropdownContent &&
                !dropdownContent.classList.contains("hidden")
            ) {
                dropdownContent.classList.add("hidden");
                const toggle = dropdownContent.previousElementSibling;
                const icon = toggle.querySelector(".fa-chevron-up");
                if (icon) {
                    icon.classList.replace("fa-chevron-up", "fa-chevron-down");
                }
            }
        });
    });

    // Handle escape key to close menus
    document.addEventListener("keydown", function (event) {
        if (event.key === "Escape") {
            // Close mobile menu
            if (mobileMenu && !mobileMenu.classList.contains("hidden")) {
                mobileMenu.classList.add("hidden");
                const icon = mobileMenuButton.querySelector("i");
                if (icon.classList.contains("fa-times")) {
                    icon.classList.replace("fa-times", "fa-bars");
                }
            }

            // Close mobile dropdowns
            const openDropdowns = document.querySelectorAll(
                ".mobile-dropdown-content:not(.hidden)"
            );
            openDropdowns.forEach((dropdown) => {
                dropdown.classList.add("hidden");
                const toggle = dropdown.previousElementSibling;
                const icon = toggle.querySelector(".fa-chevron-up");
                if (icon) {
                    icon.classList.replace("fa-chevron-up", "fa-chevron-down");
                }
            });
        }
    });
});

// slider
document.addEventListener("DOMContentLoaded", () => {
    const track = document.getElementById("simple-slider-track");
    if (!track) return;

    const slides = Array.from(track.children);
    const total = slides.length;
    if (total <= 1) return;

    let index = 0;
    let timer = null;

    const prevBtn = document.getElementById("simple-prev");
    const nextBtn = document.getElementById("simple-next");

    function go(i) {
        index = (i + total) % total;
        track.style.transform = `translateX(-${index * 100}%)`;
    }

    function startAuto() {
        stopAuto();
        timer = setInterval(() => go(index + 1), 5000);
    }

    function stopAuto() {
        if (timer) clearInterval(timer);
    }

    prevBtn?.addEventListener("click", () => {
        stopAuto();
        go(index - 1);
        startAuto();
    });

    nextBtn?.addEventListener("click", () => {
        stopAuto();
        go(index + 1);
        startAuto();
    });

    [track, prevBtn, nextBtn].forEach((el) => {
        el?.addEventListener("mouseenter", stopAuto);
        el?.addEventListener("mouseleave", startAuto);
    });

    go(0);
    startAuto();
});
