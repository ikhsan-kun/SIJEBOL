<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SI JEBOL</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --primary: #0f2b5b; /* Deep blue from image */
            --primary-light: #1e3a8a;
            --primary-dark: #0a1930;
            --secondary: #fcd34d; /* Yellow accent */
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --sidebar-width: 260px;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.05);
            --radius-lg: 20px;
            --radius-md: 12px;
        }
        *, *::before, *::after {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }
        /* Sidebar Styling */
        .sidebar {
            width: var(--sidebar-width);
            background-color: #003178; /* Deep blue from masyarakat */
            color: #fff;
            height: 100dvh; /* use dynamic viewport height for mobile */
            position: fixed;
            left: 0;
            top: 0;
            padding: 2rem 1.5rem;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 20px rgba(0,0,0,0.2);
            z-index: 2000; /* Higher z-index to ensure it sits on top */
            overflow-y: auto; /* Allow scrolling if content is too tall */
            overflow-x: hidden;
            border-right: 4px solid var(--secondary);
        }
        /* Hide scrollbar for clean UI but keep functionality */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
        }
        .sidebar::before {
            content: '';
            position: fixed; /* Keep background static when scrolling */
            top: 0; left: 0; bottom: 0; width: var(--sidebar-width);
            background-image: url('{{ asset('images/batik-tegal-premium.jpg') }}');
            background-size: 400px;
            opacity: 0.15;
            mix-blend-mode: luminosity;
            pointer-events: none;
            z-index: 0;
        }
        /* Make sure all child elements are above the ::before pseudo-element */
        .sidebar > * {
            position: relative;
            z-index: 1;
            flex-shrink: 0; /* Prevent items from shrinking when scrolling is needed */
        }
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 2.5rem;
            padding-bottom: 0;
            border-bottom: none;
        }
        .sidebar-logo-box {
            width: 90px;
            height: 90px;
            background: transparent;
            border: none;
            padding: 0;
            display: grid;
            place-items: center;
            transition: all 0.3s ease;
            margin-right: 12px;
        }
        .sidebar-brand h2 { 
            margin: 0; 
            font-size: 1.4rem; 
            font-weight: 800; 
            letter-spacing: 0.5px;
            line-height: 1.2;
        }
        .sidebar-brand p {
            margin: 4px 0 0;
            font-size: 0.7rem;
            color: var(--secondary);
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }
        .nav-label {
            display: none; /* Hide labels to match image */
        }
        .nav-link {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            text-align: left;
            gap: 16px;
            padding: 14px 16px;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            border-radius: 12px;
            margin-bottom: 8px;
            font-weight: 700;
            font-size: 0.85rem;
            transition: all 0.2s;
            position: relative;
        }
        .nav-link i, .nav-link svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            display: inline-block;
        }
        .nav-link:hover {
            background: rgba(255,255,255,0.05);
            color: #fff;
        }
        .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: var(--secondary);
        }
        
        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }
        
        /* Top Header */
        .top-header {
            background: #fff;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 40;
            border-bottom: 1px solid #f1f5f9;
        }
        .header-search {
            flex: 1;
            max-width: 400px;
            position: relative;
        }
        .header-search input {
            width: 100%;
            padding: 10px 16px 10px 40px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 99px;
            font-size: 0.9rem;
            color: var(--text-main);
            outline: none;
            transition: all 0.2s;
        }
        .header-search input:focus {
            background: #fff;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        .header-search i, .header-search svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            width: 16px;
            height: 16px;
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .notification-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            position: relative;
            padding: 8px;
        }
        .notification-btn:hover { color: var(--primary); }
        .notification-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            border: 2px solid #fff;
        }
        .user-profile-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
        }
        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.95rem;
            overflow: hidden;
            border: 2px solid #eff6ff;
        }
        .user-info {
            display: flex;
            flex-direction: column;
            text-align: left;
        }
        .user-name { font-weight: 700; font-size: 0.85rem; color: var(--text-main); }
        .user-role { font-size: 0.7rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; }

        /* Content Area */
        .content-body {
            padding: 2rem;
            flex-grow: 1;
        }
        
        /* Cards */
        .card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: var(--shadow-sm);
            margin-bottom: 1.5rem;
            border: 1px solid #f1f5f9;
        }
        
        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--primary);
            color: #fff;
            text-decoration: none;
            border-radius: 99px; /* Pill shape like image */
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .btn:hover { 
            background: var(--primary-light); 
        }
        .btn-warning {
            background: var(--secondary);
            color: var(--primary-dark);
        }
        .btn-warning:hover {
            background: #fde68a;
        }
        .btn-danger { 
            background: #ef4444; 
        }
        .btn-danger:hover { 
            background: #dc2626; 
        }
        .btn-outline {
            background: transparent;
            color: var(--text-main);
            border: 1px solid #cbd5e1;
        }
        .btn-outline:hover {
            background: #f1f5f9;
        }

        /* Tables */
        .table-container {
            overflow-x: auto;
            border-radius: var(--radius-md);
            border: 1px solid #f1f5f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #f1f5f9;
            font-size: 0.9rem;
        }
        th { 
            background: #f8fafc; 
            font-weight: 700; 
            color: var(--text-muted); 
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }
        tr:last-child td { border-bottom: none; }
        
        /* Badges */
        .badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-transform: uppercase;
        }
        .badge-pending { background: #fef3c7; color: #b45309; }
        .badge-success { background: #dcfce3; color: #166534; }
        .badge-rejected { background: #fee2e2; color: #b91c1c; }

        /* Forms */
        .form-group { margin-bottom: 1.25rem; }
        .form-group label { 
            display: block; 
            margin-bottom: 0.5rem; 
            font-weight: 600; 
            color: var(--text-main);
            font-size: 0.9rem;
        }
        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-sizing: border-box;
            font-family: inherit;
            font-size: 0.9rem;
            color: var(--text-main);
            background: #f8fafc;
            transition: all 0.2s;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--primary-light);
            background: #fff;
        }
        
        /* Mobile Responsiveness */
        .mobile-toggle {
            display: none;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: var(--primary);
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
            align-items: center;
            justify-content: center;
        }
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 43, 91, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1500;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }
        
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            .top-header {
                padding: 1rem;
                gap: 12px;
            }
            .mobile-toggle {
                display: flex;
            }
            .header-search {
                display: none; /* Hide search on mobile */
            }
            .content-body {
                padding: 1.5rem 1rem;
            }
            .hero-banner {
                padding: 2rem 1.5rem;
                flex-direction: column;
                text-align: center;
            }
            .hero-title {
                font-size: 1.5rem;
            }
            .hero-icon {
                display: none;
            }
            .user-info {
                display: none; /* Hide user name text to save space */
            }
        }
        
        /* Hero Banner */
        .hero-banner {
            background: var(--primary);
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
        
            border-radius: 0;
            padding: 48px 96px;
            margin: 0 -48px 40px -48px;
            border-bottom: 4px solid var(--accent);
        }
        .hero-banner::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('images/batik-tegal-premium.jpg') }}');
            background-size: 400px;
            opacity: 0.15;
            mix-blend-mode: luminosity;
            pointer-events: none;
            z-index: 0;
        }
        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 600px;
        }
        .hero-title {
            font-size: 2rem;
            font-weight: 800;
            margin: 0 0 1rem;
        }
        .hero-title span {
            color: var(--secondary);
        }
        .hero-desc {
            font-size: 1rem;
            line-height: 1.6;
            color: rgba(255,255,255,0.8);
            margin: 0;
        }
        .hero-icon {
            position: relative;
            z-index: 1;
            opacity: 0.2;
        }
        .hero-icon i {
            width: 120px;
            height: 120px;
        }
        
        /* Bottom Sidebar Buttons */
        .sidebar-bottom {
            margin-top: auto; /* Push to bottom */
            display: flex;
            flex-direction: column;
            gap: 16px;
            padding-top: 1.5rem;
            background: transparent;
            margin: auto -1.5rem -2rem; /* Stretch out of padding */
            padding: 2rem 1.5rem 2rem;
        }
        .sidebar-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 14px;
            border-radius: 20px; /* Highly rounded pill */
            font-weight: 800;
            font-size: 0.8rem;
            text-decoration: none;
            text-transform: uppercase;
            transition: all 0.2s;
            letter-spacing: 0.5px;
        }
        .sidebar-btn i {
            width: 18px;
            height: 18px;
        }
        .sidebar-btn.primary {
            background: #fcd34d; /* Yellow */
            color: #0f2b5b; /* Deep blue */
            box-shadow: 0 4px 15px rgba(252, 211, 77, 0.2);
        }
        .sidebar-btn.primary:hover {
            background: #fde68a;
            transform: translateY(-2px);
        }
        .sidebar-btn.secondary {
            background: rgba(255,255,255,0.03);
            color: rgba(255,255,255,0.9);
            border: 1px solid rgba(255,255,255,0.15);
        }
        .sidebar-btn.secondary:hover {
            background: rgba(255,255,255,0.08);
            color: #fff;
        }
        
        /* Alerts */
        .alert-success { 
            background: #dcfce3; 
            color: #166534; 
            padding: 1rem 1.5rem; 
            border-radius: var(--radius-md); 
            margin-bottom: 1.5rem; 
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            border-left: 4px solid #22c55e;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from { transform: translateY(-10px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Custom Pagination Styles */
        .jbl-pagination-container { display: flex; align-items: center; justify-content: flex-start; gap: 0.5rem; margin-top: 1.5rem; }
        .jbl-page-item { display: inline-flex; align-items: center; justify-content: center; width: 2.25rem; height: 2.25rem; border-radius: 0.5rem; background-color: #ffffff; border: 1px solid #e2e8f0; color: #475569; font-size: 0.875rem; font-weight: 500; text-decoration: none; transition: all 0.2s; cursor: pointer; }
        .jbl-page-item:hover:not(.disabled):not(.active) { background-color: #f8fafc; border-color: #cbd5e1; color: #1e293b; }
        .jbl-page-item.active { background-color: #003178; border-color: #003178; color: #ffffff; cursor: default; }
        .jbl-page-item.disabled { background-color: #f1f5f9; color: #94a3b8; cursor: not-allowed; border-color: #e2e8f0; }
        .jbl-page-link { display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; text-decoration: none; }
        
        /* Dropdowns */
        .dropdown-menu {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.1);
            border: 1px solid #f1f5f9;
            min-width: 240px;
            z-index: 50;
            padding: 8px 0;
            transform-origin: top right;
        }
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 20px;
            color: var(--text-main);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
        }
        .dropdown-item:hover {
            background: #f8fafc;
            color: var(--primary);
        }
        .dropdown-item i {
            width: 18px;
            height: 18px;
            color: var(--text-muted);
        }
        .dropdown-item:hover i {
            color: var(--primary);
        }
        .dropdown-header {
            padding: 12px 20px 8px;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 4px;
        }
        .dropdown-divider {
            height: 1px;
            background: #f1f5f9;
            margin: 8px 0;
        }
        
        /* Notif Item Specifics */
        .notif-item {
            padding: 12px 20px;
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.2s;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            text-decoration: none;
        }
        .notif-item:last-child { border-bottom: none; }
        .notif-item:hover { background: #f8fafc; }
        .notif-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #eff6ff;
            color: #3b82f6;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }
        .notif-content p.notif-title {
            margin: 0 0 4px;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-main);
        }
        .notif-content p.notif-desc {
            margin: 0;
            font-size: 0.75rem;
            color: var(--text-muted);
            line-height: 1.4;
        }
    </style>
</head>
<body>
    @php
        $authUser = Auth::guard('admin')->user() ?? Auth::guard('web')->user() ?? Auth::user();
    @endphp
    <!-- Sidebar Overlay -->
    <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-logo-box">
                <img src="{{ asset('images/logo-tegal.png') }}" alt="Logo" style="width: 100%; height: 100%; object-fit: contain; filter: drop-shadow(0 0 12px rgba(255, 255, 255, 0.6));">
            </div>
            <div>
                <h2>SI JEBOL</h2>
                <p>KOTA TEGAL WARGA</p>
            </div>
        </div>

        <div class="nav-label">Main Menu</div>

        @if($authUser && in_array(trim(strtolower($authUser->role ?? '')), ['admin', 'admin pusat']))
            <!-- Admin Menu -->
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard"></i> DASHBOARD
            </a>
            <a href="{{ route('admin.permohonan') ?? '#' }}" class="nav-link {{ request()->routeIs('admin.permohonan', 'admin.permohonan.*') ? 'active' : '' }}">
                <i data-lucide="file-text"></i> PERMOHONAN
            </a>
            <a href="{{ route('admin.jadwal') ?? '#' }}" class="nav-link {{ request()->routeIs('admin.jadwal', 'admin.jadwal.*') ? 'active' : '' }}">
                <i data-lucide="calendar"></i> JADWAL JEBOL
            </a>
            <a href="{{ route('admin.laporan') ?? '#' }}" class="nav-link {{ request()->routeIs('admin.laporan', 'admin.laporan.*') ? 'active' : '' }}">
                <i data-lucide="bar-chart"></i> LAPORAN
            </a>
            <a href="{{ route('admin.kepuasan.index') ?? '#' }}" class="nav-link {{ request()->routeIs('admin.kepuasan', 'admin.kepuasan.*') ? 'active' : '' }}">
                <i data-lucide="star"></i> PENILAIAN LAYANAN
            </a>
        @elseif($authUser && in_array(trim(strtolower($authUser->role ?? '')), ['cabang', 'cabang_dinas', 'petugas', 'petugas cabang', 'petugas kecamatan']))
            <!-- Cabang Dinas Menu -->
            <a href="{{ route('cabang.dashboard') }}" class="nav-link {{ request()->routeIs('cabang.dashboard') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard"></i> DASHBOARD
            </a>
            <a href="{{ route('cabang.sekolah') ?? '#' }}" class="nav-link {{ request()->routeIs('cabang.sekolah', 'cabang.sekolah.*') ? 'active' : '' }}">
                <i data-lucide="school"></i> KELOLA DATA SEKOLAH
            </a>
            <a href="{{ route('cabang.monitoring') ?? '#' }}" class="nav-link {{ request()->routeIs('cabang.monitoring', 'cabang.monitoring.*') ? 'active' : '' }}">
                <i data-lucide="clipboard-list"></i> MONITORING PENGAJUAN SEKOLAH
            </a>
            <a href="{{ route('cabang.jadwal') ?? '#' }}" class="nav-link {{ request()->routeIs('cabang.jadwal', 'cabang.jadwal.*') ? 'active' : '' }}">
                <i data-lucide="calendar"></i> JADWAL PELAYANAN
            </a>
            <a href="{{ route('cabang.laporan') ?? '#' }}" class="nav-link {{ request()->routeIs('cabang.laporan', 'cabang.laporan.*') ? 'active' : '' }}">
                <i data-lucide="file-bar-chart-2"></i> LAPORAN
            </a>
        @else
            <!-- Kecamatan Menu (Default) -->
            <a href="{{ route('cabang.dashboard') }}" class="nav-link {{ request()->routeIs('cabang.dashboard') ? 'active' : '' }}">
                <i data-lucide="layout-dashboard"></i> DASHBOARD
            </a>
            <a href="#" class="nav-link">
                <i data-lucide="users"></i> DATA MASYARAKAT
            </a>
            <a href="#" class="nav-link">
                <i data-lucide="file-plus"></i> PENGAJUAN JEBOL
            </a>
            <a href="#" class="nav-link">
                <i data-lucide="monitor"></i> MONITORING
            </a>
            <a href="#" class="nav-link">
                <i data-lucide="calendar"></i> JADWAL PELAYANAN
            </a>
            <a href="#" class="nav-link">
                <i data-lucide="file-bar-chart-2"></i> LAPORAN
            </a>
        @endif
        
        <div style="flex-grow: 1;"></div>
        


        <!-- Bottom Buttons like the image -->
        <div class="sidebar-bottom">
            @if($authUser && in_array(trim(strtolower($authUser->role ?? '')), ['admin', 'admin pusat']))
                <a href="{{ route('admin.jadwal.create') ?? '#' }}" class="sidebar-btn primary">
                    <i data-lucide="plus-circle" style="width: 16px; height: 16px;"></i> BUAT JADWAL
                </a>
            @endif

            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="sidebar-btn secondary">
                <i data-lucide="log-out" style="width: 16px; height: 16px;"></i> KELUAR SESI
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div style="display: flex; align-items: center; gap: 12px; flex: 1;">
                <button class="mobile-toggle" onclick="toggleSidebar()">
                    <i data-lucide="menu" style="width: 24px; height: 24px;"></i>
                </button>
                @php
                    $isSettingsPage = request()->routeIs('admin.settings*') || request()->routeIs('admin.users*');
                    $isCabang = false;
                    if (isset($authUser) && in_array(strtolower(trim($authUser->role ?? '')), ['cabang', 'cabang_dinas', 'petugas cabang'])) {
                        $isCabang = true;
                    }
                    
                    if ($isSettingsPage) {
                        $searchAction = route('admin.users');
                    } elseif ($isCabang) {
                        $searchAction = route('cabang.monitoring');
                    } else {
                        $searchAction = route('admin.permohonan');
                    }
                    $searchPlaceholder = $isSettingsPage ? 'Cari nama atau NIK pengguna...' : 'Cari layanan atau permohonan...';
                @endphp
                <form action="{{ $searchAction }}" method="GET" class="header-search">
                    <i data-lucide="search"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ $searchPlaceholder }}">
                </form>
            </div>
            
            <div class="user-profile">
                @php
                    $pendingCount = 0;
                    $recentPending = collect();
                    
                    if (isset($authUser) && $authUser && !in_array(trim(strtolower($authUser->role ?? '')), ['cabang', 'cabang_dinas', 'petugas', 'petugas cabang', 'petugas kecamatan'])) {
                        $pendingQuery = \App\Models\PengajuanLayanan::where(function($q) {
                            $q->where('status', 'LIKE', '%menunggu%')
                              ->orWhere('status', 'LIKE', '%Menunggu%');
                        });
                        
                        $pendingCount = (clone $pendingQuery)->count();
                        $recentPending = $pendingQuery->orderBy('tanggal_pengajuan', 'desc')
                            ->take(3)
                            ->get();
                    }
                @endphp
                
                <!-- Notification Dropdown -->
                <div x-data="{ open: false }" style="position: relative;">
                    <button @click="open = !open" @click.away="open = false" class="notification-btn">
                        <i data-lucide="bell" style="width: 20px; height: 20px;"></i>
                        @if($pendingCount > 0)
                        <span class="notification-badge"></span>
                        @endif
                    </button>
                    
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="dropdown-menu" style="width: 320px; display: none;">
                        <div class="dropdown-header">Notifikasi Sistem</div>
                        
                        @if($pendingCount > 0)
                            <a href="{{ route('admin.permohonan') }}" class="notif-item">
                                <div class="notif-icon" style="background: #fef3c7; color: #d97706;">
                                    <i data-lucide="file-warning" style="width: 16px; height: 16px;"></i>
                                </div>
                                <div class="notif-content">
                                    <p class="notif-title">{{ $pendingCount }} Permohonan Menunggu</p>
                                    <p class="notif-desc">Ada permohonan baru yang perlu diverifikasi segera.</p>
                                </div>
                            </a>
                            @foreach($recentPending as $p)
                                <a href="{{ route('admin.permohonan', ['search' => $p->nomor_tiket]) }}" class="notif-item">
                                    <div class="notif-icon">
                                        <i data-lucide="file-text" style="width: 16px; height: 16px;"></i>
                                    </div>
                                    <div class="notif-content">
                                        <p class="notif-title">Layanan {{ $p->jenis_layanan }}</p>
                                        <p class="notif-desc">{{ $p->nomor_tiket }} - {{ $p->tanggal_pengajuan ? \Carbon\Carbon::parse($p->tanggal_pengajuan)->diffForHumans() : '' }}</p>
                                    </div>
                                </a>
                            @endforeach
                            <a href="{{ route('admin.permohonan') }}" style="display: block; text-align: center; padding: 12px; font-size: 0.8rem; font-weight: 700; color: var(--primary); text-decoration: none; border-top: 1px solid #f1f5f9; background: #f8fafc; border-bottom-left-radius: 16px; border-bottom-right-radius: 16px;">Lihat Semua Notifikasi</a>
                        @else
                            <div style="padding: 24px; text-align: center; color: var(--text-muted);">
                                <i data-lucide="check-circle-2" style="width: 32px; height: 32px; margin-bottom: 8px; opacity: 0.5;"></i>
                                <p style="margin: 0; font-size: 0.85rem;">Semua tugas sudah selesai.<br>Tidak ada notifikasi baru.</p>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div style="width: 1px; height: 30px; background: #e2e8f0; margin: 0 8px;"></div>
                
                <!-- Profile Dropdown -->
                <div x-data="{ open: false }" style="position: relative;">
                    <button @click="open = !open" @click.away="open = false" class="user-profile-btn">
                        <div class="avatar">
                            @if($authUser && isset($authUser->foto_profil) && $authUser->foto_profil)
                                <img src="{{ asset('storage/' . $authUser->foto_profil) }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                {{ strtoupper(substr($authUser->name ?? 'K', 0, 2)) }}
                            @endif
                        </div>
                        <div class="user-info">
                            <span class="user-name">{{ $authUser->name ?? 'Kecamatan' }}</span>
                            <span class="user-role">{{ str_replace('_', ' ', $authUser->role ?? 'Role') }}</span>
                        </div>
                        <i data-lucide="chevron-down" style="width: 16px; height: 16px; color: #94a3b8; margin-left: 8px;"></i>
                    </button>
                    
                    <div x-show="open" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="dropdown-menu" style="display: none;">
                        <div style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9;">
                            <p style="margin: 0; font-weight: 800; font-size: 0.95rem; color: var(--text-main);">{{ $authUser->name ?? 'User' }}</p>
                            <p style="margin: 4px 0 0; font-size: 0.8rem; color: var(--text-muted);">{{ $authUser->email ?? '' }}</p>
                        </div>
                        
                        <div style="padding: 8px 0;">
                            @if(in_array(trim(strtolower($authUser->role ?? '')), ['admin', 'admin pusat']))
                                <a href="{{ route('admin.profil') }}" class="dropdown-item">
                                    <i data-lucide="user"></i> Profil Saya
                                </a>

                            @else
                                <a href="{{ route('cabang.profil') }}" class="dropdown-item">
                                    <i data-lucide="user"></i> Profil Saya
                                </a>
                            @endif
                        </div>
                        
                        <div class="dropdown-divider"></div>
                        
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0; padding: 8px 0;">
                            @csrf
                            <button type="submit" class="dropdown-item" style="color: #ef4444;">
                                <i data-lucide="log-out" style="color: #ef4444;"></i> Keluar Sistem
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="content-body">
            @yield('content')
        </div>

        <!-- Global Footer -->
        <div style="margin-top: auto; margin-left: 0; margin-right: 0; width: 100%; padding: 16px 24px; background: white; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; font-size: 0.75rem; color: #64748b; position: sticky; bottom: 0; z-index: 40; box-sizing: border-box;">
            <div>&copy; {{ date('Y') }} Dinas Kependudukan dan Pencatatan Sipil Kota Tegal. All rights reserved.</div>
            <div style="display:flex; gap:16px;">
                <span style="color:#64748b;">Crafted with ❤️ by Siti Nurhalizah</span>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
        
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
            document.querySelector('.sidebar-overlay').classList.toggle('show');
        }
    </script>
</body>
</html>

