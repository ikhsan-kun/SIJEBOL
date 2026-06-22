<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Saran & Masukan Warga - SI JEBOL Admin</title>
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#003178",
                        "background": "#f8fafc",
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        body { 
            background-image: none !important; 
            background-color: #f8fafc !important; 
        }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="jbl-386 jbl-342 jbl-461">
    
    @include('partials.admin-sidebar-premium')

    <main class="jbl-967 jbl-461 jbl-1197" x-data="{ replyModalOpen: false, currentId: null, currentMasyarakat: '', currentSaran: '', currentResponse: '' }">
        <div class="jbl-746 jbl-1539 jbl-1342">
            
            @if(session('success'))
            <div class="jbl-156 jbl-313 jbl-416 jbl-1320 jbl-333 jbl-439 jbl-454 jbl-1293 jbl-1426 jbl-985 jbl-160">
                <span class="material-symbols-outlined">check_circle</span>
                {{ session('success') }}
            </div>
            @endif

            <!-- Premium Header -->
            <div class="jbl-59 jbl-1241 jbl-1361 jbl-1109 jbl-35" style="background-color: #003178; background-image: linear-gradient(rgba(0,49,120,0.9), rgba(0,49,120,0.9)), url('/images/batik-tegal-premium.jpg'); background-size: cover; border-bottom: 4px solid #f59e0b; box-shadow: 0 20px 40px rgba(0,49,120,0.15); border-radius: 32px;">
                <div class="jbl-91 jbl-1062 jbl-907 jbl-1382" style="background-image: url('/images/batik-tegal-premium.jpg'); background-size: 400px; opacity: 0.12; mix-blend-mode: luminosity;"></div>
                <div class="jbl-91 jbl-3 jbl-321 jbl-1365 jbl-1468 jbl-201 jbl-1106 jbl-835 jbl-44 jbl-6 jbl-1069"></div>
                <div class="jbl-91 jbl-588 jbl-833 jbl-116 jbl-981 jbl-794 jbl-835 jbl-1121 jbl-6 jbl-780"></div>
                
                <div class="jbl-1109 jbl-1117 jbl-1293 jbl-1541 jbl-744 jbl-133 jbl-1409 jbl-1051">
                    <div class="jbl-1293 jbl-1426 jbl-1485">
                        <div class="jbl-592 jbl-388 jbl-366 jbl-531 jbl-1149 jbl-1400 jbl-1406 jbl-1293 jbl-1426 jbl-141 jbl-333 jbl-811 jbl-1540">
                            <span class="material-symbols-outlined jbl-264 jbl-1509">chat</span>
                        </div>
                        <div>
                            <h1 class="jbl-47 jbl-586 jbl-1511 jbl-1361 jbl-1195">Saran & Masukan Warga</h1>
                            <p class="jbl-13 jbl-166 jbl-772">Tindak lanjuti komentar dan keluhan masyarakat</p>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Table View -->
            <div class="jbl-434 jbl-1406 jbl-160 jbl-333 jbl-121 jbl-35">
                <div class="jbl-375">
                    <table class="jbl-1539 jbl-1103 jbl-325">
                        <thead>
                            <tr class="jbl-1134 jbl-1049 jbl-121 jbl-147 jbl-843 jbl-1462 jbl-422 jbl-959">
                                <th class="jbl-156 jbl-374">Tanggal</th>
                                <th class="jbl-156 jbl-1118">Warga</th>
                                <th class="jbl-156">Isi Saran / Kritik</th>
                                <th class="jbl-156 jbl-1118">Lampiran</th>
                                <th class="jbl-156 jbl-374 jbl-1401">Status</th>
                                <th class="jbl-156 jbl-374 jbl-1401">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="jbl-486 jbl-1408 jbl-166">
                            @forelse($reviews as $review)
                            <tr class="jbl-582 jbl-632 jbl-53">
                                <td class="jbl-156 jbl-1574">
                                    {{ $review->tanggal_input ? $review->tanggal_input->format('d M Y') : '-' }}<br>
                                    <span class="jbl-843 jbl-13">{{ $review->tanggal_input ? $review->tanggal_input->format('H:i') : '' }}</span>
                                </td>
                                <td class="jbl-156">
                                    <div class="jbl-959 jbl-386">{{ $review->masyarakat ? ($review->masyarakat->name ?? $review->masyarakat->nama) : 'Anonim' }}</div>
                                    <div class="jbl-843 jbl-147">{{ $review->nik }}</div>
                                </td>
                                <td class="jbl-156">
                                    <div class="jbl-102 jbl-728 jbl-1320 jbl-333 jbl-1110 jbl-1429">
                                        <p class="jbl-431 jbl-424">"{{ $review->kritik_saran }}"</p>
                                    </div>
                                    @if($review->admin_response)
                                    <div class="jbl-313 jbl-728 jbl-1320 jbl-333 jbl-916">
                                        <p class="jbl-843 jbl-959 jbl-416 jbl-1195 jbl-1293 jbl-1426 jbl-602"><span class="material-symbols-outlined jbl-949">support_agent</span> Admin menjawab:</p>
                                        <p class="jbl-431 jbl-166">{{ $review->admin_response }}</p>
                                    </div>
                                    @endif
                                </td>
                                <td class="jbl-156">
                                    @if($review->foto_path)
                                        <a href="{{ asset('storage/' . $review->foto_path) }}" target="_blank" class="jbl-225 jbl-211 jbl-388 jbl-538 jbl-35 jbl-333 jbl-121 jbl-160 jbl-1172 jbl-729">
                                            <img src="{{ asset('storage/' . $review->foto_path) }}" alt="Lampiran" class="jbl-1539 jbl-758 jbl-724">
                                        </a>
                                    @else
                                        <span class="jbl-843 jbl-13">-</span>
                                    @endif
                                </td>
                                <td class="jbl-156 jbl-1401">
                                    <span class="jbl-262 jbl-145 jbl-843 jbl-959 jbl-1462 jbl-1300 jbl-934 {{ $review->status === 'followed_up' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                        {{ $review->status === 'followed_up' ? 'Ditindaklanjuti' : 'Belum Dibalas' }}
                                    </span>
                                </td>
                                <td class="jbl-156 jbl-1401">
                                    <button 
                                        @click="replyModalOpen = true; currentId = '{{ $review->id }}'; currentMasyarakat = '{{ addslashes($review->masyarakat ? ($review->masyarakat->name ?? $review->masyarakat->nama) : 'Anonim') }}'; currentSaran = '{{ addslashes($review->kritik_saran ?? '') }}'; currentResponse = '{{ addslashes($review->admin_response ?? '') }}';"
                                        class="jbl-823 jbl-1426 jbl-602 jbl-525 jbl-120 {{ $review->status === 'followed_up' ? 'bg-slate-100 hover:bg-slate-200 text-slate-700' : 'bg-blue-600 hover:bg-blue-700 text-white' }} font-semibold rounded-lg text-xs transition-colors">
                                        <span class="material-symbols-outlined jbl-166">{{ $review->status === 'followed_up' ? 'edit' : 'reply' }}</span> 
                                        {{ $review->status === 'followed_up' ? 'Edit' : 'Balas' }}
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="jbl-1241 jbl-1401 jbl-147 jbl-1293 jbl-1541 jbl-1426 jbl-141">
                                    <span class="material-symbols-outlined jbl-264 jbl-1429 jbl-189">speaker_notes_off</span>
                                    Belum ada masukan atau saran.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="jbl-156 jbl-1234 jbl-121">
                    {{ $reviews->links() }}
                </div>
            </div>

        </div>

        <!-- Alpine.js Modal -->
        <div x-show="replyModalOpen" style="display: none;" class="jbl-524 jbl-1062 jbl-929 jbl-685" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="jbl-1293 jbl-735 jbl-141 jbl-461 jbl-1060 jbl-181 jbl-680 jbl-1401 jbl-432 jbl-282">
                <div x-show="replyModalOpen" x-transition.opacity class="jbl-524 jbl-1062 jbl-1497 bg-opacity-75 jbl-729" aria-hidden="true" @click="replyModalOpen = false"></div>
                <span class="jbl-565 jbl-1417 jbl-906 jbl-926" aria-hidden="true">&#8203;</span>
                <div x-show="replyModalOpen" 
                     x-transition:enter="ease-out duration-300" 
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" 
                     class="jbl-934 jbl-1013 jbl-434 jbl-1406 jbl-1103 jbl-35 jbl-884 jbl-753 jbl-1288 jbl-1447 jbl-906 jbl-997 jbl-690 jbl-333 jbl-121">
                    <form :action="'{{ url('admin/kepuasan') }}/' + currentId" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="jbl-434 jbl-181 jbl-419 jbl-613 jbl-773 jbl-1154">
                            <div class="jbl-1421 jbl-954">
                                <div class="jbl-619 jbl-709 jbl-1293 jbl-1426 jbl-141 jbl-1040 jbl-27 jbl-835 jbl-1093 jbl-1059 jbl-4 jbl-289">
                                    <span class="material-symbols-outlined jbl-184">forum</span>
                                </div>
                                <div class="jbl-1360 jbl-1401 jbl-523 jbl-1193 jbl-581 jbl-1539">
                                    <h3 class="jbl-105 jbl-1192 jbl-959 jbl-849" id="modal-title">Tanggapi Masukan Warga</h3>
                                    <div class="jbl-1305 jbl-166 jbl-147 jbl-772">Warga: <span x-text="currentMasyarakat" class="jbl-386 jbl-959"></span></div>
                                    <div class="jbl-858 jbl-728 jbl-1134 jbl-1320 jbl-333 jbl-121">
                                        <p class="jbl-843 jbl-959 jbl-147 jbl-1462 jbl-1195">Masukan/Saran:</p>
                                        <p class="jbl-166 jbl-431 jbl-424" x-text="'&quot;' + currentSaran + '&quot;'"></p>
                                    </div>
                                    <div class="jbl-858">
                                        <label class="jbl-225 jbl-166 jbl-959 jbl-431 jbl-1429">Tanggapan Admin (Tindak Lanjut)</label>
                                        <textarea name="admin_response" x-model="currentResponse" rows="4" class="jbl-1539 jbl-831 jbl-1320 jbl-160 jbl-327 jbl-1231 jbl-1037 focus:ring-opacity-50 jbl-166" placeholder="Tuliskan tanggapan atau tindakan perbaikan di sini..." required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="jbl-1134 jbl-181 jbl-1569 jbl-1090 jbl-1421 jbl-172 jbl-1234 jbl-121">
                            <button type="submit" class="jbl-1539 jbl-823 jbl-141 jbl-1320 jbl-333 jbl-516 jbl-160 jbl-181 jbl-345 jbl-1266 jbl-210 jbl-772 jbl-1361 jbl-1470 jbl-605 jbl-28 jbl-200 jbl-632">
                                Simpan Tanggapan
                            </button>
                            <button type="button" @click="replyModalOpen = false" class="jbl-1360 jbl-1539 jbl-823 jbl-141 jbl-1320 jbl-333 jbl-831 jbl-160 jbl-181 jbl-345 jbl-434 jbl-210 jbl-772 jbl-431 jbl-582 jbl-523 jbl-605 jbl-28 jbl-200 jbl-632">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

