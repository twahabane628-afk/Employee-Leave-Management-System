<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'ELMS | Employee Leave Management System')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet"
        href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

    @stack('styles')
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f4f6f9;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        /* SIDEBAR */
        .elms-sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #172b4d;
            color: #fff;
            z-index: 1050;
            overflow-y: auto;
            transition: margin-left 0.3s ease, transform 0.3s ease;
        }

        .sidebar-brand {
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 22px;
            font-size: 20px;
            font-weight: bold;
            color: #fff;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand i {
            margin-right: 10px;
            color: #38bdf8;
        }

        .sidebar-menu {
            padding: 18px 12px;
        }

        .sidebar-heading {
            color: #9aabc4;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 15px 12px 8px;
            letter-spacing: 1px;
        }

        .sidebar-link,
        .sidebar-toggle {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 12px 13px;
            margin-bottom: 5px;
            color: #d6deeb;
            text-decoration: none;
            border: none;
            border-radius: 6px;
            background: transparent;
            font-size: 14px;
            text-align: left;
            transition: 0.2s;
        }

        .sidebar-link:hover,
        .sidebar-toggle:hover,
        .sidebar-link.active {
            color: #fff;
            background: #29466f;
        }

        .sidebar-link i:first-child,
        .sidebar-toggle i:first-child {
            width: 25px;
            font-size: 17px;
        }

        .sidebar-arrow {
            margin-left: auto;
            font-size: 12px;
        }

        .sidebar-submenu {
            padding-left: 28px;
            margin: 2px 0 8px;
        }

        .sidebar-submenu a {
            display: block;
            padding: 10px 12px;
            margin-bottom: 3px;
            color: #bdc9dc;
            text-decoration: none;
            font-size: 13px;
            border-radius: 5px;
        }

        .sidebar-submenu a:hover,
        .sidebar-submenu a.active {
            color: #fff;
            background: #29466f;
        }

        /* MAIN AREA */
        .main-wrapper {
            margin-left: 260px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }

        /* TOP NAVBAR */
        .top-navbar {
            height: 70px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .sidebar-toggler {
            border: none;
            background: transparent;
            font-size: 25px;
            color: #172b4d;
            cursor: pointer;
            padding: 5px;
        }

        .page-heading {
            font-size: 19px;
            font-weight: 600;
            color: #26364a;
            margin: 0;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #526174;
        }

        /* MODULE TABS */
        .module-tabs-wrapper {
            background: #fff;
            border-top: 1px solid #edf0f4;
            padding: 0 25px;
        }

        .module-tabs {
            display: flex;
            align-items: center;
            gap: 25px;
            min-height: 48px;
            overflow-x: auto;
        }

        .module-tabs a {
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
            padding: 15px 3px;
            white-space: nowrap;
            border-bottom: 2px solid transparent;
        }

        .module-tabs a:hover,
        .module-tabs a.active {
            color: #2563eb;
            border-bottom-color: #2563eb;
        }

        /* PAGE CONTENT */
        .page-content {
            padding: 25px;
        }

        /* DESKTOP SIDEBAR COLLAPSE */
        body.sidebar-collapsed .elms-sidebar {
            margin-left: -260px;
        }

        body.sidebar-collapsed .main-wrapper {
            margin-left: 0;
        }

        /* MOBILE BACKDROP */
        .sidebar-backdrop {
            display: none;
        }

        @media (max-width: 991px) {
            .elms-sidebar {
                margin-left: 0;
                transform: translateX(-100%);
            }

            .elms-sidebar.show {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            body.sidebar-collapsed .elms-sidebar {
                margin-left: 0;
            }

            body.sidebar-collapsed .main-wrapper {
                margin-left: 0;
            }

            .sidebar-backdrop.show {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.45);
                z-index: 1040;
            }

            .top-navbar {
                padding: 0 15px;
            }

            .page-content {
                padding: 15px;
            }
        }

        /* FOOTER */
        .elms-footer {
            min-height: 60px;
            padding: 18px 25px;
            background: #ffffff;
            border-top: 1px solid #e9edf2;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            color: #7b8794;
            font-size: 12px;
        }

        .elms-footer strong {
            color: #334155;
        }

        .footer-right {
            color: #94a3b8;
        }

        @media (max-width: 600px) {
            .elms-footer {
                justify-content: center;
                text-align: center;
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="elms-sidebar" id="elmsSidebar">

        <div class="sidebar-brand">
            <i class="bi bi-buildings"></i>
            ELMS
        </div>

        <div class="sidebar-menu">

            <div class="sidebar-heading">Main Menu</div>

            <!-- DASHBOARD -->
            <a href="{{ route('conference.dashboard') }}"
                class="sidebar-link {{ request()->routeIs('conference.dashboard') ? 'active' : '' }}">

                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>

            <div class="sidebar-heading">Management</div>

            <!-- EMPLOYEE MANAGEMENT -->
            <button class="sidebar-toggle" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#employeeSubmenu"
                aria-expanded="{{ request()->routeIs('conference.employees.*') ? 'true' : 'false' }}">

                <i class="bi bi-people"></i>
                Employee Management
                <i class="bi bi-chevron-down sidebar-arrow"></i>
            </button>

            <div class="collapse {{ request()->routeIs('conference.employees.*') ? 'show' : '' }}"
                id="employeeSubmenu">

                <div class="sidebar-submenu">

                    <a href="{{ route('conference.employees.index') }}"
                        class="{{ request()->routeIs('conference.employees.index') ? 'active' : '' }}">
                        <i class="bi bi-list-ul me-2"></i>
                        All Employees
                    </a>

                    <a href="{{ route('conference.employees.index', ['openAddEmployee' => 1]) }}"
                        class="{{ request()->routeIs('conference.employees.create') ? 'active' : '' }}">
                        <i class="bi bi-person-plus me-2"></i>
                        Add Employee
                    </a>

                </div>
            </div>

            <!-- LEAVE MANAGEMENT -->
            <button class="sidebar-toggle" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#leaveSubmenu">

                <i class="bi bi-calendar-check"></i>
                Leave Management
                <i class="bi bi-chevron-down sidebar-arrow"></i>
            </button>

            <div class="collapse" id="leaveSubmenu">

                <div class="sidebar-submenu">

                    <a href="#">
                        <i class="bi bi-list-ul me-2"></i>
                        All Applications
                    </a>

                    <a href="#">
                        <i class="bi bi-plus-circle me-2"></i>
                        Apply for Leave
                    </a>

                    <a href="#">
                        <i class="bi bi-tags me-2"></i>
                        Leave Types
                    </a>

                </div>
            </div>

            <!-- LEAVE APPROVALS -->
            <button class="sidebar-toggle" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#approvalSubmenu">

                <i class="bi bi-clipboard-check"></i>
                Leave Approvals
                <i class="bi bi-chevron-down sidebar-arrow"></i>
            </button>

            <div class="collapse" id="approvalSubmenu">

                <div class="sidebar-submenu">

                    <a href="#">
                        <i class="bi bi-hourglass-split me-2"></i>
                        Pending Approvals
                    </a>

                    <a href="#">
                        <i class="bi bi-check-circle me-2"></i>
                        Approval History
                    </a>

                </div>
            </div>

            <!-- LEAVE REPORTS -->
            <button class="sidebar-toggle" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#reportsSubmenu">

                <i class="bi bi-bar-chart"></i>
                Leave Reports
                <i class="bi bi-chevron-down sidebar-arrow"></i>
            </button>

            <div class="collapse" id="reportsSubmenu">

                <div class="sidebar-submenu">

                    <a href="#">
                        <i class="bi bi-file-earmark-bar-graph me-2"></i>
                        Leave Summary
                    </a>

                </div>
            </div>

            <div class="sidebar-heading">System</div>

            <!-- SETTINGS -->
            <a href="#" class="sidebar-link">
                <i class="bi bi-gear"></i>
                System Settings
            </a>

        </div>
    </aside>

    <!-- MOBILE BACKDROP -->
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- MAIN WRAPPER -->
    <div class="main-wrapper">

        <!-- TOP NAVBAR -->
        <nav class="top-navbar">

            <div class="navbar-left">

                <!-- HAMBURGER BUTTON -->
                <button class="sidebar-toggler" id="sidebarToggle"
                    type="button" aria-label="Toggle sidebar">

                    <i class="bi bi-list"></i>

                </button>

                <h5 class="page-heading">
                    @yield('page-title', 'Dashboard')
                </h5>

            </div>

            <div class="navbar-right">

                <span class="d-none d-sm-inline">
                    Employee Leave Management System
                </span>

                <i class="bi bi-person-circle fs-4"></i>

            </div>

        </nav>

        <!-- MODULE TABS -->
        @hasSection('module-tabs')
        <div class="module-tabs-wrapper">
            <div class="module-tabs">
                @yield('module-tabs')
            </div>
        </div>
        @endif

        <!-- PAGE CONTENT -->
        <main class="page-content">

            @yield('content')

        </main>

        <!-- FOOTER -->
        <footer class="elms-footer">
            <div class="footer-left">
                &copy; {{ date('Y') }}
                <strong>Employee Leave Management System</strong>.
                All Rights Reserved.
            </div>

            <div class="footer-right">
                Designed for efficient employee leave management
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Bootstrap 5 Integration -->
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.17/dist/sweetalert2.all.min.js"></script>

    <!-- SIDEBAR TOGGLE SCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const sidebar = document.getElementById('elmsSidebar');
            const toggleButton = document.getElementById('sidebarToggle');
            const backdrop = document.getElementById('sidebarBackdrop');

            function isMobile() {
                return window.innerWidth <= 991;
            }

            toggleButton.addEventListener('click', function() {

                if (isMobile()) {

                    sidebar.classList.toggle('show');
                    backdrop.classList.toggle('show');

                } else {

                    document.body.classList.toggle('sidebar-collapsed');

                }

            });

            backdrop.addEventListener('click', function() {

                sidebar.classList.remove('show');
                backdrop.classList.remove('show');

            });

            // Close mobile sidebar after selecting a real navigation link
            sidebar.querySelectorAll('a').forEach(function(link) {

                link.addEventListener('click', function() {

                    if (isMobile() && link.getAttribute('href') !== '#') {

                        sidebar.classList.remove('show');
                        backdrop.classList.remove('show');

                    }

                });

            });

            // Reset mobile drawer state when screen becomes desktop
            window.addEventListener('resize', function() {

                if (!isMobile()) {

                    sidebar.classList.remove('show');
                    backdrop.classList.remove('show');

                } else {

                    document.body.classList.remove('sidebar-collapsed');

                }

            });

        });
    </script>

    @stack('scripts')

</body>

</html>