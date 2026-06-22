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

        .settings-form-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .input-group-wrapper label {
            display: block; font-size: 0.75rem; font-weight: 800; color: #475569; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;
        }
        .input-icon-box { position: relative; display: flex; align-items: center; }
        .input-icon-box input {
            width: 100%; padding: 12px 16px 12px 44px; background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 12px; font-size: 0.95rem; font-weight: 600; color: #0f172a; transition: all 0.2s; box-sizing: border-box;
        }
        .input-icon-box input:focus { background: white; border-color: #003178; box-shadow: 0 0 0 4px rgba(0, 49, 120, 0.1); outline: none; }
        .input-icon-box .left-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; pointer-events: none; }
        .password-toggle-btn {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: color 0.2s;
        }
        .password-toggle-btn:hover {
            color: #475569;
        }
        .password-toggle-btn svg, .password-toggle-btn i {
            pointer-events: auto;
            position: static;
            transform: none;
            color: inherit;
        }

        .settings-form-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 32px;
        }

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

        .info-box-custom {
            background: #eff6ff;
            border-left: 4px solid #3b82f6;
            padding: 16px;
            border-radius: 12px;
            display: flex;
            gap: 16px;
            color: #1e3a8a;
            margin-top: 24px;
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
                    <p>Kelola pengaturan kata sandi Anda.</p>
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

                    <!-- Keamanan Akun / Ubah Password -->
                    <div class="glass-card">
                        <div class="settings-card-header">
                            <i data-lucide="shield-check" width="22" style="color: #003178;"></i>
                            <h2>Ubah Password</h2>
                        </div>

                        <form action="{{ route('masyarakat.settings.password.update') }}" method="POST">
                            @csrf
                            <div class="settings-form-grid">
                                <!-- Password Saat Ini -->
                                <div class="input-group-wrapper">
                                    <label>Password Lama</label>
                                    <div class="input-icon-box">
                                        <input type="password" name="current_password" id="current_password" placeholder="Masukkan password lama" required style="padding-right: 44px;">
                                        <i data-lucide="key-round" class="left-icon" width="18"></i>
                                        <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('current_password', this)">
                                            <i data-lucide="eye" class="eye-open-icon" width="18"></i>
                                            <i data-lucide="eye-off" class="eye-closed-icon" width="18" style="display: none;"></i>
                                        </button>
                                    </div>
                                    @error('current_password')
                                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 4px; display:block;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Password Baru -->
                                <div class="input-group-wrapper">
                                    <label>Password Baru</label>
                                    <div class="input-icon-box">
                                        <input type="password" name="password" id="password" placeholder="Masukkan password baru" required style="padding-right: 44px;">
                                        <i data-lucide="lock" class="left-icon" width="18"></i>
                                        <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('password', this)">
                                            <i data-lucide="eye" class="eye-open-icon" width="18"></i>
                                            <i data-lucide="eye-off" class="eye-closed-icon" width="18" style="display: none;"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 4px; display:block;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Konfirmasi Password Baru -->
                                <div class="input-group-wrapper">
                                    <label>Konfirmasi Password Baru</label>
                                    <div class="input-icon-box">
                                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi password baru" required style="padding-right: 44px;">
                                        <i data-lucide="check-circle" class="left-icon" width="18"></i>
                                        <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('password_confirmation', this)">
                                            <i data-lucide="eye" class="eye-open-icon" width="18"></i>
                                            <i data-lucide="eye-off" class="eye-closed-icon" width="18" style="display: none;"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="info-box-custom">
                                <i data-lucide="info" width="18" style="flex-shrink:0;"></i>
                                <div>
                                    <p style="margin:0; font-weight:700; font-size: 0.9rem;">Tips Password Aman</p>
                                    <p style="margin:4px 0 0 0; font-size: 0.8rem; color: #475569; line-height: 1.4;">Gunakan minimal 8 karakter dengan kombinasi huruf besar, huruf kecil, angka, dan simbol.</p>
                                </div>
                            </div>

                            <div class="settings-form-actions">
                                <button type="submit" class="btn-primary-custom">
                                    <i data-lucide="key" width="16"></i>
                                    Simpan Password Baru
                                </button>
                            </div>
                        </form>
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

        function togglePasswordVisibility(inputId, btn) {
            const input = document.getElementById(inputId);
            const eyeOpen = btn.querySelector('.eye-open-icon');
            const eyeClosed = btn.querySelector('.eye-closed-icon');
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.style.display = 'none';
                eyeClosed.style.display = 'block';
            } else {
                input.type = 'password';
                eyeOpen.style.display = 'block';
                eyeClosed.style.display = 'none';
            }
        }
    </script>
</body>
</html>
