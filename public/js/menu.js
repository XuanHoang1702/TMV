/**
 * Menu JavaScript functionality
 * Handles desktop hover and mobile click dropdowns
 */
document.addEventListener('DOMContentLoaded', function() {
    // Cache DOM elements
    const mainMenu = document.querySelector('.main-menu');
    const serviceToggle = document.querySelector('.toggle-only');
    const newsLink = document.querySelector('.navigate-link');
    const newsMenu = document.querySelector('.news-menu');
    const languageToggle = document.querySelector('.ul-lang li.li-group > a');
    const searchToggle = document.querySelector('.input-icon .fa-search');
    const miniMenuToggle = document.querySelector('.btn-miniMenu');

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

    // ===== CATEGORY LINKS =====
    function initCategoryLinks() {
        const categoryLinks = document.querySelectorAll('.category-link');
        categoryLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Close all menus before navigation
                document.querySelectorAll('.main-menu li.li-group').forEach(li => {
                    li.classList.remove('open');
                });

                // Hide mobile menu if open
                const mobileMenu = document.querySelector('.main-menu.mini-show');
                if (mobileMenu) {
                    mobileMenu.classList.remove('mini-show');
                }

                console.log('Navigating to category:', this.href);
            });
        });
    }

    // ===== LANGUAGE MENU =====
    function initLanguageMenu() {
        if (!languageToggle) return;

        languageToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const parentLi = this.parentElement;
            const isOpen = parentLi.classList.contains('open');

            // Close other menus
            document.querySelectorAll('.ul-lang li.li-group').forEach(li => {
                li.classList.remove('open');
            });

            // Toggle current menu
            parentLi.classList.toggle('open', !isOpen);
            this.setAttribute('aria-expanded', !isOpen);
        });

        // Close language menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.ul-lang')) {
                document.querySelectorAll('.ul-lang li.li-group').forEach(li => {
                    li.classList.remove('open');
                });
            }
        });
    }

    // ===== SEARCH FUNCTIONALITY =====
    function initSearch() {
        if (!searchToggle) return;

        searchToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            const inputContainer = this.closest('.head-input-g');
            const input = inputContainer.querySelector('input');

            if (inputContainer.classList.contains('active')) {
                inputContainer.classList.remove('active');
                input.blur();
            } else {
                inputContainer.classList.add('active');
                input.focus();
            }
        });

        // Close search on escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const activeSearch = document.querySelector('.head-input-g.active');
                if (activeSearch) {
                    activeSearch.classList.remove('active');
                }
            }
        });

        // Close search when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.input-icon')) {
                const activeSearch = document.querySelector('.head-input-g.active');
                if (activeSearch) {
                    activeSearch.classList.remove('active');
                }
            }
        });
    }

    // ===== MOBILE MENU TOGGLE =====
    function initMobileMenu() {
        if (!miniMenuToggle) return;

        miniMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            const mobileMenu = document.querySelector('.d-Mobile .main-menu');

            if (mobileMenu) {
                mobileMenu.classList.toggle('mini-show');
                this.classList.toggle('active');

                // Add overlay
                if (mobileMenu.classList.contains('mini-show')) {
                    createMobileOverlay();
                } else {
                    removeMobileOverlay();
                }
            }
        });
    }

    // ===== OVERLAY FOR MOBILE MENU =====
    function createMobileOverlay() {
        const overlay = document.createElement('div');
        overlay.className = 'mobile-menu-overlay';
        overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 998;
        `;
        overlay.addEventListener('click', closeMobileMenu);
        document.body.appendChild(overlay);
    }

    function removeMobileOverlay() {
        const overlay = document.querySelector('.mobile-menu-overlay');
        if (overlay) {
            overlay.remove();
        }
    }

    function closeMobileMenu() {
        const mobileMenu = document.querySelector('.d-Mobile .main-menu');
        const miniToggle = document.querySelector('.btn-miniMenu');

        if (mobileMenu) {
            mobileMenu.classList.remove('mini-show');
        }
        if (miniToggle) {
            miniToggle.classList.remove('active');
        }
        removeMobileOverlay();
    }

    // ===== GLOBAL EVENT HANDLERS =====
    function initGlobalHandlers() {
        // Close all menus when clicking outside
        document.addEventListener('click', function(e) {
            const isClickInsideMenu = e.target.closest('.main-menu') || e.target.closest('.ul-lang');

            if (!isClickInsideMenu) {
                // Close main menus
                document.querySelectorAll('.main-menu li.li-group').forEach(li => {
                    li.classList.remove('open');
                });

                // Close language menu
                document.querySelectorAll('.ul-lang li.li-group').forEach(li => {
                    li.classList.remove('open');
                });

                // Close search
                const activeSearch = document.querySelector('.head-input-g.active');
                if (activeSearch) {
                    activeSearch.classList.remove('active');
                }
            }
        });

        // Close menus on resize to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                // Close mobile menu
                const mobileMenu = document.querySelector('.d-Mobile .main-menu');
                if (mobileMenu && mobileMenu.classList.contains('mini-show')) {
                    mobileMenu.classList.remove('mini-show');
                }

                // Close click-based menus
                document.querySelectorAll('.main-menu li.li-group').forEach(li => {
                    li.classList.remove('open');
                });

                // Remove overlay
                removeMobileOverlay();
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            // ESC to close all menus
            if (e.key === 'Escape') {
                closeAllMenus();
            }

            // Tab navigation for accessibility
            if (e.key === 'Tab') {
                // Close menus when tabbing out
                setTimeout(() => {
                    const focusedElement = document.activeElement;
                    const isMenuElement = focusedElement.closest('.main-menu, .ul-lang');
                    if (!isMenuElement) {
                        closeAllMenus();
                    }
                }, 10);
            }
        });

        // Prevent body scroll when mobile menu is open
        document.addEventListener('touchmove', function(e) {
            const mobileMenu = document.querySelector('.main-menu.mini-show');
            if (mobileMenu && !e.target.closest('.main-menu')) {
                e.preventDefault();
            }
        }, { passive: false });
    }

    // ===== UTILITY FUNCTIONS =====
    function closeAllMenus() {
        // Close main menus
        document.querySelectorAll('.main-menu li.li-group').forEach(li => {
            li.classList.remove('open');
        });

        // Close language menu
        document.querySelectorAll('.ul-lang li.li-group').forEach(li => {
            li.classList.remove('open');
        });

        // Close search
        const activeSearch = document.querySelector('.head-input-g.active');
        if (activeSearch) {
            activeSearch.classList.remove('active');
        }

        // Close mobile menu
        const mobileMenu = document.querySelector('.d-Mobile .main-menu');
        if (mobileMenu && mobileMenu.classList.contains('mini-show')) {
            mobileMenu.classList.remove('mini-show');
        }

        // Reset toggles
        document.querySelector('.btn-miniMenu')?.classList.remove('active');
        removeMobileOverlay();
    }

    // ===== ACTIVE PAGE HIGHLIGHTING =====
    function highlightActivePage() {
        // Add active class to current page
        const currentPath = window.location.pathname;
        document.querySelectorAll('.main-menu li a').forEach(link => {
            const href = link.getAttribute('href');
            if (href && currentPath.includes(href.split('/').pop())) {
                link.closest('li').classList.add('active');
            }
        });
    }

    // ===== SMOOTH SCROLLING =====
    function initSmoothScrolling() {
        const links = document.querySelectorAll('a[href^="#"]');
        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    e.preventDefault();
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    // ===== INITIALIZATION =====
    function init() {
        console.log('Initializing menu...');

        // Initialize all menu functionalities
        initServiceMenu();
        initNewsMenu();
        initSubmenuToggle();
        initCategoryLinks();
        initLanguageMenu();
        initSearch();
        initMobileMenu();
        initGlobalHandlers();
        highlightActivePage();
        initSmoothScrolling();

        // Set initial aria attributes
        document.querySelectorAll('.toggle-only, .navigate-link').forEach(link => {
            link.setAttribute('aria-haspopup', 'true');
            link.setAttribute('aria-expanded', 'false');
        });

        console.log('Menu initialized successfully');
    }

    // Start initialization
    init();

    // Reinitialize on dynamic content load (if needed)
    window.menuInit = init;
});
