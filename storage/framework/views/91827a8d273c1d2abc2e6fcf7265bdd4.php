<?php $__env->startSection('title', 'Jadwal Layanan - SI JEBOL'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-bottom: 32px;
    }
    
    .main-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr;
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
        background-image: url('<?php echo e(asset("images/batik-tegal-premium.jpg")); ?>');
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
    
    .hero-actions {
        position: relative;
        z-index: 10;
        display: flex;
        gap: 16px;
        align-items: center;
    }
    
    .date-badge {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        padding: 12px 20px;
        border-radius: 12px;
        border: 1px solid rgba(255,255,255,0.2);
        text-align: right;
        display: flex;
        flex-direction: column;
        justify-content: center;
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
        min-width: 200px;
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
    
    .btn {
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
        text-decoration: none;
    }
    
    .btn-primary {
        background: var(--primary);
        color: white;
    }
    
    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }
    
    .btn-warning {
        background: #f59e0b;
        color: #78350f;
    }
    
    .btn-warning:hover {
        background: #d97706;
        color: white;
        transform: translateY(-2px);
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
        overflow: hidden;
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
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
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
    
    /* Calendar Styling */
    .cal-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 8px;
        text-align: center;
    }

    .cal-day-header {
        font-size: 0.85rem;
        font-weight: 700;
        color: var(--text-main);
        padding-bottom: 12px;
    }

    .cal-cell {
        height: 44px;
        display: grid;
        place-items: center;
        font-size: 0.95rem;
        font-weight: 600;
        color: #334155;
        position: relative;
        cursor: pointer;
        border-radius: 12px;
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
        width: 36px;
        height: 36px;
        border-radius: 50%;
        z-index: 0;
    }

    .cal-indicator.blue { border: 2px solid #3b82f6; background: #eff6ff; }
    .cal-indicator.yellow { border: 2px solid #f59e0b; background: #fefce8; }
    .cal-indicator.green { border: 2px solid #10b981; background: #f0fdf4; }

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
        gap: 12px;
    }

    .schedule-item {
        display: grid;
        grid-template-columns: 40px 1.5fr 1fr 1fr 90px;
        align-items: center;
        gap: 12px;
        padding: 16px;
        border: 1px solid #f1f5f9;
        border-radius: 12px;
        transition: all 0.2s;
    }
    
    .schedule-item:hover {
        background: #f8fafc;
        border-color: #e2e8f0;
    }

    .sch-icon { 
        width: 40px; height: 40px; 
        border-radius: 10px; 
        background: #eff6ff; color: #3b82f6; 
        display: grid; place-items: center; 
    }
    .sch-name { font-size: 0.95rem; font-weight: 700; color: var(--text-main); }
    .sch-detail { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: var(--text-muted); font-weight: 500;}
    
    .status-badge {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
        text-align: center;
    }

    .badge-terjadwal { background: #eff6ff; color: #2563eb; }
    .badge-ditunda { background: #fffbeb; color: #d97706; }
    .badge-selesai { background: #ecfdf5; color: #10b981; }

    @media (max-width: 1024px) {
        .dashboard-grid { grid-template-columns: repeat(2, 1fr); }
        .main-grid { grid-template-columns: 1fr; }
        .schedule-item { grid-template-columns: 1fr; gap: 8px; justify-items: start; }
        .sch-icon { display: none; }
        .custom-hero {
            margin: -1.5rem -1rem 32px -1rem;
        }
    }

    @media (max-width: 768px) {
        .dashboard-grid { grid-template-columns: 1fr; }
        .custom-hero {
            flex-direction: column;
            text-align: center;
            gap: 24px;
            padding: 32px 24px;
        }
        .hero-actions {
            flex-wrap: wrap;
            justify-content: center;
            width: 100%;
        }
    }

    .modal-backdrop { 
        position: fixed; top: 0; left: 0; right: 0; bottom: 0; 
        background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); 
        z-index: 1000; display: none; place-items: center; opacity: 0; 
        transition: opacity 0.3s ease; 
    }
    .modal-backdrop.show { display: grid; opacity: 1; }
    .modal-content {
        background: white; border-radius: 20px; width: 100%;
        max-width: 500px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
        transform: scale(0.95); transition: transform 0.3s ease, opacity 0.3s ease;
    }
    .modal-backdrop.show .modal-content { transform: scale(1); opacity: 1; }
</style>

<div class="custom-hero">
    <div class="hero-content">
        <h1 class="hero-title">Jadwal <span>Layanan</span></h1>
        <p class="hero-subtitle">Manajemen Lapangan & Kegiatan Jemput Bola wilayah Kota Tegal.</p>
    </div>
    <div class="hero-actions">
        <div class="date-badge">
            <span style="font-size: 0.8rem; color: #fbbf24; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px;"><?php echo e(now()->translatedFormat('l')); ?></span>
            <span style="font-size: 1rem; color: white; font-weight: 800; line-height: 1;"><?php echo e(now()->translatedFormat('d F Y')); ?></span>
        </div>
        <a href="<?php echo e(route('admin.jadwal.create')); ?>" class="btn btn-warning" style="padding: 16px 24px; font-size: 1rem;">
            <i data-lucide="plus" style="width: 20px; height: 20px;"></i> Jadwal Baru
        </a>
    </div>
</div>

<div class="filter-panel">
    <form method="GET" action="<?php echo e(route('admin.jadwal')); ?>" class="filter-row">
        <div class="filter-group">
            <span class="filter-label">Bulan</span>
            <select name="month" class="filter-select">
                <?php $__currentLoopData = range(1, 12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e(str_pad($m, 2, '0', STR_PAD_LEFT)); ?>" <?php echo e(request('month', date('m')) == $m ? 'selected' : ''); ?>>
                        <?php echo e(\Carbon\Carbon::create()->month($m)->translatedFormat('F')); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="filter-group">
            <span class="filter-label">Tahun</span>
            <select name="year" class="filter-select">
                <?php for($y = date('Y') - 1; $y <= date('Y') + 2; $y++): ?>
                    <option value="<?php echo e($y); ?>" <?php echo e(request('year', date('Y')) == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                <?php endfor; ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary" style="height: 42px;">
            <i data-lucide="filter" style="width: 18px; height: 18px;"></i> Terapkan
        </button>
    </form>
</div>



<div class="dashboard-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background: #eff6ff; color: #3b82f6;">
            <i data-lucide="calendar" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Total Jadwal</span>
            <span class="stat-value"><?php echo e(\App\Models\JadwalJebol::count()); ?></span>
            <span class="stat-sub">Semua waktu</span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #fef3c7; color: #f59e0b;">
            <i data-lucide="calendar-check" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Jadwal Bulan Ini</span>
            <span class="stat-value"><?php echo e($activities->flatten()->count()); ?></span>
            <span class="stat-sub"><?php echo e($monthName); ?></span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #ecfdf5; color: #10b981;">
            <i data-lucide="map-pin" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Lokasi Terdekat</span>
            <span class="stat-value" style="font-size: 1.2rem; margin-bottom: 2px;"><?php echo e(Str::limit($nearest->lokasi ?? 'Belum ada', 20)); ?></span>
            <span class="stat-sub"><?php echo e($nearest ? \Carbon\Carbon::parse($nearest->tanggal_pelayanan)->translatedFormat('d F Y') : '-'); ?></span>
        </div>
    </div>
    
    <div class="stat-card">
        <div class="stat-icon" style="background: #eff6ff; color: #3b82f6;">
            <i data-lucide="check-circle" style="width: 28px; height: 28px;"></i>
        </div>
        <div class="stat-info">
            <span class="stat-label">Jadwal Selesai</span>
            <?php
                $totalJadwal = \App\Models\JadwalJebol::count();
                $selesai = \App\Models\JadwalJebol::where('status', 'Selesai')->count();
                $percentage = $totalJadwal > 0 ? round(($selesai / $totalJadwal) * 100, 1) : 0;
            ?>
            <span class="stat-value"><?php echo e($selesai); ?></span>
            <span class="stat-sub"><?php echo e($percentage); ?>% dari total</span>
        </div>
    </div>
</div>

<div class="main-grid">
    <!-- Calendar Panel -->
    <div class="panel-box" id="calendar-panel">
        <div class="panel-header">
            <h3 class="panel-title"><i data-lucide="calendar-days" style="color: var(--primary);"></i> Kalender <?php echo e($monthName); ?> <?php echo e($currentDate->year); ?></h3>
        </div>
        
        <div class="cal-grid">
            <div class="cal-day-header">Sen</div>
            <div class="cal-day-header">Sel</div>
            <div class="cal-day-header">Rab</div>
            <div class="cal-day-header">Kam</div>
            <div class="cal-day-header">Jum</div>
            <div class="cal-day-header">Sab</div>
            <div class="cal-day-header">Min</div>

            <?php $__currentLoopData = $calendar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $dateString = $item['date']->format('Y-m-d');
                    $dayActivities = $activities->get($dateString, collect());
                    $hasEvent = $dayActivities->count() > 0;
                    
                    $indicatorClass = '';
                    if ($hasEvent) {
                        $firstEventStatus = $dayActivities->first()->status ?? 'Terjadwal';
                        if (strtolower($firstEventStatus) == 'selesai') $indicatorClass = 'green';
                        else $indicatorClass = 'blue';
                    }
                ?>
                <div class="cal-cell <?php echo e(!$item['isCurrentMonth'] ? 'muted' : ''); ?>" 
                    <?php if($hasEvent): ?> 
                        onclick="showCalDetail('<?php echo e($dateString); ?>', this)" 
                        data-date="<?php echo e($dateString); ?>"
                    <?php endif; ?>
                >
                    <?php if($hasEvent): ?> <div class="cal-indicator <?php echo e($indicatorClass); ?>"></div> <?php endif; ?>
                    <span><?php echo e($item['date']->day); ?></span>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <div class="cal-legend">
            <div class="legend-item"><div class="legend-dot dot-blue"></div> Terjadwal</div>
            <div class="legend-item"><div class="legend-dot dot-green"></div> Selesai</div>
        </div>

        <!-- Popup Detail Kalender -->
        <div id="cal-detail" style="display:none; margin-top: 24px; padding: 20px; background: #f8fafc; border-radius: 16px; border: 1px solid #e2e8f0;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                <h4 id="cal-detail-title" style="margin:0; font-size:1.05rem; font-weight:800; color:var(--text-main);"></h4>
                <button onclick="document.getElementById('cal-detail').style.display='none'; document.querySelectorAll('.cal-cell.active-date').forEach(c=>c.classList.remove('active-date'));" style="background:none; border:none; cursor:pointer; color:#94a3b8; font-size:1.5rem; line-height: 1;">&times;</button>
            </div>
            <div id="cal-detail-list" style="display: flex; flex-direction: column; gap: 12px;"></div>
        </div>
    </div>
    
    <!-- Schedule List Panel -->
    <div class="panel-box" style="padding-bottom: 20px; border-bottom: 1px solid #f1f5f9; margin-bottom: 20px; display: flex; flex-direction: column;">
        <div class="panel-header" style="margin-bottom: 20px;">
            <h3 class="panel-title"><i data-lucide="clock" style="color: #f59e0b;"></i> Jadwal Mendatang</h3>
        </div>
        
        <div class="schedule-list">
            <?php $__empty_1 = true; $__currentLoopData = $upcoming; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $statusText = ucfirst($act->status ?? 'Terjadwal');
                    if (strtolower($statusText) == 'ubah jadwal') $statusClass = 'badge-ditunda';
                    elseif (strtolower($statusText) == 'selesai') $statusClass = 'badge-selesai';
                    else $statusClass = 'badge-terjadwal';
                ?>
                <div class="schedule-item" onclick="showCalDetail('<?php echo e($act->tanggal_pelayanan->format('Y-m-d')); ?>')">
                    <div class="sch-icon"><i data-lucide="calendar-days" style="width: 20px; height: 20px;"></i></div>
                    <div class="sch-name"><?php echo e($act->lokasi); ?></div>
                    <div class="sch-detail"><i data-lucide="calendar" style="width:16px; height: 16px;"></i> <?php echo e($act->tanggal_pelayanan->format('d M Y')); ?></div>
                    <div class="sch-detail"><i data-lucide="clock" style="width:16px; height: 16px;"></i> <?php echo e(\Carbon\Carbon::parse($act->jam_mulai)->format('H.i')); ?> - <?php echo e(\Carbon\Carbon::parse($act->jam_selesai)->format('H.i')); ?></div>
                    <div class="status-badge <?php echo e($statusClass); ?>"><?php echo e($statusText); ?></div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <?php if($upcoming->isEmpty()): ?>
                    <!-- Mockup data -->
                    <div class="schedule-item">
                        <div class="sch-icon"><i data-lucide="calendar-days" style="width: 20px; height: 20px;"></i></div>
                        <div class="sch-name">Kecamatan Tegal Barat</div>
                        <div class="sch-detail"><i data-lucide="calendar" style="width:16px; height: 16px;"></i> 20 Mei 2025</div>
                        <div class="sch-detail"><i data-lucide="clock" style="width:16px; height: 16px;"></i> 08.00 - 12.00</div>
                        <div class="status-badge badge-terjadwal">Terjadwal</div>
                    </div>
                    <div class="schedule-item">
                        <div class="sch-icon"><i data-lucide="calendar-days" style="width: 20px; height: 20px;"></i></div>
                        <div class="sch-name">SMP Negeri 4 Tegal</div>
                        <div class="sch-detail"><i data-lucide="calendar" style="width:16px; height: 16px;"></i> 21 Mei 2025</div>
                        <div class="sch-detail"><i data-lucide="clock" style="width:16px; height: 16px;"></i> 08.00 - 12.00</div>
                        <div class="status-badge badge-terjadwal">Terjadwal</div>
                    </div>
                    <div class="schedule-item">
                        <div class="sch-icon" style="background: #fffbeb; color: #f59e0b;"><i data-lucide="calendar-days" style="width: 20px; height: 20px;"></i></div>
                        <div class="sch-name">Kelurahan Margadana</div>
                        <div class="sch-detail"><i data-lucide="calendar" style="width:16px; height: 16px;"></i> 22 Mei 2025</div>
                        <div class="sch-detail"><i data-lucide="clock" style="width:16px; height: 16px;"></i> 08.00 - 12.00</div>
                        <div class="status-badge badge-ditunda">Ubah Jadwal</div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Data jadwal per tanggal (dari server)
    <?php
        $jadwalJson = $activities->map(function($dayItems) {
            return $dayItems->map(function($item) {
                return [
                    'id' => $item->id_jadwal,
                    'lokasi' => $item->lokasi,
                    'tanggal' => \Carbon\Carbon::parse($item->tanggal_pelayanan)->translatedFormat('d F Y'),
                    'tanggal_raw' => \Carbon\Carbon::parse($item->tanggal_pelayanan)->format('Y-m-d'),
                    'jam_mulai_raw' => \Carbon\Carbon::parse($item->jam_mulai)->format('H:i'),
                    'jam_selesai_raw' => \Carbon\Carbon::parse($item->jam_selesai)->format('H:i'),
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
    ?>
    const jadwalData = <?php echo json_encode($jadwalJson, 15, 512) ?>;

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
            
            if (item.status.toLowerCase() === 'ubah jadwal') {
                badgeClass = 'badge-ditunda';
                iconColor = '#f59e0b';
                bgClass = '#fffbeb';
            } else if (item.status.toLowerCase() === 'selesai') {
                badgeClass = 'badge-selesai';
                iconColor = '#10b981';
                bgClass = '#ecfdf5';
            }

            html += '<div style="display:flex; flex-direction:column; gap:12px; padding:16px; background:white; border-radius:12px; border:1px solid #e2e8f0; box-shadow:0 1px 3px rgba(0,0,0,0.02);">';
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

            html += '  <div style="padding-top:12px; border-top:1px solid #e2e8f0; display:flex; justify-content:flex-end;">';
            html += '    <button onclick="openStatusModal(\'' + item.id + '\', \'' + item.tanggal_raw + '\', \'' + item.jam_mulai_raw + '\', \'' + item.jam_selesai_raw + '\')" style="background:var(--primary); color:white; border:none; padding:8px 16px; border-radius:8px; font-weight:600; cursor:pointer; font-size:0.85rem; display:flex; align-items:center; gap:6px;"><i data-lucide="edit-3" style="width:14px;"></i> Ubah Jadwal</button>';
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
                html += '    <a href="/admin/permohonan/' + ticketId + '" style="background:#eff6ff; color:#2563eb; padding:6px 12px; border-radius:8px; text-decoration:none; font-size:0.8rem; font-weight:700; display:inline-flex; align-items:center; gap:4px;"><i data-lucide="eye" style="width:14px; height:14px;"></i> Detail Permohonan</a>';
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
<!-- Modal Edit Status Jadwal -->
<div id="statusModal" class="modal-backdrop">
    <div class="modal-content" style="max-width: 400px;">
        <div class="modal-header" style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; font-size: 1.1rem; color: #0f172a;">Ubah Jadwal</h3>
            <button onclick="closeStatusModal()" style="background: none; border: none; font-size: 1.5rem; color: #94a3b8; cursor: pointer; line-height: 1;">&times;</button>
        </div>
        <div class="modal-body" style="padding: 24px;">
            <form id="statusForm" method="POST" action="<?php echo e(route('admin.jadwal')); ?>/_ID_/status">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>
                
                <div class="form-group" style="margin-bottom: 16px;">
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569; font-size: 0.9rem;">Tanggal Pelayanan</label>
                    <input type="date" name="tanggal_pelayanan" id="modalTanggal" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem;" required>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                    <div class="form-group">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569; font-size: 0.9rem;">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="modalJamMulai" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem;" required>
                    </div>
                    <div class="form-group">
                        <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569; font-size: 0.9rem;">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="modalJamSelesai" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem;" required>
                    </div>
                </div>

                <button type="submit" style="width: 100%; padding: 12px; background: var(--primary); color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.2s;">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<script>
    function openStatusModal(id, tanggal, jamMulai, jamSelesai) {
        const modal = document.getElementById('statusModal');
        const form = document.getElementById('statusForm');
        
        // Reset and set action
        let baseUrl = "<?php echo e(route('admin.jadwal')); ?>";
        form.action = baseUrl + "/" + id + "/status";
        
        document.getElementById('modalTanggal').value = tanggal;
        document.getElementById('modalJamMulai').value = jamMulai;
        document.getElementById('modalJamSelesai').value = jamSelesai;
        
        modal.classList.add('show');
    }

    function closeStatusModal() {
        document.getElementById('statusModal').classList.remove('show');
    }
    
    // Close modal when clicking outside
    document.getElementById('statusModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeStatusModal();
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.panel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\jeboll\resources\views/admin/jadwal.blade.php ENDPATH**/ ?>