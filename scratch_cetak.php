<?php
    public function cetakPdf(Request $request)
    {
        $tab = $request->get('tab', 'per_sekolah');
        $tahun = $request->get('tahun', now()->year);
        $bulan = $request->get('bulan', '');

        // --- Data Laporan Per Sekolah ---
        $schools = \App\Models\School::all();
        $school_stats = collect();
        $total_ktp = 0; $total_kia = 0; $total_ikd = 0; $total_pelayanan = 0;
        $total_sekolah = $schools->count();

        foreach ($schools as $school) {
            $pengajuan = \App\Models\PengajuanLayanan::whereHas('user', function($q) use ($school) {
                $q->where('school', $school->nama_sekolah);
            })->whereYear('tanggal_pengajuan', $tahun);
            if ($bulan) $pengajuan->whereMonth('tanggal_pengajuan', $bulan);
            $pengajuan = $pengajuan->where('status', 'selesai')->get();

            $ktp = $pengajuan->where('jenis_layanan', 'KTP-el')->count();
            $kia = $pengajuan->where('jenis_layanan', 'KIA')->count();
            $ikd = $pengajuan->where('jenis_layanan', 'IKD')->count();
            $total = $ktp + $kia + $ikd;

            $school_stats->push((object)[
                'nama_sekolah' => $school->nama_sekolah,
                'npsn' => $school->npsn ?? '-',
                'ktp' => $ktp,
                'kia' => $kia,
                'ikd' => $ikd,
                'total' => $total,
            ]);

            $total_ktp += $ktp;
            $total_kia += $kia;
            $total_ikd += $ikd;
            $total_pelayanan += $total;
        }
        $school_stats = $school_stats->sortByDesc('total');

        // --- Data Jadwal JEBOL ---
        $jadwal_jebol = \App\Models\JadwalJebol::where('jenis_lokasi', 'Sekolah')
            ->orWhere('nama_kegiatan', 'like', '%sekolah%')
            ->orderBy('tanggal_pelayanan', 'desc')->get();

        // --- Data Monitoring Pengajuan ---
        $pengajuan_all = \App\Models\PengajuanLayanan::with('user')->whereHas('user', function($q) {
            $q->where('location_type', 'sekolah');
        })->whereYear('tanggal_pengajuan', $tahun);
        if ($bulan) $pengajuan_all->whereMonth('tanggal_pengajuan', $bulan);
        $pengajuan_all = $pengajuan_all->get();

        $status_stats = (object)[
            'menunggu' => $pengajuan_all->where('status', 'pending')->count(),
            'terverifikasi' => $pengajuan_all->where('status', 'terverifikasi')->count(),
            'terjadwal' => $pengajuan_all->where('status', 'terjadwal')->count(),
            'diproses' => $pengajuan_all->where('status', 'diproses')->count(),
            'selesai' => $pengajuan_all->where('status', 'selesai')->count(),
            'ditolak' => $pengajuan_all->where('status', 'ditolak')->count(),
        ];

        return view('cabang.cetak-laporan', compact(
            'tab', 'tahun', 'bulan',
            'school_stats', 'total_sekolah', 'total_ktp', 'total_kia', 'total_ikd', 'total_pelayanan',
            'jadwal_jebol',
            'pengajuan_all', 'status_stats'
        ));
    }
