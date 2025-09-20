<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name') }}</title>

    <!-- Bootstrap CSS 5.3.3 (không có integrity để tránh lỗi) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')

</head>

<body>
    <div class="admin-wrapper d-flex">
        <!-- Sidebar -->
        <nav class="admin-sidebar bg-dark text-white vh-100 p-3" style="width: 250px;">
            <div class="sidebar-header mb-4">
                <h3 class="text-white">Admin Panel</h3>
            </div>
            <ul class="sidebar-menu list-unstyled">
                @foreach ($adminMenu as $item)
                    <li
                        class="{{ (isset($item['route']) && request()->routeIs($item['route'])) ||(isset($item['children']) &&collect($item['children'])->contains(function ($child) {return isset($child['route']) && request()->routeIs($child['route']);}))? 'active bg-primary': '' }} rounded mb-2">
                        @if (isset($item['children']) && count($item['children']) > 0)
                            <a href="#"
                                class="d-flex align-items-center text-white text-decoration-none px-3 py-2"
                                data-bs-toggle="collapse" data-bs-target="#submenu-{{ $loop->index }}"
                                aria-expanded="false">
                                <i class="{{ $item['icon'] }} me-2"></i>
                                <span>{{ gtranslate($item['label']) }}</span>
                                <i class="fas fa-chevron-down ms-auto"></i>
                            </a>
                            <ul class="collapse list-unstyled ms-3" id="submenu-{{ $loop->index }}">
                                @foreach ($item['children'] as $child)
                                    <li
                                        class="{{ isset($child['route']) && request()->routeIs($child['route']) ? 'active bg-primary' : '' }} rounded mb-1">
                                        <a href="{{ $child['link'] }}"
                                            class="d-flex align-items-center text-white text-decoration-none px-3 py-2">
                                            <i class="{{ $child['icon'] }} me-2"></i>
                                            <span>{{ gtranslate($child['label']) }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <a href="{{ $item['link'] }}"
                                class="d-flex align-items-center text-white text-decoration-none px-3 py-2">
                                <i class="{{ $item['icon'] }} me-2"></i>
                                <span>{{ $item['label'] }}</span>
                            </a>
                        @endif
                    </li>
                @endforeach

                <li class="{{ request()->routeIs('admin.menus.*') ? 'active bg-primary' : '' }} rounded mb-2">
                    <a href="{{ route('admin.menus.index') }}"
                        class="d-flex align-items-center text-white text-decoration-none px-3 py-2">
                        <i class="fas fa-bars me-2"></i>
                        <span>Quản lý Menu</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="admin-main flex-grow-1">
            <!-- Top Bar -->
            <header class="admin-header d-flex justify-content-between align-items-center p-3 border-bottom bg-light">
                <div class="header-left">
                    <button class="btn btn-outline-secondary sidebar-toggle" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="header-right d-flex align-items-center">
                    <div class="user-menu dropdown">
                        <span class="me-2">Xin chào, {{ auth()->user()->name ?? 'Admin' }}</span>
                        <button class="btn btn-link dropdown-toggle p-0" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                                    <i class="fas fa-user-edit"></i> Hồ sơ
                                </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt"></i> Đăng xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                    <div class="dropdown m-3">
                        <button class="btn btn-link dropdown-toggle p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-globe"></i>{{ session('locale') }} / {{ app()->getLocale() }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ url('lang/vi') }}">
                                    🇻🇳 Tiếng Việt
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('lang/en') }}">
                                    en English
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>



            </header>

            <!-- Page Content -->
            <main class="admin-content p-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- jQuery (load trước Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS 5.3.3 (chỉ load 1 lần, cuối body, không có integrity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // CSRF Token cho AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function toggleSidebar() {
            const sidebar = document.querySelector('.admin-sidebar');
            const adminMain = document.querySelector('.admin-main');

            sidebar.classList.toggle('d-none');
            adminMain.classList.toggle('full-width');
        }

        // Active menu highlight
        document.addEventListener('DOMContentLoaded', function() {
            // Highlight active menu item
            const currentPath = window.location.pathname;
            const menuLinks = document.querySelectorAll('.sidebar-menu a[href]');

            menuLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath ||
                    (currentPath.startsWith(link.getAttribute('href')) && link.getAttribute('href') !== '/')
                    ) {
                    link.closest('li').classList.add('active', 'bg-primary');
                    link.closest('.collapse')?.classList.add('show');
                    link.closest('a[data-bs-toggle="collapse"]')?.setAttribute('aria-expanded', 'true');
                }
            });

            // Auto-close alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });

        // Responsive sidebar toggle
        window.addEventListener('resize', function() {
            const sidebar = document.querySelector('.admin-sidebar');
            const adminMain = document.querySelector('.admin-main');

            if (window.innerWidth > 768) {
                sidebar.classList.remove('d-none');
                adminMain.classList.remove('full-width');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
