@extends('layouts.panel')

@section('title', 'Profil - SI JEBOL')

@section('content')
<style>
    :root {
        --primary: #003178;
        --accent: #f59e0b;
    }

    .profil-header {
        background: linear-gradient(135deg, var(--primary) 0%, #0044a8 100%);
        border-radius: 0;
        color: white;
        padding: 36px 48px;
        position: relative;
        overflow: hidden;
        margin: -2rem -2rem 32px -2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 10px 30px rgba(0, 49, 120, 0.15);
        border-bottom: 6px solid var(--accent);
    }

    .profil-header::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url('{{ asset("images/batik-tegal-premium.jpg") }}');
        background-size: cover;
        background-position: center;
        opacity: 0.15;
        mix-blend-mode: overlay;
        pointer-events: none;
    }

    .profil-title-wrap {
        position: relative;
        z-index: 10;
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .profil-avatar-container {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid white;
        background-color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .profil-avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profil-title {
        font-size: 1.8rem;
        font-weight: 800;
        margin: 0 0 4px 0;
        line-height: 1.2;
    }

    .profil-subtitle {
        font-size: 0.95rem;
        color: rgba(255,255,255,0.85);
        margin: 0;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 24px;
    }

    @media (max-width: 768px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }

    .card-panel {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid #f1f5f9;
    }

    .field-group {
        margin-bottom: 20px;
    }

    .field-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .field-input, .field-textarea {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #334155;
        background-color: #f8fafc;
        outline: none;
    }

    .field-input[readonly], .field-textarea[readonly] {
        background-color: #f1f5f9;
        color: #64748b;
        cursor: not-allowed;
    }
</style>

<!-- Header -->
<div class="profil-header">
    <div class="profil-title-wrap">
        <div class="profil-avatar-container">
            @if($user->foto_profil)
                <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Avatar" class="profil-avatar-img">
            @else
                <i data-lucide="user" style="width: 32px; height: 32px; color: var(--primary);"></i>
            @endif
        </div>
        <div>
            <h1 class="profil-title">Profil Pengguna</h1>
            <p class="profil-subtitle">Informasi profil akun Anda (Read-Only)</p>
        </div>
    </div>
</div>

<div class="profile-grid">
    <!-- Left Column: Summary Card -->
    <div class="card-panel" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
        <div style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; margin-bottom: 16px; border: 4px solid var(--primary-light, #e0eaff); display: flex; align-items: center; justify-content: center; background: #f8fafc;">
            @if($user->foto_profil)
                <img src="{{ asset('storage/' . $user->foto_profil) }}" alt="Avatar" style="width:100%; height:100%; object-fit:cover;">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'Cabang') }}&background=003178&color=ffffff&bold=true" alt="Avatar" style="width:100%; height:100%; object-fit:cover;">
            @endif
        </div>
        
        <h3 style="font-size: 1.25rem; font-weight: 800; color: #1e293b; margin: 0 0 4px 0;">{{ $user->name ?? 'Cabang Dinas User' }}</h3>
        <p style="font-size: 0.85rem; color: #64748b; margin: 0 0 16px 0;">Petugas Cabang Dinas Pendidikan</p>
        
        <span style="background-color: #dcfce7; color: #15803d; padding: 6px 16px; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Aktif</span>

        <div style="width: 100%; border-top: 1px solid #e2e8f0; margin-top: 24px; padding-top: 24px; text-align: left;">
            <div style="margin-bottom: 16px;">
                <span style="font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase;">Email</span>
                <div style="font-size: 0.9rem; font-weight: 600; color: #334155;">{{ $user->email ?? 'petugas.cabang@dindik.tegalkota.go.id' }}</div>
            </div>
            <div>
                <span style="font-size: 0.75rem; font-weight: 700; color: #94a3b8; text-transform: uppercase;">Bergabung Sejak</span>
                <div style="font-size: 0.9rem; font-weight: 600; color: #334155;">{{ $user->created_at ? $user->created_at->translatedFormat('d F Y') : '20 Mei 2025' }}</div>
            </div>
        </div>
    </div>

    <!-- Right Column: Detail Fields -->
    <div class="card-panel">
        <h3 style="font-size: 1.1rem; font-weight: 800; color: #1e293b; margin: 0 0 24px 0; border-bottom: 1px solid #e2e8f0; padding-bottom: 12px; display: flex; align-items: center; gap: 8px;">
            <i data-lucide="shield-check" style="color: var(--primary); width: 22px; height: 22px;"></i> Informasi Detail Akun
        </h3>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="field-group">
                <span class="field-label">Nama Lengkap</span>
                <div style="position: relative; display: flex; align-items: center;">
                    <i data-lucide="user" style="position: absolute; left: 14px; color: #94a3b8; width: 18px; height: 18px;"></i>
                    <input type="text" value="{{ $user->name }}" class="field-input" style="padding-left: 42px;" readonly>
                </div>
            </div>
            
            <div class="field-group">
                <span class="field-label">Username</span>
                <div style="position: relative; display: flex; align-items: center;">
                    <i data-lucide="user-check" style="position: absolute; left: 14px; color: #94a3b8; width: 18px; height: 18px;"></i>
                    <input type="text" value="{{ $user->username ?? 'petugas.cabang' }}" class="field-input" style="padding-left: 42px;" readonly>
                </div>
            </div>
            
            <div class="field-group">
                <span class="field-label">Email</span>
                <div style="position: relative; display: flex; align-items: center;">
                    <i data-lucide="mail" style="position: absolute; left: 14px; color: #94a3b8; width: 18px; height: 18px;"></i>
                    <input type="email" value="{{ $user->email ?? 'petugas.cabang@dindik.tegalkota.go.id' }}" class="field-input" style="padding-left: 42px;" readonly>
                </div>
            </div>
            
            <div class="field-group">
                <span class="field-label">Nomor Handphone</span>
                <div style="position: relative; display: flex; align-items: center;">
                    <i data-lucide="phone" style="position: absolute; left: 14px; color: #94a3b8; width: 18px; height: 18px;"></i>
                    <input type="text" value="{{ $user->phone ?? '0812-3456-7890' }}" class="field-input" style="padding-left: 42px;" readonly>
                </div>
            </div>
            
            <div class="field-group">
                <span class="field-label">Wilayah / Kecamatan</span>
                <div style="position: relative; display: flex; align-items: center;">
                    <i data-lucide="map-pin" style="position: absolute; left: 14px; color: #94a3b8; width: 18px; height: 18px;"></i>
                    <input type="text" value="{{ $user->kecamatan ?? 'Kecamatan Tegal Timur' }}" class="field-input" style="padding-left: 42px;" readonly>
                </div>
            </div>
            
            <div class="field-group">
                <span class="field-label">Peran (Role)</span>
                <div style="position: relative; display: flex; align-items: center;">
                    <i data-lucide="lock" style="position: absolute; left: 14px; color: #94a3b8; width: 18px; height: 18px;"></i>
                    <input type="text" value="{{ $user->role === 'cabang_dinas' ? 'Petugas Cabang' : 'Petugas' }}" class="field-input" style="padding-left: 42px;" readonly>
                </div>
            </div>
            
            <div class="field-group" style="grid-column: span 2; margin-bottom: 0;">
                <span class="field-label">Alamat Kantor</span>
                <div style="position: relative; display: flex; align-items: flex-start;">
                    <i data-lucide="building" style="position: absolute; left: 14px; top: 12px; color: #94a3b8; width: 18px; height: 18px;"></i>
                    <textarea class="field-textarea" rows="3" style="padding-left: 42px;" readonly>{{ $user->alamat ?? 'Jl. Ki Gede Sebayu No.12, Kota Tegal, Jawa Tengah 52121' }}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
