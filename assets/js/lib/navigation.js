up.compiler('nav', (element) => {
    const topLogo = element.querySelector('.top-logo');

    // Go to home page on logo click.
    topLogo.addEventListener('click', () => {
        const href = window.location.href;
        window.location.href = href.substring(0, href.lastIndexOf('/'));
    });

    /**
     * Removes active styling when hovering over menu items.
     * @param items Array of menu items to remove active styling from.
     * @param activeItem The currently active menu item.
     */
    function removeActiveEffect(items, activeItem) {
        let oldBackgroundColor = activeItem.style.backgroundColor;
        let oldColor = activeItem.style.color;
        items.forEach((item) => {
            if (activeItem) {
                item.addEventListener('mouseover', () => {
                    let found = false;
                    item.classList.forEach((className) => {
                        let split = className.split("_");
                        if (split.includes("active")) {
                            found = true;
                        }
                    });
                    if (!found) {
                        activeItem.style.backgroundColor = "unset";
                        activeItem.style.color = "unset";
                    }
                });
                item.addEventListener('mouseleave', () => {
                    activeItem.style.backgroundColor = oldBackgroundColor;
                    activeItem.style.color = oldColor;
                });
            }
        });
    }

    const navItems = element.querySelectorAll(".navigation__item");
    const activeItem = element.querySelector(".navigation__item_active");
    removeActiveEffect(navItems, activeItem);

    let mobileNavItems = element.querySelectorAll(".collapsed-navigation__item");
    const mobileActiveItem = element.querySelector(".collapsed-navigation__item_active");
    removeActiveEffect(mobileNavItems, mobileActiveItem);

    // Mobile navigation dropdown
    const burgerBtn = element.querySelector(".navigation-wrapper__bars");
    const closeBtn = element.querySelector(".collapsed-navigation__close");
    const navigation = element.querySelector(".collapsed-navigation");
    const buttons = [burgerBtn, closeBtn];

    // Get session storage value and toggle if true
    const navSessionStorage = sessionStorage.getItem('navigation');
    if (navSessionStorage === 'true') {
        navigation.classList.toggle("collapsed-navigation_open");
    }

    /**
     * Open/close navigation menu.
     */
    function toggleNavigation() {
        navigation.classList.toggle("collapsed-navigation_open");
        sessionStorage.setItem('navigation', navigation.classList.contains("collapsed-navigation_open").toString());
    }

    buttons.forEach(btn => btn.addEventListener('click', toggleNavigation));
});