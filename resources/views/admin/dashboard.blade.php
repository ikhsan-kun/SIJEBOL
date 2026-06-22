@extends('layouts.panel')

@section('title', 'Dashboard Admin')

@section('content')
<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }
    
    .main-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
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

    .panel-action {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--primary);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 4px;
        padding: 6px 12px;
        border-radius: 8px;
        background: #f8fafc;
        transition: background 0.2s;
    }

    .panel-action:hover {
        background: #f1f5f9;
        text-decoration: none;
    }

    .chart-container {
        position: relative;
        height: 320px;
        width: 100%;
        flex-grow: 1;
    }

    .list-group {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .list-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px;
        border-radius: 16px;
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        transition: all 0.2s;
    }

    .list-item:hover {
        background: white;
        border-color: #e2e8f0;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }

    .list-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
    }

    .list-content {
        flex-grow: 1;
    }

    .list-title {
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--text-main);
        margin: 0 0 4px 0;
    }

    .list-desc {
        font-size: 0.8rem;
        color: var(--text-muted);
        margin: 0;
    }

    .list-meta {
        text-align: right;
    }

    .list-date {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-muted);
        display: block;
        margin-bottom: 6px;
    }

    .progress-bar {
        width: 100%;
        height: 6px;
        background: #f1f5f9;
        border-radius: 6px;
        overflow: hidden;
        margin-top: 8px;
    }

    .progress-value {
        height: 100%;
        border-radius: 6px;
    }

    @media (max-width: 1200px) {
        .dashboard-grid { grid-template-columns: repeat(2, 1fr); }
        .main-grid { grid-template-columns: 1fr; }
    }
    
    @media (max-width: 768px) {
        .dashboard-grid { grid-template-columns: 1fr; }
        .custom-hero { flex-direction: column; text-align: center; padding: 32px 24px; }
        .hero-icon-large { display: none; }
    }
</style>

<div class="custom-hero">
    <div class="hero-content">
        @php
            $hour = now()->hour;
            $greeting = 'Malam';
            if ($hour >= 5 && $hour < 11) $greeting = 'Pagi';
            elseif ($hour >= 11 && $hour < 15) $greeting = 'Siang';
            elseif ($hour >= 15 && $hour < 18) $greeting = 'Sore';
        @endphp
        <h1 class="hero-title">Selamat {{ $greeting }}, <span>{{ explode(' ', Auth::guard('admin')->user()->name ?? 'Admin')[0] }}!</span> 👋</h1>
        <p class="hero-subtitle">Berikut adalah ringkasan performa layanan SI JEBOL Kota Tegal. Pantau terus statistik harian untuk memberikan pelayanan terbaik bagi masyarakat.</p>
        
        <form method="GET" action="{{ route('admin.dashboard') }}" style="margin-top: 20px; display: flex; gap: 12px; align-items: center; background: rgba(255,255,255,0.1); padding: 12px 20px; border-radius: 12px; backdrop-filter: blur(5px); width: max-content; border: 1px solid rgba(255,255,255,0.2);">
            <div style="display: flex; align-items: center; gap: 8px;">
                <i data-lucide="filter" style="width: 16px; height: 16px; color: white;"></i>
                <span style="font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Filter Data:</span>
            </div>
            <select name="month" onchange="this.form.submit()" style="background: rgba(255,255,255,0.9); border: none; padding: 6px 12px; border-radius: 6px; font-size: 0.9rem; color: #334155; font-weight: 600; cursor: pointer; outline: none;">
                <option value="">Semua Bulan</option>
                @foreach(range(1, 12) as $m)
                    <option value="{{ $m }}" {{ request('month', $bulan) == $m ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                    </option>
                @endforeach
            </select>
            <select name="year" onchange="this.form.submit()" style="background: rgba(255,255,255,0.9); border: none; padding: 6px 12px; border-radius: 6px; font-size: 0.9rem; color: #334155; font-weight: 600; cursor: pointer; outline: none;">
                @foreach(range(date('Y') - 2, date('Y')) as $y)
                    <option value="{{ $y }}" {{ request('year', $tahun) == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endforeach
            </select>
        </form>
    </div>
    <div class="hero-schedule-card" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); padding: 24px; border-radius: 20px; color: white; width: 320px; z-index: 10; flex-shrink: 0; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
        @php $nextSchedule = $upcomingSchedules->first(); @endphp
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <span style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #fbbf24;">Jadwal Terdekat</span>
            <i data-lucide="calendar-clock" style="width: 20px; height: 20px; color: #fbbf24;"></i>
        </div>
        @if($nextSchedule)
            <div style="display: flex; gap: 16px; align-items: center; margin-bottom: 20px;">
                <div style="background: white; color: var(--primary); padding: 12px; border-radius: 14px; text-align: center; min-width: 65px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    <span style="display: block; font-size: 1.6rem; font-weight: 800; line-height: 1;">{{ \Carbon\Carbon::parse($nextSchedule->tanggal_pelayanan)->format('d') }}</span>
                    <span style="display: block; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin-top: 4px;">{{ \Carbon\Carbon::parse($nextSchedule->tanggal_pelayanan)->translatedFormat('M') }}</span>
                </div>
                <div>
                    <h4 style="margin: 0 0 6px 0; font-size: 1.15rem; font-weight: 700; line-height: 1.3;">{{ $nextSchedule->lokasi }}</h4>
                    <p style="margin: 0; font-size: 0.85rem; opacity: 0.9; display: flex; align-items: center; gap: 4px;">
                        <i data-lucide="map-pin" style="width: 14px; height: 14px;"></i> {{ $nextSchedule->kecamatan }}
                    </p>
                </div>
            </div>
            <div style="background: rgba(0, 0, 0, 0.2); padding: 12px 16px; border-radius: 12px; display: flex; justify-content: space-between; align-items: center; font-size: 0.85rem; font-weight: 600;">
                <div style="display: flex; align-items: center; gap: 6px;">
                    <i data-lucide="clock" style="width: 14px; height: 14px; color: #93c5fd;"></i>
                    <span style="color: #e2e8f0;">Pukul:</span>
                </div>
                <span>{{ \Carbon\Carbon::parse($nextSchedule->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($nextSchedule->waktu_selesai)->format('H:i') }} WIB</span>
            </div>
        @else
            <div style="text-align: center; padding: 20px 0; opacity: 0.7;">
                <i data-lucide="calendar-x" style="width: 32px; height: 32px; margin-bottom: 8px;"></i>
                <p style="margin: 0; font-size: 0.9rem;">Belum ada jadwal pelayanan terdekat</p>
            </div>
        @endif
    </div>
</div>

<div class="dashboard-grid">
    <a href="{{ route('admin.permohonan') }}" class="stat-card" style="text-decoration: none; color: inherit;">
        <div class="stat-icon" style="background: #eff6ff; color: #3b82f6;">
            <i data-lucide="file-text" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Total Pengajuan</span>
            <span class="stat-value">{{ number_format($totalPengajuan) }}</span>
        </div>
    </a>
    
    <a href="{{ route('admin.permohonan') }}" class="stat-card" style="text-decoration: none; color: inherit;">
        <div class="stat-icon" style="background: #ecfdf5; color: #10b981;">
            <i data-lucide="check-circle" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Pengajuan Selesai</span>
            <span class="stat-value">{{ number_format($totalSelesai) }}</span>
        </div>
    </a>
    
    <a href="{{ route('admin.jadwal') }}" class="stat-card" style="text-decoration: none; color: inherit;">
        <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
            <i data-lucide="calendar-days" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Jadwal JEBOL</span>
            <span class="stat-value">{{ number_format($totalJadwal) }}</span>
        </div>
    </a>
    
    <a href="{{ route('admin.users') }}" class="stat-card" style="text-decoration: none; color: inherit;">
        <div class="stat-icon" style="background: #f5f3ff; color: #8b5cf6;">
            <i data-lucide="users" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Total Pengguna</span>
            <span class="stat-value">{{ number_format($totalPengguna) }}</span>
        </div>
    </a>
</div>

<div class="main-grid">
    <!-- Kiri: Chart -->
    <div class="panel-box">
        <div class="panel-header">
            <h3 class="panel-title"><i data-lucide="trending-up" style="color: var(--primary);"></i> {{ $chartTitle }}</h3>
            <div style="display:flex; gap: 8px;">
                <span class="badge" style="background:#eff6ff; color:#3b82f6;"><i data-lucide="circle" style="fill:#3b82f6; width:8px; height:8px;"></i> Total</span>
                <span class="badge" style="background:#ecfdf5; color:#10b981;"><i data-lucide="circle" style="fill:#10b981; width:8px; height:8px;"></i> Selesai</span>
            </div>
        </div>
        <div class="chart-container" style="position: relative; height: 320px;">
            <div id="pengajuanChart" style="height: 100%; width: 100%;"></div>
        </div>
    </div>

    <!-- Kanan: Sebaran Layanan -->
    <div class="panel-box">
        <div class="panel-header">
            <h3 class="panel-title"><i data-lucide="pie-chart" style="color: var(--primary);"></i> Sebaran Layanan</h3>
        </div>
        
        <div class="list-group">
            @forelse($sebaranLayanan as $layanan)
                @php
                    $percent = $totalPengajuan > 0 ? round(($layanan->total / $totalPengajuan) * 100) : 0;
                    $bgGradient = 'linear-gradient(90deg, #3b82f6, #60a5fa)';
                    $glowColor = 'rgba(59, 130, 246, 0.4)';
                    if (str_contains(strtolower($layanan->jenis_layanan), 'kia')) {
                        $bgGradient = 'linear-gradient(90deg, #f59e0b, #fbbf24)';
                        $glowColor = 'rgba(245, 158, 11, 0.4)';
                    }
                    elseif (str_contains(strtolower($layanan->jenis_layanan), 'ikd')) {
                        $bgGradient = 'linear-gradient(90deg, #10b981, #34d399)';
                        $glowColor = 'rgba(16, 185, 129, 0.4)';
                    }
                @endphp
                <div class="list-item" style="border: none; padding: 0; background: transparent; display: block; margin-bottom: 16px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 8px;">
                        <span style="font-weight: 700; color: var(--text-main); font-size: 0.95rem;">
                            {{ $layanan->jenis_layanan }}
                        </span>
                        <div style="text-align: right;">
                            <span style="font-weight: 800; color: var(--text-main); font-size: 1.1rem;">
                                {{ number_format($layanan->total) }}
                            </span>
                            <span style="font-size: 0.8rem; font-weight: 600; color: var(--text-muted); margin-left: 4px;">({{ $percent }}%)</span>
                        </div>
                    </div>
                    <div style="width: 100%; height: 10px; background: #e2e8f0; border-radius: 10px; overflow: visible;">
                        <div style="width: {{ $percent }}%; background: {{ $bgGradient }}; height: 10px; border-radius: 10px; box-shadow: 0 4px 10px {{ $glowColor }}; position: relative; overflow: hidden;">
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent); transform: skewX(-20deg); animation: shimmer 2s infinite;"></div>
                        </div>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 30px; color: var(--text-muted);">
                    <i data-lucide="bar-chart-2" style="width: 48px; height: 48px; margin-bottom: 10px; opacity: 0.5;"></i>
                    <p>Belum ada data pengajuan layanan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<div style="margin-top: 24px;">
    <!-- Kiri: Verifikasi Terbaru -->
    <div class="panel-box">
        <div class="panel-header">
            <h3 class="panel-title"><i data-lucide="bell-ring" style="color: var(--primary);"></i> Menunggu Verifikasi</h3>
            <a href="{{ route('admin.permohonan') }}" class="panel-action">Lihat Semua <i data-lucide="arrow-right" style="width: 16px; height: 16px;"></i></a>
        </div>
        
        <div class="table-responsive" style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0 12px; text-align: left;">
                <thead>
                    <tr>
                        <th style="padding: 0 20px 8px 20px; font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0;">Pemohon</th>
                        <th style="padding: 0 20px 8px 20px; font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0;">Jenis Layanan</th>
                        <th style="padding: 0 20px 8px 20px; font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0;">Wilayah</th>
                        <th style="padding: 0 20px 8px 20px; font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0;">Waktu</th>
                        <th style="padding: 0 20px 8px 20px; font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0;">Status</th>
                        <th style="padding: 0 20px 8px 20px; font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e2e8f0; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentVerifications as $rv)
                        <tr style="background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.05); transition: transform 0.2s;">
                            <td style="padding: 16px 20px; border-top-left-radius: 12px; border-bottom-left-radius: 12px; border: 1px solid #f1f5f9; border-right: none;">
                                <div style="display: flex; align-items: center; gap: 16px;">
                                    <div style="background: #fffbeb; color: #d97706; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i data-lucide="user" style="width: 20px; height: 20px;"></i>
                                    </div>
                                    <span style="font-size: 1.05rem; font-weight: 600; color: var(--text-main);">{{ $rv->masyarakat->nama ?? 'Anonim' }}</span>
                                </div>
                            </td>
                            <td style="padding: 16px 20px; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9;">
                                <span style="background: #eff6ff; padding: 4px 10px; border-radius: 6px; font-weight: 700; font-size: 0.8rem; color: #3b82f6;">{{ $rv->jenis_layanan }}</span>
                            </td>
                            <td style="padding: 16px 20px; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9;">
                                <span style="color: #475569; font-size: 0.9rem; font-weight: 500; display: flex; align-items: center; gap: 6px;">
                                    <i data-lucide="map-pin" style="width: 14px; color: #94a3b8;"></i> {{ $rv->lokasi_pelayanan ?? 'Kecamatan' }}
                                </span>
                            </td>
                            <td style="padding: 16px 20px; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9;">
                                <span style="font-size: 0.85rem; font-weight: 500; color: var(--text-main); display: flex; align-items: center; gap: 6px;">
                                    <i data-lucide="calendar" style="width: 14px; color: #94a3b8;"></i> {{ \Carbon\Carbon::parse($rv->tanggal_pengajuan)->diffForHumans() }}
                                </span>
                            </td>
                            <td style="padding: 16px 20px; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9;">
                                <span style="background: #fef3c7; color: #d97706; padding: 6px 12px; font-size: 0.8rem; border-radius: 8px; font-weight: 700; display: inline-block;">MENUNGGU</span>
                            </td>
                            <td style="padding: 16px 20px; border-top-right-radius: 12px; border-bottom-right-radius: 12px; border: 1px solid #f1f5f9; border-left: none; text-align: right;">
                                <a href="{{ route('admin.permohonan.detail', $rv->id_pengajuan) }}" style="background: var(--primary); color: white; padding: 8px 16px; border-radius: 8px; font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.2s;">
                                    Proses <i data-lucide="arrow-right" style="width: 16px;"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px; color: var(--text-muted); border: 1px dashed #e2e8f0; border-radius: 12px;">
                                <i data-lucide="check-circle" style="width: 48px; height: 48px; margin-bottom: 12px; opacity: 0.5; color: #10b981; display: block; margin-left: auto; margin-right: auto;"></i>
                                <p style="margin: 0;">Semua pengajuan sudah terverifikasi.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    @keyframes shimmer {
        0% { transform: translateX(-150%) skewX(-20deg); }
        100% { transform: translateX(150%) skewX(-20deg); }
    }
</style>
<!-- ApexCharts Setup -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data dari backend
        const labels = {!! json_encode($chartLabels) !!};
        const totalData = {!! json_encode($chartData) !!};
        const selesaiData = {!! json_encode($chartSelesaiData) !!};

        var options = {
            series: [{
                name: 'Total Pengajuan',
                data: totalData
            }, {
                name: 'Selesai',
                data: selesaiData
            }],
            chart: {
                height: 320,
                type: 'area',
                fontFamily: "'Inter', sans-serif",
                toolbar: { show: false },
                zoom: { enabled: false },
                dropShadow: {
                    enabled: true,
                    top: 10,
                    left: 0,
                    blur: 10,
                    color: ['#3b82f6', '#10b981'],
                    opacity: 0.2
                }
            },
            colors: ['#3b82f6', '#10b981'],
            dataLabels: { enabled: false },
            stroke: {
                curve: 'smooth',
                width: [4, 4],
                dashArray: [0, 5]
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: labels,
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: { colors: '#64748b', fontSize: '12px', fontWeight: 600 }
                }
            },
            yaxis: {
                labels: {
                    style: { colors: '#64748b', fontSize: '12px', fontWeight: 600 }
                }
            },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 4,
                yaxis: { lines: { show: true } }
            },
            legend: { show: false },
            tooltip: {
                theme: 'dark',
                y: { formatter: function (val) { return val + " Pengajuan" } }
            }
        };

        var chart = new ApexCharts(document.querySelector("#pengajuanChart"), options);
        chart.render();
    });
</script>
@endsection