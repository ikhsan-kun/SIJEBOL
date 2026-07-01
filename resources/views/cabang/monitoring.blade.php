@extends('layouts.panel')

@section('title', 'Monitoring Pengajuan Sekolah')

@section('content')
<style>
    .monitoring-header {
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
        border-bottom: 6px solid #fbbf24;
    }

    .monitoring-header::after {
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

    .monitoring-title-wrap {
        position: relative;
        z-index: 10;
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .monitoring-icon {
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

    .monitoring-title {
        font-size: 1.8rem;
        font-weight: 800;
        margin: 0 0 4px 0;
        line-height: 1.2;
    }

    .monitoring-subtitle {
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

    .date-range {
        display: flex;
        align-items: center;
        gap: 8px;
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

    .btn-search:hover { background: var(--primary-light); }

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

    .status-badge {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .status-pending { background: #fef3c7; color: #b45309; }
    .status-terverifikasi { background: #e0e7ff; color: #4f46e5; }
    .status-terjadwal { background: #cffafe; color: #0891b2; }
    .status-diproses { background: #eff6ff; color: #1d4ed8; }
    .status-selesai { background: #dcfce3; color: #166534; }
    .status-ditolak { background: #fee2e2; color: #b91c1c; }

    .btn-detail {
        background: #eff6ff;
        color: #2563eb;
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
    }

    .btn-detail:hover { background: #dbeafe; }

    .pagination-wrapper {
        padding: 16px 20px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .empty-state {
        padding: 60px 20px;
        text-align: center;
        color: var(--text-muted);
    }

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
        border-radius: 24px;
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
        padding: 24px 32px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--text-main);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
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
        padding: 32px;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }

    .detail-item {
        margin-bottom: 20px;
    }

    .detail-label {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        margin-bottom: 6px;
    }

    .detail-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-main);
    }

    @media (max-width: 1024px) {
        .stats-container { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .stats-container { grid-template-columns: 1fr; }
        .monitoring-header { flex-direction: column; text-align: center; gap: 16px; padding: 24px; }
        .monitoring-title-wrap { flex-direction: column; }
        .detail-grid { grid-template-columns: 1fr; gap: 0; }
        .filter-group { min-width: 100%; }
        .btn-search, .btn-reset { flex: 1; justify-content: center; }
    }
</style>

<div class="monitoring-header">
    <div class="monitoring-title-wrap">
        <div class="monitoring-icon">
            <i data-lucide="monitor" style="width: 32px; height: 32px; color: white;"></i>
        </div>
        <div>
            <h1 class="monitoring-title">Pengajuan Sekolah</h1>
            <p class="monitoring-subtitle">Pantau seluruh pengajuan layanan Jemput Bola dari sekolah di wilayah Anda.</p>
        </div>
    </div>

</div>

<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon" style="background: #f1f5f9; color: #475569;">
            <i data-lucide="files" style="width: 24px; height: 24px;"></i>
        </div>
        <div class="stat-content">
            <h4 class="stat-title">Total Pengajuan</h4>
            <p class="stat-value">{{ number_format($stats['total'] ?? 0) }}</p>
            <p class="stat-desc">Semua Status</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
            <i data-lucide="clock" style="width: 24px; height: 24px;"></i>
        </div>
        <div class="stat-content">
            <h4 class="stat-title">Menunggu</h4>
            <p class="stat-value">{{ number_format($stats['pending'] ?? 0) }}</p>
            <p class="stat-desc">Belum diproses</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: #eff6ff; color: #2563eb;">
            <i data-lucide="refresh-ccw" style="width: 24px; height: 24px;"></i>
        </div>
        <div class="stat-content">
            <h4 class="stat-title">Diproses</h4>
            <p class="stat-value">{{ number_format($stats['diproses'] ?? 0) }}</p>
            <p class="stat-desc">Sedang berjalan</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background: #dcfce3; color: #166534;">
            <i data-lucide="check-circle-2" style="width: 24px; height: 24px;"></i>
        </div>
        <div class="stat-content">
            <h4 class="stat-title">Selesai</h4>
            <p class="stat-value">{{ number_format($stats['selesai'] ?? 0) }}</p>
            <p class="stat-desc">Terlayani</p>
        </div>
    </div>
</div>

<div class="filter-card">
    <form class="filter-form" action="{{ route('cabang.monitoring') }}" method="GET" id="filter-form">
        <div class="filter-group" style="flex: 2;">
            <label class="filter-label">Pencarian</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari tiket, sekolah, atau layanan..." class="filter-input">
        </div>
        <div class="filter-group">
            <label class="filter-label">Status</label>
            <select name="status" class="filter-input" onchange="document.getElementById('filter-form').submit()">
                <option value="semua" {{ request('status') === 'semua' ? 'selected' : '' }}>Semua Status</option>
                <option value="menunggu_verifikasi" {{ request('status') === 'menunggu_verifikasi' ? 'selected' : '' }}>Menunggu</option>
                <option value="terverifikasi" {{ request('status') === 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                <option value="terjadwal" {{ request('status') === 'terjadwal' ? 'selected' : '' }}>Terjadwal</option>
                <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="ditolak" {{ request('status') === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
        <div class="filter-group" style="flex: 1.5;">
            <label class="filter-label">Tanggal Pengajuan</label>
            <div class="date-range">
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="filter-input">
                <span style="color: var(--text-muted);">-</span>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="filter-input">
            </div>
        </div>
        <div style="display: flex; gap: 12px;">
            <button type="submit" class="btn-search">
                <i data-lucide="search" style="width: 18px; height: 18px;"></i> Cari
            </button>
            @if(request()->anyFilled(['search', 'status', 'start_date', 'end_date']))
            <a href="{{ route('cabang.monitoring') }}" class="btn-reset">
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
                    <th>Tiket</th>
                    <th>Sekolah</th>
                    <th>Layanan</th>
                    <th>Peserta</th>
                    <th>Tgl Pengajuan</th>
                    <th>Tgl Pelayanan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($permohonans as $p)
                @php
                    $school = $p->user->school ?? $p->masyarakat->school ?? '—';
                    $target = (int)($p->jumlah_orang ?? 0);
                    $realisasi = (int)($p->jumlah_realisasi ?? 0);
                    
                    $statusCls = 'status-pending';
                    $statusIcon = 'clock';
                    $statusLabel = 'Menunggu';
                    if($p->status == 'terverifikasi') { $statusCls = 'status-terverifikasi'; $statusIcon = 'check-square'; $statusLabel = 'Terverifikasi'; }
                    if($p->status == 'terjadwal') { $statusCls = 'status-terjadwal'; $statusIcon = 'calendar'; $statusLabel = 'Terjadwal'; }
                    if($p->status == 'diproses') { $statusCls = 'status-diproses'; $statusIcon = 'refresh-cw'; $statusLabel = 'Diproses'; }
                    if($p->status == 'selesai') { $statusCls = 'status-selesai'; $statusIcon = 'check-circle'; $statusLabel = 'Selesai'; }
                    if($p->status == 'ditolak') { $statusCls = 'status-ditolak'; $statusIcon = 'x-circle'; $statusLabel = 'Ditolak'; }
                @endphp
                <tr>
                    <td style="font-weight: 700; color: var(--primary);">
                        <a href="javascript:void(0)" onclick="openDetail({{ $p->id_pengajuan }})" style="color: var(--primary); text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                            #{{ $p->nomor_tiket }}
                        </a>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <div style="width: 32px; height: 32px; border-radius: 8px; background: #f8fafc; display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
                                <i data-lucide="school" style="width: 16px; height: 16px;"></i>
                            </div>
                            <span style="font-weight: 600;">{{ $school }}</span>
                        </div>
                    </td>
                    <td>
                        <span style="background: #f8fafc; padding: 4px 8px; border-radius: 6px; font-size: 0.8rem; font-weight: 600; border: 1px solid #e2e8f0;">
                            {{ $p->jenis_layanan ?? '—' }}
                        </span>
                    </td>
                    <td>
                        <div style="font-weight: 700;">{{ number_format($realisasi) }} <span style="color: var(--text-muted); font-weight: 500; font-size: 0.8rem;">/ {{ number_format($target) }}</span></div>
                    </td>
                    <td>
                        <div style="font-weight: 600;">{{ $p->tanggal_pengajuan->format('d M Y') }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $p->tanggal_pengajuan->format('H:i') }} WIB</div>
                    </td>
                    <td>
                        @if($p->tanggal_kedatangan)
                        <div style="font-weight: 600; color: var(--primary);">{{ \Carbon\Carbon::parse($p->tanggal_kedatangan)->format('d M Y') }}</div>
                        @else
                        <span style="color: var(--text-muted); font-size: 0.85rem; font-style: italic;">Belum dijadwal</span>
                        @endif
                    </td>
                    <td>
                        <span class="status-badge {{ $statusCls }}">
                            <i data-lucide="{{ $statusIcon }}" style="width: 14px; height: 14px;"></i> {{ $statusLabel }}
                        </span>
                    </td>
                    <td>
                        <button class="btn-detail" onclick="openDetail({{ $p->id_pengajuan }})">
                            <i data-lucide="eye" style="width: 14px; height: 14px;"></i> Detail
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <i data-lucide="inbox" style="width: 48px; height: 48px; margin-bottom: 16px; opacity: 0.3;"></i>
                            <h4 style="margin: 0 0 8px 0; font-size: 1.1rem;">Tidak ada data pengajuan</h4>
                            <p style="margin: 0;">Coba sesuaikan filter pencarian Anda.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if(isset($permohonans) && method_exists($permohonans, 'hasPages') && $permohonans->hasPages())
    <div class="pagination-wrapper">
        <div style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600;">
            Menampilkan {{ $permohonans->firstItem() ?? 0 }} - {{ $permohonans->lastItem() ?? 0 }} dari {{ $permohonans->total() ?? 0 }}
        </div>
        <div style="display: flex; gap: 4px;">
            {{ $permohonans->links() }}
        </div>
    </div>
    @endif
</div>

<!-- Detail Modal -->
<div class="modal-overlay" id="detail-modal">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">
                <div style="background: #eff6ff; color: var(--primary); width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i data-lucide="file-text" style="width: 20px; height: 20px;"></i>
                </div>
                Detail Pengajuan <span id="modal-tiket" style="color: var(--primary);"></span>
            </h3>
            <button class="btn-close" onclick="closeDetail()">
                <i data-lucide="x" style="width: 20px; height: 20px;"></i>
            </button>
        </div>
        <div class="modal-body">
            <div style="margin-bottom: 24px; padding: 16px; background: #f8fafc; border-radius: 12px; display: flex; justify-content: space-between; align-items: center; border: 1px solid #e2e8f0;">
                <span style="font-weight: 700; color: var(--text-main);">Status Saat Ini</span>
                <span id="modal-status" class="status-badge"></span>
            </div>

            <div class="detail-grid">
                <div>
                    <div class="detail-item">
                        <div class="detail-label">Nama Sekolah</div>
                        <div class="detail-value" id="modal-school" style="display: flex; align-items: center; gap: 8px;">
                            <i data-lucide="school" style="width: 16px; height: 16px; color: var(--text-muted);"></i>
                            <span></span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Jenis Layanan</div>
                        <div class="detail-value" id="modal-layanan"></div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Lokasi Pelayanan</div>
                        <div class="detail-value" id="modal-lokasi" style="display: flex; align-items: flex-start; gap: 8px;">
                            <i data-lucide="map-pin" style="width: 16px; height: 16px; color: var(--text-muted); margin-top: 2px;"></i>
                            <span></span>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="detail-item">
                        <div class="detail-label">Jumlah Peserta</div>
                        <div class="detail-value" id="modal-peserta" style="display: flex; align-items: center; gap: 8px;">
                            <i data-lucide="users" style="width: 16px; height: 16px; color: var(--text-muted);"></i>
                            <span></span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Waktu Pengajuan</div>
                        <div class="detail-value" id="modal-tgl-pengajuan"></div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Jadwal Pelayanan</div>
                        <div class="detail-value" id="modal-tgl-pelayanan" style="color: var(--primary);"></div>
                    </div>
                </div>
            </div>

            <!-- Info Banner Jadwal -->
            <div id="modal-jadwal-banner" style="display: none; margin-top: 16px; background: linear-gradient(135deg, #eff6ff 0%, #f0fdf4 100%); border: 1px solid #bfdbfe; border-radius: 16px; padding: 20px; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -10px; right: -10px; width: 80px; height: 80px; background: rgba(59,130,246,0.08); border-radius: 50%;"></div>
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                    <div style="width: 36px; height: 36px; background: var(--primary); color: white; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i data-lucide="calendar-check" style="width: 18px; height: 18px;"></i>
                    </div>
                    <div>
                        <div style="font-size: 0.75rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 0.5px;">Informasi Penjadwalan</div>
                        <div style="font-size: 0.8rem; color: #64748b; font-weight: 500;">Dijadwalkan oleh Admin Disdukcapil</div>
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 12px;">
                    <div style="background: white; padding: 12px; border-radius: 10px; text-align: center; border: 1px solid #e2e8f0;">
                        <div style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 4px;">Tanggal</div>
                        <div id="modal-jadwal-tanggal" style="font-size: 0.9rem; font-weight: 800; color: var(--primary);"></div>
                    </div>
                    <div style="background: white; padding: 12px; border-radius: 10px; text-align: center; border: 1px solid #e2e8f0;">
                        <div style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 4px;">Waktu</div>
                        <div id="modal-jadwal-waktu" style="font-size: 0.9rem; font-weight: 800; color: #1e293b;"></div>
                    </div>
                    <div style="background: white; padding: 12px; border-radius: 10px; text-align: center; border: 1px solid #e2e8f0;">
                        <div style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 4px;">Petugas</div>
                        <div id="modal-jadwal-petugas" style="font-size: 0.9rem; font-weight: 800; color: #16a34a;"></div>
                    </div>
                </div>
            </div>

            <div class="detail-item" style="margin-top: 8px;">
                <div class="detail-label">Keterangan / Pesan</div>
                <div class="detail-value" id="modal-keterangan" style="background: #f8fafc; padding: 16px; border-radius: 12px; border: 1px solid #e2e8f0; font-weight: 500;"></div>
            </div>

            <!-- Petugas Penghubung (PIC) -->
            <div id="modal-pic-container" style="margin-top: 24px; border-top: 1px dashed #e2e8f0; padding-top: 20px; display: none;">
                <h4 style="font-size: 0.9rem; font-weight: 800; color: var(--primary); margin: 0 0 16px 0;">Petugas Penghubung (PIC)</h4>
                <div class="detail-grid">
                    <div>
                        <div class="detail-item">
                            <div class="detail-label">Nama PIC</div>
                            <div class="detail-value" id="modal-pic-nama"></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">NIK PIC</div>
                            <div class="detail-value" id="modal-pic-nik"></div>
                        </div>
                    </div>
                    <div>
                        <div class="detail-item">
                            <div class="detail-label">WhatsApp PIC</div>
                            <div class="detail-value" id="modal-pic-phone" style="color: #10b981; display: flex; align-items: center; gap: 6px;">
                                <i data-lucide="phone" style="width: 14px; height: 14px;"></i>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dokumen Lampiran -->
            <div id="modal-attachment-container" class="detail-item" style="margin-top: 24px; display: none;">
                <div class="detail-label">Dokumen Lampiran</div>
                <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                    <a id="modal-attachment-link" href="#" target="_blank" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; border: 1px solid #bfdbfe; border-radius: 12px; text-decoration: none; color: #1e40af; background: #eff6ff; font-weight: 700; font-size: 0.85rem; transition: background 0.2s;">
                        <i data-lucide="file-text" style="width: 18px; height: 18px;"></i>
                        <span>Surat Pengantar Sekolah</span>
                    </a>
                </div>
            </div>
            
            <div id="modal-realisasi-container" class="detail-item" style="margin-top: 24px; display: none;">
                <div class="detail-label">Realisasi Layanan (Cetak)</div>
                <div id="modal-realisasi" style="display: flex; gap: 12px; flex-wrap: wrap;"></div>
            </div>
        </div>
    </div>
</div>

<script>
    const pengajuanData = {
        @foreach($permohonans as $p)
        @php
            $school  = $p->user->school ?? $p->masyarakat->school ?? '—';
            $lokasi  = $p->alamat_lengkap ?? ($p->kantorPelayanan->nama ?? '—');
            $peserta = max((int)($p->jumlah_orang ?? 0), (int)($p->jumlah_realisasi ?? 0));
            $statusLabel = ['pending'=>'Menunggu','diproses'=>'Diproses','selesai'=>'Selesai','ditolak'=>'Ditolak'][$p->status] ?? $p->status;
            
            $statusCls = 'status-pending';
            $statusIcon = 'clock';
            if($p->status == 'diproses') { $statusCls = 'status-diproses'; $statusIcon = 'refresh-cw'; }
            if($p->status == 'selesai') { $statusCls = 'status-selesai'; $statusIcon = 'check-circle'; }
            if($p->status == 'ditolak') { $statusCls = 'status-ditolak'; $statusIcon = 'x-circle'; }

            $tglPengajuan = $p->tanggal_pengajuan->format('d M Y, H:i') . ' WIB';
            $tglPelayanan = $p->tanggal_kedatangan ? \Carbon\Carbon::parse($p->tanggal_kedatangan)->format('d M Y') : 'Belum dijadwalkan';
            $keterangan   = $p->keterangan ?? $p->detail_tambahan ?? '—';
            
            $ikd = $p->jumlah_ikd  ? "IKD: {$p->jumlah_ikd}" : null;
            $kia = $p->jumlah_kia  ? "KIA: {$p->jumlah_kia}" : null;
            $realisasi = $p->jumlah_realisasi ? "Cetak: {$p->jumlah_realisasi}" : null;

            // PIC Info
            $detail = json_decode($p->detail_pengajuan, true);
            $picNama = $detail['nama'] ?? $p->user->name ?? $p->masyarakat->nama ?? null;
            $picPhone = $detail['phone'] ?? $p->user->phone ?? $p->masyarakat->no_hp ?? null;
            $picNik = $detail['nik'] ?? $p->user->nik ?? $p->masyarakat->nik ?? null;
            $fileSuratPengantar = $p->file_surat_pengantar ? asset('storage/' . $p->file_surat_pengantar) : null;
            $jumlahPetugas = $p->jumlah_petugas ?? null;
            $jadwalWaktu = null;
            if ($detail && isset($detail['usulan_jam_mulai']) && isset($detail['usulan_jam_selesai'])) {
                $jadwalWaktu = $detail['usulan_jam_mulai'] . ' - ' . $detail['usulan_jam_selesai'] . ' WIB';
            }
        @endphp
        {{ $p->id_pengajuan }}: {
            tiket:       "#{{ $p->nomor_tiket }}",
            school:      @json($school),
            layanan:     @json($p->jenis_layanan ?? '—'),
            peserta:     "{{ $peserta > 0 ? $peserta . ' Orang' : '—' }}",
            tglPengajuan:@json($tglPengajuan),
            tglPelayanan:@json($tglPelayanan),
            lokasi:      @json($lokasi),
            statusLabel: @json($statusLabel),
            statusCls:   @json($statusCls),
            statusIcon:  @json($statusIcon),
            keterangan:  @json($keterangan),
            tags:        [@json($ikd), @json($kia), @json($realisasi)].filter(Boolean),
            picNama:     @json($picNama),
            picPhone:    @json($picPhone),
            picNik:      @json($picNik),
            fileSuratPengantar: @json($fileSuratPengantar),
            jumlahPetugas: @json($jumlahPetugas),
            jadwalWaktu: @json($jadwalWaktu),
            statusRaw:   @json($p->status)
        },
        @endforeach
    };

    function openDetail(id) {
        const d = pengajuanData[id];
        if (!d) return;

        document.getElementById('modal-tiket').textContent = d.tiket;
        
        const statusBadge = document.getElementById('modal-status');
        statusBadge.className = 'status-badge ' + d.statusCls;
        statusBadge.innerHTML = `<i data-lucide="${d.statusIcon}" style="width: 14px; height: 14px;"></i> ${d.statusLabel}`;
        
        document.querySelector('#modal-school span').textContent = d.school;
        document.getElementById('modal-layanan').textContent = d.layanan;
        document.querySelector('#modal-peserta span').textContent = d.peserta;
        document.getElementById('modal-tgl-pengajuan').textContent = d.tglPengajuan;
        document.getElementById('modal-tgl-pelayanan').textContent = d.tglPelayanan;
        document.querySelector('#modal-lokasi span').textContent = d.lokasi;
        document.getElementById('modal-keterangan').textContent = d.keterangan;

        // Jadwal Banner (show when scheduled)
        const jadwalBanner = document.getElementById('modal-jadwal-banner');
        if (['terjadwal', 'diproses', 'selesai'].includes(d.statusRaw) && (d.tglPelayanan !== 'Belum dijadwalkan' || d.jumlahPetugas)) {
            document.getElementById('modal-jadwal-tanggal').textContent = d.tglPelayanan || '—';
            document.getElementById('modal-jadwal-waktu').textContent = d.jadwalWaktu || '—';
            document.getElementById('modal-jadwal-petugas').textContent = d.jumlahPetugas ? d.jumlahPetugas + ' Orang' : '—';
            jadwalBanner.style.display = 'block';
        } else {
            jadwalBanner.style.display = 'none';
        }

        // PIC details
        const picContainer = document.getElementById('modal-pic-container');
        if (d.picNama || d.picPhone || d.picNik) {
            document.getElementById('modal-pic-nama').textContent = d.picNama || '—';
            document.getElementById('modal-pic-nik').textContent = d.picNik || '—';
            document.querySelector('#modal-pic-phone span').textContent = d.picPhone || '—';
            picContainer.style.display = 'block';
        } else {
            picContainer.style.display = 'none';
        }

        // Attachments
        const attachmentContainer = document.getElementById('modal-attachment-container');
        const attachmentLink = document.getElementById('modal-attachment-link');
        if (d.fileSuratPengantar) {
            attachmentLink.href = d.fileSuratPengantar;
            attachmentContainer.style.display = 'block';
        } else {
            attachmentContainer.style.display = 'none';
        }

        const realisasiContainer = document.getElementById('modal-realisasi-container');
        const realisasiBox = document.getElementById('modal-realisasi');
        
        if (d.tags && d.tags.length > 0) {
            realisasiBox.innerHTML = d.tags.map(t => 
                `<span style="background: var(--primary); color: white; padding: 6px 12px; border-radius: 8px; font-size: 0.8rem; font-weight: 700;">${t}</span>`
            ).join('');
            realisasiContainer.style.display = 'block';
        } else {
            realisasiContainer.style.display = 'none';
        }

        if (window.lucide) {
            window.lucide.createIcons();
        }

        const modal = document.getElementById('detail-modal');
        modal.classList.add('active');
    }

    function closeDetail() {
        const modal = document.getElementById('detail-modal');
        modal.classList.remove('active');
    }

    document.addEventListener('keydown', e => { 
        if (e.key === 'Escape') closeDetail(); 
    });
</script>
@endsection
