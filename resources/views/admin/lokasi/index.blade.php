<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Kelola Lokasi JEBOL - SI JEBOL</title>
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
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="bg-background text-on-surface jbl-342 jbl-461">
    @include('partials.admin-sidebar-premium')

    <main class="jbl-967 jbl-461 jbl-156 jbl-158">
        <div class="jbl-1413 jbl-619 jbl-1342 jbl-471">
            
            @if(session('success'))
                <div class="jbl-156 jbl-313 jbl-333 jbl-439 jbl-416 jbl-1406 jbl-1293 jbl-1426 jbl-985 animate-in fade-in jbl-532">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span class="jbl-959 jbl-166">{{ session('success') }}</span>
                </div>
            @endif

            <div class="jbl-1293 jbl-1541 jbl-1352 jbl-1409 jbl-1046 jbl-1492 jbl-701">
                <div>
                    <h1 class="jbl-390 jbl-80 jbl-586 jbl-184">Pengelolaan Lokasi JEBOL</h1>
                    <p class="jbl-147 jbl-843 jbl-1175">Atur lokasi-lokasi pelayanan Jemput Bola Disdukcapil</p>
                </div>
                <button onclick="openModal()" class="jbl-1539 jbl-577 jbl-725 jbl-1569 jbl-1266 jbl-1361 jbl-1320 jbl-959 jbl-1293 jbl-1426 jbl-141 jbl-745 jbl-781 jbl-1288">
                    <span class="material-symbols-outlined jbl-166">add</span>
                    Tambah Lokasi
                </button>
            </div>

            <!-- Stats Overview -->
            <div class="jbl-174 jbl-1019 jbl-1333 jbl-701 jbl-776">
                <div class="jbl-434 jbl-156 jbl-1312 jbl-1406 jbl-333 jbl-121 jbl-160">
                    <p class="jbl-13 jbl-1105 jbl-586 jbl-1462 jbl-1471 jbl-1195">Total Lokasi</p>
                    <h3 class="jbl-742 jbl-237 jbl-586 jbl-184">{{ $lokasi->total() }}</h3>
                </div>
                <div class="jbl-434 jbl-156 jbl-1312 jbl-1406 jbl-333 jbl-121 jbl-160">
                    <p class="jbl-13 jbl-1105 jbl-586 jbl-1462 jbl-1471 jbl-1195">Lokasi Aktif</p>
                    <h3 class="jbl-742 jbl-237 jbl-586 jbl-625">{{ $lokasi->where('status', 'Aktif')->count() }}</h3>
                </div>
            </div>

            <!-- Search & Actions Bar -->
            <div class="jbl-1293 jbl-1541 jbl-627 jbl-1488 jbl-1409 jbl-701 jbl-434 jbl-156 jbl-1406 jbl-333 jbl-121 jbl-160">
                <form action="{{ route('admin.lokasi.index') }}" method="GET" class="jbl-1109 jbl-1539 jbl-1451 jbl-304">
                    <span class="material-symbols-outlined jbl-91 jbl-94 jbl-256 jbl-1167 jbl-13 jbl-1295 jbl-632 jbl-105">search</span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama lokasi, kecamatan..." class="jbl-1539 jbl-1071 jbl-1559 jbl-345 jbl-1134 jbl-333 jbl-121 jbl-1320 jbl-843 jbl-456 jbl-894 jbl-466 jbl-1029 jbl-85 jbl-1288">
                    @if(request('search'))
                        <a href="{{ route('admin.lokasi.index') }}" class="jbl-91 jbl-574 jbl-256 jbl-1167 jbl-13 jbl-427 jbl-632">
                            <span class="material-symbols-outlined jbl-166">close</span>
                        </a>
                    @endif
                </form>
            </div>

            <!-- Table -->
            <div class="jbl-434 jbl-333 jbl-121 jbl-1406 jbl-160 jbl-35">
                <div class="jbl-375">
                    <table class="jbl-1539 jbl-1103 jbl-114">
                        <thead>
                            <tr class="jbl-1105 jbl-586 jbl-13 jbl-1462 jbl-1471 jbl-1049 jbl-1319 jbl-1445">
                                <th class="jbl-181 jbl-674 jbl-27">No</th>
                                <th class="jbl-181 jbl-674">Nama Lokasi</th>
                                <th class="jbl-181 jbl-674">Kecamatan</th>
                                <th class="jbl-181 jbl-674">Alamat Lengkap</th>
                                <th class="jbl-181 jbl-674 jbl-1401">Kuota Peserta</th>
                                <th class="jbl-181 jbl-674">Status</th>
                                <th class="jbl-181 jbl-674 jbl-925">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="jbl-486 jbl-1341">
                            @forelse($lokasi as $i => $l)
                            <tr class="jbl-1504 jbl-632">
                                <td class="jbl-181 jbl-1569 jbl-843 jbl-586 jbl-13">{{ ($lokasi->currentPage() - 1) * $lokasi->perPage() + $loop->iteration }}</td>
                                <td class="jbl-181 jbl-1569">
                                    <p class="jbl-959 jbl-386 jbl-166">{{ $l->nama_lokasi }}</p>
                                </td>
                                <td class="jbl-181 jbl-1569">
                                    <p class="jbl-959 jbl-431 jbl-843">{{ $l->kecamatan }}</p>
                                    <p class="jbl-1105 jbl-147">{{ $l->kelurahan }}</p>
                                </td>
                                <td class="jbl-181 jbl-1569">
                                    <p class="jbl-843 jbl-1574 jbl-1542 jbl-1442">{{ $l->alamat_lengkap }}</p>
                                </td>
                                <td class="jbl-181 jbl-1569 jbl-1401 jbl-959 jbl-386">
                                    {{ $l->kuota_peserta }}
                                </td>
                                <td class="jbl-181 jbl-1569">
                                    @if($l->status == 'Aktif')
                                        <span class="jbl-840 jbl-738 jbl-1452 jbl-416 jbl-835 jbl-891 jbl-586 jbl-1462">Aktif</span>
                                    @else
                                        <span class="jbl-840 jbl-738 jbl-585 jbl-1523 jbl-835 jbl-891 jbl-586 jbl-1462">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="jbl-181 jbl-1569 jbl-925">
                                    <button onclick="openEditModal({{ $l->id }}, '{{ addslashes($l->nama_lokasi) }}', '{{ addslashes($l->kecamatan) }}', '{{ addslashes($l->kelurahan) }}', '{{ addslashes($l->alamat_lengkap) }}', {{ $l->kuota_peserta }}, '{{ $l->status }}')" class="jbl-650 jbl-184 jbl-519 jbl-538">
                                        <span class="material-symbols-outlined jbl-166">edit</span>
                                    </button>
                                    <form action="{{ route('admin.lokasi.destroy', $l->id) }}" method="POST" class="jbl-1189" onsubmit="return confirm('Hapus lokasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="jbl-650 jbl-677 jbl-1530 jbl-538">
                                            <span class="material-symbols-outlined jbl-166">delete</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="jbl-725 jbl-828 jbl-1401 jbl-13 jbl-424 jbl-166">Belum ada data lokasi JEBOL.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="jbl-156 jbl-1234 jbl-1319">
                    {{ $lokasi->links() }}
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Form -->
    <div id="modalForm" class="jbl-524 jbl-1062 jbl-1469 jbl-565">
        <div class="jbl-91 jbl-1062 jbl-1085 jbl-637" onclick="closeModal()"></div>
        <div class="jbl-91 jbl-256 jbl-914 jbl-1398 jbl-1167 jbl-1539 jbl-768 jbl-181">
            <div class="jbl-434 jbl-1406 jbl-641 jbl-35">
                <div class="jbl-156 jbl-1312 jbl-1049 jbl-1319 jbl-1293 jbl-1409 jbl-1426">
                    <h3 id="modalTitle" class="jbl-210 jbl-365 jbl-586 jbl-184 jbl-1462 jbl-1471">Tambah Lokasi</h3>
                    <button onclick="closeModal()" class="jbl-13 jbl-1483 jbl-632">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <form id="lokasiForm" action="{{ route('admin.lokasi.store') }}" method="POST" class="jbl-156 jbl-1312 jbl-285">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    
                    <div>
                        <label class="jbl-1105 jbl-586 jbl-13 jbl-1462 jbl-1471 jbl-1195 jbl-225">Nama Lokasi (Gedung/Sekolah/Balai)</label>
                        <input type="text" name="nama_lokasi" id="nama_lokasi" required class="jbl-1539 jbl-1134 jbl-121 jbl-1320 jbl-166 jbl-894 jbl-466">
                    </div>
                    <div class="jbl-174 jbl-1576 jbl-701">
                        <div>
                            <label class="jbl-1105 jbl-586 jbl-13 jbl-1462 jbl-1471 jbl-1195 jbl-225">Kecamatan</label>
                            <input type="text" name="kecamatan" id="kecamatan" required class="jbl-1539 jbl-1134 jbl-121 jbl-1320 jbl-166 jbl-894 jbl-466">
                        </div>
                        <div>
                            <label class="jbl-1105 jbl-586 jbl-13 jbl-1462 jbl-1471 jbl-1195 jbl-225">Kelurahan</label>
                            <input type="text" name="kelurahan" id="kelurahan" required class="jbl-1539 jbl-1134 jbl-121 jbl-1320 jbl-166 jbl-894 jbl-466">
                        </div>
                    </div>
                    <div>
                        <label class="jbl-1105 jbl-586 jbl-13 jbl-1462 jbl-1471 jbl-1195 jbl-225">Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" id="alamat_lengkap" rows="3" required class="jbl-1539 jbl-1134 jbl-121 jbl-1320 jbl-166 jbl-894 jbl-466"></textarea>
                    </div>
                    <div class="jbl-174 jbl-1576 jbl-701">
                        <div>
                            <label class="jbl-1105 jbl-586 jbl-13 jbl-1462 jbl-1471 jbl-1195 jbl-225">Kuota Peserta</label>
                            <input type="number" name="kuota_peserta" id="kuota_peserta" required min="0" value="0" class="jbl-1539 jbl-1134 jbl-121 jbl-1320 jbl-166 jbl-894 jbl-466">
                        </div>
                        <div>
                            <label class="jbl-1105 jbl-586 jbl-13 jbl-1462 jbl-1471 jbl-1195 jbl-225">Status Lokasi</label>
                            <select name="status" id="status" class="jbl-1539 jbl-1134 jbl-121 jbl-1320 jbl-166 jbl-894 jbl-466">
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="jbl-1060 jbl-1293 jbl-985">
                        <button type="button" onclick="closeModal()" class="jbl-177 jbl-1569 jbl-995 jbl-1574 jbl-1320 jbl-959 jbl-166 jbl-212 jbl-632">Batal</button>
                        <button type="submit" class="jbl-177 jbl-1569 jbl-1266 jbl-1361 jbl-1320 jbl-959 jbl-166 jbl-1470 jbl-632">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('modalTitle').innerText = 'Tambah Lokasi';
            document.getElementById('lokasiForm').action = "{{ route('admin.lokasi.store') }}";
            document.getElementById('formMethod').value = 'POST';
            
            document.getElementById('nama_lokasi').value = '';
            document.getElementById('kecamatan').value = '';
            document.getElementById('kelurahan').value = '';
            document.getElementById('alamat_lengkap').value = '';
            document.getElementById('kuota_peserta').value = '0';
            document.getElementById('status').value = 'Aktif';

            document.getElementById('modalForm').classList.remove('hidden');
        }

        function openEditModal(id, nama, kecamatan, kelurahan, alamat, kuota, status) {
            document.getElementById('modalTitle').innerText = 'Edit Lokasi';
            document.getElementById('lokasiForm').action = `/admin/lokasi/${id}`;
            document.getElementById('formMethod').value = 'PUT';
            
            document.getElementById('nama_lokasi').value = nama;
            document.getElementById('kecamatan').value = kecamatan;
            document.getElementById('kelurahan').value = kelurahan;
            document.getElementById('alamat_lengkap').value = alamat;
            document.getElementById('kuota_peserta').value = kuota;
            document.getElementById('status').value = status;

            document.getElementById('modalForm').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modalForm').classList.add('hidden');
        }
    </script>
</body>
</html>

