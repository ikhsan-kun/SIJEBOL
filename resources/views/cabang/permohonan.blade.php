<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Antrean Wilayah - SI JEBOL</title>
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#003178",
                        "primary-light": "#e0eaff",
                        "background": "#f8faff",
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            line-height: 1;
        }
        body { font-family: 'Inter', sans-serif; }

        /* Status pill animations */
        @keyframes pulse-soft {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.6; }
        }
        .animate-pulse-soft { animation: pulse-soft 2s ease-in-out infinite; }

        /* Table row hover */
        .table-row-hover:hover { background-color: #f8faff; }

        /* Modal transition */
        .modal-enter { animation: modalIn 0.2s ease-out; }
        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.96) translateY(8px); }
            to   { opacity: 1; transform: scale(1)   translateY(0);    }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        @media print {
            .no-print { display: none !important; }
            .print-only { display: block !important; }
            body { background: white !important; }
            .print-full-width { margin-left: 0 !important; width: 100% !important; max-width: 100% !important; }
            .shadow-sm, .shadow-md { box-shadow: none !important; border: 1px solid #e2e8f0 !important; }
        }
    </style>
</head>
<body class="bg-background text-on-surface jbl-342 jbl-461 jbl-1423">
    @include('partials.admin-sidebar-premium')

    <main class="jbl-9 jbl-461 jbl-1423">
        <!-- Sub Header -->
        <div class="jbl-725 jbl-674 jbl-1293 jbl-1409 jbl-1426 jbl-1049 jbl-121 jbl-425 jbl-637 jbl-846 jbl-988 jbl-292">
            <div class="jbl-1293 jbl-1426 jbl-701">
                <h2 class="jbl-390 jbl-959 jbl-184">Antrean Verifikasi Wilayah</h2>
                <span class="jbl-189">|</span>
                <p class="jbl-166 jbl-147 jbl-772">Kecamatan {{ auth()->user()->kecamatan }}</p>
                </div>
            <div class="jbl-1293 jbl-1426 jbl-985">
                <button class="jbl-1293 jbl-1426 jbl-745 jbl-181 jbl-345 jbl-434 jbl-333 jbl-121 jbl-538 jbl-843 jbl-959 jbl-1574 jbl-582 jbl-1288">
                    <span class="material-symbols-outlined jbl-105">filter_list</span>
                    Filter Status
                    </button>
                </div>
        </div>

        <div class="jbl-1241 jbl-1413 jbl-619 jbl-1351">
            <!-- Stats Row -->
            <div class="jbl-174 jbl-1019 jbl-1307 jbl-1051">
                <div class="jbl-434 jbl-746 jbl-1406 jbl-333 jbl-121 jbl-160 jbl-1109 jbl-35">
                    <div class="jbl-91 jbl-213 jbl-3 jbl-588 jbl-1236 jbl-1266"></div>
                    <p class="jbl-1105 jbl-586 jbl-13 jbl-1462 jbl-1471 jbl-1195">Total Antrean</p>
                    <h3 class="jbl-742 jbl-586 jbl-184">{{ $permohonan->count() }}</h3>
                </div>
                <div class="jbl-434 jbl-746 jbl-1406 jbl-333 jbl-121 jbl-160 jbl-1109 jbl-35">
                    <div class="jbl-91 jbl-213 jbl-3 jbl-588 jbl-1236 jbl-44"></div>
                    <p class="jbl-1105 jbl-586 jbl-13 jbl-1462 jbl-1471 jbl-1195">Belum Verifikasi</p>
                    <h3 class="jbl-742 jbl-586 jbl-302">{{ $permohonan->where('status', 'pending')->count() }}</h3>
                </div>
                <div class="jbl-434 jbl-746 jbl-1406 jbl-333 jbl-121 jbl-160 jbl-1109 jbl-35">
                    <div class="jbl-91 jbl-213 jbl-3 jbl-588 jbl-1236 jbl-1121"></div>
                    <p class="jbl-1105 jbl-586 jbl-13 jbl-1462 jbl-1471 jbl-1195">Sedang Diproses</p>
                    <h3 class="jbl-742 jbl-586 jbl-184">{{ $permohonan->where('status', 'diproses')->count() }}</h3>
                </div>
                <div class="jbl-434 jbl-746 jbl-1406 jbl-333 jbl-121 jbl-160 jbl-1109 jbl-35">
                    <div class="jbl-91 jbl-213 jbl-3 jbl-588 jbl-1236 jbl-1135"></div>
                    <p class="jbl-1105 jbl-586 jbl-13 jbl-1462 jbl-1471 jbl-1195">Selesai Terbit</p>
                    <h3 class="jbl-742 jbl-586 jbl-625">{{ $permohonan->where('status', 'selesai')->count() }}</h3>
                </div>
            </div>

            <!-- Table Card -->
            <div class="jbl-434 jbl-1406 jbl-333 jbl-121 jbl-160 jbl-35">
                <div class="jbl-375">
                    <table class="jbl-1539 jbl-1103 jbl-325">
                        <thead>
                            <tr class="jbl-1445 jbl-1370 jbl-586 jbl-13 jbl-1462 jbl-1471 jbl-1049 jbl-1319">
                                <th class="jbl-725 jbl-674">Nomor Tiket</th>
                                <th class="jbl-725 jbl-674">Data Pemohon</th>
                                <th class="jbl-725 jbl-674">Jenis Layanan</th>
                                <th class="jbl-725 jbl-674">Tgl Pengajuan</th>
                                <th class="jbl-725 jbl-674">Status</th>
                                <th class="jbl-725 jbl-674 jbl-925">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="jbl-486 jbl-1341">
                            @forelse($permohonan as $p)
                            <tr class="jbl-1504 jbl-1288 jbl-304">
                                <td class="jbl-725 jbl-371">
                                    <a href="{{ route('admin.permohonan.detail', $p->id) }}" class="jbl-843 jbl-586 jbl-184 jbl-176 jbl-840 jbl-145 jbl-140 hover:underline" style="color: inherit; text-decoration: none;">
                                        #{{ $p->nomor_tiket }}
                                    </a>
                                </td>
                                <td class="jbl-725 jbl-371">
                                    <div class="jbl-1293 jbl-1541">
                                        <span class="jbl-166 jbl-586 jbl-431">{{ $p->user->name }}</span>
                                        <span class="jbl-1370 jbl-959 jbl-13 jbl-422">{{ $p->user->nik }}</span>
                                    </div>
                                </td>
                                <td class="jbl-725 jbl-371">
                                    <div class="jbl-1293 jbl-1426 jbl-745">
                                        <span class="material-symbols-outlined jbl-13 jbl-166">description</span>
                                        <span class="jbl-843 jbl-959 jbl-1574">{{ $p->jenis_layanan }}</span>
                                    </div>
                                </td>
                                <td class="jbl-725 jbl-371">
                                    <div class="jbl-1293 jbl-1541">
                                        <span class="jbl-843 jbl-959 jbl-1574">{{ $p->created_at->format('d M Y') }}</span>
                                        <span class="jbl-1105 jbl-13 jbl-959 jbl-1462">{{ $p->created_at->format('H:i') }} WIB</span>
                                    </div>
                                </td>
                                <td class="jbl-725 jbl-371">
                                    @php
                                        $sClass = [
                                            'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                            'diproses' => 'bg-blue-50 text-blue-600 border-blue-100',
                                            'selesai' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                            'ditolak' => 'bg-blue-50 text-blue-600 border-blue-100'
                                        ][$p->status] ?? 'bg-slate-50 text-slate-600 border-slate-100';
                                    @endphp
                                    <span class="jbl-525 jbl-145 jbl-333 {{ $sClass }} jbl-1105 jbl-586 jbl-835 jbl-1462 jbl-1471">
                                        {{ $p->status == 'pending' ? 'menunggu' : $p->status }}
                                    </span>
                                </td>
                                <td class="jbl-725 jbl-371 jbl-925">
                                    <a href="{{ route('admin.permohonan.detail', $p->id) }}" class="jbl-823 jbl-1426 jbl-745 jbl-181 jbl-345 jbl-995 jbl-1574 jbl-1105 jbl-586 jbl-538 jbl-212 jbl-1288 jbl-333 jbl-121 jbl-1462">
                                        LIHAT DETAIL
                                        <span class="material-symbols-outlined jbl-166">visibility</span>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="jbl-725 jbl-828 jbl-1401">
                                    <div class="jbl-1293 jbl-1541 jbl-1426 jbl-745 jbl-694">
                                        <span class="material-symbols-outlined jbl-1396">inventory_2</span>
                                        <p class="jbl-166 jbl-586 jbl-1462 jbl-1471">Belum ada antrean masuk</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="jbl-746 jbl-1234 jbl-1153 jbl-478">
                    <p class="jbl-1105 jbl-586 jbl-13 jbl-1462 jbl-1471">Total: {{ $permohonan->count() }} Data Permohonan Wilayah</p>
                </div>
            </div>
        </div>

        <footer class="jbl-1081 jbl-1401">
            <p class="jbl-1105 jbl-959 jbl-189 jbl-1462 jbl-73">SI JEBOL • KOTA TEGAL</p>
        </footer>
    </main>
</body>
</html>

