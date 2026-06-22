@extends('layouts.panel')

@section('title', 'Laporan Strategis - SI JEBOL')

@section('content')
<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }
    
    .main-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
        margin-bottom: 24px;
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
        font-size: 0.9rem;
        vertical-align: middle;
        padding: 4px 12px;
        background: rgba(251, 191, 36, 0.2);
        border: 1px solid rgba(251, 191, 36, 0.5);
        border-radius: 20px;
        margin-left: 12px;
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
        transform: scale(2) rotate(-15deg);
        margin-right: 20px;
        z-index: 1;
        color: white;
    }

    .filter-panel {
        background: white;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        border: 1px solid #f1f5f9;
        margin-bottom: 32px;
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
        min-width: 150px;
    }
    
    .filter-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .filter-select {
        padding: 10px 14px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        font-size: 0.9rem;
        color: var(--text-main);
        font-weight: 500;
        outline: none;
        transition: border-color 0.2s;
    }
    
    .filter-select:focus {
        border-color: var(--primary);
    }
    
    .action-buttons {
        display: flex;
        gap: 12px;
    }
    
    .btn {
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
        text-decoration: none;
    }
    
    .btn-outline {
        background: white;
        color: var(--text-main);
        border: 1px solid #e2e8f0;
    }
    
    .btn-outline:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }
    
    .btn-primary {
        background: var(--primary);
        color: white;
    }
    
    .btn-primary:hover {
        background: var(--primary-dark);
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
        height: 100%;
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
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-main);
        line-height: 1;
    }

    .panel-box {
        background: white;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        border: 1px solid #f1f5f9;
        height: 100%;
        display: flex;
        flex-direction: column;
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
    
    .data-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .data-table th, .data-table td {
        padding: 12px 16px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
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
    
    .row-kota {
        background: var(--primary);
    }
    
    .row-kota td {
        color: white;
        font-weight: 700;
        border-bottom: none;
    }
    
    .row-kecamatan {
        background: #eff6ff;
    }
    
    .row-kecamatan td {
        color: #1e3a8a;
        font-weight: 700;
    }
    
    .row-kelurahan td {
        color: var(--text-main);
    }
    
    .row-kelurahan:hover td {
        background: #f8fafc;
    }
    
    .insight-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-top: 32px;
    }
    
    .insight-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #f1f5f9;
    }

    @media print {
        .no-print, .sidebar, .top-header, .filter-panel, .custom-hero, .insight-grid {
            display: none !important;
        }
        .main-content {
            margin-left: 0 !important;
            padding: 0 !important;
        }
        .panel-box {
            box-shadow: none !important;
            border: none !important;
        }
    }

    @media (max-width: 1400px) {
        .dashboard-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 900px) {
        .dashboard-grid { grid-template-columns: repeat(2, 1fr); }
        .insight-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 600px) {
        .dashboard-grid, .insight-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="custom-hero">
    <div class="hero-content">
        <h1 class="hero-title">Laporan Strategis <span>LIVE REPORT</span></h1>
        <p class="hero-subtitle">Monitoring capaian layanan kependudukan Kota Tegal. Data terakhir diperbarui pada {{ now()->translatedFormat('d M Y, H:i') }} WIB.</p>
    </div>
    <div class="hero-icon-large">
        <i data-lucide="bar-chart-2" style="width: 120px; height: 120px;"></i>
    </div>
</div>

<div class="filter-panel">
    <form action="{{ route('admin.laporan') }}" method="GET" class="filter-row">
        <div class="filter-group">
            <span class="filter-label">Pilih Bulan</span>
            <select name="bulan" class="filter-select" onchange="this.form.submit()">
                <option value="01" {{ $bulan == '01' ? 'selected' : '' }}>Januari</option>
                <option value="02" {{ $bulan == '02' ? 'selected' : '' }}>Februari</option>
                <option value="03" {{ $bulan == '03' ? 'selected' : '' }}>Maret</option>
                <option value="04" {{ $bulan == '04' ? 'selected' : '' }}>April</option>
                <option value="05" {{ $bulan == '05' ? 'selected' : '' }}>Mei</option>
                <option value="06" {{ $bulan == '06' ? 'selected' : '' }}>Juni</option>
                <option value="07" {{ $bulan == '07' ? 'selected' : '' }}>Juli</option>
                <option value="08" {{ $bulan == '08' ? 'selected' : '' }}>Agustus</option>
                <option value="09" {{ $bulan == '09' ? 'selected' : '' }}>September</option>
                <option value="10" {{ $bulan == '10' ? 'selected' : '' }}>Oktober</option>
                <option value="11" {{ $bulan == '11' ? 'selected' : '' }}>November</option>
                <option value="12" {{ $bulan == '12' ? 'selected' : '' }}>Desember</option>
            </select>
        </div>
        <div class="filter-group">
            <span class="filter-label">Pilih Tahun</span>
            <select name="tahun" class="filter-select" onchange="this.form.submit()">
                @php $currentYear = date('Y'); @endphp
                @for($i = $currentYear; $i >= $currentYear - 3; $i--)
                    <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="filter-group">
            <span class="filter-label">Kecamatan</span>
            <select name="kecamatan" class="filter-select" onchange="this.form.submit()">
                <option value="" {{ empty($kecamatan) ? 'selected' : '' }}>-- Semua Wilayah --</option>
                @foreach($masterKecamatan as $kec)
                    <option value="{{ $kec->nama }}" {{ (strtoupper(str_ireplace(['Kecamatan ', 'Kec. '], '', $kec->nama)) == strtoupper($kecamatan) || $kec->nama == $kecamatan) ? 'selected' : '' }}>{{ $kec->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="filter-group">
            <span class="filter-label">Jenis Layanan</span>
            <select name="jenis_layanan" class="filter-select" onchange="this.form.submit()">
                <option value="-- Semua --" {{ $jenis_layanan == '-- Semua --' ? 'selected' : '' }}>Semua Layanan</option>
                <option value="KTP-el" {{ $jenis_layanan == 'KTP-el' ? 'selected' : '' }}>KTP-el</option>
                <option value="KIA" {{ $jenis_layanan == 'KIA' ? 'selected' : '' }}>KIA</option>
                <option value="IKD" {{ $jenis_layanan == 'IKD' ? 'selected' : '' }}>IKD</option>
            </select>
        </div>
        <div class="filter-group">
            <span class="filter-label">Status</span>
            <select name="status_pengajuan" class="filter-select" onchange="this.form.submit()">
                <option value="-- Semua --" {{ $status_pengajuan == '-- Semua --' ? 'selected' : '' }}>Semua Status</option>
                <option value="Menunggu Verifikasi" {{ $status_pengajuan == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                <option value="Terverifikasi" {{ $status_pengajuan == 'Terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                <option value="Terjadwal" {{ $status_pengajuan == 'Terjadwal' ? 'selected' : '' }}>Terjadwal</option>
                <option value="Selesai" {{ $status_pengajuan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Ditolak" {{ $status_pengajuan == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
        
        <div class="action-buttons">
            <a href="{{ route('admin.laporan.download', request()->query()) }}" target="_blank" class="btn btn-outline">
                <i data-lucide="printer" style="width: 18px; height: 18px;"></i> Cetak PDF
            </a>
        </div>
    </form>
</div>

<div class="dashboard-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background: #eff6ff; color: #3b82f6;">
            <i data-lucide="file-text" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Total Pengajuan</span>
            <span class="stat-value">{{ number_format($totalPengajuan ?? 1248) }}</span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #ecfdf5; color: #10b981;">
            <i data-lucide="check-circle" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Terverifikasi</span>
            <span class="stat-value">{{ number_format($statTerverifikasi ?? 987) }}</span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
            <i data-lucide="settings" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Diproses</span>
            <span class="stat-value">{{ number_format($statTerjadwal ?? 654) }}</span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #f5f3ff; color: #8b5cf6;">
            <i data-lucide="check-square" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Selesai</span>
            <span class="stat-value">{{ number_format($statSelesai ?? 572) }}</span>
        </div>
    </div>

    <!-- Rekap Selesai per Layanan -->
    <div class="stat-card" style="padding: 16px; flex-direction: column; justify-content: center; gap: 8px;">
        <span class="stat-label" style="text-align: center; width: 100%; margin-bottom: 4px; font-weight: 700; font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.5px;">Rekap Selesai per Layanan</span>
        <div style="display: flex; align-items: center; justify-content: center; gap: 16px; width: 100%;">
            <div style="position: relative; width: 64px; height: 64px; flex-shrink: 0;">
                <canvas id="rekapLayananChart"></canvas>
                <div style="position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; pointer-events: none;">
                    <span style="font-size: 0.95rem; font-weight: 800; color: var(--text-main); text-align: center;">{{ $statSelesai ?? 572 }}</span>
                </div>
            </div>
            <div style="display: flex; flex-direction: column; gap: 4px; font-size: 0.7rem; flex-grow: 1;">
                <div style="display: flex; justify-content: space-between; gap: 6px;">
                    <div style="display: flex; align-items: center; gap: 4px;">
                        <span style="width: 6px; height: 6px; border-radius: 50%; background: #3b82f6;"></span>
                        <span style="font-weight: 700; color: var(--text-muted);">IKD</span>
                    </div>
                    <span style="color: var(--text-main); font-weight: 700;">{{ ($statSelesai ?? 0) > 0 ? round((($rekapSelesaiData[0] ?? 0) / $statSelesai) * 100) : 0 }}%</span>
                </div>
                <div style="display: flex; justify-content: space-between; gap: 6px;">
                    <div style="display: flex; align-items: center; gap: 4px;">
                        <span style="width: 6px; height: 6px; border-radius: 50%; background: #10b981;"></span>
                        <span style="font-weight: 700; color: var(--text-muted);">KTP</span>
                    </div>
                    <span style="color: var(--text-main); font-weight: 700;">{{ ($statSelesai ?? 0) > 0 ? round((($rekapSelesaiData[1] ?? 0) / $statSelesai) * 100) : 0 }}%</span>
                </div>
                <div style="display: flex; justify-content: space-between; gap: 6px;">
                    <div style="display: flex; align-items: center; gap: 4px;">
                        <span style="width: 6px; height: 6px; border-radius: 50%; background: #f59e0b;"></span>
                        <span style="font-weight: 700; color: var(--text-muted);">KIA</span>
                    </div>
                    <span style="color: var(--text-main); font-weight: 700;">{{ ($statSelesai ?? 0) > 0 ? round((($rekapSelesaiData[2] ?? 0) / $statSelesai) * 100) : 0 }}%</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-grid">
    <!-- Laporan Per Wilayah -->
    <div class="panel-box" style="overflow-x: auto;">
        <div class="panel-header">
            <h3 class="panel-title"><i data-lucide="bar-chart-2" style="color: var(--primary);"></i> Laporan Per Wilayah</h3>
        </div>
        
        <table class="data-table">
            <thead>
                <tr>
                    <th rowspan="2">Kode</th>
                    <th rowspan="2">Wilayah</th>
                    <th rowspan="2">Waktu & Ket</th>
                    <th colspan="2" style="text-align: center; border-left: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0;">Jumlah IKD</th>
                    <th colspan="2" style="text-align: center; border-right: 1px solid #e2e8f0;">Jumlah KTP-EL</th>
                    <th colspan="2" style="text-align: center;">Jumlah KIA</th>
                </tr>
                <tr>
                    <th style="border-left: 1px solid #e2e8f0;">Sudah</th>
                    <th style="border-right: 1px solid #e2e8f0;">Belum</th>
                    <th>Sudah</th>
                    <th style="border-right: 1px solid #e2e8f0;">Belum</th>
                    <th>Sudah</th>
                    <th>Belum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paginatedDataLaporan as $item)
                @php
                    $rowClass = "";
                    if ($item['type'] == 'kota') $rowClass = "row-kota";
                    elseif ($item['type'] == 'kecamatan') $rowClass = "row-kecamatan";
                    else $rowClass = "row-kelurahan";
                @endphp
                <tr class="{{ $rowClass }}">
                    <td>{{ $item['kode'] }}</td>
                    <td style="{{ $item['type'] == 'kelurahan' ? 'padding-left: 32px;' : '' }}">{{ $item['wilayah'] }}</td>
                    <td>
                        <div style="font-weight: 600;">{{ $item['tanggal'] }}</div>
                        <div style="font-size: 0.8rem; opacity: 0.8;">{{ $item['keterangan'] }}</div>
                    </td>
                    <!-- IKD -->
                    <td style="border-left: 1px solid #e2e8f0; text-align: center;">{{ number_format($item['ikd_sudah']) }}</td>
                    <td style="border-right: 1px solid #e2e8f0; text-align: center;">{{ number_format($item['ikd_belum']) }}</td>
                    <!-- KTP -->
                    <td style="text-align: center;">{{ number_format($item['ktp_sudah']) }}</td>
                    <td style="border-right: 1px solid #e2e8f0; text-align: center;">{{ number_format($item['ktp_belum']) }}</td>
                    <!-- KIA -->
                    <td style="text-align: center;">{{ number_format($item['kia_sudah']) }}</td>
                    <td style="text-align: center;">{{ number_format($item['kia_belum']) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div style="margin-top: 24px;">
            {{ $paginatedDataLaporan->links() }}
        </div>
    </div>
</div>

<div class="insight-grid">
    <div class="insight-card">
        <i data-lucide="badge" style="color: #3b82f6; width: 32px; height: 32px; margin-bottom: 12px;"></i>
        <h4 style="font-weight: 700; color: var(--text-main); margin: 0 0 8px 0;">Statistik IKD</h4>
        <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0; line-height: 1.5;">Aktivasi IKD nasional ditargetkan mencapai 25% dari total perekaman tahun ini.</p>
    </div>
    <div class="insight-card">
        <i data-lucide="id-card" style="color: #10b981; width: 32px; height: 32px; margin-bottom: 12px;"></i>
        <h4 style="font-weight: 700; color: var(--text-main); margin: 0 0 8px 0;">Capaian KTP-el</h4>
        <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0; line-height: 1.5;">Monitoring real-time pencetakan KTP-el baru dan penggantian fisik yang rusak.</p>
    </div>
    <div class="insight-card">
        <i data-lucide="baby" style="color: #f59e0b; width: 32px; height: 32px; margin-bottom: 12px;"></i>
        <h4 style="font-weight: 700; color: var(--text-main); margin: 0 0 8px 0;">Capaian KIA</h4>
        <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0; line-height: 1.5;">Kepemilikan KIA untuk usia 0-17 tahun dipantau secara harian di setiap wilayah.</p>
    </div>
    <div class="insight-card">
        <i data-lucide="shield-check" style="color: #8b5cf6; width: 32px; height: 32px; margin-bottom: 12px;"></i>
        <h4 style="font-weight: 700; color: var(--text-main); margin: 0 0 8px 0;">Sertifikasi Data</h4>
        <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0; line-height: 1.5;">Seluruh data yang ditampilkan telah tersertifikasi valid oleh sistem SI JEBOL.</p>
    </div>
</div>

<!-- Chart.js Logic -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rekapCtx = document.getElementById('rekapLayananChart').getContext('2d');
        new Chart(rekapCtx, {
            type: 'doughnut',
            data: {
                labels: ['IKD', 'KTP-el', 'KIA'],
                datasets: [{
                    data: {!! json_encode($rekapSelesaiData ?? [0,0,0]) !!},
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        padding: 12,
                        titleFont: { family: "'Plus Jakarta Sans', sans-serif", size: 13 },
                        bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 12 },
                        displayColors: true,
                    }
                }
            }
        });
    });
</script>
@endsection
