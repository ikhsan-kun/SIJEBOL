

<?php $__env->startPush('styles'); ?>
<style>
@media (max-width: 1024px) {
            
        }

        .content-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 48px;
        }

        @media (max-width: 768px) {
            .content-container {
                padding: 0 24px;
            }
        }

        .help-hero {
            position: relative;
            background-color: var(--primary);
            background-image: linear-gradient(rgba(0, 49, 120, 0.9), rgba(0, 49, 120, 0.95)), url('<?php echo e(asset('images/batik-tegal-premium.jpg')); ?>');
            background-size: cover;
            padding: 48px 0;
            text-align: left;
            color: white;
            border-bottom: 4px solid #FFC107;
        }

        .help-hero .container {
            position: relative;
            z-index: 10;
        }

        .hero-title {
            font-size: 3rem !important;
            font-weight: 900 !important;
            line-height: 1.1 !important;
            margin-bottom: 16px !important;
            color: white !important;
            text-shadow: 0 4px 30px rgba(0,0,0,0.3);
            letter-spacing: -1.5px;
            position: relative;
            display: inline-block;
        }

        @media (max-width: 768px) {
            .help-hero { padding: 80px 20px 0 ; border-radius: 0 0 40px 40px; }
            .hero-title { font-size: 2.2rem !important; }
            .hero-subtitle { font-size: 1rem !important; }
        }

        .hero-title .text-amber-400 {
            color: #FFC107 !important;
        }

        .hero-subtitle {
            font-size: clamp(1rem, 1.5vw, 1.1rem) !important;
            max-width: 700px !important;
            margin-bottom: 24px !important;
            color: rgba(255,255,255,0.9) !important;
            line-height: 1.6 !important;
            text-shadow: 0 2px 10px rgba(0,0,0,0.2);
            margin-left: 0;
            margin-right: 0;
        }

        .category-section {
            padding: 100px 0;
            background: transparent;
            margin-top: -60px;
            position: relative;
            z-index: 20;
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
        }

        @media (max-width: 1024px) {
            .category-grid { grid-template-columns: repeat(2, 1fr); }
            .cat-card { padding: 32px 24px; border-radius: 24px; }
        }

        @media (max-width: 640px) {
            .category-grid { grid-template-columns: 1fr; }
            .category-section { padding: 60px 0; }
        }

        .cat-card {
            padding: 40px 32px;
            border-radius: 32px;
            border: 1px solid rgba(0, 49, 120, 0.05);
            background: white;
            box-shadow: 0 10px 30px rgba(0, 49, 120, 0.05);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-align: center;
            text-decoration: none;
            color: inherit;
        }

        .cat-card:hover {
            box-shadow: 0 30px 60px rgba(0, 49, 120, 0.12);
            transform: translateY(-12px);
            border-color: var(--primary);
        }

        .cat-icon {
            width: 64px;
            height: 64px;
            background-color: var(--primary-light);
            color: var(--primary);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            transition: all 0.3s ease;
        }

        .cat-card:hover .cat-icon {
            background-color: var(--primary);
            color: white;
            transform: rotate(10deg);
        }

        .cat-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--primary);
        }

        .cat-card p {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .faq-section {
            padding: 100px 0;
            background-color: white;
            border-radius: 60px 60px 0 0;
            box-shadow: 0 -20px 40px rgba(0, 49, 120, 0.03);
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-header h2 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 16px;
        }

        .faq-list {
            max-width: 900px;
            margin: 0 auto;
        }

        .faq-item {
            background: #f8fafc;
            border: 1px solid rgba(0,0,0,0.03);
            border-radius: 24px;
            margin-bottom: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-item:hover {
            background: white;
            box-shadow: 0 10px 30px rgba(0, 49, 120, 0.08);
            border-color: var(--primary-light);
        }

        .faq-item.active, .faq-item.active:hover {
            background: var(--primary) !important;
            box-shadow: 0 20px 40px rgba(0, 49, 120, 0.15) !important;
            border-color: var(--primary-dark) !important;
        }

        .faq-item.active .faq-question {
            color: white !important;
        }

        .faq-item.active .faq-answer {
            color: rgba(255, 255, 255, 0.9) !important;
        }

        .faq-item.active .faq-question svg, .faq-item.active .faq-question i {
            color: white !important;
        }

        .faq-question {
            padding: 24px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 700;
            color: var(--primary);
            font-size: 1.1rem;
        }

        .faq-answer {
            display: none;
            padding: 0 32px 32px;
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.7;
        }

        .download-section {
            padding: 120px 0;
            background-color: #f8fafc;
        }

        .download-grid {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 80px;
            align-items: center;
        }

        @media (max-width: 1024px) {
            .download-grid { grid-template-columns: 1fr; gap: 40px; }
            .download-image-wrapper { order: -1; }
            .download-image { height: 300px; border-radius: 24px; }
            .image-badge { right: 10px !important; bottom: 10px !important; }
        }

        .download-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 24px 32px;
            border: 1px solid rgba(0, 49, 120, 0.08);
            border-radius: 24px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            background: white;
            text-decoration: none;
        }

        .download-card:hover {
            transform: scale(1.02);
            border-color: var(--primary);
            box-shadow: 0 20px 40px rgba(0, 49, 120, 0.1);
        }

        .dl-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .dl-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dl-icon.pdf { background-color: #fee2e2; color: #dc2626; }
        .dl-icon.video { background-color: #e0f2fe; color: #0284c7; }

        .dl-text h4 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .dl-text p {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        .download-image-wrapper {
            position: relative;
        }

        .download-image {
            width: 100%;
            border-radius: 40px;
            box-shadow: 0 40px 80px rgba(0, 49, 120, 0.2);
            object-fit: cover;
            height: 450px;
            border: 8px solid white;
        }

        .contact-section {
            background-color: var(--primary);
            padding: 100px 0;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .contact-section::before {
            content: '';
            position: absolute;
            inset: 0;
            opacity: 0.1;
            mix-blend-mode: soft-light;
        }

        .contact-section h2 {
            color: white;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .contact-section p {
            color: rgba(255,255,255,0.9);
            font-size: 1.1rem;
            margin-bottom: 48px;
            position: relative;
            z-index: 2;
        }

        .contact-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            position: relative;
            z-index: 2;
        }

        .btn-premium-light {
            padding: 18px 40px;
            border-radius: 100px;
            font-weight: 700;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 12px;
        }

        .btn-wa { background: #25D366; color: white; }
        .btn-wa:hover { background: #1ebd5a; transform: translateY(-5px); box-shadow: 0 15px 30px rgba(37, 211, 102, 0.3); }

        .btn-email { background: white; color: var(--primary); }
        .btn-email:hover { background: #f1f5f9; transform: translateY(-5px); box-shadow: 0 15px 30px rgba(255, 255, 255, 0.2); }

        @media (max-width: 1200px) {
            .category-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            .section-header h2 { font-size: 1.75rem; }
            .faq-question { padding: 20px; font-size: 1rem; }
            .contact-buttons { flex-direction: column; align-items: center; }
            .btn-premium-light { width: 100%; max-width: 350px; justify-content: center; }
        }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="help-hero">
                <div class="content-container">
                    <h1 class="hero-title">
                        Pusat <span class="jbl-407">Bantuan</span> Masyarakat
                    </h1>
                    <p class="hero-subtitle">Temukan solusi cepat dan panduan resmi layanan kependudukan Kota Tegal melalui basis pengetahuan kami.</p>
                </div>
            </section>

            <section class="category-section">
                <div class="content-container">
                    <div class="category-grid">
                        <a href="#faq-akun-daftar" class="cat-card" data-faq-target="faq-akun-daftar">
                            <div class="cat-icon"><i data-lucide="user-circle" width="32" height="32"></i></div>
                            <h3>Akun & Login</h3>
                            <p>Masalah akses, lupa kata sandi, dan panduan aktivasi akun warga.</p>
                        </a>
                        <a href="#faq-cara-pengajuan" class="cat-card" data-faq-target="faq-cara-pengajuan">
                            <div class="cat-icon"><i data-lucide="file-check-2" width="32" height="32"></i></div>
                            <h3>Cara Pengajuan</h3>
                            <p>Langkah-langkah unggah dokumen dan syarat permohonan adminduk.</p>
                        </a>
                        <a href="#faq-cek-status" class="cat-card" data-faq-target="faq-cek-status">
                            <div class="cat-icon"><i data-lucide="activity" width="32" height="32"></i></div>
                            <h3>Cek Status</h3>
                            <p>Memahami arti status permohonan dan estimasi waktu penyelesaian.</p>
                        </a>
                        <a href="#faq-lokasi-layanan" class="cat-card" data-faq-target="faq-lokasi-layanan">
                            <div class="cat-icon"><i data-lucide="navigation" width="32" height="32"></i></div>
                            <h3>Lokasi Layanan</h3>
                            <p>Info titik jemput bola, kantor cabang, dan jadwal operasional.</p>
                        </a>
                    </div>
                </div>
            </section>

            <section class="faq-section" id="faq-section">
                <div class="content-container">
                    <div class="section-header">
                        <h2>Pertanyaan yang Sering Diajukan</h2>
                        <p>Cari jawaban instan untuk pertanyaan umum dari masyarakat.</p>
                    </div>

                     <div class="faq-list">
                        <div class="faq-item" id="faq-akun-daftar">
                            <div class="faq-question">
                                <span>Bagaimana cara mendaftar akun JEBOL?</span>
                                <i data-lucide="chevron-down" width="24" height="24"></i>
                            </div>
                            <div class="faq-answer">
                                Anda dapat mendaftar dengan menekan tombol "Register" di navigasi atas, lalu masukkan NIK sesuai KTP, nama lengkap, nomor WhatsApp aktif, dan email. Pastikan data yang dimasukkan valid karena akan diverifikasi oleh sistem.
                            </div>
                        </div>
                        <div class="faq-item" id="faq-cara-pengajuan">
                            <div class="faq-question">
                                <span>Bagaimana langkah-langkah pengajuan dokumen adminduk di SI JEBOL?</span>
                                <i data-lucide="chevron-down" width="24" height="24"></i>
                            </div>
                            <div class="faq-answer">
                                Berikut adalah langkah-langkah pengajuan dokumen adminduk secara online:
                                <ol style="margin-left: 20px; list-style-type: decimal; margin-top: 10px;">
                                    <li style="margin-bottom: 8px;"><strong>Login ke Akun:</strong> Masuk menggunakan NIK dan password yang telah Anda daftarkan.</li>
                                    <li style="margin-bottom: 8px;"><strong>Pilih Layanan:</strong> Masuk ke menu Layanan dan pilih jenis dokumen kependudukan yang ingin Anda ajukan (KTP-el, KIA, IKD, dll).</li>
                                    <li style="margin-bottom: 8px;"><strong>Isi Formulir & Unggah Dokumen:</strong> Isi data diri secara lengkap dan unggah foto/scan berkas persyaratan asli secara jelas (pastikan foto tidak buram atau terpotong).</li>
                                    <li style="margin-bottom: 8px;"><strong>Kirim Permohonan:</strong> Periksa kembali data Anda, lalu klik "Kirim Permohonan". Petugas akan segera memverifikasi berkas Anda.</li>
                                    <li style="margin-bottom: 8px;"><strong>Pantau Status:</strong> Anda bisa melihat progres pengerjaan berkas secara berkala melalui menu "Cek Status".</li>
                                </ol>
                            </div>
                        </div>
                        <div class="faq-item" id="faq-cek-status">
                            <div class="faq-question">
                                <span>Bagaimana cara mengecek status permohonan dan apa saja arti status tersebut?</span>
                                <i data-lucide="chevron-down" width="24" height="24"></i>
                            </div>
                            <div class="faq-answer">
                                Anda dapat memantau status permohonan secara real-time melalui menu <strong>Cek Status</strong> di dashboard Anda. Berikut arti dari setiap status permohonan:
                                <ul style="margin-left: 20px; list-style-type: disc; margin-top: 10px;">
                                    <li style="margin-bottom: 8px;"><strong>Pending / Menunggu Verifikasi:</strong> Berkas Anda telah diterima dan sedang mengantre untuk diperiksa oleh petugas.</li>
                                    <li style="margin-bottom: 8px;"><strong>Diproses:</strong> Berkas dinyatakan lengkap dan dokumen adminduk Anda sedang dalam tahap pencetakan atau penerbitan.</li>
                                    <li style="margin-bottom: 8px;"><strong>Selesai:</strong> Dokumen Anda telah selesai diterbitkan! Anda dapat mengunduh berkas digitalnya langsung atau mengambil dokumen fisik jika diperlukan.</li>
                                    <li style="margin-bottom: 8px;"><strong>Ditolak:</strong> Permohonan belum disetujui karena berkas kurang lengkap atau tidak jelas. Silakan lihat catatan petugas untuk detail perbaikan yang diperlukan.</li>
                                </ul>
                                <p style="margin-top: 12px; font-weight: 600; color: var(--primary);">Estimasi waktu penyelesaian layanan berkisar antara 1 hingga 3 hari kerja sejak berkas dinyatakan lengkap dan diverifikasi.</p>
                            </div>
                        </div>
                        <div class="faq-item" id="faq-akun-lupa">
                            <div class="faq-question">
                                <span>Bagaimana jika saya lupa kata sandi akun?</span>
                                <i data-lucide="chevron-down" width="24" height="24"></i>
                            </div>
                            <div class="faq-answer">
                                Klik menu "Login", lalu pilih "Lupa Kata Sandi". Masukkan nomor WhatsApp atau email terdaftar, dan sistem akan mengirimkan instruksi pengaturan ulang kata sandi ke perangkat Anda.
                            </div>
                        </div>
                        <div class="faq-item" id="faq-lokasi-layanan">
                            <div class="faq-question">
                                <span>Dimana saya bisa melihat lokasi dan jadwal layanan Jemput Bola?</span>
                                <i data-lucide="chevron-down" width="24" height="24"></i>
                            </div>
                            <div class="faq-answer">
                                Anda dapat melihat jadwal operasional dan titik lokasi jemput bola secara lengkap melalui menu "Jadwal Jemput Bola" di navigasi atas atau mengunjungi kantor cabang/kecamatan terdekat untuk informasi lebih lanjut.
                            </div>
                        </div>
                    </div>
                </div>
            </section>



            <section class="contact-section">
                <div class="content-container">
                    <h2>Belum Menemukan Jawaban?</h2>
                    <p>Tim dukungan Disdukcapil Kota Tegal siap membantu Anda secara personal.</p>
                    <div class="contact-buttons">
                        <a href="https://wa.me/628123456789" class="btn-premium-light btn-wa">
                            <i data-lucide="message-square" width="20" height="20"></i> WhatsApp Center
                        </a>
                        <a href="mailto:disdukcapil@tegalkota.go.id" class="btn-premium-light btn-email">
                            <i data-lucide="mail" width="20" height="20"></i> Hubungi via Email
                        </a>
                    </div>
                </div>
            </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.masyarakat', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\jeboll\resources\views/masyarakat/bantuan.blade.php ENDPATH**/ ?>