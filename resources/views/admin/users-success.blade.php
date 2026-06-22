<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>User Berhasil Dibuat - SI JEBOL Admin</title>
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
<body class="bg-background text-on-surface jbl-342 jbl-461">
    @include('partials.admin-sidebar-premium')

    <main class="jbl-9 jbl-461 jbl-1293 jbl-1541">
        <header class="jbl-1293 jbl-1409 jbl-1426 jbl-388 jbl-725 jbl-1539 jbl-379 jbl-434 jbl-1049 jbl-121 jbl-160 jbl-846 jbl-3">
            <div class="jbl-1293 jbl-1426 jbl-701">
                <h2 class="jbl-390 jbl-959 jbl-184">Manajemen User</h2>
                <span class="jbl-189">|</span>
                <p class="jbl-166 jbl-147">SI JEBOL Tegal / Konfirmasi</p>
            </div>
        </header>

        <div class="jbl-177 jbl-1293 jbl-1426 jbl-141 jbl-1241">
            <div class="jbl-624 jbl-1539 jbl-434 jbl-333 jbl-1272 jbl-1406 jbl-35 jbl-160">
                <!-- Top Section -->
                <div class="p-stack-lg jbl-1293 jbl-1541 jbl-1426 jbl-1401 gap-stack-md jbl-1524">
                    <div class="jbl-983 jbl-309 jbl-1008 jbl-835 jbl-1293 jbl-1426 jbl-141 jbl-870">
                        <span class="material-symbols-outlined jbl-1396 jbl-877" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    </div>
                    <h1 class="jbl-47 jbl-959 jbl-184">Akun Pengguna Berhasil Dibuat</h1>
                    <p class="text-secondary">Identitas admin baru telah diverifikasi dan didaftarkan ke dalam sistem SI JEBOL.</p>
                </div>

                <!-- Middle Section: Ringkasan Akun -->
                <div class="px-stack-lg py-stack-md">
                    <div class="jbl-176 jbl-333 jbl-1110 jbl-1320 p-stack-md">
                        <h3 class="jbl-166 jbl-959 jbl-184 mb-stack-md jbl-1462 jbl-422">Ringkasan Akun</h3>
                        <div class="jbl-174 jbl-1019 jbl-868 gap-y-stack-md gap-x-stack-lg">
                            <div>
                                <p class="jbl-1105 text-secondary jbl-1462 jbl-959">Nama Lengkap</p>
                                <p class="jbl-1397 text-on-surface">Ahmad Subarjo</p>
                            </div>
                            <div>
                                <p class="jbl-1105 text-secondary jbl-1462 jbl-959">NIK</p>
                                <p class="jbl-1397 text-on-surface">3328010203040001</p>
                            </div>
                            <div>
                                <p class="jbl-1105 text-secondary jbl-1462 jbl-959">Role</p>
                                <div class="jbl-823 jbl-1426 jbl-840 jbl-738 jbl-140 jbl-1093 jbl-202 jbl-843 jbl-1397 jbl-1237">
                                    Admin
                                </div>
                            </div>
                            <div>
                                <p class="jbl-1105 text-secondary jbl-1462 jbl-959">Unit Kerja</p>
                                <p class="jbl-1397 text-on-surface">Disdukcapil Pusat</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Redirect Notification -->
                <div class="jbl-1241 jbl-1401 jbl-1134 jbl-1234 jbl-1319">
                    <p class="jbl-166 jbl-147 jbl-772 jbl-1293 jbl-1426 jbl-141 jbl-745">
                        <span class="jbl-1283 jbl-575 jbl-1266 jbl-835 jbl-188"></span>
                        Kembali ke halaman utama dalam <span id="countdown" class="jbl-959 jbl-184">5</span> detik...
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="jbl-591 jbl-1234 jbl-1290 jbl-1539 jbl-1293 jbl-1541 jbl-744 jbl-1409 jbl-1426 jbl-1298 jbl-1078">
            <p class="jbl-843 jbl-654">© 2024 Pemerintah Kota Tegal - Dinas Kependudukan dan Pencatatan Sipil</p>
            <div class="jbl-1293 jbl-1051 jbl-858 jbl-1534">
                <a class="jbl-654 jbl-1162 jbl-1016 jbl-843" href="#">Kebijakan Privasi</a>
                <a class="jbl-654 jbl-1162 jbl-1016 jbl-843" href="#">Kontak Kami</a>
                <a class="jbl-654 jbl-1162 jbl-1016 jbl-843" href="#">Portal Tegal</a>
            </div>
        </footer>
    </main>

    <script>
        let count = 5;
        const countdownElement = document.getElementById('countdown');
        const timer = setInterval(() => {
            count--;
            countdownElement.textContent = count;
            if (count <= 0) {
                clearInterval(timer);
                window.location.href = "{{ route('admin.users') }}";
            }
        }, 1000);
    </script>
</body>
</html>

