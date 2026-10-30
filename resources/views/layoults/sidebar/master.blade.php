<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ELMS | Employee Leave Management System')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --navy: #173b70;
            --navy-dark: #102b50;
            --blue: #2878b8;
            --sidebar-width: 255px;
            --header-height: 78px;
            --page-bg: #f5f7fb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: var(--page-bg);
            color: #344054;
            font-size: 14px;
        }

        .elms-sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: var(--sidebar-width);
            background: #fff;
            border-right: 1px solid #dfe5ed;
            overflow-y: auto;
            z-index: 1050;
            transition: transform .25s ease;
        }

        .sidebar-brand {
            height: 125px;
            background: linear-gradient(135deg, var(--navy-dark), #285b96);
            color: white;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 20px;
        }

        .brand-logo {
            width: 47px;
            height: 47px;
            border-radius: 12px;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .3);
            display: grid;
            place-items: center;
            font-size: 26px;
        }

        .sidebar-brand h5 {
            font-weight: 800;
            letter-spacing: 1px;
            margin: 0;
        }

        .sidebar-brand small {
            display: block;
            color: #dceaff;
            font-size: 10px;
            margin-top: 4px;
        }

        .sidebar-section {
            padding: 20px 17px 8px;
            font-size: 10px;
            letter-spacing: 1.2px;
            color: #8a96a8;
            font-weight: 800;
        }

        .sidebar-link,
        .sidebar-toggle {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 19px;
            border: 0;
            border-left: 3px solid transparent;
            background: transparent;
            text-decoration: none;
            color: #465468;
            text-align: left;
            font-size: 13px;
            transition: .2s;
        }

        .sidebar-link>i:first-child,
        .sidebar-toggle>i:first-child {
            width: 20px;
            font-size: 17px;
            text-align: center;
        }

        .sidebar-link:hover,
        .sidebar-toggle:hover {
            background: #f0f5fb;
            color: var(--blue);
        }

        .sidebar-link.active {
            color: #1768a8;
            background: #eaf3fb;
            border-left-color: #2583c5;
            font-weight: 650;
        }

        .sidebar-toggle[aria-expanded="true"] {
            background: #f4f7fb;
            color: var(--navy);
            font-weight: 650;
        }

        .menu-chevron {
            margin-left: auto;
            transition: transform .2s;
            font-size: 12px;
        }

        .sidebar-toggle[aria-expanded="true"] .menu-chevron {
            transform: rotate(180deg);
        }

        .sidebar-submenu {
            padding: 3px 0 8px;
            background: #f8fafc;
        }

        .sidebar-submenu a {
            display: block;
            text-decoration: none;
            color: #617086;
            font-size: 12px;
            padding: 11px 12px 11px 53px;
            border-left: 3px solid transparent;
        }

        .sidebar-submenu a:hover,
        .sidebar-submenu a.active {
            color: #1768a8;
            background: #eaf3fb;
            border-left-color: #2583c5;
        }

        .sidebar-footer {
            padding: 18px;
            margin-top: 15px;
            border-top: 1px solid #e9edf3;
            color: #8b96a7;
            font-size: 11px;
        }

        .elms-main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }

        .elms-topbar {
            min-height: var(--header-height);
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            padding: 15px 28px;
            background: #fff;
            border-bottom: 1px solid #e6eaf0;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .topbar-title {
            margin: 0;
            font-size: 18px;
            font-weight: 750;
            color: #24364f;
        }

        .topbar-subtitle {
            color: #8a96a8;
            font-size: 11px;
            margin-top: 4px;
        }

        .menu-button {
            display: none;
            border: 1px solid #e1e7ef;
            border-radius: 8px;
            background: white;
            padding: 7px 10px;
            font-size: 20px;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 39px;
            height: 39px;
            border-radius: 50%;
            background: #e8f1ff;
            color: #205da0;
            display: grid;
            place-items: center;
            font-size: 20px;
        }

        .page-content {
            padding: 27px 28px;
            min-height: calc(100vh - var(--header-height) - 55px);
        }

        .page-footer {
            padding: 16px 25px;
            text-align: center;
            font-size: 11px;
            color: #8994a5;
            border-top: 1px solid #e7ebf2;
            background: #fff;
        }

        .sidebar-backdrop {
            display: none;
        }

        @media (max-width: 991px) {
            .elms-sidebar {
                transform: translateX(-100%);
            }

            .elms-sidebar.show {
                transform: translateX(0);
            }

            .elms-main {
                margin-left: 0;
            }

            .menu-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            .sidebar-backdrop.show {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(15, 23, 42, .45);
                z-index: 1040;
            }
        }

        @media (max-width: 575px) {
            .elms-topbar {
                padding: 12px 14px;
            }

            .page-content {
                padding: 18px 13px;
            }

            .topbar-title {
                font-size: 16px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <aside class="elms-sidebar" id="elmsSidebar">

        <div class="sidebar-brand">
            <div class="brand-logo">
                <i class="bi bi-calendar2-check-fill"></i>
            </div>
            <div>
                <h5>ELMS</h5>
                <small>EMPLOYEE LEAVE SYSTEM</small>
            </div>
        </div>

        <div class="sidebar-section">MAIN MENU</div>

        <a href="{{ route('conference.dashboard') }}"
            class="sidebar-link {{ request()->routeIs('conference.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            <span>Dashboard</span>
        </a>

        <button type="button"
            class="sidebar-toggle"
            data-bs-toggle="collapse"
            data-bs-target="#employeeSubmenu"
            aria-expanded="{{ request()->routeIs('conference.employees.*') ? 'true' : 'false' }}">
            <i class="bi bi-people-fill"></i>
            <span>Employee Management</span>
            <i class="bi bi-chevron-down menu-chevron"></i>
        </button>

        <div class="collapse {{ request()->routeIs('conference.employees.*') ? 'show' : '' }}"
            id="employeeSubmenu">
            <div class="sidebar-submenu">
                <a href="{{ route('conference.employees.index') }}"
                    class="{{ request()->routeIs('conference.employees.index') ? 'active' : '' }}">
                    <i class="bi bi-list-ul me-2"></i> All Employees
                </a>
                <a href="{{ route('conference.employees.create') }}"
                    class="{{ request()->routeIs('conference.employees.create') ? 'active' : '' }}">
                    <i class="bi bi-person-plus me-2"></i> Add Employee
                </a>
            </div>
        </div>

        <button type="button"
            class="sidebar-toggle"
            data-bs-toggle="collapse"
            data-bs-target="#leaveSubmenu"
            aria-expanded="{{ request()->routeIs('conference.leaves.*') ? 'true' : 'false' }}">
            <i class="bi bi-calendar2-week"></i>
            <span>Leave Management</span>
            <i class="bi bi-chevron-down menu-chevron"></i>
        </button>

        <div class="collapse {{ request()->routeIs('conference.leaves.*') ? 'show' : '' }}"
            id="leaveSubmenu">
            <div class="sidebar-submenu">
                
                    <i class="bi bi-list-ul me-2"></i> All Applications
                </a>
                <!-- <a href="{{ route('conference.leaves.create') }}"> -->
                    <i class="bi bi-plus-circle me-2"></i> Apply for Leave
                </a>
                <!-- <a href="{{ route('conference.leaves.types') }}"> -->
                    <i class="bi bi-tags me-2"></i><a href="{{ route('conference.leaves.index') }}"> Leave Types
                </a>
            </div>
        </div>

        <button type="button"
            class="sidebar-toggle"
            data-bs-toggle="collapse"
            data-bs-target="#approvalSubmenu"
            <!-- aria-expanded="{{ request()->routeIs('conference.approvals.*') ? 'true' : 'false' }}"> -->
            <i class="bi bi-check2-square"></i>
            <span>Leave Approvals</span>
            <i class="bi bi-chevron-down menu-chevron"></i>
        </button>

        <!-- <div class="collapse {{ request()->routeIs('conference.approvals.*') ? 'show' : '' }}"
            id="approvalSubmenu"> -->
            <div class="sidebar-submenu">
                <!-- <a href="{{ route('conference.approvals.index') }}"> -->
                    <i class="bi bi-hourglass-split me-2"></i> Pending Approvals
                </a>
                <a href="{{ route('conference.approvals.history') }}">
                    <i class="bi bi-clock-history me-2"></i> Approval History
                </a>
            </div>
        </div>

        <button type="button"
            class="sidebar-toggle"
            data-bs-toggle="collapse"
            data-bs-target="#reportSubmenu"
            aria-expanded="{{ request()->routeIs('conference.reports.*') ? 'true' : 'false' }}">
            <i class="bi bi-bar-chart-line-fill"></i>
            <span>Leave Reports</span>
            <i class="bi bi-chevron-down menu-chevron"></i>
        </button>

        <div class="collapse {{ request()->routeIs('conference.reports.*') ? 'show' : '' }}"
            id="reportSubmenu">
            <div class="sidebar-submenu">
                <a href="{{ route('conference.reports.index') }}">
                    <i class="bi bi-file-earmark-bar-graph me-2"></i> Leave Summary
                </a>
            </div>
        </div>

        <div class="sidebar-section">SYSTEM</div>

        <a href="#" class="sidebar-link">
            <i class="bi bi-gear-fill"></i>
            <span>Settings</span>
        </a>

        <div class="sidebar-footer">
            <i class="bi bi-shield-check me-1"></i>
            Employee Leave Management System
            <div class="mt-2">Version 1.0</div>
        </div>

    </aside>

    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="elms-main">

        <header class="elms-topbar">
            <div class="topbar-left">
                <button class="menu-button" type="button" id="sidebarToggle"
                    aria-label="Toggle navigation">
                    <i class="bi bi-list"></i>
                </button>

                <div>
                    <h1 class="topbar-title">@yield('page-title', 'Dashboard')</h1>
                    <div class="topbar-subtitle">
                        Employee Leave Management System
                    </div>
                </div>
            </div>

            <div class="topbar-user">
                <div class="text-end d-none d-sm-block">
                    <div class="fw-semibold" style="font-size:12px;">
                        ELMS Administrator
                    </div>
                    <div class="text-secondary" style="font-size:11px;">
                        Management Portal
                    </div>
                </div>
                <div class="user-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>
            </div>
        </header>

        <main class="page-content">
            @yield('content')
        </main>

        <footer class="page-footer">
            &copy; {{ date('Y') }} Employee Leave Management System.
            All rights reserved.
        </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const sidebar = document.getElementById('elmsSidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const backdrop = document.getElementById('sidebarBackdrop');

        function closeSidebar() {
            sidebar.classList.remove('show');
            backdrop.classList.remove('show');
        }

        sidebarToggle?.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            backdrop.classList.toggle('show');
        });

        backdrop?.addEventListener('click', closeSidebar);

        document.querySelectorAll('.sidebar-link, .sidebar-submenu a')
            .forEach(function(link) {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 991) {
                        closeSidebar();
                    }
                });
            });
    </script>

    @stack('scripts')
</body>

</html>