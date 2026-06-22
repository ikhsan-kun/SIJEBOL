<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Adminduk - SI JEBOL Kota Tegal</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @include('partials.head-dependencies')
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --primary: #003178;
            --primary-dark: #001e50;
            --accent: #F59E0B;
            --background: #f8fafc;
        }

        body {
            background-color: var(--background);
            font-family: 'Inter', sans-serif;
        }

        .jbl-186 {
            width: 100% !important;
            margin-left: auto !important;
            margin-right: auto !important;
            padding-left: 24px !important;
            padding-right: 24px !important;
            box-sizing: border-box !important;
        }
        /* Hero Section Premium Batik */
        .layanan-hero {
            background-color: var(--primary);
            background-image: linear-gradient(rgba(0, 49, 120, 0.9), rgba(0, 49, 120, 0.8)), url('{{ asset('images/batik-tegal-premium.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 160px 0 120px;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 5px solid #F59E0B;
        }

        .layanan-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('img/batik-pattern.png') }}');
            background-size: 600px;
            opacity: 0.1;
            mix-blend-mode: overlay;
            pointer-events: none;
        }

        .hero-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 24px;
            position: relative;
            z-index: 10;
        }

        .hero-container h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 4.5rem;
            font-weight: 900;
            letter-spacing: -2px;
            margin-bottom: 24px;
            color: white;
            text-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .hero-container h1 span {
            color: var(--accent);
        }

        .hero-container p {
            font-size: 1.25rem;
            line-height: 1.6;
            font-weight: 500;
            opacity: 0.95;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }

        /* Services Grid */
        .services-section {
            padding: 80px 0 120px;
            background-image: url('{{ asset('img/batik-pattern.png') }}');
            background-size: 600px;
            background-attachment: fixed;
            position: relative;
        }

        .services-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(248, 250, 252, 0.95);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            position: relative;
            z-index: 5;        
        }
        
        .service-card {
            background: white;
            border-radius: 28px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 49, 120, 0.06);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            border: 1px solid rgba(0, 49, 120, 0.03);
            display: flex;
            flex-direction: column;
            text-align: left; 
            height: 100%;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(0, 49, 120, 0.12);
            border-color: var(--accent);
        }

        .icon-wrapper {
            width: 56px;
            height: 56px;
            background: #f1f5f9;
            color: var(--primary);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            transition: all 0.3s ease;
        }

        .service-card:hover .icon-wrapper {
            background: var(--primary);
            color: white;
        }

        .service-card h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: 12px;
        }

        .service-card p {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 24px;
            flex-grow: 1;
        }

        .service-card p strong {
            color: var(--primary);
            font-weight: 700;
        }

        .btn-link-action {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            text-decoration: none;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .card-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: auto;
        }

        .primary-action {
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary);
            color: white;
            padding: 14px 24px;
            border-radius: 14px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
            width: 100%;
        }

        .primary-action:hover {
            background: var(--accent);
            color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(245, 158, 11, 0.2);
        }

        .secondary-action {
            color: #94a3b8;
            font-size: 0.85rem;
            font-weight: 600;
            justify-content: center; /* Center since it's under a full-width button */
            width: 100%;
        }

        .secondary-action:hover {
            color: var(--primary);
        }

        /* Sidebar Refinement */
        .sidebar-card {
            background: white;
            border-radius: 28px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(0, 49, 120, 0.04);
            border: 1px solid rgba(0, 49, 120, 0.03);
        }

        .sidebar-card h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.3rem;
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .req-item {
            margin-bottom: 16px;
            display: flex;
            gap: 12px;
        }

        .req-num {
            width: 28px;
            height: 28px;
            font-size: 0.75rem;
            flex-shrink: 0;
            background: #eff6ff;
            color: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
        }

        .req-text {
            color: #475569;
            font-size: 0.95rem;
            line-height: 1.5;
            font-weight: 500;
        }

        /* Help Card */
        .btn-support {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 14px 28px;
            background: var(--primary);
            color: white;
            border-radius: 100px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-support:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 49, 120, 0.15);
        }

        /* Layout for Sidebar */
        .layanan-content-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 40px;
            margin-top: -60px;
            position: relative;
            z-index: 20;
            align-items: start;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 32px;
        }

        .sidebar-stack {
            display: flex;
            flex-direction: column;
            gap: 32px;
        }

        @media (max-width: 1100px) {
            .layanan-content-grid { grid-template-columns: 1fr; margin-top: 0; padding-top: 40px; }
            .sidebar-stack { order: 2; }
            .services-grid { order: 1; }
        }

        @media (max-width: 768px) {
            .hero-container h1 { font-size: 3rem; }
        }
    </style>
</head>
<body>

    @include('partials.navbar')

    <section class="layanan-hero">
        <div class="hero-container">
            <div style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; background: rgba(255,255,255,0.1); border-radius: 100px; margin-bottom: 24px; font-size: 0.8rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">
                <span style="width: 8px; height: 8px; background: #10b981; border-radius: 50%;"></span> Layanan Digital Warga
            </div>
            <h1>Layanan <span style="color: #F59E0B;">SI JEBOL</span></h1>
            <p>Pilih layanan administrasi kependudukan yang Anda butuhkan dengan mudah, cepat, dan aman.</p>
        </div>
    </section>

    <div class="services-section" x-data="{ openModal: null }">
        <div class="jbl-186">
            <div class="layanan-content-grid">
                <!-- Left Column: Services -->
                <div class="services-grid">
                    <!-- Service 1: KTP-el -->
                    <div class="service-card">
                        <div class="icon-wrapper">
                            <span class="material-symbols-outlined" style="font-size: 32px;">badge</span>
                        </div>
                        <h3>KTP-el Baru / Ganti</h3>
                        <p>Pengajuan cetak KTP elektronik baru karena hilang, rusak, atau perubahan data. Estimasi: <strong>3 Hari Kerja</strong>.</p>
                        <div class="card-actions">
                            <a href="{{ route('register') }}" class="btn-link-action primary-action">
                                Mulai Pengajuan <i data-lucide="arrow-right" width="18" height="18"></i>
                            </a>
                            <button @click.prevent="openModal = 'ktp'" class="btn-link-action secondary-action" style="background:none; border:none; cursor:pointer; padding:0; display:flex;">
                                <i data-lucide="info" width="16" height="16"></i> Lihat detail dan syarat
                            </button>
                        </div>
                    </div>

                    <!-- Service 2: KIA -->
                    <div class="service-card">
                        <div class="icon-wrapper">
                            <span class="material-symbols-outlined" style="font-size: 32px;">assignment_ind</span>
                        </div>
                        <h3>Kartu Identitas Anak</h3>
                        <p>Penerbitan kartu identitas resmi untuk anak usia 0-17 tahun kurang satu hari. Estimasi: <strong>2 Hari Kerja</strong>.</p>
                        <div class="card-actions">
                            <a href="{{ route('register') }}" class="btn-link-action primary-action">
                                Mulai Pengajuan <i data-lucide="arrow-right" width="18" height="18"></i>
                            </a>
                            <button @click.prevent="openModal = 'kia'" class="btn-link-action secondary-action" style="background:none; border:none; cursor:pointer; padding:0; display:flex;">
                                <i data-lucide="info" width="16" height="16"></i> Lihat detail dan syarat
                            </button>
                        </div>
                    </div>

                    <!-- Service 3: IKD -->
                    <div class="service-card">
                        <div class="icon-wrapper">
                            <span class="material-symbols-outlined" style="font-size: 32px;">contact_page</span>
                        </div>
                        <h3>Aktivasi IKD</h3>
                        <p>Aktivasi Identitas Kependudukan Digital untuk kemudahan akses data kependudukan. Estimasi: <strong>1 Hari</strong>.</p>
                        <div class="card-actions">
                            <a href="{{ route('register') }}" class="btn-link-action primary-action">
                                Mulai Pengajuan <i data-lucide="arrow-right" width="18" height="18"></i>
                            </a>
                            <button @click.prevent="openModal = 'ikd'" class="btn-link-action secondary-action" style="background:none; border:none; cursor:pointer; padding:0; display:flex;">
                                <i data-lucide="info" width="16" height="16"></i> Lihat detail dan syarat
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Sidebar -->
                <div class="sidebar-stack">
                    <div class="sidebar-card">
                        <h3><i data-lucide="file-check" width="22" height="22"></i> Persyaratan Umum</h3>
                        <div class="req-list">
                            <div class="req-item">
                                <span class="req-num">01</span>
                                <span class="req-text">Akun SI JEBOL terverifikasi NIK.</span>
                            </div>
                            <div class="req-item">
                                <span class="req-num">02</span>
                                <span class="req-text">Scan dokumen asli & berwarna.</span>
                            </div>
                            <div class="req-item">
                                <span class="req-num">03</span>
                                <span class="req-text">Format JPG/PDF (Max 2MB).</span>
                            </div>
                            <div class="req-item">
                                <span class="req-num">04</span>
                                <span class="req-text">Nomor WhatsApp harus aktif.</span>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-card">
                        <h3 style="margin-bottom: 12px;">Bantuan Teknis?</h3>
                        <p style="margin-bottom: 20px; font-size: 0.9rem;">Hubungi tim dukungan kami untuk kendala pengajuan Anda.</p>
                        <a href="https://wa.me/628123456789" class="btn-support" style="width: 100%; justify-content: center;">
                            <i data-lucide="message-circle" width="18" height="18"></i> WhatsApp Support
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modals -->
        <!-- Modal KTP -->
        <div x-show="openModal === 'ktp'" class="jbl-524 jbl-1062 jbl-543 jbl-1293 jbl-1426 jbl-141 jbl-156 jbl-1085 jbl-637" x-transition x-cloak>
            <div @click.away="openModal = null" class="jbl-434 jbl-1382 jbl-1241 jbl-768 jbl-1539 jbl-641 jbl-1109" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <button @click="openModal = null" class="jbl-91 jbl-510 jbl-378 jbl-13 jbl-314 jbl-632">
                    <span class="material-symbols-outlined">close</span>
                </button>
                <div class="jbl-1293 jbl-1426 jbl-701 jbl-454">
                    <div class="jbl-27 jbl-1040 jbl-176 jbl-1066 jbl-1320 jbl-1293 jbl-1426 jbl-141">
                        <span class="material-symbols-outlined jbl-742">badge</span>
                    </div>
                    <div>
                        <h3 class="jbl-390 jbl-959 jbl-386">Syarat KTP-el</h3>
                        <p class="jbl-166 jbl-147">Perekaman Baru / Ganti / Hilang</p>
                    </div>
                </div>
                <ul class="jbl-1052 jbl-59 jbl-1574 jbl-166">
                    <li class="jbl-1293 jbl-1046 jbl-985"><span class="material-symbols-outlined jbl-1183 jbl-105 jbl-709">check_circle</span> <span>Fotokopi Kartu Keluarga (KK).</span></li>
                    <li class="jbl-1293 jbl-1046 jbl-985"><span class="material-symbols-outlined jbl-1183 jbl-105 jbl-709">check_circle</span> <span>Telah berusia 17 tahun atau sudah/pernah kawin.</span></li>
                    <li class="jbl-1293 jbl-1046 jbl-985"><span class="material-symbols-outlined jbl-1183 jbl-105 jbl-709">check_circle</span> <span>Untuk <b>KTP Hilang</b>: Wajib melampirkan Surat Keterangan Kehilangan dari Kepolisian.</span></li>
                    <li class="jbl-1293 jbl-1046 jbl-985"><span class="material-symbols-outlined jbl-1183 jbl-105 jbl-709">check_circle</span> <span>Untuk <b>KTP Rusak/Ganti Data</b>: Wajib melampirkan KTP-el fisik yang lama/rusak.</span></li>
                </ul>
                <button @click="openModal = null" class="jbl-1539 jbl-1569 jbl-995 jbl-212 jbl-431 jbl-959 jbl-1320 jbl-1288">Mengerti, Tutup</button>
            </div>
        </div>

        <!-- Modal KIA -->
        <div x-show="openModal === 'kia'" class="jbl-524 jbl-1062 jbl-543 jbl-1293 jbl-1426 jbl-141 jbl-156 jbl-1085 jbl-637" x-transition x-cloak>
            <div @click.away="openModal = null" class="jbl-434 jbl-1382 jbl-1241 jbl-768 jbl-1539 jbl-641 jbl-1109" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <button @click="openModal = null" class="jbl-91 jbl-510 jbl-378 jbl-13 jbl-314 jbl-632">
                    <span class="material-symbols-outlined">close</span>
                </button>
                <div class="jbl-1293 jbl-1426 jbl-701 jbl-454">
                    <div class="jbl-27 jbl-1040 jbl-176 jbl-1066 jbl-1320 jbl-1293 jbl-1426 jbl-141">
                        <span class="material-symbols-outlined jbl-742">assignment_ind</span>
                    </div>
                    <div>
                        <h3 class="jbl-390 jbl-959 jbl-386">Syarat KIA</h3>
                        <p class="jbl-166 jbl-147">Kartu Identitas Anak (Usia 0-17 th)</p>
                    </div>
                </div>
                <ul class="jbl-1052 jbl-59 jbl-1574 jbl-166">
                    <li class="jbl-1293 jbl-1046 jbl-985"><span class="material-symbols-outlined jbl-1183 jbl-105 jbl-709">check_circle</span> <span>Fotokopi Kutipan Akta Kelahiran Anak.</span></li>
                    <li class="jbl-1293 jbl-1046 jbl-985"><span class="material-symbols-outlined jbl-1183 jbl-105 jbl-709">check_circle</span> <span>Fotokopi Kartu Keluarga (KK) orang tua.</span></li>
                    <li class="jbl-1293 jbl-1046 jbl-985"><span class="material-symbols-outlined jbl-1183 jbl-105 jbl-709">check_circle</span> <span>Fotokopi KTP-el kedua orang tua/wali.</span></li>
                    <li class="jbl-1293 jbl-1046 jbl-985"><span class="material-symbols-outlined jbl-1183 jbl-105 jbl-709">check_circle</span> <span>Pas foto berwarna Anak (ukuran 2x3 atau 3x4) sebanyak 2 lembar (Khusus anak usia 5-17 tahun kurang satu hari). Anak di bawah 5 tahun tidak perlu melampirkan foto.</span></li>
                </ul>
                <button @click="openModal = null" class="jbl-1539 jbl-1569 jbl-995 jbl-212 jbl-431 jbl-959 jbl-1320 jbl-1288">Mengerti, Tutup</button>
            </div>
        </div>

        <!-- Modal IKD -->
        <div x-show="openModal === 'ikd'" class="jbl-524 jbl-1062 jbl-543 jbl-1293 jbl-1426 jbl-141 jbl-156 jbl-1085 jbl-637" x-transition x-cloak>
            <div @click.away="openModal = null" class="jbl-434 jbl-1382 jbl-1241 jbl-768 jbl-1539 jbl-641 jbl-1109" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <button @click="openModal = null" class="jbl-91 jbl-510 jbl-378 jbl-13 jbl-314 jbl-632">
                    <span class="material-symbols-outlined">close</span>
                </button>
                <div class="jbl-1293 jbl-1426 jbl-701 jbl-454">
                    <div class="jbl-27 jbl-1040 jbl-176 jbl-1066 jbl-1320 jbl-1293 jbl-1426 jbl-141">
                        <span class="material-symbols-outlined jbl-742">contact_page</span>
                    </div>
                    <div>
                        <h3 class="jbl-390 jbl-959 jbl-386">Syarat Aktivasi IKD</h3>
                        <p class="jbl-166 jbl-147">Identitas Kependudukan Digital</p>
                    </div>
                </div>
                <ul class="jbl-1052 jbl-59 jbl-1574 jbl-166">
                    <li class="jbl-1293 jbl-1046 jbl-985"><span class="material-symbols-outlined jbl-1183 jbl-105 jbl-709">check_circle</span> <span>Memiliki KTP-el fisik atau setidaknya sudah melakukan perekaman KTP-el.</span></li>
                    <li class="jbl-1293 jbl-1046 jbl-985"><span class="material-symbols-outlined jbl-1183 jbl-105 jbl-709">check_circle</span> <span>Memiliki smartphone (Android/iOS) yang terhubung dengan akses internet.</span></li>
                    <li class="jbl-1293 jbl-1046 jbl-985"><span class="material-symbols-outlined jbl-1183 jbl-105 jbl-709">check_circle</span> <span>Memiliki Nomor WhatsApp (HP) yang aktif.</span></li>
                    <li class="jbl-1293 jbl-1046 jbl-985"><span class="material-symbols-outlined jbl-1183 jbl-105 jbl-709">check_circle</span> <span>Memiliki Alamat Email pribadi yang aktif (bisa diakses).</span></li>
                </ul>
                <button @click="openModal = null" class="jbl-1539 jbl-1569 jbl-995 jbl-212 jbl-431 jbl-959 jbl-1320 jbl-1288">Mengerti, Tutup</button>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <script>
        lucide.createIcons();
    </script>
</body>
</html>

