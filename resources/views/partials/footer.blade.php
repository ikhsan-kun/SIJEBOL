<style>
    .custom-footer {
        background-color: #0f172a;
        color: #94a3b8;
        padding: 80px 0 0 0;
        position: relative;
        overflow: hidden;
        font-family: 'Inter', sans-serif;
    }
    .footer-batik {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: url('{{ asset('img/batik-pattern.png') }}');
        background-size: 400px;
        background-position: center;
        opacity: 0.03;
        z-index: 1;
        pointer-events: none;
    }
    .footer-container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 24px;
        position: relative;
        z-index: 2;
    }
    .footer-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1.5fr;
        gap: 40px;
        margin-bottom: 60px;
    }
    .footer-brand {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .footer-logo-link {
        display: flex;
        align-items: center;
        gap: 16px;
        text-decoration: none;
    }
    .footer-logo-img {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: white;
        padding: 2px;
        object-fit: cover;
    }
    .footer-title-main {
        font-size: 1.4rem;
        font-weight: 900;
        color: white;
        line-height: 1.1;
        letter-spacing: 0.5px;
    }
    .footer-title-sub {
        font-size: 0.75rem;
        font-weight: 700;
        color: #3b82f6;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-top: 2px;
        display: block;
    }
    .footer-desc {
        line-height: 1.7;
        font-size: 0.95rem;
        max-width: 400px;
        margin: 0;
    }
    .footer-socials {
        display: flex;
        gap: 12px;
    }
    .footer-social-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        color: white;
        transition: all 0.3s;
    }
    .footer-social-link:hover {
        background: #3b82f6;
        transform: translateY(-3px);
    }
    .footer-heading {
        color: white;
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 24px;
        margin-top: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .footer-link-item a {
        color: #94a3b8;
        text-decoration: none;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .footer-link-item a:hover {
        color: #3b82f6;
        transform: translateX(5px);
    }
    .footer-contact-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .footer-contact-item {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        line-height: 1.6;
    }
    .footer-contact-icon {
        color: #3b82f6;
        font-size: 1.2rem;
        margin-top: 2px;
    }
    .footer-contact-item a {
        color: #94a3b8;
        text-decoration: none;
        transition: color 0.2s;
    }
    .footer-contact-item a:hover {
        color: white;
    }
    .footer-schedule {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 24px;
    }
    .footer-schedule-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px dashed rgba(255, 255, 255, 0.1);
    }
    .footer-schedule-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    .footer-schedule-day {
        color: #cbd5e1;
    }
    .footer-schedule-time {
        color: white;
        font-weight: 600;
    }
    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding: 24px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .footer-bottom-links {
        display: flex;
        gap: 24px;
    }
    .footer-bottom-links a {
        color: #94a3b8;
        text-decoration: none;
        font-size: 0.9rem;
        transition: color 0.2s;
    }
    .footer-bottom-links a:hover {
        color: white;
    }
    @media (max-width: 1024px) {
        .footer-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
    @media (max-width: 640px) {
        .footer-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }
        .footer-bottom {
            flex-direction: column;
            gap: 16px;
            text-align: center;
        }
    }
</style>

<footer class="custom-footer">
    <!-- Batik Overlay -->
    <div class="footer-batik"></div>

    <div class="footer-container">
        <div class="footer-grid">
            <!-- Brand Column -->
            <div class="footer-brand">
                <a href="/" class="footer-logo-link">
                    <img src="{{ asset('images/logo.jpg') }}" alt="SI JEBOL" class="footer-logo-img">
                    <div>
                        <span class="footer-title-main">SI JEBOL</span>
                        <span class="footer-title-sub">Kota Tegal Bahari</span>
                    </div>
                </a>
                <p class="footer-desc">
                    Sistem Informasi Jemput Bola (SI JEBOL) merupakan layanan administrasi kependudukan berbasis digital yang memudahkan masyarakat dalam mengakses layanan KTP-el, KIA, dan IKD melalui program pelayanan jemput bola.
                </p>
                <div class="footer-socials">
                    <a href="#" class="footer-social-link">
                        <i data-lucide="instagram" width="20" height="20"></i>
                    </a>
                    <a href="#" class="footer-social-link">
                        <i data-lucide="facebook" width="20" height="20"></i>
                    </a>
                    <a href="#" class="footer-social-link">
                        <i data-lucide="twitter" width="20" height="20"></i>
                    </a>
                </div>
            </div>

            <!-- Services Column -->
            <div>
                <h4 class="footer-heading">Layanan Kami</h4>
                <ul class="footer-links">
                    <li class="footer-link-item">
                        <a href="{{ route('services') }}">
                            <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward_ios</span>
                            Perekaman KTP-el
                        </a>
                    </li>
                    <li class="footer-link-item">
                        <a href="{{ route('services') }}">
                            <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward_ios</span>
                            Kartu Identitas Anak (KIA)
                        </a>
                    </li>
                    <li class="footer-link-item">
                        <a href="{{ route('services') }}">
                            <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward_ios</span>
                            Aktivasi IKD
                        </a>
                    </li>
                    <li class="footer-link-item">
                        <a href="{{ route('masyarakat.cek-status') }}">
                            <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward_ios</span>
                            Pelacakan Status
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Info Column -->
            <div>
                <h4 class="footer-heading">Pusat Informasi</h4>
                <ul class="footer-links">
                    <li class="footer-link-item">
                        <a href="{{ route('tentang') }}">
                            <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward_ios</span>
                            Tentang JEBOL
                        </a>
                    </li>
                    <li class="footer-link-item">
                        <a href="{{ route('jadwal') }}">
                            <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward_ios</span>
                            Jadwal Jemput Bola
                        </a>
                    </li>
                    <li class="footer-link-item">
                        <a href="{{ route('contact') }}">
                            <span class="material-symbols-outlined" style="font-size: 16px;">arrow_forward_ios</span>
                            Kontak
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact/Extra Column -->
            <div>
                <h4 class="footer-heading">Jam Layanan</h4>
                <div class="footer-schedule">
                    <div class="footer-schedule-row">
                        <span class="footer-schedule-day">Senin - Kamis</span>
                        <span class="footer-schedule-time">08:00 - 15:30 WIB</span>
                    </div>
                    <div class="footer-schedule-row">
                        <span class="footer-schedule-day">Jumat</span>
                        <span class="footer-schedule-time">08:00 - 11:00 WIB</span>
                    </div>
                </div>
                
                <h4 class="footer-heading" style="margin-bottom: 16px;">Kontak Kami</h4>
                <ul class="footer-contact-list">
                    <li class="footer-contact-item">
                        <span class="material-symbols-outlined footer-contact-icon">location_on</span>
                        <span>Dinas Kependudukan dan Pencatatan Sipil Kota Tegal</span>
                    </li>
                    <li class="footer-contact-item">
                        <span class="material-symbols-outlined footer-contact-icon">call</span>
                        <a href="tel:0283XXXXXXX">(0283) XXXXXXX</a>
                    </li>
                    <li class="footer-contact-item">
                        <span class="material-symbols-outlined footer-contact-icon">mail</span>
                        <a href="mailto:disdukcapil@tegalkota.go.id">disdukcapil@tegalkota.go.id</a>
                    </li>
                    <li class="footer-contact-item">
                        <span class="material-symbols-outlined footer-contact-icon">language</span>
                        <a href="https://disdukcapil.tegalkota.go.id" target="_blank">Website Resmi</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="footer-bottom">
            <p style="margin: 0;">
                &copy; {{ date('Y') }} Dinas Kependudukan dan Pencatatan Sipil Kota Tegal.
            </p>
            <div class="footer-bottom-links">
                <a href="#">Syarat & Ketentuan</a>
                <a href="#">Kebijakan Privasi</a>
            </div>
        </div>
    </div>
</footer>
