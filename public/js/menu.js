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

    // ===== SERVICE MENU TOGGLE (Click only for mobile) + HOVER (desktop) =====
    function initServiceMenu() {
        const toggleItems = document.querySelectorAll('.toggle-only');
        toggleItems.forEach(item => {
            const parentLi = item.closest('li.li-group');
            const dropdown = parentLi.querySelector('.m-ul-sub');

            // Mobile: Click to toggle
            if (isMobile()) {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

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
            } else {
                // Desktop: Click does nothing (hover handles show), but close on click if open
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const isOpen = parentLi.classList.contains('open') ||
                                   (dropdown && window.getComputedStyle(dropdown).maxHeight !== '0px');

                    if (isOpen) {
                        // Close if open
                        parentLi.classList.remove('open');
                        if (dropdown) {
                            dropdown.style.maxHeight = '0';
                            dropdown.style.opacity = '0';
                            dropdown.style.visibility = 'hidden';
                            dropdown.style.transform = 'translateY(-10px)';
                        }
                        this.setAttribute('aria-expanded', 'false');
                        parentLi.setAttribute('aria-expanded', 'false');
                    }
                    // Else do nothing (hover will show)
                });
            }
        });

        // Desktop hover for services (only if not mobile)
        if (!isMobile()) {
            const serviceMenus = document.querySelectorAll('.main-menu li.li-group:not(.news-menu)');
            serviceMenus.forEach(serviceMenu => {
                const serviceLink = serviceMenu.querySelector('.toggle-only');
                const serviceDropdown = serviceMenu.querySelector('.m-ul-sub');
                let hoverTimeout;

                if (serviceDropdown) {
                    serviceMenu.addEventListener('mouseenter', function() {
                        clearTimeout(hoverTimeout);
                        serviceDropdown.style.maxHeight = '1000px'; // Or '400px' to match news
                        serviceDropdown.style.opacity = '1';
                        serviceDropdown.style.visibility = 'visible';
                        serviceDropdown.style.transform = 'translateY(0)';
                        if (serviceLink) serviceLink.setAttribute('aria-expanded', 'true');
                        serviceMenu.setAttribute('aria-expanded', 'true');
                    });

                    serviceMenu.addEventListener('mouseleave', function() {
                        hoverTimeout = setTimeout(() => {
                            serviceDropdown.style.maxHeight = '0';
                            serviceDropdown.style.opacity = '0';
                            serviceDropdown.style.visibility = 'hidden';
                            serviceDropdown.style.transform = 'translateY(-10px)';
                            if (serviceLink) serviceLink.setAttribute('aria-expanded', 'false');
                            serviceMenu.setAttribute('aria-expanded', 'false');
                        }, 150);
                    });

                    // Submenu hover (for nested services)
                    const subDropdowns = serviceDropdown.querySelectorAll('.m-ul-sub-child');
                    subDropdowns.forEach(sub => {
                        const subParent = sub.closest('li');
                        subParent.addEventListener('mouseenter', function() {
                            clearTimeout(hoverTimeout);
                            sub.style.maxHeight = '500px';
                            sub.style.opacity = '1';
                            sub.style.visibility = 'visible';
                        });

                        subParent.addEventListener('mouseleave', function() {
                            hoverTimeout = setTimeout(() => {
                                sub.style.maxHeight = '0';
                                sub.style.opacity = '0';
                                sub.style.visibility = 'hidden';
                            }, 150);
                        });
                    });
                }
            });
        }
    }

    // ===== NEWS MENU HANDLING =====
    function initNewsMenu() {
        if (!newsLink || !newsMenu) return;

        // Mobile: Separate click handlers for text (navigate) and arrow (toggle)
        if (isMobile()) {
            // Click on arrow to toggle dropdown
            const newsArrow = newsLink.querySelector('i.fa-angle-down');
            if (newsArrow) {
                newsArrow.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation(); // Prevent bubbling to <a>

                    const parentLi = newsMenu;
                    const isOpen = parentLi.classList.contains('open');

                    // Close other menus
                    document.querySelectorAll('.main-menu li.li-group').forEach(li => {
                        if (li !== parentLi) {
                            li.classList.remove('open');
                        }
                    });

                    // Toggle current
                    if (isOpen) {
                        parentLi.classList.remove('open');
                        newsLink.setAttribute('aria-expanded', 'false');
                        parentLi.setAttribute('aria-expanded', 'false');
                        console.log('Mobile: Closed news dropdown');
                    } else {
                        parentLi.classList.add('open');
                        newsLink.setAttribute('aria-expanded', 'true');
                        parentLi.setAttribute('aria-expanded', 'true');
                        console.log('Mobile: Opened news dropdown via arrow');
                    }
                });
            }

            // Click on sub-items: Navigate and close dropdown
            const newsSubItems = newsMenu.querySelectorAll('.news-dropdown .category-link');
            newsSubItems.forEach(link => {
                link.addEventListener('click', function(e) {
                    const parentLi = this.closest('li.news-menu');
                    parentLi.classList.remove('open');
                    console.log('Mobile: Navigated to news category, closed dropdown');
                    // Allow navigation (default behavior)
                });
            });

            // Parent link click: Always navigate (text area), close any open dropdown
            newsLink.addEventListener('click', function(e) {
                // Only if not clicking the arrow (handled separately)
                if (e.target !== newsArrow) {
                    const parentLi = newsMenu;
                    parentLi.classList.remove('open');
                    console.log('Mobile navigation to news via text click:', this.href);
                    // Allow default navigation
                    return true;
                }
            });
        } else {
            // Desktop: Hover to show dropdown, click to navigate
            newsLink.addEventListener('click', function(e) {
                // Close all menus before navigation
                document.querySelectorAll('.main-menu li.li-group').forEach(li => {
                    li.classList.remove('open');
                });

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
            });

            // Enhanced hover handling for desktop
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
