<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SI JEBOL - Panel Masyarakat')</title>
    
    <!-- Base CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    
    <!-- Panel Masyarakat Global CSS -->
    <link rel="stylesheet" href="{{ asset('css/masyarakat.css') }}?v={{ time() }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @stack('styles')
</head>
<body class="no-batik" x-data="{ sidebarOpen: false }">
    <div class="dashboard-layout">
        @include('partials.sidebar-masyarakat')

        <main class="main-content">
            @yield('content')
            
        <div style="margin-top: auto; margin-left: -24px; margin-right: -24px; width: calc(100% + 48px); padding: 16px 24px; background: white; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; font-size: 0.75rem; color: #64748b; position: sticky; bottom: 0; z-index: 40; box-sizing: border-box;">
            <div>&copy; {{ date('Y') }} Dinas Kependudukan dan Pencatatan Sipil Kota Tegal. All rights reserved.</div>
            <div style="display:flex; gap:16px;">
                <span style="color:#64748b;">Crafted with ❤️ by Siti Nurhalizah</span>
            </div>
        </div>        
        </main>
    </div>

    <!-- Toast Container -->
    <div class="toast-container" id="toastContainer"></div>
    
    <!-- Panel Masyarakat Global JS -->
    <script src="{{ asset('js/masyarakat.js') }}"></script>
    
    @stack('scripts')
</body>
</html>
