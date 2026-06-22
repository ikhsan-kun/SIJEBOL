<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kegiatan - SI JEBOL Kota Tegal</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @include('partials.head-dependencies')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700;800&display=swap" />
    <style>
        :root {
            --primary: #003178;
            --primary-dark: #001e50;
            --accent: #f59e0b;
        }

        body {
            background-color: #f8fafc !important;
            background-image: none !important;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .main-content {
            padding-top: 80px; /* Adjust for navbar */
            min-width: 0;
            transition: all 0.3s ease;
        }

        .content-container {
            padding: 40px 96px;
        }

        @media (max-width: 1024px) {
            .content-container {
                padding: 40px 40px;
            }
        }

        /* Hero Banner */
        .hero-banner {
            background-color: var(--primary);
            border-radius: 0;
            padding: 60px 0;
            margin: 0;
            color: white;
            position: relative;
            overflow: hidden;
            border-bottom: 4px solid var(--accent);
        }

        .hero-inner {
            padding: 0 96px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        @media (max-width: 1024px) {
            .hero-inner {
                padding: 0 40px;
            }
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
            mix-blend-mode: luminosity;
            pointer-events: none;
        }

        .hero-banner h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 3rem !important;
            font-weight: 900 !important;
            line-height: 1.1 !important;
            margin-bottom: 16px !important;
            color: white !important;
            letter-spacing: -1.5px !important;
            position: relative;
            z-index: 10;
        }

        .hero-banner p {
            font-size: 1.1rem !important;
            max-width: 600px !important;
            color: rgba(255,255,255,0.9) !important;
            margin: 0 auto !important;
            line-height: 1.6 !important;
            position: relative;
            z-index: 10;
        }

        .hero-content {
            position: relative;
            z-index: 10;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            text-align: left;
        }

        .hero-cursive {
            font-family: 'Brush Script MT', 'Dancing Script', cursive;
            color: var(--accent);
            font-size: 1.5rem;
            margin: 0;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
        }

        .hero-building {
            position: absolute;
            right: 0;
            bottom: 0;
            height: 120%;
            z-index: 5;
            opacity: 0.9;
        }

        /* Filter Bar */
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

        /* Stats Grid */
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

        /* Bottom Grid: Calendar & Schedule List */
        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        @media (max-width: 1024px) {
            .hero-banner {
                margin: 0 -20px 40px -20px;
                padding: 40px 40px;
            }
            .bottom-grid { grid-template-columns: 1fr; }
            .filter-bar { flex-wrap: wrap; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .hero-banner {
                padding: 32px 20px;
            }
            .hero-banner h1 {
                font-size: 2.2rem !important;
            }
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

        /* Calendar Styling */
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

        /* Schedule List */
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
</head>
<body>
    @include('partials.navbar')

    <main class="main-content">
        <!-- Hero Banner -->
        <div class="hero-banner" style="display: block;">
            <div class="hero-inner">
                <h1>Jadwal <span style="color: #fbbf24;">Mobile</span></h1>
                <p>Pelayanan mobile untuk kemudahan masyarakat. Dekat, Cepat, Mudah, dan Gratis. "Disdukcapil Hadir, Melayani dengan Hati" <i data-lucide="heart" style="display:inline; width:18px; color:var(--accent); fill:var(--accent); vertical-align: middle;"></i></p>
            </div>
        </div>

        <div class="content-container">
            <!-- Filter Bar -->
            <form method="GET" action="{{ route('jadwal') }}" class="filter-bar">
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
            <div class="filter-group">
                <i data-lucide="map-pin"></i>
                <label>Wilayah / Kecamatan</label>
                <select name="wilayah">
                    <option value="">Semua Wilayah</option>
                    <option value="Tegal Barat" {{ request('wilayah') == 'Tegal Barat' ? 'selected' : '' }}>Tegal Barat</option>
                    <option value="Tegal Timur" {{ request('wilayah') == 'Tegal Timur' ? 'selected' : '' }}>Tegal Timur</option>
                    <option value="Tegal Selatan" {{ request('wilayah') == 'Tegal Selatan' ? 'selected' : '' }}>Tegal Selatan</option>
                    <option value="Margadana" {{ request('wilayah') == 'Margadana' ? 'selected' : '' }}>Margadana</option>
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
                                else if (strtolower($firstEventStatus) == 'ditunda') $indicatorClass = 'yellow';
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

                    @if($upcoming->isEmpty())
                        <div class="schedule-item">
                            <div class="sch-icon"><i data-lucide="calendar-days"></i></div>
                            <div class="sch-name">Kecamatan Tegal Barat</div>
                            <div class="sch-detail"><i data-lucide="calendar" style="width:14px;"></i> 20 Mei 2025</div>
                            <div class="sch-detail"><i data-lucide="clock" style="width:14px;"></i> 08.00 - 12.00 WIB</div>
                            <div class="status-badge badge-terjadwal">Terjadwal</div>
                        </div>
                        <div class="schedule-item">
                            <div class="sch-icon"><i data-lucide="calendar-days"></i></div>
                            <div class="sch-name">SMP Negeri 4 Tegal</div>
                            <div class="sch-detail"><i data-lucide="calendar" style="width:14px;"></i> 21 Mei 2025</div>
                            <div class="sch-detail"><i data-lucide="clock" style="width:14px;"></i> 08.00 - 12.00 WIB</div>
                            <div class="status-badge badge-terjadwal">Terjadwal</div>
                        </div>
                        <div class="schedule-item">
                            <div class="sch-icon"><i data-lucide="calendar-days"></i></div>
                            <div class="sch-name">Kelurahan Margadana</div>
                            <div class="sch-detail"><i data-lucide="calendar" style="width:14px;"></i> 22 Mei 2025</div>
                            <div class="sch-detail"><i data-lucide="clock" style="width:14px;"></i> 08.00 - 12.00 WIB</div>
                            <div class="status-badge badge-ditunda">Ditunda</div>
                        </div>
                        <div class="schedule-item">
                            <div class="sch-icon"><i data-lucide="calendar-days"></i></div>
                            <div class="sch-name">Kecamatan Tegal Timur</div>
                            <div class="sch-detail"><i data-lucide="calendar" style="width:14px;"></i> 24 Mei 2025</div>
                            <div class="sch-detail"><i data-lucide="clock" style="width:14px;"></i> 08.00 - 12.00 WIB</div>
                            <div class="status-badge badge-terjadwal">Terjadwal</div>
                        </div>
                        <div class="schedule-item">
                            <div class="sch-icon"><i data-lucide="calendar-days"></i></div>
                            <div class="sch-name">Kelurahan Panggung</div>
                            <div class="sch-detail"><i data-lucide="calendar" style="width:14px;"></i> 27 Mei 2025</div>
                            <div class="sch-detail"><i data-lucide="clock" style="width:14px;"></i> 08.00 - 12.00 WIB</div>
                            <div class="status-badge badge-terjadwal">Terjadwal</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    @include('partials.footer')

    <script>
        lucide.createIcons();

        @php
            $jadwalJson = $activities->map(function($dayItems) {
                return $dayItems->map(function($item) {
                    return [
                        'lokasi' => $item->lokasi,
                        'tanggal' => \Carbon\Carbon::parse($item->tanggal_pelayanan)->translatedFormat('d F Y'),
                        'jam' => \Carbon\Carbon::parse($item->jam_mulai)->format('H.i') . ' - ' . \Carbon\Carbon::parse($item->jam_selesai)->format('H.i') . ' WIB',
                        'status' => ucfirst($item->status ?? 'Terjadwal'),
                        'kegiatan' => $item->nama_kegiatan ?? '-',
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

                html += '</div>';
            });

            list.innerHTML = html;
            detail.style.display = 'block';

            lucide.createIcons();
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
</body>
</html>
