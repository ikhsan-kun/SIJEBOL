<!-- Mobile Toggle Button and Sidebar -->
<style>
    body {
        background-color: #f8faff !important;
    }
</style>
<div x-data="{ open: false }" class="jbl-1109">

    <!-- Overlay -->
    <div x-show="open" @click="open = false" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="jbl-524 jbl-1062 jbl-1085 jbl-637 jbl-723 jbl-1393"></div>

    <aside :class="open ? 'translate-x-0' : '-translate-x-full'" class="jbl-524 jbl-213 jbl-3 jbl-758 jbl-1293 jbl-1541 jbl-1060 jbl-246 jbl-616 jbl-1440 jbl-201 jbl-929 jbl-35 jbl-993 jbl-119 jbl-476 jbl-965" style="background: #003178;">
    <!-- Batik Overlay (same as masyarakat sidebar) -->
    <div class="jbl-91 jbl-1062 jbl-907" style="background-image: url('/images/batik-tegal-premium.jpg'); background-size: 400px; opacity: 0.15; mix-blend-mode: luminosity; z-index:0;"></div>
    
    <div class="jbl-725 jbl-59 jbl-1293 jbl-1426 jbl-985 jbl-1109 jbl-1117">
        <div class="jbl-27 jbl-1040 jbl-1112 jbl-1293 jbl-1426 jbl-141 jbl-1320 jbl-637 jbl-650" style="width: 90px; height: 90px; background: transparent; border: none; display: grid; place-items: center; padding: 0; transition: all 0.3s ease; margin-right: 12px;">
            <img src="/images/logo-tegal.png" alt="Logo Tegal" class="jbl-1539 jbl-758 jbl-920 jbl-1202 jbl-1182" style="width: 100%; height: 100%; object-fit: contain; filter: drop-shadow(0 0 12px rgba(255, 255, 255, 0.6));">
        </div>
        <div>
            <h1 class="jbl-105 jbl-586 jbl-1361 jbl-502 jbl-1511">SI JEBOL</h1>
            @php $roleType = strtolower(auth()->user()->role ?? ''); @endphp
            @if(in_array($roleType, ['admin', 'admin pusat']))
                <p class="jbl-1105 jbl-1509 jbl-1462 jbl-1471 jbl-586 jbl-1237">{{ auth()->user()->jabatan ?? 'Admin Pusat' }}</p>
            @elseif(in_array($roleType, ['cabang', 'cabang_dinas', 'petugas cabang']))
                <p class="jbl-1105 jbl-217 jbl-1462 jbl-1471 jbl-586 jbl-1237">{{ auth()->user()->jabatan ?? 'Cabang Dinas Pendidikan' }}</p>
            @else
                <p class="jbl-1105 jbl-662 jbl-1462 jbl-1471 jbl-586 jbl-1237">{{ auth()->user()->jabatan ?? 'Petugas Kecamatan' }}</p>
            @endif
        </div>
    </div>
    <nav class="jbl-177 jbl-181 jbl-1003 jbl-1109 jbl-1117 jbl-685">
        @if(in_array($roleType, ['admin', 'admin pusat']))
        <!-- Menu Admin Pusat -->
        <a class="jbl-1293 jbl-1426 jbl-985 jbl-181 jbl-1569 {{ request()->routeIs('admin.dashboard') ? 'text-amber-400' : 'text-slate-300 hover:text-white' }} transition-all duration-200 rounded-xl group relative" href="{{ route('admin.dashboard') }}">
            @if(request()->routeIs('admin.dashboard'))<span class="jbl-91 jbl-213 jbl-880 jbl-1107 jbl-1236 jbl-199 jbl-1227" style="box-shadow: 0 0 15px rgba(251,211,141,0.5);"></span>@endif
            <span class="jbl-1475 jbl-1263 jbl-1320 jbl-1293 jbl-1426 jbl-141 jbl-1288 {{ request()->routeIs('admin.dashboard') ? 'bg-white/10' : 'bg-transparent group-hover:bg-white/10' }}">
                <span class="material-symbols-outlined jbl-390">dashboard</span>
            </span>
            <span class="jbl-843 jbl-959 jbl-1462 jbl-422">Dashboard</span>
        </a>

        <a class="jbl-1293 jbl-1426 jbl-985 jbl-181 jbl-1569 {{ request()->routeIs('admin.permohonan*') ? 'text-amber-400' : 'text-slate-300 hover:text-white' }} transition-all duration-200 rounded-xl group relative" href="{{ route('admin.permohonan') }}">
            @if(request()->routeIs('admin.permohonan*'))<span class="jbl-91 jbl-213 jbl-880 jbl-1107 jbl-1236 jbl-199 jbl-1227" style="box-shadow: 0 0 15px rgba(251,211,141,0.5);"></span>@endif
            <span class="jbl-1475 jbl-1263 jbl-1320 jbl-1293 jbl-1426 jbl-141 jbl-1288 {{ request()->routeIs('admin.permohonan*') ? 'bg-white/10' : 'bg-transparent group-hover:bg-white/10' }}">
                <span class="material-symbols-outlined jbl-390">verified_user</span>
            </span>
            <span class="jbl-843 jbl-959 jbl-1462 jbl-422">Verifikasi</span>
        </a>

        <a class="jbl-1293 jbl-1426 jbl-985 jbl-181 jbl-1569 {{ request()->routeIs('admin.jadwal*') ? 'text-amber-400' : 'text-slate-300 hover:text-white' }} transition-all duration-200 rounded-xl group relative" href="{{ route('admin.jadwal') }}">
            @if(request()->routeIs('admin.jadwal*'))<span class="jbl-91 jbl-213 jbl-880 jbl-1107 jbl-1236 jbl-199 jbl-1227" style="box-shadow: 0 0 15px rgba(251,211,141,0.5);"></span>@endif
            <span class="jbl-1475 jbl-1263 jbl-1320 jbl-1293 jbl-1426 jbl-141 jbl-1288 {{ request()->routeIs('admin.jadwal*') ? 'bg-white/10' : 'bg-transparent group-hover:bg-white/10' }}">
                <span class="material-symbols-outlined jbl-390">calendar_month</span>
            </span>
            <span class="jbl-843 jbl-959 jbl-1462 jbl-422">Jadwal</span>
        </a>
        <a class="jbl-1293 jbl-1426 jbl-985 jbl-181 jbl-1569 {{ request()->routeIs('admin.laporan*') ? 'text-amber-400' : 'text-slate-300 hover:text-white' }} transition-all duration-200 rounded-xl group relative" href="{{ route('admin.laporan') }}">
            @if(request()->routeIs('admin.laporan*'))<span class="jbl-91 jbl-213 jbl-880 jbl-1107 jbl-1236 jbl-199 jbl-1227" style="box-shadow: 0 0 15px rgba(251,211,141,0.5);"></span>@endif
            <span class="jbl-1475 jbl-1263 jbl-1320 jbl-1293 jbl-1426 jbl-141 jbl-1288 {{ request()->routeIs('admin.laporan*') ? 'bg-white/10' : 'bg-transparent group-hover:bg-white/10' }}">
                <span class="material-symbols-outlined jbl-390">description</span>
            </span>
            <span class="jbl-843 jbl-959 jbl-1462 jbl-422">Laporan</span>
        </a>

        <a class="jbl-1293 jbl-1426 jbl-985 jbl-181 jbl-1569 {{ request()->routeIs('admin.kepuasan.*') ? 'text-amber-400' : 'text-slate-300 hover:text-white' }} transition-all duration-200 rounded-xl group relative" href="{{ route('admin.kepuasan.index') }}">
            @if(request()->routeIs('admin.kepuasan.*'))<span class="jbl-91 jbl-213 jbl-880 jbl-1107 jbl-1236 jbl-199 jbl-1227" style="box-shadow: 0 0 15px rgba(251,211,141,0.5);"></span>@endif
            <span class="jbl-1475 jbl-1263 jbl-1320 jbl-1293 jbl-1426 jbl-141 jbl-1288 {{ request()->routeIs('admin.kepuasan.*') ? 'bg-white/10' : 'bg-transparent group-hover:bg-white/10' }}">
                <span class="material-symbols-outlined jbl-390">star</span>
            </span>
            <span class="jbl-843 jbl-959 jbl-1462 jbl-422">Penilaian Layanan</span>
        </a>


        @elseif(in_array($roleType, ['cabang', 'cabang_dinas', 'petugas', 'petugas cabang', 'petugas kecamatan']))
        <!-- Menu Cabang & Petugas -->

        {{-- Label Seksi --}}
        <div class="jbl-181 jbl-293 jbl-1198">
            <p class="jbl-891 jbl-586 jbl-1574 jbl-1462 jbl-1555">Menu Utama</p>
        </div>

        <a class="jbl-1293 jbl-1426 jbl-985 jbl-181 jbl-1569 {{ request()->routeIs('cabang.dashboard') ? 'text-amber-400' : 'text-slate-300 hover:text-white' }} transition-all duration-200 rounded-xl group relative" href="{{ route('cabang.dashboard') }}">
            @if(request()->routeIs('cabang.dashboard'))<span class="jbl-91 jbl-213 jbl-880 jbl-1107 jbl-1236 jbl-199 jbl-1227" style="box-shadow: 0 0 15px rgba(251,211,141,0.5);"></span>@endif
            <span class="jbl-1475 jbl-1263 jbl-1320 jbl-1293 jbl-1426 jbl-141 jbl-1288 {{ request()->routeIs('cabang.dashboard') ? 'bg-white/10' : 'bg-transparent group-hover:bg-white/10' }}">
                <span class="material-symbols-outlined jbl-390">dashboard</span>
            </span>
            <span class="jbl-843 jbl-959 jbl-1462 jbl-422">Dashboard</span>
        </a>

        <a class="jbl-1293 jbl-1426 jbl-985 jbl-181 jbl-1569 {{ request()->routeIs('cabang.sekolah*') ? 'text-amber-400' : 'text-slate-300 hover:text-white' }} transition-all duration-200 rounded-xl group relative" href="{{ route('cabang.sekolah') }}">
            @if(request()->routeIs('cabang.sekolah*'))<span class="jbl-91 jbl-213 jbl-880 jbl-1107 jbl-1236 jbl-199 jbl-1227" style="box-shadow: 0 0 15px rgba(251,211,141,0.5);"></span>@endif
            <span class="jbl-1475 jbl-1263 jbl-1320 jbl-1293 jbl-1426 jbl-141 jbl-1288 {{ request()->routeIs('cabang.sekolah*') ? 'bg-white/10' : 'bg-transparent group-hover:bg-white/10' }}">
                <span class="material-symbols-outlined jbl-390">school</span>
            </span>
            <span class="jbl-843 jbl-959 jbl-1462 jbl-422">Manajemen Sekolah</span>
        </a>

        <a class="jbl-1293 jbl-1426 jbl-985 jbl-181 jbl-1569 {{ request()->routeIs('cabang.jadwal*') ? 'text-amber-400' : 'text-slate-300 hover:text-white' }} transition-all duration-200 rounded-xl group relative" href="{{ route('cabang.jadwal') }}">
            @if(request()->routeIs('cabang.jadwal*'))<span class="jbl-91 jbl-213 jbl-880 jbl-1107 jbl-1236 jbl-199 jbl-1227" style="box-shadow: 0 0 15px rgba(251,211,141,0.5);"></span>@endif
            <span class="jbl-1475 jbl-1263 jbl-1320 jbl-1293 jbl-1426 jbl-141 jbl-1288 {{ request()->routeIs('cabang.jadwal*') ? 'bg-white/10' : 'bg-transparent group-hover:bg-white/10' }}">
                <span class="material-symbols-outlined jbl-390">event</span>
            </span>
            <span class="jbl-843 jbl-959 jbl-1462 jbl-422">Monitor Jadwal</span>
        </a>

        <a class="jbl-1293 jbl-1426 jbl-985 jbl-181 jbl-1569 {{ request()->routeIs('cabang.laporan*') ? 'text-amber-400' : 'text-slate-300 hover:text-white' }} transition-all duration-200 rounded-xl group relative" href="{{ route('cabang.laporan') }}">
            @if(request()->routeIs('cabang.laporan*'))<span class="jbl-91 jbl-213 jbl-880 jbl-1107 jbl-1236 jbl-199 jbl-1227" style="box-shadow: 0 0 15px rgba(251,211,141,0.5);"></span>@endif
            <span class="jbl-1475 jbl-1263 jbl-1320 jbl-1293 jbl-1426 jbl-141 jbl-1288 {{ request()->routeIs('cabang.laporan*') ? 'bg-white/10' : 'bg-transparent group-hover:bg-white/10' }}">
                <span class="material-symbols-outlined jbl-390">analytics</span>
            </span>
            <span class="jbl-843 jbl-959 jbl-1462 jbl-422">Laporan</span>
        </a>



        @endif
    </nav>
    <div class="jbl-181 jbl-603 jbl-81 jbl-1109 jbl-1117">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="jbl-1539 jbl-1293 jbl-1426 jbl-985 jbl-181 jbl-1569 jbl-189 jbl-1554 jbl-376 jbl-1288 jbl-1320 jbl-304">
                <span class="jbl-1475 jbl-1263 jbl-1320 jbl-1293 jbl-1426 jbl-141 jbl-1505 jbl-1284 jbl-1288">
                    <span class="material-symbols-outlined jbl-390">logout</span>
                </span>
                <span class="jbl-843 jbl-959 jbl-1462 jbl-422">Logout</span>
            </button>
        </form>
    </div>
</aside>

<header class="jbl-1293 jbl-1409 jbl-1426 jbl-388 jbl-181 jbl-821 jbl-1539 jbl-438 jbl-967 jbl-379 jbl-658 jbl-1400 jbl-1049 jbl-121 jbl-160 jbl-524 jbl-3 jbl-1288 jbl-476">
    <!-- Mobile Toggle (Integrated into Navbar) -->
    <button @click="open = !open" class="jbl-1393 jbl-984 jbl-518 jbl-1574 jbl-1077 jbl-1320 jbl-1288">
        <span class="material-symbols-outlined">menu</span>
    </button>

    <div class="jbl-1293 jbl-1426 jbl-701 jbl-177">
        @php
            $isSettingsPage = request()->routeIs('admin.settings*');
            $searchAction = $isSettingsPage ? route('admin.users') : route('admin.permohonan');
            $searchPlaceholder = $isSettingsPage ? 'Cari nama atau NIK pengguna...' : 'Cari data permohonan...';
        @endphp
        <form action="{{ $searchAction }}" method="GET" class="jbl-1109 jbl-1539 jbl-1451 jbl-304">
            <span class="material-symbols-outlined jbl-91 jbl-94 jbl-256 jbl-1167 jbl-13 jbl-1295 jbl-632 jbl-105">search</span>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ $searchPlaceholder }}" class="jbl-1539 jbl-1071 jbl-629 jbl-345 jbl-1134 jbl-333 jbl-121 jbl-1320 jbl-843 jbl-456 jbl-894 jbl-466 jbl-1029 jbl-85 jbl-1288 jbl-1088 jbl-495">
        </form>
    </div>
    <div class="jbl-1293 jbl-1426 jbl-701">
        <!-- Notifications -->
        @php
            $pendingCount = \App\Models\PengajuanLayanan::where('status', 'Menunggu')->count();
            $recentPending = \App\Models\PengajuanLayanan::where('status', 'Menunggu')
                ->orderBy('tanggal_pengajuan', 'desc')
                ->take(3)
                ->get();
        @endphp
        <div class="jbl-1109 jbl-304 jbl-964 jbl-518 jbl-1077 jbl-835 jbl-1288">
            <span class="material-symbols-outlined jbl-147 jbl-1474 jbl-632">notifications</span>
            @if($pendingCount > 0)
            <span class="jbl-91 jbl-268 jbl-347 jbl-1283 jbl-575 jbl-1121 jbl-835 jbl-11 jbl-364"></span>
            @endif
            
            <!-- Tooltip -->
            <div class="jbl-91 jbl-273 jbl-321 jbl-293 jbl-639 jbl-687 jbl-851 jbl-1053 jbl-640 jbl-1288 jbl-929">
                <div class="jbl-434 jbl-333 jbl-121 jbl-1320 jbl-884 jbl-156">
                    <p class="jbl-843 jbl-959 jbl-13 jbl-1462 jbl-1471 jbl-897">Notifikasi Sistem</p>
                <div class="jbl-1052">
                    @if($pendingCount > 0)
                        <a href="{{ route('admin.permohonan') }}" class="jbl-1293 jbl-985 jbl-582 jbl-518 jbl-538 jbl-632 jbl-442">
                            <div class="jbl-1283 jbl-575 jbl-396 jbl-835 jbl-1266 jbl-709"></div>
                            <div>
                                <p class="jbl-843 jbl-1574 jbl-959 jbl-1337">{{ $pendingCount }} Permohonan Menunggu</p>
                                <p class="jbl-1105 jbl-13 jbl-1213">Ada permohonan baru yang perlu diverifikasi.</p>
                            </div>
                        </a>
                        @foreach($recentPending as $p)
                            <a href="{{ route('admin.permohonan', ['search' => $p->nomor_tiket]) }}" class="jbl-1293 jbl-985 jbl-582 jbl-518 jbl-538 jbl-632 jbl-442">
                                <div class="jbl-1283 jbl-575 jbl-396 jbl-835 jbl-44 jbl-709"></div>
                                <div>
                                    <p class="jbl-843 jbl-1574 jbl-772 jbl-205">Layanan {{ $p->jenis_layanan }}</p>
                                    <p class="jbl-1105 jbl-13 jbl-1213">{{ $p->nomor_tiket }} - {{ $p->tanggal_pengajuan ? \Carbon\Carbon::parse($p->tanggal_pengajuan)->diffForHumans() : '' }}</p>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <div class="jbl-1401 jbl-674 jbl-843 jbl-147">
                            Semua tugas sudah selesai.
                        </div>
                    @endif
                </div>
                </div>
            </div>
        </div>

        <div class="jbl-1224 jbl-679 jbl-82 jbl-1215 jbl-807 jbl-565 jbl-432"></div>

        <!-- User Profile Dropdown -->
        <div class="jbl-1109 jbl-304">
            <button class="jbl-1293 jbl-1426 jbl-745 jbl-1515 jbl-582 jbl-1320 jbl-1288 jbl-333 jbl-516 jbl-235">
                <div class="jbl-1374 jbl-318 jbl-1224 jbl-1522 jbl-538 jbl-333 jbl-121 jbl-35 jbl-995 jbl-1293 jbl-1426 jbl-141">
                    @if(auth()->user()->foto_profil)
                        <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="Avatar" class="jbl-1539 jbl-758 jbl-724">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=003178&color=ffffff&bold=true" alt="Avatar" class="jbl-1539 jbl-758 jbl-724">
                    @endif
                </div>
                <div class="jbl-925 jbl-565 jbl-432">
                    <p class="jbl-1105 jbl-704 jbl-586 jbl-849 jbl-502">{{ auth()->user()->name }}</p>
                    <p class="jbl-838 jbl-829 jbl-959 jbl-184 jbl-1462 jbl-1471 jbl-1237">{{ auth()->user()->jabatan ?? auth()->user()->role }}</p>
                </div>
                <span class="material-symbols-outlined jbl-13 jbl-843 jbl-565 jbl-195">expand_more</span>
            </button>

            <!-- Dropdown Menu -->
            <div class="jbl-91 jbl-273 jbl-321 jbl-293 jbl-1395 jbl-687 jbl-851 jbl-1053 jbl-640 jbl-1288 jbl-929">
                <div class="jbl-434 jbl-333 jbl-121 jbl-1320 jbl-884 jbl-35">
                    <div class="jbl-156 jbl-1049 jbl-1153 jbl-1445">
                        <p class="jbl-843 jbl-959 jbl-849">{{ auth()->user()->name }}</p>
                    <p class="jbl-1105 jbl-147 jbl-1542">{{ auth()->user()->email }}</p>
                </div>
                <div class="jbl-518">
                    @if(in_array($roleType, ['cabang', 'cabang_dinas', 'petugas', 'petugas cabang']))
                    <a href="{{ route('cabang.profil') }}" class="jbl-1293 jbl-1426 jbl-985 jbl-525 jbl-345 jbl-843 jbl-959 jbl-1574 jbl-582 jbl-682 jbl-538 jbl-1288">
                        <span class="material-symbols-outlined jbl-105">person</span>
                        Profil Saya
                    </a>
                    @endif
                    @if(in_array($roleType, ['admin', 'admin pusat']))
                    <a href="{{ route('admin.profil') }}" class="jbl-1293 jbl-1426 jbl-985 jbl-525 jbl-345 jbl-843 jbl-959 jbl-1574 jbl-582 jbl-682 jbl-538 jbl-1288">
                        <span class="material-symbols-outlined jbl-105">person</span>
                        Profil Saya
                    </a>
                    <a href="{{ route('admin.profil.edit') }}" class="jbl-1293 jbl-1426 jbl-985 jbl-525 jbl-345 jbl-843 jbl-959 jbl-1574 jbl-582 jbl-682 jbl-538 jbl-1288">
                        <span class="material-symbols-outlined jbl-105">settings</span>
                        Pengaturan
                    </a>
                    @endif
                </div>
                <div class="jbl-518 jbl-1234 jbl-1153">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="jbl-1539 jbl-1293 jbl-1426 jbl-985 jbl-525 jbl-345 jbl-843 jbl-959 jbl-184 jbl-519 jbl-538 jbl-1288">
                            <span class="material-symbols-outlined jbl-105">logout</span>
                            Keluar Sistem
                        </button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="jbl-388 jbl-1539"></div>
</div>

<!-- Alpine.js for dropdowns and sidebar -->
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<style>
    .batik-pattern {
        background-image: url('/img/batik-pattern.png');
        background-size: 400px;
        background-position: center;
    }
</style>
