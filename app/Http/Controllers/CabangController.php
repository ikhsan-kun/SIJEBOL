<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanLayanan;
use App\Models\School;
use App\Models\JadwalJebol;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CabangController extends Controller
{
    public function dashboard()
    {
        // Stats
        $sekolahCount = School::count();
        $totalSiswa = School::sum('jumlah_siswa');
        
        $pengajuanCount = PengajuanLayanan::where(function($q) {
            $q->where('lokasi_pelayanan', 'LIKE', 'Sekolah%')
              ->orWhere('jenis_pengajuan', 'Sekolah')
              ->orWhereHas('user', function($uq) {
                  $uq->where('location_type', 'sekolah');
              })
              ->orWhereHas('masyarakat', function($mq) {
                  $mq->where('tipe_pendaftar', 'sekolah');
              });
        })->count();
        
        $terjadwalCount = JadwalJebol::where('status', 'Terjadwal')
                            ->where('jenis_lokasi', 'Sekolah')
                            ->count();
                            
        $selesaiCount = PengajuanLayanan::where(function($q) {
            $q->where('lokasi_pelayanan', 'LIKE', 'Sekolah%')
              ->orWhere('jenis_pengajuan', 'Sekolah')
              ->orWhereHas('user', function($uq) {
                  $uq->where('location_type', 'sekolah');
              })
              ->orWhereHas('masyarakat', function($mq) {
                  $mq->where('tipe_pendaftar', 'sekolah');
              });
        })->where('status', 'selesai')->count();

        $siswaTerlayani = PengajuanLayanan::where(function($q) {
            $q->where('lokasi_pelayanan', 'LIKE', 'Sekolah%')
              ->orWhere('jenis_pengajuan', 'Sekolah')
              ->orWhereHas('user', function($uq) {
                  $uq->where('location_type', 'sekolah');
              })
              ->orWhereHas('masyarakat', function($mq) {
                  $mq->where('tipe_pendaftar', 'sekolah');
              });
        })->where('status', 'selesai')->sum('jumlah_realisasi');

        // Jadwal Pelayanan Terdekat
        $nextSchedule = JadwalJebol::where('tanggal_pelayanan', '>=', Carbon::today())
            ->where('status', 'Terjadwal')
            ->where('jenis_lokasi', 'Sekolah')
            ->where('lokasi', 'NOT LIKE', 'Kec.%')
            ->where('lokasi', 'NOT LIKE', 'Kecamatan%')
            ->orderBy('tanggal_pelayanan', 'asc')
            ->first();
            
        // Aktivitas Terbaru 
        $aktivitas = PengajuanLayanan::where(function($q) {
            $q->where('lokasi_pelayanan', 'LIKE', 'Sekolah%')
              ->orWhere('jenis_pengajuan', 'Sekolah')
              ->orWhereHas('user', function($uq) {
                  $uq->where('location_type', 'sekolah');
              })
              ->orWhereHas('masyarakat', function($mq) {
                  $mq->where('tipe_pendaftar', 'sekolah');
              });
        })->whereNotIn('status', ['pending', 'selesai', 'ditolak'])
          ->orderBy('tanggal_pengajuan', 'desc')
          ->take(6)
          ->get();
 
        // New data for redesign
        $recentSchools = School::orderBy('created_at', 'desc')->take(5)->get();
        $upcomingJadwals = JadwalJebol::where('tanggal_pelayanan', '>=', Carbon::today())
            ->where('jenis_lokasi', 'Sekolah')
            ->where('lokasi', 'NOT LIKE', 'Kec.%')
            ->where('lokasi', 'NOT LIKE', 'Kecamatan%')
            ->orderBy('tanggal_pelayanan', 'asc')
            ->take(4)
            ->get();

        // 7 Days Stats for Cabang
        $startDate = now()->subDays(6)->startOfDay();
        $endDate = now()->endOfDay();
        
        $stats = \App\Models\PengajuanLayanan::select(
                \Illuminate\Support\Facades\DB::raw('DATE(tanggal_pengajuan) as tanggal'),
                \Illuminate\Support\Facades\DB::raw('COUNT(*) as total')
            )
            ->where(function($q) {
                $q->where('lokasi_pelayanan', 'LIKE', 'Sekolah%')
                  ->orWhere('jenis_pengajuan', 'Sekolah')
                  ->orWhereHas('user', function($uq) {
                      $uq->where('location_type', 'sekolah');
                  })
                  ->orWhereHas('masyarakat', function($mq) {
                      $mq->where('tipe_pendaftar', 'sekolah');
                  });
            })
            ->whereBetween('tanggal_pengajuan', [$startDate, $endDate])
            ->groupBy('tanggal')
            ->get()
            ->pluck('total', 'tanggal');
            
        $selesaiStats = \App\Models\PengajuanLayanan::select(
                \Illuminate\Support\Facades\DB::raw('DATE(tanggal_pengajuan) as tanggal'),
                \Illuminate\Support\Facades\DB::raw('COUNT(*) as total')
            )
            ->where(function($q) {
                $q->where('lokasi_pelayanan', 'LIKE', 'Sekolah%')
                  ->orWhere('jenis_pengajuan', 'Sekolah')
                  ->orWhereHas('user', function($uq) {
                      $uq->where('location_type', 'sekolah');
                  })
                  ->orWhereHas('masyarakat', function($mq) {
                      $mq->where('tipe_pendaftar', 'sekolah');
                  });
            })
            ->whereBetween('tanggal_pengajuan', [$startDate, $endDate])
            ->where('status', 'selesai')
            ->groupBy('tanggal')
            ->get()
            ->pluck('total', 'tanggal');

        $chartLabels = [];
        $chartData = [];
        $chartSelesaiData = [];

        for ($i = 6; $i >= 0; $i--) {
            $dateObj = now()->subDays($i);
            $dateStr = $dateObj->toDateString();
            
            $chartLabels[] = $dateObj->translatedFormat('d M');
            $chartData[] = $stats[$dateStr] ?? 0;
            $chartSelesaiData[] = $selesaiStats[$dateStr] ?? 0;
        }

        // Sebaran Jenis Layanan for Cabang
        $sebaranLayanan = \App\Models\PengajuanLayanan::select('jenis_layanan', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->where(function($q) {
                $q->where('lokasi_pelayanan', 'LIKE', 'Sekolah%')
                  ->orWhere('jenis_pengajuan', 'Sekolah')
                  ->orWhereHas('user', function($uq) {
                      $uq->where('location_type', 'sekolah');
                  })
                  ->orWhereHas('masyarakat', function($mq) {
                      $mq->where('tipe_pendaftar', 'sekolah');
                  });
            })
            ->groupBy('jenis_layanan')
            ->orderBy('total', 'desc')
            ->take(4)
            ->get();

        return view('cabang.dashboard', compact(
            'sekolahCount', 'totalSiswa', 'pengajuanCount', 'terjadwalCount', 
            'selesaiCount', 'siswaTerlayani', 'nextSchedule', 'aktivitas', 'recentSchools', 'upcomingJadwals',
            'chartLabels', 'chartData', 'chartSelesaiData', 'sebaranLayanan'
        ));
    }

    public function sekolah(Request $request)
    {
        $users = \App\Models\User::where('role', 'user')->whereNotNull('school')->where('school', '!=', '')->get();
        foreach ($users as $user) {
            $school = School::where('nama_sekolah', $user->school)->first();
            if (!$school) {
                School::create([
                    'nama_sekolah' => $user->school,
                    'kecamatan' => $user->kecamatan,
                    'tingkat' => 'Tingkat Lainnya', // Default fallback
                    'jumlah_siswa' => 100, // Dummy
                    'cabang_id' => Auth::id()
                ]);
            }
        }
        
        $query = School::query();
        if ($search = $request->get('search')) {
            $query->where('nama_sekolah', 'like', "%{$search}%")
                  ->orWhere('npsn', 'like', "%{$search}%")
                  ->orWhere('kecamatan', 'like', "%{$search}%");
        }
        $schools = $query->paginate(15)->withQueryString();

        foreach($schools as $s) {
            $s->total_pengajuan = PengajuanLayanan::where(function($q) use($s) {
                $q->whereHas('user', function($uq) use($s) {
                    $uq->where('school', $s->nama_sekolah);
                })->orWhereHas('masyarakat', function($mq) use($s) {
                    $mq->where('school', $s->nama_sekolah);
                });
            })->count();
            $s->pengajuan_selesai = PengajuanLayanan::where(function($q) use($s) {
                $q->whereHas('user', function($uq) use($s) {
                    $uq->where('school', $s->nama_sekolah);
                })->orWhereHas('masyarakat', function($mq) use($s) {
                    $mq->where('school', $s->nama_sekolah);
                });
            })->sum('jumlah_realisasi');
            
            $jadwal = JadwalJebol::where('lokasi', 'like', '%' . $s->nama_sekolah . '%')->orderBy('tanggal_pelayanan', 'desc')->first();
            if ($jadwal) {
                $s->jadwal_terbaru = $jadwal;
                $tanggalJadwal = \Carbon\Carbon::parse($jadwal->tanggal_pelayanan)->startOfDay();
                $hariIni = now()->startOfDay();
                
                if ($s->jumlah_siswa > 0 && $s->pengajuan_selesai >= $s->jumlah_siswa) {
                    $s->status_jempol = 'Selesai';
                } else {
                    $s->status_jempol = 'Dijadwalkan';
                }
            } else {
                $s->status_jempol = 'Belum Dijadwalkan';
            }
        }

        if ($status_filter = $request->get('status')) {
            $schools = $schools->where('status_jempol', $status_filter);
        }

        if ($tanggal_filter = $request->get('tanggal')) {
            $schools = $schools->filter(function($s) use ($tanggal_filter) {
                return $s->jadwal_terbaru && \Carbon\Carbon::parse($s->jadwal_terbaru->tanggal_pelayanan)->format('Y-m-d') == $tanggal_filter;
            });
        }

        return view('cabang.sekolah', compact('schools'));
    }

    public function monitoring(Request $request)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $query = PengajuanLayanan::with(['user', 'masyarakat'])->where(function($q) {
            $q->whereHas('user', function($uq) {
                $uq->where('location_type', 'sekolah');
            })->orWhereHas('masyarakat', function($mq) {
                $mq->where('tipe_pendaftar', 'sekolah');
            })->orWhere('jenis_pengajuan', 'Sekolah');
        });

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nomor_tiket', 'like', "%{$search}%")
                  ->orWhereHas('user', function($uq) use ($search) {
                      $uq->where('school', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('masyarakat', function($mq) use ($search) {
                      $mq->where('school', 'like', "%{$search}%")
                        ->orWhere('nama', 'like', "%{$search}%");
                  });
            });
        }
        if ($status && $status !== 'semua') {
            $query->where('status', $status);
        }
        if ($startDate) {
            $query->whereDate('tanggal_pengajuan', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('tanggal_pengajuan', '<=', $endDate);
        }

        $permohonans = $query->orderByRaw("
            CASE 
                WHEN status IN ('pending', 'menunggu_verifikasi') THEN 1
                WHEN status = 'terverifikasi' THEN 2
                WHEN status = 'terjadwal' THEN 3
                WHEN status = 'diproses' THEN 4
                WHEN status = 'selesai' THEN 5
                WHEN status = 'ditolak' THEN 6
                ELSE 7
            END
        ")->latest('tanggal_pengajuan')->paginate(10)->withQueryString();

        $schoolFilter = function($q) {
            $q->whereHas('user', function($uq) {
                $uq->where('location_type', 'sekolah');
            })->orWhereHas('masyarakat', function($mq) {
                $mq->where('tipe_pendaftar', 'sekolah');
            })->orWhere('jenis_pengajuan', 'Sekolah');
        };

        $stats = [
            'total' => PengajuanLayanan::where($schoolFilter)->count(),
            'pending' => PengajuanLayanan::where($schoolFilter)->whereIn('status', ['pending', 'menunggu_verifikasi'])->count(),
            'diproses' => PengajuanLayanan::where($schoolFilter)->where('status', 'diproses')->count(),
            'selesai' => PengajuanLayanan::where($schoolFilter)->where('status', 'selesai')->count(),
            'ditolak' => PengajuanLayanan::where($schoolFilter)->where('status', 'ditolak')->count(),
        ];

        return view('cabang.monitoring', compact('permohonans', 'stats'));
    }

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
            $pengajuan = \App\Models\PengajuanLayanan::where(function($q) use ($school) {
                $q->whereHas('user', function($uq) use ($school) {
                    $uq->where('school', $school->nama_sekolah);
                })->orWhereHas('masyarakat', function($mq) use ($school) {
                    $mq->where('school', $school->nama_sekolah);
                })->orWhere('lokasi_pelayanan', 'LIKE', '%' . $school->nama_sekolah . '%');
            })->whereYear('tanggal_pengajuan', $tahun);
            if ($bulan) $pengajuan->whereMonth('tanggal_pengajuan', $bulan);
            $pengajuan = $pengajuan->where('status', 'selesai')->get();

            $ktp = 0;
            $kia = 0;
            $ikd = 0;
            foreach ($pengajuan as $p) {
                $jl = strtolower($p->jenis_layanan ?? '');
                if (str_contains($jl, 'ktp')) {
                    $ktp += $p->jumlah_realisasi ?? 0;
                } elseif (str_contains($jl, 'kia')) {
                    $kia += $p->jumlah_kia ?? $p->jumlah_realisasi ?? 0;
                } elseif (str_contains($jl, 'ikd')) {
                    $ikd += $p->jumlah_ikd ?? $p->jumlah_realisasi ?? 0;
                } else {
                    $ktp += $p->jumlah_realisasi ?? 0;
                }
            }
            $total = $ktp + $kia + $ikd;

            $jadwal = \App\Models\JadwalJebol::where('lokasi', 'like', '%' . $school->nama_sekolah . '%')
                ->orderBy('tanggal_pelayanan', 'desc')
                ->first();
            $waktu_ket = $jadwal ? \Carbon\Carbon::parse($jadwal->tanggal_pelayanan)->format('d/m/Y') : 'Belum Ada';

            $school_stats->push((object)[
                'nama_sekolah' => $school->nama_sekolah,
                'tingkat' => $school->tingkat,
                'fokus_layanan' => $school->fokus_layanan ?? 'KTP-el',
                'npsn' => $school->npsn ?? '-',
                'alamat' => $school->alamat ?? '-',
                'kecamatan' => $school->kecamatan ?? '-',
                'kelurahan' => $school->kelurahan ?? '-',
                'waktu_ket' => $waktu_ket,
                'ktp' => $ktp,
                'kia' => $kia,
                'ikd' => $ikd,
                'sudah' => $total,
                'belum' => max(0, (int)$school->jumlah_siswa - $total),
                'keseluruhan' => (int)$school->jumlah_siswa,
            ]);

            $total_ktp += $ktp;
            $total_kia += $kia;
            $total_ikd += $ikd;
            $total_pelayanan += $total;
        }
        $school_stats = $school_stats->sortByDesc('keseluruhan');

        // --- Data Jadwal JEBOL ---
        $jadwal_jebol = \App\Models\JadwalJebol::where(function($q) {
            $q->where('jenis_lokasi', 'Sekolah')
              ->orWhere('nama_kegiatan', 'like', '%sekolah%');
        })->whereYear('tanggal_pelayanan', $tahun);
        if ($bulan) $jadwal_jebol->whereMonth('tanggal_pelayanan', $bulan);
        $jadwal_jebol = $jadwal_jebol->orderBy('tanggal_pelayanan', 'desc')->get();

        // --- Data Monitoring Pengajuan ---
        $pengajuan_all = \App\Models\PengajuanLayanan::with(['user', 'masyarakat'])->where(function($q) {
            $q->whereHas('user', function($uq) {
                $uq->where('location_type', 'sekolah');
            })->orWhereHas('masyarakat', function($mq) {
                $mq->where('tipe_pendaftar', 'sekolah');
            })->orWhere('jenis_pengajuan', 'Sekolah');
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
            $html .= '<tr style="height: 30px;"><th colspan="8" style="font-size: 16px; font-weight:bold; text-align: center; border: none; vertical-align: middle;">LAPORAN PELAYANAN JEBOL PER SEKOLAH</th></tr>';
            $html .= '<tr style="height: 30px;"><th colspan="8" style="text-align: center; border: none; vertical-align: middle;">Periode: ' . $periode . '</th></tr>';
            $html .= '<tr><td colspan="8" style="border: none; height: 15px;"></td></tr>';
            
            $html .= '<tr style="background-color: #1f8a89; color: white; height: 40px;">';
            $html .= '<th style="text-align: center; border: 1px solid #000;">No</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">NPSN</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Nama Sekolah</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Jenjang</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Wilayah</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Target Siswa</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Sudah Pelayanan</th>';
            $html .= '<th style="text-align: center; border: 1px solid #000;">Belum Pelayanan</th>';
            $html .= '</tr>';
            
            $rowIndex = 0;
            foreach ($school_stats as $stat) {
                $bgColor = ($rowIndex % 2 == 0) ? '#f2f2f2' : '#ffffff';
                $wilayah = $stat->kecamatan;
                if ($stat->kelurahan && $stat->kelurahan !== '-') {
                    $wilayah .= ' - ' . $stat->kelurahan;
                }
                $html .= '<tr style="height: 25px;">';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">'.($rowIndex + 1).'</td>';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center; mso-number-format:\'\@\';">'.htmlspecialchars($stat->npsn).'</td>';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000;">'.htmlspecialchars($stat->nama_sekolah).'</td>';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">'.htmlspecialchars($stat->tingkat).'</td>';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000;">'.htmlspecialchars($wilayah).'</td>';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">'.$stat->keseluruhan.'</td>';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">'.$stat->sudah.'</td>';
                $html .= '<td style="background-color: '.$bgColor.'; border: 1px solid #000; text-align: center;">'.$stat->belum.'</td>';
                $html .= '</tr>';
                $rowIndex++;
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
            $pengajuan = \App\Models\PengajuanLayanan::where(function($q) use ($school) {
                $q->whereHas('user', function($uq) use ($school) {
                    $uq->where('school', $school->nama_sekolah);
                })->orWhereHas('masyarakat', function($mq) use ($school) {
                    $mq->where('school', $school->nama_sekolah);
                })->orWhere('lokasi_pelayanan', 'LIKE', '%' . $school->nama_sekolah . '%');
            })->whereYear('tanggal_pengajuan', $tahun);
            if ($bulan) $pengajuan->whereMonth('tanggal_pengajuan', $bulan);
            $pengajuan = $pengajuan->where('status', 'selesai')->get();

            $ktp = 0;
            $kia = 0;
            $ikd = 0;
            foreach ($pengajuan as $p) {
                $jl = strtolower($p->jenis_layanan ?? '');
                if (str_contains($jl, 'ktp')) {
                    $ktp += $p->jumlah_realisasi ?? 0;
                } elseif (str_contains($jl, 'kia')) {
                    $kia += $p->jumlah_kia ?? $p->jumlah_realisasi ?? 0;
                } elseif (str_contains($jl, 'ikd')) {
                    $ikd += $p->jumlah_ikd ?? $p->jumlah_realisasi ?? 0;
                } else {
                    $ktp += $p->jumlah_realisasi ?? 0;
                }
            }
            $total = $ktp + $kia + $ikd;

            $jadwal = \App\Models\JadwalJebol::where('lokasi', 'like', '%' . $school->nama_sekolah . '%')
                ->orderBy('tanggal_pelayanan', 'desc')
                ->first();
            $waktu_ket = $jadwal ? \Carbon\Carbon::parse($jadwal->tanggal_pelayanan)->format('d/m/Y') : 'Belum Ada';

            $school_stats->push((object)[
                'nama_sekolah' => $school->nama_sekolah,
                'tingkat' => $school->tingkat,
                'fokus_layanan' => $school->fokus_layanan ?? 'KTP-el',
                'npsn' => $school->npsn ?? '-',
                'alamat' => $school->alamat ?? '-',
                'kecamatan' => $school->kecamatan ?? '-',
                'kelurahan' => $school->kelurahan ?? '-',
                'waktu_ket' => $waktu_ket,
                'ktp' => $ktp,
                'kia' => $kia,
                'ikd' => $ikd,
                'sudah' => $total,
                'belum' => max(0, (int)$school->jumlah_siswa - $total),
                'keseluruhan' => (int)$school->jumlah_siswa,
            ]);

            $total_ktp += $ktp;
            $total_kia += $kia;
            $total_ikd += $ikd;
            $total_pelayanan += $total;
        }
        $school_stats = $school_stats->sortByDesc('keseluruhan');

        // --- Data Jadwal JEBOL ---
        $jadwal_jebol = \App\Models\JadwalJebol::where(function($q) {
            $q->where('jenis_lokasi', 'Sekolah')
              ->orWhere('nama_kegiatan', 'like', '%sekolah%');
        })->whereYear('tanggal_pelayanan', $tahun);
        if ($bulan) $jadwal_jebol->whereMonth('tanggal_pelayanan', $bulan);
        $jadwal_jebol = $jadwal_jebol->orderBy('tanggal_pelayanan', 'desc')->get();

        // --- Data Monitoring Pengajuan ---
        $pengajuan_all = \App\Models\PengajuanLayanan::with(['user', 'masyarakat'])->where(function($q) {
            $q->whereHas('user', function($uq) {
                $uq->where('location_type', 'sekolah');
            })->orWhereHas('masyarakat', function($mq) {
                $mq->where('tipe_pendaftar', 'sekolah');
            })->orWhere('jenis_pengajuan', 'Sekolah');
        })->whereYear('tanggal_pengajuan', $tahun);
        if ($bulan) $pengajuan_all->whereMonth('tanggal_pengajuan', $bulan);
        $pengajuan_all = $pengajuan_all->get();

        $status_stats = (object)[
            'menunggu' => $pengajuan_all->where('status', 'menunggu_verifikasi')->count(),
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

    public function storeSekolah(Request $request) {
        $request->validate(['nama_sekolah' => 'required', 'kecamatan' => 'required']);
        School::create([
            'nama_sekolah' => $request->nama_sekolah, 
            'kecamatan' => $request->kecamatan, 
            'kelurahan' => $request->desa,
            'tingkat' => $request->tingkat ?? 'Umum',
            'jumlah_siswa' => $request->jumlah_siswa ?? 0, 
            'npsn' => $request->npsn,
            'alamat' => $request->alamat,
            'cabang_id' => Auth::id(),
            'fokus_layanan' => $request->fokus_layanan
        ]);
        return back()->with('success', 'Sekolah berhasil ditambahkan.');
    }
 
    public function updateSiswa(Request $request, $id) {
        $school = School::findOrFail($id);
        $school->update([
            'nama_sekolah' => $request->nama_sekolah,
            'npsn' => $request->npsn,
            'alamat' => $request->alamat,
            'jumlah_siswa' => $request->jumlah_siswa,
            'fokus_layanan' => $request->fokus_layanan,
            'tingkat' => $request->tingkat
        ]);
        return back()->with('success', 'Data sekolah diperbarui.');
    }

    public function ajukanJadwalSekolah(Request $request) {
        $school = $request->get('school');
        $schoolInfo = \App\Models\School::where('nama_sekolah', $school)->first();
        return view('cabang.ajukan-jadwal-sekolah', compact('school', 'schoolInfo'));
    }

    public function storeJadwalSekolah(Request $request) {
        $lokasiFix = 'Sekolah ' . $request->lokasi;
        if ($request->filled('detail_lokasi')) {
            $lokasiFix .= ' (' . $request->detail_lokasi . ')';
        }

        $detailPengajuan = json_encode([
            'usulan_tanggal' => $request->tanggal,
            'usulan_jam_mulai' => $request->jam_mulai,
            'usulan_jam_selesai' => $request->jam_selesai,
            'kategori_layanan' => $request->kategori,
        ]);

        $schoolInfo = \App\Models\User::where('school', $request->lokasi)->first();
        
        $picName = 'PJ ' . $request->lokasi;
        $picPhone = null;
        
        if ($request->filled('pic')) {
            $picInput = $request->pic;
            if (preg_match('/\((.*?)\)/', $picInput, $matches)) {
                $picPhone = preg_replace('/[^0-9]/', '', $matches[1]);
                $picName = trim(preg_replace('/\((.*?)\)/', '', $picInput));
            } else {
                $picName = $picInput;
                if (preg_match('/[0-9]{10,13}/', $picInput, $matches)) {
                    $picPhone = $matches[0];
                    $picName = trim(str_replace($picPhone, '', $picInput));
                }
            }
            if (empty($picName)) {
                $picName = 'PJ ' . $request->lokasi;
            }
        }

        $pj = \App\Models\User::firstOrCreate(
            ['school' => $request->lokasi, 'role' => 'user'],
            [
                'name' => $picName,
                'nik' => '3376' . rand(100000, 999999) . rand(100000, 999999),
                'phone' => $picPhone,
                'email' => strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $request->lokasi)) . rand(100,999) . '@jeboll.com',
                'password' => bcrypt('password123'),
                'location_type' => 'sekolah',
                'kecamatan' => $request->kecamatan ?? ($schoolInfo ? $schoolInfo->kecamatan : 'Kota Tegal'),
                'desa' => $request->desa ?? ($schoolInfo ? $schoolInfo->desa : null),
                'status' => 'active'
            ]
        );
        
        if ($request->filled('pic')) {
            $pj->name = $picName;
            $pj->phone = $picPhone;
        }
        if ($request->filled('kecamatan')) {
            $pj->kecamatan = $request->kecamatan;
        }
        if ($request->filled('desa')) {
            $pj->desa = $request->desa;
        }
        $pj->save();

        \App\Models\Masyarakat::updateOrCreate(
            ['nik' => $pj->nik],
            [
                'nama' => $pj->name,
                'email' => $pj->email,
                'password' => $pj->password,
                'no_hp' => $pj->phone,
                'alamat' => $lokasiFix,
                'role' => 'user'
            ]
        );

        \App\Models\PengajuanLayanan::create([
            'nik' => $pj->nik,
            'nomor_tiket' => 'JB-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(4)),
            'jenis_layanan' => $request->kategori,
            'jenis_pengajuan' => 'Sekolah',
            'tanggal_pengajuan' => now(),
            'alamat' => $schoolInfo ? $schoolInfo->alamat : $lokasiFix,
            'lokasi_pelayanan' => $lokasiFix,
            'keterangan' => $request->keterangan ?? null,
            'detail_pengajuan' => $detailPengajuan,
            'status' => 'menunggu_verifikasi',
        ]);

        return redirect()->route('cabang.sekolah')->with('success', 'Usulan jadwal berhasil diajukan dan sedang menunggu verifikasi Disdukcapil.');
    }

    public function destroySekolah($id) {
        School::findOrFail($id)->delete();
        return back()->with('success', 'Sekolah berhasil dihapus.');
    }

    public function jadwal(Request $request) {
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));
        
        $currentDate = \Carbon\Carbon::createFromDate($year, $month, 1);
        $startOfCalendar = $currentDate->copy()->startOfMonth()->startOfWeek(\Carbon\Carbon::SUNDAY);
        $endOfCalendar = $currentDate->copy()->endOfMonth()->endOfWeek(\Carbon\Carbon::SATURDAY);

        $calendar = [];
        for ($date = $startOfCalendar->copy(); $date->lte($endOfCalendar); $date->addDay()) {
            $calendar[] = [
                'date' => $date->copy(),
                'isCurrentMonth' => $date->month == $currentDate->month,
                'isToday' => $date->isToday(),
            ];
        }

        $activities = JadwalJebol::all()->map(function($j) {
            $j->nama_kegiatan = $j->nama_kegiatan ?? 'Jemput Bola ' . $j->lokasi;
            $j->warna = 'blue';
            return $j;
        })->groupBy(function($act) {
            return \Carbon\Carbon::parse($act->tanggal_pelayanan)->format('Y-m-d');
        });

        $upcoming = JadwalJebol::where('tanggal_pelayanan', '>=', now()->startOfDay())->orderBy('tanggal_pelayanan')->take(5)->get()->map(function($j) {
            $j->nama_kegiatan = $j->nama_kegiatan ?? 'Jemput Bola ' . $j->lokasi;
            return $j;
        });

        $sekolahSelesai = PengajuanLayanan::whereHas('user', fn($q) => $q->where('location_type', 'sekolah'))->where('status', 'selesai')->count();

        return view('cabang.jadwal', compact('currentDate', 'calendar', 'activities', 'upcoming', 'sekolahSelesai'));
    }

    public function createJadwal() {
        $sekolahList = \App\Models\School::pluck('nama_sekolah');
        $kecamatanList = ['Kecamatan Tegal Barat', 'Kecamatan Tegal Timur', 'Kecamatan Tegal Selatan', 'Kecamatan Margadana'];
        return view('cabang.jadwal-baru', compact('sekolahList', 'kecamatanList'));
    }

    public function storeJadwal(Request $request) {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:100',
            'lokasi' => 'required|string|max:100',
            'tanggal_pelayanan' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'jenis_layanan' => 'required|array',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->except(['jenis_layanan', 'foto']);
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/jadwal'), $filename);
            $data['foto'] = 'uploads/jadwal/' . $filename;
        }

        $data['jenis_layanan'] = implode(', ', $request->jenis_layanan);
        $data['petugas'] = 'Belum Ditentukan';
        $data['kuota'] = 100;
        $data['jenis_lokasi'] = null;
        $data['status'] = 'Terjadwal';

        JadwalJebol::create($data);
        return redirect()->route('cabang.jadwal')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function profil()
    {
        $user = auth()->user();
        return view('cabang.profil', compact('user'));
    }

    public function profilEdit()
    {
        $user = auth()->user();
        return view('cabang.profil-edit', compact('user'));
    }

    public function profilUpdate(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|ends_with:@gmail.com|max:255',
            'phone'    => 'nullable|string|max:20',
            'jabatan'  => 'nullable|string|max:100',
            'alamat'   => 'nullable|string|max:500',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'email.ends_with' => 'Email harus menggunakan @gmail.com',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'jabatan', 'alamat', 'username']);

        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($user->foto_profil && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->foto_profil)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('profil', 'public');
        }

        $user->update($data);

        return redirect()->route('cabang.profil')->with('success', 'Profil berhasil diperbarui!');
    }

    public function profilPassword()
    {
        $user = auth()->user();
        return view('cabang.profil-password', compact('user'));
    }

    public function profilPasswordUpdate(\Illuminate\Http\Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Password lama wajib diisi',
            'new_password.required' => 'Password baru wajib diisi',
            'new_password.min' => 'Password minimal 6 karakter',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak cocok']);
        }

        $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        $user->save();

        return redirect()->route('cabang.profil')->with('success', 'Password berhasil diubah!');
    }
}
