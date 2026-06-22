@extends('layouts.panel')

@section('title', 'Dashboard Cabang')

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

    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        display: flex;
        align-items: flex-start;
        gap: 20px;
        border: 1px solid #f1f5f9;
        transition: all 0.3s;
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

    @media (max-width: 1200px) {
        .dashboard-grid { grid-template-columns: repeat(2, 1fr); }
        .main-grid { grid-template-columns: 1fr; }
    }
    @media (max-width: 768px) {
        .dashboard-grid { grid-template-columns: 1fr; }
        .custom-hero { flex-direction: column; text-align: center; padding: 32px 24px; }
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
        <h1 class="hero-title">Selamat {{ $greeting }}, <span>{{ explode(' ', auth()->user()->name ?? 'Petugas')[0] }}!</span> 👋</h1>
        <p class="hero-subtitle">Pantau seluruh kegiatan pelayanan administrasi kependudukan di wilayah Anda. Segera tindaklanjuti pengajuan yang masuk.</p>
    </div>
    <div class="hero-schedule-card" style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); padding: 24px; border-radius: 20px; color: white; width: 320px; z-index: 10; margin-top: 16px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <span style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #fbbf24;">Jadwal Terdekat</span>
            <i data-lucide="calendar-clock" style="width: 20px; height: 20px; color: #fbbf24;"></i>
        </div>
        @if($nextSchedule)
            <div style="display: flex; gap: 16px; align-items: center; margin-bottom: 20px;">
                <div style="background: white; color: var(--primary); padding: 12px; border-radius: 14px; text-align: center; min-width: 65px;">
                    <span style="display: block; font-size: 1.6rem; font-weight: 800; line-height: 1;">{{ \Carbon\Carbon::parse($nextSchedule->tanggal_pelayanan)->format('d') }}</span>
                    <span style="display: block; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; margin-top: 4px;">{{ \Carbon\Carbon::parse($nextSchedule->tanggal_pelayanan)->translatedFormat('M') }}</span>
                </div>
                <div>
                    <h4 style="margin: 0 0 6px 0; font-size: 1.15rem; font-weight: 700; line-height: 1.3;">{{ $nextSchedule->lokasi }}</h4>
                    <p style="margin: 0; font-size: 0.85rem; opacity: 0.9; display: flex; align-items: center; gap: 4px;">
                        <i data-lucide="map-pin" style="width: 14px; height: 14px;"></i> {{ $nextSchedule->kecamatan ?? 'Kota Tegal' }}
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
    <div class="stat-card">
        <div class="stat-icon" style="background: #eff6ff; color: #3b82f6;">
            <i data-lucide="school" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Total Sekolah</span>
            <span class="stat-value">{{ number_format($sekolahCount) }}</span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #ecfdf5; color: #10b981;">
            <i data-lucide="users" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Total Siswa</span>
            <span class="stat-value">{{ number_format($totalSiswa) }}</span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #fef3c7; color: #d97706;">
            <i data-lucide="file-text" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Total Pengajuan</span>
            <span class="stat-value">{{ number_format($pengajuanCount) }}</span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #f5f3ff; color: #8b5cf6;">
            <i data-lucide="check-circle" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Selesai Diproses</span>
            <span class="stat-value">{{ number_format($selesaiCount) }}</span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #e0f2fe; color: #0ea5e9;">
            <i data-lucide="user-check" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Siswa Terlayani</span>
            <span class="stat-value">{{ number_format($siswaTerlayani) }}</span>
        </div>
    </div>
</div>

<div class="main-grid">
    <!-- Kiri: Chart -->
    <div class="panel-box">
        <div class="panel-header">
            <h3 class="panel-title"><i data-lucide="trending-up" style="color: var(--primary);"></i> Statistik Pengajuan (7 Hari Terakhir)</h3>
            <div style="display:flex; gap: 8px;">
                <span class="badge" style="background:#eff6ff; color:#3b82f6; text-transform: uppercase; font-size: 0.7rem; font-weight: 700; padding: 4px 8px; border-radius: 6px; display: inline-flex; align-items: center; gap: 4px;"><i data-lucide="circle" style="fill:#3b82f6; width:8px; height:8px;"></i> Total</span>
                <span class="badge" style="background:#ecfdf5; color:#10b981; text-transform: uppercase; font-size: 0.7rem; font-weight: 700; padding: 4px 8px; border-radius: 6px; display: inline-flex; align-items: center; gap: 4px;"><i data-lucide="circle" style="fill:#10b981; width:8px; height:8px;"></i> Selesai</span>
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
        
        <div style="display: flex; flex-direction: column; gap: 20px; padding: 10px 0;">
            @php $sebaranTotal = $sebaranLayanan->sum('total'); @endphp
            @forelse($sebaranLayanan as $layanan)
                @php
                    $percent = $sebaranTotal > 0 ? round(($layanan->total / $sebaranTotal) * 100) : 0;
                    $bgGradient = 'linear-gradient(90deg, #3b82f6, #60a5fa)';
                    $glowColor = 'rgba(59, 130, 246, 0.4)';
                    if (str_contains(strtolower($layanan->jenis_layanan), 'kia')) {
                        $bgGradient = 'linear-gradient(90deg, #f59e0b, #fbbf24)';
                        $glowColor = 'rgba(245, 158, 11, 0.4)';
                    } elseif (str_contains(strtolower($layanan->jenis_layanan), 'ikd')) {
                        $bgGradient = 'linear-gradient(90deg, #10b981, #34d399)';
                        $glowColor = 'rgba(16, 185, 129, 0.4)';
                    }
                @endphp
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: 700; color: var(--text-main); font-size: 0.95rem;">{{ $layanan->jenis_layanan }}</span>
                        <span style="font-weight: 800; color: var(--text-main); font-size: 0.95rem;">{{ $layanan->total }} <span style="font-weight: 500; color: var(--text-muted); font-size: 0.8rem;">({{ $percent }}%)</span></span>
                    </div>
                    <div style="height: 12px; background: #e2e8f0; border-radius: 99px; overflow: hidden; position: relative;">
                        <div style="width: {{ $percent }}%; height: 100%; background: {{ $bgGradient }}; border-radius: 99px; box-shadow: 0 0 10px {{ $glowColor }}; transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);"></div>
                    </div>
                </div>
            @empty
                <div style="text-align: center; color: var(--text-muted); padding: 40px;">Belum ada data pengajuan</div>
            @endforelse
        </div>
    </div>
</div>

<div class="main-grid">
    <div class="panel-box">
        <div class="panel-header">
            <h3 class="panel-title"><i data-lucide="activity" style="color: var(--primary);"></i> Aktivitas Pengajuan Terbaru</h3>
            <a href="{{ route('cabang.monitoring') ?? '#' }}" style="color: var(--primary); text-decoration: none; font-size: 0.9rem; font-weight: 600;">Lihat Semua</a>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0 12px; text-align: left;">
                <thead>
                    <tr>
                        <th style="padding: 0 20px 8px; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; border-bottom: 2px solid #e2e8f0;">Tiket</th>
                        <th style="padding: 0 20px 8px; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; border-bottom: 2px solid #e2e8f0;">Layanan</th>
                        <th style="padding: 0 20px 8px; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; border-bottom: 2px solid #e2e8f0;">Tanggal</th>
                        <th style="padding: 0 20px 8px; font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; border-bottom: 2px solid #e2e8f0;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aktivitas as $akt)
                    <tr style="background: #f8fafc; border-radius: 8px;">
                        <td style="padding: 16px 20px; font-weight: 600; color: var(--text-main); border-radius: 12px 0 0 12px;">{{ $akt->nomor_tiket }}</td>
                        <td style="padding: 16px 20px; font-weight: 600;">{{ $akt->jenis_layanan }}</td>
                        <td style="padding: 16px 20px; color: var(--text-muted);">{{ \Carbon\Carbon::parse($akt->tanggal_pengajuan)->format('d M Y') }}</td>
                        <td style="padding: 16px 20px; border-radius: 0 12px 12px 0;">
                            <span style="padding: 6px 12px; border-radius: 8px; font-size: 0.8rem; font-weight: 700;
                                @if($akt->status == 'selesai') background: #dcfce3; color: #166534;
                                @elseif($akt->status == 'pending' || $akt->status == 'menunggu_verifikasi') background: #fef3c7; color: #b45309;
                                @else background: #eff6ff; color: #1d4ed8; @endif
                            ">
                                {{ strtoupper(str_replace('_', ' ', $akt->status)) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 40px; color: var(--text-muted);">Belum ada aktivitas terbaru</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel-box">
        <div class="panel-header">
            <h3 class="panel-title"><i data-lucide="clock" style="color: var(--primary);"></i> Jadwal Mendatang</h3>
        </div>
        <div style="display: flex; flex-direction: column; gap: 16px;">
            @forelse($upcomingJadwals as $jadwal)
            <div style="display: flex; gap: 16px; align-items: center; padding: 16px; background: #f8fafc; border-radius: 12px; border: 1px solid #f1f5f9;">
                <div style="background: #eff6ff; color: var(--primary); width: 48px; height: 48px; border-radius: 12px; display: flex; flex-direction: column; align-items: center; justify-content: center; flex-shrink: 0;">
                    <span style="font-weight: 800; font-size: 1.2rem; line-height: 1;">{{ \Carbon\Carbon::parse($jadwal->tanggal_pelayanan)->format('d') }}</span>
                    <span style="font-size: 0.65rem; font-weight: 700; text-transform: uppercase;">{{ \Carbon\Carbon::parse($jadwal->tanggal_pelayanan)->format('M') }}</span>
                </div>
                <div style="flex-grow: 1;">
                    <h4 style="margin: 0 0 4px; font-size: 0.95rem; font-weight: 700;">{{ preg_replace('/\s*\(.*?\)/', '', $jadwal->lokasi) }}</h4>
                    <p style="margin: 0; font-size: 0.8rem; color: var(--text-muted); display: flex; align-items: center; gap: 4px;">
                        <i data-lucide="map-pin" style="width: 12px; height: 12px;"></i> {{ $jadwal->kecamatan ?? 'Tegal' }}
                    </p>
                </div>
            </div>
            @empty
            <div style="text-align: center; padding: 30px; color: var(--text-muted);">
                <i data-lucide="calendar-x" style="width: 48px; height: 48px; margin-bottom: 12px; opacity: 0.5;"></i>
                <p>Belum ada jadwal tersisa.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

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
                fontFamily: "'Plus Jakarta Sans', sans-serif",
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