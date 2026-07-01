@extends('layouts.masyarakat')

@push('styles')
<style>
@media print {
            
            .sidebar-desktop, .sidebar-mobile, .hero-section, .pagination-premium-v2, .history-card, button, a:not(.btn-search) { display: none !important; }
            .tracking-container { margin-left: 0 !important; padding: 20px !important; background: none !important; }
            .tracking-container::before { display: none !important; }
            .result-card { box-shadow: none !important; border: 2px solid #e2e8f0 !important; border-radius: 16px !important; }
            .timeline-box { margin: 20px 0 !important; }
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        }

        

        

        .tracking-container {
            flex-grow: 1;
            margin-left: 260px;
            padding: 80px 40px 0 ;
            background-image: url('{{ asset('img/batik-pattern.png') }}');
            background-size: 600px;
            background-attachment: fixed;
            position: relative;
            transition: all 0.3s ease;
            min-width: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .tracking-container::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(241, 245, 249, 0.96);
            z-index: 0;
        }

        .tracking-container > * {
            position: relative;
            z-index: 1;
        }

        .hero-section {
            text-align: center;
            margin: 0 -40px 60px -40px;
            background: var(--primary);
            background-image: linear-gradient(rgba(0, 49, 120, 0.9), rgba(0, 49, 120, 0.9)), url('{{ asset('images/batik-tegal-premium.jpg') }}');
            background-size: cover;
            padding: 60px 80px;
            border-radius: 0;
            color: white;
            box-shadow: 0 20px 40px rgba(0, 49, 120, 0.15);
            border-bottom: 4px solid var(--accent);
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: 800;
            color: white;
            margin-bottom: 12px;
            letter-spacing: -1px;
        }

        .hero-section h1 span { color: var(--accent); }

        .hero-section p {
            color: rgba(255, 255, 255, 0.85);
            max-width: 600px;
            margin: 0 auto;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        /* Search Bar Capsule Style */
        .search-wrapper {
            max-width: 700px;
            margin: 32px auto 0;
            position: relative;
        }

        .search-capsule {
            display: flex;
            background: white;
            padding: 8px;
            border-radius: 100px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .search-input-group {
            flex: 1;
            display: flex;
            align-items: center;
            padding-left: 24px;
        }

        .search-input-group i {
            color: var(--primary);
            margin-right: 16px;
        }

        .search-input-group input {
            width: 100%;
            border: none;
            outline: none;
            font-size: 1rem;
            font-weight: 600;
            color: var(--primary-dark);
            background: transparent;
        }

        .btn-search {
            background: var(--primary);
            color: white;
            padding: 14px 40px;
            border-radius: 100px;
            font-weight: 800;
            font-size: 0.9rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-search:hover {
            background: var(--accent);
            color: var(--primary-dark);
            transform: scale(1.02);
        }

        /* Result Card */
        .result-card {
            background: white;
            border-radius: 40px;
            padding: 48px;
            box-shadow: 0 20px 60px rgba(0, 49, 120, 0.05);
            margin-top: 40px;
            border: 1px solid rgba(0, 49, 120, 0.05);
        }

        .timeline-box {
            display: flex;
            justify-content: space-between;
            margin: 60px 0;
            position: relative;
        }

        .timeline-box::before {
            content: '';
            position: absolute;
            top: 26px;
            left: 70px;
            right: 70px;
            height: 2px;
            background: #f1f5f9;
            z-index: 1;
        }

        .t-step {
            position: relative;
            z-index: 2;
            text-align: center;
            width: 140px;
        }

        .t-icon {
            width: 52px;
            height: 52px;
            background: white;
            border: 2px solid #f1f5f9;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: #94a3b8;
            transition: all 0.3s;
        }

        .t-step.active .t-icon {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
            box-shadow: 0 10px 20px rgba(0, 49, 120, 0.2);
        }

        .t-step.done .t-icon {
            background: #10b981;
            border-color: #10b981;
            color: white;
        }

        .t-label {
            font-weight: 800;
            font-size: 0.85rem;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .t-time {
            font-size: 0.75rem;
            color: #64748b;
            margin-top: 4px;
            font-weight: 500;
        }

        /* Status Badges */
        .badge-premium {
            padding: 6px 14px;
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-pending { background: #fff7ed; color: #f97316; }
        .badge-process { background: #eff6ff; color: #3b82f6; }
        .badge-success { background: #ecfdf5; color: #059669; }
        .badge-danger { background: #fef2f2; color: #dc2626; }

        /* Stats Cards */
        .stats-grid-container {
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
            gap: 24px; 
            margin-bottom: 32px;
        }
        .stat-card {
            background: white; border-radius: 20px; padding: 24px; border: 1px solid rgba(0,49,120,0.05); box-shadow: 0 10px 30px rgba(0,49,120,0.02); display: flex; align-items: center; gap: 20px;
        }
        .stat-icon {
            width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .stat-content p {
            color: #64748b; font-size: 0.85rem; font-weight: 800; margin-bottom: 4px; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 0;
        }
        .stat-content h3 {
            font-size: 1.8rem; font-weight: 900; color: #0f172a; line-height: 1; margin: 0;
        }
        .stat-content h3 span {
            font-size: 0.9rem; color: #94a3b8; font-weight: 600;
        }

        /* History Table */
        .history-card {
            background: white;
            border-radius: 32px;
            padding: 0;
            box-shadow: 0 10px 30px rgba(0, 49, 120, 0.04);
            border: 1px solid rgba(0, 49, 120, 0.05);
            overflow: hidden;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .history-table th {
            text-align: left;
            padding: 24px;
            background: #fafbfc;
            font-size: 0.7rem;
            font-weight: 800;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid #f1f5f9;
        }

        .history-table td {
            padding: 24px;
            border-bottom: 1px solid #f8fafc;
            font-size: 0.9rem;
        }

        .history-table tr:last-child td { border-bottom: none; }

        .btn-detail {
            color: var(--primary);
            font-weight: 800;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-detail:hover { color: var(--accent); transform: translateX(5px); }

        @media (max-width: 1024px) {
            .sidebar-masyarakat {
                transform: translateX(-100%);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .sidebar-masyarakat.active {
                transform: translateX(0);
            }
            .global-content-header {
                width: 100% !important;
                padding: 0 20px !important;
            }
            .tracking-container {
                margin-left: 0 !important;
                padding: 100px 16px 40px !important;
            }
            .hero-section {
                margin: 0 -16px 60px -16px;
                padding: 40px 24px;
            }
            .sidebar-overlay {
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.4);
                backdrop-filter: blur(4px);
                z-index: 999;
            }
        }

        @media (max-width: 768px) {
            .hero-section { padding: 40px 16px; border-radius: 0; }
            .hero-section h1 { font-size: 2.2rem; }
            .hero-section p { font-size: 1rem; }
            
            .search-capsule {
                flex-direction: column;
                border-radius: 24px;
                padding: 12px;
            }
            .search-input-group {
                padding: 12px;
                border-bottom: 1px solid #f1f5f9;
                margin-bottom: 8px;
            }
            .btn-search { width: 100%; border-radius: 16px; }

            .timeline-box { 
                flex-direction: column; 
                gap: 0; 
                align-items: flex-start; 
                margin: 40px 0; 
                padding-left: 0;
                position: relative;
            }
            .timeline-box::before { 
                display: block; 
                content: '';
                position: absolute;
                top: 20px;
                bottom: 50px;
                left: 20px;
                width: 2px;
                height: auto;
                background: #f1f5f9;
                right: auto;
                z-index: 1;
            }
            .t-step { 
                width: 100%; 
                display: flex; 
                align-items: center; 
                text-align: left; 
                gap: 16px; 
                margin-bottom: 32px;
                position: relative;
            }
            .t-icon { margin: 0; flex-shrink: 0; width: 40px; height: 40px; }
            .t-step::after {
                content: '';
                position: absolute;
                left: -21px;
                top: 20px;
                width: 10px;
                height: 10px;
                background: #e2e8f0;
                border-radius: 50%;
                border: 2px solid white;
            }
            .t-step.active::after, .t-step.done::after {
                background: var(--primary);
            }
            .t-step.done::after { background: #10b981; }

            /* Mobile Stats Grid */
            .stats-grid-container {
                grid-template-columns: 1fr 1fr; /* Force 2 columns */
                gap: 12px;
            }
            .stat-card {
                flex-direction: column;
                align-items: flex-start;
                padding: 16px;
                gap: 12px;
                border-radius: 16px;
            }
            .stat-icon {
                width: 40px;
                height: 40px;
                border-radius: 12px;
            }
            .stat-icon svg {
                width: 20px;
                height: 20px;
            }
            .stat-content p {
                font-size: 0.65rem;
                line-height: 1.2;
                margin-bottom: 8px;
            }
            .stat-content h3 {
                font-size: 1.4rem;
            }
            .stat-content h3 span {
                font-size: 0.7rem;
                display: block; /* Drop text to next line to save width */
                margin-top: 4px;
            }

            /* Table to Cards */
            .history-table, .history-table thead { display: none; }
            .history-table tr { 
                display: block; 
                background: white; 
                border-radius: 20px; 
                padding: 20px; 
                margin-bottom: 16px;
                border: 1px solid #f1f5f9;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            }
            .history-table td { 
                display: flex; 
                justify-content: space-between; 
                align-items: center; 
                padding: 8px 0;
                border: none;
                width: 100%;
            }
            .history-table td::before {
                content: attr(data-label);
                font-weight: 800;
                font-size: 0.7rem;
                color: #94a3b8;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }
            .history-table td:last-child {
                border-top: 1px solid #f8fafc;
                margin-top: 8px;
                padding-top: 16px;
            }
            .mobile-text-right { text-align: right; }
        }

        /* Modal Guide */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 49, 120, 0.4);
            backdrop-filter: blur(8px);
            z-index: 2000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.active { display: flex; }

        .modal-content {
            background: white;
            width: 100%;
            max-width: 600px;
            border-radius: 40px;
            padding: 40px;
            box-shadow: 0 50px 100px rgba(0, 49, 120, 0.2);
            position: relative;
        }

        /* Pagination */
        .pagination-premium-v2 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 32px 0 0;
            border-top: 1px solid #f1f5f9;
            margin-top: 24px;
        }

        .pagination-info {
            font-size: 0.85rem;
            font-weight: 700;
            color: #94a3b8;
        }

        .pagination-controls-v2 {
            display: flex;
            gap: 8px;
        }

        .page-nav-btn {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.9rem;
            color: #64748b;
            border: 1px solid #e2e8f0;
            background: white;
            transition: all 0.2s;
            text-decoration: none !important;
            cursor: pointer;
        }

        .page-nav-btn:hover {
            background: #f8fafc;
            border-color: var(--primary);
            color: var(--primary);
        }

        .page-nav-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            box-shadow: 0 5px 15px rgba(0, 49, 120, 0.2);
        }

        .page-nav-btn:disabled, .page-nav-btn.disabled {
            opacity: 0.4;
            cursor: not-allowed;
            pointer-events: none;
            background: #f1f5f9;
            border-color: #e2e8f0;
        }
        
        @media (max-width: 768px) {
            .pagination-premium-v2 {
                flex-direction: column;
                gap: 20px;
                padding-top: 24px;
            }
        }
</style>
@endpush

@section('content')
@if($search)
                <a href="{{ route('masyarakat.cek-status') }}" style="display: inline-flex; align-items: center; gap: 8px; color: #64748b; font-weight: 700; font-size: 0.85rem; margin-bottom: 24px; text-decoration: none;">
                    <i data-lucide="arrow-left" width="16" height="16"></i> Kembali ke Riwayat
                </a>
            @endif

            <section class="hero-section">
                <h1>Pantau <span>Status</span></h1>
                <p>Masukkan Nomor Tiket untuk melacak kemajuan dokumen kependudukan Anda secara real-time.</p>
                
                <div class="search-wrapper">
                    <form action="{{ route('masyarakat.cek-status') }}" method="GET" class="search-capsule">
                        <div class="search-input-group">
                            <i data-lucide="search" width="20" height="20"></i>
                            <input type="text" name="search" placeholder="Masukkan Nomor Tiket..." value="{{ $search }}" autocomplete="off">
                        </div>
                        <button type="submit" class="btn-search">Lacak Sekarang</button>
                    </form>
                </div>
            </section>

            @if($search && !$permohonan)
                <div class="result-card" style="text-align: center; padding: 80px 40px;">
                    <div style="width: 80px; height: 80px; background: #fef2f2; color: #dc2626; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                        <i data-lucide="search-x" width="40" height="40"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 800; color: #1e293b; margin-bottom: 8px;">Data Tidak Ditemukan</h3>
                    <p style="color: #64748b; font-weight: 500;">Pastikan nomor yang Anda masukkan sudah benar.</p>
                </div>
            @endif

            @if($permohonan)
                <div class="result-card" id="detail-pengajuan">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px; flex-wrap: wrap; gap: 20px;">
                        <div>
                            <p style="font-size: 0.7rem; font-weight: 800; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px;">Detail Pengajuan</p>
                            <h2 style="font-size: 2rem; font-weight: 800; color: var(--primary); margin: 0;">{{ $permohonan->jenis_layanan }}</h2>
                            <p style="font-size: 0.9rem; font-weight: 700; color: #64748b; margin-top: 8px;">TIKET: <span style="color: var(--primary);">#{{ $permohonan->nomor_tiket }}</span></p>
                        </div>
                        @php
                            $status = $permohonan->status;
                            $sClass = match($status) {
                                'menunggu_verifikasi', 'pending' => 'background:#fef3c7; color:#b45309; border:1.5px solid #fcd34d;',
                                'terverifikasi', 'verified' => 'background:#eff6ff; color:#1d4ed8; border:1.5px solid #93c5fd;',
                                'terjadwal' => 'background:#f0fdf4; color:#15803d; border:1.5px solid #86efac;',
                                'diproses', 'processing' => 'background:#faf5ff; color:#7c3aed; border:1.5px solid #c4b5fd;',
                                'selesai' => 'background:#f0fdf4; color:#166534; border:1.5px solid #4ade80;',
                                'ditolak' => 'background:#fef2f2; color:#dc2626; border:1.5px solid #fca5a5;',
                                default => 'background:#f1f5f9; color:#475569; border:1.5px solid #e2e8f0;'
                            };
                            $sLabel = match($status) {
                                'menunggu_verifikasi', 'pending' => 'Menunggu Verifikasi',
                                'terverifikasi', 'verified' => 'Terverifikasi',
                                'terjadwal' => 'Terjadwal',
                                'diproses', 'processing' => 'Sedang Diproses',
                                'selesai' => 'Selesai',
                                'ditolak' => 'Ditolak',
                                default => strtoupper($status)
                            };
                        @endphp
                        <span style="padding: 10px 20px; border-radius: 50px; font-weight: 800; font-size: 0.8rem; letter-spacing: 0.5px; {{ $sClass }}">
                            {{ $sLabel }}
                        </span>
                    </div>

                    <style>
                        @media (max-width: 768px) {
                            .detail-status-badge { transform: none !important; }
                        }
                    </style>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 48px;">
                        <div style="background: #f8fafc; padding: 24px; border-radius: 24px; border: 1px solid #f1f5f9;">
                            <p style="font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 8px;">Pemohon</p>
                            <p style="font-weight: 800; color: #1e293b; font-size: 0.95rem;">{{ strtoupper($permohonan->masyarakat->nama ?? '--') }}</p>
                        </div>
                        <div style="background: #f8fafc; padding: 24px; border-radius: 24px; border: 1px solid #f1f5f9;">
                            <p style="font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 8px;">NIK</p>
                            <p style="font-weight: 800; color: #1e293b; font-size: 0.95rem;">{{ $permohonan->masyarakat->nik ?? '--' }}</p>
                        </div>
                        <div style="background: #f8fafc; padding: 24px; border-radius: 24px; border: 1px solid #f1f5f9;">
                            <p style="font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 8px;">Tanggal</p>
                            <p style="font-weight: 800; color: #1e293b; font-size: 0.95rem;">{{ $permohonan->tanggal_pengajuan ? $permohonan->tanggal_pengajuan->format('d M Y') : '--' }}</p>
                        </div>
                        <div style="background: #f8fafc; padding: 24px; border-radius: 24px; border: 1px solid #f1f5f9;">
                            <p style="font-size: 0.65rem; font-weight: 800; color: #94a3b8; text-transform: uppercase; margin-bottom: 8px;">Lokasi</p>
                            <p style="font-weight: 800; color: #1e293b; font-size: 0.95rem;">{{ $permohonan->lokasi_pelayanan ?? '--' }}</p>
                        </div>
                    </div>

                    @php
                        $st = $permohonan->status;
                        $statusOrder = ['menunggu_verifikasi' => 0, 'pending' => 0, 'terverifikasi' => 1, 'verified' => 1, 'terjadwal' => 2, 'diproses' => 3, 'processing' => 3, 'selesai' => 4];
                        $currentIdx = $statusOrder[$st] ?? 0;
                        $isDitolak = $st === 'ditolak';
                        $detailJson = json_decode($permohonan->detail_pengajuan, true) ?? [];
                        $jadwalWaktuMulai = $detailJson['usulan_jam_mulai'] ?? null;
                        $jadwalWaktuSelesai = $detailJson['usulan_jam_selesai'] ?? null;
                    @endphp

                    @if(in_array($st, ['terjadwal', 'diproses', 'selesai']) && ($permohonan->tanggal_kedatangan || $permohonan->jumlah_petugas))
                    <div style="background: linear-gradient(135deg, #eff6ff 0%, #f0fdf4 100%); border: 1px solid #bfdbfe; border-radius: 24px; padding: 24px; margin-bottom: 32px; position: relative; overflow: hidden;">
                        <div style="position: absolute; top: -15px; right: -15px; width: 100px; height: 100px; background: rgba(59,130,246,0.06); border-radius: 50%;"></div>
                        <div style="position: absolute; bottom: -20px; left: -20px; width: 80px; height: 80px; background: rgba(16,185,129,0.06); border-radius: 50%;"></div>
                        <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 16px; position: relative;">
                            <div style="width: 44px; height: 44px; background: var(--primary); color: white; border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 12px rgba(0,49,120,0.2);">
                                <i data-lucide="calendar-check" width="22" height="22"></i>
                            </div>
                            <div>
                                <div style="font-size: 0.8rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 0.5px;">Informasi Penjadwalan</div>
                                <div style="font-size: 0.85rem; color: #64748b; font-weight: 500;">Pengajuan Anda telah dijadwalkan oleh Disdukcapil</div>
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 12px; position: relative;">
                            <div style="background: white; padding: 16px; border-radius: 16px; text-align: center; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
                                <div style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 6px;">Tanggal Pelayanan</div>
                                <div style="font-size: 1rem; font-weight: 800; color: var(--primary);">
                                    {{ $permohonan->tanggal_kedatangan ? \Carbon\Carbon::parse($permohonan->tanggal_kedatangan)->translatedFormat('d F Y') : '--' }}
                                </div>
                            </div>
                            <div style="background: white; padding: 16px; border-radius: 16px; text-align: center; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
                                <div style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 6px;">Waktu</div>
                                <div style="font-size: 1rem; font-weight: 800; color: #1e293b;">
                                    @if($jadwalWaktuMulai && $jadwalWaktuSelesai)
                                        {{ $jadwalWaktuMulai }} - {{ $jadwalWaktuSelesai }} WIB
                                    @else
                                        --
                                    @endif
                                </div>
                            </div>
                            <div style="background: white; padding: 16px; border-radius: 16px; text-align: center; border: 1px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.02);">
                                <div style="font-size: 0.65rem; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 6px;">Jumlah Petugas</div>
                                <div style="font-size: 1rem; font-weight: 800; color: #16a34a;">
                                    {{ $permohonan->jumlah_petugas ? $permohonan->jumlah_petugas . ' Orang' : '--' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="timeline-box">
                        @php
                        $steps = [
                            ['label' => 'Menunggu Verifikasi', 'icon' => 'clock', 'idx' => 0],
                            ['label' => 'Terverifikasi', 'icon' => 'shield-check', 'idx' => 1],
                            ['label' => 'Terjadwal', 'icon' => 'calendar-check', 'idx' => 2],
                            ['label' => 'Diproses', 'icon' => 'loader', 'idx' => 3],
                            ['label' => 'Selesai', 'icon' => 'package-check', 'idx' => 4],
                        ];
                        @endphp
                        @foreach($steps as $s)
                        <div class="t-step {{ $isDitolak ? '' : ($currentIdx > $s['idx'] ? 'done' : ($currentIdx === $s['idx'] ? 'active' : '')) }}">
                            <div class="t-icon">
                                @if(!$isDitolak && $currentIdx > $s['idx'])
                                    <i data-lucide="check" width="24" height="24"></i>
                                @else
                                    <i data-lucide="{{ $s['icon'] }}" width="24" height="24"></i>
                                @endif
                            </div>
                            <div class="t-label">{{ $s['label'] }}</div>
                            <div class="t-time">
                                @if($isDitolak) Ditolak
                                @elseif($currentIdx > $s['idx']) Selesai
                                @elseif($currentIdx === $s['idx']) Saat ini
                                @else Menunggu @endif
                            </div>
                        </div>
                        @endforeach
                        @if($isDitolak)
                        <div class="t-step active" style="--dot-color:#dc2626;">
                            <div class="t-icon" style="background:#fef2f2; color:#dc2626;"><i data-lucide="x-circle" width="24" height="24"></i></div>
                            <div class="t-label" style="color:#dc2626;">Ditolak</div>
                            <div class="t-time">Selesai</div>
                        </div>
                        @endif
                    </div>

                    @if($permohonan->keterangan)
                        <div style="background: #fef2f2; border: 1px solid #fee2e2; border-radius: 20px; padding: 20px; margin-top: 32px;">
                            <p style="font-size: 0.75rem; font-weight: 800; color: #b91c1c; text-transform: uppercase; margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                                <i data-lucide="info" width="16" height="16"></i> Catatan Petugas
                            </p>
                            <p style="color: #991b1b; font-size: 0.9rem; font-weight: 500;">{{ $permohonan->keterangan }}</p>
                        </div>
                    @endif

                    <div style="margin-top: 48px; padding-top: 32px; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
                        <p style="color: #64748b; font-size: 0.85rem; font-weight: 600; display: flex; align-items: center; gap: 8px;">
                            <i data-lucide="help-circle" width="18" height="18" color="var(--primary)"></i> 
                            Butuh bantuan? Silakan hubungi layanan bantuan kami.
                        </p>
                        <div style="display: flex; gap: 12px;">
                            @if($permohonan->status == 'selesai')
                            <a href="{{ route('masyarakat.kepuasan') }}?layanan={{ urlencode($permohonan->jenis_layanan) }}" style="padding: 12px 24px; border-radius: 12px; background: #FFC107; color: #003178; border: none; font-weight: 900; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 10px 20px rgba(255, 193, 7, 0.3);">
                                <i data-lucide="star" width="18" height="18" fill="currentColor"></i> Beri Penilaian
                            </a>
                            @endif
                            <button onclick="toggleModal(true)" style="padding: 12px 24px; border-radius: 12px; border: 2px solid var(--primary); color: var(--primary); font-weight: 800; background: white; cursor: pointer;">Panduan</button>
                            <button id="btn-unduh-pdf" onclick="unduhBuktiPDF()" style="padding: 12px 24px; border-radius: 12px; background: var(--primary); color: white; border: none; font-weight: 800; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                <i data-lucide="download" width="18" height="18"></i> Unduh PDF
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div style="margin-top: 40px;">
                    <!-- STATS CARDS -->
                    <div class="stats-grid-container">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: #eff6ff; color: #3b82f6;">
                                <i data-lucide="files" width="28" height="28"></i>
                            </div>
                            <div class="stat-content">
                                <p>Total Pengajuan</p>
                                <h3>{{ $totalPengajuan ?? 0 }} <span>Dokumen</span></h3>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon" style="background: #f0fdf4; color: #16a34a;">
                                <i data-lucide="check-circle-2" width="28" height="28"></i>
                            </div>
                            <div class="stat-content">
                                <p>Sudah Selesai</p>
                                <h3>{{ $totalSelesai ?? 0 }} <span>Dokumen</span></h3>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: #fffbeb; color: #d97706;">
                                <i data-lucide="clock-4" width="28" height="28"></i>
                            </div>
                            <div class="stat-content">
                                <p>Sedang Diproses</p>
                                <h3>{{ $totalBelum ?? 0 }} <span>Dokumen</span></h3>
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon" style="background: #fef2f2; color: #dc2626;">
                                <i data-lucide="x-circle" width="28" height="28"></i>
                            </div>
                            <div class="stat-content">
                                <p>Ditolak / Dihapus</p>
                                <h3>{{ $totalDitolak ?? 0 }} <span>Dokumen</span></h3>
                            </div>
                        </div>
                    </div>

                    <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--primary); margin-bottom: 24px;">Riwayat Pengajuan Anda</h2>
                    <div style="background: white; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,49,120,0.03); border: 1px solid rgba(0,49,120,0.05); overflow: hidden;">
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
                                <thead style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                                    <tr>
                                        <th style="padding: 16px 24px; text-align: left; font-size: 0.85rem; color: #64748b; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">No. Tiket</th>
                                        <th style="padding: 16px 24px; text-align: left; font-size: 0.85rem; color: #64748b; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Layanan</th>
                                        <th style="padding: 16px 24px; text-align: left; font-size: 0.85rem; color: #64748b; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Waktu & Pelaksanaan</th>
                                        <th style="padding: 16px 24px; text-align: left; font-size: 0.85rem; color: #64748b; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Progres Orang</th>
                                        <th style="padding: 16px 24px; text-align: center; font-size: 0.85rem; color: #64748b; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($riwayat as $r)
                                    <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">
                                        <td style="padding: 20px 24px; font-family: monospace; font-weight: 700; color: var(--primary); font-size: 0.95rem;">
                                            <a href="{{ route('masyarakat.cek-status', ['search' => $r->nomor_tiket]) }}#detail-pengajuan" style="color: var(--primary); text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">
                                                #{{ $r->nomor_tiket }}
                                            </a>
                                        </td>
                                        <td style="padding: 20px 24px; font-weight: 800; color: #1e293b;">
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <div style="width: 32px; height: 32px; border-radius: 8px; background: #eff6ff; color: #3b82f6; display: flex; align-items: center; justify-content: center;">
                                                    <i data-lucide="file-check-2" width="16"></i>
                                                </div>
                                                {{ $r->jenis_layanan }}
                                            </div>
                                        </td>
                                        <td style="padding: 20px 24px;">
                                            <div style="display: flex; flex-direction: column; gap: 6px;">
                                                <span style="font-size: 0.8rem; color: #64748b; font-weight: 600; display: flex; justify-content: space-between; width: 170px;">Dibuat: <strong style="color: #0f172a;">{{ $r->tanggal_pengajuan ? $r->tanggal_pengajuan->format('d M Y') : '--' }}</strong></span>
                                                <span style="font-size: 0.8rem; color: #64748b; font-weight: 600; display: flex; justify-content: space-between; width: 170px;">Jemput Bola: <strong style="color: #3b82f6;">{{ $r->tanggal_kedatangan ? \Carbon\Carbon::parse($r->tanggal_kedatangan)->format('d M Y') : 'Menunggu' }}</strong></span>
                                            </div>
                                        </td>
                                        <td style="padding: 20px 24px;">
                                            <div style="display: flex; flex-direction: column; gap: 6px;">
                                                <span style="font-size: 0.8rem; color: #64748b; font-weight: 600; display: flex; justify-content: space-between; max-width: 120px;">Target: <strong style="color: #0f172a;">{{ $r->jumlah_orang ?? 0 }}</strong></span>
                                                <span style="font-size: 0.8rem; color: #64748b; font-weight: 600; display: flex; justify-content: space-between; max-width: 120px;">Selesai: <strong style="color: #16a34a;">{{ max($r->jumlah_realisasi ?? 0, max($r->jumlah_ikd ?? 0, $r->jumlah_kia ?? 0)) }}</strong></span>
                                            </div>
                                        </td>
                                        <td style="padding: 20px 24px; text-align: center;">
                                            <a href="{{ route('masyarakat.cek-status', ['search' => $r->nomor_tiket]) }}#detail-pengajuan" style="background: #eff6ff; color: #3b82f6; padding: 8px 16px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-weight: 800; text-decoration: none; font-size: 0.8rem; transition: all 0.2s;" onmouseover="this.style.background='#3b82f6'; this.style.color='white'" onmouseout="this.style.background='#eff6ff'; this.style.color='#3b82f6'">
                                                <i data-lucide="crosshair" width="16"></i> Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" style="padding: 60px 24px; text-align: center;">
                                            <div style="display: flex; flex-direction: column; align-items: center; gap: 16px; color: #cbd5e1;">
                                                <i data-lucide="inbox" width="48" height="48"></i>
                                                <p style="color: #94a3b8; font-weight: 600; font-size: 1rem;">Belum ada riwayat pengajuan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        @if($riwayat->hasPages())
                        <div class="pagination-premium-v2" style="padding: 16px 24px; background: #f8fafc; margin-top: 0; border-top: 1px solid #f1f5f9; border-bottom-left-radius: 24px; border-bottom-right-radius: 24px;">
                            <div class="pagination-info">
                                Menampilkan {{ $riwayat->firstItem() ?? 0 }}-{{ $riwayat->lastItem() ?? 0 }} dari {{ $riwayat->total() }} dokumen
                            </div>
                            <div class="pagination-controls-v2">
                                @if ($riwayat->onFirstPage())
                                    <button class="page-nav-btn disabled" disabled><i data-lucide="chevron-left" width="18" height="18"></i></button>
                                @else
                                    <a href="{{ $riwayat->previousPageUrl() }}" class="page-nav-btn"><i data-lucide="chevron-left" width="18" height="18"></i></a>
                                @endif

                                @php
                                    $start = max(1, $riwayat->currentPage() - 2);
                                    $end = min($riwayat->lastPage(), $riwayat->currentPage() + 2);
                                @endphp

                                @if($start > 1)
                                    <a href="{{ $riwayat->url(1) }}" class="page-nav-btn">1</a>
                                    @if($start > 2)
                                        <span class="page-nav-btn disabled" style="border:none; background:transparent;">...</span>
                                    @endif
                                @endif

                                @for($i = $start; $i <= $end; $i++)
                                    @if($i == $riwayat->currentPage())
                                        <span class="page-nav-btn active">{{ $i }}</span>
                                    @else
                                        <a href="{{ $riwayat->url($i) }}" class="page-nav-btn">{{ $i }}</a>
                                    @endif
                                @endfor

                                @if($end < $riwayat->lastPage())
                                    @if($end < $riwayat->lastPage() - 1)
                                        <span class="page-nav-btn disabled" style="border:none; background:transparent;">...</span>
                                    @endif
                                    <a href="{{ $riwayat->url($riwayat->lastPage()) }}" class="page-nav-btn">{{ $riwayat->lastPage() }}</a>
                                @endif

                                @if ($riwayat->hasMorePages())
                                    <a href="{{ $riwayat->nextPageUrl() }}" class="page-nav-btn"><i data-lucide="chevron-right" width="18" height="18"></i></a>
                                @else
                                    <button class="page-nav-btn disabled" disabled><i data-lucide="chevron-right" width="18" height="18"></i></button>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            @endif
@endsection
