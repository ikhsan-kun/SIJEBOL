<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi Layanan - SI JEBOL Kota Tegal</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @include('partials.head-dependencies')
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --primary: #003178;
            --primary-dark: #002252;
            --primary-light: #e0f2fe;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            background-color: #f8faff;
            background-image: url('{{ asset('img/batik-pattern.png') }}');
            background-size: 400px;
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            margin: 0;
        }
        .jbl-186 {
            width: 100% !important;
            margin-left: auto !important;
            margin-right: auto !important;
            padding-left: 24px !important;
            padding-right: 24px !important;
            box-sizing: border-box !important;
        }
        .public-hero {
            background-color: var(--primary);
            background-image: linear-gradient(rgba(0, 49, 120, 0.9), rgba(0, 49, 120, 0.85)), url('{{ asset('images/batik-tegal-premium.jpg') }}');
            background-size: cover;
            background-attachment: fixed;
            padding: 160px 0 100px;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 5px solid #FFC107;
        }

        .public-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('img/batik-pattern.png') }}');
            background-size: 500px;
            opacity: 0.1;
            mix-blend-mode: overlay;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
            position: relative;
            z-index: 10;
        }

        .map-section {
            padding: 100px 0;
        }

        .map-card {
            background: white;
            border-radius: 40px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 49, 120, 0.1);
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            min-height: 500px;
        }

        .map-info {
            padding: 60px;
        }

        .map-info h2 {
            font-size: 2rem;
            font-weight: 900;
            color: var(--primary);
            margin-bottom: 24px;
        }

        .map-info p {
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 40px;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 20px;
        }

        .contact-item .material-symbols-outlined {
            color: var(--primary);
            font-size: 24px;
        }

        @media (max-width: 992px) {
            .map-card { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    @include('partials.navbar')

    <section class="public-hero">
        <div class="jbl-186">
            <h1 style="font-size: 4rem; font-weight: 900; letter-spacing: -2px; margin-bottom: 24px; color: white;">Lokasi Layanan</h1>
            <p style="font-size: 1.25rem; max-width: 700px; margin: 0 auto; opacity: 0.9;">Temukan kantor pelayanan kami untuk pengurusan dokumen tatap muka.</p>
        </div>
    </section>

    <div class="jbl-186 map-section">
        <div class="map-card">
            <div class="map-info">
                <h2>Kantor Pusat</h2>
                <p>Dinas Kependudukan dan Pencatatan Sipil Kota Tegal siap melayani Anda di hari kerja.</p>
                
                <div class="contact-item">
                    <span class="material-symbols-outlined">location_on</span>
                    <span>Jl. Ki Gede Sebayu No.2, Kota Tegal</span>
                </div>
                <div class="contact-item">
                    <span class="material-symbols-outlined">phone</span>
                    <span>(0283) 351001</span>
                </div>
                <div class="contact-item">
                    <span class="material-symbols-outlined">schedule</span>
                    <span>Senin - Jumat (08:00 - 15:30)</span>
                </div>

                <a href="https://maps.google.com" target="_blank" class="jbl-423 jbl-934 jbl-1266 jbl-1361 jbl-1298 jbl-674 jbl-835 jbl-959">Buka Google Maps</a>
            </div>
            <div class="map-frame">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.036814214251!2d109.1352494109044!3d-6.886196293084307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb9d95f8e5611%3A0xc3f3458622c7d9e7!2sDisdukcapil%20Kota%20Tegal!5e0!3m2!1sid!2sid!4v1715484000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>

    @include('partials.footer')

    <script>
        lucide.createIcons();
    </script>
</body>
</html>

