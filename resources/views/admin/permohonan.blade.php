@extends('layouts.panel')

@section('title', 'Verifikasi Pengajuan Layanan - SI JEBOL Admin')

@section('content')
<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }

    .custom-hero {
        background: linear-gradient(135deg, var(--primary) 0%, #0044a8 100%);
        border-radius: 0;
        color: white;
        padding: 36px 48px;
        position: relative;
        overflow: hidden;
        margin: -2rem -2rem 32px -2rem;
        box-shadow: 0 10px 30px rgba(0, 49, 120, 0.15);
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 6px solid #fbbf24;
    }

    .custom-hero::after {
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

    .hero-content {
        position: relative;
        z-index: 10;
        max-width: 650px;
    }

    .hero-title {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0 0 12px 0;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .hero-title span {
        color: #fbbf24;
    }
    .hero-subtitle {
        font-size: 1.05rem;
        color: rgba(255,255,255,0.9);
        margin: 0;
        line-height: 1.6;
        font-weight: 400;
    }
    
    .hero-icon-large {
        opacity: 0.15;
        transform: scale(2) rotate(10deg);
        margin-right: 20px;
        z-index: 1;
        color: white;
    }

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.02);
        display: flex;
        align-items: flex-start;
        gap: 20px;
        border: 1px solid #f1f5f9;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 20px -8px rgba(0,0,0,0.08);
        border-color: #e2e8f0;
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
    }

    .stat-info {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .stat-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-main);
        line-height: 1;
    }

    .stat-sub {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin-top: 6px;
    }

    .panel-box {
        background: white;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        border: 1px solid #f1f5f9;
    }

    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .panel-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-main);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    /* Tabs Styling */
    .tabs-nav {
        display: flex;
        gap: 8px;
        border-bottom: 1px solid #e2e8f0;
        margin-bottom: 24px;
        overflow-x: auto;
    }

    .tab-btn {
        padding: 12px 24px;
        background: none;
        border: none;
        border-bottom: 3px solid transparent;
        font-weight: 600;
        font-size: 0.95rem;
        color: var(--text-muted);
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .tab-btn:hover {
        color: var(--text-main);
        border-bottom-color: #cbd5e1;
    }

    .tab-btn.active {
        color: var(--primary);
        border-bottom-color: var(--primary);
    }

    /* Filter Form Styling */
    .filter-panel {
        background: #f8fafc;
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 24px;
        border: 1px solid #e2e8f0;
    }

    .filter-row {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        align-items: flex-end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        flex-grow: 1;
        min-width: 200px;
    }

    .filter-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-muted);
    }

    .filter-input {
        padding: 10px 14px;
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        background: white;
        font-size: 0.9rem;
        color: var(--text-main);
        width: 100%;
        outline: none;
        transition: border-color 0.2s;
    }

    .filter-input:focus {
        border-color: var(--primary);
    }

    .filter-date-group {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Data Table */
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .data-table th, .data-table td {
        padding: 16px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
        vertical-align: middle;
    }
    
    .data-table th {
        background: #f8fafc;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.8rem;
        text-align: left;
    }

    .data-table th:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
    .data-table th:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }

    .data-table tr { transition: background 0.2s; }
    .data-table tbody tr:hover { background: #f8fafc; }

    /* Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-menunggu { background: #fef3c7; color: #d97706; }
    .badge-terverifikasi { background: #e0e7ff; color: #4338ca; }
    .badge-terjadwal { background: #eff6ff; color: #2563eb; }
    .badge-diproses { background: #f3e8ff; color: #7e22ce; }
    .badge-selesai { background: #ecfdf5; color: #10b981; }
    .badge-ditolak { background: #fee2e2; color: #dc2626; }
    .badge-default { background: #f1f5f9; color: #475569; }

    /* Action Buttons */
    .action-group {
        display: flex;
        gap: 8px;
        flex-wrap: nowrap;
        align-items: center;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
        text-decoration: none;
    }

    .btn-icon { padding: 8px; }
    
    .btn-primary { background: var(--primary); color: white; }
    .btn-primary:hover { background: var(--primary-dark); }
    
    .btn-success { background: #10b981; color: white; }
    .btn-success:hover { background: #059669; }

    .btn-outline { background: white; border: 1px solid #e2e8f0; color: var(--text-main); }
    .btn-outline:hover { background: #f8fafc; border-color: #cbd5e1; }

    .btn-danger-outline { background: white; border: 1px solid #fecaca; color: #dc2626; }
    .btn-danger-outline:hover { background: #fee2e2; }

    /* Modals */
    .modal-backdrop {
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        z-index: 1000;
        display: none;
        place-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .modal-backdrop.show { display: grid; opacity: 1; }

    .modal-content {
        background: white;
        border-radius: 20px;
        width: 100%;
        max-width: 500px;
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
        transform: scale(0.95);
        opacity: 0;
        transition: all 0.3s ease;
        padding: 32px;
    }

    .modal-backdrop.show .modal-content {
        transform: scale(1);
        opacity: 1;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .modal-title { font-size: 1.2rem; font-weight: 700; color: var(--text-main); margin: 0; display: flex; align-items: center; gap: 8px;}
    .modal-close { background: none; border: none; font-size: 1.5rem; color: #94a3b8; cursor: pointer; }

    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; font-size: 0.85rem; font-weight: 600; color: var(--text-muted); margin-bottom: 8px; }
    .form-group input, .form-group textarea { width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #cbd5e1; font-family: inherit; font-size: 0.95rem; }
    
    .modal-footer { display: flex; justify-content: flex-end; gap: 12px; margin-top: 32px; }

    .alert {
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .alert-success { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; }
    .alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
    
    .info-box {
        background: #eff6ff; border: 1px solid #bfdbfe; color: #1e3a8a;
        padding: 16px; border-radius: 12px; margin-bottom: 24px;
        display: flex; gap: 12px; font-size: 0.9rem; line-height: 1.5;
    }

    @media (max-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: repeat(2, 1fr) !important;
        }
        .custom-hero {
            flex-direction: column;
            text-align: center;
            padding: 24px !important;
            margin: -1.5rem -1rem 24px -1rem !important;
        }
        .hero-icon-large {
            display: none;
        }
    }
    @media (max-width: 640px) {
        .dashboard-grid {
            grid-template-columns: 1fr !important;
        }
        .filter-row {
            flex-direction: column;
            align-items: stretch !important;
        }
        .filter-group {
            width: 100% !important;
        }
    }
</style>

<div class="custom-hero">
    <div class="hero-content">
        <h1 class="hero-title">Verifikasi <span>Pengajuan</span></h1>
        <p class="hero-subtitle">Kelola dan verifikasi setiap pengajuan layanan Adminduk dari masyarakat sebelum masuk ke tahap pencetakan atau pelayanan lapangan.</p>
    </div>
    <div class="hero-icon-large">
        <i data-lucide="shield-check" style="width: 120px; height: 120px;"></i>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">
    <i data-lucide="check-circle"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

@if(session('error'))
<div class="alert alert-error">
    <i data-lucide="alert-circle"></i>
    <span>{{ session('error') }}</span>
</div>
@endif

<div class="dashboard-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background: #eff6ff; color: #3b82f6;">
            <i data-lucide="file-text" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Total Pengajuan</span>
            <span class="stat-value">{{ $totalPermohonan }}</span>
            <span class="stat-sub">Semua Layanan</span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #fffbeb; color: #d97706;">
            <i data-lucide="clock" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Menunggu Verifikasi</span>
            <span class="stat-value">{{ $totalMenunggu }}</span>
            <span class="stat-sub">Perlu Tindak Lanjut</span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #e0e7ff; color: #4338ca;">
            <i data-lucide="check-circle" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Terverifikasi</span>
            <span class="stat-value">{{ $totalTerverifikasi }}</span>
            <span class="stat-sub">Sudah Diverifikasi</span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #fef2f2; color: #dc2626;">
            <i data-lucide="x-circle" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Ditolak</span>
            <span class="stat-value">{{ $totalDitolak }}</span>
            <span class="stat-sub">Pengajuan Ditolak</span>
        </div>
    </div>
</div>

<div class="panel-box">
    <!-- Tabs Navigation -->
    <div class="tabs-nav">
        <button onclick="switchTab('individu')" id="btn-tab-individu" class="tab-btn active">
            <i data-lucide="user" style="width: 18px;"></i> Pengajuan Individu
        </button>
        <button onclick="switchTab('rekap')" id="btn-tab-rekap" class="tab-btn">
            <i data-lucide="map-pin" style="width: 18px;"></i> Monitoring Lokasi JEBOL
        </button>
    </div>

    <!-- Tab Individu -->
    <div id="tab-individu">
        <!-- Filter Panel -->
        <div class="filter-panel">
            <form action="{{ route('admin.permohonan') }}" method="GET" class="filter-row">
                <div class="filter-group">
                    <label class="filter-label">Cari Pemohon</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama / NIK / No. HP..." class="filter-input">
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Jenis Layanan</label>
                    <select name="layanan" class="filter-input">
                        <option value="">Semua Layanan</option>
                        @foreach($services as $svc)
                            <option value="{{ $svc->nama_layanan }}" {{ request('layanan') == $svc->nama_layanan ? 'selected' : '' }}>{{ $svc->nama_layanan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <label class="filter-label">Status Verifikasi</label>
                    <select name="status" class="filter-input">
                        <option value="">Semua Status</option>
                        <option value="menunggu_verifikasi" {{ request('status') == 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                        <option value="terverifikasi" {{ request('status') == 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                        <option value="terjadwal" {{ request('status') == 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>

                <div class="filter-group" style="flex-grow: 2;">
                    <label class="filter-label">Tanggal Pengajuan</label>
                    <div class="filter-date-group">
                        <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="filter-input">
                        <span style="color: var(--text-muted); font-weight: bold;">-</span>
                        <input type="date" name="tanggal_end" value="{{ request('tanggal_end') }}" disabled title="TBD" class="filter-input" style="background: #f1f5f9; cursor: not-allowed;">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="height: 42px;">
                    <i data-lucide="filter" style="width: 18px;"></i> Filter
                </button>
            </form>
        </div>

        <div style="overflow-x: auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Pengajuan</th>
                        <th>Pemohon</th>
                        <th>Wilayah</th>
                        <th>Jenis Layanan</th>
                        <th>Waktu Pengajuan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($permohonan as $p)
                    <tr>
                        <td>{{ ($permohonan->currentPage() - 1) * $permohonan->perPage() + $loop->iteration }}</td>
                        <td style="font-weight: 700; color: var(--primary);">
                            <a href="{{ route('admin.permohonan.detail', $p->id_pengajuan) }}" style="color: var(--primary); text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                                {{ $p->nomor_tiket }}
                            </a>
                        </td>
                        <td>
                            <div style="font-weight: 700; color: var(--text-main);">{{ $p->masyarakat->nama ?? 'Anonim' }}</div>
                            <div style="font-size: 0.8rem; color: var(--text-muted);">NIK. {{ $p->nik }}</div>
                        </td>
                        <td style="font-weight: 600; color: var(--text-main);">{{ $p->lokasi_pelayanan ?? '-' }}</td>
                        <td style="font-weight: 600; color: var(--text-muted);">{{ $p->jenis_layanan }}</td>
                        <td>
                            <div style="font-weight: 600; color: var(--text-main);">{{ $p->tanggal_pengajuan ? $p->tanggal_pengajuan->format('d M Y') : '-' }}</div>
                            <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $p->tanggal_pengajuan ? $p->tanggal_pengajuan->format('H:i') . ' WIB' : '' }}</div>
                        </td>
                        <td>
                            @php
                                $badgeClass = 'badge-default';
                                $icon = 'circle';
                                $statusText = str_replace('_', ' ', $p->status);
                                if($p->status == 'menunggu_verifikasi') { $badgeClass = 'badge-menunggu'; $icon = 'clock'; }
                                elseif($p->status == 'terverifikasi') { $badgeClass = 'badge-terverifikasi'; $icon = 'check-circle'; }
                                elseif($p->status == 'terjadwal') { $badgeClass = 'badge-terjadwal'; $icon = 'calendar'; }
                                elseif($p->status == 'diproses') { $badgeClass = 'badge-diproses'; $icon = 'refresh-cw'; }
                                elseif($p->status == 'selesai') { $badgeClass = 'badge-selesai'; $icon = 'check-square'; }
                                elseif($p->status == 'ditolak') { $badgeClass = 'badge-ditolak'; $icon = 'x-circle'; }
                            @endphp
                            <span class="status-badge {{ $badgeClass }}">
                                <i data-lucide="{{ $icon }}" style="width: 14px; height: 14px;"></i>
                                {{ ucwords($statusText) }}
                            </span>
                        </td>
                        <td>
                            <div class="action-group">
                                @if($p->status == 'menunggu_verifikasi')
                                    <a href="{{ route('admin.permohonan.detail', $p->id_pengajuan) }}" class="btn btn-success">
                                        <i data-lucide="check-circle" style="width: 16px;"></i> Verifikasi
                                    </a>
                                @else
                                    <a href="{{ route('admin.permohonan.detail', $p->id_pengajuan) }}" class="btn btn-outline">
                                        <i data-lucide="eye" style="width: 16px;"></i> Detail
                                    </a>
                                @endif
                                <form action="{{ route('admin.permohonan.destroy', $p->id_pengajuan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengajuan ini secara permanen?');" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger-outline btn-icon" title="Hapus">
                                        <i data-lucide="trash-2" style="width: 16px;"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 32px; color: var(--text-muted);">
                            Belum ada pengajuan layanan yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div style="margin-top: 24px;">
            {{ $permohonan->links() }}
        </div>
    </div> <!-- End Tab Individu -->

    <!-- Tab Rekap Lokasi -->
    <div id="tab-rekap" style="display: none;">
        <div style="margin-bottom: 24px;">
            <p style="color: var(--text-muted); font-size: 0.95rem;">Pantau jumlah pengajuan per wilayah untuk diakumulasi sebagai jadwal massal.</p>
        </div>
        
        <div style="overflow-x: auto;">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Lokasi / Asal (Kecamatan)</th>
                        <th>Total Pemohon (Terverifikasi)</th>
                        <th>Status Kolektif</th>
                        <th>Aksi Penjadwalan</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($rekapLokasi) && count($rekapLokasi) > 0)
                        @foreach($rekapLokasi as $rekap)
                        <tr>
                            <td style="font-weight: 700; color: var(--text-main); font-size: 1rem;">
                                {{ $rekap->lokasi_pelayanan }}
                            </td>
                            <td>
                                <span style="font-size: 1.5rem; font-weight: 800; color: var(--primary);">{{ $rekap->total }}</span>
                                <span style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">Orang</span>
                            </td>
                            <td>
                                @if(in_array($rekap->status, ['menunggu_verifikasi', 'menunggu_kuota', 'terverifikasi']))
                                    <span class="status-badge badge-menunggu"><i data-lucide="clock" style="width: 14px;"></i> Siap Dijadwalkan</span>
                                @elseif($rekap->status == 'terjadwal')
                                    <span class="status-badge badge-terjadwal"><i data-lucide="calendar" style="width: 14px;"></i> Terjadwal</span>
                                @elseif($rekap->status == 'diproses')
                                    <span class="status-badge badge-diproses"><i data-lucide="refresh-cw" style="width: 14px;"></i> Diproses</span>
                                @endif
                            </td>
                            <td>
                                @if(in_array($rekap->status, ['menunggu_verifikasi', 'menunggu_kuota', 'terverifikasi']))
                                    <button onclick="openBulkScheduleModal('{{ $rekap->lokasi_pelayanan }}')" class="btn btn-primary">
                                        <i data-lucide="calendar-plus" style="width: 16px;"></i> Buat Jadwal
                                    </button>
                                @elseif(in_array($rekap->status, ['terjadwal', 'diproses']))
                                    <button onclick="openBulkCompleteModal('{{ $rekap->lokasi_pelayanan }}', {{ $rekap->total }})" class="btn btn-success">
                                        <i data-lucide="check-square" style="width: 16px;"></i> Selesaikan Semua
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 32px; color: var(--text-muted);">
                            Tidak ada data pengajuan kolektif yang siap dijadwalkan.
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div> <!-- End Tab Rekap Lokasi -->
</div>

<!-- Modal Bulk Schedule -->
<div id="bulkScheduleModal" class="modal-backdrop">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i data-lucide="calendar-plus" style="color: var(--primary);"></i> Buat Jadwal JEBOL Masal</h3>
            <button onclick="closeBulkScheduleModal()" class="modal-close">&times;</button>
        </div>
        
        <form action="{{ route('admin.permohonan.bulk-schedule') }}" method="POST">
            @csrf
            
            <div class="info-box">
                <i data-lucide="info" style="width: 20px; height: 20px; flex-shrink: 0;"></i>
                <div>Tindakan ini akan secara otomatis mengubah semua pemohon di lokasi ini menjadi status <strong>"Terjadwal"</strong>.</div>
            </div>
            
            <div class="form-group">
                <label>Lokasi Pelayanan</label>
                <input type="text" name="lokasi_pelayanan" id="modal_lokasi" readonly style="background: #f1f5f9; color: var(--text-muted);">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label>Tanggal Pelayanan</label>
                    <input type="date" name="tanggal" required>
                </div>
                <div class="form-group">
                    <label>Jumlah Petugas (Orang)</label>
                    <input type="number" name="jumlah_petugas" min="1" required placeholder="Contoh: 3">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div class="form-group">
                    <label>Jam Mulai</label>
                    <input type="time" name="jam_mulai" value="08:00" required>
                </div>
                <div class="form-group">
                    <label>Jam Selesai (Opsional)</label>
                    <input type="time" name="jam_selesai" value="12:00">
                </div>
            </div>

            <div class="form-group">
                <label>Pesan/Catatan Tambahan</label>
                <textarea name="keterangan" rows="2" placeholder="Contoh: Mohon membawa fotokopi KK asli"></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" onclick="closeBulkScheduleModal()" class="btn btn-outline">Batal</button>
                <button type="submit" class="btn btn-primary">
                    <i data-lucide="check" style="width: 16px;"></i> Jadwalkan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Bulk Complete -->
<div id="bulkCompleteModal" class="modal-backdrop">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title"><i data-lucide="check-square" style="color: #10b981;"></i> Selesaikan Jadwal JEBOL</h3>
            <button onclick="closeBulkCompleteModal()" class="modal-close">&times;</button>
        </div>
        
        <form action="{{ route('admin.permohonan.bulk-complete') }}" method="POST">
            @csrf
            <input type="hidden" name="lokasi_pelayanan" id="complete_modal_lokasi">
            
            <div class="info-box" style="background: #ecfdf5; border-color: #a7f3d0; color: #065f46;">
                <i data-lucide="info" style="width: 20px; height: 20px; flex-shrink: 0;"></i>
                <div>Tandai pengajuan di lokasi ini sebagai <strong>"Selesai"</strong>. Harap masukkan jumlah warga yang berhasil dilayani (hadir).</div>
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center; background: #f8fafc; padding: 16px; border-radius: 12px; margin-bottom: 20px; border: 1px solid #e2e8f0;">
                <span style="font-weight: 600; color: var(--text-muted);">Total Warga Terdaftar:</span>
                <span style="font-size: 1.2rem; font-weight: 800; color: var(--text-main);"><span id="complete_modal_total">0</span> Orang</span>
            </div>

            <div class="form-group">
                <label>Total Warga Yang Dilayani (Hadir) *</label>
                <input type="number" name="total_hadir" id="input_total_hadir" min="0" required style="font-size: 1.2rem; font-weight: 700;">
                <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 8px;">Sistem akan membagi status kehadiran otomatis secara merata berdasarkan angka ini.</p>
            </div>
            
            <div class="modal-footer">
                <button type="button" onclick="closeBulkCompleteModal()" class="btn btn-outline">Batal</button>
                <button type="submit" class="btn btn-success">
                    <i data-lucide="check-circle" style="width: 16px;"></i> Konfirmasi Selesai
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function switchTab(tab) {
        document.getElementById('tab-individu').style.display = 'none';
        document.getElementById('tab-rekap').style.display = 'none';
        
        document.getElementById('btn-tab-individu').classList.remove('active');
        document.getElementById('btn-tab-rekap').classList.remove('active');
        
        if(tab === 'individu') {
            document.getElementById('tab-individu').style.display = 'block';
            document.getElementById('btn-tab-individu').classList.add('active');
        } else {
            document.getElementById('tab-rekap').style.display = 'block';
            document.getElementById('btn-tab-rekap').classList.add('active');
        }
    }

    function openBulkScheduleModal(lokasi) {
        document.getElementById('modal_lokasi').value = lokasi;
        const modal = document.getElementById('bulkScheduleModal');
        modal.classList.add('show');
    }

    function closeBulkScheduleModal() {
        document.getElementById('bulkScheduleModal').classList.remove('show');
    }

    function openBulkCompleteModal(lokasi, total) {
        document.getElementById('complete_modal_lokasi').value = lokasi;
        document.getElementById('complete_modal_total').innerText = total;
        document.getElementById('input_total_hadir').max = total;
        document.getElementById('input_total_hadir').value = total;

        const modal = document.getElementById('bulkCompleteModal');
        modal.classList.add('show');
    }

    function closeBulkCompleteModal() {
        document.getElementById('bulkCompleteModal').classList.remove('show');
    }
</script>
@endsection
