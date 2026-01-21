<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRIS - PT Toba Pulp Lestari</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --header-height: 60px;
            --primary-bg: #f6f8fa;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--primary-bg);
            color: #24292f;
            overflow-x: hidden;
        }

        /* Responsive Sidebar */
        #sidebar {
            width: var(--sidebar-width);
            background-color: #ffffff;
            border-right: 1px solid #d0d7de;
            position: fixed;
            height: 100vh;
            top: 0;
            left: 0;
            padding: 16px;
            z-index: 1040;
            transition: transform 0.3s ease-in-out;
        }

        #main-content {
            margin-left: var(--sidebar-width);
            padding: 24px;
            transition: margin-left 0.3s ease-in-out;
            min-height: 100vh;
        }

        /* Mobile View Rules */
        @media (max-width: 768px) {
            #sidebar {
                transform: translateX(-100%);
            }

            #sidebar.active {
                transform: translateX(0);
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            }

            #main-content {
                margin-left: 0;
            }

            /* Overlay saat sidebar muncul di HP */
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1030;
            }

            .sidebar-overlay.active {
                display: block;
            }
        }

        .nav-link {
            color: #57606a;
            padding: 10px 12px;
            border-radius: 6px;
            margin-bottom: 2px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: #f6f8fa;
            color: #0969da;
            font-weight: 500;
        }

        .nav-link i {
            margin-right: 12px;
            font-size: 16px;
        }

        .section-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: #6e7781;
            margin: 24px 0 8px 12px;
        }

        /* Custom Card Style (GitHub-ish) */
        .gh-card {
            background: #fff;
            border: 1px solid #d0d7de;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }
    </style>
</head>

<body>

    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <nav id="sidebar">
        <div class="d-flex align-items-center justify-content-between mb-4 px-2">
            <div class="fw-bold text-dark d-flex align-items-center">
                <i class="bi bi-tree-fill text-success fs-4 me-2"></i>
                <span>HRIS TPL</span>
            </div>
            <button class="btn btn-sm btn-light d-md-none" onclick="toggleSidebar()"><i class="bi bi-x-lg"></i></button>
        </div>

        <div class="section-label">Overview</div>
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <div class="section-label">Pegawai</div>
        <a href="{{ route('employees.index') }}"
            class="nav-link {{ request()->routeIs('employees.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Data Karyawan
        </a>
        <a href="{{ route('structure.index') }}"
            class="nav-link {{ request()->routeIs('structure.*') ? 'active' : '' }}">
            <i class="bi bi-diagram-3"></i> Struktur Dept.
        </a>

        <div class="section-label">Operasional</div>
        <a href="{{ route('attendance.index') }}"
            class="nav-link {{ request()->routeIs('attendance.*') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i> Data Absensi
        </a>
        <a href="{{ route('leaves.index') }}" class="nav-link {{ request()->routeIs('leaves.*') ? 'active' : '' }}">
            <i class="bi bi-calendar-check"></i> Pengajuan Cuti
        </a>
        <a href="{{ route('payroll.index') }}" class="nav-link {{ request()->routeIs('payroll.*') ? 'active' : '' }}">
            <i class="bi bi-cash-stack"></i> Penggajian
        </a>

        <div class="mt-5 px-2">
            <a href="#" class="btn btn-outline-danger w-100 btn-sm"><i class="bi bi-box-arrow-left me-2"></i>
                Logout</a>
        </div>
    </nav>

    <main id="main-content">
        <div
            class="d-md-none mb-3 d-flex align-items-center justify-content-between bg-white p-2 rounded border shadow-sm">
            <div class="fw-bold"><i class="bi bi-tree-fill text-success me-2"></i>PT Toba Pulp Lestari</div>
            <button class="btn btn-outline-secondary btn-sm" onclick="toggleSidebar()">
                <i class="bi bi-list"></i> Menu
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.querySelector('.sidebar-overlay').classList.toggle('active');
        }
    </script>
</body>

</html>
