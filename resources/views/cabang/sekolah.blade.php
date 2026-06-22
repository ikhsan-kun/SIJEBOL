@extends('layouts.panel')

@section('title', 'Manajemen Sekolah')

@section('content')
<style>
    .sekolah-header {
        background: linear-gradient(135deg, var(--primary) 0%, #0044a8 100%);
        border-radius: 0;
        color: white;
        padding: 36px 48px;
        position: relative;
        overflow: hidden;
        margin: -2rem -2rem 32px -2rem;
        box-shadow: 0 10px 30px rgba(0, 49, 120, 0.15);
        border-bottom: 6px solid #fbbf24;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .sekolah-header::after {
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

    .sekolah-title-wrap {
        position: relative;
        z-index: 10;
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .sekolah-icon {
        width: 64px;
        height: 64px;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sekolah-title {
        font-size: 1.8rem;
        font-weight: 800;
        margin: 0 0 4px 0;
        line-height: 1.2;
    }

    .sekolah-subtitle {
        font-size: 0.95rem;
        color: rgba(255,255,255,0.85);
        margin: 0;
    }

    .stats-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 24px;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 20px;
        box-shadow: var(--shadow-sm);
        border: 1px solid #f1f5f9;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-content {
        flex: 1;
    }

    .stat-title {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        margin: 0 0 4px 0;
    }

    .stat-value {
        font-size: 1.75rem;
        font-weight: 800;
        color: var(--text-main);
        margin: 0 0 2px 0;
        line-height: 1;
    }

    .stat-desc {
        font-size: 0.7rem;
        color: var(--text-muted);
        margin: 0;
    }

    .filter-card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 20px;
        box-shadow: var(--shadow-sm);
        border: 1px solid #f1f5f9;
        margin-bottom: 24px;
    }

    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        align-items: flex-end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        flex: 1;
        min-width: 200px;
    }

    .filter-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-main);
    }

    .filter-input {
        padding: 10px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-family: inherit;
        font-size: 0.9rem;
        background: #f8fafc;
        width: 100%;
        box-sizing: border-box;
    }

    .filter-input:focus {
        outline: none;
        border-color: var(--primary);
        background: white;
    }

    .btn-search {
        background: var(--primary);
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        height: 40px;
    }

    .btn-search:hover { background: var(--primary-light); color: var(--primary); }

    .btn-reset {
        background: transparent;
        color: var(--text-muted);
        border: 1px solid #e2e8f0;
        padding: 10px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        height: 40px;
        text-decoration: none;
        box-sizing: border-box;
    }

    .btn-reset:hover { background: #f8fafc; color: var(--text-main); }

    .table-card {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        border: 1px solid #f1f5f9;
        overflow: hidden;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th, .data-table td {
        padding: 16px 20px;
        text-align: left;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
    }

    .data-table th {
        background: #f8fafc;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .data-table tr:hover td { background: #f8fafc; }
    .data-table tr:last-child td { border-bottom: none; }

    .btn-action {
        background: #f1f5f9;
        color: var(--text-main);
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.8rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background 0.2s;
        text-decoration: none;
    }
    
    .btn-action:hover { background: #e2e8f0; }
    .btn-action.primary { background: #eff6ff; color: #2563eb; }
    .btn-action.primary:hover { background: #dbeafe; }
    .btn-action.danger { background: #fee2e2; color: #dc2626; }
    .btn-action.danger:hover { background: #fecaca; }

    .status-badge {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .badge-pending { background: #f1f5f9; color: #475569; }
    .badge-scheduled { background: #eff6ff; color: #1d4ed8; }
    .badge-success { background: #dcfce3; color: #166534; }

    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .modal-overlay.active {
        display: flex;
        opacity: 1;
    }

    .modal-container {
        background: white;
        border-radius: 20px;
        width: 100%;
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        transform: scale(0.95) translateY(10px);
        transition: transform 0.3s;
    }

    .modal-overlay.active .modal-container {
        transform: scale(1) translateY(0);
    }

    .modal-header {
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-title {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--text-main);
        margin: 0;
    }

    .btn-close {
        background: #f1f5f9;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--text-muted);
    }

    .btn-close:hover { background: #e2e8f0; color: var(--text-main); }

    .modal-body {
        padding: 24px;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-label {
        display: block;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 6px;
    }

    .form-control {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-family: inherit;
        font-size: 0.95rem;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
    }

    .modal-footer {
        padding: 16px 24px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        background: #f8fafc;
    }

    .btn-submit {
        background: var(--primary);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
    }
    
    .btn-submit:hover { background: #0044a8; }
    
    .btn-cancel {
        background: white;
        color: var(--text-main);
        border: 1px solid #e2e8f0;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
    }
    
    .btn-cancel:hover { background: #f8fafc; }

    .alert-success {
        background: #dcfce3;
        color: #166534;
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        border: 1px solid #bbf7d0;
    }

    @media (max-width: 1024px) {
        .stats-container { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .stats-container { grid-template-columns: 1fr; }
        .sekolah-header { flex-direction: column; text-align: center; gap: 16px; padding: 24px; }
        .sekolah-title-wrap { flex-direction: column; }
    }
</style>

<div class="sekolah-header">
    <div class="sekolah-title-wrap">
        <div class="sekolah-icon">
            <i data-lucide="school" style="width: 32px; height: 32px; color: white;"></i>
        </div>
        <div>
            <h1 class="sekolah-title">Manajemen Sekolah</h1>
            <p class="sekolah-subtitle">Kelola daftar sekolah mitra pelayanan Jemput Bola di wilayah Kota Tegal.</p>
        </div>
    </div>
    <div style="position: relative; z-index: 10;">
        <button onclick="openAddModal()" style="background: white; color: var(--primary); border: none; padding: 10px 20px; border-radius: 8px; font-weight: 700; cursor: pointer; display: flex; align-items: center; gap: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <i data-lucide="plus" style="width: 18px; height: 18px;"></i> Tambah Sekolah
        </button>
    </div>
</div>

@if(session('success'))
<div class="alert-success">
    <i data-lucide="check-circle-2" style="width: 20px; height: 20px;"></i>
    {{ session('success') }}
</div>
@endif

<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon" style="background: #eff6ff; color: #2563eb;">
            <i data-lucide="graduation-cap" style="width: 24px; height: 24px;"></i>
        </div>
        <div class="stat-content">
            <h4 class="stat-title">Total Sekolah</h4>
            <p class="stat-value">{{ $schools->count() }}</p>
            <p class="stat-desc">Sekolah terdaftar</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
            <i data-lucide="users" style="width: 24px; height: 24px;"></i>
        </div>
        <div class="stat-content">
            <h4 class="stat-title">Total Siswa</h4>
            <p class="stat-value">{{ number_format($schools->sum('jumlah_siswa')) }}</p>
            <p class="stat-desc">Siswa aktif</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: #dcfce3; color: #166534;">
            <i data-lucide="user-check" style="width: 24px; height: 24px;"></i>
        </div>
        <div class="stat-content">
            <h4 class="stat-title">Siswa Terlayani</h4>
            <p class="stat-value">{{ number_format($schools->sum('pengajuan_selesai')) }}</p>
            <p class="stat-desc">Sudah direkam</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: #f1f5f9; color: #475569;">
            <i data-lucide="calendar-clock" style="width: 24px; height: 24px;"></i>
        </div>
        <div class="stat-content">
            <h4 class="stat-title">Pelayanan</h4>
            <p class="stat-value">{{ $schools->where('status_jempol', 'Dijadwalkan')->count() }}</p>
            <p class="stat-desc">Sekolah dijadwalkan</p>
        </div>
    </div>
</div>

<div class="filter-card">
    <form class="filter-form" action="{{ route('cabang.sekolah') }}" method="GET">
        <div class="filter-group" style="flex: 2;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari sekolah, npsn..." class="filter-input">
        </div>
        <div class="filter-group">
            <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="filter-input">
        </div>
        <div class="filter-group">
            <select name="status" class="filter-input">
                <option value="">Semua Status</option>
                <option value="Belum Dijadwalkan" {{ request('status') == 'Belum Dijadwalkan' ? 'selected' : '' }}>Belum Dijadwalkan</option>
                <option value="Dijadwalkan" {{ request('status') == 'Dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div style="display: flex; gap: 12px;">
            <button type="submit" class="btn-search">
                <i data-lucide="search" style="width: 18px; height: 18px;"></i> Cari
            </button>
            @if(request('search') || request('status') || request('tanggal'))
            <a href="{{ route('cabang.sekolah') }}" class="btn-reset">
                <i data-lucide="x" style="width: 18px; height: 18px;"></i> Reset
            </a>
            @endif
        </div>
    </form>
</div>

<div class="table-card">
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Nama Sekolah</th>
                    <th width="10%">NPSN</th>
                    <th width="15%">Alamat</th>
                    <th width="15%">Kecamatan & Desa</th>
                    <th width="10%">Jml. Siswa</th>
                    <th width="10%">Jempol</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schools as $i => $school)
                <tr>
                    <td style="font-weight: 700; color: var(--text-muted);">{{ $i + 1 }}</td>
                    <td>
                        <div style="font-weight: 700; color: var(--primary); margin-bottom: 4px;">{{ $school->nama_sekolah }}</div>
                        <div style="display: flex; gap: 6px;">
                            <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px; font-size: 0.7rem; font-weight: 600;">{{ $school->tingkat }}</span>
                            <span style="background: #eff6ff; color: #2563eb; padding: 2px 6px; border-radius: 4px; font-size: 0.7rem; font-weight: 600;">Fokus: {{ $school->fokus_layanan ?? 'KTP-el' }}</span>
                        </div>
                    </td>
                    <td><span style="font-family: monospace; background: #f8fafc; padding: 4px 8px; border-radius: 6px; font-size: 0.85rem;">{{ $school->npsn ?? '-' }}</span></td>
                    <td><span style="font-size: 0.85rem; color: var(--text-muted);">{{ $school->alamat ?? '-' }}</span></td>
                    <td>
                        <div style="font-weight: 600; font-size: 0.85rem;">{{ $school->kecamatan }}</div>
                        @if($school->kelurahan)
                        <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $school->kelurahan }}</div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight: 700;">{{ number_format($school->pengajuan_selesai) }} <span style="color: var(--text-muted); font-weight: 500; font-size: 0.75rem;">/ {{ number_format($school->jumlah_siswa) }}</span></div>
                    </td>
                    <td>
                        @if($school->status_jempol == 'Sudah' || $school->status_jempol == 'Selesai')
                            <span class="status-badge badge-success"><i data-lucide="check-circle" style="width: 12px; height: 12px;"></i> Selesai</span>
                        @elseif($school->status_jempol == 'Dijadwalkan')
                            <span class="status-badge badge-scheduled"><i data-lucide="calendar" style="width: 12px; height: 12px;"></i> Dijadwalkan</span>
                        @else
                            <span class="status-badge badge-pending"><i data-lucide="clock" style="width: 12px; height: 12px;"></i> Belum</span>
                        @endif
                        
                        @if(isset($school->jadwal_terbaru) && $school->status_jempol != 'Belum Dijadwalkan')
                            <div style="font-size: 0.7rem; color: var(--text-muted); margin-top: 4px; font-weight: 600;">
                                {{ \Carbon\Carbon::parse($school->jadwal_terbaru->tanggal)->format('d M Y') }}
                            </div>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                            <button onclick="openDetailModal({{ $school->id }})" class="btn-action" title="Detail">
                                <i data-lucide="eye" style="width: 14px; height: 14px;"></i>
                            </button>
                            <a href="{{ route('cabang.sekolah.ajukan_jadwal', ['school' => $school->nama_sekolah]) }}" class="btn-action primary" title="Jadwal">
                                <i data-lucide="calendar-plus" style="width: 14px; height: 14px;"></i>
                            </a>
                            <button onclick="openEditModal({{ $school->id }}, '{{ addslashes($school->nama_sekolah) }}', '{{ addslashes($school->npsn ?? '') }}', '{{ addslashes($school->alamat ?? '') }}', {{ $school->jumlah_siswa }}, '{{ $school->fokus_layanan ?? 'KTP-el' }}', '{{ $school->tingkat }}')" class="btn-action" title="Edit">
                                <i data-lucide="edit" style="width: 14px; height: 14px;"></i>
                            </button>
                            <form action="{{ route('cabang.sekolah.destroy', $school->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data sekolah ini?');" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action danger" title="Hapus">
                                    <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div style="padding: 40px; text-align: center; color: var(--text-muted);">
                            <i data-lucide="school" style="width: 48px; height: 48px; margin-bottom: 16px; opacity: 0.3;"></i>
                            <h4 style="margin: 0 0 8px 0; font-size: 1.1rem;">Belum ada data sekolah</h4>
                            <p style="margin: 0;">Silakan tambah data sekolah baru.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Sekolah -->
<div class="modal-overlay" id="modalSekolah">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Sekolah</h3>
            <button class="btn-close" onclick="closeAddModal()"><i data-lucide="x" style="width: 20px; height: 20px;"></i></button>
        </div>
        <form action="{{ route('cabang.sekolah.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Tingkat Sekolah</label>
                    <select name="tingkat" required class="form-control">
                        <option value="" disabled selected>-- Pilih Tingkat --</option>
                        <option value="TK">TK</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SLTA">SLTA</option>
                    </select>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label class="form-label">Kecamatan</label>
                        <select name="kecamatan" required class="form-control">
                            <option value="" disabled selected>-- Pilih Kecamatan --</option>
                            <option value="Kota Tegal">Kota Tegal</option>
                            <option value="Margadana" {{ auth()->user()->kecamatan == 'Margadana' ? 'selected' : '' }}>Kecamatan Margadana</option>
                            <option value="Tegal Barat" {{ auth()->user()->kecamatan == 'Tegal Barat' ? 'selected' : '' }}>Kecamatan Tegal Barat</option>
                            <option value="Tegal Selatan" {{ auth()->user()->kecamatan == 'Tegal Selatan' ? 'selected' : '' }}>Kecamatan Tegal Selatan</option>
                            <option value="Tegal Timur" {{ auth()->user()->kecamatan == 'Tegal Timur' ? 'selected' : '' }}>Kecamatan Tegal Timur</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Desa / Kelurahan</label>
                        <input type="text" name="desa" required placeholder="Contoh: Panggung" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nama Sekolah</label>
                    <input type="text" name="nama_sekolah" required placeholder="Contoh: SD Negeri 1 Tegal" class="form-control">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 16px;">
                    <div class="form-group">
                        <label class="form-label">NPSN</label>
                        <input type="text" name="npsn" placeholder="Nomor Pokok" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Alamat Lengkap</label>
                        <input type="text" name="alamat" placeholder="Jalan / Gang" class="form-control">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label class="form-label">Jumlah Siswa</label>
                        <input type="number" name="jumlah_siswa" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="Swasta" selected>Swasta</option>
                            <option value="Negeri">Negeri</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Fokus Layanan</label>
                        <select name="fokus_layanan" class="form-control">
                            <option value="KTP-el" selected>KTP-el</option>
                            <option value="KIA">KIA</option>
                            <option value="IKD">IKD</option>
                            <option value="Semua Layanan">Semua Layanan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeAddModal()">Batal</button>
                <button type="submit" class="btn-submit">Simpan Sekolah</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Sekolah -->
<div class="modal-overlay" id="modalEditSiswa">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">Edit Data Sekolah</h3>
            <button class="btn-close" onclick="closeEditModal()"><i data-lucide="x" style="width: 20px; height: 20px;"></i></button>
        </div>
        <form id="formEditSiswa" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Sekolah</label>
                    <input type="text" name="nama_sekolah" id="editNamaSekolahInput" required class="form-control">
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label class="form-label">NPSN</label>
                        <input type="text" name="npsn" id="editNpsn" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jumlah Siswa</label>
                        <input type="number" name="jumlah_siswa" id="editJumlahSiswa" required class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat" id="editAlamat" rows="2" class="form-control"></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div class="form-group">
                        <label class="form-label">Tingkat Sekolah</label>
                        <select name="tingkat" id="editTingkat" required class="form-control">
                            <option value="TK">TK</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SLTA">SLTA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Fokus Layanan</label>
                        <select name="fokus_layanan" id="editFokusLayanan" class="form-control">
                            <option value="KTP-el">KTP-el</option>
                            <option value="KIA">KIA</option>
                            <option value="IKD">IKD</option>
                            <option value="Semua Layanan">Semua Layanan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeEditModal()">Batal</button>
                <button type="submit" class="btn-submit">Update Data</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Detail Sekolah -->
<div class="modal-overlay" id="modalDetailSekolah">
    <div class="modal-container">
        <div class="modal-header">
            <div style="display: flex; align-items: center; gap: 12px;">
                <div style="width: 40px; height: 40px; border-radius: 10px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="school" style="width: 24px; height: 24px;"></i>
                </div>
                <div>
                    <h3 class="modal-title" id="detailNamaSekolah">Nama Sekolah</h3>
                    <p style="margin: 0; font-size: 0.85rem; color: var(--text-muted);" id="detailTingkat">Tingkat</p>
                </div>
            </div>
            <button class="btn-close" onclick="closeDetailModal()"><i data-lucide="x" style="width: 20px; height: 20px;"></i></button>
        </div>
        <div class="modal-body">
            <div style="background: #f8fafc; padding: 16px; border-radius: 12px; border: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <span style="font-weight: 700;">Status Jemput Bola</span>
                <span id="detailStatusJempol" class="status-badge badge-pending" style="font-size: 0.9rem; padding: 6px 12px;">Status</span>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                <div>
                    <div style="margin-bottom: 16px;">
                        <p style="margin: 0 0 4px 0; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">NPSN</p>
                        <p style="margin: 0; font-weight: 600; font-family: monospace;" id="detailNpsn">-</p>
                    </div>
                    <div style="margin-bottom: 16px;">
                        <p style="margin: 0 0 4px 0; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Kecamatan</p>
                        <p style="margin: 0; font-weight: 600;" id="detailKecamatan">-</p>
                    </div>
                    <div style="margin-bottom: 16px;">
                        <p style="margin: 0 0 4px 0; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Fokus Layanan</p>
                        <p style="margin: 0; font-weight: 600;" id="detailFokusLayanan">-</p>
                    </div>
                </div>
                <div>
                    <div style="margin-bottom: 16px;">
                        <p style="margin: 0 0 4px 0; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Progres Pelayanan</p>
                        <p style="margin: 0 0 6px 0; font-weight: 700;"><span id="detailTerlayani" style="color: var(--primary);">0</span> / <span id="detailSiswa">0</span> siswa</p>
                        <div style="width: 100%; height: 8px; background: #e2e8f0; border-radius: 4px; overflow: hidden;">
                            <div id="detailProgresBar" style="height: 100%; background: var(--primary); width: 0%;"></div>
                        </div>
                    </div>
                    <div style="margin-bottom: 16px;">
                        <p style="margin: 0 0 4px 0; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Jadwal Terbaru</p>
                        <p style="margin: 0; font-weight: 600; color: var(--primary);" id="detailJadwal">-</p>
                    </div>
                    <div style="margin-bottom: 16px;">
                        <p style="margin: 0 0 4px 0; font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase;">Alamat Lengkap</p>
                        <p style="margin: 0; font-size: 0.9rem;" id="detailAlamat">-</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openAddModal() {
        document.getElementById('modalSekolah').classList.add('active');
    }
    
    function closeAddModal() {
        document.getElementById('modalSekolah').classList.remove('active');
    }

    const sekolahData = {
        @foreach($schools as $school)
        @php
            $jadwal_terbaru = isset($school->jadwal_terbaru) && $school->status_jempol != 'Belum Dijadwalkan' 
                ? \Carbon\Carbon::parse($school->jadwal_terbaru->tanggal)->format('d M Y') 
                : 'Belum Ada Jadwal';
            
            $percent = $school->jumlah_siswa > 0 ? min(100, ($school->pengajuan_selesai / $school->jumlah_siswa) * 100) : 0;
        @endphp
        {{ $school->id }}: {
            nama: @json($school->nama_sekolah),
            tingkat: @json($school->tingkat),
            npsn: @json($school->npsn ?? '-'),
            alamat: @json($school->alamat ?? '-'),
            kecamatan: @json($school->kecamatan),
            terlayani: {{ $school->pengajuan_selesai ?? 0 }},
            siswa: {{ $school->jumlah_siswa ?? 0 }},
            percent: {{ $percent }},
            status_jempol: @json($school->status_jempol),
            jadwal: @json($jadwal_terbaru),
            fokus_layanan: @json($school->fokus_layanan ?? 'KTP-el')
        },
        @endforeach
    };

    function openDetailModal(id) {
        const data = sekolahData[id];
        if(!data) return;

        document.getElementById('detailNamaSekolah').textContent = data.nama;
        document.getElementById('detailTingkat').textContent = data.tingkat;
        document.getElementById('detailNpsn').textContent = data.npsn;
        document.getElementById('detailAlamat').textContent = data.alamat;
        document.getElementById('detailKecamatan').textContent = data.kecamatan;
        document.getElementById('detailFokusLayanan').textContent = data.fokus_layanan;
        document.getElementById('detailTerlayani').textContent = new Intl.NumberFormat('id-ID').format(data.terlayani);
        document.getElementById('detailSiswa').textContent = new Intl.NumberFormat('id-ID').format(data.siswa);
        document.getElementById('detailJadwal').textContent = data.jadwal;
        
        document.getElementById('detailProgresBar').style.width = data.percent + '%';
        
        const statusBadge = document.getElementById('detailStatusJempol');
        statusBadge.textContent = data.status_jempol;
        
        if(data.status_jempol === 'Sudah' || data.status_jempol === 'Selesai') {
            statusBadge.className = 'status-badge badge-success';
        } else if(data.status_jempol === 'Dijadwalkan') {
            statusBadge.className = 'status-badge badge-scheduled';
        } else {
            statusBadge.className = 'status-badge badge-pending';
        }

        document.getElementById('modalDetailSekolah').classList.add('active');
    }

    function closeDetailModal() {
        document.getElementById('modalDetailSekolah').classList.remove('active');
    }

    function openEditModal(id, nama, npsn, alamat, jumlah, fokus, tingkat) {
        document.getElementById('editNamaSekolahInput').value = nama;
        document.getElementById('editNpsn').value = npsn;
        document.getElementById('editAlamat').value = alamat;
        document.getElementById('editJumlahSiswa').value = jumlah;
        document.getElementById('editFokusLayanan').value = fokus || 'KTP-el';
        document.getElementById('editTingkat').value = tingkat || 'SLTA';
        
        document.getElementById('formEditSiswa').action = `/cabang/sekolah/${id}/update-siswa`;
        document.getElementById('modalEditSiswa').classList.add('active');
    }

    function closeEditModal() {
        document.getElementById('modalEditSiswa').classList.remove('active');
    }

    document.addEventListener('keydown', e => { 
        if (e.key === 'Escape') {
            closeAddModal();
            closeEditModal();
            closeDetailModal();
        }
    });
</script>
@endsection
