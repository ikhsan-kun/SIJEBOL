@extends('layouts.panel')

@section('title', 'Tentang Aplikasi - Settings')

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
    .settings-item:last-child {
        margin-bottom: 0;
    }
    .settings-item:hover, .settings-item.active {
        background: #f8fafc;
    }
    .settings-item.active {
        background: #eff6ff;
        color: #2563eb;
    }
    .settings-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: #eff6ff;
        color: #2563eb;
        display: grid;
        place-items: center;
        margin-right: 16px;
        flex-shrink: 0;
    }
    .settings-item.active .settings-icon {
        background: #2563eb;
        color: white;
    }
    .settings-text h3 {
        margin: 0 0 4px;
        font-size: 0.95rem;
        font-weight: 700;
    }
    .settings-text p {
        margin: 0;
        font-size: 0.8rem;
        color: var(--text-muted);
    }
    .settings-content-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 4px 20px -5px rgba(0,0,0,0.05);
        padding: 32px;
    }
    .form-group {
        margin-bottom: 24px;
    }
    .form-label {
        display: block;
        font-weight: 700;
        margin-bottom: 8px;
        color: var(--text-main);
    }
    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.95rem;
        transition: all 0.2s;
        background: #f8fafc;
    }
    .form-input:focus {
        border-color: #3b82f6;
        outline: none;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        background: white;
    }
    .logo-upload-area {
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        padding: 32px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        background: #f8fafc;
    }
    .logo-upload-area:hover {
        border-color: #3b82f6;
        background: white;
    }
    .logo-upload-area img {
        max-height: 100px;
        border-radius: 12px;
        margin-bottom: 16px;
    }
    .btn-primary {
        background: var(--primary);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 700;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .btn-primary:hover {
        background: #002255;
        transform: translateY(-2px);
    }
    @media (max-width: 1024px) {
        .settings-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="settings-header">
    <div style="position: relative; z-index: 10; display: flex; align-items: center; gap: 24px;">
        <div style="width: 64px; height: 64px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 20px; display: grid; place-items: center;">
            <i data-lucide="info" style="width: 32px; height: 32px;"></i>
        </div>
        <div>
            <h1 style="margin: 0 0 8px; font-size: 2rem; font-weight: 800;">Tentang Aplikasi</h1>
            <p style="margin: 0; font-size: 1.1rem; opacity: 0.9;">Kelola informasi dasar dan identitas aplikasi SI JEBOL.</p>
        </div>
    </div>
</div>

<div class="settings-container">
    <!-- Sidebar Menu -->
    <div class="settings-sidebar">
        <a href="{{ route('admin.settings.users') }}" class="settings-item">
            <div class="settings-icon">
                <i data-lucide="users"></i>
            </div>
            <div class="settings-text">
                <h3>Pengguna</h3>
                <p>Kelola akses admin</p>
            </div>
        </a>
        <a href="{{ route('admin.settings.security') ?? '#' }}" class="settings-item">
            <div class="settings-icon">
                <i data-lucide="shield"></i>
            </div>
            <div class="settings-text">
                <h3>Keamanan</h3>
                <p>Aktivitas perangkat</p>
            </div>
        </a>
    </div>

    <!-- Main Content -->
    <div class="settings-content-card">
        <form action="{{ route('admin.settings.about.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="display: grid; grid-template-columns: 200px 1fr; gap: 32px; align-items: start;">
                <div>
                    <label class="form-label">Logo Instansi</label>
                    <label for="logo_upload" class="logo-upload-area">
                        @if(isset($settings->agency_logo) && $settings->agency_logo)
                            <img src="{{ asset($settings->agency_logo) }}" alt="Logo">
                            <span style="font-size: 0.85rem; font-weight: 700; color: var(--primary);">Ubah Logo</span>
                        @else
                            <i data-lucide="image" style="width: 48px; height: 48px; color: #cbd5e1; margin-bottom: 12px;"></i>
                            <span style="font-size: 0.85rem; font-weight: 700; color: var(--text-muted);">Upload Logo</span>
                        @endif
                        <input type="file" id="logo_upload" name="agency_logo" style="display: none;" accept="image/*" onchange="previewImage(this)">
                    </label>
                </div>
                
                <div>
                    <div class="form-group">
                        <label class="form-label">Nama Aplikasi</label>
                        <input type="text" name="app_name" value="{{ $settings->app_name ?? 'SI JEBOL' }}" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Nama Instansi</label>
                        <input type="text" name="agency_name" value="{{ $settings->agency_name ?? 'Disdukcapil Kota Tegal' }}" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Deskripsi / Tagline</label>
                        <textarea name="app_tagline" rows="3" class="form-input">{{ $settings->app_tagline ?? 'Aplikasi ini digunakan untuk mendukung layanan administrasi kependudukan melalui program Jemput Bola secara online.' }}</textarea>
                    </div>
                </div>
            </div>

            <hr style="border: none; border-top: 1px solid #f1f5f9; margin: 32px 0;">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                <div class="form-group">
                    <label class="form-label">Email Kontak</label>
                    <div style="position: relative;">
                        <i data-lucide="mail" style="position: absolute; left: 16px; top: 14px; color: #94a3b8; width: 18px; height: 18px;"></i>
                        <input type="email" name="contact_email" value="{{ $settings->contact_email ?? 'disdukcapil@tegalkota.go.id' }}" class="form-input" style="padding-left: 44px;">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Alamat Kantor</label>
                    <div style="position: relative;">
                        <i data-lucide="map-pin" style="position: absolute; left: 16px; top: 14px; color: #94a3b8; width: 18px; height: 18px;"></i>
                        <input type="text" name="contact_address" value="{{ $settings->contact_address ?? 'Jl. Ki Gede Sebayu No. 12, Tegal 52121, Jawa Tengah' }}" class="form-input" style="padding-left: 44px;">
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: 16px;">
                <button type="submit" class="btn-primary">
                    <i data-lucide="save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var container = input.closest('.logo-upload-area');
                // Don't overwrite the whole innerHTML because it destroys the input file data!
                // Instead, just update the preview parts.
                
                // If there's already an image, just update its src
                var existingImg = container.querySelector('img');
                if (existingImg) {
                    existingImg.src = e.target.result;
                } else {
                    // Remove the lucide icon and 'Upload Logo' text
                    var icon = container.querySelector('svg');
                    if(icon) icon.remove();
                    var textSpan = container.querySelector('span');
                    if(textSpan) textSpan.remove();
                    
                    // Add new image and text, BEFORE the input element so we don't destroy it
                    var inputEl = container.querySelector('input[type="file"]');
                    var previewHTML = '<img src="' + e.target.result + '" alt="Logo" style="max-height: 100px; border-radius: 12px; margin-bottom: 16px;"><span style="font-size: 0.85rem; font-weight: 700; color: var(--primary);">Ubah Logo</span>';
                    inputEl.insertAdjacentHTML('beforebegin', previewHTML);
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
