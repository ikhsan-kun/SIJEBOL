@php
    $monthName = \Carbon\Carbon::create()->month((int) request('month', date('m')))->translatedFormat('F');
    $nearest = $upcoming->first();
@endphp

@extends('layouts.panel')

@section('title', 'Jadwal Kegiatan Cabang - SI JEBOL')

@section('content')
<style>
    :root {
        --primary: #003178;
        --primary-dark: #001e50;
        --accent: #f59e0b;
    }

    /* Hero Banner */
    .hero-banner {
        background: linear-gradient(135deg, var(--primary) 0%, #0044a8 100%);
        border-radius: 0;
        padding: 36px 48px;
        margin: -2rem -2rem 32px -2rem;
        color: white;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        box-shadow: 0 10px 30px rgba(0, 49, 120, 0.15);
        border-bottom: 6px solid var(--accent);
    }

    .hero-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('{{ asset("images/batik-tegal-premium.jpg") }}');
        background-size: cover;
        background-position: center;
        opacity: 0.15;
        mix-blend-mode: overlay;
        pointer-events: none;
    }

    .hero-banner h1 {
        font-size: 2.2rem !important;
        font-weight: 800 !important;
        line-height: 1.2 !important;
        margin: 0 0 8px 0 !important;
        color: white !important;
        letter-spacing: -0.5px !important;
        position: relative;
        z-index: 10;
    }

    .hero-banner p {
        font-size: 1.1rem !important;
        color: rgba(255,255,255,0.9) !important;
        margin: 0 !important;
        line-height: 1.6 !important;
        position: relative;
        z-index: 10;
    }

    .filter-bar {
        display: flex;
        gap: 16px;
        margin-bottom: 24px;
    }

    .filter-group {
        flex: 1;
        display: flex;
        align-items: center;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 8px 16px;
        gap: 12px;
    }

    .filter-group i { color: #64748b; }
    .filter-group label { font-size: 0.8rem; color: #64748b; font-weight: 500; }
    .filter-group select { 
        border: none; 
        outline: none; 
        font-size: 0.9rem; 
        font-weight: 600; 
        color: #0f172a; 
        background: transparent; 
        flex-grow: 1;
        cursor: pointer;
    }

    .btn-terapkan {
        background: #2563eb;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0 24px;
        font-weight: 600;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-terapkan:hover { background: #1d4ed8; }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        display: grid;
        place-items: center;
        color: white;
        flex-shrink: 0;
    }

    .icon-blue { background: #2563eb; }
    .icon-yellow { background: #eab308; }
    .icon-green { background: #22c55e; }

    .stat-info { display: flex; flex-direction: column; }
    .stat-title { font-size: 0.75rem; color: #64748b; margin: 0 0 4px 0; }
    .stat-value { font-size: 1.6rem; font-weight: 800; color: #0f172a; line-height: 1; margin: 0 0 4px 0; }
    .stat-sub { font-size: 0.7rem; color: #64748b; margin: 0; }

    .bottom-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
    }

    @media (max-width: 1023px) {
        .bottom-grid { grid-template-columns: 1fr; }
        .filter-bar { flex-wrap: wrap; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 640px) {
        .stats-grid { grid-template-columns: 1fr; }
    }

    .panel-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        border: 1px solid #e2e8f0;
    }

    .panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .panel-title {
        font-size: 1.1rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }

    .cal-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
        text-align: center;
    }

    .cal-day-header {
        font-size: 0.8rem;
        font-weight: 700;
        color: #0f172a;
        padding-bottom: 12px;
    }

    .cal-cell {
        height: 40px;
        display: grid;
        place-items: center;
        font-size: 0.9rem;
        font-weight: 600;
        color: #334155;
        position: relative;
        cursor: pointer;
        border-radius: 8px;
        transition: background 0.2s;
    }

    .cal-cell:hover:not(.muted) {
        background: #f1f5f9;
    }

    .cal-cell.active-date {
        background: #dbeafe;
    }

    .cal-cell.muted { color: #cbd5e1; }

    .cal-indicator {
        position: absolute;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        z-index: 0;
    }

    .cal-indicator.blue { border: 2px solid #3b82f6; background: #eff6ff; }
    .cal-indicator.yellow { border: 2px solid #eab308; background: #fefce8; }
    .cal-indicator.green { border: 2px solid #22c55e; background: #f0fdf4; }

    .cal-cell span { position: relative; z-index: 1; }

    .cal-legend {
        display: flex;
        gap: 20px;
        margin-top: 24px;
        font-size: 0.95rem;
        font-weight: 700;
        color: #64748b;
        justify-content: flex-start;
        padding-left: 8px;
    }
    .legend-item { display: flex; align-items: center; gap: 8px; }
    .legend-dot { width: 12px; height: 12px; border-radius: 50%; }
    .dot-blue { background: #3b82f6; }
    .dot-green { background: #22c55e; }
    .dot-yellow { background: #eab308; }

    .schedule-list {
        display: flex;
        flex-direction: column;
    }

    .schedule-item {
        display: grid;
        grid-template-columns: 32px 1.5fr 1fr 1fr 80px;
        align-items: center;
        gap: 12px;
        padding: 16px 12px;
        margin: 0 -12px;
        border-bottom: 1px solid #f1f5f9;
        cursor: pointer;
        transition: all 0.2s ease;
        border-radius: 8px;
    }

    .schedule-item:hover {
        background: #eff6ff;
        transform: translateX(4px);
    }

    .schedule-item:last-child { border-bottom: none; }

    .sch-icon { color: #3b82f6; }
    .sch-name { font-size: 0.85rem; font-weight: 700; color: #0f172a; }
    .sch-detail { display: flex; align-items: center; gap: 6px; font-size: 0.8rem; color: #64748b; }
    
    .status-badge {
        padding: 4px 12px;
        border-radius: 4px;
        font-size: 0.7rem;
        font-weight: 600;
        text-align: center;
    }

    .badge-terjadwal { background: #eff6ff; color: #2563eb; }
    .badge-ditunda { background: #fffbeb; color: #d97706; }
    .badge-selesai { background: #dcfce7; color: #16a34a; }

    .view-all {
        font-size: 0.8rem;
        font-weight: 600;
        color: #2563eb;
        text-decoration: none;
    }
</style>

<!-- Hero Banner -->
<div class="hero-banner" style="display: flex; justify-content: space-between; text-align: left; align-items: center; flex-wrap: wrap; gap: 20px;">
    <div>
        <h1>Jadwal <span style="color: #fbbf24;">Layanan</span></h1>
        <p>Manajemen Jadwal Lapangan {{ auth()->user()->kecamatan }}</p>
    </div>
    <div style="display: flex; gap: 16px; align-items: center; z-index: 10;">
        <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 12px 20px; border-radius: 12px; border: 1px solid rgba(255,255,255,0.2); text-align: right; display: flex; flex-direction: column; justify-content: center;">
            <div style="font-size: 0.75rem; color: var(--accent); font-weight: bold; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;">{{ now()->translatedFormat('l') }}</div>
            <div style="font-size: 0.9rem; color: white; font-weight: 800; line-height: 1;">{{ now()->translatedFormat('d F Y') }}</div>
        </div>
        <a href="{{ route('cabang.jadwal.create') }}" style="display: flex; align-items: center; gap: 8px; background: var(--accent); color: var(--primary-dark); padding: 16px 24px; border-radius: 12px; font-weight: 800; font-size: 0.9rem; text-decoration: none; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3); transition: all 0.2s;">
            <i data-lucide="plus" style="width: 20px;"></i> Jadwal Baru
        </a>
    </div>
</div>

<!-- Filter Bar -->
<form method="GET" action="{{ route('cabang.jadwal') }}" class="filter-bar">
    <div class="filter-group">
        <i data-lucide="calendar"></i>
        <label>Bulan</label>
        <select name="month">
            @foreach(range(1, 12) as $m)
                <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}" {{ request('month', date('m')) == $m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="filter-group">
        <i data-lucide="calendar-days"></i>
        <label>Tahun</label>
        <select name="year">
            @for($y = date('Y') - 1; $y <= date('Y') + 2; $y++)
                <option value="{{ $y }}" {{ request('year', date('Y')) == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
        </select>
    </div>
    <button type="submit" class="btn-terapkan">
        <i data-lucide="filter" style="width:16px;"></i> Terapkan
    </button>
</form>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon icon-blue"><i data-lucide="calendar"></i></div>
        <div class="stat-info">
            <p class="stat-title">Total Jadwal</p>
            <h3 class="stat-value">{{ \App\Models\JadwalJebol::count() }}</h3>
            <p class="stat-sub">Semua waktu</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon icon-yellow"><i data-lucide="calendar-check"></i></div>
        <div class="stat-info">
            <p class="stat-title">Jadwal Bulan Ini</p>
            <h3 class="stat-value">{{ $activities->flatten()->count() }}</h3>
            <p class="stat-sub">{{ $monthName }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon icon-green"><i data-lucide="map-pin"></i></div>
        <div class="stat-info">
            <p class="stat-title">Lokasi Terdekat</p>
            <h3 class="stat-value" style="font-size: 1.1rem; font-weight:800; margin-bottom:2px; margin-top:2px;">{{ Str::limit($nearest->lokasi ?? 'Belum ada jadwal', 20) }}</h3>
            <p class="stat-sub">{{ $nearest ? \Carbon\Carbon::parse($nearest->tanggal_pelayanan)->translatedFormat('d F Y') : '-' }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon icon-blue"><i data-lucide="check-circle"></i></div>
        <div class="stat-info">
            <p class="stat-title">Jadwal Selesai</p>
            @php
                $totalJadwal = \App\Models\JadwalJebol::count();
                $selesai = \App\Models\JadwalJebol::where('status', 'Selesai')->count();
                $percentage = $totalJadwal > 0 ? round(($selesai / $totalJadwal) * 100, 1) : 0;
            @endphp
            <h3 class="stat-value">{{ $selesai }}</h3>
            <p class="stat-sub">{{ $percentage }}% dari total</p>
        </div>
    </div>
</div>

<!-- Bottom Grid -->
<div class="bottom-grid">
    
    <!-- Calendar Panel -->
    <div class="panel-card" id="calendar-panel">
        <div class="panel-header">
            <h3 class="panel-title">Kalender {{ $monthName }} {{ $currentDate->year }}</h3>
        </div>
        <div class="cal-grid">
            <div class="cal-day-header">Sen</div>
            <div class="cal-day-header">Sel</div>
            <div class="cal-day-header">Rab</div>
            <div class="cal-day-header">Kam</div>
            <div class="cal-day-header">Jum</div>
            <div class="cal-day-header">Sab</div>
            <div class="cal-day-header">Min</div>

            @foreach($calendar as $item)
                @php
                    $dateString = $item['date']->format('Y-m-d');
                    $dayActivities = $activities->get($dateString, collect());
                    $hasEvent = $dayActivities->count() > 0;
                    
                    $indicatorClass = '';
                    if ($hasEvent) {
                        $firstEventStatus = $dayActivities->first()->status ?? 'Terjadwal';
                        if (strtolower($firstEventStatus) == 'selesai') $indicatorClass = 'green';
                        elseif (strtolower($firstEventStatus) == 'ditunda') $indicatorClass = 'yellow';
                        else $indicatorClass = 'blue';
                    }
                @endphp
                <div class="cal-cell {{ !$item['isCurrentMonth'] ? 'muted' : '' }}" 
                    @if($hasEvent) 
                        onclick="showCalDetail('{{ $dateString }}', this)" 
                        data-date="{{ $dateString }}"
                    @endif
                >
                    @if($hasEvent) <div class="cal-indicator {{ $indicatorClass }}"></div> @endif
                    <span>{{ $item['date']->day }}</span>
                </div>
            @endforeach
        </div>
        <div class="cal-legend">
            <div class="legend-item"><div class="legend-dot dot-blue"></div> Terjadwal</div>
            <div class="legend-item"><div class="legend-dot dot-green"></div> Selesai</div>
            <div class="legend-item"><div class="legend-dot dot-yellow"></div> Ditunda</div>
        </div>

        <!-- Detail Popup -->
        <div id="cal-detail" style="display:none; margin-top: 16px; padding: 16px; background: #f8fafc; border-radius: 12px; border: 1px solid #e2e8f0;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px;">
                <h4 id="cal-detail-title" style="margin:0; font-size:0.95rem; font-weight:700; color:#0f172a;"></h4>
                <button onclick="document.getElementById('cal-detail').style.display='none'; document.querySelectorAll('.cal-cell.active-date').forEach(c=>c.classList.remove('active-date'));" style="background:none; border:none; cursor:pointer; color:#94a3b8; font-size:1.2rem;">&times;</button>
            </div>
            <div id="cal-detail-list"></div>
        </div>
    </div>

    <!-- Schedule List Panel -->
    <div class="panel-card">
        <div class="panel-header">
            <h3 class="panel-title">Jadwal Terdekat</h3>
            <a href="#calendar-panel" class="view-all">Lihat Semua</a>
        </div>
        <div class="schedule-list">
            
            @forelse($upcoming as $index => $act)
                @php
                    $statusText = ucfirst($act->status ?? 'Terjadwal');
                    
                    if (strtolower($statusText) == 'ditunda') {
                        $statusClass = 'badge-ditunda';
                    } elseif (strtolower($statusText) == 'selesai') {
                        $statusClass = 'badge-selesai';
                    } else {
                        $statusClass = 'badge-terjadwal';
                    }
                @endphp
                <div class="schedule-item" onclick="showCalDetail('{{ $act->tanggal_pelayanan->format('Y-m-d') }}')">
                    <div class="sch-icon"><i data-lucide="calendar-days"></i></div>
                    <div class="sch-name">{{ $act->lokasi }}</div>
                    <div class="sch-detail"><i data-lucide="calendar" style="width:14px;"></i> {{ $act->tanggal_pelayanan->format('d M Y') }}</div>
                    <div class="sch-detail"><i data-lucide="clock" style="width:14px;"></i> {{ \Carbon\Carbon::parse($act->jam_mulai)->format('H.i') }} - {{ \Carbon\Carbon::parse($act->jam_selesai)->format('H.i') }} WIB</div>
                    <div class="status-badge {{ $statusClass }}">{{ $statusText }}</div>
                </div>
            @empty
                <div style="text-align: center; padding: 20px; color: #94a3b8; font-size: 0.9rem;">
                    Belum ada jadwal terdekat.
                </div>
            @endforelse
        </div>
    </div>

</div>

<script>
    @php
        $jadwalJson = $activities->map(function($dayItems) {
            return $dayItems->map(function($item) {
                return [
                    'lokasi' => $item->lokasi,
                    'tanggal' => \Carbon\Carbon::parse($item->tanggal_pelayanan)->translatedFormat('d F Y'),
                    'jam' => \Carbon\Carbon::parse($item->jam_mulai)->format('H.i') . ' - ' . \Carbon\Carbon::parse($item->jam_selesai)->format('H.i') . ' WIB',
                    'status' => ucfirst($item->status ?? 'Terjadwal'),
                    'deskripsi' => $item->deskripsi ?? 'Tidak ada deskripsi.',
                    'petugas' => $item->petugas ?? '-',
                    'jenis_layanan' => $item->jenis_layanan ?? '-',
                    'foto' => $item->foto ? asset('storage/' . $item->foto) : null,
                ];
            })->values();
        });
    @endphp
    const jadwalData = @json($jadwalJson);

    function showCalDetail(dateStr, el) {
        document.querySelectorAll('.cal-cell.active-date').forEach(c => c.classList.remove('active-date'));
        if (!el && dateStr) {
            el = document.querySelector('.cal-cell[data-date="' + dateStr + '"]');
        }
        if (el) el.classList.add('active-date');

        const detail = document.getElementById('cal-detail');
        const title = document.getElementById('cal-detail-title');
        const list = document.getElementById('cal-detail-list');

        const items = jadwalData[dateStr] || [];
        if (items.length === 0) {
            detail.style.display = 'none';
            return;
        }

        title.textContent = 'Jadwal ' + items[0].tanggal + ' (' + items.length + ' kegiatan)';

        let html = '';
        items.forEach(function(item) {
            let badgeClass = 'badge-terjadwal';
            let iconColor = '#3b82f6';
            let bgClass = '#eff6ff';
            
            if (item.status.toLowerCase() === 'ditunda') {
                badgeClass = 'badge-ditunda';
                iconColor = '#f59e0b';
                bgClass = '#fffbeb';
            } else if (item.status.toLowerCase() === 'selesai') {
                badgeClass = 'badge-selesai';
                iconColor = '#10b981';
                bgClass = '#ecfdf5';
            }

            html += '<div style="display:flex; flex-direction:column; gap:12px; padding:16px; background:white; border-radius:12px; border:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,0.02); margin-bottom:12px;">';
            html += '  <div style="display:grid; grid-template-columns: 40px 1fr auto auto; align-items:center; gap:16px;">';
            html += '    <div style="width:40px; height:40px; border-radius:10px; background:'+bgClass+'; color:'+iconColor+'; display:grid; place-items:center;"><i data-lucide="calendar-days" style="width:20px;"></i></div>';
            html += '    <div style="flex:1;">';
            html += '      <div style="font-weight:700; font-size:0.95rem; color:var(--text-main); margin-bottom:2px;">' + item.lokasi + '</div>';
            html += '      <div style="font-size:0.85rem; color:var(--text-muted); font-weight:500;">' + item.kegiatan + '</div>';
            html += '    </div>';
            html += '    <div style="font-size:0.85rem; color:var(--text-muted); font-weight:600; display:flex; align-items:center; gap:6px;"><i data-lucide="clock" style="width:16px;"></i> ' + item.jam + '</div>';
            html += '    <div class="status-badge ' + badgeClass + '">' + item.status + '</div>';
            html += '  </div>';
            
            html += '  <div style="padding-top:10px; border-top:1px dashed #e2e8f0; display:grid; grid-template-columns:1fr 1fr; gap:12px; font-size:0.8rem; color:#64748b;">';
            html += '    <div><strong>Layanan:</strong> ' + item.jenis_layanan + '</div>';
            html += '    <div><strong>Petugas:</strong> ' + item.petugas + '</div>';
            html += '    <div style="grid-column: span 2;"><strong>Keterangan:</strong> ' + item.deskripsi + '</div>';
            html += '  </div>';

            if (item.foto) {
                html += '  <div style="margin-top:8px; border-radius:8px; overflow:hidden; border:1px solid #e2e8f0; max-height:220px; width:100%; display:flex; align-items:center; justify-content:center; background:#f8fafc;">';
                html += '    <a href="javascript:void(0)" onclick="openLightbox(\'' + item.foto + '\')" style="display:flex; width:100%; height:100%; align-items:center; justify-content:center;" title="Klik untuk memperbesar">';
                html += '      <img src="' + item.foto + '" style="max-width:100%; max-height:220px; object-fit:contain; cursor:pointer;" alt="Foto/Brosur Kegiatan">';
                html += '    </a>';
                html += '  </div>';
            }

            if (item.kegiatan.startsWith('Layanan Tiket ')) {
                const ticketId = item.kegiatan.replace('Layanan Tiket ', '').trim();
                html += '  <div style="display:flex; justify-content:flex-end; margin-top:4px;">';
                html += '    <a href="/cabang/permohonan" style="background:#eff6ff; color:#2563eb; padding:6px 12px; border-radius:8px; text-decoration:none; font-size:0.8rem; font-weight:700; display:inline-flex; align-items:center; gap:4px;"><i data-lucide="eye" style="width:14px; height:14px;"></i> Monitoring Pengajuan</a>';
                html += '  </div>';
            }
            
            html += '</div>';
        });

        list.innerHTML = html;
        detail.style.display = 'block';

        if(window.lucide) {
            window.lucide.createIcons();
        }

        detail.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function openLightbox(src) {
        const lightbox = document.getElementById('image-lightbox');
        const img = document.getElementById('lightbox-img');
        img.src = src;
        lightbox.style.display = 'flex';
        if(window.lucide) window.lucide.createIcons();
    }
    function closeLightbox() {
        document.getElementById('image-lightbox').style.display = 'none';
    }
</script>

<!-- Modal Lightbox for Image Preview -->
<div id="image-lightbox" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.85); z-index:9999; align-items:center; justify-content:center; flex-direction:column; padding:20px; backdrop-filter:blur(8px);">
    <div style="position:relative; max-width:90%; max-height:80%;">
        <img id="lightbox-img" src="" style="max-width:100%; max-height:75vh; border-radius:12px; box-shadow:0 25px 50px -12px rgba(0,0,0,0.5); border:3px solid white; object-fit:contain;">
    </div>
    <button onclick="closeLightbox()" style="margin-top:20px; background:#ffffff; color:#1e293b; border:none; padding:12px 24px; border-radius:30px; font-weight:700; font-size:0.9rem; cursor:pointer; display:flex; align-items:center; gap:8px; box-shadow:0 10px 15px -3px rgba(0,0,0,0.3); transition:all 0.2s;"><i data-lucide="arrow-left" style="width:18px; height:18px;"></i> Kembali</button>
</div>
@endsection
