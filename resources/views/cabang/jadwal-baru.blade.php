@extends('layouts.panel')

@section('title', 'Tambah Jadwal Baru - SI JEBOL')

@section('content')
<style>
    :root {
        --primary: #003178;
        --accent: #f59e0b;
    }

    .form-header {
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

    .form-header::after {
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

    .form-title-wrap {
        position: relative;
        z-index: 10;
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .form-title {
        font-size: 1.8rem;
        font-weight: 800;
        margin: 0 0 4px 0;
        line-height: 1.2;
    }

    .form-subtitle {
        font-size: 0.95rem;
        color: rgba(255,255,255,0.85);
        margin: 0;
    }

    .card-panel {
        background: white;
        border-radius: 12px;
        padding: 32px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid #f1f5f9;
        margin-bottom: 24px;
    }

    .form-section-title {
        font-size: 1.1rem;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 20px 0;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 24px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    .field-group {
        margin-bottom: 20px;
    }

    .field-group-full {
        grid-column: span 2;
    }

    @media (max-width: 768px) {
        .field-group-full {
            grid-column: span 1;
        }
    }

    .field-label {
        display: block;
        font-size: 0.8rem;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .field-input, .field-textarea, .field-select {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #334155;
        background-color: #f8fafc;
        outline: none;
        transition: all 0.3s;
    }

    .field-input:focus, .field-textarea:focus, .field-select:focus {
        border-color: var(--primary);
        background-color: white;
        box-shadow: 0 0 0 4px rgba(0, 49, 120, 0.05);
    }

    .checkbox-group {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        margin-top: 8px;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.9rem;
        font-weight: 600;
        color: #334155;
        transition: all 0.2s;
    }

    .checkbox-label:hover {
        border-color: var(--primary);
        background-color: #f8fafc;
    }

    .checkbox-input {
        width: 18px;
        height: 18px;
        accent-color: var(--primary);
    }

    .btn-submit {
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 14px 28px;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
    }

    .btn-submit:hover {
        background: #00255a;
    }

    .btn-reset {
        background: #f1f5f9;
        color: #64748b;
        border: none;
        border-radius: 8px;
        padding: 14px 28px;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-reset:hover {
        background: #e2e8f0;
    }
</style>

<!-- Header -->
<div class="form-header">
    <div class="form-title-wrap">
        <div style="width: 48px; height: 48px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
            <i data-lucide="calendar" style="width: 24px; height: 24px; color: white;"></i>
        </div>
        <div>
            <h1 class="form-title">Tambah Jadwal Baru</h1>
            <p class="form-subtitle">Buat jadwal pelayanan JEBOL untuk wilayah atau sekolah</p>
        </div>
    </div>
    <a href="{{ route('cabang.jadwal') }}" style="display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.2); color: white; padding: 10px 16px; border-radius: 8px; font-weight: 700; font-size: 0.85rem; text-decoration: none; backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1);">
        <i data-lucide="arrow-left" style="width: 16px;"></i> Kembali
    </a>
</div>

@if($errors->any())
    <div style="background-color: #fef2f2; border: 1px solid #fca5a5; color: #b91c1c; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
        <ul style="margin: 0; padding-left: 20px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ request()->routeIs('cabang_dinas.*') ? route('cabang_dinas.jadwal.store') : route('cabang.jadwal.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <!-- Section 1: Informasi Dasar -->
    <div class="card-panel">
        <h2 class="form-section-title">
            <i data-lucide="info" style="width: 20px; color: var(--primary);"></i> Informasi Jadwal
        </h2>
        
        <div class="form-grid">
            <div class="field-group">
                <span class="field-label">Nama Kegiatan</span>
                <input type="text" name="nama_kegiatan" placeholder="Contoh: JEBOL KTP-el Kecamatan Tegal Barat" required class="field-input" value="{{ old('nama_kegiatan') }}">
            </div>

            <div class="field-group">
                <span class="field-label">Lokasi Pelayanan</span>
                <input type="text" name="lokasi" id="lokasi" required class="field-input" placeholder="Contoh: SMAN 1 Tegal atau Balai Desa" value="{{ old('lokasi') }}">
            </div>
        </div>
        
        <div class="form-grid" style="margin-top: 16px;">
            <div class="field-group">
                <span class="field-label">Foto Brosur / Banner (Opsional)</span>
                <input type="file" name="foto" accept="image/*" class="field-input" style="padding: 10px;">
                <small style="color: var(--text-muted); font-size: 0.8rem; display: block; margin-top: 4px;">Upload foto terkait kegiatan JEBOL ini (Maks. 2MB).</small>
            </div>
        </div>
    </div>

    <!-- Section 2: Waktu Pelaksanaan -->
    <div class="card-panel">
        <h2 class="form-section-title">
            <i data-lucide="clock" style="width: 20px; color: var(--primary);"></i> Waktu Pelaksanaan
        </h2>
        
        <div class="form-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
            <div class="field-group">
                <span class="field-label">Tanggal Pelayanan</span>
                <input type="date" name="tanggal_pelayanan" required class="field-input" value="{{ old('tanggal_pelayanan') }}">
            </div>
            <div class="field-group">
                <span class="field-label">Jam Mulai</span>
                <input type="time" name="jam_mulai" required class="field-input" value="{{ old('jam_mulai') }}">
            </div>
            <div class="field-group">
                <span class="field-label">Jam Selesai</span>
                <input type="time" name="jam_selesai" required class="field-input" value="{{ old('jam_selesai') }}">
            </div>
        </div>
    </div>

    <!-- Section 3: Detail Layanan -->
    <div class="card-panel">
        <h2 class="form-section-title">
            <i data-lucide="user-check" style="width: 20px; color: var(--primary);"></i> Detail Layanan
        </h2>
        
        <div class="field-group">
            <span class="field-label">Jenis Layanan</span>
            <div class="checkbox-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="jenis_layanan[]" value="KTP-el" class="checkbox-input">
                    <span>KTP-el</span>
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="jenis_layanan[]" value="KIA" class="checkbox-input">
                    <span>KIA</span>
                </label>
                <label class="checkbox-label">
                    <input type="checkbox" name="jenis_layanan[]" value="IKD" class="checkbox-input">
                    <span>IKD</span>
                </label>
            </div>
        </div>

        <div class="field-group" style="margin-bottom: 0;">
            <span class="field-label">Deskripsi Kegiatan</span>
            <textarea name="deskripsi" rows="4" placeholder="Contoh: Pelayanan JEBOL untuk pembuatan KTP-el, KIA, dan aktivasi IKD bagi masyarakat..." class="field-textarea">{{ old('deskripsi') }}</textarea>
        </div>
    </div>

    <!-- Actions -->
    <div style="display: flex; justify-content: flex-end; gap: 16px; margin-bottom: 40px;">
        <button type="reset" class="btn-reset">Reset</button>
        <button type="submit" class="btn-submit">
            <i data-lucide="save" style="width: 18px;"></i> Simpan Jadwal
        </button>
    </div>
</form>
@endsection
