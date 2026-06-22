<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi Layanan - SI JEBOL Kota Tegal</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://unpkg.com/lucide@latest"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --primary: #003178;
            --primary-dark: #001f4d;
            --primary-light: #f0f7ff;
            --accent: #FFC107;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --card-shadow: 0 20px 50px rgba(0, 49, 120, 0.1);
        }

        body {
            background-color: #f8faff;
            background-image: url('{{ asset('img/batik-pattern.png') }}');
            background-size: 400px;
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
        }

        /* Sidebar Layout Integration */
        .dashboard-layout {
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex-grow: 1;
            margin-left: 260px;
            padding: 80px 48px 0 ;
            background: #f4f7fb;
            min-width: 0;
            transition: all 0.3s ease;
            display: flex; flex-direction: column; min-height: 100vh;
}

        @media (max-width: 1024px) {
            .main-content {
                margin-left: 0;
                padding: 100px 20px 0 ;
                display: flex; flex-direction: column; min-height: 100vh;
}
        }

        .location-hero {
            position: relative;
            background: #003178;
            background-image: linear-gradient(rgba(0,49,120,0.9), rgba(0,49,120,0.9)), url('{{ asset("images/batik-tegal-premium.jpg") }}');
            background-size: cover;
            border-radius: 0;
            padding: 48px 96px;
            margin: 0 -48px 40px -48px;
            border-bottom: 4px solid #F59E0B;
            color: white;
            overflow: hidden;
            box-shadow: 0 20px 40px -15px rgba(0, 49, 120, 0.2);
        }

        .hero-title {
            font-size: 3rem !important;
            font-weight: 900 !important;
            line-height: 1.1 !important;
            margin-bottom: 16px !important;
            color: white !important;
        }

        @media (max-width: 768px) {
            .location-hero { padding: 32px 20px; border-radius: 0; margin: 0 -20px 40px -20px; }
            .hero-title { font-size: 2.2rem !important; }
            .hero-subtitle { font-size: 1rem !important; }
        }

        .hero-subtitle {
            font-size: 1.1rem !important;
            max-width: 600px !important;
            color: rgba(255,255,255,0.8) !important;
            margin-bottom: 0 !important;
        }

        .content-wrapper {
            max-width: 100%;
            margin: 0;
            padding: 0;
        }

        .main-card {
            display: grid;
            grid-template-columns: 450px 1fr;
            gap: 40px;
        }

        .info-panel {
            padding: 0;
        }

        .map-panel {
            min-height: 600px;
            position: relative;
            border-radius: 40px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: #eef2ff;
            color: var(--primary);
            border-radius: 100px;
            font-size: 0.7rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 32px;
        }

        .address-box h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: 16px;
        }

        .address-box p {
            color: var(--text-muted);
            line-height: 1.7;
            font-size: 1.05rem;
            margin-bottom: 40px;
        }

        .contact-list {
            display: flex;
            flex-direction: column;
            gap: 24px;
            margin-bottom: 48px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .icon-box {
            width: 52px;
            height: 52px;
            background: white;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            box-shadow: 0 8px 16px rgba(0, 49, 120, 0.05);
            border: 1px solid #f1f5f9;
            flex-shrink: 0;
        }

        .contact-info label {
            display: block;
            font-size: 0.75rem;
            color: var(--text-muted);
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .contact-info span {
            display: block;
            font-size: 1.05rem;
            color: var(--text-main);
            font-weight: 600;
        }

        .btn-directions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            width: 100%;
            padding: 20px;
            background: var(--primary);
            color: white;
            border-radius: 20px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-directions:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0, 49, 120, 0.2);
        }

        /* Branch Section */
        .branch-section {
            margin-top: 100px;
        }

        .branch-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .branch-header h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-dark);
        }

        .branch-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .branch-card {
            background: white;
            padding: 40px;
            border-radius: 32px;
            border: 1px solid transparent;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            display: flex;
            gap: 24px;
            transition: all 0.3s;
        }

        .branch-card:hover {
            transform: scale(1.02);
            border-color: var(--primary-light);
            box-shadow: var(--card-shadow);
        }

        .branch-icon {
            width: 64px;
            height: 64px;
            background: var(--primary-light);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            flex-shrink: 0;
        }

        .branch-card h4 {
            font-family: 'Outfit', sans-serif;
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: 8px;
            color: var(--primary-dark);
        }

        .branch-card p {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* Bottom Banner */
        .promo-banner {
            margin-top: 100px;
            background: linear-gradient(135deg, var(--accent) 0%, #ffab00 100%);
            border-radius: 48px;
            padding: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(255, 193, 7, 0.2);
        }

        .promo-content {
            position: relative;
            z-index: 2;
            max-width: 500px;
        }

        .promo-content h3 {
            font-family: 'Outfit', sans-serif;
            font-size: 2.5rem;
            font-weight: 900;
            color: #402a00;
            margin-bottom: 16px;
        }

        .promo-content p {
            color: rgba(64, 42, 0, 0.7);
            font-size: 1.1rem;
            margin-bottom: 32px;
            font-weight: 500;
        }

        .btn-white {
            display: inline-flex;
            padding: 16px 40px;
            background: white;
            color: #402a00;
            border-radius: 20px;
            font-weight: 800;
            transition: all 0.2s;
        }

        .btn-white:hover {
            transform: scale(1.05);
            background: #402a00;
            color: white;
        }

        .promo-img {
            position: absolute;
            right: 80px;
            bottom: -20px;
            width: 400px;
            opacity: 0.15;
            pointer-events: none;
        }

        @media (max-width: 1024px) {
            .main-card { grid-template-columns: 1fr; gap: 32px; }
            .info-panel { padding: 0; }
            .map-panel { min-height: 400px; order: -1; border-radius: 24px; }
            .promo-banner { flex-direction: column; text-align: center; padding: 40px 24px; border-radius: 32px; }
            .promo-content { max-width: 100%; }
            .promo-img { display: none; }
        }

        @media (max-width: 768px) {
            .hero-title { font-size: 2.75rem; }
            .branch-grid { grid-template-columns: 1fr; }
            .branch-card { padding: 24px; border-radius: 24px; flex-direction: column; text-align: center; align-items: center; }
            .address-box h3 { font-size: 1.5rem; }
            .branch-header h2 { font-size: 2rem; }
        }
    </style>
</head>
<body x-data="{ sidebarOpen: false }">

    <div class="dashboard-layout">
        @include('partials.sidebar-masyarakat')

        <main class="main-content">
            <section class="location-hero">
                <div class="jbl-1109 jbl-1117">
                    <h1 class="hero-title">
                        Lokasi <span style="color: #f59e0b;">Pelayanan</span>
                    </h1>
                    <p class="hero-subtitle">
                        Temukan kantor pelayanan Disdukcapil dan titik jemput bola terdekat dari lokasi Anda di seluruh penjuru Kota Tegal.
                    </p>
                </div>
                <div class="jbl-91 jbl-726 jbl-256 jbl-1167 jbl-1117 jbl-565 jbl-195 jbl-6">
                    <i data-lucide="map-pin" style="width: 180px; height: 180px; color: white;"></i>
                </div>
            </section>

    <div class="content-wrapper">
        <div class="main-card">
            <div class="info-panel">
                <div class="section-badge">
                    <i data-lucide="check-circle-2" style="width: 14px;"></i>
                    Kantor Pusat Disdukcapil
                </div>
                
                <div class="address-box">
                    <h3>Disdukcapil Kota Tegal</h3>
                    <p>Jl. Ki Gede Sebayu No.2, Tegal, Kec. Tegal Timur, Kota Tegal, Jawa Tengah 52123</p>
                </div>

                <div class="contact-list">
                    <div class="contact-item">
                        <div class="icon-box"><i data-lucide="phone"></i></div>
                        <div class="contact-info">
                            <label>Telepon Kantor</label>
                            <span>(0283) 351001</span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="icon-box"><i data-lucide="message-circle" style="color: #25D366;"></i></div>
                        <div class="contact-info">
                            <label>WhatsApp Center</label>
                            <span>0812-3456-7890</span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="icon-box"><i data-lucide="clock"></i></div>
                        <div class="contact-info">
                            <label>Jam Operasional</label>
                            <span>Senin-Kamis (08.00-15.30)</span>
                            <span class="jbl-843 jbl-302 jbl-1237">Jumat (08.00-11.00)</span>
                        </div>
                    </div>
                </div>

                <a href="https://www.google.com/maps/dir/?api=1&destination=Disdukcapil+Kota+Tegal" target="_blank" class="btn-directions">
                    <i data-lucide="navigation"></i>
                    Dapatkan Petunjuk Arah
                </a>
            </div>
            <div class="map-panel">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.036814214251!2d109.1352494109044!3d-6.886196293084307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb9d95f8e5611%3A0xc3f3458622c7d9e7!2sDisdukcapil%20Kota%20Tegal!5e0!3m2!1sid!2sid!4v1715484000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        <div class="branch-section">
            <div class="branch-header">
                <h2>Titik Layanan Wilayah</h2>
                <p class="jbl-147 jbl-1451 jbl-619 jbl-858">Pilih titik layanan terdekat dari tempat tinggal Anda untuk pengurusan dokumen langsung.</p>
            </div>
            
            <div class="branch-grid">
                <div class="branch-card">
                    <div class="branch-icon"><i data-lucide="map-pin"></i></div>
                    <div>
                        <h4>Kec. Tegal Timur</h4>
                        <p>Jl. Ki Gede Sebayu No.2, Kompleks Balaikota Tegal. Lokasi sangat strategis di pusat kota.</p>
                    </div>
                </div>
                <div class="branch-card">
                    <div class="branch-icon"><i data-lucide="anchor"></i></div>
                    <div>
                        <h4>Kec. Tegal Barat</h4>
                        <p>Jl. Hang Tuah No.12, Kel. Tegalsari. Dekat dengan area pelabuhan dan pemukiman warga.</p>
                    </div>
                </div>
                <div class="branch-card">
                    <div class="branch-icon"><i data-lucide="building-2"></i></div>
                    <div>
                        <h4>Kec. Tegal Selatan</h4>
                        <p>Jl. Teuku Umar No.45. Melayani seluruh kelurahan di wilayah selatan Kota Tegal.</p>
                    </div>
                </div>
                <div class="branch-card">
                    <div class="branch-icon"><i data-lucide="map"></i></div>
                    <div>
                        <h4>Kec. Margadana</h4>
                        <p>Jl. Dr. Cipto Mangunkusumo No.88. Akses mudah bagi warga di sisi barat Kota Tegal.</p>
                    </div>
                </div>
            </div>
        </div>

       
    </div>

                    <!-- Global Footer -->
            <div style="margin-top: auto; padding: 24px; background: white; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; font-size: 0.75rem; color: #64748b;">
                <div>&copy; 2026 Dinas Kependudukan dan Pencatatan Sipil Kota Tegal. All rights reserved.</div>
                <div style="display:flex; gap:16px;">
                    <a href="#" style="color:#64748b; text-decoration:none;">Kebijakan Privasi</a>
                    <a href="#" style="color:#64748b; text-decoration:none;">Syarat & Ketentuan</a>
                </div>
            </div>
        </main>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>

