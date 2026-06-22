<nav class="bg-gray-100 border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">

        <!-- LOGO -->
        <div>
            <h1 class="font-bold text-lg text-gray-800">
                DISDUKCAPIL TEGAL
            </h1>
            <p class="text-xs text-gray-500">
                Dinas Kependudukan dan Pencatatan Sipil Kota Tegal
            </p>
        </div>

        <!-- MENU -->
        <ul class="flex gap-6 items-center font-medium text-gray-700">

            <li>
                <a href="/" 
                   class="px-4 py-2 rounded-full transition 
                   {{ request()->is('/') ? 'bg-yellow-500 text-white font-semibold' : 'hover:bg-yellow-400 hover:text-white' }}">
                    Beranda
                </a>
            </li>

            <li><a href="#" class="hover:text-yellow-500">Tentang</a></li>
            <li><a href="#" class="hover:text-yellow-500">Layanan</a></li>
            <li><a href="#" class="hover:text-yellow-500">Persyaratan</a></li>
            <li><a href="#" class="hover:text-yellow-500">Pengumuman</a></li>
            <li><a href="#" class="hover:text-yellow-500">FAQ</a></li>
            <li><a href="#" class="hover:text-yellow-500">Kontak</a></li>

        </ul>

        @guest
            <a href="/login" class="block py-1">Masuk</a>
            <a href="/register" class="block py-1">Daftar</a>
        @endguest

        @auth
            <div class="py-2">👤 {{ auth()->user()->name }}</div>

            @if(auth()->user()->role == 'admin')
                <a href="/admin" class="block py-1">Admin</a>
            @elseif(auth()->user()->role == 'cabang')
                <a href="/cabang" class="block py-1">Cabang</a>
            @else
                <a href="/dashboard" class="block py-1">Dashboard</a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="mt-2">Logout</button>
            </form>
        @endauth

    </div>
</nav>

<script>
    document.getElementById('menuBtn').onclick = function () {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    }
</script>