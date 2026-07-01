@extends('layouts.masyarakat')

@push('styles')
<style>
@media (max-width: 1024px) {
            
        }

        .page-title-section {
            background-color: var(--primary);
            background-image: linear-gradient(rgba(0, 49, 120, 0.9), rgba(0, 49, 120, 0.9)), url('{{ asset('images/batik-tegal-premium.jpg') }}');
            background-size: cover;
            border-radius: 0;
            padding: 48px 96px;
            margin: 0 -48px 40px -48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 20px 40px rgba(0, 49, 120, 0.15);
            border-bottom: 4px solid #f59e0b;
        }

        .page-title-section h1 {
            font-size: 2.25rem;
            font-weight: 900;
            color: white;
            letter-spacing: -1px;
            margin-bottom: 8px;
        }

        .page-title-section p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1rem;
            max-width: 600px;
            line-height: 1.6;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .page-title-section { 
                flex-direction: column; 
                gap: 24px; 
                align-items: flex-start; 
                padding: 32px 24px;
                margin: 0 -20px 40px -20px;
            }
            .action-btns { width: 100%; flex-direction: column; }
            .btn-report-outline, .btn-report-solid { width: 100%; justify-content: center; padding: 14px 16px; font-size: 0.9rem; }
            .page-title-section h1 { font-size: 1.75rem; }
        }

        .action-btns {
            display: flex;
            gap: 12px;
        }

        .btn-report-outline {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 24px;
            border: 2px dashed rgba(255, 255, 255, 0.4);
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.2s;
            cursor: pointer;
        }

        .btn-report-outline:hover {
            border-color: white;
            background: rgba(255, 255, 255, 0.2);
        }

        .btn-report-solid {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 24px;
            background: #f59e0b;
            color: #0f172a;
            border-radius: 14px;
            font-weight: 800;
            font-size: 0.95rem;
            transition: all 0.2s;
            box-shadow: 0 10px 20px rgba(245, 158, 11, 0.3);
            text-decoration: none !important;
            cursor: pointer;
        }

        .btn-report-solid:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(245, 158, 11, 0.4);
            background: #fbbf24;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
            margin-bottom: 40px;
        }

        .stat-card-premium {
            background: white;
            padding: 32px;
            border-radius: 32px;
            display: flex;
            align-items: center;
            gap: 24px;
            border: 1px solid rgba(0, 49, 120, 0.03);
            box-shadow: 0 10px 30px rgba(0, 49, 120, 0.03);
            transition: all 0.3s ease;
        }

        .stat-card-premium:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 49, 120, 0.08);
        }

        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
            .stat-card-premium { 
                padding: 16px; 
                border-radius: 20px; 
                flex-direction: column; 
                align-items: flex-start; 
                gap: 12px; 
            }
            .stat-icon-box { width: 44px; height: 44px; border-radius: 12px; }
            .stat-icon-box i { width: 22px; height: 22px; }
            .stat-info h4 { font-size: 0.6rem; letter-spacing: 0.5px; }
            .stat-info strong { font-size: 1.25rem; }
        }

        .stat-icon-box {
            width: 64px;
            height: 64px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-blue { background: #eff6ff; color: #3b82f6; }
        .icon-green { background: #f0fdf4; color: #22c55e; }
        .icon-amber { background: #fffbeb; color: #f59e0b; }
        .icon-red { background: #fef2f2; color: #ef4444; }

        .stat-info h4 {
            font-size: 0.7rem;
            font-weight: 900;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }

        .stat-info strong {
            font-size: 1.75rem;
            font-weight: 900;
            color: #0f172a;
        }

        /* Filter Panel */
        .filter-container-premium {
            background: white;
            padding: 32px;
            border-radius: 32px;
            box-shadow: 0 10px 30px rgba(0, 49, 120, 0.02);
            border: 1px solid rgba(0, 49, 120, 0.02);
            margin-bottom: 32px;
        }

        .filter-grid-v2 {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 20px;
            align-items: flex-end;
        }

        .filter-item-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 800;
            color: #475569;
            margin-bottom: 10px;
        }

        .filter-input-premium {
            width: 100%;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 14px 20px;
            border-radius: 16px;
            font-size: 0.95rem;
            font-weight: 600;
            color: #1e293b;
            transition: all 0.2s;
            outline: none;
        }

        .filter-input-premium:focus {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 49, 120, 0.05);
        }

        .btn-apply-filter {
            background: #0f172a;
            color: white;
            padding: 16px 32px;
            border-radius: 16px;
            font-weight: 800;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .btn-apply-filter:hover {
            background: #1e293b;
            transform: scale(1.02);
        }

        /* Table Premium V2 */
        .table-box-premium {
            background: white;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 49, 120, 0.02);
            border: 1px solid rgba(0, 49, 120, 0.02);
        }

        .premium-table-v2 {
            width: 100%;
            border-collapse: collapse;
        }

        .premium-table-v2 th {
            text-align: left;
            padding: 24px;
            font-size: 0.85rem;
            font-weight: 800;
            color: white;
            background: var(--primary);
            border-bottom: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .premium-table-v2 td {
            padding: 20px 24px;
            font-size: 0.95rem;
            color: #334155;
            border-bottom: 1px solid #f8fafc;
        }

        .premium-table-v2 tbody tr {
            transition: all 0.2s ease;
        }

        .premium-table-v2 tbody tr:hover {
            background: rgba(0, 49, 120, 0.02);
        }

        .service-type-cell {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .service-icon-circle {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #f1f5f9;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .service-name-text {
            font-weight: 800;
            color: #0f172a;
        }

        .id-permohonan-text {
            font-weight: 700;
            color: #64748b;
            font-family: monospace;
            font-size: 0.9rem;
        }

        .status-badge-v3 {
            padding: 6px 16px;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 800;
            display: inline-block;
            text-align: center;
            min-width: 90px;
        }

        .status-badge-selesai { background: #f0fdf4; color: #16a34a; }
        .status-badge-proses { background: #faf5ff; color: #7c3aed; }
        .status-badge-ditolak { background: #fef2f2; color: #dc2626; }
        .status-badge-menunggu { background: #fef3c7; color: #b45309; }
        .status-badge-verifikasi { background: #eff6ff; color: #1d4ed8; }
        .status-badge-terjadwal { background: #f0fdf4; color: #15803d; }

        .table-actions-v2 {
            display: flex;
            gap: 16px;
            color: #94a3b8;
        }

        .table-actions-v2 a {
            transition: all 0.2s;
        }

        .table-actions-v2 a:hover {
            color: var(--primary);
            transform: scale(1.1);
        }

        /* Pagination */
        .pagination-premium-v2 {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 32px;
            border-top: 1px solid #f1f5f9;
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
            transition: all 0.2s;
            text-decoration: none !important;
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

        /* Support CTA Section */
        .support-cta-box {
            margin-top: 48px;
            background: #0f172a;
            border-radius: 32px;
            padding: 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .support-cta-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 100% 0%, rgba(59, 130, 246, 0.1), transparent 50%);
            pointer-events: none;
        }

        .support-text h2 {
            font-size: 1.5rem;
            font-weight: 900;
            margin-bottom: 12px;
            letter-spacing: -0.5px;
        }

        .support-text p {
            color: #94a3b8;
            font-size: 1rem;
            max-width: 480px;
            line-height: 1.6;
            font-weight: 500;
        }

        .support-actions {
            display: flex;
            gap: 16px;
        }

        .btn-support-main {
            background: #38bdf8;
            color: #0f172a;
            padding: 16px 32px;
            border-radius: 20px;
            font-weight: 900;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
        }

        .btn-support-main:hover {
            background: #7dd3fc;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(56, 189, 248, 0.3);
        }

        .btn-support-alt {
            background: rgba(255, 255, 255, 0.05);
            color: white;
            padding: 16px 32px;
            border-radius: 20px;
            font-weight: 800;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-support-alt:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }

        @media (max-width: 768px) {
            .filter-container-premium { padding: 24px; border-radius: 24px; }
            .filter-grid-v2 { grid-template-columns: 1fr; gap: 16px; }
            .btn-apply-filter { width: 100%; }
            
            /* Table Mobile Reset */
            .premium-table-v2, .premium-table-v2 thead, .premium-table-v2 tbody, .premium-table-v2 th, .premium-table-v2 td, .premium-table-v2 tr {
                display: block;
            }
            .premium-table-v2 thead { display: none; }
            .premium-table-v2 tr {
                padding: 24px;
                border-bottom: 1px solid #f1f5f9;
                position: relative;
            }
            .premium-table-v2 td {
                padding: 10px 0;
                border: none;
                display: flex;
                justify-content: space-between;
                align-items: center;
                text-align: right;
                font-size: 0.85rem;
            }
            .premium-table-v2 td::before {
                content: attr(data-label);
                font-weight: 800;
                color: #64748b;
                text-align: left;
                text-transform: uppercase;
                font-size: 0.7rem;
                letter-spacing: 0.5px;
            }
            .service-type-cell { flex-direction: row-reverse; gap: 12px; }
            .table-actions-v2 { justify-content: flex-end; }
            .support-cta-box { flex-direction: column; padding: 32px 24px; text-align: center; border-radius: 24px; }
            .support-text { margin-bottom: 32px; }
            .support-text p { margin: 0 auto; }
            .support-actions { flex-direction: column; width: 100%; }
            .btn-support-main, .btn-support-alt { width: 100%; justify-content: center; }
            .pagination-premium-v2 { flex-direction: column; gap: 20px; padding: 24px; }
        }

        @media print {
            .sidebar-masyarakat,
            .global-content-header,
            .sidebar-overlay-fixed,
            .action-btns, 
            .filter-container-premium, 
            .pagination-premium-v2, 
            .support-cta-box,
            .table-actions-v2,
            .stats-grid {
                display: none !important;
            }
            
            .table-box-premium {
                box-shadow: none !important;
                border: none !important;
                width: 100% !important;
                overflow: visible !important;
            }
            
            /* FORCE HORIZONTAL TABLE VIEW FOR PRINT PREVIEW */
            .premium-table-v2 {
                display: table !important;
                width: 100% !important;
                border-collapse: collapse !important;
            }
            .premium-table-v2 thead {
                display: table-header-group !important;
            }
            .premium-table-v2 t
            .premium-table-v2 tr {
                display: table-row !important;
                page-break-inside: avoid !important;
            }
            .premium-table-v2 th, .premium-table-v2 td {
                display: table-cell !important;
                text-align: left !important;
                padding: 14px 18px !important;
                border-bottom: 1px solid #e2e8f0 !important;
                font-size: 0.85rem !important;
            }
            .premium-table-v2 th {
                background-color: #003178 !important;
                color: white !important;
                font-weight: 800 !important;
                text-transform: uppercase !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .premium-table-v2 td::before {
                display: none !important; /* Hide vertical mobile labels */
            }
            .service-type-cell {
                display: flex !important;
                align-items: center !important;
                gap: 8px !important;
            }
            .status-badge-v3 {
                padding: 4px 10px !important;
                font-size: 0.7rem !important;
                border: 1px solid #cbd5e1 !important;
                background: transparent !important;
                color: #0f172a !important;
                border-radius: 9999px !important;
            }
            
            
        }

        /* Custom Toast Notification styling */
        .toast-container {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 12px;
            pointer-events: none;
        }

        .premium-toast {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            padding: 16px 24px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 0.9rem;
            font-weight: 700;
            pointer-events: auto;
            transform: translateY(-20px);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            max-width: 380px;
        }

        .premium-toast.show {
            transform: translateY(0);
            opacity: 1;
        }
</style>
@endpush

@section('content')
<div class="page-title-section">
                <div>
                    <h1>Riwayat Pengajuan</h1>
                    <p style="color: #64748b; margin-top: 8px; line-height: 1.6; max-width: 900px;">Menu Riwayat Pengajuan digunakan oleh masyarakat untuk melihat arsip seluruh pengajuan layanan yang pernah dilakukan. Informasi yang ditampilkan meliputi nomor pengajuan, jenis layanan, tanggal pengajuan, identitas pemohon, detail dokumen pengajuan, catatan petugas, serta bukti pengajuan yang dapat dilihat atau diunduh kembali. Menu ini juga menyediakan fitur pencarian dan filter untuk mempermudah pengguna menemukan data pengajuan tertentu.</p>
                </div>
                <div class="action-btns">
                    <button onclick="window.print()" class="btn-report-outline">
                        <i data-lucide="printer" width="20"></i>
                        Cetak Riwayat
                    </button>
                    <a href="{{ route('riwayat.export', request()->query()) }}" id="btnExportCSV" class="btn-report-solid">
                        <i data-lucide="download" width="20"></i>
                        Ekspor Riwayat
                    </a>
                </div>
            </div>

            <!-- Stats -->
            <div class="stats-grid">
                <div class="stat-card-premium">
                    <div class="stat-icon-box icon-blue">
                        <i data-lucide="file-text" width="28"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Total Pengajuan</h4>
                        <strong>{{ $totalPermohonan }}</strong>
                    </div>
                </div>
                <div class="stat-card-premium">
                    <div class="stat-icon-box icon-green">
                        <i data-lucide="check-circle" width="28"></i>
                    </div>
                    <div class="stat-info">
                        <h4>Sudah Dijemput Bola</h4>
                        <strong>{{ $totalJemputBola }}</strong>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="filter-container-premium">
                <form action="{{ route('riwayat') }}" method="GET" class="filter-grid-v2">
                    <div class="filter-item-group">
                        <label>Nomor Pengajuan</label>
                        <input type="text" name="nomor_pengajuan" value="{{ request('nomor_pengajuan') }}" class="filter-input-premium" placeholder="Cari no tiket...">
                    </div>
                    <div class="filter-item-group">
                        <label>Jenis Layanan</label>
                        <select name="layanan" class="filter-input-premium">
                            <option value="">Semua Layanan</option>
                            <option value="KTP" {{ request('layanan') == 'KTP' ? 'selected' : '' }}>KTP-el Baru</option>
                            <option value="IKD" {{ request('layanan') == 'IKD' ? 'selected' : '' }}>Aktivasi IKD</option>
                            <option value="KIA" {{ request('layanan') == 'KIA' ? 'selected' : '' }}>KIA Anak</option>
                        </select>
                    </div>

                    <div class="filter-item-group">
                        <label>Rentang Tanggal</label>
                        <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="filter-input-premium" placeholder="dd/mm/yyyy">
                    </div>
                    <button type="submit" class="btn-apply-filter">Cari</button>
                </form>
            </div>

            <!-- Table -->
            <div class="table-box-premium">
                <table class="premium-table-v2">
                    <thead>
                        <tr>
                            <th style="width: 60px; text-align: center;">No.</th>
                            <th>Nomor Pengajuan</th>
                            <th>Jenis Layanan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Identitas Pemohon</th>
                            <th>Detail Dokumen</th>
                            <th>Catatan Petugas</th>
                            <th>Bukti Pengajuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permohonan as $p)
                        <tr>
                            <td data-label="No." class="jbl-959 jbl-147" style="text-align: center;">
                                {{ $loop->iteration + ($permohonan->currentPage() - 1) * $permohonan->perPage() }}
                            </td>
                            <td data-label="Nomor Pengajuan"><span class="id-permohonan-text">{{ $p->nomor_tiket }}</span></td>
                            <td data-label="Jenis Layanan">
                                <div class="service-type-cell">
                                    <div class="service-icon-circle">
                                        <i data-lucide="file-check-2" width="16"></i>
                                    </div>
                                    <span class="service-name-text">{{ $p->jenis_layanan }}</span>
                                </div>
                            </td>
                            <td data-label="Tanggal Pengajuan" class="jbl-959 jbl-147">{{ $p->tanggal_pengajuan ? $p->tanggal_pengajuan->format('d M Y') : '--' }}</td>
                             @php
                                 $pStatus = $p->status ?? 'menunggu_verifikasi';
                                 $pBadgeClass = match($pStatus) {
                                     'menunggu_verifikasi', 'pending' => 'status-badge-menunggu',
                                     'terverifikasi', 'verified' => 'status-badge-verifikasi',
                                     'terjadwal' => 'status-badge-terjadwal',
                                     'diproses', 'processing' => 'status-badge-proses',
                                     'selesai' => 'status-badge-selesai',
                                     'ditolak' => 'status-badge-ditolak',
                                     default => 'status-badge-menunggu'
                                 };
                                 $pStatusLabel = match($pStatus) {
                                     'menunggu_verifikasi', 'pending' => 'Menunggu Verifikasi',
                                     'terverifikasi', 'verified' => 'Terverifikasi',
                                     'terjadwal' => 'Terjadwal',
                                     'diproses', 'processing' => 'Diproses',
                                     'selesai' => 'Selesai',
                                     'ditolak' => 'Ditolak',
                                     default => ucfirst($pStatus)
                                 };
                             @endphp
                             <td data-label="Status">
                                 <span class="status-badge-v3 {{ $pBadgeClass }}">{{ $pStatusLabel }}</span>
                             </td>
                            <td data-label="Identitas Pemohon" class="jbl-959 jbl-386">
                                {{ $p->masyarakat->nama ?? 'Pemohon' }}<br>
                                <small style="color: #94a3b8; font-weight: normal;">{{ $p->lokasi_pelayanan ?? '-' }}</small>
                            </td>
                            <td data-label="Detail Dokumen" style="font-size: 0.75rem;">
                                @if($p->file_ktp) <span style="background: #eff6ff; color: #3b82f6; padding: 2px 6px; border-radius: 4px; display: inline-block; margin: 1px;">KTP</span> @endif
                                @if($p->file_kk) <span style="background: #f0fdf4; color: #22c55e; padding: 2px 6px; border-radius: 4px; display: inline-block; margin: 1px;">KK</span> @endif
                                @if($p->file_foto) <span style="background: #fffbeb; color: #f59e0b; padding: 2px 6px; border-radius: 4px; display: inline-block; margin: 1px;">FOTO</span> @endif
                                @if(!$p->file_ktp && !$p->file_kk && !$p->file_foto) - @endif
                            </td>
                            <td data-label="Catatan Petugas" style="font-size: 0.75rem; color: #64748b;">
                                {{ $p->keterangan ?? 'Sedang diproses / belum ada catatan' }}
                            </td>
                            <td data-label="Bukti Pengajuan">
                                @if($p->dokumen_path)
                                    @php
                                        $file = is_array($p->dokumen_path) ? ($p->dokumen_path[0] ?? null) : $p->dokumen_path;
                                    @endphp
                                    @if($file)
                                        <a href="{{ Storage::url($file) }}" target="_blank" style="color: #3b82f6; text-decoration: none; font-size: 0.75rem; font-weight: bold; display: flex; align-items: center; gap: 4px; padding: 4px 8px; background: #eff6ff; border-radius: 6px; width: max-content;">
                                            <i data-lucide="paperclip" width="14"></i> Lihat File
                                        </a>
                                    @else
                                        <span style="font-size: 0.7rem; color: #94a3b8;">-</span>
                                    @endif
                                @else
                                    <span style="font-size: 0.7rem; color: #94a3b8;">-</span>
                                @endif
                            </td>
                            <td data-label="Aksi">
                                <div class="table-actions-v2">
                                    <a href="{{ route('masyarakat.cek-status', ['search' => $p->nomor_tiket]) }}" class="btn-action-primary" title="Lacak & Detail" style="background: #eff6ff; color: #3b82f6; padding: 6px 12px; border-radius: 6px; display: inline-flex; align-items: center; gap: 6px; font-weight: 700; text-decoration: none; font-size: 0.75rem;">
                                        <i data-lucide="crosshair" width="14"></i> Lacak Status
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="jbl-1401 jbl-45">
                                <div class="jbl-1293 jbl-1541 jbl-1426 jbl-701 jbl-189">
                                    <i data-lucide="inbox" width="64" height="64"></i>
                                    <p class="jbl-586 jbl-13">Belum ada data riwayat pengajuan tersedia.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                @if($permohonan->total() > 0)
                <div class="pagination-premium-v2">
                    <div class="pagination-info">
                        Menampilkan {{ $permohonan->firstItem() ?? 0 }}-{{ $permohonan->lastItem() ?? 0 }} dari {{ $permohonan->total() }} riwayat pengajuan
                    </div>
                    <div class="pagination-controls-v2">
                        {{-- Previous Page Link --}}
                        @if ($permohonan->onFirstPage())
                            <button class="page-nav-btn" disabled><i data-lucide="chevron-left" width="18"></i></button>
                        @else
                            <a href="{{ $permohonan->previousPageUrl() }}" class="page-nav-btn"><i data-lucide="chevron-left" width="18"></i></a>
                        @endif

                        {{-- Page Elements --}}
                        @php
                            $currentPage = $permohonan->currentPage();
                            $lastPage = $permohonan->lastPage();
                            $start = max(1, $currentPage - 1);
                            $end = min($lastPage, $currentPage + 1);

                            if ($currentPage <= 2) {
                                $end = min($lastPage, 3);
                            }
                            if ($currentPage >= $lastPage - 1) {
                                $start = max(1, $lastPage - 2);
                            }
                        @endphp

                        @if ($start > 1)
                            <a href="{{ $permohonan->url(1) }}" class="page-nav-btn">1</a>
                            @if ($start > 2)
                                <button class="page-nav-btn" disabled>...</button>
                            @endif
                        @endif

                        @for ($page = $start; $page <= $end; $page++)
                            @if ($page == $currentPage)
                                <button class="page-nav-btn active">{{ $page }}</button>
                            @else
                                <a href="{{ $permohonan->url($page) }}" class="page-nav-btn">{{ $page }}</a>
                            @endif
                        @endfor

                        @if ($end < $lastPage)
                            @if ($end < $lastPage - 1)
                                <button class="page-nav-btn" disabled>...</button>
                            @endif
                            <a href="{{ $permohonan->url($lastPage) }}" class="page-nav-btn">{{ $lastPage }}</a>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($permohonan->hasMorePages())
                            <a href="{{ $permohonan->nextPageUrl() }}" class="page-nav-btn"><i data-lucide="chevron-right" width="18"></i></a>
                        @else
                            <button class="page-nav-btn" disabled><i data-lucide="chevron-right" width="18"></i></button>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- Support CTA Section -->
            <div class="support-cta-box">
                <div class="support-text">
                    <h2>Butuh bantuan lebih lanjut?</h2>
                    <p>Jika Anda menemui kendala dalam pelaporan atau memiliki pertanyaan mengenai status layanan Anda, tim dukungan kami siap membantu 24/7.</p>
                </div>
                <div class="support-actions">
                    <a href="#" class="btn-support-main">
                        <i data-lucide="headphones" width="24"></i>
                        <span>Hubungi Admin</span>
                    </a>
                    <a href="{{ route('masyarakat.help') }}" class="btn-support-alt">
                        Pusat Bantuan
                    </a>
                </div>
            </div>
@endsection
