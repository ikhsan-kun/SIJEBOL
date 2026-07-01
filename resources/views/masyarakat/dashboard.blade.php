@extends('layouts.masyarakat')

@push('styles')
<style>
@media (max-width: 1024px) {
            
        }

        /* Top Grid: Hero & Profile */
        .top-grid {
            margin: -24px -24px 32px -24px;
            display: grid;
            grid-template-columns: 2.5fr 1fr;
            gap: 0;
            align-items: stretch;
        }

        @media (max-width: 1200px) {
            .top-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 1024px) {
            .top-grid { margin: -16px -16px 32px -16px !important; }
        }
        @media (max-width: 768px) {
            .top-grid { 
                margin: -16px -16px 16px -16px !important; 
                width: calc(100% + 32px) !important;
                display: block !important; 
            }
            .hero-banner, .profile-card {
                border-radius: 0 !important;
                margin-bottom: 0 !important;
                width: 100% !important;
                box-sizing: border-box !important;
            }
            .profile-card { border-bottom: 1px solid #e2e8f0 !important; border-top: none !important; }
        }

        .hero-banner {
            background: #003178;
            color: white;
            position: relative;
            overflow: hidden;
            border-radius: 0;
            padding: 40px;
            margin: 0;
            border-bottom: 4px solid var(--accent);
            box-shadow: 0 10px 30px rgba(0,49,120,0.1);
            display: flex;
            align-items: center;
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
        }

        .hero-content {
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            gap: 32px;
            width: 100%;
        }

        .hero-text-left {
            flex: 1;
        }

        .hero-text-right {
            flex: 0.8;
            border-left: 2px solid rgba(255, 255, 255, 0.2);
            padding-left: 40px;
        }

        @media (max-width: 768px) {
            .hero-content {
                flex-direction: column;
                text-align: center;
            }
            .hero-text-right {
                border-left: none;
                padding-left: 0;
                border-top: 2px solid rgba(255, 255, 255, 0.2);
                padding-top: 24px;
            }
        }

        .hero-title {
            font-size: 2rem;
            font-weight: 800;
            margin: 0;
        }

        .hero-title span {
            color: #fbbf24;
        }

        .hero-desc {
            font-size: 1rem;
            opacity: 0.9;
            margin: 12px 0 0 0;
            line-height: 1.6;
        }

        /* Profile Card */
        .profile-card {
            background: white;
            border-radius: 0;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
            border: 1px solid #e2e8f0;
            border-left: none;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .profile-avatar {
            width: 64px;
            height: 64px;
            background: #eff6ff;
            color: #3b82f6;
            border-radius: 50%;
            display: grid;
            place-items: center;
            margin-bottom: 16px;
        }

        .profile-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 4px 0;
        }

        .profile-nik {
            font-size: 0.75rem;
            color: #64748b;
            margin: 0 0 12px 0;
        }

        .profile-badge {
            background: #ecfdf5;
            color: #10b981;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.65rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 16px;
        }

        .btn-profile {
            background: #003178;
            color: white;
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s;
        }

        .btn-profile:hover { background: #002254; }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 0;
            margin-bottom: 0;
        }

        .stat-card {
            background: white;
            border-radius: 0;
            padding: 24px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
            border: 1px solid #e2e8f0;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .stat-info { display: flex; flex-direction: column; }
        .stat-title { font-size: 0.8rem; font-weight: 600; color: #475569; margin: 0 0 4px 0; }
        .stat-value { font-size: 1.8rem; font-weight: 800; color: #0f172a; line-height: 1; margin: 0 0 6px 0; }
        .stat-sub { font-size: 0.7rem; color: #94a3b8; margin: 0; }

        /* Aksi Cepat */
        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
            padding: 24px 24px 0 24px;
            background: white;
            border: 1px solid #e2e8f0;
            border-bottom: none;
        }

        .action-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0;
            margin-bottom: 0;
        }

        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(3, 1fr); }
        }

        @media (max-width: 1024px) { 
            .action-grid { grid-template-columns: repeat(2, 1fr); } 
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 640px) { 
            .action-grid, .stats-grid { 
                display: grid;
                grid-template-columns: 1fr;
                gap: 12px;
            } 
            .action-card, .stat-card {
                border-radius: 12px;
            }
        }

        .action-card {
            background: white;
            border-radius: 0;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
            border: 1px solid #e2e8f0;
            transition: all 0.2s;
        }

        .action-card:hover {
            border-color: #3b82f6;
            box-shadow: 0 8px 16px rgba(59,130,246,0.1);
        }

        .action-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #003178;
            color: white;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .action-info { flex-grow: 1; }
        .action-title { font-size: 0.85rem; font-weight: 700; color: #0f172a; margin: 0 0 2px 0; }
        .action-sub { font-size: 0.7rem; color: #64748b; margin: 0; }

        /* Bottom Grid */
        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0;
        }

        @media (max-width: 1200px) { .bottom-grid { grid-template-columns: 1fr; } }

        .panel-card {
            background: white;
            border-radius: 0;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
            border: 1px solid #e2e8f0;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .panel-title {
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .view-all {
            font-size: 0.75rem;
            font-weight: 600;
            color: #3b82f6;
            text-decoration: none;
        }

        /* Table */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table-riwayat {
            width: 100%;
            border-collapse: collapse;
        }

        .table-riwayat th {
            text-align: left;
            padding: 12px 8px;
            font-size: 0.7rem;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #f1f5f9;
            white-space: nowrap;
        }

        .table-riwayat td {
            padding: 16px 8px;
            font-size: 0.85rem;
            border-bottom: 1px solid #f1f5f9;
            color: #1e293b;
        }

        .table-riwayat tr:last-child td { border-bottom: none; }

        @media (max-width: 640px) {
            .table-responsive {
                margin: 0 -16px;
                padding: 0 24px;
            }
            .table-riwayat {
                min-width: 550px;
            }
            .table-riwayat td {
                white-space: nowrap;
            }
        }

        .status-badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.7rem;
            font-weight: 700;
            display: inline-block;
        }

        .badge-menunggu { background: #fffbeb; color: #d97706; }
        .badge-terjadwal { background: #eff6ff; color: #2563eb; }
        .badge-selesai { background: #ecfdf5; color: #10b981; }
        .badge-batal { background: #fef2f2; color: #ef4444; }

        .btn-lihat {
            color: #3b82f6;
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            padding: 6px 12px;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            display: inline-block;
            transition: all 0.2s;
        }

        .btn-lihat:hover {
            background: #eff6ff;
        }

        /* Lists */
        .list-item {
            display: flex;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .list-item:last-child { border-bottom: none; }

        .list-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .icon-blue { background: #eff6ff; color: #3b82f6; }
        .icon-green { background: #ecfdf5; color: #10b981; }
        .icon-yellow { background: #fffbeb; color: #d97706; }

        .list-info h5 { margin: 0 0 4px 0; font-size: 0.85rem; font-weight: 700; color: #0f172a; }
        .list-info p { margin: 0; font-size: 0.75rem; color: #64748b; line-height: 1.4; }
        .list-meta { font-size: 0.7rem; color: #94a3b8; font-weight: 600; margin-top: 4px; }
        
        .date-float {
            font-size: 0.7rem;
            color: #64748b;
            font-weight: 600;
        }

        .footer {
            margin-top: 0;
            padding: 24px;
            background: white;
            border-top: none;
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #64748b;
        }
</style>
@endpush

@section('content')
<div class="top-grid">
                <!-- Hero Banner -->
                <div class="hero-banner">
                    <div class="hero-content">
                        <div class="hero-text-left">
                            <h1 class="hero-title">Selamat Datang, <br><span>Warga Kota Tegal!</span> <i data-lucide="hand" style="display:inline; width:24px; color:#fbbf24;"></i></h1>
                        </div>
                        <div class="hero-text-right">
                            <p class="hero-desc">Si Jebol memudahkan Anda mengurus dokumen kependudukan secara online, cepat, dan transparan.</p>
                        </div>
                    </div>
                </div>

                <!-- Profile Card -->
                <div class="profile-card">
                    <div class="profile-avatar" style="overflow: hidden; padding: 0;">
                        @if(auth()->user()->foto_profil ?? auth()->user()->profile_photo_path)
                            <img src="{{ asset('storage/' . (auth()->user()->foto_profil ?? auth()->user()->profile_photo_path)) }}" alt="Profile Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <i data-lucide="user" style="width:32px; height:32px;"></i>
                        @endif
                    </div>
                    <h3 class="profile-name">{{ auth()->user()->nama ?? auth()->user()->name ?? '-' }}</h3>
                    <p class="profile-nik">{{ auth()->user()->email ?? '-' }}</p>
                    <span class="profile-badge">TERVERIFIKASI <i data-lucide="check-circle-2" style="width:12px; height:12px;"></i></span>
                    <a href="{{ route('masyarakat.settings') }}" class="btn-profile"><i data-lucide="user" style="width:16px;"></i> Lihat Profil</a>
                </div>
            </div>

            <!-- Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon" style="background: #eff6ff; color: #3b82f6;">
                        <i data-lucide="file-text"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-title">Total Pengajuan</h3>
                        <p class="stat-value">{{ $totalPengajuan }}</p>
                        <p class="stat-sub">Semua waktu <i data-lucide="info" style="width:10px; display:inline;"></i></p>
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon" style="background: #fffbeb; color: #d97706;">
                        <i data-lucide="clock"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-title">Menunggu Verifikasi</h3>
                        <p class="stat-value">{{ $statusMenunggu }}</p>
                        <p class="stat-sub">Perlu ditindaklanjuti</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: #f5f3ff; color: #8b5cf6;">
                        <i data-lucide="calendar"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-title">Terjadwal</h3>
                        <p class="stat-value">{{ $statusProses }}</p>
                        <p class="stat-sub">Jadwal mobile service</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: #ecfdf5; color: #10b981;">
                        <i data-lucide="check-circle-2"></i>
                    </div>
                    <div class="stat-info">
                        <h3 class="stat-title">Selesai</h3>
                        <p class="stat-value">{{ $statusSelesai }}</p>
                        <p class="stat-sub">Pengajuan selesai</p>
                    </div>
                </div>

                <!-- Chart Card -->
                <div class="stat-card" style="padding: 16px; flex-direction: column; justify-content: center; gap: 8px;">
                    <h3 class="stat-title" style="text-align: center; width: 100%; font-size: 0.75rem;">Rekap Selesai per Layanan</h3>
                    <div style="display: flex; align-items: center; justify-content: center; gap: 12px; width: 100%;">
                        <div style="position: relative; width: 56px; height: 56px; flex-shrink: 0;">
                            <canvas id="rekapLayananChart"></canvas>
                            <div style="position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; pointer-events: none;">
                                <span style="font-size: 0.7rem; font-weight: 800; color: #1e293b; text-align: center;">{{ $statusSelesai }}</span>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 4px; font-size: 0.6rem;">
                            <div style="display: flex; justify-content: space-between; gap: 6px;">
                                <div style="display: flex; align-items: center; gap: 4px;">
                                    <span style="width: 6px; height: 6px; border-radius: 50%; background: #2563eb;"></span>
                                    <span style="font-weight: 700; color: #475569;">IKD</span>
                                </div>
                                <span style="color: #64748b; font-weight: 600;">({{ $statusSelesai > 0 ? round(($rekapSelesaiData[0] / $statusSelesai) * 100) : 0 }}%)</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; gap: 6px;">
                                <div style="display: flex; align-items: center; gap: 4px;">
                                    <span style="width: 6px; height: 6px; border-radius: 50%; background: #10b981;"></span>
                                    <span style="font-weight: 700; color: #475569;">KTP</span>
                                </div>
                                <span style="color: #64748b; font-weight: 600;">({{ $statusSelesai > 0 ? round(($rekapSelesaiData[1] / $statusSelesai) * 100) : 0 }}%)</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; gap: 6px;">
                                <div style="display: flex; align-items: center; gap: 4px;">
                                    <span style="width: 6px; height: 6px; border-radius: 50%; background: #fb923c;"></span>
                                    <span style="font-weight: 700; color: #475569;">KIA</span>
                                </div>
                                <span style="color: #64748b; font-weight: 600;">({{ $statusSelesai > 0 ? round(($rekapSelesaiData[2] / $statusSelesai) * 100) : 0 }}%)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aksi Cepat -->
            <h2 class="section-title">Aksi Cepat</h2>
            <div class="action-grid">
                <a href="{{ route('pengajuan') }}?layanan=KTP-el" class="action-card">
                    <div class="action-icon"><i data-lucide="contact-2"></i></div>
                    <div class="action-info">
                        <h4 class="action-title">Ajukan KTP-el</h4>
                        <p class="action-sub">Buat permohonan KTP elektronik</p>
                    </div>
                    <i data-lucide="chevron-right" style="color: #cbd5e1; width:20px;"></i>
                </a>

                <a href="{{ route('pengajuan') }}?layanan=KIA" class="action-card">
                    <div class="action-icon"><i data-lucide="baby"></i></div>
                    <div class="action-info">
                        <h4 class="action-title">Ajukan KIA</h4>
                        <p class="action-sub">Buat permohonan Kartu Identitas Anak</p>
                    </div>
                    <i data-lucide="chevron-right" style="color: #cbd5e1; width:20px;"></i>
                </a>

                <a href="{{ route('pengajuan') }}?layanan=IKD" class="action-card">
                    <div class="action-icon"><i data-lucide="smartphone"></i></div>
                    <div class="action-info">
                        <h4 class="action-title">Aktivasi IKD</h4>
                        <p class="action-sub">Aktifkan Identitas Kependudukan Digital</p>
                    </div>
                    <i data-lucide="chevron-right" style="color: #cbd5e1; width:20px;"></i>
                </a>

                <a href="{{ route('masyarakat.cek-status') }}" class="action-card">
                    <div class="action-icon" style="background: #eff6ff; color: #003178;"><i data-lucide="search"></i></div>
                    <div class="action-info">
                        <h4 class="action-title">Lacak Status</h4>
                        <p class="action-sub">Cek progres pengajuan dokumen Anda</p>
                    </div>
                    <i data-lucide="chevron-right" style="color: #cbd5e1; width:20px;"></i>
                </a>
            </div>

            <!-- Bottom Sections -->
            <div class="bottom-grid">
                
                <!-- Riwayat -->
                <div class="panel-card">
                    <div class="panel-header">
                        <h3 class="panel-title">Riwayat Pengajuan Terbaru</h3>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table-riwayat">
                            <thead>
                                <tr>
                                    <th>Nomor Tiket</th>
                                    <th>Jenis Layanan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lastPermohonan as $lp)
                                <tr>
                                    <td style="font-weight: 600;">
                                        <a href="{{ route('masyarakat.cek-status') }}?search={{ $lp->nomor_tiket }}" style="color: inherit; text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                                            #{{ $lp->nomor_tiket }}
                                        </a>
                                    </td>
                                    <td style="font-weight: 600;">{{ $lp->jenis_layanan }}</td>
                                    <td>{{ $lp->tanggal_pengajuan ? $lp->tanggal_pengajuan->format('d M Y') : '--' }}</td>
                                    <td>
                                        @php
                                            $badgeClass = 'badge-menunggu';
                                            $text = 'Menunggu Verifikasi';
                                            if($lp->status == 'diproses') { $badgeClass = 'badge-terjadwal'; $text = 'Terjadwal'; }
                                            elseif($lp->status == 'selesai') { $badgeClass = 'badge-selesai'; $text = 'Selesai'; }
                                            elseif($lp->status == 'ditolak') { $badgeClass = 'badge-batal'; $text = 'Dibatalkan'; }
                                        @endphp
                                        <span class="status-badge {{ $badgeClass }}">{{ strtoupper($text) }}</span>
                                    </td>
                                    <td><a href="{{ route('masyarakat.cek-status') }}?search={{ $lp->nomor_tiket }}" class="btn-lihat">Lihat</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div style="margin-top: 16px;">
                        <a href="{{ route('masyarakat.cek-status') }}" style="font-size: 0.8rem; font-weight: 700; color: #3b82f6; text-decoration: none; display: flex; align-items: center; gap: 4px;">
                            Lihat Semua Pengajuan <i data-lucide="arrow-right" style="width:14px;"></i>
                        </a>
                    </div>
                </div>



            </div>
@endsection
