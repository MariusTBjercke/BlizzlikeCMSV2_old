const topLogo = document.querySelector('.top-logo');

// Go to home page on logo click.
topLogo.addEventListener('click', () => {
    document.location.href = "index.php";
});

// Navigation hover effect
const navItems = document.querySelectorAll(".navigation .navigation__item");
navItems.forEach((item) => {
    let activeItem = document.querySelector(".navigation .navigation__item_active");
    if (activeItem) {
        item.addEventListener('mouseover', () => {
            if (!item.classList.contains("navigation__item_active")) {
                activeItem.style.backgroundColor = "transparent";
            }
        });
        item.addEventListener('mouseleave', () => {
            activeItem.style.backgroundColor = item.style.backgroundColor;
        });
    }
});