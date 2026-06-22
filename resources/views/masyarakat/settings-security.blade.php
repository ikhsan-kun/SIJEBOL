<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - SI JEBOL</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#003178',
                        primaryHover: '#00255a',
                        accent: '#f59e0b',
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #0f172a;
        }

        .main-content {
            flex-grow: 1;
            margin-left: 260px;
            padding: 80px 0 0 0;
            min-height: 100vh;
            transition: all 0.3s ease;
            min-width: 0;
            display: flex; 
            flex-direction: column;
        }

        @media (max-width: 1024px) {
            .main-content {
                margin-left: 0;
            }
            .page-title-section {
                padding: 32px 24px !important;
            }
        }

        .page-title-section {
            background-color: #003178;
            background-image: linear-gradient(rgba(0, 49, 120, 0.9), rgba(0, 49, 120, 0.9)), url('{{ asset('images/batik-tegal-premium.jpg') }}');
            background-size: cover;
            padding: 48px 96px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-bottom: 4px solid #f59e0b;
        }

        .page-title-section h1 { font-size: 2.25rem; font-weight: 900; color: white; margin-bottom: 8px; }
        .page-title-section p { color: rgba(255, 255, 255, 0.85); font-size: 1rem; max-width: 600px; font-weight: 500; }

        .settings-container {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 32px;
            padding: 40px 48px;
            max-width: 100%;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        .settings-sidebar {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .settings-menu-list {
            background: white;
            border-radius: 24px;
            padding: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .settings-menu-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px 20px;
            border-radius: 16px;
            text-decoration: none;
            color: #475569;
            font-weight: 600;
            transition: all 0.2s ease;
            border-right: 4px solid transparent;
        }
        .settings-menu-item:hover {
            background: #f8fafc;
            color: #003178;
        }
        .settings-menu-item.active {
            background: #eff6ff;
            color: #003178;
            border-right-color: #003178;
        }

        .settings-menu-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }
        .settings-menu-item:hover .settings-menu-icon {
            background: #003178;
            color: white;
        }
        .settings-menu-item.active .settings-menu-icon {
            background: #003178;
            color: white;
        }

        .settings-main {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .glass-card {
            background: white;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .settings-card-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 32px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }

        .settings-card-header h2 {
            font-size: 1.35rem;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }

        .input-group-wrapper label {
            display: block; font-size: 0.75rem; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;
        }
        .input-icon-box { position: relative; }
        .input-icon-box input {
            width: 100%; padding: 12px 16px 12px 44px; background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 12px; font-size: 0.95rem; font-weight: 600; color: #0f172a; transition: all 0.2s; box-sizing: border-box;
        }
        .input-icon-box input:focus { background: white; border-color: #003178; box-shadow: 0 0 0 4px rgba(0, 49, 120, 0.1); outline: none; }
        .input-icon-box i, .input-icon-box svg { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; pointer-events: none; }
        .input-icon-box input:disabled { background: #cbd5e1; color: #64748b; border-color: #cbd5e1; cursor: not-allowed; }

        /* Interactive iOS Switch styling */
        .toggle-switch { position: relative; display: inline-block; width: 52px; height: 28px; }
        .toggle-switch input { opacity: 0; width: 0; height: 0; }
        .toggle-slider { position: absolute; cursor: pointer; inset: 0; background-color: #cbd5e1; transition: .4s; border-radius: 34px; }
        .toggle-slider:before { position: absolute; content: ""; height: 20px; width: 20px; left: 4px; bottom: 4px; background-color: white; transition: .4s; border-radius: 50%; box-shadow: 0 2px 5px rgba(0,0,0,0.15); }
        .toggle-switch input:checked + .toggle-slider { background-color: #003178; }
        .toggle-switch input:checked + .toggle-slider:before { transform: translateX(24px); }

        .btn-primary-custom {
            background: #003178;
            color: white;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 700;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-primary-custom:hover {
            background: #002252;
            transform: translateY(-2px);
        }

        .settings-session-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .settings-session-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 20px;
            border-radius: 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            transition: all 0.2s;
        }

        .settings-session-item.current {
            background: #eff6ff;
            border-color: #bfdbfe;
        }

        .settings-session-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .settings-session-text h5 {
            margin: 0;
            font-size: 0.95rem;
            font-weight: 700;
            color: #0f172a;
        }

        .settings-session-text p {
            margin: 4px 0 0 0;
            font-size: 0.8rem;
            color: #64748b;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
            background: #ecfdf5;
            color: #047857;
        }

        .info-box-custom {
            background: #eff6ff;
            border-left: 4px solid #003178;
            padding: 16px;
            border-radius: 12px;
            display: flex;
            gap: 16px;
            color: #1e3a8a;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        @media (max-width: 1024px) {
            .settings-container {
                grid-template-columns: 1fr;
                padding: 32px 24px;
            }
        }

        @media (max-width: 768px) {
            .glass-card {
                padding: 24px;
            }
            .settings-session-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
        }
    </style>
</head>
<body x-data="{ sidebarOpen: false }">

    <div class="dashboard-layout">
        @include('partials.sidebar-masyarakat')

        <main class="main-content">
            <!-- Header section -->
            <div class="page-title-section">
                <div>
                    <h1>Pengaturan <span style="color: var(--accent);">Akun</span></h1>
                    <p>Kelola informasi profil, keamanan kata sandi, dan preferensi notifikasi.</p>
                </div>
            </div>

            <div class="settings-container">

                <!-- Left Sidebar Menu -->
                <div class="settings-sidebar">
                    <div class="settings-menu-list">
                        
                        <a href="{{ route('masyarakat.settings') }}" class="settings-menu-item {{ request()->routeIs('masyarakat.settings') ? 'active' : '' }}">
                            <div class="settings-menu-icon {{ request()->routeIs('masyarakat.settings') ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-600' }}">
                                <i data-lucide="user" width="20"></i>
                            </div>
                            <div>
                                <h3 style="margin:0; font-size: 0.95rem; font-weight: 700;">Informasi Akun</h3>
                                <p style="margin: 2px 0 0 0; font-size: 0.75rem; color: #64748b;">Data diri dan kontak</p>
                            </div>
                        </a>

                        <a href="{{ route('masyarakat.settings.security') }}" class="settings-menu-item {{ request()->routeIs('masyarakat.settings.security') ? 'active' : '' }}">
                            <div class="settings-menu-icon {{ request()->routeIs('masyarakat.settings.security') ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-600' }}">
                                <i data-lucide="shield" width="20"></i>
                            </div>
                            <div>
                                <h3 style="margin:0; font-size: 0.95rem; font-weight: 700;">Keamanan & Sesi</h3>
                                <p style="margin: 2px 0 0 0; font-size: 0.75rem; color: #64748b;">Status akun dan sesi aktif</p>
                            </div>
                        </a>

                        <a href="{{ route('masyarakat.settings.password') }}" class="settings-menu-item {{ request()->routeIs('masyarakat.settings.password') ? 'active' : '' }}">
                            <div class="settings-menu-icon {{ request()->routeIs('masyarakat.settings.password') ? 'bg-blue-600 text-white' : 'bg-blue-50 text-blue-600' }}">
                                <i data-lucide="key" width="20"></i>
                            </div>
                            <div>
                                <h3 style="margin:0; font-size: 0.95rem; font-weight: 700;">Ubah Password</h3>
                                <p style="margin: 2px 0 0 0; font-size: 0.75rem; color: #64748b;">Perbarui kata sandi Anda</p>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Right Content Area -->
                <div class="settings-main">
                    @if(session('success'))
                        <div style="background: #ecfdf5; border-left: 4px solid #10b981; padding: 16px; border-radius: 12px; display: flex; align-items: center; gap: 12px; color: #065f46; font-weight: 600;">
                            <i data-lucide="check-circle" width="20"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="glass-card">
                        <div class="settings-card-header">
                            <i data-lucide="shield-alert" width="22" style="color: #003178;"></i>
                            <h2>Keamanan & Sesi</h2>
                        </div>

                        <!-- Status Akun -->
                        <div style="margin-bottom: 40px; padding-bottom: 32px; border-bottom: 1px solid #e2e8f0;">
                            <h3 style="font-size: 1.1rem; font-weight: 700; color: #0f172a; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                                <i data-lucide="shield-check" width="18" style="color: #003178;"></i>
                                Status Akun
                            </h3>

                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                                <!-- Status -->
                                <div style="display: flex; gap: 16px; background: #f8fafc; padding: 20px; border-radius: 16px; border: 1px solid #e2e8f0;">
                                    <div style="background: #ecfdf5; color: #10b981; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i data-lucide="check-circle" width="20"></i>
                                    </div>
                                    <div>
                                        <p style="margin: 0; font-size: 0.8rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Status Akun</p>
                                        <p style="margin: 4px 0 0 0; font-size: 1.05rem; font-weight: 800; color: #0f172a;">Aktif</p>
                                        <p style="margin: 4px 0 0 0; font-size: 0.8rem; color: #64748b; line-height: 1.4;">Akun Anda aktif dan dapat digunakan.</p>
                                    </div>
                                </div>

                                <!-- Login Terakhir -->
                                <div style="display: flex; gap: 16px; background: #f8fafc; padding: 20px; border-radius: 16px; border: 1px solid #e2e8f0;">
                                    <div style="background: #eff6ff; color: #003178; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i data-lucide="calendar" width="20"></i>
                                    </div>
                                    <div>
                                        <p style="margin: 0; font-size: 0.8rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Login Terakhir</p>
                                        @if(isset($lastLogin) && $lastLogin)
                                            <p style="margin: 4px 0 0 0; font-size: 1.05rem; font-weight: 800; color: #0f172a;">{{ \Carbon\Carbon::parse($lastLogin->login_at)->translatedFormat('d F Y, H:i') }} WIB</p>
                                            <p style="margin: 4px 0 0 0; font-size: 0.8rem; color: #64748b; line-height: 1.4;">Dari IP {{ $lastLogin->ip_address }}</p>
                                        @elseif(isset($sessions) && $sessions->count() > 0)
                                            <p style="margin: 4px 0 0 0; font-size: 1.05rem; font-weight: 800; color: #0f172a;">{{ \Carbon\Carbon::createFromTimestamp($sessions->first()->last_activity)->translatedFormat('d F Y, H:i') }} WIB</p>
                                            <p style="margin: 4px 0 0 0; font-size: 0.8rem; color: #64748b; line-height: 1.4;">Dari IP {{ $sessions->first()->ip_address }}</p>
                                        @else
                                            <p style="margin: 4px 0 0 0; font-size: 1.05rem; font-weight: 800; color: #0f172a;">Belum ada data</p>
                                            <p style="margin: 4px 0 0 0; font-size: 0.8rem; color: #64748b; line-height: 1.4;">-</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sesi Login -->
                        <div>
                            <h3 style="font-size: 1.1rem; font-weight: 700; color: #0f172a; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                                <i data-lucide="monitor" width="18" style="color: #003178;"></i>
                                Sesi Login Aktif
                            </h3>

                            <div class="info-box-custom">
                                <i data-lucide="info" width="18" style="flex-shrink: 0; margin-top: 2px;"></i>
                                <div>
                                    <p style="margin: 0; font-size: 0.85rem; color: #1e3a8a; line-height: 1.5;">Anda saat ini login di perangkat ini. Jika menemukan aktivitas mencurigakan, Anda dapat mengeluarkan akun dari semua perangkat lain.</p>
                                </div>
                            </div>

                            <div class="settings-session-list" style="margin-top: 20px;">
                                @php
                                    if (!function_exists('parseUserAgentSec')) {
                                        function parseUserAgentSec($userAgent) {
                                            $os = 'Unknown OS';
                                            $browser = 'Unknown Browser';
                                            $icon = 'laptop';

                                            if (preg_match('/windows/i', $userAgent)) { $os = 'Windows'; $icon = 'laptop'; }
                                            elseif (preg_match('/mac/i', $userAgent)) { $os = 'macOS'; $icon = 'monitor'; }
                                            elseif (preg_match('/linux/i', $userAgent)) { $os = 'Linux'; $icon = 'terminal-square'; }
                                            elseif (preg_match('/android/i', $userAgent)) { $os = 'Android'; $icon = 'smartphone'; }
                                            elseif (preg_match('/iphone|ipad/i', $userAgent)) { $os = 'iOS'; $icon = 'smartphone'; }

                                            if (preg_match('/chrome|crios/i', $userAgent) && !preg_match('/edge|edg|opr/i', $userAgent)) { $browser = 'Chrome'; }
                                            elseif (preg_match('/firefox|fxios/i', $userAgent)) { $browser = 'Firefox'; }
                                            elseif (preg_match('/safari/i', $userAgent) && !preg_match('/chrome|crios/i', $userAgent)) { $browser = 'Safari'; }
                                            elseif (preg_match('/edge|edg/i', $userAgent)) { $browser = 'Edge'; }
                                            elseif (preg_match('/opr|opera/i', $userAgent)) { $browser = 'Opera'; }

                                            return ['text' => $os . ' • ' . $browser, 'icon' => $icon];
                                        }
                                    }
                                @endphp

                                @if(isset($sessions) && $sessions->count() > 0)
                                    @foreach($sessions as $session)
                                        @php
                                            $agent = parseUserAgentSec($session->user_agent);
                                            $isCurrentDevice = $session->id === session()->getId();
                                        @endphp
                                        <div class="settings-session-item {{ $isCurrentDevice ? 'current' : '' }}">
                                            <div class="settings-session-info">
                                                <div style="background: white; border: 1px solid #e2e8f0; width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: #003178;">
                                                    <i data-lucide="{{ $agent['icon'] }}" width="20"></i>
                                                </div>
                                                <div class="settings-session-text">
                                                    <h5>
                                                        {{ $agent['text'] }}
                                                        @if($isCurrentDevice)
                                                            <span style="color: #003178; font-size: 0.8rem; font-weight: 700;">(Perangkat Ini)</span>
                                                        @endif
                                                    </h5>
                                                    <p>IP {{ $session->ip_address }} • Aktivitas: {{ \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                            @if($isCurrentDevice)
                                                <span class="status-badge">Aktif</span>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div style="text-align: center; padding: 32px; color: #64748b; font-weight: 600;">Data sesi tidak tersedia.</div>
                                @endif
                            </div>

                            @if(isset($sessions) && $sessions->count() > 1)
                                <form action="{{ route('settings.security.logout-other') }}" method="POST" style="margin-top: 32px; display: flex; justify-content: flex-end;">
                                    @csrf
                                    <button type="submit" class="btn-primary-custom" style="background: #dc2626;">
                                        <i data-lucide="log-out" width="16"></i>
                                        Logout Semua Perangkat Lain
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            <!-- Global Footer -->
            <div style="margin-top: auto; padding: 24px; background: white; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; font-size: 0.75rem; color: #64748b;">
                <div>&copy; 2026 Dinas Kependudukan dan Pencatatan Sipil Kota Tegal. All rights reserved.</div>
                <div style="display:flex; gap:16px;">
                    <a href="#" style="color:#64748b; text-decoration:none;">Kebijakan Privasi</a>
                    <a href="#" style="color:#64748b; text-decoration:none;">Syarat & Ketentuan</a>
                </div>
            </div>
        </main>
    </div>

    <!-- Toast Container -->
    <div id="toastContainer" style="position: fixed; top: 24px; right: 24px; z-index: 9999; display: flex; flex-direction: column; gap: 12px;"></div>

    <script>
        lucide.createIcons();

        // Premium Toast Notification
        function showToast(message, iconName = 'bell', type = 'success') {
            const container = document.getElementById('toastContainer');
            if (!container) return;
            
            const toast = document.createElement('div');
            toast.className = `p-4 rounded-xl shadow-lg flex items-center gap-3 transform transition-all duration-300 translate-y-[-20px] opacity-0 ${type === 'success' ? 'bg-white border-l-4 border-emerald-500' : 'bg-white border-l-4 border-amber-500'}`;
            
            toast.innerHTML = `
                <div class="${type === 'success' ? 'bg-emerald-50 text-emerald-500' : 'bg-amber-50 text-amber-500'} flex items-center justify-center shrink-0" style="width: 32px; height: 32px; border-radius: 8px;">
                    <i data-lucide="${iconName}" width="16"></i>
                </div>
                <span style="font-size: 0.9rem; font-weight: 600; color: #0f172a;">${message}</span>
            `;
            
            container.appendChild(toast);
            lucide.createIcons();
            
            setTimeout(() => {
                toast.classList.remove('translate-y-[-20px]', 'opacity-0');
            }, 50);
            
            setTimeout(() => {
                toast.classList.add('translate-y-[-20px]', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 3500);
        }
    </script>
</body>
</html>
