@extends('layouts.panel')

@section('title', 'Notifikasi - Settings')

@section('content')
<style>
    .settings-header {
        background: linear-gradient(135deg, var(--primary) 0%, #0044a8 100%);
        border-radius: 24px;
        color: white;
        padding: 40px;
        position: relative;
        overflow: hidden;
        margin-bottom: 30px;
        box-shadow: 0 10px 25px -5px rgba(0, 49, 120, 0.3);
    }
    .settings-header::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: url('{{ asset("images/batik-tegal-premium.jpg") }}');
        background-size: 400px;
        opacity: 0.12;
        mix-blend-mode: luminosity;
    }
    .settings-container {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 30px;
        align-items: start;
    }
    .settings-sidebar {
        background: white;
        border-radius: 24px;
        box-shadow: 0 4px 20px -5px rgba(0,0,0,0.05);
        padding: 12px;
    }
    .settings-item {
        display: flex;
        align-items: center;
        padding: 16px;
        border-radius: 16px;
        transition: all 0.2s;
        text-decoration: none;
        color: var(--text-main);
        margin-bottom: 8px;
    }
    .settings-item:last-child { margin-bottom: 0; }
    .settings-item:hover, .settings-item.active { background: #f8fafc; }
    .settings-item.active { background: #eff6ff; color: #2563eb; }
    .settings-icon {
        width: 40px; height: 40px; border-radius: 12px;
        background: #eff6ff; color: #2563eb;
        display: grid; place-items: center;
        margin-right: 16px; flex-shrink: 0;
    }
    .settings-item.active .settings-icon { background: #2563eb; color: white; }
    .settings-text h3 { margin: 0 0 4px; font-size: 0.95rem; font-weight: 700; }
    .settings-text p { margin: 0; font-size: 0.8rem; color: var(--text-muted); }
    .settings-content-card {
        background: white; border-radius: 24px;
        box-shadow: 0 4px 20px -5px rgba(0,0,0,0.05); padding: 32px;
    }
    .btn-primary {
        background: var(--primary); color: white; padding: 12px 24px;
        border-radius: 12px; font-weight: 700; border: none; cursor: pointer;
        display: flex; align-items: center; gap: 8px; transition: all 0.2s;
    }
    .btn-primary:hover { background: #002255; transform: translateY(-2px); }
    .form-group { margin-bottom: 24px; }
    .form-label { display: block; font-weight: 700; margin-bottom: 8px; color: var(--text-main); }
    .form-input { width: 100%; padding: 12px 16px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 0.95rem; transition: all 0.2s; background: #f8fafc; }
    .form-input:focus { border-color: #3b82f6; outline: none; box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1); background: white; }
    .alert-info {
        background: #eff6ff; color: #1e3a8a; padding: 16px; border-radius: 12px;
        display: flex; align-items: flex-start; gap: 12px; margin-bottom: 24px;
    }
</style>

<div class="settings-header">
    <div style="position: relative; z-index: 10; display: flex; align-items: center; gap: 24px;">
        <div style="width: 64px; height: 64px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 20px; display: grid; place-items: center;">
            <i data-lucide="bell" style="width: 32px; height: 32px;"></i>
        </div>
        <div>
            <h1 style="margin: 0 0 8px; font-size: 2rem; font-weight: 800;">Pengaturan Notifikasi</h1>
            <p style="margin: 0; font-size: 1.1rem; opacity: 0.9;">Kelola gateway pengiriman email dan pesan otomatis.</p>
        </div>
    </div>
</div>

<div class="settings-container">
    <!-- Sidebar Menu -->
    <div class="settings-sidebar">

        <a href="{{ route('admin.settings.users') }}" class="settings-item">
            <div class="settings-icon"><i data-lucide="users"></i></div>
            <div class="settings-text">
                <h3>Pengguna</h3><p>Kelola akses admin</p>
            </div>
        </a>
        <a href="{{ route('admin.settings.notifications_page') ?? '#' }}" class="settings-item active">
            <div class="settings-icon"><i data-lucide="bell"></i></div>
            <div class="settings-text">
                <h3>Notifikasi</h3><p>Email dan pesan</p>
            </div>
        </a>
        <a href="{{ route('admin.settings.security') ?? '#' }}" class="settings-item">
            <div class="settings-icon"><i data-lucide="shield"></i></div>
            <div class="settings-text">
                <h3>Keamanan</h3><p>Aktivitas perangkat</p>
            </div>
        </a>
    </div>

    <!-- Main Content -->
    <div class="settings-content-card">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
            <i data-lucide="bell" style="color: var(--primary);"></i>
            <h2 style="margin: 0; font-size: 1.25rem; font-weight: 800;">Pengaturan Gateway</h2>
        </div>
        
        @if(session('success'))
            <div style="background: #10b981; color: white; padding: 12px 16px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 8px;">
                <i data-lucide="check-circle" style="width: 20px; height: 20px;"></i>
                <span style="font-weight: 600;">{{ session('success') }}</span>
            </div>
        @endif

        <div class="alert-info">
            <i data-lucide="info" style="flex-shrink: 0; margin-top: 2px;"></i>
            <div>
                <p style="margin: 0; font-size: 0.9rem; line-height: 1.5;">Pengaturan ini digunakan untuk mengirim pesan notifikasi otomatis saat status permohonan layanan berubah (misalnya: disetujui, ditolak, atau dijadwalkan).</p>
            </div>
        </div>

        <form action="{{ route('admin.settings.gateway') }}" method="POST">
            @csrf
            @php
                $appSettings = \Illuminate\Support\Facades\DB::table('app_settings')->first();
                $notif = $appSettings ? json_decode($appSettings->notification_settings, true) : [];
            @endphp
            
            <div class="form-group">
                <label class="form-label">Nama Pengirim Email</label>
                <div style="position: relative;">
                    <i data-lucide="mail" style="position: absolute; left: 16px; top: 14px; color: #94a3b8; width: 18px; height: 18px;"></i>
                    <input type="text" name="email_sender_name" value="{{ $notif['email_sender_name'] ?? 'Admin SI JEBOL' }}" class="form-input" style="padding-left: 44px;">
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: 32px;">
                <button type="submit" class="btn-primary">
                    <i data-lucide="save"></i> Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
