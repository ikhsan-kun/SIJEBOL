

<?php $__env->startPush('styles'); ?>
<style>
}');
            background-size: 400px;
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            margin: 0;
        }

        /* Sidebar Layout Integration */
        

        

        @media (max-width: 1024px) {
            
        }

        .hero-banner {
            background: #003178;
            color: white;
            overflow: hidden;
            box-shadow: 0 20px 40px -15px rgba(0, 49, 120, 0.2);
            position: relative;
        
            border-radius: 0;
            padding: 48px 96px;
            margin: 0 -48px 40px -48px;
            border-bottom: 4px solid #F59E0B;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('<?php echo e(asset("images/batik-tegal-premium.jpg")); ?>');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
            mix-blend-mode: luminosity;
            pointer-events: none;
        }

        .hero-banner h1 {
            font-size: 3rem !important;
            font-weight: 900 !important;
            line-height: 1.1 !important;
            margin-bottom: 16px !important;
            color: white !important;
            letter-spacing: -1.5px !important;
        }

        @media (max-width: 1024px) {
            .hero-banner {
                margin: -16px -16px 40px -16px;
                padding: 40px 24px;
                border-radius: 0;
            }
        }

        @media (max-width: 768px) {
            .hero-banner { padding: 32px 20px; border-radius: 0; }
            .hero-banner h1 { font-size: 2.2rem !important; }
            .hero-banner p { font-size: 1rem !important; }
        }

        .hero-banner p {
            font-size: 1.1rem !important;
            max-width: 600px !important;
            color: rgba(255,255,255,0.8) !important;
            margin-bottom: 0 !important;
            line-height: 1.6 !important;
        }

        .main-layout {
            max-width: 100%;
            margin: 0;
            padding: 0;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 32px;
        }

        .services-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .premium-service-card {
            background: white;
            border-radius: 32px;
            padding: 40px;
            border: 1px solid rgba(0, 49, 120, 0.05);
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        .premium-service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 60px rgba(0, 49, 120, 0.1);
            border-color: var(--primary);
        }

        .card-icon-box {
            width: 60px;
            height: 60px;
            background: #fdfdfe;
            border: 1px solid #f1f5f9;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            margin-bottom: 24px;
            transition: all 0.3s;
        }

        .premium-service-card:hover .card-icon-box {
            background: var(--primary);
            color: white;
            transform: rotate(-5deg) scale(1.1);
        }

        .premium-service-card h3 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #000000;
            margin-bottom: 12px;
            font-family: 'Inter', sans-serif;
            letter-spacing: -0.5px;
        }

        .premium-service-card p {
            font-size: 0.9rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 32px;
            flex: 1;
        }

        .status-pill {
            display: inline-flex;
            padding: 4px 12px;
            background: #f0fdf4;
            color: #15803d;
            border-radius: 100px;
            font-size: 0.65rem;
            font-weight: 900;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .btn-action-main {
            background: var(--primary);
            color: white;
            padding: 16px;
            border-radius: 16px;
            font-weight: 700;
            text-align: center;
            transition: all 0.2s;
            margin-top: auto;
            display: block;
        }

        .btn-action-main:hover {
            background: var(--primary-dark);
            transform: scale(1.02);
            box-shadow: 0 10px 20px rgba(0, 49, 120, 0.2);
        }

        .btn-action-secondary {
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 700;
            text-align: center;
            margin-top: 16px;
            transition: all 0.2s;
        }

        .btn-action-secondary:hover {
            color: var(--primary);
        }

        /* Sidebar Styles */
        .sidebar-premium {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .info-premium-card {
            background: white;
            border-radius: 32px;
            padding: 32px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        }

        .info-premium-card h4 {
            font-size: 1.1rem;
            font-weight: 800;
            color: #000000;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .req-step {
            display: flex;
            gap: 16px;
            margin-bottom: 20px;
        }

        .step-num {
            width: 28px;
            height: 28px;
            background: var(--primary-light);
            color: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 0.8rem;
            flex-shrink: 0;
        }

        .req-step p {
            font-size: 0.85rem;
            color: var(--text-main);
            font-weight: 500;
            line-height: 1.5;
        }

        .help-banner-modern {
            background: #ffffff;
            border-radius: 32px;
            padding: 32px;
            color: var(--text-main);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0, 49, 120, 0.05);
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        }

        .help-banner-modern h4 {
            font-size: 1.25rem;
            font-weight: 900;
            color: var(--primary);
            margin-bottom: 12px;
            position: relative;
            z-index: 2;
        }

        .help-banner-modern p {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 24px;
            position: relative;
            z-index: 2;
        }

        .btn-white-glass {
            background: var(--primary);
            color: white;
            padding: 12px 24px;
            border-radius: 100px;
            font-weight: 700;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            position: relative;
            z-index: 2;
        }

        .btn-white-glass:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }

        .bg-pattern {
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 2px, transparent 0);
            background-size: 15px 15px;
            z-index: 1;
        }

        @media (max-width: 1024px) {
            .main-layout { grid-template-columns: 1fr; }
            .hero-banner h1 { font-size: 2.5rem; }
            .services-grid { 
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }
        }

        @media (max-width: 768px) {
            .services-grid { 
                grid-template-columns: 1fr 1fr;
                gap: 12px; 
            }
            .premium-service-card { 
                padding: 16px; 
                border-radius: 16px; 
                display: flex;
                flex-direction: column;
                min-width: unset;
                max-width: unset;
            }
            .premium-service-card h3 {
                font-size: 1rem;
                margin-bottom: 8px;
                line-height: 1.2;
                text-align: left;
            }
            .premium-service-card p {
                font-size: 0.75rem;
                margin-bottom: 16px;
                line-height: 1.4;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            .card-icon-box {
                width: 40px;
                height: 40px;
                margin-bottom: 12px;
                border-radius: 12px;
                margin-left: 0;
                margin-right: 0;
            }
            .card-icon-box .material-symbols-outlined {
                font-size: 20px !important;
            }
            .status-pill {
                padding: 4px 8px;
                font-size: 0.6rem;
                margin-bottom: 12px;
                align-self: flex-start;
            }
            .btn-action-main {
                padding: 10px;
                font-size: 0.8rem;
                border-radius: 10px;
                text-align: center;
                margin-top: auto;
            }
            .btn-action-secondary {
                display: block;
                font-size: 0.75rem;
                margin-top: 10px;
            }
        }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="hero-banner">
                <div class="jbl-1109 jbl-1117 jbl-1401 jbl-1293 jbl-1541 jbl-1426 jbl-141">
                    <h1>Layanan <span style="color: #F59E0B;">SI JEBOL</span></h1>
                    <p style="margin-left: auto !important; margin-right: auto !important;">Pilih layanan administrasi kependudukan yang Anda butuhkan dengan mudah, cepat, dan aman.</p>
                </div>
                <div class="jbl-91 jbl-726 jbl-256 jbl-1167 jbl-1117 jbl-565 jbl-195 jbl-6">
                    <span class="material-symbols-outlined" style="font-size: 180px; color: white;">verified_user</span>
                </div>
            </section>

   

            <div class="main-layout">
        <!-- Left: Services -->
        <div class="services-grid">
            <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="premium-service-card">
                <span class="status-pill"><?php echo e(strtoupper($service->status)); ?></span>
                <div class="card-icon-box">
                    <span class="material-symbols-outlined jbl-47"><?php echo e($service->icon ?? 'description'); ?></span>
                </div>
                <h3><?php echo e($service->name); ?></h3>
                <p>Urus dokumen kependudukan Anda secara online dengan estimasi waktu penyelesaian <strong><?php echo e($service->estimation ?? '1-3 Hari Kerja'); ?></strong>.</p>
                <a href="<?php echo e(route('pengajuan', ['layanan' => $service->name])); ?>" class="btn-action-main">Ajukan Sekarang</a>
                <button @click.prevent="showDetailModal = true; activeService = '<?php echo e(addslashes($service->name)); ?>'" class="btn-action-secondary">Lihat Detail & Syarat</button>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="jbl-834 jbl-1081 jbl-1401 jbl-434 jbl-1382 jbl-333 jbl-400 jbl-121">
                <span class="material-symbols-outlined jbl-766 jbl-189 jbl-870">settings_suggest</span>
                <p class="jbl-147 jbl-959">Maaf, saat ini belum ada layanan aktif yang tersedia.</p>
            </div>
            <?php endif; ?>
        </div>

        <!-- Right: Sidebar -->
        <div class="sidebar-premium">
            <div class="info-premium-card">
                <h4>
                    <span class="material-symbols-outlined">description</span>
                    Persyaratan Umum
                </h4>
                <div class="req-step">
                    <div class="step-num">01</div>
                    <p>Mempunyai akun SI JEBOL yang telah terverifikasi NIK-nya.</p>
                </div>
                <div class="req-step">
                    <div class="step-num Explorer">02</div>
                    <p>Dokumen asli harus dipindai (scan) dengan jelas dan berwarna.</p>
                </div>
                <div class="req-step">
                    <div class="step-num">03</div>
                    <p>Format file: JPG/PDF dengan ukuran maksimal 2MB per file.</p>
                </div>
                <div class="req-step">
                    <div class="step-num">04</div>
                    <p>Pastikan Nomor WhatsApp aktif untuk notifikasi status berkas.</p>
                </div>
            </div>

            <div class="help-banner-modern">
                <div class="bg-pattern"></div>
                <h4>Butuh Bantuan Teknis?</h4>
                <p>Tim dukungan kami siap membantu Anda menyelesaikan kendala pengajuan dokumen Anda.</p>
                <a href="#" class="btn-white-glass">
                    <i data-lucide="message-circle" width="18" height="18"></i>
                    WhatsApp Support
                </a>
            </div>
        </div>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.masyarakat', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\jeboll\resources\views/masyarakat/layanan.blade.php ENDPATH**/ ?>