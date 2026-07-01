<style>
        .custom-navbar {
            background-color: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border-bottom: 1px solid #f1f5f9;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 50;
            transition: all 0.3s ease;
            padding: 16px 0;
        }
        .custom-navbar.scrolled {
            padding: 12px 0;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }
        .nav-container {
            max-width: 100%;
            margin: 0 auto;
            padding: 0 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 16px;
            text-decoration: none;
            transition: opacity 0.2s;
        }
        .nav-brand:hover {
            opacity: 0.85;
        }
        .nav-logo {
            width: 64px;
            height: 64px;
            object-fit: contain;
        }
        .nav-title {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .nav-title-main {
            font-size: 1.3rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.1;
            letter-spacing: -0.5px;
        }
        .nav-title-sub {
            font-size: 0.75rem;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-top: 2px;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 24px;
        }
        .nav-link {
            font-size: 0.95rem;
            font-weight: 600;
            color: #64748b;
            text-decoration: none;
            transition: all 0.2s ease;
            padding: 8px 12px;
            border-radius: 8px;
        }
        .nav-link:hover {
            color: #0f172a;
            background-color: #f8fafc;
        }
        .nav-link.active {
            color: #2563eb;
            background-color: #eff6ff;
            font-weight: 700;
        }
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .btn-login {
            font-weight: 600;
            font-size: 0.95rem;
            color: #475569;
            text-decoration: none;
            transition: color 0.2s;
            padding: 8px 16px;
            border-radius: 8px;
        }
        .btn-login:hover {
            color: #0f172a;
            background-color: #f8fafc;
        }
        .btn-register {
            background-color: #2563eb;
            color: white;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.1);
            transition: all 0.2s;
        }
        .btn-register:hover {
            background-color: #1d4ed8;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
            transform: translateY(-1px);
        }
        .btn-dashboard {
            display: flex;
            align-items: center;
            gap: 8px;
            background-color: #2563eb;
            color: white;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
        box-shadow: 0 4px 6px -1px rgba(0, 49, 120, 0.2);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-dashboard:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px -2px rgba(0, 49, 120, 0.3);
    }
    
    .mobile-menu-btn {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        color: #1e293b;
    }
    
    .mobile-nav-overlay {
        position: fixed;
        top: 76px;
        left: 0;
        width: 100%;
        background: white;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border-top: 1px solid #f1f5f9;
        z-index: 40;
    }
    .mobile-nav-links {
        display: flex;
        flex-direction: column;
        padding: 16px 24px;
    }
    .mobile-nav-link {
        padding: 12px 16px;
        font-size: 1rem;
        font-weight: 600;
        color: #475569;
        text-decoration: none;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 4px;
    }
    .mobile-nav-link.active, .mobile-nav-link:hover {
        background: #f8fafc;
        color: var(--primary, #003178);
    }
    .mobile-actions {
        padding: 16px;
        border-top: 1px solid #f1f5f9;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .mobile-btn-login {
        display: block;
        text-align: center;
        padding: 12px;
        font-weight: 700;
        color: #1e293b;
        text-decoration: none;
        border-radius: 8px;
        background: #f1f5f9;
    }
    .mobile-btn-register {
        display: block;
        text-align: center;
        padding: 12px;
        font-weight: 700;
        color: white;
        background: var(--primary, #003178);
        text-decoration: none;
        border-radius: 8px;
    }

    @media (max-width: 1024px) {
        .nav-links { display: none; }
        .nav-actions .btn-login, .nav-actions .btn-register, .nav-actions .btn-dashboard { display: none; }
        .mobile-menu-btn { display: block; }
    }
</style>

<header class="custom-navbar" 
        x-data="{ mobileMenuOpen: false, scrolled: false }"
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="scrolled ? 'scrolled' : ''">
    
    <div class="nav-container">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="nav-brand">
            <img src="{{ asset('images/logo-tegal.png') }}" alt="SI JEBOL" class="nav-logo">
            <div class="nav-title">
                <span class="nav-title-main">SI JEBOL</span>
                <span class="nav-title-sub">Kota Tegal</span>
            </div>
        </a>
        
        <!-- Desktop Navigation -->
        <nav class="nav-links">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
            <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Layanan</a>
            <a href="{{ route('jadwal') }}" class="nav-link {{ request()->routeIs('jadwal') ? 'active' : '' }}">Jadwal Jemput Bola</a>
            <a href="{{ route('ulasan') }}" class="nav-link {{ request()->routeIs('ulasan') ? 'active' : '' }}">Penilaian Layanan</a>
            <a href="{{ route('bantuan') }}" class="nav-link {{ request()->routeIs('bantuan') ? 'active' : '' }}">Bantuan</a>
            <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Kontak</a>
        </nav>

        <!-- Actions -->
        <div class="nav-actions">
            @auth
                <a href="{{ route('masyarakat.dashboard') }}" class="btn-dashboard">
                    <span class="material-symbols-outlined" style="font-size: 20px;">dashboard</span>
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-login">Login</a>
                <a href="/register" class="btn-register">Registrasi</a>
            @endauth

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="mobile-menu-btn">
                <span class="material-symbols-outlined" x-show="!mobileMenuOpen">menu</span>
                <span class="material-symbols-outlined" x-show="mobileMenuOpen" x-cloak>close</span>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Overlay -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-[-10px]"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-[-10px]"
         class="mobile-nav-overlay"
         x-cloak>
        
        <div class="mobile-nav-links">
            <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                Beranda
                <span class="material-symbols-outlined">chevron_right</span>
            </a>
            <a href="{{ route('services') }}" class="mobile-nav-link {{ request()->routeIs('services') ? 'active' : '' }}">
                Layanan
                <span class="material-symbols-outlined">chevron_right</span>
            </a>
            <a href="{{ route('jadwal') }}" class="mobile-nav-link {{ request()->routeIs('jadwal') ? 'active' : '' }}">
                Jadwal Jemput Bola
                <span class="material-symbols-outlined">chevron_right</span>
            </a>
            <a href="{{ route('ulasan') }}" class="mobile-nav-link {{ request()->routeIs('ulasan') ? 'active' : '' }}">
                Penilaian Layanan
                <span class="material-symbols-outlined">chevron_right</span>
            </a>
            <a href="{{ route('bantuan') }}" class="mobile-nav-link {{ request()->routeIs('bantuan') ? 'active' : '' }}">
                Bantuan
                <span class="material-symbols-outlined">chevron_right</span>
            </a>
            <a href="{{ route('contact') }}" class="mobile-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                Kontak
                <span class="material-symbols-outlined">chevron_right</span>
            </a>
        </div>
        
        <div class="mobile-actions">
            @auth
                <a href="{{ route('masyarakat.dashboard') }}" class="mobile-btn-register" style="display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <span class="material-symbols-outlined" style="font-size: 20px;">dashboard</span>
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="mobile-btn-login">Login</a>
                <a href="/register" class="mobile-btn-register">Registrasi</a>
            @endauth
        </div>
    </div>
</header>
