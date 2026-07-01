<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami - SI JEBOL</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <?php echo $__env->make('partials.head-dependencies', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
            background-image: url('<?php echo e(asset('img/batik-pattern.png')); ?>');
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
            background-image: linear-gradient(rgba(0, 49, 120, 0.9), rgba(0, 49, 120, 0.85)), url('<?php echo e(asset('images/batik-tegal-premium.jpg')); ?>');
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
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 16px;
        }

        .hero-tag {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 100px;
            font-size: 0.85rem;
            font-weight: 700;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero-content h1 {
            color: white;
            font-size: 3.5rem;
            font-weight: 800;
            margin: 0;
            line-height: 1.2;
        }

        .hero-content h1 span {
            color: var(--accent);
        }

        .hero-content p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
            line-height: 1.6;
            margin: 0;
            max-width: 600px;
        }

        .main-container {
            max-width: 100%;
            margin: 60px auto 80px;
            padding: 0 40px;
            position: relative;
            z-index: 10;
        }

        /* Side-by-Side Layout */
        .contact-layout {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 24px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .premium-card {
            background: var(--surface);
            border-radius: 20px;
            padding: 24px 20px;
            text-align: center;
            box-shadow: 0 20px 40px -10px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.03);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .premium-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px -12px rgba(0,0,0,0.08);
        }

        .icon-box {
            width: 56px;
            height: 56px;
            background: #f0f7ff;
            color: var(--primary);
            border-radius: 16px;
            display: grid;
            place-items: center;
            margin-bottom: 16px;
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
            height: 100%;
            min-height: 500px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1);
            border: 10px solid white;
        }

        @media (max-width: 1024px) {
            .contact-layout { grid-template-columns: 1fr; }
            .hero-content h1 { font-size: 2.5rem; }
        }
    </style>
</head>
<body>
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <section class="contact-hero">
        <div class="hero-content">
            <span class="hero-tag">Pusat Informasi</span>
            <h1>Hubungi <span>Kami</span></h1>
            <p>Tim SI JEBOL siap membantu Anda dengan layanan kependudukan yang cepat dan transparan.</p>
        </div>
    </section>

    <div class="main-container">
        <div class="contact-layout">
            <!-- Grid Kartu Informasi (1 Kolom) -->
            <div class="info-grid">
                <div class="premium-card">
                    <div class="icon-box"><i data-lucide="map-pin"></i></div>
                    <div class="card-title">Alamat Kantor</div>
                    <p class="card-desc">Jl. Lele No.14, Tegalsari, Kec. Tegal Bar., Kota Tegal, Jawa Tengah 52111</p>
                </div>

                <div class="premium-card">
                    <div class="icon-box"><i data-lucide="phone"></i></div>
                    <div class="card-title">Layanan Telepon</div>
                    <p class="card-desc">0896-8002-21212</p>
                </div>

                <div class="premium-card">
                    <div class="icon-box"><i data-lucide="mail"></i></div>
                    <div class="card-title">Email Resmi</div>
                    <p class="card-desc">hdisdukcapiltegalkota@gmail.com</p>
                </div>
            </div>

            <!-- Peta Lokasi -->
            <div class="map-section">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.2001552554765!2d109.1368!3d-6.8675!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNTInMDIuOSJTIDEwOcKwMDgnMTIuNSJF!5e0!3m2!1sid!2sid!4v1619680000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </div>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Pastikan script lucide diload dengan benar -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>

<?php /**PATH D:\laragon\www\jeboll\resources\views/pengunjung/kontak.blade.php ENDPATH**/ ?>