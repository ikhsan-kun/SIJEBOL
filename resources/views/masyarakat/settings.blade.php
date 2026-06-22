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

        .settings-avatar-section {
            display: flex;
            align-items: center;
            gap: 32px;
            margin-bottom: 40px;
            padding-bottom: 32px;
            border-bottom: 1px solid #e2e8f0;
        }

        .settings-avatar-info {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .avatar-wrapper { position: relative; width: 120px; height: 120px; }
        .avatar-glow { position: absolute; inset: -4px; border-radius: 50%; background: linear-gradient(135deg, #003178, #f59e0b); opacity: 0.2; filter: blur(10px); }
        .avatar-container-circle { width: 100%; height: 100%; border-radius: 50%; background: #eff6ff; border: 4px solid white; box-shadow: 0 10px 25px rgba(15, 23, 42, 0.1); display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative; font-size: 2.5rem; font-weight: 900; color: #003178; z-index: 2; }
        .avatar-img { width: 100%; height: 100%; object-fit: cover; }
        .avatar-overlay-upload { position: absolute; inset: 0; background: rgba(0, 49, 120, 0.8); display: flex; flex-direction: column; align-items: center; justify-content: center; color: white; opacity: 0; transition: all 0.3s ease; cursor: pointer; z-index: 3; font-size: 0.75rem; font-weight: 700; border-radius: 50%; }
        .avatar-wrapper:hover .avatar-overlay-upload { opacity: 1; }

        .settings-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
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
        .input-icon-box input:disabled { background: #e2e8f0; color: #64748b; border-color: #cbd5e1; cursor: not-allowed; }

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

        .btn-secondary-custom {
            background: #f1f5f9;
            color: #475569;
            padding: 10px 16px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        .btn-secondary-custom:hover {
            background: #e2e8f0;
        }

        .btn-danger-custom {
            background: #fee2e2;
            color: #dc2626;
            padding: 10px 16px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-danger-custom:hover {
            background: #fecaca;
        }

        @media (max-width: 1024px) {
            .settings-container {
                grid-template-columns: 1fr;
                padding: 32px 24px;
            }
        }

        @media (max-width: 768px) {
            .settings-avatar-section {
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 20px;
            }
            .settings-form-grid {
                grid-template-columns: 1fr;
            }
            .glass-card {
                padding: 24px;
            }
            .settings-avatar-info {
                align-items: center;
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

                    @if($errors->any() && !($errors->has('current_password') || $errors->has('password')))
                        <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 16px; border-radius: 12px; color: #991b1b;">
                            <div style="display: flex; align-items: center; gap: 12px; font-weight: 700; margin-bottom: 8px;">
                                <i data-lucide="alert-circle" width="20"></i>
                                <span>Gagal memperbarui data:</span>
                            </div>
                            <ul style="margin: 0 0 0 20px; padding: 0; font-size: 0.9rem;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="glass-card">
                        <div class="settings-card-header">
                            <i data-lucide="user" width="22" style="color: #003178;"></i>
                            <h2>Informasi Akun</h2>
                        </div>

                        <!-- Profile Hero / Avatar Section -->
                        <div class="settings-avatar-section">
                            <div class="avatar-wrapper">
                                <div class="avatar-glow"></div>
                                <div class="avatar-container-circle" id="avatarPreview">
                                    @if(auth()->user()->foto_profil ?? auth()->user()->profile_photo_path)
                                        <img src="{{ asset('storage/' . (auth()->user()->foto_profil ?? auth()->user()->profile_photo_path)) }}" alt="Profile Photo" class="avatar-img">
                                    @else
                                        {{ strtoupper(substr(auth()->user()->nama ?? auth()->user()->name, 0, 2)) }}
                                    @endif
                                </div>
                                <div class="avatar-overlay-upload" onclick="document.getElementById('photoInput').click()">
                                    <i data-lucide="camera" width="24" style="color: white; margin-bottom: 4px;"></i>
                                    <span>Ubah Foto</span>
                                </div>
                            </div>
                            
                            <div class="settings-avatar-info">
                                <div style="display: flex; gap: 12px; align-items: center;">
                                    <button onclick="document.getElementById('photoInput').click()" type="button" class="btn-secondary-custom">
                                        <i data-lucide="image" width="14"></i>
                                        Pilih Foto Baru
                                    </button>

                                    @if(auth()->user()->foto_profil ?? auth()->user()->profile_photo_path)
                                        <form action="{{ route('masyarakat.settings.photo.delete') }}" method="POST" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger-custom">
                                                <i data-lucide="trash-2" width="14"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                                <p style="font-size: 0.8rem; color: #64748b; margin: 4px 0 0 0;">Maks. 1MB. Format: JPG, JPEG, atau PNG.</p>
                            </div>
                        </div>

                        <!-- Profile Form -->
                        <form action="{{ route('masyarakat.settings.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="profile_photo" id="photoInput" style="display: none;" onchange="previewImage(this)">

                            <div class="settings-form-grid">
                                <!-- Nama -->
                                <div class="input-group-wrapper">
                                    <label>Nama Lengkap</label>
                                    <div class="input-icon-box">
                                        <input type="text" name="name" value="{{ old('name', auth()->user()->nama ?? auth()->user()->name) }}" required>
                                        <i data-lucide="user" width="18"></i>
                                    </div>
                                    @error('name')
                                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 4px; display:block;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- NIK (Disabled as Username substitute) -->
                                <div class="input-group-wrapper">
                                    <label>NIK / Username</label>
                                    <div class="input-icon-box">
                                        <input type="text" value="{{ auth()->user()->nik }}" disabled>
                                        <i data-lucide="credit-card" width="18"></i>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="input-group-wrapper">
                                    <label>Email</label>
                                    <div class="input-icon-box">
                                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                        <i data-lucide="mail" width="18"></i>
                                    </div>
                                    @error('email')
                                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 4px; display:block;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Phone / WhatsApp -->
                                <div class="input-group-wrapper">
                                    <label>No. HP / WhatsApp</label>
                                    <div class="input-icon-box">
                                        <input type="tel" name="phone" value="{{ old('phone', auth()->user()->phone) }}" placeholder="Contoh: 08123456789">
                                        <i data-lucide="phone" width="18"></i>
                                    </div>
                                    @error('phone')
                                        <span style="color: #ef4444; font-size: 0.8rem; margin-top: 4px; display:block;">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <!-- Alamat -->
                                <div class="input-group-wrapper" style="grid-column: span 2;">
                                    <label>Alamat Domisili / Kecamatan</label>
                                    <div class="input-icon-box">
                                        <input type="text" value="{{ auth()->user()->kecamatan ?? '-' }}" disabled>
                                        <i data-lucide="map-pin" width="18"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="settings-form-actions">
                                <button type="submit" class="btn-primary-custom">
                                    <i data-lucide="save" width="16"></i>
                                    Simpan Perubahan
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
    <div class="jbl-524 jbl-510 jbl-378 jbl-929 jbl-1293 jbl-1541 jbl-985" id="toastContainer"></div>

    <script>
        lucide.createIcons();

        // Premium Toast Notification
        function showToast(message, iconName = 'bell', type = 'success') {
            const container = document.getElementById('toastContainer');
            if (!container) return;
            
            const toast = document.createElement('div');
            toast.className = `p-4 rounded-xl shadow-lg flex items-center gap-3 transform transition-all duration-300 translate-y-[-20px] opacity-0 ${type === 'success' ? 'bg-white border-l-4 border-emerald-500' : 'bg-white border-l-4 border-amber-500'}`;
            
            toast.innerHTML = `
                <div class="jbl-1374 jbl-1224 jbl-538 ${type === 'success' ? 'bg-emerald-50 text-emerald-500' : 'bg-amber-50 text-amber-500'} flex items-center justify-center shrink-0">
                    <i data-lucide="${iconName}" width="16"></i>
                </div>
                <span class="jbl-386 jbl-959 jbl-166">${message}</span>
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

        // Live state preservation
        document.addEventListener('DOMContentLoaded', () => {
            ['toggle-email', 'toggle-whatsapp', 'toggle-jadwal'].forEach(id => {
                const toggle = document.getElementById(id);
                if (toggle) {
                    toggle.addEventListener('change', (e) => {
                        if (e.target.checked) {
                            showToast('Pengaturan notifikasi diaktifkan!', 'check-circle', 'success');
                        } else {
                            showToast('Pengaturan notifikasi dinonaktifkan.', 'alert-circle', 'warning');
                        }
                    });
                }
            });
        });

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const avatarPreview = document.getElementById('avatarPreview');
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="avatar-img">`;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>

