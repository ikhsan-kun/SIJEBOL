<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Penilaian Layanan - SI JEBOL Kota Tegal</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @include('partials.head-dependencies')
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --primary: #003178;
            --primary-dark: #002252;
            --primary-light: #e0f2fe;
            --accent: #FFC107;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            background-color: #f8faff;
            background-image: url('{{ asset('img/batik-pattern.png') }}');
            background-size: 600px;
            background-attachment: fixed;
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            margin: 0;
            position: relative;
        }

        .jbl-186 {
            width: 100% !important;
            margin-left: auto !important;
            margin-right: auto !important;
            padding-left: 24px !important;
            padding-right: 24px !important;
            box-sizing: border-box !important;
        }
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background: rgba(248, 250, 255, 0.95);
            z-index: -1;
        }

        .public-hero {
            background-color: var(--primary);
            background-image: linear-gradient(rgba(0, 49, 120, 0.92), rgba(0, 49, 120, 0.85)), url('{{ asset('images/batik-tegal-premium.jpg') }}');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            padding: 120px 0 80px;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 6px solid var(--accent);
            box-shadow: 0 20px 40px rgba(0, 49, 120, 0.2);
        }

        .public-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('img/batik-pattern.png') }}');
            background-size: 500px;
            opacity: 0.15;
            mix-blend-mode: overlay;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            padding: 0;
            position: relative;
            z-index: 10;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 900;
            letter-spacing: -1px;
            margin-bottom: 16px;
            color: white;
            text-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        .hero-title span { color: var(--accent); }
        
        .hero-subtitle {
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
            opacity: 0.95;
            line-height: 1.6;
            font-weight: 500;
        }

        /* Stats Cards */
        .stats-summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: -40px;
            position: relative;
            z-index: 20;
            margin-bottom: 60px;
        }

        .stat-card-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 24px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 20px 40px rgba(0, 49, 120, 0.08);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .stat-card-glass:hover {
            transform: translateY(-10px);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--primary) 0%, #3b82f6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 8px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .stat-label {
            font-weight: 800;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
        }

        /* Review Grid */
        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 32px;
            margin-bottom: 80px;
        }

        .history-item {
            padding: 20px;
            border-radius: 16px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            margin-bottom: 16px;
            transition: all 0.3s ease;
        }

        .history-item:hover {
            border-color: #cbd5e1;
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.02);
        }

        .history-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .history-date {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        .status-badge {
            font-size: 0.75rem;
            font-weight: 800;
            padding: 4px 10px;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .status-received {
            background: #e0f2fe;
            color: #0284c7;
        }

        .status-followed-up {
            background: #ecfdf5;
            color: #059669;
        }

        .history-rating {
            display: flex;
            gap: 4px;
            color: var(--accent);
            margin-bottom: 12px;
        }

        .history-feedback {
            color: var(--text-main);
            font-style: italic;
            line-height: 1.6;
            margin: 16px 0;
            padding-left: 16px;
            border-left: 4px solid #e2e8f0;
        }

        .history-response {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            padding: 16px;
            border-radius: 12px;
            margin-top: 16px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
        }

        /* Filter Section */
        .filter-section {
            margin-bottom: 24px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .filter-tabs {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 8px 20px;
            border-radius: 100px;
            border: 2px solid #f1f5f9;
            background: white;
            color: var(--text-muted);
            font-weight: 700;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-btn:hover {
            border-color: var(--primary-light);
            color: var(--primary);
        }

        .filter-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 49, 120, 0.2);
        }

        .sort-select {
            padding: 8px 16px;
            border-radius: 100px;
            border: 2px solid #f1f5f9;
            background: #f8fafc;
            color: var(--text-main);
            font-weight: 700;
            font-size: 0.85rem;
            outline: none;
            cursor: pointer;
        }

        /* CTA */
        .cta-bottom {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 40px;
            padding: 80px 40px;
            text-align: center;
            color: white;
            margin-bottom: 100px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 49, 120, 0.15);
        }

        .cta-bottom::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,193,7,0.15) 0%, transparent 70%);
        }

        .btn-cta {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 18px 40px;
            background: var(--accent);
            color: var(--primary-dark);
            border-radius: 100px;
            font-weight: 900;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s;
            margin-top: 32px;
            box-shadow: 0 10px 25px rgba(255, 193, 7, 0.3);
        }

        .btn-cta:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(255, 193, 7, 0.4);
        }

        @media (max-width: 768px) {
            .hero-title { font-size: 2.5rem; }
            .stats-summary { 
                grid-template-columns: repeat(3, 1fr); 
                gap: 8px; 
                margin-top: 20px; 
            }
            .stat-card-glass {
                padding: 12px 8px;
                border-radius: 16px;
            }
            .stat-value {
                font-size: 1.25rem;
            }
            .stat-value [data-lucide="star"] {
                width: 16px;
                height: 16px;
            }
            .stat-label {
                font-size: 0.55rem;
                letter-spacing: 0px;
                line-height: 1.2;
                margin-top: 4px;
            }
            .filter-section { flex-direction: column; align-items: flex-start; }
            .public-hero { padding: 100px 0 40px; }
        }
    </style>
</head>
<body>

    @include('partials.navbar')

    <section class="public-hero">
        <div class="jbl-186">
            <h1 class="hero-title">Penilaian <span>Layanan</span></h1>
            <p class="hero-subtitle">Transparansi kualitas pelayanan administrasi kependudukan di Kota Tegal berdasarkan ulasan dan pengalaman nyata masyarakat.</p>
        </div>
    </section>

    <div class="jbl-186">
        <!-- Stats -->
        <div class="stats-summary">
            <div class="stat-card-glass">
                <div class="stat-value">
                    {{ number_format($rataRata, 1) }} <i data-lucide="star" width="32" height="32" fill="#FFC107" color="#FFC107"></i>
                </div>
                <div class="stat-label">Rata-rata Penilaian</div>
            </div>
            <div class="stat-card-glass">
                <div class="stat-value">{{ $persentasePuas }}%</div>
                <div class="stat-label">Tingkat Kepuasan</div>
            </div>
            <div class="stat-card-glass">
                <div class="stat-value">{{ number_format($totalUlasan) }}</div>
                <div class="stat-label">Ulasan Masuk</div>
            </div>
        </div>

        <!-- Filter -->
        <div class="filter-section">
            <h3 style="margin: 0; font-size: 1.1rem; color: var(--text-main); font-weight: 800;">Daftar Ulasan</h3>
            <form action="{{ route('ulasan') }}" method="GET" style="margin: 0;">
                <select name="filter" class="sort-select" onchange="this.form.submit()">
                    <option value="all" {{ request('filter', 'all') == 'all' ? 'selected' : '' }}>Semua Bintang</option>
                    <option value="5-bintang" {{ request('filter') == '5-bintang' ? 'selected' : '' }}>5 ⭐⭐⭐⭐⭐</option>
                    <option value="4-bintang" {{ request('filter') == '4-bintang' ? 'selected' : '' }}>4 ⭐⭐⭐⭐</option>
                    <option value="3-bintang" {{ request('filter') == '3-bintang' ? 'selected' : '' }}>3 ⭐⭐⭐</option>
                    <option value="2-bintang" {{ request('filter') == '2-bintang' ? 'selected' : '' }}>2 ⭐⭐</option>
                    <option value="1-bintang" {{ request('filter') == '1-bintang' ? 'selected' : '' }}>1 ⭐</option>
                </select>
            </form>
        </div>

        <div style="margin-bottom: 40px; display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 24px;">
                @forelse($reviews as $review)
                    <div class="history-item" style="margin-bottom: 0; display: flex; flex-direction: column;">
                    <div class="history-header">
                        <span class="history-date">{{ $review->tanggal_input ? $review->tanggal_input->format('d M Y, H:i') : '-' }} WIB</span>
                        @php
                            $statusClass = ($review->status ?? '') === 'followed_up' ? 'status-followed-up' : 'status-received';
                        @endphp
                        <span class="status-badge {{ $statusClass }}">
                            @if(($review->status ?? '') === 'followed_up')
                                <i data-lucide="check-circle-2" width="12" height="12" class="jbl-1189"></i> Ditindaklanjuti
                            @else
                                <i data-lucide="clock" width="12" height="12" class="jbl-1189"></i> Diterima
                            @endif
                        </span>
                    </div>
                    <div class="history-rating">
                        @for ($i = 1; $i <= 5; $i++)
                            @if($i <= $review->nilai_kepuasan)
                                <i data-lucide="star" width="16" height="16" fill="currentColor"></i>
                            @else
                                <i data-lucide="star" width="16" height="16" color="#cbd5e1"></i>
                            @endif
                        @endfor
                    </div>

                    <p class="history-feedback jbl-1360">"{{ $review->kritik_saran ?? 'Tidak ada komentar.' }}"</p>
                    @if($review->foto_path)
                        <div style="margin-top: 12px;">
                            <a href="javascript:void(0)" onclick="openImageModal('{{ Storage::url($review->foto_path) }}')" title="Klik untuk memperbesar">
                                <img src="{{ Storage::url($review->foto_path) }}" alt="Foto" style="max-width: 100%; max-height: 250px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'" />
                            </a>
                        </div>
                    @endif
                    @if($review->status === 'followed_up' && $review->admin_response)
                        <div class="history-response">
                            <i data-lucide="message-square" width="16" height="16"></i>
                            <span><b>Balasan Admin:</b> {{ $review->admin_response }}</span>
                        </div>
                    @endif
                    <div style="display: flex; align-items: center; gap: 12px; margin-top: auto; padding-top: 16px; border-top: 1px solid #e2e8f0;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--primary); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; flex-shrink: 0;">
                            {{ $review->masyarakat ? strtoupper(substr($review->masyarakat->name ?? $review->masyarakat->nama ?? 'A', 0, 1)) : 'A' }}
                        </div>
                        <div>
                            <div style="font-weight: 700; color: var(--primary); font-size: 0.95rem;">{{ $review->masyarakat ? ($review->masyarakat->name ?? $review->masyarakat->nama) : 'Anonim' }}</div>
                            <div style="font-size: 0.8rem; color: #64748b; display: flex; align-items: center; gap: 4px;"><i data-lucide="map-pin" width="12"></i> {{ $review->masyarakat ? ($review->masyarakat->kecamatan ?? 'Kota Tegal') : 'Masyarakat' }}</div>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; color: var(--text-muted);">
                    Belum ada ulasan yang ditampilkan.
                </div>
            @endforelse
            </div>



        <!-- CTA Action -->
        <div class="cta-bottom">
            <h2 style="font-size: 2.5rem; font-weight: 900; margin-bottom: 16px; letter-spacing: -1px; color: white;">Ingin Merasakan Mudahnya Layanan Kami?</h2>
            <p style="font-size: 1.1rem; max-width: 600px; margin: 0 auto; opacity: 0.9; color: white;">Daftar sekarang dan nikmati layanan administrasi kependudukan jemput bola yang cepat, transparan, dan gratis!</p>
            <a href="{{ route('register') }}" class="btn-cta">
                <i data-lucide="user-plus"></i> Buat Akun Sekarang
            </a>
        </div>
    </div>

    @include('partials.footer')

    <!-- Image Modal -->
    <div id="imageModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.85); z-index: 9999; justify-content: center; align-items: center; backdrop-filter: blur(5px);">
        <button onclick="closeImageModal()" style="position: absolute; top: 20px; right: 30px; background: none; border: none; color: white; font-size: 40px; cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.2)'" onmouseout="this.style.transform='scale(1)'">&times;</button>
        <img id="modalImg" src="" style="max-width: 90%; max-height: 85vh; border-radius: 8px; box-shadow: 0 20px 50px rgba(0,0,0,0.5);" />
    </div>

    <script>
        lucide.createIcons();
        
        function openImageModal(url) {
            document.getElementById('modalImg').src = url;
            document.getElementById('imageModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
        
        function closeImageModal() {
            document.getElementById('imageModal').style.display = 'none';
            document.getElementById('modalImg').src = '';
            document.body.style.overflow = 'auto';
        }
        
        // Tutup jika klik di luar gambar
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });
    </script>
</body>
</html>

