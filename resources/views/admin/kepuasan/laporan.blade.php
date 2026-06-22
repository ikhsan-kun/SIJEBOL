<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Cetak Laporan Hasil Kepuasan Warga</title>
    <link rel="stylesheet" href="{{ asset('css/custom-style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        body { 
            background-color: #f3f4f6; 
            font-family: 'Inter', sans-serif;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        
        .a4-container {
            width: 210mm;
            min-height: 297mm;
            background: white;
            margin: 0 auto;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            padding: 20mm;
        }

        .table-header {
            background-color: #1e40af !important; /* blue-800 */
            color: white !important;
        }

        .table-row-striped:nth-child(even) {
            background-color: #f8fafc !important; /* slate-50 */
        }

        .star-filled { color: #eab308 !important; } /* yellow-500 */
        .star-empty { color: #cbd5e1 !important; } /* slate-300 */

        @media print {
            body { 
                background-color: white; 
            }
            .no-print { 
                display: none !important; 
            }
            .a4-container {
                width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }
            .print-border {
                border-color: #000 !important;
            }
            @page {
                size: A4 portrait;
                margin: 15mm;
            }
        }
    </style>
</head>
<body class="jbl-386 jbl-342">
    
    @php
        $totalPenilaian = $reviews->count();
        $rataRataKepuasan = $totalPenilaian > 0 ? $reviews->avg('nilai_kepuasan') : 0;
        
        $groupedByLayanan = $reviews->groupBy('status_layanan')->map(function ($items, $key) {
            return [
                'layanan' => $key ?: '-',
                'jumlah' => $items->count(),
                'rata_rata' => $items->avg('nilai_kepuasan')
            ];
        })->values();

        $penilaianTerbaik = $groupedByLayanan->sortByDesc('rata_rata')->first();
        $penilaianTerbanyak = $groupedByLayanan->sortByDesc('jumlah')->first();

        function getRatingLabel($rating) {
            if ($rating >= 4.5) return 'Sangat Baik';
            if ($rating >= 3.5) return 'Baik';
            if ($rating >= 2.5) return 'Cukup';
            if ($rating >= 1.5) return 'Kurang';
            return 'Sangat Kurang';
        }
    @endphp

    <!-- Top Action Bar (No Print) -->
    <div class="no-print jbl-434 jbl-1049 jbl-121 jbl-846 jbl-3 jbl-929 jbl-160 jbl-725 jbl-674 jbl-1293 jbl-1426 jbl-1409">
        <h1 class="jbl-105 jbl-959 jbl-386">Cetak Laporan Hasil Kepuasan Warga</h1>
        <div class="jbl-1293 jbl-985">
            <button onclick="downloadPDF()" class="jbl-1036 jbl-1082 jbl-1361 jbl-772 jbl-345 jbl-181 jbl-1300 jbl-1293 jbl-1426 jbl-745 jbl-166 jbl-632 jbl-160">
                <span class="material-symbols-outlined jbl-1203">download</span> Download PDF
            </button>
            <button onclick="window.print()" class="jbl-1508 jbl-164 jbl-1361 jbl-772 jbl-345 jbl-181 jbl-1300 jbl-1293 jbl-1426 jbl-745 jbl-166 jbl-632 jbl-160">
                <span class="material-symbols-outlined jbl-1203">print</span> Cetak
            </button>
        </div>
    </div>

    <!-- Main Print Container (A4) -->
    <div class="jbl-782 jbl-399 no-print-bg">
        <div class="a4-container jbl-1109" id="laporan-pdf">
            
            <!-- Header KOP Surat -->
            <div class="jbl-1293 jbl-1426 jbl-1409 jbl-870">
                <div class="jbl-595 jbl-1226 jbl-795">
                    <!-- Logo Tegal -->
                    <img src="/images/logo-tegal.png" alt="Logo Kota Tegal" class="jbl-1539 jbl-758 jbl-920">
                </div>
                <div class="jbl-177 jbl-1401 jbl-181">
                    <h2 class="jbl-1203 jbl-959 jbl-335 jbl-1462 jbl-1267">PEMERINTAH KOTA TEGAL</h2>
                    <h1 class="jbl-900 jbl-959 jbl-335 jbl-1462 jbl-1267 jbl-1195">DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</h1>
                    <p class="jbl-810 jbl-335">Jl. KS. Tubun No. 8 Kota Tegal, Jawa Tengah 52113</p>
                    <p class="jbl-810 jbl-335">Telp. (0283) 357050 | Email: disdukcapil@tegalkota.go.id</p>
                </div>
                <div class="jbl-595 jbl-795">
                    <!-- Right empty space for centering -->
                </div>
            </div>
            
            <!-- Thick Horizontal Line -->
            <div class="jbl-808 jbl-131 jbl-1195 jbl-1539"></div>
            <div class="jbl-1049 jbl-131 jbl-454 jbl-1539"></div>

            <!-- Report Title -->
            <div class="jbl-1401 jbl-59">
                <h3 class="jbl-957 jbl-959 jbl-335 jbl-1462">LAPORAN HASIL KEPUASAN WARGA</h3>
                <p class="jbl-252 jbl-335 jbl-1237">
                    Periode: 
                    @if(request('start_date') && request('end_date'))
                        {{ \Carbon\Carbon::parse(request('start_date'))->translatedFormat('d F Y') }} s.d. {{ \Carbon\Carbon::parse(request('end_date'))->translatedFormat('d F Y') }}
                    @else
                        Semua Waktu
                    @endif
                </p>
            </div>

            <!-- Summary Cards Row -->
            <div class="jbl-1293 jbl-333 jbl-831 jbl-483 jbl-59 jbl-434">
                <!-- Total Penilaian -->
                <div class="jbl-177 jbl-156 jbl-1401 jbl-1261 jbl-831 jbl-1293 jbl-1541 jbl-1426 jbl-141">
                    <p class="jbl-1105 jbl-959 jbl-147 jbl-1462 jbl-422 jbl-1429">TOTAL PENILAIAN</p>
                    <div class="jbl-1293 jbl-1426 jbl-985">
                        <span class="material-symbols-outlined jbl-315 jbl-1173">group</span>
                        <div class="jbl-1103">
                            <p class="jbl-900 jbl-959 jbl-335 jbl-502 jbl-1195">{{ $totalPenilaian }}</p>
                            <p class="jbl-1370 jbl-147">Penilaian</p>
                        </div>
                    </div>
                </div>

                <!-- Rata-rata Kepuasan -->
                <div class="jbl-177 jbl-156 jbl-1401 jbl-1261 jbl-831 jbl-1293 jbl-1541 jbl-1426 jbl-141">
                    <p class="jbl-1105 jbl-959 jbl-147 jbl-1462 jbl-422 jbl-1429">RATA-RATA KEPUASAN</p>
                    <div class="jbl-1293 jbl-1426 jbl-985">
                        <span class="material-symbols-outlined jbl-315 jbl-1173">star</span>
                        <div class="jbl-1103">
                            <p class="jbl-1203 jbl-959 jbl-335 jbl-502 jbl-1195">{{ number_format($rataRataKepuasan, 2, ',', '.') }} / 5</p>
                            <p class="jbl-1370 jbl-147">{{ getRatingLabel($rataRataKepuasan) }}</p>
                        </div>
                    </div>
                </div>

                <!-- Penilaian Terbaik -->
                <div class="jbl-177 jbl-156 jbl-1401 jbl-1261 jbl-831 jbl-1293 jbl-1541 jbl-1426 jbl-141">
                    <p class="jbl-1105 jbl-959 jbl-147 jbl-1462 jbl-422 jbl-1429">PENILAIAN TERBAIK</p>
                    <div class="jbl-1293 jbl-1426 jbl-985">
                        <span class="material-symbols-outlined jbl-315 jbl-1173">thumb_up</span>
                        <div class="jbl-1103">
                            <p class="jbl-957 jbl-959 jbl-335 jbl-502 jbl-1195 jbl-1542 jbl-783">{{ $penilaianTerbaik ? $penilaianTerbaik['layanan'] : '-' }}</p>
                            <p class="jbl-1370 jbl-147">{{ $penilaianTerbaik ? number_format($penilaianTerbaik['rata_rata'], 2, ',', '.') . ' / 5' : '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Penilaian Terbanyak -->
                <div class="jbl-177 jbl-156 jbl-1401 jbl-1293 jbl-1541 jbl-1426 jbl-141">
                    <p class="jbl-1105 jbl-959 jbl-147 jbl-1462 jbl-422 jbl-1429">PENILAIAN TERBANYAK</p>
                    <div class="jbl-1293 jbl-1426 jbl-985">
                        <span class="material-symbols-outlined jbl-315 jbl-1173">assignment</span>
                        <div class="jbl-1103">
                            <p class="jbl-957 jbl-959 jbl-335 jbl-502 jbl-1195 jbl-1542 jbl-783">{{ $penilaianTerbanyak ? $penilaianTerbanyak['layanan'] : '-' }}</p>
                            <p class="jbl-1370 jbl-147">{{ $penilaianTerbanyak ? $penilaianTerbanyak['jumlah'] . ' Penilaian' : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table 1: Ringkasan -->
            <div class="jbl-59">
                <h4 class="jbl-1370 jbl-959 jbl-335 jbl-1462 jbl-422 jbl-1429">RINGKASAN PENILAIAN PER JENIS LAYANAN</h4>
                <table class="jbl-1539 jbl-325 jbl-333 jbl-831">
                    <thead>
                        <tr class="table-header jbl-1370 jbl-1103">
                            <th class="jbl-333 jbl-831 jbl-518 jbl-1401 jbl-27">No</th>
                            <th class="jbl-333 jbl-831 jbl-518">Jenis Layanan</th>
                            <th class="jbl-333 jbl-831 jbl-518 jbl-1401">Jumlah Penilaian</th>
                            <th class="jbl-333 jbl-831 jbl-518 jbl-1401" colspan="2">Rata-rata Rating</th>
                        </tr>
                    </thead>
                    <tbody class="jbl-1370 jbl-335">
                        @foreach($groupedByLayanan as $index => $item)
                        <tr class="table-row-striped">
                            <td class="jbl-333 jbl-831 jbl-518 jbl-1401">{{ $index + 1 }}</td>
                            <td class="jbl-333 jbl-831 jbl-518 jbl-772">{{ $item['layanan'] }}</td>
                            <td class="jbl-333 jbl-831 jbl-518 jbl-1401">{{ $item['jumlah'] }}</td>
                            <td class="jbl-191 jbl-881 jbl-831 jbl-518 jbl-925 jbl-211">
                                <div class="jbl-1293 jbl-1171 jbl-852">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($item['rata_rata']))
                                            <span class="material-symbols-outlined star-filled jbl-810">star</span>
                                        @else
                                            <span class="material-symbols-outlined star-empty jbl-810">star</span>
                                        @endif
                                    @endfor
                                </div>
                            </td>
                            <td class="jbl-191 jbl-1261 jbl-831 jbl-518 jbl-592 jbl-1397">{{ number_format($item['rata_rata'], 2, ',', '.') }}</td>
                        </tr>
                        @endforeach
                        @if($groupedByLayanan->isEmpty())
                        <tr>
                            <td colspan="5" class="jbl-333 jbl-831 jbl-156 jbl-1401 jbl-147">Tidak ada data penilaian.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Table 2: Daftar Penilaian -->
            <div class="jbl-59">
                <h4 class="jbl-1370 jbl-959 jbl-335 jbl-1462 jbl-422 jbl-1429">DAFTAR PENILAIAN</h4>
                <table class="jbl-1539 jbl-325 jbl-333 jbl-831">
                    <thead>
                        <tr class="table-header jbl-1370 jbl-1103">
                            <th class="jbl-333 jbl-831 jbl-518 jbl-1401 jbl-800">No</th>
                            <th class="jbl-333 jbl-831 jbl-518 jbl-374">Nama Pemohon</th>
                            <th class="jbl-333 jbl-831 jbl-518 jbl-1401 jbl-374">Jenis Layanan</th>
                            <th class="jbl-333 jbl-831 jbl-518 jbl-1401 jbl-211">Rating</th>
                            <th class="jbl-333 jbl-831 jbl-518">Komentar / Saran</th>
                            <th class="jbl-333 jbl-831 jbl-518 jbl-1401 jbl-848">Tanggal Penilaian</th>
                        </tr>
                    </thead>
                    <tbody class="jbl-1105 jbl-335">
                        @foreach($reviews as $index => $review)
                        <tr class="table-row-striped">
                            <td class="jbl-333 jbl-831 jbl-518 jbl-1401">{{ $index + 1 }}</td>
                            <td class="jbl-333 jbl-831 jbl-518">{{ $review->masyarakat ? ($review->masyarakat->name ?? $review->masyarakat->nama) : 'Anonim' }}</td>
                            <td class="jbl-333 jbl-831 jbl-518 jbl-1401">{{ $review->status_layanan ?? '-' }}</td>
                            <td class="jbl-333 jbl-831 jbl-518 jbl-1401">
                                <div class="jbl-1293 jbl-141 jbl-852">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($review->nilai_kepuasan))
                                            <span class="material-symbols-outlined star-filled jbl-810">star</span>
                                        @else
                                            <span class="material-symbols-outlined star-empty jbl-810">star</span>
                                        @endif
                                    @endfor
                                </div>
                            </td>
                            <td class="jbl-333 jbl-831 jbl-518">{{ $review->kritik_saran ?? '-' }}</td>
                            <td class="jbl-333 jbl-831 jbl-518 jbl-1401">{{ $review->tanggal_input ? $review->tanggal_input->format('d-m-Y') : '-' }}</td>
                        </tr>
                        @endforeach
                        @if($reviews->isEmpty())
                        <tr>
                            <td colspan="6" class="jbl-333 jbl-831 jbl-156 jbl-1401 jbl-147">Tidak ada data penilaian.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Footer Area -->
            <div class="jbl-936 jbl-1293 jbl-1409 jbl-1046">
                
                <!-- Left: Keterangan Rating -->
                <div class="jbl-1105 jbl-335">
                    <p class="jbl-959 jbl-1429">Keterangan Rating:</p>
                    <div class="jbl-1293 jbl-276">
                        <div>
                            <div class="jbl-1293 jbl-1426 jbl-745 jbl-1195">
                                <div class="jbl-1293 jbl-810"><span class="material-symbols-outlined star-filled">star</span><span class="material-symbols-outlined star-filled">star</span><span class="material-symbols-outlined star-filled">star</span><span class="material-symbols-outlined star-filled">star</span><span class="material-symbols-outlined star-filled">star</span></div>
                                <span>= Sangat Baik (5)</span>
                            </div>
                            <div class="jbl-1293 jbl-1426 jbl-745 jbl-1195">
                                <div class="jbl-1293 jbl-810"><span class="material-symbols-outlined star-filled">star</span><span class="material-symbols-outlined star-filled">star</span><span class="material-symbols-outlined star-filled">star</span><span class="material-symbols-outlined star-filled">star</span><span class="material-symbols-outlined star-empty">star</span></div>
                                <span>= Baik (4)</span>
                            </div>
                            <div class="jbl-1293 jbl-1426 jbl-745 jbl-1195">
                                <div class="jbl-1293 jbl-810"><span class="material-symbols-outlined star-filled">star</span><span class="material-symbols-outlined star-filled">star</span><span class="material-symbols-outlined star-filled">star</span><span class="material-symbols-outlined star-empty">star</span><span class="material-symbols-outlined star-empty">star</span></div>
                                <span>= Cukup (3)</span>
                            </div>
                        </div>
                        <div>
                            <div class="jbl-1293 jbl-1426 jbl-745 jbl-1195">
                                <div class="jbl-1293 jbl-810"><span class="material-symbols-outlined star-filled">star</span><span class="material-symbols-outlined star-filled">star</span><span class="material-symbols-outlined star-empty">star</span><span class="material-symbols-outlined star-empty">star</span><span class="material-symbols-outlined star-empty">star</span></div>
                                <span>= Kurang (2)</span>
                            </div>
                            <div class="jbl-1293 jbl-1426 jbl-745 jbl-1195">
                                <div class="jbl-1293 jbl-810"><span class="material-symbols-outlined star-filled">star</span><span class="material-symbols-outlined star-empty">star</span><span class="material-symbols-outlined star-empty">star</span><span class="material-symbols-outlined star-empty">star</span><span class="material-symbols-outlined star-empty">star</span></div>
                                <span>= Sangat Kurang (1)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Signature -->
                <div class="jbl-1370 jbl-335 jbl-1401 jbl-752 jbl-544">
                    <p class="jbl-1195">Tegal, {{ now()->translatedFormat('d F Y') }}</p>
                    <p class="jbl-908">Admin Disdukcapil Kota Tegal</p>
                    <p class="jbl-1195">(.............................................................)</p>
                    <p class="jbl-1103 jbl-842">NIP. ..................................................</p>
                </div>

            </div>
            
        </div>
    </div>

    <!-- Script for PDF Download -->
    <script>
        function downloadPDF() {
            const element = document.getElementById('laporan-pdf');
            const opt = {
                margin:       0,
                filename:     'Laporan_Kepuasan_Warga.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };

            // Before generating PDF, temporary styling adjustments if needed
            html2pdf().set(opt).from(element).save();
        }
    </script>
</body>
</html>

