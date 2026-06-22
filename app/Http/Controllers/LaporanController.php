<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\PengajuanLayanan;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));
        $kecamatan = $request->get('kecamatan');
        $masterKecamatan = \App\Models\MasterKecamatan::where('status', 'Aktif')->get();

        $dataLaporan = $this->getRealData($bulan, $tahun, $kecamatan);
        
        $perPage = 50;
        $page = \Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1;
        $items = collect($dataLaporan);
        $paginatedDataLaporan = new \Illuminate\Pagination\LengthAwarePaginator(
            $items->forPage($page, $perPage),
            $items->count(),
            $perPage,
            $page,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );
        // Append current query parameters to the paginator links
        $paginatedDataLaporan->appends($request->all());

        $laporanSekolah = $this->getSchoolData($bulan, $tahun, $kecamatan);

        // Filter Laporan Pengajuan
        $jenis_layanan = $request->get('jenis_layanan', '-- Semua --');
        $status_pengajuan = $request->get('status_pengajuan', '-- Semua --');

        $query = PengajuanLayanan::query();
        
        $query->whereMonth('tanggal_pengajuan', $bulan)
              ->whereYear('tanggal_pengajuan', $tahun);

        if ($kecamatan) {
            $kecName = str_ireplace(['Kecamatan ', 'Kec. '], '', $kecamatan);
            $query->where('lokasi_pelayanan', 'LIKE', '%' . trim($kecName) . '%');
        }
        if ($jenis_layanan && $jenis_layanan !== '-- Semua --') {
            $query->where('jenis_layanan', 'LIKE', '%' . $jenis_layanan . '%');
        }
        if ($status_pengajuan && $status_pengajuan !== '-- Semua --') {
            if ($status_pengajuan == 'Menunggu Verifikasi') $query->where('status', 'menunggu_verifikasi');
            elseif ($status_pengajuan == 'Terverifikasi') $query->where('status', 'terverifikasi');
            elseif ($status_pengajuan == 'Terjadwal') $query->where('status', 'terjadwal');
            elseif ($status_pengajuan == 'Selesai') $query->where('status', 'selesai');
            elseif ($status_pengajuan == 'Ditolak') $query->where('status', 'ditolak');
        }


        $filteredData = clone $query;
        $totalPengajuan = $filteredData->count();
        $statTerverifikasi = (clone $query)->where('status', 'terverifikasi')->count();
        $statTerjadwal = (clone $query)->where('status', 'terjadwal')->count();
        $statSelesai = (clone $query)->where('status', 'selesai')->count();
        $statDitolak = (clone $query)->where('status', 'ditolak')->count();
        $statMenunggu = (clone $query)->where('status', 'menunggu_verifikasi')->count();

        // Data untuk Grafik Status
        $statusData = [$statMenunggu, $statTerverifikasi, $statTerjadwal, $statSelesai, $statDitolak];

        // Data untuk Grafik Jenis Layanan
        $jenisKTP = (clone $query)->where('jenis_layanan', 'LIKE', '%KTP%')->count();
        $jenisKIA = (clone $query)->where('jenis_layanan', 'LIKE', '%KIA%')->count();
        $jenisIKD = (clone $query)->where('jenis_layanan', 'LIKE', '%IKD%')->count();
        $jenisData = [$jenisKTP, $jenisKIA, $jenisIKD];

        // Data untuk Grafik Rekap Selesai
        $selesaiKTP = (clone $query)->where('status', 'selesai')->where('jenis_layanan', 'LIKE', '%KTP%')->count();
        $selesaiKIA = (clone $query)->where('status', 'selesai')->where('jenis_layanan', 'LIKE', '%KIA%')->count();
        $selesaiIKD = (clone $query)->where('status', 'selesai')->where('jenis_layanan', 'LIKE', '%IKD%')->count();
        $rekapSelesaiData = [$selesaiIKD, $selesaiKTP, $selesaiKIA]; // Urutan: IKD, KTP, KIA

        return view('admin.laporan', compact(
            'dataLaporan', 'paginatedDataLaporan', 'laporanSekolah', 'bulan', 'tahun', 'kecamatan',
            'jenis_layanan', 'status_pengajuan',
            'totalPengajuan', 'statTerverifikasi', 'statTerjadwal', 'statSelesai', 'statDitolak',
            'statusData', 'jenisData', 'rekapSelesaiData', 'masterKecamatan'
        ));
    }

    public function download(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));
        $kecamatan = $request->get('kecamatan');
        $masterKecamatan = \App\Models\MasterKecamatan::where('status', 'Aktif')->get();
        
        $dataLaporan = $this->getRealData($bulan, $tahun, $kecamatan);
        $laporanSekolah = $this->getSchoolData($bulan, $tahun, $kecamatan);

        return view('admin.laporan-print', compact('dataLaporan', 'laporanSekolah', 'bulan', 'tahun', 'kecamatan', 'masterKecamatan'));
    }

    private function getRealData($bulan, $tahun, $kecamatanFilter = null)
    {
        $masterKecamatan = \App\Models\MasterKecamatan::all();
        $masterKelurahan = \App\Models\MasterKelurahan::all();

        $kecamatanMap = [];
        foreach ($masterKecamatan as $kec) {
            // Find kelurahan by matching the name
            $desa = $masterKelurahan->filter(function($k) use ($kec) {
                return str_ireplace(['Kecamatan ', 'Kec. '], '', $k->kecamatan_nama) == str_ireplace(['Kecamatan ', 'Kec. '], '', $kec->nama);
            })->pluck('nama')->toArray();

            $kecKode = $kec->kode ?: str_pad($kec->id, 2, '0', STR_PAD_LEFT);
            $kecamatanMap[$kecKode] = [
                'nama' => strtoupper(str_ireplace(['Kecamatan ', 'Kec. '], '', $kec->nama)),
                'desa' => array_map('strtoupper', $desa)
            ];
        }

        $report = [];
        $kotaTotal = [
            'type' => 'kota',
            'kode' => '33.76',
            'wilayah' => 'KOTA TEGAL',
            'tanggal' => '', 'hari' => '', 'keterangan' => '',
            'perekaman_ikd' => 0, 'ikd_sudah' => 0, 'ikd_belum' => 0,
            'perekaman_ktp' => 0, 'ktp_sudah' => 0, 'ktp_belum' => 0,
            'perekaman_kia' => 0, 'kia_sudah' => 0, 'kia_belum' => 0,
        ];

        foreach ($kecamatanMap as $kecKode => $kecData) {
            if ($kecamatanFilter && strtoupper($kecamatanFilter) !== $kecData['nama']) continue;

            $kecTotal = [
                'type' => 'kecamatan',
                'kode' => '33.76.' . $kecKode,
                'wilayah' => $kecData['nama'],
                'tanggal' => '', 'hari' => '', 'keterangan' => '',
                'perekaman_ikd' => 0, 'ikd_sudah' => 0, 'ikd_belum' => 0,
                'perekaman_ktp' => 0, 'ktp_sudah' => 0, 'ktp_belum' => 0,
                'perekaman_kia' => 0, 'kia_sudah' => 0, 'kia_belum' => 0,
            ];

            $kelurahanRows = [];
            foreach ($kecData['desa'] as $desaIndex => $desaName) {
                $query = DB::table('pengajuan_layanan')
                    ->where(function($q) use ($desaName, $kecData) {
                        $q->where('lokasi_pelayanan', 'like', '%' . $desaName . '%')
                          ->orWhere('lokasi_pelayanan', 'like', '%' . ucwords(strtolower($desaName)) . '%');
                    });

                if ($bulan && $bulan !== 'all') {
                    $query->whereYear('pengajuan_layanan.tanggal_pengajuan', $tahun)
                          ->whereMonth('pengajuan_layanan.tanggal_pengajuan', $bulan);
                } else {
                    $query->whereYear('pengajuan_layanan.tanggal_pengajuan', $tahun);
                }

                $allRows = (clone $query)->select('pengajuan_layanan.*')->get();

                // calculate stats
                $rekamKtp = $allRows->filter(fn($r) => stripos((string)$r->jenis_layanan, 'KTP') !== false)->count();
                $sudahKtp = $allRows->filter(fn($r) => stripos((string)$r->jenis_layanan, 'KTP') !== false && $r->status === 'selesai')->count();
                $sudahKtpQty = $allRows->filter(fn($r) => stripos((string)$r->jenis_layanan, 'KTP') !== false && $r->status === 'selesai')->sum('jumlah_realisasi') ?? $sudahKtp;
                if ($sudahKtpQty == 0) $sudahKtpQty = $sudahKtp;

                $rekamIkd = $allRows->filter(fn($r) => stripos((string)$r->jenis_layanan, 'IKD') !== false)->count();
                $sudahIkd = $allRows->filter(fn($r) => stripos((string)$r->jenis_layanan, 'IKD') !== false && $r->status === 'selesai')->count();
                $sudahIkdQty = $allRows->filter(fn($r) => stripos((string)$r->jenis_layanan, 'IKD') !== false && $r->status === 'selesai')->sum('jumlah_ikd') ?? $sudahIkd;
                if ($sudahIkdQty == 0) $sudahIkdQty = $sudahIkd;

                $rekamKia = $allRows->filter(fn($r) => stripos((string)$r->jenis_layanan, 'KIA') !== false)->count();
                $sudahKia = $allRows->filter(fn($r) => stripos((string)$r->jenis_layanan, 'KIA') !== false && $r->status === 'selesai')->count();
                $sudahKiaQty = $allRows->filter(fn($r) => stripos((string)$r->jenis_layanan, 'KIA') !== false && $r->status === 'selesai')->sum('jumlah_kia') ?? $sudahKia;
                if ($sudahKiaQty == 0) $sudahKiaQty = $sudahKia;

                $row = [
                    'type'          => 'kelurahan',
                    'kode'          => '33.76.' . $kecKode . '.' . (1001 + $desaIndex),
                    'wilayah'       => $desaName,
                    'tanggal'       => ($bulan && $bulan !== 'all') ? Carbon::create($tahun, $bulan)->format('M Y') : "Tahun $tahun",
                    'hari'          => ($bulan && $bulan !== 'all') ? Carbon::create($tahun, $bulan)->translatedFormat('F') : 'Tahunan',
                    'keterangan'    => $allRows->count() > 0 ? 'Update Terkini' : 'Menunggu',
                    'perekaman_ikd' => $rekamIkd,
                    'ikd_sudah'     => $sudahIkdQty,
                    'ikd_belum'     => max(0, $rekamIkd - $sudahIkdQty),
                    'perekaman_ktp' => $rekamKtp,
                    'ktp_sudah'     => $sudahKtpQty,
                    'ktp_belum'     => max(0, $rekamKtp - $sudahKtpQty),
                    'perekaman_kia' => $rekamKia,
                    'kia_sudah'     => $sudahKiaQty,
                    'kia_belum'     => max(0, $rekamKia - $sudahKiaQty),
                ];

                $kecTotal['perekaman_ikd'] += $row['perekaman_ikd'];
                $kecTotal['ikd_sudah'] += $row['ikd_sudah'];
                $kecTotal['perekaman_ktp'] += $row['perekaman_ktp'];
                $kecTotal['ktp_sudah'] += $row['ktp_sudah'];
                $kecTotal['perekaman_kia'] += $row['perekaman_kia'];
                $kecTotal['kia_sudah'] += $row['kia_sudah'];

                $kelurahanRows[] = $row;
            }

            $kecTotal['ikd_belum'] = max(0, $kecTotal['perekaman_ikd'] - $kecTotal['ikd_sudah']);
            $kecTotal['ktp_belum'] = max(0, $kecTotal['perekaman_ktp'] - $kecTotal['ktp_sudah']);
            $kecTotal['kia_belum'] = max(0, $kecTotal['perekaman_kia'] - $kecTotal['kia_sudah']);

            $kotaTotal['perekaman_ikd'] += $kecTotal['perekaman_ikd'];
            $kotaTotal['ikd_sudah'] += $kecTotal['ikd_sudah'];
            $kotaTotal['ikd_belum'] += $kecTotal['ikd_belum'];
            $kotaTotal['perekaman_ktp'] += $kecTotal['perekaman_ktp'];
            $kotaTotal['ktp_sudah'] += $kecTotal['ktp_sudah'];
            $kotaTotal['ktp_belum'] += $kecTotal['ktp_belum'];
            $kotaTotal['perekaman_kia'] += $kecTotal['perekaman_kia'];
            $kotaTotal['kia_sudah'] += $kecTotal['kia_sudah'];
            $kotaTotal['kia_belum'] += $kecTotal['kia_belum'];

            $report[] = $kecTotal;
            foreach ($kelurahanRows as $r) {
                $report[] = $r;
            }
        }

        array_unshift($report, $kotaTotal);

        return $report;
    }

    private function getSchoolData($bulan, $tahun, $kecamatan = null)
    {
        // Sistem tidak melacak data per-sekolah dalam skema ini
        return collect([]);
    }

    public function target()
    {
        $allTargets = \Illuminate\Support\Facades\Schema::hasTable('regional_targets')
            ? \Illuminate\Support\Facades\DB::table('regional_targets')->orderBy('id')->get()
            : collect([]);

        $kecamatanTargets = [];
        $kelurahanTargets = [];
        $kotaTarget = null;
        foreach($allTargets as $t) {
            if (strtoupper($t->kecamatan) === 'KOTA TEGAL' && empty($t->kelurahan)) {
                $kotaTarget = $t;
            } elseif (empty($t->kelurahan)) {
                $kecamatanTargets[strtoupper($t->kecamatan)] = $t;
            } else {
                $kelurahanTargets[strtoupper($t->kecamatan)][] = $t;
            }
        }
            
        // Map kode for kecamatan and kelurahan
        $kecamatanMap = [
            'TEGAL BARAT' => '01',
            'TEGAL TIMUR' => '02',
            'TEGAL SELATAN' => '03',
            'MARGADANA' => '04',
        ];

        return view('admin.laporan-target', compact('kecamatanTargets', 'kelurahanTargets', 'kecamatanMap', 'kotaTarget'));
    }

    public function updateTarget(Request $request)
    {
        $targets = $request->input('targets');
        if ($targets && is_array($targets)) {
            foreach ($targets as $id => $data) {
                \Illuminate\Support\Facades\DB::table('regional_targets')->where('id', $id)->update([
                    'target_ktp' => $data['ktp'] ?? 0,
                    'target_kia' => $data['kia'] ?? 0,
                    'target_ikd' => $data['ikd'] ?? 0,
                ]);
            }
        }
        return back()->with('success', 'Target layanan berhasil diperbarui!');
    }
}

