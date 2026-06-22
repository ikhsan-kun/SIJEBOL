<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Master Data - SI JEBOL Admin</title>
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            background-color: #f8fafc !important; 
        }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        .table-row-hover:hover { background-color: #f8fafc; }
        
        .main-content {
            flex-grow: 1;
            margin-left: 256px;
            padding: 40px 48px 60px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            min-width: 0;
            transition: all 0.3s ease;
        }
        @media (max-width: 1023px) {
            .main-content {
                margin-left: 0;
                padding: 24px 20px 40px;
            }
        }
        /* Hero Banner */
        .dashboard-hero {
            margin: -24px -48px 40px -48px;
            border-radius: 0;
        }
        @media (max-width: 1023px) {
            .dashboard-hero {
                margin: -16px -20px 40px -20px;
            }
        }
    </style>
</head>
<body class="jbl-386 jbl-342 jbl-461">
    
    @include('partials.admin-sidebar-premium')

    @php
        $unifiedData = [];
        $kecamatanMap = [
            'TEGAL BARAT' => '01',
            'TEGAL TIMUR' => '02',
            'TEGAL SELATAN' => '03',
            'MARGADANA' => '04',
        ];

        $kategoriLayanan = 'Jenis Layanan';
        $kategoriStatus = 'Status Layanan';
        $kategoriPetugas = 'Pengguna';

        $kelIndexMap = [];
        $kelurahanCol = collect($kelurahan);

        foreach ($kecamatan as $kecItem) {
            $kodeKec = $kecamatanMap[strtoupper($kecItem->nama)] ?? '00';
            $unifiedData[] = [
                'id' => $kecItem->id,
                'kode' => 'KEC' . str_pad($kodeKec, 3, '0', STR_PAD_LEFT),
                'nama' => 'Kecamatan ' . $kecItem->nama,
                'kategori' => 'Kecamatan',
                'keterangan' => 'Wilayah Kecamatan ' . $kecItem->nama,
                'status' => $kecItem->status,
                'type' => 'Kecamatan',
                'raw_data' => $kecItem
            ];

            // Append its Kelurahans right below it
            $kels = $kelurahanCol->filter(function($k) use ($kecItem) {
                // Match with or without 'Kecamatan ' prefix to be safe
                return str_ireplace(['Kecamatan ', 'Kec. '], '', $k->kecamatan_nama) == str_ireplace(['Kecamatan ', 'Kec. '], '', $kecItem->nama);
            });

            foreach ($kels as $item) {
                if (!isset($kelIndexMap[$item->kecamatan_nama])) {
                    $kelIndexMap[$item->kecamatan_nama] = 1;
                }
                $kodeKel = $kelIndexMap[$item->kecamatan_nama]++;
                $unifiedData[] = [
                    'id' => $item->id,
                    'kode' => 'KEL' . str_pad($kodeKec, 2, '0', STR_PAD_LEFT) . str_pad($kodeKel, 2, '0', STR_PAD_LEFT),
                    'nama' => 'Kelurahan ' . $item->nama,
                    'kategori' => 'Kelurahan',
                    'keterangan' => 'Kelurahan ' . $item->nama . ', Kec. ' . $item->kecamatan_nama,
                    'status' => $item->status,
                    'type' => 'Kelurahan',
                    'raw_data' => $item
                ];
                // Remove from collection so we don't duplicate
                $kelurahanCol = $kelurahanCol->reject(fn($v) => $v->id == $item->id);
            }
        }

        // Any remaining Kelurahans without matching Kecamatan
        foreach ($kelurahanCol as $item) {
            $kodeKec = $kecamatanMap[strtoupper($item->kecamatan_nama)] ?? '00';
            if (!isset($kelIndexMap[$item->kecamatan_nama])) {
                $kelIndexMap[$item->kecamatan_nama] = 1;
            }
            $kodeKel = $kelIndexMap[$item->kecamatan_nama]++;
            $unifiedData[] = [
                'id' => $item->id,
                'kode' => 'KEL' . str_pad($kodeKec, 2, '0', STR_PAD_LEFT) . str_pad($kodeKel, 2, '0', STR_PAD_LEFT),
                'nama' => 'Kelurahan ' . $item->nama,
                'kategori' => 'Kelurahan',
                'keterangan' => 'Kelurahan ' . $item->nama . ', Kec. ' . $item->kecamatan_nama,
                'status' => $item->status,
                'type' => 'Kelurahan',
                'raw_data' => $item
            ];
        }

        // Jenis Layanan
        foreach ($jenisLayanan ?? [] as $index => $item) {
            $unifiedData[] = [
                'id' => $item->id,
                'kode' => 'LAY' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'nama' => $item->nama,
                'kategori' => $kategoriLayanan,
                'keterangan' => $item->deskripsi ?? '-',
                'status' => $item->status,
                'type' => 'Jenis Layanan',
                'raw_data' => $item
            ];
        }
        $wilayahCount = count($kecamatan) + count($kelurahan);
        $layananCount = count($jenisLayanan);
        $totalData = count($unifiedData);
    @endphp

    <main class="main-content jbl-265" style="padding-top: 0;" x-data="{ 
        currentTab: 'Semua',
        currentTabModal: 'Kecamatan',
        showAddModal: false,
        showEditModal: false,
        editData: null,
        searchQuery: '',
        filterStatus: 'Semua',
        currentPage: 1,
        itemsPerPage: 8,
        allData: {{ json_encode($unifiedData) }},
        
        get filteredData() {
            return this.allData.filter(item => {
                const matchSearch = item.nama.toLowerCase().includes(this.searchQuery.toLowerCase()) || 
                                    item.kode.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                                    (item.keterangan && item.keterangan.toLowerCase().includes(this.searchQuery.toLowerCase()));
                const matchKategori = this.currentTab === 'Semua' || item.kategori === this.currentTab;
                const matchStatus = this.filterStatus === 'Semua' || item.status === this.filterStatus;
                return matchSearch && matchKategori && matchStatus;
            });
        },
        
        get paginatedData() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            const end = start + this.itemsPerPage;
            return this.filteredData.slice(start, end);
        },
        
        get totalPages() {
            return Math.ceil(this.filteredData.length / this.itemsPerPage) || 1;
        },
        
        resetFilter() {
            this.searchQuery = '';
            this.currentTab = 'Semua';
            this.filterStatus = 'Semua';
            this.currentPage = 1;
        },
        
        changeTab(tab) {
            this.currentTab = tab;
            this.currentPage = 1;
        },

        initChart() {
            const ctx = document.getElementById('ringkasanChart');
            if (ctx) {
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Kecamatan', 'Kelurahan', 'Jenis Layanan'],
                        datasets: [{
                            data: [{{ count($kecamatan) }}, {{ count($kelurahan) }}, {{ $layananCount }}],
                            backgroundColor: ['#3b82f6', '#10b981', '#f59e0b'],
                            borderWidth: 0,
                            cutout: '75%'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }
        }
    }" x-init="initChart()">
        
        <div class="jbl-1539 jbl-1507">
            <!-- Hero Header -->
            <div class="jbl-59 jbl-822 jbl-1168">
                <div class="jbl-1536 jbl-1169 jbl-903 jbl-808 jbl-1440 jbl-746 jbl-197 jbl-1293 jbl-1541 jbl-141 jbl-1109 jbl-35 jbl-1335">
                    <!-- Background Pattern -->
                    <div class="jbl-91 jbl-1062 jbl-907" style="background-image: url('{{ asset('images/batik-tegal-premium.jpg') }}'); background-size: 400px; opacity: 0.12; mix-blend-mode: luminosity;"></div>
                    
                    <!-- Decorative Elements -->
                    <div class="jbl-91 jbl-3 jbl-321 jbl-1365 jbl-1468 jbl-201 jbl-1106 jbl-835 jbl-44 jbl-6 jbl-1069"></div>
                    <div class="jbl-91 jbl-588 jbl-833 jbl-116 jbl-981 jbl-794 jbl-835 jbl-1518 jbl-694 jbl-780"></div>
                    
                    <div class="jbl-1109 jbl-1117 jbl-1293 jbl-1426 jbl-1485">
                        <div class="jbl-1184 jbl-1021 jbl-675 jbl-1187 jbl-366 jbl-362 jbl-153 jbl-1562 jbl-1406 jbl-1293 jbl-1426 jbl-141 jbl-333 jbl-52 jbl-1001 jbl-709 jbl-304">
                            <span class="material-symbols-outlined jbl-47 jbl-862 jbl-557 jbl-1182 jbl-75 jbl-119 jbl-476">database</span>
                        </div>
                        <div>
                            <h1 class="jbl-742 jbl-1076 jbl-1332 jbl-586 jbl-1466 jbl-340 jbl-1536 jbl-774 jbl-1514 jbl-589 jbl-1511 jbl-1195 jbl-1131">Master Data</h1>
                            <p class="jbl-622 jbl-843 jbl-853 jbl-772">Kelola data utama sistem SI JEBOL Kota Tegal</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Widgets -->
            <div class="jbl-174 jbl-1019 jbl-868 jbl-171 jbl-701 jbl-454">
                <div class="jbl-434 jbl-1406 jbl-1545 jbl-333 jbl-121 jbl-160 jbl-1293 jbl-1426 jbl-701">
                    <div class="jbl-1184 jbl-1021 jbl-835 jbl-176 jbl-184 jbl-1293 jbl-1426 jbl-141 jbl-795">
                        <span class="material-symbols-outlined jbl-47">location_city</span>
                    </div>
                    <div>
                        <p class="jbl-147 jbl-166 jbl-1195">Total Kecamatan</p>
                        <h3 class="jbl-742 jbl-586 jbl-386 jbl-502">{{ count($kecamatan) }}</h3>
                        <p class="jbl-901 jbl-843 jbl-1397 jbl-1237">Aktif</p>
                    </div>
                </div>
                <div class="jbl-434 jbl-1406 jbl-1545 jbl-333 jbl-121 jbl-160 jbl-1293 jbl-1426 jbl-701">
                    <div class="jbl-1184 jbl-1021 jbl-835 jbl-176 jbl-184 jbl-1293 jbl-1426 jbl-141 jbl-795">
                        <span class="material-symbols-outlined jbl-47">home</span>
                    </div>
                    <div>
                        <p class="jbl-147 jbl-166 jbl-1195">Total Kelurahan</p>
                        <h3 class="jbl-742 jbl-586 jbl-386 jbl-502">{{ count($kelurahan) }}</h3>
                        <p class="jbl-901 jbl-843 jbl-1397 jbl-1237">Aktif</p>
                    </div>
                </div>
                <div class="jbl-434 jbl-1406 jbl-1545 jbl-333 jbl-121 jbl-160 jbl-1293 jbl-1426 jbl-701">
                    <div class="jbl-1184 jbl-1021 jbl-835 jbl-176 jbl-184 jbl-1293 jbl-1426 jbl-141 jbl-795">
                        <span class="material-symbols-outlined jbl-47">list_alt</span>
                    </div>
                    <div>
                        <p class="jbl-147 jbl-166 jbl-1195">Total Jenis Layanan</p>
                        <h3 class="jbl-742 jbl-586 jbl-386 jbl-502">{{ count($jenisLayanan) }}</h3>
                        <p class="jbl-901 jbl-843 jbl-1397 jbl-1237">Aktif</p>
                    </div>
                </div>
                <div class="jbl-434 jbl-1406 jbl-1545 jbl-333 jbl-121 jbl-160 jbl-1293 jbl-1426 jbl-701">
                    <div class="jbl-1184 jbl-1021 jbl-835 jbl-176 jbl-184 jbl-1293 jbl-1426 jbl-141 jbl-795">
                        <span class="material-symbols-outlined jbl-47">group</span>
                    </div>
                    <div>
                        <p class="jbl-147 jbl-166 jbl-1195">Total Pengguna</p>
                        <h3 class="jbl-742 jbl-586 jbl-386 jbl-502">{{ count($users) }}</h3>
                        <p class="jbl-901 jbl-843 jbl-1397 jbl-1237">Aktif</p>
                    </div>
                </div>
            </div>

            <!-- Global Filter Bar -->
            <div class="jbl-434 jbl-1406 jbl-156 jbl-333 jbl-121 jbl-160 jbl-1293 jbl-358 jbl-701 jbl-735 jbl-454">
                <div class="jbl-1109 jbl-177 jbl-696">
                    <span class="material-symbols-outlined jbl-91 jbl-94 jbl-256 jbl-1167 jbl-13 jbl-900">search</span>
                    <input type="text" x-model="searchQuery" @input="currentPage = 1" placeholder="Cari data..." class="jbl-1539 jbl-1071 jbl-629 jbl-345 jbl-333 jbl-121 jbl-538 jbl-166 jbl-1574 jbl-456 jbl-952 jbl-327 jbl-85 jbl-1020">
                </div>
                <div class="jbl-1539 jbl-312">
                    <label class="jbl-225 jbl-843 jbl-147 jbl-772 jbl-1195">Kategori Data</label>
                    <select x-model="currentTab" @change="currentPage = 1" class="jbl-1539 jbl-1338 jbl-333 jbl-121 jbl-538 jbl-345 jbl-525 jbl-166 jbl-1574 jbl-456 jbl-952 jbl-327 jbl-85 jbl-434">
                        <option value="Semua">Semua</option>
                        <option value="Kecamatan">Kecamatan</option>
                        <option value="Kelurahan">Kelurahan</option>
                        <option value="Jenis Layanan">Jenis Layanan</option>
                        <option value="Status Layanan">Status Layanan</option>
                        <option value="Pengguna">Pengguna</option>
                    </select>
                </div>
                <div class="jbl-1539 jbl-312">
                    <label class="jbl-225 jbl-843 jbl-147 jbl-772 jbl-1195">Status</label>
                    <select x-model="filterStatus" @change="currentPage = 1" class="jbl-1539 jbl-1338 jbl-333 jbl-121 jbl-538 jbl-345 jbl-525 jbl-166 jbl-1574 jbl-456 jbl-952 jbl-327 jbl-85 jbl-434">
                        <option value="Semua">Semua</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>
                <button @click="resetFilter()" class="jbl-1539 jbl-312 jbl-181 jbl-345 jbl-333 jbl-935 jbl-184 jbl-538 jbl-166 jbl-772 jbl-519 jbl-632 jbl-1293 jbl-1426 jbl-141 jbl-745">
                    <span class="material-symbols-outlined jbl-1203">refresh</span> Reset Filter
                </button>
            </div>

            <!-- 2-Column Layout Grid -->
            <div class="jbl-174 jbl-1019 jbl-986 jbl-1051">
                
                <!-- Main Content (Menu + Table) -->
                <div class="jbl-1091 jbl-1293 jbl-1541 jbl-1051">
                    <!-- Kategori Data Menu -->
                    <div class="jbl-434 jbl-1406 jbl-333 jbl-121 jbl-160 jbl-156">
                        <nav class="jbl-1293 jbl-375 jbl-290 jbl-745 hide-scroll">
                            <button @click="changeTab('Kecamatan')" :class="currentTab === 'Kecamatan' || currentTab === 'Semua' ? 'bg-blue-50 text-blue-600 border-b-4 border-blue-600' : 'text-slate-600 hover:bg-slate-50 border-b-4 border-transparent'" class="jbl-709 jbl-1293 jbl-1426 jbl-1409 jbl-1051 jbl-181 jbl-1569 jbl-1057 jbl-632">
                                <div class="jbl-1293 jbl-1426 jbl-985">
                                    <span class="material-symbols-outlined jbl-390">map</span>
                                    <div class="jbl-1103">
                                        <div class="jbl-166 jbl-959">Kecamatan</div>
                                        <div class="jbl-1105 jbl-13 jbl-565 jbl-432">Kecamatan Kota</div>
                                    </div>
                                </div>
                                <span class="jbl-1093 jbl-1174 jbl-843 jbl-738 jbl-840 jbl-1300 jbl-959">{{ count($kecamatan) }}</span>
                            </button>
                            
                            <button @click="changeTab('Kelurahan')" :class="currentTab === 'Kelurahan' ? 'bg-blue-50 text-blue-600 border-b-4 border-blue-600' : 'text-slate-600 hover:bg-slate-50 border-b-4 border-transparent'" class="jbl-709 jbl-1293 jbl-1426 jbl-1409 jbl-1051 jbl-181 jbl-1569 jbl-1057 jbl-632">
                                <div class="jbl-1293 jbl-1426 jbl-985">
                                    <span class="material-symbols-outlined jbl-390">pin_drop</span>
                                    <div class="jbl-1103">
                                        <div class="jbl-166 jbl-959">Kelurahan</div>
                                        <div class="jbl-1105 jbl-13 jbl-565 jbl-432">Kelurahan Kota</div>
                                    </div>
                                </div>
                                <span class="jbl-1093 jbl-1174 jbl-843 jbl-738 jbl-840 jbl-1300 jbl-959">{{ count($kelurahan) }}</span>
                            </button>
                            
                            <button @click="changeTab('Jenis Layanan')" :class="currentTab === 'Jenis Layanan' ? 'bg-blue-50 text-blue-600 border-b-4 border-blue-600' : 'text-slate-600 hover:bg-slate-50 border-b-4 border-transparent'" class="jbl-709 jbl-1293 jbl-1426 jbl-1409 jbl-1051 jbl-181 jbl-1569 jbl-1057 jbl-632">
                                <div class="jbl-1293 jbl-1426 jbl-985">
                                    <span class="material-symbols-outlined jbl-390">list_alt</span>
                                    <div class="jbl-1103">
                                        <div class="jbl-166 jbl-959">Jenis Layanan</div>
                                        <div class="jbl-1105 jbl-13 jbl-565 jbl-432">Layanan Kependudukan</div>
                                    </div>
                                </div>
                                <span class="jbl-1093 jbl-1174 jbl-843 jbl-738 jbl-840 jbl-1300 jbl-959">{{ count($jenisLayanan) }}</span>
                            </button>
                            </nav>
                    </div>

                    <!-- Table Section -->
                    <div class="jbl-434 jbl-1406 jbl-333 jbl-121 jbl-160 jbl-35 jbl-1293 jbl-1541 jbl-758">
                        <!-- Add Button Header (dynamic) -->
                        <div class="jbl-156 jbl-1049 jbl-1319 jbl-1293 jbl-1171 jbl-434">
                            <template x-if="['Kecamatan', 'Kelurahan', 'Semua'].includes(currentTab)">
                                <div class="jbl-1293 jbl-745">
                                    <button x-show="currentTab === 'Kecamatan' || currentTab === 'Semua'" @click="currentTabModal = 'Kecamatan'; showAddModal = true" class="jbl-176 jbl-184 jbl-333 jbl-935 jbl-930 jbl-772 jbl-538 jbl-525 jbl-120 jbl-843 jbl-632 jbl-1293 jbl-1426 jbl-602 jbl-160">
                                        <span class="material-symbols-outlined jbl-957">add</span> Kecamatan
                                    </button>
                                    <button x-show="currentTab === 'Kelurahan' || currentTab === 'Semua'" @click="currentTabModal = 'Kelurahan'; showAddModal = true" class="jbl-176 jbl-184 jbl-333 jbl-935 jbl-930 jbl-772 jbl-538 jbl-525 jbl-120 jbl-843 jbl-632 jbl-1293 jbl-1426 jbl-602 jbl-160">
                                        <span class="material-symbols-outlined jbl-957">add</span> Kelurahan
                                    </button>
                                </div>
                            </template>
                            <template x-if="!['Kecamatan', 'Kelurahan', 'Semua'].includes(currentTab)">
                                <button @click="currentTabModal = currentTab; showAddModal = true" class="jbl-176 jbl-184 jbl-333 jbl-935 jbl-930 jbl-772 jbl-538 jbl-525 jbl-120 jbl-843 jbl-632 jbl-1293 jbl-1426 jbl-602 jbl-160">
                                    <span class="material-symbols-outlined jbl-957">add</span> Tambah <span x-text="currentTab"></span>
                                </button>
                            </template>
                        </div>

                        <div class="jbl-375 jbl-177 jbl-1476">
                            <table class="jbl-1539 jbl-1103 jbl-166 jbl-1574">
                                <thead class="jbl-434 jbl-386 jbl-959 jbl-1049 jbl-1319">
                                    <tr>
                                        <th class="jbl-181 jbl-674 jbl-1306 jbl-1401">No</th>
                                        <th class="jbl-181 jbl-674 jbl-1306">Kode</th>
                                        <th class="jbl-181 jbl-674 jbl-1306">Nama Data</th>
                                        <th class="jbl-181 jbl-674 jbl-1306">Kategori</th>
                                        <th class="jbl-181 jbl-674 jbl-1306">Keterangan</th>
                                        <th class="jbl-181 jbl-674 jbl-1306 jbl-1401">Status</th>
                                        <th class="jbl-181 jbl-674 jbl-1306 jbl-1401">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="jbl-486 jbl-1408">
                                    <template x-for="(item, index) in paginatedData" :key="item.id + item.type">
                                        <tr class="jbl-632" :class="item.type === 'Kecamatan' ? 'bg-blue-50/50 hover:bg-blue-100/50' : 'hover:bg-slate-50'">
                                            <td class="jbl-181 jbl-1569 jbl-1401" x-text="(currentPage - 1) * itemsPerPage + index + 1"></td>
                                            <td class="jbl-181 jbl-1569 jbl-772 jbl-431" x-text="item.kode"></td>
                                            <td class="jbl-181 jbl-1569 jbl-772 jbl-849" x-text="item.nama"></td>
                                            <td class="jbl-181 jbl-1569 jbl-147 jbl-843" x-text="item.kategori"></td>
                                            <td class="jbl-181 jbl-1569 jbl-147 jbl-843 jbl-250 jbl-1542" x-text="item.keterangan" :title="item.keterangan"></td>
                                            <td class="jbl-181 jbl-1569 jbl-1401">
                                                <span :class="item.status === 'Aktif' ? 'bg-emerald-50 text-emerald-600 border-emerald-200' : 'bg-red-50 text-red-600 border-red-200'" class="jbl-840 jbl-738 jbl-333 jbl-140 jbl-1370 jbl-959" x-text="item.status"></span>
                                            </td>
                                            <td class="jbl-181 jbl-1569 jbl-1401">
                                                <div class="jbl-1293 jbl-1426 jbl-141 jbl-602">
                                                    <button class="jbl-840 jbl-145 jbl-434 jbl-333 jbl-935 jbl-184 jbl-140 jbl-1370 jbl-1397 jbl-1293 jbl-1426 jbl-602 jbl-519 jbl-632">
                                                        <span class="material-symbols-outlined jbl-949">visibility</span> Detail
                                                    </button>
                                                    <button @click="editData = item.raw_data; currentTabModal = item.type; showEditModal = true" class="jbl-840 jbl-145 jbl-434 jbl-333 jbl-1321 jbl-302 jbl-140 jbl-1370 jbl-1397 jbl-1293 jbl-1426 jbl-602 jbl-1556 jbl-632">
                                                        <span class="material-symbols-outlined jbl-949">edit</span> Edit
                                                    </button>
                                                    
                                                    <!-- Delete form mapping based on type -->
                                                    <form :action="item.type === 'Kecamatan' ? `/admin/master-data/kecamatan/${item.id}` : (item.type === 'Kelurahan' ? `/admin/master-data/kelurahan/${item.id}` : `/admin/master-data/jenis-layanan/${item.id}`)")" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');" class="jbl-1189">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="jbl-840 jbl-145 jbl-434 jbl-333 jbl-1346 jbl-1443 jbl-140 jbl-1370 jbl-1397 jbl-1293 jbl-1426 jbl-602 jbl-259 jbl-632">
                                                            <span class="material-symbols-outlined jbl-949">delete</span> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                    <tr x-show="filteredData.length === 0">
                                        <td colspan="7" class="jbl-725 jbl-496 jbl-1401 jbl-147">
                                            <div class="jbl-1293 jbl-1541 jbl-1426 jbl-141">
                                                <span class="material-symbols-outlined jbl-264 jbl-189 jbl-1429">search_off</span>
                                                <p>Data tidak ditemukan</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="jbl-156 jbl-1234 jbl-1319 jbl-434 jbl-1293 jbl-358 jbl-1426 jbl-1409 jbl-701">
                            <p class="jbl-843 jbl-147">
                                Menampilkan <span class="jbl-959 jbl-431" x-text="filteredData.length ? (currentPage - 1) * itemsPerPage + 1 : 0"></span> 
                                sampai <span class="jbl-959 jbl-431" x-text="Math.min(currentPage * itemsPerPage, filteredData.length)"></span> 
                                dari <span class="jbl-959 jbl-431" x-text="filteredData.length"></span> data
                            </p>
                            <div class="jbl-1293 jbl-1426 jbl-602">
                                <button @click="if(currentPage > 1) currentPage--" :disabled="currentPage === 1" class="jbl-1374 jbl-1224 jbl-1293 jbl-1426 jbl-141 jbl-140 jbl-1134 jbl-1574 jbl-1077 jbl-41 jbl-632">
                                    <span class="material-symbols-outlined jbl-1203">chevron_left</span>
                                </button>
                                <template x-for="page in totalPages" :key="page">
                                    <button @click="currentPage = page" 
                                            x-show="page === 1 || page === totalPages || (page >= currentPage - 1 && page <= currentPage + 1)"
                                            :class="currentPage === page ? 'bg-blue-600 text-white font-bold' : 'bg-slate-50 text-slate-600 hover:bg-slate-100'" 
                                            class="jbl-1374 jbl-1224 jbl-1293 jbl-1426 jbl-141 jbl-140 jbl-166 jbl-632" x-text="page"></button>
                                </template>
                                <button @click="if(currentPage < totalPages) currentPage++" :disabled="currentPage === totalPages" class="jbl-1374 jbl-1224 jbl-1293 jbl-1426 jbl-141 jbl-140 jbl-1134 jbl-1574 jbl-1077 jbl-41 jbl-632">
                                    <span class="material-symbols-outlined jbl-1203">chevron_right</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="jbl-1537 jbl-1342">
                    <!-- Ringkasan Data Chart -->
                    <div class="jbl-434 jbl-1406 jbl-333 jbl-121 jbl-160 jbl-1545">
                        <h3 class="jbl-959 jbl-386 jbl-870">Ringkasan Data</h3>
                        <div class="jbl-1109 jbl-825 jbl-870">
                            <canvas id="ringkasanChart"></canvas>
                        </div>
                        <div class="jbl-1052 jbl-652">
                            <div class="jbl-1293 jbl-1426 jbl-1409 jbl-843">
                                <div class="jbl-1293 jbl-1426 jbl-745">
                                    <div class="jbl-898 jbl-643 jbl-483 jbl-1121"></div>
                                    <span class="jbl-1574">Data Wilayah</span>
                                </div>
                                <div class="jbl-959">{{ $wilayahCount }} <span class="jbl-13 jbl-418">({{ $totalData > 0 ? round(($wilayahCount/$totalData)*100) : 0 }}%)</span></div>
                            </div>
                            <div class="jbl-1293 jbl-1426 jbl-1409 jbl-843">
                                <div class="jbl-1293 jbl-1426 jbl-745">
                                    <div class="jbl-898 jbl-643 jbl-483 jbl-1135"></div>
                                    <span class="jbl-1574">Jenis Layanan</span>
                                </div>
                                <div class="jbl-959">{{ $layananCount }} <span class="jbl-13 jbl-418">({{ $totalData > 0 ? round(($layananCount/$totalData)*100) : 0 }}%)</span></div>
                            </div>
                            </div>
                    </div>
                    
                    <!-- Informasi Card -->
                    <div class="jbl-434 jbl-1406 jbl-333 jbl-121 jbl-160 jbl-746">
                        <div class="jbl-1293 jbl-1426 jbl-745 jbl-184 jbl-897">
                            <span class="material-symbols-outlined jbl-390">info</span>
                            <h3 class="jbl-959 jbl-386">Informasi</h3>
                        </div>
                        <p class="jbl-166 jbl-147 jbl-787">
                            Master data digunakan sebagai data referensi utama dalam proses pelayanan pada sistem SI JEBOL Kota Tegal.
                        </p>
                        <div class="jbl-652 jbl-1293 jbl-141 jbl-6">
                            <span class="material-symbols-outlined jbl-1200">database</span>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <!-- Modals -->
        <!-- Add Modal -->
        <div x-show="showAddModal" style="display: none;" class="jbl-524 jbl-1062 jbl-1469 jbl-1293 jbl-1426 jbl-141 jbl-1007 jbl-637" x-transition.opacity>
            <div class="jbl-434 jbl-1406 jbl-884 jbl-1539 jbl-768 jbl-1025 jbl-35" @click.away="showAddModal = false">
                <div class="jbl-746 jbl-1049 jbl-1319 jbl-1293 jbl-1409 jbl-1426 jbl-1134">
                    <h3 class="jbl-959 jbl-386 jbl-105">Tambah <span x-text="currentTabModal"></span></h3>
                    <button @click="showAddModal = false" class="jbl-13 jbl-427">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <div class="jbl-746">
                    <!-- Form Kecamatan -->
                    <form x-show="currentTabModal === 'Kecamatan'" action="{{ route('admin.master-data.kecamatan.store') }}" method="POST" class="jbl-285">
                        @csrf
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Kode Kecamatan</label><input type="text" name="kode" required class="jbl-1539 jbl-831 jbl-538 jbl-218 jbl-327"></div>
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Nama Kecamatan</label><input type="text" name="nama" required class="jbl-1539 jbl-831 jbl-538"></div>
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Keterangan</label><textarea name="keterangan" class="jbl-1539 jbl-831 jbl-538"></textarea></div>
                        <div class="jbl-1060 jbl-1293 jbl-1171 jbl-745">
                            <button type="button" @click="showAddModal = false" class="jbl-181 jbl-345 jbl-333 jbl-538 jbl-1574 jbl-582">Batal</button>
                            <button type="submit" class="jbl-181 jbl-345 jbl-1266 jbl-1361 jbl-538 jbl-1470">Simpan</button>
                        </div>
                    </form>
                    <!-- Form Kelurahan -->
                    <form x-show="currentTabModal === 'Kelurahan'" action="{{ route('admin.master-data.kelurahan.store') }}" method="POST" class="jbl-285">
                        @csrf
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Kode Kelurahan</label><input type="text" name="kode" required class="jbl-1539 jbl-831 jbl-538"></div>
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Nama Kelurahan</label><input type="text" name="nama" required class="jbl-1539 jbl-831 jbl-538"></div>
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Pilih Kecamatan</label><select name="kecamatan_nama" required class="jbl-1539 jbl-831 jbl-538"><option value="">-- Pilih Kecamatan --</option>@foreach($kecamatan ?? [] as $k)<option value="{{ $k->nama }}">{{ $k->nama }}</option>@endforeach</select></div>
                        <div class="jbl-1060 jbl-1293 jbl-1171 jbl-745">
                            <button type="button" @click="showAddModal = false" class="jbl-181 jbl-345 jbl-333 jbl-538 jbl-1574 jbl-582">Batal</button>
                            <button type="submit" class="jbl-181 jbl-345 jbl-1266 jbl-1361 jbl-538 jbl-1470">Simpan</button>
                        </div>
                    </form>
                    <!-- Form Jenis Layanan -->
                    <form x-show="currentTabModal === 'Jenis Layanan'" action="{{ route('admin.master-data.jenis-layanan.store') }}" method="POST" class="jbl-285">
                        @csrf
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Kode Layanan</label><input type="text" name="kode" required class="jbl-1539 jbl-831 jbl-538"></div>
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Nama Jenis Layanan</label><input type="text" name="nama" required class="jbl-1539 jbl-831 jbl-538"></div>
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Deskripsi</label><textarea name="deskripsi" class="jbl-1539 jbl-831 jbl-538"></textarea></div>
                        <div class="jbl-1060 jbl-1293 jbl-1171 jbl-745">
                            <button type="button" @click="showAddModal = false" class="jbl-181 jbl-345 jbl-333 jbl-538 jbl-1574 jbl-582">Batal</button>
                            <button type="submit" class="jbl-181 jbl-345 jbl-1266 jbl-1361 jbl-538 jbl-1470">Simpan</button>
                        </div>
                    </form>
                    </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div x-show="showEditModal" style="display: none;" class="jbl-524 jbl-1062 jbl-1469 jbl-1293 jbl-1426 jbl-141 jbl-1007 jbl-637" x-transition.opacity>
            <div class="jbl-434 jbl-1406 jbl-884 jbl-1539 jbl-768 jbl-1025 jbl-35" @click.away="showEditModal = false">
                <div class="jbl-746 jbl-1049 jbl-1319 jbl-1293 jbl-1409 jbl-1426 jbl-1134">
                    <h3 class="jbl-959 jbl-386 jbl-105">Edit <span x-text="currentTabModal"></span></h3>
                    <button @click="showEditModal = false" class="jbl-13 jbl-427">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                <div class="jbl-746 jbl-464 jbl-685">
                    <!-- Edit Kecamatan -->
                    <form x-show="currentTabModal === 'Kecamatan'" :action="`/admin/master-data/kecamatan/${editData?.id}`" method="POST" class="jbl-285">
                        @csrf @method('PUT')
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Kode Kecamatan</label><input type="text" name="kode" :value="editData?.kode" required class="jbl-1539 jbl-831 jbl-538"></div>
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Nama Kecamatan</label><input type="text" name="nama" :value="editData?.nama" required class="jbl-1539 jbl-831 jbl-538"></div>
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Keterangan</label><textarea name="keterangan" :value="editData?.keterangan" x-text="editData?.keterangan" class="jbl-1539 jbl-831 jbl-538"></textarea></div>
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Status</label><select name="status" class="jbl-1539 jbl-831 jbl-538"><option value="Aktif" :selected="editData?.status === 'Aktif'">Aktif</option><option value="Nonaktif" :selected="editData?.status === 'Nonaktif'">Nonaktif</option></select></div>
                        <div class="jbl-1060 jbl-1293 jbl-1171 jbl-745">
                            <button type="button" @click="showEditModal = false" class="jbl-181 jbl-345 jbl-333 jbl-538 jbl-1574 jbl-582">Batal</button>
                            <button type="submit" class="jbl-181 jbl-345 jbl-44 jbl-1361 jbl-538 jbl-258">Update</button>
                        </div>
                    </form>
                    <!-- Edit Kelurahan -->
                    <form x-show="currentTabModal === 'Kelurahan'" :action="`/admin/master-data/kelurahan/${editData?.id}`" method="POST" class="jbl-285">
                        @csrf @method('PUT')
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Kode Kelurahan</label><input type="text" name="kode" :value="editData?.kode" required class="jbl-1539 jbl-831 jbl-538"></div>
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Nama Kelurahan</label><input type="text" name="nama" :value="editData?.nama" required class="jbl-1539 jbl-831 jbl-538"></div>
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Pilih Kecamatan</label><select name="kecamatan_nama" required class="jbl-1539 jbl-831 jbl-538"><option value="">-- Pilih Kecamatan --</option>@foreach($kecamatan ?? [] as $k)<option value="{{ $k->nama }}" :selected="editData?.kecamatan_nama === '{{ $k->nama }}'">{{ $k->nama }}</option>@endforeach</select></div>
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Status</label><select name="status" class="jbl-1539 jbl-831 jbl-538"><option value="Aktif" :selected="editData?.status === 'Aktif'">Aktif</option><option value="Nonaktif" :selected="editData?.status === 'Nonaktif'">Nonaktif</option></select></div>
                        <div class="jbl-1060 jbl-1293 jbl-1171 jbl-745">
                            <button type="button" @click="showEditModal = false" class="jbl-181 jbl-345 jbl-333 jbl-538 jbl-1574 jbl-582">Batal</button>
                            <button type="submit" class="jbl-181 jbl-345 jbl-44 jbl-1361 jbl-538 jbl-258">Update</button>
                        </div>
                    </form>
                    <!-- Edit Jenis Layanan -->
                    <form x-show="currentTabModal === 'Jenis Layanan'" :action="`/admin/master-data/jenis-layanan/${editData?.id}`" method="POST" class="jbl-285">
                        @csrf @method('PUT')
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Kode Layanan</label><input type="text" name="kode" :value="editData?.kode" required class="jbl-1539 jbl-831 jbl-538"></div>
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Nama Jenis Layanan</label><input type="text" name="nama" :value="editData?.nama" required class="jbl-1539 jbl-831 jbl-538"></div>
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Deskripsi</label><textarea name="deskripsi" :value="editData?.deskripsi" x-text="editData?.deskripsi" class="jbl-1539 jbl-831 jbl-538"></textarea></div>
                        <div><label class="jbl-225 jbl-166 jbl-772 jbl-431 jbl-1195">Status</label><select name="status" class="jbl-1539 jbl-831 jbl-538"><option value="Aktif" :selected="editData?.status === 'Aktif'">Aktif</option><option value="Nonaktif" :selected="editData?.status === 'Nonaktif'">Nonaktif</option></select></div>
                        <div class="jbl-1060 jbl-1293 jbl-1171 jbl-745">
                            <button type="button" @click="showEditModal = false" class="jbl-181 jbl-345 jbl-333 jbl-538 jbl-1574 jbl-582">Batal</button>
                            <button type="submit" class="jbl-181 jbl-345 jbl-1266 jbl-1361 jbl-538 jbl-1470">Update</button>
                        </div>
                    </form>
                    </div>
            </div>
        </div>
    </main>

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                alert("{{ session('success') }}");
            }, 500);
        });
    </script>
    @endif
</body>
</html>

