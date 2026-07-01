@extends('layouts.masyarakat')

@push('styles')
<style>
@media (max-width: 1024px) {
            
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

        /* Interactive iOS Switch styling */
        .toggle-switch { position: relative; display: inline-block; width: 52px; height: 28px; }
        .toggle-switch input { opacity: 0; width: 0; height: 0; }
        .toggle-slider { position: absolute; cursor: pointer; inset: 0; background-color: #cbd5e1; transition: .4s; border-radius: 34px; }
        .toggle-slider:before { position: absolute; content: ""; height: 20px; width: 20px; left: 4px; bottom: 4px; background-color: white; transition: .4s; border-radius: 50%; box-shadow: 0 2px 5px rgba(0,0,0,0.15); }
        .toggle-switch input:checked + .toggle-slider { background-color: #003178; }
        .toggle-switch input:checked + .toggle-slider:before { transform: translateX(24px); }

        .notification-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .notification-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-radius: 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            transition: all 0.2s;
        }

        .notification-item-info {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .notification-item-icon {
            background: #eff6ff;
            color: #003178;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .notification-item-text h4 {
            margin: 0;
            font-size: 0.95rem;
            font-weight: 700;
            color: #0f172a;
        }

        .notification-item-text p {
            margin: 4px 0 0 0;
            font-size: 0.8rem;
            color: #64748b;
            line-height: 1.4;
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
            .notification-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
            .toggle-switch {
                align-self: flex-end;
            }
        }
</style>
@endpush

@section('content')
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
                    <div class="glass-card">
                        <div class="settings-card-header">
                            <i data-lucide="bell" width="22" style="color: #003178;"></i>
                            <h2>Preferensi Notifikasi</h2>
                        </div>

                        <div class="notification-list">
                            <!-- Email -->
                            <div class="notification-item">
                                <div class="notification-item-info">
                                    <div class="notification-item-icon">
                                        <i data-lucide="mail" width="20"></i>
                                    </div>
                                    <div class="notification-item-text">
                                        <h4>Notifikasi Email</h4>
                                        <p>Terima notifikasi penting mengenai pengajuan layanan Anda langsung melalui email.</p>
                                    </div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="toggle-email" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>

                            <!-- Pengingat Jadwal -->
                            <div class="notification-item">
                                <div class="notification-item-info">
                                    <div class="notification-item-icon">
                                        <i data-lucide="calendar-clock" width="20"></i>
                                    </div>
                                    <div class="notification-item-text">
                                        <h4>Pengingat Jadwal</h4>
                                        <p>Terima pemberitahuan dan pengingat otomatis untuk jadwal layanan keliling atau tatap muka.</p>
                                    </div>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="toggle-jadwal" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
@endsection
