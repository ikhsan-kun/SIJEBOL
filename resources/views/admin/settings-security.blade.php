@extends('layouts.panel')

@section('title', 'Keamanan Akun - Settings')

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
        margin-bottom: 24px;
    }
    .device-card {
        padding: 20px; border: 1px solid #f1f5f9; border-radius: 16px; display: flex; align-items: flex-start; gap: 16px;
    }
    .device-icon {
        width: 48px; height: 48px; background: #f8fafc; border-radius: 12px; display: grid; place-items: center; color: var(--text-muted);
    }
    .device-info h4 { margin: 0 0 4px; font-weight: 700; font-size: 1rem; }
    .device-info p { margin: 0 0 8px; font-size: 0.85rem; color: var(--text-muted); }
    .badge-active { background: #eff6ff; color: #2563eb; padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; display: inline-block; }
    
    .history-item {
        padding: 16px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;
    }
    .history-item:last-child { border-bottom: none; }
    .history-status { width: 8px; height: 8px; border-radius: 50%; margin-right: 12px; flex-shrink: 0; }
    .status-success { background: #10b981; }
    .status-failed { background: #ef4444; }
</style>

<div class="settings-header">
    <div style="position: relative; z-index: 10; display: flex; align-items: center; gap: 24px;">
        <div style="width: 64px; height: 64px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 20px; display: grid; place-items: center;">
            <i data-lucide="shield" style="width: 32px; height: 32px;"></i>
        </div>
        <div>
            <h1 style="margin: 0 0 8px; font-size: 2rem; font-weight: 800;">Keamanan Akun</h1>
            <p style="margin: 0; font-size: 1.1rem; opacity: 0.9;">Pantau aktivitas login dan perangkat Anda.</p>
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

        <a href="{{ route('admin.settings.security') ?? '#' }}" class="settings-item active">
            <div class="settings-icon"><i data-lucide="shield"></i></div>
            <div class="settings-text">
                <h3>Keamanan</h3><p>Aktivitas perangkat</p>
            </div>
        </a>
    </div>

    <!-- Main Content -->
    <div>
        <div class="settings-content-card">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
                <i data-lucide="monitor-smartphone" style="color: var(--primary);"></i>
                <h2 style="margin: 0; font-size: 1.25rem; font-weight: 800;">Perangkat yang Terhubung</h2>
            </div>
            
            <div class="device-card">
                <div class="device-icon"><i data-lucide="laptop"></i></div>
                <div class="device-info">
                    @php
                        $userAgent = request()->userAgent();
                        $browser = 'Unknown Browser';
                        $os = 'Unknown OS';

                        if (preg_match('/(?:MSIE |Trident\/.*; rv:|Edge\/|Edg\/)(\d+)/', $userAgent)) $browser = 'Edge';
                        elseif (preg_match('/Chrome\/(\d+)/', $userAgent)) $browser = 'Chrome';
                        elseif (preg_match('/Firefox\/(\d+)/', $userAgent)) $browser = 'Firefox';
                        elseif (preg_match('/Safari\//', $userAgent) && !preg_match('/Chrome\//', $userAgent)) $browser = 'Safari';

                        if (preg_match('/windows|win32/i', $userAgent)) $os = 'Windows';
                        elseif (preg_match('/macintosh|mac os x/i', $userAgent)) $os = 'Mac OS';
                        elseif (preg_match('/linux/i', $userAgent)) $os = 'Linux';
                        elseif (preg_match('/android/i', $userAgent)) $os = 'Android';
                        elseif (preg_match('/iphone|ipad|ipod/i', $userAgent)) $os = 'iOS';
                    @endphp
                    <h4>{{ $os }} - {{ $browser }} <span class="badge-active" style="margin-left: 8px;">Perangkat Ini</span></h4>
                    <p>IP: {{ request()->ip() }}</p>
                    <span style="font-size: 0.8rem; font-weight: 600; color: #10b981;">Sedang Aktif</span>
                </div>
            </div>
        </div>

        <div class="settings-content-card" style="padding: 0;">
            <div style="padding: 24px 32px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 12px;">
                <i data-lucide="history" style="color: var(--primary);"></i>
                <h2 style="margin: 0; font-size: 1.25rem; font-weight: 800;">Riwayat Login Terakhir</h2>
            </div>
            
            <div>
                @forelse($histories ?? [] as $history)
                <div class="history-item">
                    <div style="display: flex; align-items: center;">
                        <div class="history-status {{ $history->status == 'Berhasil' ? 'status-success' : 'status-failed' }}"></div>
                        <div>
                            <h4 style="margin: 0 0 4px; font-weight: 700; font-size: 0.95rem;">Login {{ $history->status }}</h4>
                            <p style="margin: 0; font-size: 0.8rem; color: var(--text-muted);">{{ Str::limit($history->user_agent, 40) }} (IP: {{ $history->ip_address ?? 'Unknown' }})</p>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <span style="font-size: 0.85rem; font-weight: 600; color: var(--text-muted);">{{ \Carbon\Carbon::parse($history->login_at)->translatedFormat('d F Y, H:i') }} WIB</span>
                    </div>
                </div>
                @empty
                <div style="padding: 40px; text-align: center; color: var(--text-muted);">
                    <i data-lucide="shield-check" style="width: 48px; height: 48px; opacity: 0.5; margin-bottom: 12px;"></i>
                    <p style="margin: 0; font-weight: 600;">Belum ada riwayat login tercatat.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
