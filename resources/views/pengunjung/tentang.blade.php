<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang JEBOL - SI JEBOL Kota Tegal</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @include('partials.head-dependencies')
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --primary: #003178;
            --primary-dark: #001e50;
            --accent: #f59e0b;
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
        }        .page-hero {
            background-color: var(--primary);
            background-image: linear-gradient(rgba(0, 49, 120, 0.9), rgba(0, 49, 120, 0.8)), url('{{ asset('images/batik-tegal-premium.jpg') }}');
            background-size: cover;
            background-position: center;
            padding: 140px 0 80px;
            color: white;
            text-align: center;
            border-bottom: 5px solid var(--accent);
        }
        .page-title {
            font-family: 'Outfit', sans-serif;
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 16px;
            color: #ffffff !important;
        }
        .content-section {
            padding: 80px 0;
            min-height: 50vh;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 24px;
        }
        .card {
            background: white;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 49, 120, 0.05);
            line-height: 1.8;
            color: #334155;
            font-size: 1.1rem;
            margin-bottom: 40px;
        }
        .card h2 {
            color: var(--primary);
            font-family: 'Outfit', sans-serif;
            font-size: 2rem;
            margin-bottom: 24px;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .card h2 i {
            color: var(--accent);
        }
        
        .timeline {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }
        .timeline::after {
            content: '';
            position: absolute;
            width: 4px;
            background-color: #e2e8f0;
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -2px;
            border-radius: 4px;
        }
        .timeline-item {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
        }
        .timeline-item.left { left: 0; }
        .timeline-item.right { left: 50%; }
        .timeline-item::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            right: -10px;
            background-color: var(--primary);
            border: 4px solid var(--accent);
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }
        .timeline-item.right::after { left: -10px; }
        .timeline-content {
            padding: 20px 30px;
            background-color: white;
            position: relative;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }
        .timeline-content h3 {
            color: var(--primary);
            font-weight: 800;
            font-size: 1.25rem;
            margin-bottom: 10px;
        }
        
        @media screen and (max-width: 600px) {
            .timeline::after { left: 31px; }
            .timeline-item { width: 100%; padding-left: 70px; padding-right: 25px; }
            .timeline-item.left::after, .timeline-item.right::after { left: 21px; }
            .timeline-item.right { left: 0%; }
        }
    </style>
</head>
<body>

    @include('partials.navbar')

    <section class="page-hero">
        <div class="jbl-186">
            <h1 class="page-title">Tentang JEBOL</h1>
            <p style="font-size: 1.2rem; opacity: 0.9;">Jemput Bola Layanan Administrasi Kependudukan</p>
        </div>
    </section>

    <section class="content-section">
        <div class="jbl-186">
            
            <div id="profil" class="card">
                <h2><i data-lucide="info"></i> Profil SI JEBOL</h2>
                <p>
                    <strong>SI JEBOL (Sistem Jemput Bola)</strong> adalah inovasi layanan dari Dinas Kependudukan dan Pencatatan Sipil (Disdukcapil) Kota Tegal. Program ini dirancang untuk memberikan kemudahan bagi masyarakat Kota Tegal dalam mengurus dokumen administrasi kependudukan tanpa harus datang langsung ke kantor Disdukcapil.
                </p>
                <p class="jbl-858">
                    Melalui SI JEBOL, tim pelayanan kami akan turun langsung ke berbagai lokasi seperti kelurahan, sekolah, rumah sakit, dan tempat umum lainnya sesuai dengan jadwal yang telah ditetapkan atau berdasarkan permohonan khusus (misalnya untuk lansia, penyandang disabilitas, atau warga yang sakit).
                </p>
            </div>

            <div id="tujuan" class="card">
                <h2><i data-lucide="target"></i> Tujuan Program</h2>
                <ul class="jbl-1405 jbl-1384 jbl-1052">
                    <li><strong>Mendekatkan Layanan:</strong> Memberikan akses layanan kependudukan yang lebih dekat dan mudah dijangkau oleh masyarakat.</li>
                    <li><strong>Meningkatkan Cakupan Kepemilikan Dokumen:</strong> Memastikan seluruh warga Kota Tegal memiliki dokumen kependudukan yang sah (KTP-el, KIA, Akta, dll).</li>
                    <li><strong>Efisiensi Waktu dan Biaya:</strong> Mengurangi waktu antrean dan biaya transportasi masyarakat dalam mengurus dokumen.</li>
                    <li><strong>Pelayanan Inklusif:</strong> Memastikan warga rentan (lansia, sakit, disabilitas) tetap mendapatkan hak pelayanan administrasi kependudukan.</li>
                </ul>
            </div>

            <div id="alur" class="card" style="background-color: transparent; box-shadow: none; padding: 0;">
                <h2 style="justify-content: center; margin-bottom: 40px; font-size: 2.5rem;"><i data-lucide="route"></i> Alur Pelayanan</h2>
                
                <div class="timeline">
                    <div class="timeline-item left">
                        <div class="timeline-content">
                            <h3>1. Cek Jadwal & Lokasi</h3>
                            <p>Masyarakat melihat jadwal pelayanan keliling SI JEBOL melalui website atau media sosial Disdukcapil.</p>
                        </div>
                    </div>
                    <div class="timeline-item right">
                        <div class="timeline-content">
                            <h3>2. Siapkan Berkas</h3>
                            <p>Membawa persyaratan yang dibutuhkan sesuai jenis layanan kependudukan yang diajukan.</p>
                        </div>
                    </div>
                    <div class="timeline-item left">
                        <div class="timeline-content">
                            <h3>3. Datang ke Lokasi</h3>
                            <p>Menuju lokasi pelayanan mobile JEBOL sesuai waktu yang dijadwalkan.</p>
                        </div>
                    </div>
                    <div class="timeline-item right">
                        <div class="timeline-content">
                            <h3>4. Proses Pelayanan</h3>
                            <p>Petugas akan memproses dokumen secara langsung di tempat (perekaman, pencetakan, dll).</p>
                        </div>
                    </div>
                    <div class="timeline-item left">
                        <div class="timeline-content">
                            <h3>5. Dokumen Selesai</h3>
                            <p>Dokumen kependudukan diserahkan langsung kepada warga (jika memungkinkan dicetak di tempat) atau diinformasikan waktu pengambilannya.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    @include('partials.footer')

    <script>
        lucide.createIcons();
    </script>
</body>
</html>

