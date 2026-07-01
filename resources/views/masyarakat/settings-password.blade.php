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
        
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-2px); }

        .btn-outline { background: white; border: 2px solid #e2e8f0; color: var(--text-main); padding: 12px 24px; border-radius: 12px; font-weight: 700; cursor: pointer; text-decoration: none; transition: all 0.2s; }
        .btn-outline:hover { background: #f8fafc; border-color: #cbd5e1; }

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

        .form-grid { display: grid; grid-template-columns: 1fr; gap: 24px; }

        .form-group { display: flex; flex-direction: column; gap: 8px; margin-bottom: 20px;}
        .form-group:last-child { margin-bottom: 0; }
        
        .form-label { font-size: 0.85rem; font-weight: 700; color: var(--text-main); }
        .form-control-wrapper { position: relative; display: flex; align-items: center; }
        .form-control { 
            width: 100%; 
            padding: 12px 16px 12px 44px; 
            border-radius: 12px; 
            border: 2px solid #e2e8f0; 
            background: #f8fafc; 
            font-family: inherit; 
            font-size: 0.95rem; 
            outline: none; 
            transition: all 0.2s; 
            box-sizing: border-box;
        }
        .form-control:focus { border-color: var(--primary); background: white; box-shadow: 0 0 0 4px rgba(0, 49, 120, 0.1); }
        .form-control-wrapper .left-icon { position: absolute; left: 14px; color: #94a3b8; pointer-events: none; }
        
        .password-toggle-btn {
            position: absolute;
            right: 14px;
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
        .password-toggle-btn:hover { color: #475569; }
        
        .form-hint { font-size: 0.8rem; color: var(--text-muted); margin-top: 4px; }

        .form-actions { display: flex; justify-content: flex-start; gap: 16px; margin-top: 32px; padding-top: 24px; border-top: 1px solid #e2e8f0; }
        
        .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; font-weight: 500; }
        .alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: flex-start; gap: 12px; font-weight: 500; }

        .info-box-custom { background: #eff6ff; border-left: 4px solid #3b82f6; padding: 16px; border-radius: 12px; display: flex; gap: 16px; color: #1e3a8a; margin-top: 24px; }
</style>
@endpush

@section('content')
<div class="page-header">
                <div class="header-content">
                    <h1 class="header-title">
                        <i data-lucide="shield-check" style="width: 32px; height: 32px; color: #fbbf24;"></i>
                        Ubah Password
                    </h1>
                    <p class="header-subtitle">Kelola keamanan dan kata sandi akun Anda</p>
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

                @if($errors->any() && ($errors->has('current_password') || $errors->has('password')))
                    <div class="alert-error">
                        <i data-lucide="alert-circle" style="width: 20px; flex-shrink: 0; margin-top: 2px;"></i>
                        <div>
                            <div style="font-weight: 700; margin-bottom: 8px;">Gagal memperbarui password:</div>
                            <ul style="margin: 0 0 0 20px; padding: 0; font-size: 0.9rem;">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('masyarakat.settings.password.update') }}" method="POST">
                    @csrf
                    
                    <div class="form-section">
                        <h3 class="section-title"><i data-lucide="key" style="color: var(--primary);"></i> Form Ubah Password</h3>
                        
                        <div class="form-grid">
                            <!-- Password Saat Ini -->
                            <div class="form-group">
                                <label class="form-label">Password Saat Ini *</label>
                                <div class="form-control-wrapper">
                                    <input type="password" name="current_password" id="current_password" placeholder="Masukkan password lama" class="form-control" required style="padding-right: 44px;">
                                    <i data-lucide="key-round" class="left-icon" width="18"></i>
                                    <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('current_password', this)">
                                        <i data-lucide="eye" class="eye-open-icon" width="18"></i>
                                        <i data-lucide="eye-off" class="eye-closed-icon" width="18" style="display: none;"></i>
                                    </button>
                                </div>
                                @error('current_password')<div class="form-hint" style="color: #ef4444;">{{ $message }}</div>@enderror
                            </div>

                            <!-- Password Baru -->
                            <div class="form-group">
                                <label class="form-label">Password Baru *</label>
                                <div class="form-control-wrapper">
                                    <input type="password" name="password" id="password" placeholder="Masukkan password baru" class="form-control" required style="padding-right: 44px;">
                                    <i data-lucide="lock" class="left-icon" width="18"></i>
                                    <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('password', this)">
                                        <i data-lucide="eye" class="eye-open-icon" width="18"></i>
                                        <i data-lucide="eye-off" class="eye-closed-icon" width="18" style="display: none;"></i>
                                    </button>
                                </div>
                                @error('password')<div class="form-hint" style="color: #ef4444;">{{ $message }}</div>@enderror
                            </div>

                            <!-- Konfirmasi Password Baru -->
                            <div class="form-group">
                                <label class="form-label">Konfirmasi Password Baru *</label>
                                <div class="form-control-wrapper">
                                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi password baru" class="form-control" required style="padding-right: 44px;">
                                    <i data-lucide="check-circle" class="left-icon" width="18"></i>
                                    <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('password_confirmation', this)">
                                        <i data-lucide="eye" class="eye-open-icon" width="18"></i>
                                        <i data-lucide="eye-off" class="eye-closed-icon" width="18" style="display: none;"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="info-box-custom">
                            <i data-lucide="info" width="20" style="flex-shrink:0;"></i>
                            <div>
                                <p style="margin:0; font-weight:700; font-size: 0.95rem;">Tips Password Aman</p>
                                <p style="margin:4px 0 0 0; font-size: 0.85rem; color: #475569; line-height: 1.5;">Gunakan minimal 8 karakter dengan kombinasi huruf besar, huruf kecil, angka, dan simbol untuk keamanan maksimal.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <i data-lucide="save" style="width: 18px;"></i> Simpan Password Baru
                        </button>
                        <a href="{{ route('masyarakat.profile') }}" class="btn-outline">Batal</a>
                    </div>
                </form>
            </div>
@endsection
