<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jasamarga - @yield('title', 'Dashboard')</title>
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #00a4f4;
            --dark-blue: #0069ab;
            --text-dark: #3d3d3d;
            --text-light: #6d6d6d;
            --text-gray: #888888;
            --bg-light-blue: #f2faff;
            --white: #ffffff;
            --border-color: #e7e7e7;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 80px;
        }

        body {
            font-family: 'Manrope', sans-serif;
            background-color: #f8f9fa;
            color: var(--text-dark);
            overflow-x: hidden;
        }

        .main-container {
            display: flex;
            min-height: 100vh;
        }

        .content-wrapper {
            flex: 1;
            overflow-x: hidden;
            transition: margin-left 0.3s;
            margin-left: var(--sidebar-width);
        }

        .main-content {
            padding: 20px;
            transition: all 0.3s;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: none;
        }

        .card-header {
            background-color: var(--white);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 700;
        }

        .stat-card {
            background-color: var(--white);
            border-radius: 12px;
            padding: 20px;
            height: 100%;
            border-left: 4px solid var(--primary-blue);
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--dark-blue);
        }

        .stat-label {
            font-size: 14px;
            color: var(--text-gray);
            font-weight: 600;
        }

        .chart-container {
            background-color: var(--white);
            border-radius: 12px;
            padding: 20px;
            height: 100%;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background-color: var(--white);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: all 0.3s;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid var(--border-color);
            text-align: center;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-logo {
            width: 180px;
            transition: all 0.3s;
        }

        .sidebar-menu {
            padding: 15px 0;
        }

        .nav-link {
            color: var(--text-light);
            padding: 12px 20px;
            margin: 4px 0;
            border-radius: 8px;
            transition: all 0.2s;
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary-blue);
            background-color: var(--bg-light-blue);
        }

        .nav-link.active {
            color: var(--primary-blue);
            background-color: var(--bg-light-blue);
            font-weight: 600;
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background-color: var(--primary-blue);
            border-radius: 0 4px 4px 0;
        }

        /* Header Styles */
        .navbar-top {
            background-color: var(--white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            height: 70px;
            padding: 0 20px;
        }

        .user-profile {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .sidebar-toggle {
            border: none;
            background: none;
            font-size: 1.25rem;
            color: var(--text-dark);
        }

        /* Mobile Styles */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1050;
            }

            .sidebar-mobile-show {
                transform: translateX(0);
            }

            .content-wrapper {
                margin-left: 0 !important;
            }

            .sidebar-collapsed .sidebar {
                width: var(--sidebar-collapsed-width);
                transform: translateX(0);
            }

            .user-name {
                display: none;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="main-container">
        @include('partials.sidebar')

        <div class="content-wrapper">
            @include('partials.header')

            <main class="main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            const sidebar = document.querySelector('.sidebar');
            const body = document.body;

            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    if (window.innerWidth <= 992) {
                        sidebar.classList.toggle('sidebar-mobile-show');
                    } else {
                        body.classList.toggle('sidebar-collapsed');
                    }
                });
            }

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth <= 992 && !sidebar.contains(e.target) &&
                    !e.target.classList.contains('sidebar-toggle') &&
                    !e.target.closest('.sidebar-toggle')) {
                    sidebar.classList.remove('sidebar-mobile-show');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Aktifkan parent menu jika submenu aktif
            const activeSubmenu = document.querySelector('.sidebar-menu .nav-link.active');
            if (activeSubmenu && activeSubmenu.closest('.collapse')) {
                const parentMenu = activeSubmenu.closest('.collapse').previousElementSibling;
                parentMenu.classList.add('active');
                const collapseElement = bootstrap.Collapse.getInstance(activeSubmenu.closest('.collapse'));
                if (collapseElement) {
                    collapseElement.show();
                }
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
