<!-- Global Content Header (Centralized) -->
<header class="global-content-header">
    <!-- Mobile Toggle (New) -->
    <button class="mobile-nav-toggle" @click="sidebarOpen = !sidebarOpen">
        <i data-lucide="menu"></i>
    </button>

    <form action="{{ route('masyarakat.cek-status') }}" method="GET" class="header-search-form">
        <i data-lucide="search" class="search-icon-fixed"></i>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari layanan atau permohonan...">
    </form>
    
    <div class="header-right-actions">
        <!-- Notifications -->
        @php
            $recentNotifs = collect();
            if (auth()->check() && auth()->user() instanceof \App\Models\Masyarakat) {
                $recentNotifs = \App\Models\PengajuanLayanan::where('nik', auth()->user()->nik)
                    ->whereNotNull('tanggal_pengajuan')
                    ->orderBy('tanggal_pengajuan', 'desc')
                    ->take(3)
                    ->get();
            }
        @endphp
        <div class="header-notification-wrapper">
            <div class="notification-trigger">
                <i data-lucide="bell"></i>
                @if($recentNotifs->count() > 0)
                <span class="notification-badge"></span>
                @endif
            </div>
            
            <!-- Notification Dropdown -->
            <div class="header-dropdown-menu notification-dropdown">
                <p class="dropdown-label">Pesan Terbaru</p>
                <div class="notification-list">
                    @forelse($recentNotifs as $notif)
                    <a href="{{ route('masyarakat.cek-status', ['search' => $notif->nomor_tiket]) }}" style="text-decoration: none;" class="notification-item-row jbl-582 jbl-632" style="display: flex; gap: 12px; padding: 10px; border-radius: 8px;">
                        <div class="notif-dot" style="background: {{ $notif->status == 'Selesai' ? '#10b981' : ($notif->status == 'Ditolak' ? '#ef4444' : '#f59e0b') }}"></div>
                        <div class="notif-content">
                            <p class="notif-title" style="margin: 0; font-size: 0.8rem; font-weight: 800; color: #1e293b;">Status: {{ $notif->status }}</p>
                            <p class="notif-desc" style="margin: 4px 0 0; font-size: 0.75rem; color: #64748b;">Layanan {{ $notif->jenis_layanan }} ({{ $notif->nomor_tiket }})</p>
                            <p style="margin: 4px 0 0; font-size: 0.65rem; color: #94a3b8; font-weight: 600;">{{ $notif->tanggal_pengajuan ? \Carbon\Carbon::parse($notif->tanggal_pengajuan)->diffForHumans() : '' }}</p>
                        </div>
                    </a>
                    @empty
                    <div style="text-align: center; padding: 16px 0; font-size: 0.75rem; color: #94a3b8;">
                        Belum ada notifikasi baru.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="header-divider"></div>

        <!-- User Profile Dropdown -->
        <div class="header-user-wrapper">
            @auth
                <button class="user-profile-trigger">
                    <div class="user-avatar-initials">
                        @if(auth()->user()->foto_profil ?? auth()->user()->profile_photo_path)
                            <img src="{{ asset('storage/' . (auth()->user()->foto_profil ?? auth()->user()->profile_photo_path)) }}" alt="Profile">
                        @else
                            {{ strtoupper(substr(auth()->user()->nama ?? auth()->user()->name ?? 'U', 0, 2)) }}
                        @endif
                    </div>
                    <div class="user-info-text">
                        <p class="user-display-name">{{ auth()->user()->nama ?? auth()->user()->name ?? 'Pengguna' }}</p>
                        <p class="user-display-role">Warga Digital</p>
                    </div>
                    <i data-lucide="chevron-down" class="dropdown-arrow-icon"></i>
                </button>

                <!-- Dropdown Menu -->
                <div class="header-dropdown-menu profile-dropdown">
                    <div class="dropdown-header-box">
                        <p class="dropdown-user-name">{{ auth()->user()->nama ?? auth()->user()->name ?? 'Pengguna' }}</p>
                        <p class="dropdown-user-email">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="dropdown-links">
                        <a href="{{ route('masyarakat.profile') }}" class="dropdown-link-item">
                            <i data-lucide="user"></i>
                            Profil Akun
                        </a>
                        <a href="{{ route('masyarakat.help') }}" class="dropdown-link-item">
                            <i data-lucide="help-circle"></i>
                            Bantuan
                        </a>
                    </div>
                    <div class="dropdown-footer">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="logout-link-btn" style="color: #ef4444; border: none; background: transparent; cursor: pointer; display: flex; align-items: center; gap: 12px; font-weight: 700; width: 100%; padding: 12px 20px;">
                                <i data-lucide="log-out"></i>
                                Keluar Sesi
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="user-profile-trigger" style="text-decoration: none;">
                    <div class="user-avatar-initials" style="background: rgba(148, 163, 184, 0.1); color: #64748b; border-color: rgba(148, 163, 184, 0.2);">
                        <i data-lucide="user"></i>
                    </div>
                    <div class="user-info-text">
                        <p class="user-display-name">Tamu</p>
                        <p class="user-display-role">Belum Masuk</p>
                    </div>
                </a>
            @endauth
        </div>
    </div>
</header>
