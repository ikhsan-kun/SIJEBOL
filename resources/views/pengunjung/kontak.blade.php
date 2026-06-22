<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami - SI JEBOL</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @include('partials.head-dependencies')
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --primary: #003178;
            --primary-light: #0a58ca;
            --accent: #f59e0b;
            --bg-soft: #f8fafc;
            --surface: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-soft);
            background-image: url('{{ asset('img/batik-pattern.png') }}');
            background-size: 600px;
            background-attachment: fixed;
            color: var(--text-main);
            margin: 0;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(248, 250, 252, 0.95);
            z-index: -1;
        }

        .contact-hero {
            background-color: var(--primary);
            background-image: linear-gradient(rgba(0, 49, 120, 0.9), rgba(0, 49, 120, 0.85)), url('{{ asset('images/batik-tegal-premium.jpg') }}');
            background-size: 600px;
            background-position: center;
            background-attachment: fixed;
            padding: 160px 24px 100px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
            border-bottom: 5px solid var(--accent);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-tag {
            display: inline-block;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 100px;
            font-size: 0.85rem;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero-content h1 {
            color: white;
            font-size: 3.5rem;
            font-weight: 800;
            margin: 0 0 16px;
        }

        .hero-content h1 span {
            color: var(--accent);
        }

        .hero-content p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            line-height: 1.6;
            margin: 0;
        }

        .main-container {
            max-width: 1200px;
            margin: -60px auto 80px;
            padding: 0 24px;
            position: relative;
            z-index: 10;
        }

        /* 3-Column Layout for Info Cards */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-bottom: 48px;
        }

        .premium-card {
            background: var(--surface);
            border-radius: 24px;
            padding: 40px 32px;
            text-align: center;
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.03);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .premium-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 60px -12px rgba(0,0,0,0.08);
        }

        .icon-box {
            width: 64px;
            height: 64px;
            background: #f0f7ff;
            color: var(--primary);
            border-radius: 20px;
            display: grid;
            place-items: center;
            margin-bottom: 24px;
            transition: all 0.3s;
        }

        .premium-card:hover .icon-box {
            background: var(--primary);
            color: white;
            transform: scale(1.1) rotate(-5deg);
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: #1e293b;
        }

        .card-desc {
            color: var(--text-muted);
            line-height: 1.6;
            font-size: 1rem;
            margin: 0;
        }

        .map-section {
            border-radius: 32px;
            overflow: hidden;
            height: 500px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1);
            border: 10px solid white;
        }

        .social-container {
            text-align: center;
            margin-top: 60px;
        }

        .social-bar {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 24px;
        }

        .social-link {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: white;
            display: grid;
            place-items: center;
            color: var(--primary);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05);
            transition: all 0.2s;
            text-decoration: none;
        }

        .social-link:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-5px);
        }

        @media (max-width: 1024px) {
            .info-grid { grid-template-columns: 1fr; }
            .hero-content h1 { font-size: 2.5rem; }
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <section class="contact-hero">
        <div class="hero-content">
            <span class="hero-tag">Pusat Informasi</span>
            <h1>Hubungi <span>Kami</span></h1>
            <p>Tim SI JEBOL siap membantu Anda dengan layanan kependudukan yang cepat dan transparan.</p>
        </div>
    </section>

    <div class="main-container">
        <!-- Grid Kartu Informasi (3 Kolom) -->
        <div class="info-grid">
            <div class="premium-card">
                <div class="icon-box"><i data-lucide="map-pin"></i></div>
                <div class="card-title">Alamat Kantor</div>
                <p class="card-desc">Jl. Ki Gede Sebayu No.2, Tegal Timur, Kota Tegal, Jawa Tengah 52123</p>
            </div>

            <div class="premium-card">
                <div class="icon-box"><i data-lucide="phone"></i></div>
                <div class="card-title">Layanan Telepon</div>
                <p class="card-desc"><strong>WhatsApp:</strong> 0812-3456-7890<br><strong>Hotline:</strong> (0283) 351001</p>
            </div>

            <div class="premium-card">
                <div class="icon-box"><i data-lucide="mail"></i></div>
                <div class="card-title">Email Resmi</div>
                <p class="card-desc">disdukcapil@tegalkota.go.id<br>support.jebol@tegalkota.go.id</p>
            </div>
        </div>

        <!-- Peta Lokasi Full Width -->
        <div class="map-section">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.2001552554765!2d109.1368!3d-6.8675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNTInMDIuOSJTIDEwOcKwMDgnMTIuNSJF!5e0!3m2!1sid!2sid!4v1619680000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>

        <div class="social-container">
            <h3 style="font-weight: 700; color: #475569;">Ikuti Media Sosial Kami</h3>
            <div class="social-bar">
                <a href="#" class="social-link" title="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                </a>
                <a href="#" class="social-link" title="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                <a href="#" class="social-link" title="Twitter">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                </a>
                <a href="#" class="social-link" title="YouTube">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 7.1C2 8.7 1.7 10.3 1.7 12s.3 3.3.8 4.9c.8 2.6 3 4.5 5.7 4.9 1.4.2 2.8.2 4.1.2s2.7 0 4.1-.2c2.7-.4 4.9-2.3 5.7-4.9.5-1.6.8-3.2.8-4.9s-.3-3.3-.8-4.9c-.8-2.6-3-4.5-5.7-4.9-1.4-.2-2.8-.2-4.1-.2s-2.7 0-4.1.2c-2.7.4-4.9 2.3-5.7 4.9z"/><path d="m10 15 5-3-5-3v6z"/></svg>
                </a>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <!-- Pastikan script lucide diload dengan benar -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>

