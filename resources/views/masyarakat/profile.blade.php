@extends('layouts.masyarakat')

@push('styles')
<style>
@media (max-width: 1024px) {
            
        }

        /* ADMIN PROFIL STYLE ADAPTED FOR MASYARAKAT */
        .page-header {
            background: linear-gradient(135deg, var(--primary) 0%, #0044a8 100%);
            border-radius: 0;
            color: white;
            padding: 40px;
            position: relative;
            overflow: hidden;
            margin: -24px -24px 24px -24px;
            box-shadow: 0 10px 30px rgba(0, 49, 120, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 6px solid var(--accent, #f59e0b);
        }

        .page-header::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url('{{ asset("images/batik-tegal-premium.jpg") }}');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
            mix-blend-mode: overlay;
            pointer-events: none;
        }

        .header-content { position: relative; z-index: 10; display: flex; align-items: center; gap: 24px; }
        
        .profile-avatar-large {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            object-fit: cover;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary);
        }
        
        .header-title { font-size: 2rem; font-weight: 800; margin: 0 0 4px 0; letter-spacing: -0.5px; color: white; }
        .header-subtitle { font-size: 1rem; color: rgba(255,255,255,0.8); margin: 0; font-weight: 500; display: flex; align-items: center; gap: 8px; }

        .header-actions { position: relative; z-index: 10; display: flex; gap: 12px; }

        .btn {
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            text-decoration: none;
        }

        .btn-light-outline { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: white; backdrop-filter: blur(5px); }
        .btn-light-outline:hover { background: rgba(255,255,255,0.2); }
        
        .btn-warning { background: #f59e0b; color: #78350f; }
        .btn-warning:hover { background: #d97706; color: white; transform: translateY(-2px); }

        .main-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 24px;
        }
        
        @media (max-width: 1024px) { 
            .main-grid { grid-template-columns: 1fr; } 
            .page-header { flex-direction: column; text-align: center; gap: 20px; margin: -16px -16px 24px -16px; }
            .header-content { flex-direction: column; text-align: center; }
        }

        .panel-box {
            background: white;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
            border: 1px solid #f1f5f9;
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 0 24px 0;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }

        .info-list { display: flex; flex-direction: column; gap: 20px; }
        
        .info-item { display: flex; align-items: flex-start; gap: 16px; }
        
        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #f8fafc;
            color: var(--primary);
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border: 1px solid #e2e8f0;
        }
        
        .info-content { flex: 1; }
        .info-label { font-size: 0.8rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
        .info-value { font-size: 1rem; font-weight: 600; color: #1e293b; }

        .stat-card {
            background: #f8fafc;
            border-radius: 16px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
            transition: all 0.2s;
        }
        .stat-card:hover { border-color: var(--primary); background: white; box-shadow: 0 4px 12px rgba(0, 49, 120, 0.05); }
        .stat-card:last-child { margin-bottom: 0; }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }
        
        .icon-success { background: #d1fae5; color: #047857; }
        .icon-primary { background: #dbeafe; color: #1d4ed8; }
        .icon-warning { background: #fef3c7; color: #d97706; }
        
        .stat-text { flex: 1; }
        .stat-title { font-size: 0.85rem; font-weight: 700; color: #64748b; margin-bottom: 4px; }
        .stat-val { font-size: 1.1rem; font-weight: 800; color: #1e293b; }
        .stat-desc { font-size: 0.8rem; color: #64748b; margin-top: 4px; }
</style>
@endpush

@section('content')
<div class="page-header">
                <div class="header-content">
                    <div class="profile-avatar-large">
                        @if(auth()->user()->foto_profil ?? auth()->user()->profile_photo_path)
                            <img src="{{ asset('storage/' . (auth()->user()->foto_profil ?? auth()->user()->profile_photo_path)) }}" alt="Avatar" style="width:100%;height:100%;object-fit:cover;border-radius:50%;">
                        @else
                            {{ strtoupper(substr(auth()->user()->nama ?? auth()->user()->name ?? 'U', 0, 2)) }}
                        @endif
                    </div>
                    <div>
                        <h1 class="header-title">{{ auth()->user()->nama ?? auth()->user()->name ?? 'Pengguna' }}</h1>
                        <p class="header-subtitle">
                            <i data-lucide="shield" style="width: 16px;"></i> Warga Digital Terverifikasi
                        </p>
                    </div>
                </div>
                <div class="header-actions">
                    <a href="{{ route('masyarakat.settings') }}" class="btn btn-warning">
                        <i data-lucide="edit-3" style="width: 18px;"></i> Ubah Profil
                    </a>
                    <a href="{{ route('masyarakat.settings.password') }}" class="btn btn-light-outline">
                        <i data-lucide="lock" style="width: 18px;"></i> Keamanan
                    </a>
                </div>
            </div>

            <div class="main-grid">
                <!-- Kolom Kiri: Informasi Detail -->
                <div>
                    <div class="panel-box">
                        <h3 class="section-title"><i data-lucide="user" style="color: var(--primary);"></i> Informasi Detail Profil</h3>
                        
                        <div class="info-list">
                            <div class="info-item">
                                <div class="info-icon"><i data-lucide="credit-card"></i></div>
                                <div class="info-content">
                                    <div class="info-label">Nomor NIK</div>
                                    <div class="info-value">{{ auth()->user()->nik }}</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon"><i data-lucide="user"></i></div>
                                <div class="info-content">
                                    <div class="info-label">Nama Lengkap</div>
                                    <div class="info-value">{{ auth()->user()->nama ?? auth()->user()->name ?? '-' }}</div>
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-icon"><i data-lucide="mail"></i></div>
                                <div class="info-content">
                                    <div class="info-label">Email Address</div>
                                    <div class="info-value">{{ auth()->user()->email ?? '-' }}</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon"><i data-lucide="phone"></i></div>
                                <div class="info-content">
                                    <div class="info-label">Nomor Handphone</div>
                                    <div class="info-value">{{ auth()->user()->no_hp ?? auth()->user()->phone ?? '-' }}</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon"><i data-lucide="home"></i></div>
                                <div class="info-content">
                                    <div class="info-label">Kecamatan Domisili</div>
                                    <div class="info-value">{{ auth()->user()->kecamatan ?? '-' }}</div>
                                </div>
                            </div>

                            <div class="info-item">
                                <div class="info-icon"><i data-lucide="map-pin"></i></div>
                                <div class="info-content">
                                    <div class="info-label">Alamat Lengkap</div>
                                    <div class="info-value">{{ auth()->user()->alamat ?? auth()->user()->alamat_lengkap ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Status & Info Akun -->
                <div>
                    <div class="panel-box">
                        <h3 class="section-title"><i data-lucide="info" style="color: var(--primary);"></i> Status Akun</h3>
                        
                        <!-- Status Aktif -->
                        <div class="stat-card">
                            <div class="stat-icon icon-success"><i data-lucide="check-circle"></i></div>
                            <div class="stat-text">
                                <div class="stat-title">Status Akun</div>
                                <div class="stat-val" style="color: #047857;">Aktif</div>
                                <div class="stat-desc">Akun Anda dalam kondisi aktif</div>
                            </div>
                        </div>

                        <!-- Role -->
                        <div class="stat-card">
                            <div class="stat-icon icon-primary"><i data-lucide="shield"></i></div>
                            <div class="stat-text">
                                <div class="stat-title">Hak Akses</div>
                                <div class="stat-val">Masyarakat</div>
                                <div class="stat-desc">Akses sebagai warga (publik)</div>
                            </div>
                        </div>

                        <!-- Bergabung Sejak -->
                        <div class="stat-card">
                            <div class="stat-icon icon-warning"><i data-lucide="calendar"></i></div>
                            <div class="stat-text">
                                <div class="stat-title">Bergabung Sejak</div>
                                <div class="stat-val" style="font-size: 0.95rem;">{{ auth()->user()->created_at ? auth()->user()->created_at->translatedFormat('d M Y') : '-' }}</div>
                                <div class="stat-desc">Tanggal pendaftaran akun</div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
@endsection
