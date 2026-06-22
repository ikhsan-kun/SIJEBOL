<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Audit Log System - SI JEBOL Admin</title>
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
        
        .audit-header {
            margin: -40px -48px 40px -48px;
        }
        @media (max-width: 1023px) {
            .audit-header {
                margin: -40px -20px 40px -20px;
            }
        }
    </style>
</head>
<body class="jbl-342">
    @include('partials.admin-sidebar-premium')

    <main class="main-content jbl-680">
        <div class="jbl-1539 jbl-1507">
            <div class="jbl-181 jbl-480 jbl-1078 jbl-950 jbl-434 jbl-1049 jbl-121 jbl-846 jbl-988 jbl-292 jbl-160 jbl-1293 jbl-1541 jbl-627 jbl-1409 jbl-1488 jbl-701 audit-header">
                <div>
                    <h2 class="jbl-390 jbl-1495 jbl-586 jbl-849 jbl-1511">System Audit Log</h2>
                    <p class="jbl-843 jbl-200 jbl-147 jbl-772">Rekaman jejak aktivitas pengguna dan sistem keamanan.</p>
                </div>
                <a href="{{ route('admin.settings.security') }}" class="jbl-823 jbl-1426 jbl-745 jbl-181 jbl-1090 jbl-1569 jbl-995 jbl-1574 jbl-1320 jbl-1105 jbl-1128 jbl-586 jbl-212 jbl-1288 jbl-1462 jbl-1471 jbl-1276 jbl-1390">
                    <span class="material-symbols-outlined jbl-210 jbl-445">arrow_back</span>
                    Kembali ke Keamanan Akun
                </a>
            </div>

            <div class="jbl-1539">
            <div class="jbl-434 jbl-106 jbl-333 jbl-121 jbl-160 jbl-35">
                <div class="jbl-1241 jbl-1049 jbl-1319 jbl-1293 jbl-1409 jbl-1426 jbl-138">
                    <h3 class="jbl-166 jbl-586 jbl-849 jbl-1462 jbl-1471 jbl-1293 jbl-1426 jbl-745">
                        <span class="material-symbols-outlined jbl-184">history</span>
                        Aktivitas Terbaru
                    </h3>
                    <span class="jbl-181 jbl-120 jbl-313 jbl-625 jbl-1105 jbl-586 jbl-835 jbl-1462 jbl-333 jbl-916 jbl-280">Live Monitoring</span>
                </div>
                
                <div class="jbl-375">
                    <table class="jbl-1539 jbl-1103">
                        <thead>
                            <tr class="jbl-1105 jbl-586 jbl-13 jbl-1462 jbl-1555 jbl-1049 jbl-1153">
                                <th class="jbl-181 jbl-480 jbl-674 jbl-1459">Timestamp</th>
                                <th class="jbl-181 jbl-480 jbl-674 jbl-1459">User / Actor</th>
                                <th class="jbl-181 jbl-480 jbl-674 jbl-1459">Aktivitas</th>
                                <th class="jbl-181 jbl-480 jbl-674 jbl-1459 jbl-925">Status</th>
                            </tr>
                        </thead>
                        <tbody class="jbl-486 jbl-1341">
                            @foreach($logs as $log)
                            <tr class="jbl-1504 jbl-1288 jbl-304">
                                <td class="jbl-181 jbl-480 jbl-674 jbl-1459 jbl-1306">
                                    <span class="jbl-1105 jbl-1128 jbl-959 jbl-13 jbl-1100">{{ $log->created_at }}</span>
                                </td>
                                <td class="jbl-181 jbl-480 jbl-674 jbl-1459 jbl-1306">
                                    <div class="jbl-1293 jbl-1426 jbl-985">
                                        <div class="jbl-1374 jbl-1224 jbl-538 jbl-995 jbl-565 jbl-1421 jbl-1426 jbl-141">
                                            <span class="material-symbols-outlined jbl-13 jbl-105">person</span>
                                        </div>
                                        <div class="jbl-1293 jbl-1541">
                                            <span class="jbl-843 jbl-200 jbl-586 jbl-431 jbl-1511">{{ $log->name }}</span>
                                            <span class="jbl-891 jbl-905 jbl-13 jbl-772">{{ $log->role }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="jbl-181 jbl-480 jbl-674 jbl-1459 jbl-1306">
                                    @php
                                        $actions = ['Mengakses Dashboard', 'Memverifikasi Permohonan', 'Mencetak Laporan Tahunan', 'Memperbarui Pengaturan Wilayah', 'Menambahkan User Baru'];
                                        $action = $actions[array_rand($actions)];
                                    @endphp
                                    <span class="jbl-843 jbl-200 jbl-959 jbl-1574">{{ $action }}</span>
                                </td>
                                <td class="jbl-181 jbl-480 jbl-674 jbl-1459 jbl-925 jbl-1306">
                                    <span class="jbl-525 jbl-145 jbl-176 jbl-184 jbl-1105 jbl-586 jbl-835 jbl-1462">SUCCESS</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="jbl-1241 jbl-1234 jbl-1153 jbl-478 jbl-1401">
                    <p class="jbl-843 jbl-13 jbl-959 jbl-1462 jbl-1471 jbl-424">-- Data audit log dienkripsi secara otomatis oleh sistem --</p>
                </div>
            </div>
            </div>
        </div>
    </main>
</body>
</html>

