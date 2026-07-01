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

        .btn-outline { background: white; border: 1px solid #cbd5e1; color: var(--text-main); }
        .btn-outline:hover { background: #f8fafc; }

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

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
        @media (max-width: 768px) { .form-grid { grid-template-columns: 1fr; } }

        .form-group { display: flex; flex-direction: column; gap: 8px; margin-bottom: 20px;}
        .form-group:last-child { margin-bottom: 0; }
        
        .form-label { font-size: 0.85rem; font-weight: 700; color: var(--text-main); }
        .form-control { 
            width: 100%; 
            padding: 12px 16px; 
            border-radius: 12px; 
            border: 1px solid #cbd5e1; 
            background: white; 
            font-family: inherit; 
            font-size: 0.95rem; 
            outline: none; 
            transition: all 0.2s; 
            box-sizing: border-box;
        }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 0 3px rgba(0, 49, 120, 0.1); }
        .form-control:disabled { background: #f8fafc; color: #94a3b8; cursor: not-allowed; }
        
        .form-hint { font-size: 0.8rem; color: var(--text-muted); margin-top: 4px; }

        .avatar-upload-container {
            display: flex;
            align-items: center;
            gap: 24px;
            padding: 24px;
            background: #f8fafc;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            margin-bottom: 24px;
        }
        
        @media (max-width: 768px) { .avatar-upload-container { flex-direction: column; text-align: center; } }

        .avatar-preview {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            background: white;
            display: flex; align-items: center; justify-content: center;
            font-size: 2rem; font-weight: 800; color: var(--primary);
            flex-shrink: 0;
        }

        input[type="file"]::file-selector-button {
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            background: white;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--text-main);
            cursor: pointer;
            margin-right: 12px;
            transition: all 0.2s;
            font-family: inherit;
        }
        input[type="file"]::file-selector-button:hover { background: #f8fafc; }

        .form-actions { display: flex; justify-content: flex-end; gap: 16px; margin-top: 32px; padding-top: 24px; border-top: 1px solid #e2e8f0; }
        
        .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; display: flex; align-items: center; gap: 12px; font-weight: 500; }
</style>
@endpush

@section('content')
<div class="page-header">
                <div class="header-content">
                    <h1 class="header-title">
                        <i data-lucide="user-cog" style="width: 32px; height: 32px; color: #fbbf24;"></i>
                        Edit Profil
                    </h1>
                    <p class="header-subtitle">Perbarui informasi akun Anda</p>
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

                <form action="{{ route('masyarakat.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-section">
                        <h3 class="section-title"><i data-lucide="camera" style="color: var(--primary);"></i> Foto Profil</h3>
                        <div class="avatar-upload-container">
                            @if(auth()->user()->foto_profil ?? auth()->user()->profile_photo_path)
                                <img src="{{ asset('storage/' . (auth()->user()->foto_profil ?? auth()->user()->profile_photo_path)) }}" alt="Avatar" class="avatar-preview" id="avatar_preview">
                            @else
                                <div class="avatar-preview" id="avatar_preview_container">
                                    {{ strtoupper(substr(auth()->user()->nama ?? auth()->user()->name ?? 'U', 0, 2)) }}
                                </div>
                                <img src="" alt="Avatar" class="avatar-preview" id="avatar_preview" style="display: none;">
                            @endif
                            <div>
                                <input type="file" name="profile_photo" id="profile_photo" accept="image/*" class="form-control" style="border: none; padding: 0; background: transparent;">
                                <div class="form-hint" style="margin-top: 8px;">Format: JPG, PNG. Maksimal ukuran file 1MB.</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="section-title"><i data-lucide="user" style="color: var(--primary);"></i> Informasi Pribadi</h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label class="form-label">Nama Lengkap *</label>
                                <input type="text" name="name" value="{{ old('name', auth()->user()->nama ?? auth()->user()->name) }}" class="form-control" readonly style="background: #f8fafc; color: #94a3b8; cursor: not-allowed;" title="Nama tidak dapat diubah">
                            </div>

                            <div class="form-group">
                                <label class="form-label">NIK / Username</label>
                                <input type="text" value="{{ auth()->user()->nik ?? auth()->user()->username }}" class="form-control" disabled title="NIK tidak dapat diubah">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Nomor Handphone</label>
                                <input type="text" name="phone" value="{{ old('phone', auth()->user()->telepon ?? auth()->user()->no_hp) }}" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h3 class="section-title"><i data-lucide="map-pin" style="color: var(--primary);"></i> Alamat (Data Dukcapil)</h3>
                        
                        <div class="form-group">
                            <label class="form-label">Kecamatan Domisili</label>
                            <select name="kecamatan" class="form-control">
                                <option value="" disabled {{ empty(auth()->user()->kecamatan) ? 'selected' : '' }}>Pilih Kecamatan Domisili</option>
                                <option value="Kecamatan Tegal Barat" {{ auth()->user()->kecamatan == 'Kecamatan Tegal Barat' ? 'selected' : '' }}>Kecamatan Tegal Barat</option>
                                <option value="Kecamatan Tegal Timur" {{ auth()->user()->kecamatan == 'Kecamatan Tegal Timur' ? 'selected' : '' }}>Kecamatan Tegal Timur</option>
                                <option value="Kecamatan Tegal Selatan" {{ auth()->user()->kecamatan == 'Kecamatan Tegal Selatan' ? 'selected' : '' }}>Kecamatan Tegal Selatan</option>
                                <option value="Kecamatan Margadana" {{ auth()->user()->kecamatan == 'Kecamatan Margadana' ? 'selected' : '' }}>Kecamatan Margadana</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3">{{ auth()->user()->alamat ?? '' }}</textarea>
                            <div class="form-hint">Pastikan alamat sesuai dengan KTP/KK Anda.</div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="form-actions">
                        <a href="{{ route('masyarakat.profile') }}" class="btn btn-outline" style="border: 1px solid #cbd5e1; color: var(--text-main); background: white;">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <i data-lucide="save" style="width: 18px;"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

<script>
    const photoInput = document.getElementById('profile_photo');
    if (photoInput) {
        photoInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    let preview = document.getElementById('avatar_preview');
                    let container = document.getElementById('avatar_preview_container');
                    preview.src = event.target.result;
                    preview.style.display = 'block';
                    if (container) container.style.display = 'none';
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    }
</script>
@endsection
