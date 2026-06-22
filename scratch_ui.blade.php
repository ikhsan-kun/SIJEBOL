@extends('layouts.admin')

@section('content')
<div class="p-6 lg:p-8 flex-1 w-full max-w-7xl mx-auto space-y-6">
    
    <!-- Header -->
    <div class="rounded-3xl p-6 lg:p-8 shadow-2xl shadow-blue-900/40 flex flex-col md:flex-row md:items-center justify-between gap-5 relative overflow-hidden bg-gradient-to-br from-slate-900 via-[#001e4a] to-[#003178] border border-blue-800/50">
        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-10 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-32 -mb-12 w-40 h-40 rounded-full bg-indigo-400 opacity-20 blur-2xl pointer-events-none"></div>
        
        <div class="relative z-10 flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center border border-white/30 shadow-inner shrink-0 hidden sm:flex">
                <span class="material-symbols-outlined text-white text-3xl">analytics</span>
            </div>
            <div>
                <div class="flex items-center gap-1.5 text-[10px] font-black text-blue-200 uppercase tracking-widest mb-1 opacity-90">
                    <span class="material-symbols-outlined text-[12px]" style="font-variation-settings:'FILL' 0">home</span>
                    <span>/</span>
                    <span>Cabang Dinas</span>
                    <span>/</span>
                    <span class="text-white">Laporan</span>
                </div>
                <h1 class="text-xl lg:text-3xl font-black text-white tracking-tight leading-none mb-1 drop-shadow-md">Laporan Pelayanan</h1>
                <p class="text-sm font-medium text-blue-100">Cabang Dinas Pendidikan Kota Tegal</p>
            </div>
        </div>
        
        <!-- Filter & Aksi -->
        <div class="relative z-10 shrink-0 w-full md:w-auto flex flex-col sm:flex-row gap-2">
            <form action="{{ route('cabang.laporan') }}" method="GET" class="flex gap-2">
                <input type="hidden" name="tab" value="{{ $tab }}">
                <select name="bulan" onchange="this.form.submit()" class="bg-white/10 border border-white/20 text-white rounded-xl text-sm px-3 py-2 outline-none focus:ring-2 focus:ring-white/50">
                    <option value="" class="text-slate-800">Semua Bulan</option>
                    @for($i=1; $i<=12; $i++)
                        <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }} class="text-slate-800">{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                    @endfor
                </select>
                <select name="tahun" onchange="this.form.submit()" class="bg-white/10 border border-white/20 text-white rounded-xl text-sm px-3 py-2 outline-none focus:ring-2 focus:ring-white/50">
                    @for($i=date('Y'); $i>=2024; $i--)
                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }} class="text-slate-800">{{ $i }}</option>
                    @endfor
                </select>
            </form>
            <a href="{{ route('cabang.cetakPdf', ['tab' => $tab, 'tahun' => $tahun, 'bulan' => $bulan]) }}" target="_blank" class="w-full sm:w-auto flex items-center justify-center gap-2 px-5 py-2.5 bg-white/10 border border-white/20 text-white hover:bg-white/20 rounded-xl text-sm font-bold transition-all">
                <span class="material-symbols-outlined text-sm">print</span> Cetak PDF
            </a>
            <a href="{{ request()->fullUrlWithQuery(['export' => 'excel']) }}" class="w-full sm:w-auto flex items-center justify-center gap-2 px-5 py-2.5 bg-white text-blue-700 hover:bg-blue-50 rounded-xl text-sm font-bold transition-all">
                <span class="material-symbols-outlined text-sm">download</span> Export Excel
            </a>
        </div>
    </div>

    <!-- Tabs Navigation -->
    <div class="flex overflow-x-auto border-b border-slate-200 hide-scrollbar">
        <a href="{{ route('cabang.laporan', ['tab' => 'per_sekolah', 'tahun' => $tahun, 'bulan' => $bulan]) }}" class="px-6 py-4 font-bold text-sm border-b-2 whitespace-nowrap transition-colors {{ $tab == 'per_sekolah' ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">
            Laporan Per Sekolah
        </a>
        <a href="{{ route('cabang.laporan', ['tab' => 'jadwal_jebol', 'tahun' => $tahun, 'bulan' => $bulan]) }}" class="px-6 py-4 font-bold text-sm border-b-2 whitespace-nowrap transition-colors {{ $tab == 'jadwal_jebol' ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">
            Laporan Jadwal JEBOL
        </a>
        <a href="{{ route('cabang.laporan', ['tab' => 'monitoring', 'tahun' => $tahun, 'bulan' => $bulan]) }}" class="px-6 py-4 font-bold text-sm border-b-2 whitespace-nowrap transition-colors {{ $tab == 'monitoring' ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">
            Laporan Monitoring Pengajuan
        </a>
    </div>

    <!-- Tab Content -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
        
        @if($tab == 'per_sekolah')
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 text-slate-600 font-bold uppercase text-[10px] tracking-wider">
                        <tr>
                            <th class="px-6 py-4 border-b">No</th>
                            <th class="px-6 py-4 border-b">Nama Sekolah</th>
                            <th class="px-6 py-4 border-b text-center">KTP-el</th>
                            <th class="px-6 py-4 border-b text-center">KIA</th>
                            <th class="px-6 py-4 border-b text-center">IKD</th>
                            <th class="px-6 py-4 border-b text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($school_stats as $index => $stat)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 text-slate-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-bold text-slate-800">{{ $stat->nama_sekolah }}</td>
                                <td class="px-6 py-4 text-center">{{ $stat->ktp }}</td>
                                <td class="px-6 py-4 text-center">{{ $stat->kia }}</td>
                                <td class="px-6 py-4 text-center">{{ $stat->ikd }}</td>
                                <td class="px-6 py-4 text-center font-bold text-blue-600">{{ $stat->total }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-6 py-8 text-center text-slate-500">Tidak ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        @elseif($tab == 'jadwal_jebol')
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 text-slate-600 font-bold uppercase text-[10px] tracking-wider">
                        <tr>
                            <th class="px-6 py-4 border-b">No</th>
                            <th class="px-6 py-4 border-b">Nama Sekolah</th>
                            <th class="px-6 py-4 border-b">Tanggal</th>
                            <th class="px-6 py-4 border-b">Lokasi</th>
                            <th class="px-6 py-4 border-b text-center">Jenis Layanan</th>
                            <th class="px-6 py-4 border-b text-center">Peserta</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($jadwal_jebol as $index => $j)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 text-slate-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-bold text-slate-800">{{ $j->nama_kegiatan }}</td>
                                <td class="px-6 py-4">{{ $j->tanggal_pelayanan ? \Carbon\Carbon::parse($j->tanggal_pelayanan)->translatedFormat('d F Y') : '-' }}</td>
                                <td class="px-6 py-4">{{ $j->lokasi }}</td>
                                <td class="px-6 py-4 text-center"><span class="px-2 py-1 bg-blue-50 text-blue-700 rounded text-xs font-bold">{{ $j->jenis_layanan }}</span></td>
                                <td class="px-6 py-4 text-center font-bold text-emerald-600">{{ $j->kuota }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-6 py-8 text-center text-slate-500">Tidak ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        @elseif($tab == 'monitoring')
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 text-slate-600 font-bold uppercase text-[10px] tracking-wider">
                        <tr>
                            <th class="px-6 py-4 border-b">No</th>
                            <th class="px-6 py-4 border-b">Nomor Pengajuan</th>
                            <th class="px-6 py-4 border-b">Sekolah</th>
                            <th class="px-6 py-4 border-b text-center">Jenis Layanan</th>
                            <th class="px-6 py-4 border-b text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($pengajuan_all as $index => $p)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 text-slate-500">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-mono font-medium text-slate-800">{{ $p->nomor_tiket }}</td>
                                <td class="px-6 py-4 font-bold text-slate-800">{{ $p->user->school ?? '-' }}</td>
                                <td class="px-6 py-4 text-center">{{ $p->jenis_layanan }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-2 py-1 rounded text-xs font-bold 
                                        {{ $p->status == 'selesai' ? 'bg-emerald-50 text-emerald-700' : '' }}
                                        {{ $p->status == 'pending' ? 'bg-amber-50 text-amber-700' : '' }}
                                        {{ $p->status == 'ditolak' ? 'bg-red-50 text-red-700' : '' }}
                                        {{ !in_array($p->status, ['selesai','pending','ditolak']) ? 'bg-blue-50 text-blue-700' : '' }}">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-6 py-8 text-center text-slate-500">Tidak ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif

    </div>
</div>
@endsection
