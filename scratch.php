<?php

    public function laporan(Request $request)
    {
        $tab = $request->get('tab', 'per_sekolah');
        $tahun = $request->get('tahun', now()->year);
        $bulan = $request->get('bulan', '');

        // --- Data Laporan Per Sekolah ---
        $schools = \App\Models\School::all();
        $school_stats = collect();
        $total_sekolah = $schools->count();
        $total_ktp = 0; $total_kia = 0; $total_ikd = 0; $total_pelayanan = 0;

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

        // --- HANDLE EXPORT EXCEL ---
        if ($request->get('export') == 'excel') {
            return $this->exportExcel($tab, $school_stats, $jadwal_jebol, $pengajuan_all, $tahun, $bulan);
        }

        return view('cabang.laporan', compact(
            'tab', 'tahun', 'bulan',
            'school_stats', 'total_sekolah', 'total_ktp', 'total_kia', 'total_ikd', 'total_pelayanan',
            'jadwal_jebol',
            'pengajuan_all', 'status_stats'
        ));
    }

    private function exportExcel($tab, $school_stats, $jadwal_jebol, $pengajuan_all, $tahun, $bulan)
    {
        $filename = 'Laporan_' . $tab . '_' . date('Ymd_His') . '.xls';
        $headers = [
            'Content-type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'attachment; filename=' . $filename,
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];
        
        $periode = 'Tahun ' . $tahun;
        if ($bulan) {
            $periode = \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') . ' ' . $tahun;
        }

        $html = '<html xmlns:x="urn:schemas-microsoft-com:office:excel"><head><meta charset="UTF-8"></head><body>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; font-family: Arial, sans-serif;">';

        if ($tab == 'per_sekolah') {
            $html .= '<tr style="height: 30px;"><th colspan="5" style="font-size: 16px; font-weight:bold; text-align: center; border: none; vertical-align: middle;">LAPORAN PELAYANAN JEBOL PER SEKOLAH</th></tr>';
            $html .= '<tr style="height: 30px;"><th colspan="5" style="text-align: center; border: none; vertical-align: middle;">Periode: ' . $periode . '</th></tr>';
            $html .= '<tr><td colspan="5" style="border: none; height: 15px;"></td></tr>';
            
            $html .= '<tr style="background-color: #1f8a89; color: white; height: 40px;">';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Nama Sekolah</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">NPSN</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Jenis Layanan</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Jumlah</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Status</th>';
            $html .= '</tr>';
            
            $rowIndex = 0;
            foreach ($school_stats as $stat) {
                if ($stat->ktp > 0) {
                    $bgColor = ($rowIndex % 2 == 0) ? '#f2f2f2' : '#ffffff';
                    $html .= '<tr style="height: 25px;"><td style="background-color: '.$bgColor.'; border: 1px solid #000;">'.htmlspecialchars($stat->nama_sekolah).'</td><td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">'.$stat->npsn.'</td><td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">KTP-el</td><td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">'.$stat->ktp.'</td><td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">Selesai</td></tr>';
                    $rowIndex++;
                }
                if ($stat->kia > 0) {
                    $bgColor = ($rowIndex % 2 == 0) ? '#f2f2f2' : '#ffffff';
                    $html .= '<tr style="height: 25px;"><td style="background-color: '.$bgColor.'; border: 1px solid #000;">'.htmlspecialchars($stat->nama_sekolah).'</td><td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">'.$stat->npsn.'</td><td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">KIA</td><td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">'.$stat->kia.'</td><td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">Selesai</td></tr>';
                    $rowIndex++;
                }
                if ($stat->ikd > 0) {
                    $bgColor = ($rowIndex % 2 == 0) ? '#f2f2f2' : '#ffffff';
                    $html .= '<tr style="height: 25px;"><td style="background-color: '.$bgColor.'; border: 1px solid #000;">'.htmlspecialchars($stat->nama_sekolah).'</td><td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">'.$stat->npsn.'</td><td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">IKD</td><td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">'.$stat->ikd.'</td><td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">Selesai</td></tr>';
                    $rowIndex++;
                }
            }
        } elseif ($tab == 'jadwal_jebol') {
            $html .= '<tr style="height: 30px;"><th colspan="5" style="font-size: 16px; font-weight:bold; text-align: center; border: none; vertical-align: middle;">LAPORAN JADWAL JEBOL SEKOLAH</th></tr>';
            $html .= '<tr><td colspan="5" style="border: none; height: 15px;"></td></tr>';
            $html .= '<tr style="background-color: #1f8a89; color: white; height: 40px;">';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Nama Sekolah</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Tanggal</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Lokasi</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Jenis Layanan</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Jumlah Peserta</th>';
            $html .= '</tr>';
            
            $rowIndex = 0;
            foreach ($jadwal_jebol as $j) {
                $tanggal = $j->tanggal_pelayanan ? \Carbon\Carbon::parse($j->tanggal_pelayanan)->format('d F Y') : '-';
                $bgColor = ($rowIndex % 2 == 0) ? '#f2f2f2' : '#ffffff';
                $html .= '<tr style="height: 25px;">';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000;">'.htmlspecialchars($j->nama_kegiatan).'</td>';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">'.$tanggal.'</td>';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000;">'.htmlspecialchars($j->lokasi).'</td>';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">'.$j->jenis_layanan.'</td>';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">'.$j->kuota.'</td>';
                $html .= '</tr>';
                $rowIndex++;
            }
        } elseif ($tab == 'monitoring') {
            $html .= '<tr style="height: 30px;"><th colspan="5" style="font-size: 16px; font-weight:bold; text-align: center; border: none; vertical-align: middle;">LAPORAN MONITORING PENGAJUAN</th></tr>';
            $html .= '<tr style="height: 30px;"><th colspan="5" style="text-align: center; border: none; vertical-align: middle;">Periode: ' . $periode . '</th></tr>';
            $html .= '<tr><td colspan="5" style="border: none; height: 15px;"></td></tr>';
            $html .= '<tr style="background-color: #1f8a89; color: white; height: 40px;">';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Nomor Pengajuan</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Nama</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Sekolah</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Jenis Layanan</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Status</th>';
            $html .= '</tr>';
            
            $rowIndex = 0;
            foreach ($pengajuan_all as $p) {
                $bgColor = ($rowIndex % 2 == 0) ? '#f2f2f2' : '#ffffff';
                $html .= '<tr style="height: 25px;">';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">'.$p->nomor_tiket.'</td>';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000;">'.htmlspecialchars($p->user->name ?? '-').'</td>';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000;">'.htmlspecialchars($p->user->school ?? '-').'</td>';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">'.$p->jenis_layanan.'</td>';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">'.$p->status.'</td>';
                $html .= '</tr>';
                $rowIndex++;
            }
        }
        
        $html .= '</table></body></html>';
        return response($html, 200, $headers);
    }
