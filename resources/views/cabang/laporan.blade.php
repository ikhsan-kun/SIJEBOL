@extends('layouts.panel')

@section('title', 'Laporan Pelayanan Cabang - SI JEBOL')

@section('content')
<style>
    :root {
        --primary: #003178;
        --primary-light: #e0eaff;
        --accent: #f59e0b;
    }

    .laporan-header {
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

    .laporan-header::after {
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

    .laporan-title-wrap {
        position: relative;
        z-index: 10;
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .laporan-icon {
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

    .laporan-title {
        font-size: 1.8rem;
        font-weight: 800;
        margin: 0 0 4px 0;
        line-height: 1.2;
    }

    .laporan-subtitle {
        font-size: 0.95rem;
        color: rgba(255,255,255,0.85);
        margin: 0;
    }

    /* Filter Card */
    .filter-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
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
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
    }

    .filter-input-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }

    .filter-input-wrap i {
        position: absolute;
        left: 12px;
        color: #94a3b8;
        width: 18px;
    }

    .filter-select, .filter-input {
        width: 100%;
        padding: 10px 12px 10px 40px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #334155;
        background-color: #f8fafc;
        outline: none;
        appearance: none;
    }

    .filter-select:focus, .filter-input:focus {
        border-color: var(--primary);
        background-color: white;
    }

    .btn-search {
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 11px 24px;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
    }

    .btn-search:hover {
        background: #00255a;
    }

    .btn-export {
        background: white;
        color: #334155;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 11px 18px;
        font-weight: 600;
        font-size: 0.9rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        text-decoration: none;
    }

    .btn-export:hover {
        background: #f8fafc;
        border-color: #94a3b8;
    }

    .btn-export-primary {
        background: var(--accent);
        color: var(--primary-dark);
        border: none;
    }

    .btn-export-primary:hover {
        background: #d97706;
        color: white;
    }

    /* Table Styling */
    .table-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border: 1px solid #f1f5f9;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .custom-table th {
        padding: 16px 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #64748b;
        border-bottom: 2px solid #e2e8f0;
        background: #f8fafc;
    }

    .custom-table td {
        padding: 16px 20px;
        font-size: 0.9rem;
        color: #334155;
        border-bottom: 1px solid #edf2f7;
        vertical-align: middle;
    }

    .custom-table tr:hover {
        background-color: #f8fafc;
    }

    .badge-tingkat {
        background-color: #eff6ff;
        color: #1d4ed8;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .badge-layanan {
        background-color: #f0fdf4;
        color: #166534;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
    }
</style>

<!-- Header -->
<div class="laporan-header">
    <div class="laporan-title-wrap">
        <div class="laporan-icon">
            <i data-lucide="bar-chart-3" style="width: 32px; height: 32px; color: white;"></i>
        </div>
        <div>
            <h1 class="laporan-title">Laporan Pelayanan</h1>
            <p class="laporan-subtitle">Cabang Dinas Pendidikan Kota Tegal</p>
        </div>
    </div>
</div>

<!-- Filter & Actions -->
<div class="filter-card">
    <div class="filter-form">
        <form action="{{ route('cabang.laporan') }}" method="GET" class="filter-form" style="flex: 1;">
            <input type="hidden" name="tab" value="{{ $tab }}">
            
            <div class="filter-group">
                <span class="filter-label">Bulan</span>
                <div class="filter-input-wrap">
                    <i data-lucide="calendar"></i>
                    <select name="bulan" class="filter-select">
                        <option value="">Semua Bulan</option>
                        @for($i=1; $i<=12; $i++)
                            <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="filter-group">
                <span class="filter-label">Tahun</span>
                <div class="filter-input-wrap">
                    <i data-lucide="calendar-days"></i>
                    <input type="number" name="tahun" value="{{ $tahun }}" min="2000" max="2100" placeholder="Tahun" class="filter-input">
                </div>
            </div>

            <button type="submit" class="btn-search">
                <i data-lucide="search" style="width: 16px;"></i> Cari
            </button>
        </form>

        <div style="display: flex; gap: 12px;">
            <a href="{{ route('cabang.cetakPdf', ['tab' => $tab, 'tahun' => $tahun, 'bulan' => $bulan]) }}" target="_blank" class="btn-export">
                <i data-lucide="printer" style="width: 16px;"></i> Cetak PDF
            </a>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="table-card">
    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width: 60px; text-align: center;">No</th>
                    <th>NPSN</th>
                    <th>Nama Sekolah</th>
                    <th>Jenjang</th>
                    <th>Wilayah</th>
                    <th style="text-align: center;">Target Siswa</th>
                    <th style="text-align: center;">Sudah Pelayanan</th>
                    <th style="text-align: center;">Belum Pelayanan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($school_stats as $index => $stat)
                    <tr>
                        <td style="text-align: center; font-weight: 600;">{{ $loop->iteration }}</td>
                        <td style="font-family: monospace; font-weight: 600; color: #475569;">{{ $stat->npsn }}</td>
                        <td style="font-weight: 700; color: var(--primary);">{{ $stat->nama_sekolah }}</td>
                        <td>
                            <span class="badge-tingkat">{{ $stat->tingkat }}</span>
                        </td>
                        <td>
                            <div style="font-weight: 600; color: #1e293b;">{{ $stat->kecamatan }}</div>
                            @if($stat->kelurahan && $stat->kelurahan !== '-')
                                <div style="font-size: 0.75rem; color: #64748b;">{{ $stat->kelurahan }}</div>
                            @endif
                        </td>
                        <td style="text-align: center; font-weight: 700; color: #334155;">{{ $stat->keseluruhan }}</td>
                        <td style="text-align: center;">
                            <span style="display: inline-block; background-color: #f0fdf4; color: #16a34a; padding: 4px 10px; border-radius: 6px; font-weight: 700; font-size: 0.85rem; min-width: 45px;">
                                {{ $stat->sudah }}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            @if($stat->belum > 0)
                                <span style="display: inline-block; background-color: #fef2f2; color: #dc2626; padding: 4px 10px; border-radius: 6px; font-weight: 700; font-size: 0.85rem; min-width: 45px;">
                                    {{ $stat->belum }}
                                </span>
                            @else
                                <span style="display: inline-block; background-color: #f0fdf4; color: #16a34a; padding: 4px 10px; border-radius: 6px; font-weight: 700; font-size: 0.85rem; min-width: 45px;">
                                    0
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px; color: #64748b;">
                            Tidak ada data laporan untuk kriteria pencarian ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
