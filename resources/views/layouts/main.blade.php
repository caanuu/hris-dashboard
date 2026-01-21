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
            --gh-header-bg: #24292f;
            --gh-text-main: #24292f;
            --gh-bg-canvas: #f6f8fa;
            --gh-border: #d0d7de;
            --gh-green-btn: #2da44e;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #fff;
            color: var(--gh-text-main);
            font-size: 14px;
        }

        .gh-header {
            background-color: var(--gh-header-bg);
            padding: 12px 24px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .gh-sidebar {
            width: 260px;
            background-color: #fff;
            border-right: 1px solid var(--gh-border);
            padding: 20px;
            min-height: calc(100vh - 56px);
        }

        .gh-nav-item {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            color: var(--gh-text-main);
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 2px;
        }

        .gh-nav-item:hover,
        .gh-nav-item.active {
            background-color: var(--gh-bg-canvas);
        }

        .gh-nav-icon {
            width: 20px;
            margin-right: 8px;
            color: #57606a;
        }

        .gh-section-title {
            font-size: 11px;
            font-weight: 600;
            color: #57606a;
            margin: 20px 0 8px 12px;
            text-transform: uppercase;
        }

        .gh-content {
            flex-grow: 1;
            padding: 32px;
            background-color: #fff;
        }
    </style>
</head>

<body>

    <header class="gh-header">
        <div class="d-flex align-items-center gap-3">
            <i class="bi bi-github fs-3"></i>
            <span class="fw-bold">HRIS TPL</span>
        </div>
        <div class="dropdown">
            <a href="#" class="text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random" width="24"
                    class="rounded-circle me-1">
                <span class="small fw-bold">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li class="px-3 py-1 small text-muted">Signed in as <br><strong
                        class="text-dark">{{ ucfirst(Auth::user()->role) }}</strong></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item small" href="{{ route('settings.index') }}">Settings</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item small text-danger">Sign out</button>
                    </form>
                </li>
            </ul>
        </div>
    </header>

    <div class="d-flex">
        <nav class="gh-sidebar">
            <div class="gh-section-title">Overview</div>
            <a href="{{ route('dashboard') }}"
                class="gh-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 gh-nav-icon"></i> Dashboard
            </a>

            @if (Auth::user()->role == 'admin')
                <a href="{{ route('reports.index') }}"
                    class="gh-nav-item {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    <i class="bi bi-graph-up gh-nav-icon"></i> Insights
                </a>

                <div class="gh-section-title">Management</div>
                <a href="{{ route('employees.index') }}"
                    class="gh-nav-item {{ request()->routeIs('employees.*') ? 'active' : '' }}">
                    <i class="bi bi-people gh-nav-icon"></i> Employees
                </a>
                <a href="{{ route('structure.index') }}"
                    class="gh-nav-item {{ request()->routeIs('structure.*') ? 'active' : '' }}">
                    <i class="bi bi-diagram-2 gh-nav-icon"></i> Departments
                </a>
            @endif

            <div class="gh-section-title">Operasional</div>

            <a href="{{ route('attendance.index') }}"
                class="gh-nav-item {{ request()->routeIs('attendance.*') ? 'active' : '' }}">
                <i class="bi bi-clock-history gh-nav-icon"></i>
                {{ Auth::user()->role == 'admin' ? 'Data Absensi' : 'Absensi Saya' }}
            </a>

            <a href="{{ route('leaves.index') }}"
                class="gh-nav-item {{ request()->routeIs('leaves.*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check gh-nav-icon"></i>
                {{ Auth::user()->role == 'admin' ? 'Approval Cuti' : 'Ajukan Cuti' }}
            </a>

            <a href="{{ route('payroll.index') }}"
                class="gh-nav-item {{ request()->routeIs('payroll.*') ? 'active' : '' }}">
                <i class="bi bi-cash-stack gh-nav-icon"></i>
                {{ Auth::user()->role == 'admin' ? 'Penggajian' : 'Slip Gaji Saya' }}
            </a>

            <div class="mt-4 pt-4 border-top">
                <a href="{{ route('settings.index') }}"
                    class="gh-nav-item {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                    <i class="bi bi-gear gh-nav-icon"></i> Settings
                </a>
            </div>
        </nav>

        <main class="gh-content">
            @if (session('success'))
                <div class="alert alert-success border-success small py-2 mb-4">
                    <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger border-danger small py-2 mb-4">
                    <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
