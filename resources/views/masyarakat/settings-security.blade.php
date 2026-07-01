@extends('layouts.masyarakat')

@push('styles')
<style>
@media (max-width: 1024px) {
            
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary) 0%, #0044a8 100%);
            border-radius: 0;
            color: white;
            padding: 32px 40px;
            position: relative;
            overflow: hidden;
            margin: -24px -24px 24px -24px;
            box-shadow: 0 10px 30px rgba(0, 49, 120, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 6px solid var(--accent, #f59e0b);
        }

        @media (max-width: 1024px) {
            .page-header {
                flex-direction: column; text-align: center; gap: 20px;
                margin: -16px -16px 24px -16px;
                padding: 32px 20px;
            }
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

        .header-content { position: relative; z-index: 10; }
        .header-title { font-size: 1.8rem; font-weight: 800; margin: 0 0 8px 0; letter-spacing: -0.5px; display: flex; align-items: center; gap: 12px; color: white; }
        @media (max-width: 1024px) { .header-title { justify-content: center; } }
        .header-subtitle { font-size: 0.95rem; color: rgba(255,255,255,0.9); margin: 0; font-weight: 500; }

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

        .btn-danger { background: #fee2e2; color: #dc2626; padding: 12px 24px; border-radius: 12px; font-weight: 700; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s; text-decoration: none; }
        .btn-danger:hover { background: #fecaca; transform: translateY(-2px); }

        .panel-box {
            background: white;
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
            border: 1px solid #f1f5f9;
            margin-bottom: 24px;
        }

        @media (max-width: 768px) { .panel-box { padding: 24px; } }

        .form-section { margin-bottom: 32px; }
        .form-section:last-child { margin-bottom: 0; }
        
        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 0 24px 0;
            padding-bottom: 12px;
            border-bottom: 1px solid #e2e8f0;
        }

        .settings-session-list { display: flex; flex-direction: column; gap: 16px; }

        .settings-session-item {
            display: flex; justify-content: space-between; align-items: center;
            padding: 16px 20px; border-radius: 16px; background: #f8fafc; border: 1px solid #e2e8f0; transition: all 0.2s;
        }
        .settings-session-item.current { background: #eff6ff; border-color: #bfdbfe; }
        @media (max-width: 768px) { .settings-session-item { flex-direction: column; align-items: flex-start; gap: 16px; } }

        .settings-session-info { display: flex; align-items: center; gap: 16px; }

        .settings-session-text h5 { margin: 0; font-size: 0.95rem; font-weight: 700; color: #0f172a; }
        .settings-session-text p { margin: 4px 0 0 0; font-size: 0.8rem; color: #64748b; }

        .status-badge { padding: 6px 12px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; background: #ecfdf5; color: #047857; }

        .info-box-custom { background: #eff6ff; border-left: 4px solid #003178; padding: 16px; border-radius: 12px; display: flex; gap: 16px; color: #1e3a8a; margin-bottom: 24px; line-height: 1.5; }
        
        .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; font-weight: 500; }
</style>
@endpush

@section('content')
<div class="page-header">
                <div class="header-content">
                    <h1 class="header-title">
                        <i data-lucide="shield-alert" style="width: 32px; height: 32px; color: #fbbf24;"></i>
                        Keamanan & Sesi
                    </h1>
                    <p class="header-subtitle">Pantau status akun dan aktivitas sesi Anda</p>
                </div>
                <div class="header-actions">
                    <a href="{{ route('masyarakat.profile') }}" class="btn btn-light-outline">
                        <i data-lucide="arrow-left" style="width: 18px;"></i> Kembali ke Profil
                    </a>
                </div>
            </div>

            <div class="panel-box">
                @if(session('success'))
                <div class="alert-success">
                    <i data-lucide="check-circle" style="width: 20px; flex-shrink: 0;"></i>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                <div class="form-section">
                    <h3 class="section-title"><i data-lucide="shield-check" style="color: var(--primary);"></i> Status Akun</h3>

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

                <div class="form-section">
                    <h3 class="section-title"><i data-lucide="monitor" style="color: var(--primary);"></i> Sesi Login Aktif</h3>

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
                            <button type="submit" class="btn-danger">
                                <i data-lucide="log-out" width="16"></i>
                                Logout Semua Perangkat Lain
                            </button>
                        </form>
                    @endif
                </div>
            </div>
@endsection
