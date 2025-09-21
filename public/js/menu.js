document.addEventListener('DOMContentLoaded', function() {
    // Cache DOM elements
    const mainMenu = document.querySelector('.main-menu');
    const serviceToggle = document.querySelector('.toggle-only');
    const newsLink = document.querySelector('.navigate-link');
    const newsMenu = document.querySelector('.news-menu');

    // Check if elements exist
    if (!mainMenu) return;

    // ===== DESKTOP/MOBILE DETECTION =====
    function isMobile() {
        return window.innerWidth <= 768;
    }

    // ===== SERVICE MENU TOGGLE (Click only) =====
    function initServiceMenu() {
        const toggleItems = document.querySelectorAll('.toggle-only');
        toggleItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const parentLi = this.closest('li.li-group');
                const isOpen = parentLi.classList.contains('open');

                // Close all other menus
                document.querySelectorAll('.main-menu li.li-group').forEach(li => {
                    if (li !== parentLi) {
                        li.classList.remove('open');
                    }
                });

                // Toggle current menu
                if (isOpen) {
                    parentLi.classList.remove('open');
                } else {
                    parentLi.classList.add('open');
                }

                // Update aria attributes
                this.setAttribute('aria-expanded', !isOpen);
                parentLi.setAttribute('aria-expanded', !isOpen);
            });
        });
    }

    // ===== NEWS MENU HANDLING =====
    function initNewsMenu() {
        if (!newsLink || !newsMenu) return;

        // Desktop: Hover to show dropdown, click to navigate
        newsLink.addEventListener('click', function(e) {
            const mobile = isMobile();

            // Close all menus before navigation
            document.querySelectorAll('.main-menu li.li-group').forEach(li => {
                li.classList.remove('open');
            });

            if (mobile) {
                // Mobile: Just navigate, no dropdown
                console.log('Mobile navigation to:', this.href);
                // Allow default link behavior
                return true;
            } else {
                // Desktop: If dropdown is open, navigate; else just close
                const parentLi = this.closest('li.news-menu');
                const isDropdownOpen = parentLi.classList.contains('open') ||
                                     window.getComputedStyle(document.querySelector('.news-menu > .m-ul-sub')).maxHeight !== '0px';

                if (isDropdownOpen) {
                    console.log('Desktop navigation to:', this.href);
                    // Allow default link behavior
                    return true;
                } else {
                    e.preventDefault();
                    // Don't navigate, just close any open menus
                    return false;
                }
            }
        });

        // Enhanced hover handling for desktop
        if (!isMobile()) {
            let hoverTimeout;

            newsMenu.addEventListener('mouseenter', function() {
                clearTimeout(hoverTimeout);
                const dropdown = this.querySelector('.m-ul-sub');
                if (dropdown) {
                    dropdown.style.maxHeight = '400px';
                    dropdown.style.opacity = '1';
                    dropdown.style.visibility = 'visible';
                    dropdown.style.transform = 'translateY(0)';
                }
            });

            newsMenu.addEventListener('mouseleave', function() {
                const dropdown = this.querySelector('.m-ul-sub');
                hoverTimeout = setTimeout(() => {
                    if (dropdown) {
                        dropdown.style.maxHeight = '0';
                        dropdown.style.opacity = '0';
                        dropdown.style.visibility = 'hidden';
                        dropdown.style.transform = 'translateY(-10px)';
                    }
                }, 150); // Small delay to allow moving to submenu
            });

            // Handle submenu hover
            const newsDropdown = newsMenu.querySelector('.m-ul-sub');
            if (newsDropdown) {
                newsDropdown.addEventListener('mouseenter', function() {
                    clearTimeout(hoverTimeout);
                    this.style.maxHeight = '400px';
                    this.style.opacity = '1';
                    this.style.visibility = 'visible';
                    this.style.transform = 'translateY(0)';
                });

                newsDropdown.addEventListener('mouseleave', function() {
                    hoverTimeout = setTimeout(() => {
                        this.style.maxHeight = '0';
                        this.style.opacity = '0';
                        this.style.visibility = 'hidden';
                        this.style.transform = 'translateY(-10px)';
                    }, 150);
                });
            }
        }
    }

    // ===== SUBMENU TOGGLE (Services children - Mobile only) =====
    function initSubmenuToggle() {
        const submenuItems = document.querySelectorAll('.m-ul-sub li:has(.m-ul-sub-child) > a');
        submenuItems.forEach(item => {
            item.addEventListener('click', function(e) {
                // Only handle on mobile
                if (isMobile()) {
                    e.preventDefault();
                    e.stopPropagation();

                    const parentLi = this.parentElement;
                    const isOpen = parentLi.classList.contains('open');

                    // Close other submenus in same level
                    parentLi.closest('.m-ul-sub').querySelectorAll('li').forEach(li => {
                        if (li !== parentLi) {
                            li.classList.remove('open');
                        }
                    });

                    // Toggle current submenu
                    parentLi.classList.toggle('open', !isOpen);
                    this.setAttribute('aria-expanded', !isOpen);
                }
            });
        });
    }

    // ===== INITIALIZATION =====
    function init() {
        console.log('Initializing dropdown menus...');
        initServiceMenu();
        initNewsMenu();
        initSubmenuToggle();
        console.log('Dropdown menus initialized successfully');
    }

    // Start initialization
    init();
});
