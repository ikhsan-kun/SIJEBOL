<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - SI JEBOL</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --primary: #003178;
            --accent: #f59e0b;
        }

        body {
            background-color: #f8faff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
        }

        .main-content {
            flex-grow: 1;
            margin-left: 260px;
            padding: 80px 0 0 0;
            transition: all 0.3s ease;
            display: flex; flex-direction: column; min-height: 100vh;
}

        @media (max-width: 1024px) {
            .main-content {
                margin-left: 0;
                padding: 80px 0 0 0;
                display: flex; flex-direction: column; min-height: 100vh;
}
        }

        .profile-card-premium {
            background: white;
            border-radius: 0;
            overflow: hidden;
            box-shadow: none;
            border: none;
            width: 100%;
            min-height: calc(100vh - 80px);
        }

        .profile-cover {
            height: 240px;
            background-color: var(--primary);
            background-image: linear-gradient(rgba(0, 49, 120, 0.8), rgba(0, 49, 120, 0.9)), url('{{ asset('images/batik-tegal-premium.jpg') }}');
            background-size: 600px;
            background-position: center;
            position: relative;
            border-bottom: 4px solid var(--accent);
        }

        .profile-header-content {
            padding: 0 48px;
            margin-top: -60px;
            position: relative;
            z-index: 10;
            display: flex;
            align-items: flex-end;
            gap: 32px;
            margin-bottom: 48px;
        }

        .profile-avatar-large {
            width: 160px;
            height: 160px;
            background: white;
            border: 6px solid white;
            border-radius: 48px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            font-weight: 900;
            color: var(--primary);
        }

        .profile-avatar-large img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-name-section h1 {
            font-size: 2.25rem;
            font-weight: 900;
            color: #0f172a;
            letter-spacing: -1px;
            margin-bottom: 8px;
        }

        .profile-name-section p {
            font-size: 1.1rem;
            color: #64748b;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .profile-details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 40px;
            padding: 0 48px 48px;
        }

        .detail-item-v2 {
            display: flex;
            gap: 20px;
        }

        .detail-icon-box {
            width: 54px;
            height: 54px;
            background: #f1f5f9;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            flex-shrink: 0;
        }

        .detail-info label {
            display: block;
            font-size: 0.75rem;
            font-weight: 800;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
        }

        .detail-info p {
            font-size: 1rem;
            font-weight: 700;
            color: #1e293b;
        }

        .stats-strip {
            background: #fcfdfe;
            border-top: 1px solid #f1f5f9;
            padding: 32px 48px;
            display: flex;
            gap: 48px;
        }

        .stat-small {
            display: flex;
            flex-direction: column;
        }

        .stat-small span {
            font-size: 0.7rem;
            font-weight: 800;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .stat-small strong {
            font-size: 1.25rem;
            font-weight: 900;
            color: var(--primary);
        }

        .btn-edit-profile-v2 {
            background: var(--primary);
            color: white;
            padding: 14px 28px;
            border-radius: 16px;
            font-weight: 800;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
            margin-left: auto;
            border: none;
            cursor: pointer;
        }

        .btn-edit-profile-v2:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 49, 120, 0.2);
        }

        @media (max-width: 768px) {
            .profile-cover { height: 160px; }
            .profile-header-content { 
                flex-direction: column; 
                align-items: center; 
                text-align: center; 
                padding: 0 24px;
                margin-top: -80px;
            }
            .profile-avatar-large { width: 140px; height: 140px; border-radius: 32px; }
            .profile-details-grid { grid-template-columns: 1fr; padding: 0 24px 32px; gap: 24px; }
            .profile-header-content { gap: 16px; }
            .btn-edit-profile-v2 { margin: 16px auto 0; width: 100%; justify-content: center; }
            .stats-strip { flex-direction: column; gap: 20px; padding: 32px 24px; }
            .profile-name-section h1 { font-size: 1.75rem; }
        }
    </style>
</head>
<body x-data="{ sidebarOpen: false }">
    <div class="dashboard-layout jbl-1293">
        @include('partials.sidebar-masyarakat')

        <main class="main-content">
            <div class="profile-card-premium">
                <!-- Cover -->
                <div class="profile-cover"></div>

                <!-- Header Content -->
                <div class="profile-header-content">
                    <div class="profile-avatar-large">
                        @if(auth()->user()->foto_profil ?? auth()->user()->profile_photo_path)
                            <img src="{{ asset('storage/' . (auth()->user()->foto_profil ?? auth()->user()->profile_photo_path)) }}" alt="Profile Photo">
                        @else
                            {{ strtoupper(substr(auth()->user()->nama ?? auth()->user()->name ?? 'U', 0, 2)) }}
                        @endif
                    </div>
                    <div class="profile-name-section">
                        <div class="jbl-1293 jbl-1426 jbl-985 jbl-1429">
                            <span class="jbl-451 jbl-678 jbl-1105 jbl-586 jbl-1462 jbl-1471 jbl-525 jbl-145 jbl-835">Warga Digital</span>
                            <span class="jbl-1452 jbl-416 jbl-1105 jbl-586 jbl-1462 jbl-1471 jbl-525 jbl-145 jbl-835">Terverifikasi</span>
                        </div>
                        <h1>{{ auth()->user()->nama ?? auth()->user()->name ?? 'Pengguna' }}</h1>
                        <p>
                            <i data-lucide="map-pin" width="18"></i>
                            {{ auth()->user()->kecamatan ?? 'Kota Tegal' }}, Jawa Tengah
                        </p>
                    </div>
                    <a href="{{ route('masyarakat.settings') }}" class="btn-edit-profile-v2">
                        <i data-lucide="edit-3" width="18"></i>
                        Ubah Profil
                    </a>
                </div>

                <!-- Details Grid -->
                <div class="profile-details-grid">
                    <div class="detail-item-v2">
                        <div class="detail-icon-box"><i data-lucide="credit-card" width="24"></i></div>
                        <div class="detail-info">
                            <label>Nomor NIK</label>
                            <p>{{ auth()->user()->nik }}</p>
                        </div>
                    </div>
                    <div class="detail-item-v2">
                        <div class="detail-icon-box"><i data-lucide="mail" width="24"></i></div>
                        <div class="detail-info">
                            <label>Email Terdaftar</label>
                            <p class="jbl-159">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <div class="detail-item-v2">
                        <div class="detail-icon-box"><i data-lucide="phone" width="24"></i></div>
                        <div class="detail-info">
                            <label>Nomor WhatsApp</label>
                            <p>{{ auth()->user()->phone ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="detail-item-v2">
                        <div class="detail-icon-box"><i data-lucide="home" width="24"></i></div>
                        <div class="detail-info">
                            <label>Kecamatan</label>
                            <p>{{ auth()->user()->kecamatan ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="detail-item-v2 jbl-1010">
                        <div class="detail-icon-box"><i data-lucide="map" width="24"></i></div>
                        <div class="detail-info">
                            <label>Alamat Lengkap</label>
                            <p>{{ auth()->user()->alamat_lengkap ?? 'Alamat belum dilengkapi.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Stats Strip -->
                <div class="stats-strip">
                    <div class="stat-small">
                        <span>Total Layanan</span>
                        <strong>{{ \App\Models\PengajuanLayanan::where('nik', auth()->user()->nik)->count() }}</strong>
                    </div>
                    <div class="stat-small">
                        <span>Bergabung Sejak</span>
                        <strong>{{ auth()->user()->created_at->format('M Y') }}</strong>
                    </div>
                    <div class="stat-small">
                        <span>Status Akun</span>
                        <strong class="jbl-625">Aktif</strong>
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

    <script>
        lucide.createIcons();
    </script>
</body>
</html>

