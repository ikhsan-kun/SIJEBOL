<?php

namespace App\Http\Controllers;

use App\Models\PengajuanLayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class PermohonanController extends Controller
{
    /**
     * Tampilkan form pengajuan (Step 1-4)
     */
    public function create()
    {
        $services = \Illuminate\Support\Facades\DB::table('services')->where('status', 'AKTIF')->get();

        // Hitung jumlah pengajuan per kecamatan (status bukan ditolak)
        $kuotaPerKecamatan = PengajuanLayanan::whereNotIn('status', ['ditolak'])
            ->selectRaw("
                TRIM(SUBSTRING_INDEX(lokasi_pelayanan, ' - ', 1)) as kecamatan,
                COUNT(*) as jumlah
            ")
            ->whereNotNull('lokasi_pelayanan')
            ->groupByRaw("TRIM(SUBSTRING_INDEX(lokasi_pelayanan, ' - ', 1))")
            ->pluck('jumlah', 'kecamatan')
            ->toArray();

        $masterKecamatan = \App\Models\MasterKecamatan::where('status', 'Aktif')->get();
        $masterKelurahan = \App\Models\MasterKelurahan::where('status', 'Aktif')->get();

        return view('masyarakat.pengajuan', compact('services', 'kuotaPerKecamatan', 'masterKecamatan', 'masterKelurahan'));
    }

    /**
     * Simpan data pengajuan ke database
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'jenis_layanan'     => 'required',
            'lokasi_pelayanan'  => 'required',
            'kelurahan'         => 'required|string|max:255',
            'persetujuan'       => 'accepted',
            'nik'               => 'nullable|string|max:16',
            'nik_anak'          => 'nullable|string|max:16',
        ], [
            'required'          => 'Kolom :attribute wajib diisi.',
            'accepted'          => 'Anda harus menyetujui pernyataan.',
            'max'               => 'Kolom :attribute maksimal :max karakter.',
        ]);

        try {
            $nomor_tiket = 'JB-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(4));

            // Collect all inputs to save dynamically
            $detailData = $request->except(['_token', 'jenis_layanan', 'lokasi_pelayanan', 'jadwal_pelayanan', 'persetujuan', 'keterangan', 'jenis_pengajuan']);
            
            // Handle file uploads
            foreach ($request->allFiles() as $key => $file) {
                if ($request->hasFile($key)) {
                    $path = $file->store('lampiran_pengajuan', 'public');
                    $detailData[$key] = $path;
                }
            }
            
            $dataPemohon = json_encode($detailData);

            // Determine primary NIK and Phone based on service
            $primaryNik = Auth::user()->nik;
            $primaryPhone = $request->phone_ortu ?? $request->phone ?? Auth::user()->phone;
            $primaryAlamat = $request->alamat ?? Auth::user()->alamat ?? '-';

            $permohonan = PengajuanLayanan::create([
                'nik' => $primaryNik,
                'nomor_tiket' => $nomor_tiket,
                'jenis_layanan' => $request->jenis_layanan,
                'jenis_pengajuan' => $request->jenis_pengajuan ?? 'Baru',
                'no_hp' => $primaryPhone,
                'alamat' => $primaryAlamat,
                'keterangan' => $request->keterangan,
                'lokasi_pelayanan' => 'Kec. ' . $request->lokasi_pelayanan . ' - ' . $request->kelurahan,
                'status' => 'menunggu_verifikasi',
                'tanggal_pengajuan' => now(),
                'detail_pengajuan' => $dataPemohon,
            ]);

            // Cek Pengaturan Email Notifikasi Pengajuan Baru
            $settings = \Illuminate\Support\Facades\DB::table('app_settings')->first();
            $notifSettings = json_decode($settings->notification_settings ?? '{}');
            if (isset($notifSettings->email_pengajuan_baru) && $notifSettings->email_pengajuan_baru) {
                try {
                    \Illuminate\Support\Facades\Mail::to(Auth::user()->email)
                        ->send(new \App\Mail\PengajuanBaruMail($permohonan, Auth::user()));
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Gagal mengirim email pengajuan baru: ' . $e->getMessage());
                }
            }

            // Cek Pengaturan SMS/WA Notifikasi Pengajuan Baru
            if (isset($notifSettings->wa_active) && $notifSettings->wa_active) {
                $pesanWa = "Halo Bapak/Ibu " . Auth::user()->name . ",\n\nPengajuan layanan kependudukan Anda berhasil diterima di sistem SI JEBOL dengan No. Tiket: *" . $permohonan->nomor_tiket . "*.\n\nMohon simpan tiket ini dan tunggu informasi jadwal kedatangan mobil keliling di wilayah Anda. Terima kasih!";
                \App\Services\WhatsAppService::send(Auth::user()->phone ?? '081234567890', $pesanWa);
            }

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan berhasil terkirim!',
                'nomor_tiket' => $nomor_tiket
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Tampilkan riwayat pengajuan user
     */
    public function riwayat(Request $request)
    {
        $query = PengajuanLayanan::where('nik', Auth::user()->nik)
            ->orderBy('tanggal_pengajuan', 'desc');

        if ($request->filled('nomor_pengajuan')) {
            $query->where('nomor_tiket', 'LIKE', '%' . $request->nomor_pengajuan . '%');
        }

        if ($request->filled('layanan')) {
            $query->where('jenis_layanan', 'LIKE', '%' . $request->layanan . '%');
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_pengajuan', $request->tanggal);
        }

        // Calculate overall totals
        $totalPermohonan = (clone $query)->count();
        $totalJemputBola = (clone $query)->where('status', 'selesai')->count();

        $permohonan = $query->paginate(5)->withQueryString();
        
        return view('masyarakat.riwayat', compact('permohonan', 'totalPermohonan', 'totalJemputBola'));
    }

    /**
     * Export Riwayat to CSV
     */
    public function exportCsv(Request $request)
    {
        $query = \App\Models\PengajuanLayanan::where('nik', Auth::user()->nik)
            ->orderBy('tanggal_pengajuan', 'desc');

        if ($request->filled('nomor_pengajuan')) {
            $query->where('nomor_tiket', 'LIKE', '%' . $request->nomor_pengajuan . '%');
        }

        if ($request->filled('layanan')) {
            $query->where('jenis_layanan', 'LIKE', '%' . $request->layanan . '%');
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal_pengajuan', $request->tanggal);
        }

        $permohonan = $query->get();

        $fileName = 'riwayat_permohonan_' . date('Ymd_His') . '.xls';
        
        $headers = array(
            "Content-type"        => "application/vnd.ms-excel",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $callback = function() use($permohonan) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for character set safety
            fwrite($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header HTML with fully inline styles for absolute Excel engine compatibility
            $html = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv="Content-type" content="text/html;charset=utf-8" />
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">
  <h2 style="font-family: Arial, sans-serif; color: #003178; font-size: 16pt; margin: 0 0 5px 0; font-weight: bold;">
    Laporan Riwayat Layanan Kependudukan - SI JEBOL
  </h2>
  <p style="font-family: Arial, sans-serif; color: #64748b; font-size: 10pt; margin: 0 0 25px 0;">
    Tanggal Ekspor: ' . date('d-m-Y H:i') . ' WIB
  </p>
  
  <table style="border-collapse: collapse; border: 0.5pt solid #cbd5e1; width: 100%;">
    <thead>
      <tr>
        <th style="background-color: #003178; color: #ffffff; font-family: Arial, sans-serif; font-size: 10pt; font-weight: bold; padding: 12px 18px; border: 0.5pt solid #cbd5e1; text-align: left;">Tanggal Pengajuan</th>
        <th style="background-color: #003178; color: #ffffff; font-family: Arial, sans-serif; font-size: 10pt; font-weight: bold; padding: 12px 18px; border: 0.5pt solid #cbd5e1; text-align: left;">No. Tiket Permohonan</th>
        <th style="background-color: #003178; color: #ffffff; font-family: Arial, sans-serif; font-size: 10pt; font-weight: bold; padding: 12px 18px; border: 0.5pt solid #cbd5e1; text-align: left;">Jenis Layanan</th>
        <th style="background-color: #003178; color: #ffffff; font-family: Arial, sans-serif; font-size: 10pt; font-weight: bold; padding: 12px 18px; border: 0.5pt solid #cbd5e1; text-align: left;">Status Layanan</th>
        <th style="background-color: #003178; color: #ffffff; font-family: Arial, sans-serif; font-size: 10pt; font-weight: bold; padding: 12px 18px; border: 0.5pt solid #cbd5e1; text-align: left;">Keterangan Tambahan</th>
      </tr>
    </thead>
    <tbody>';
            
            foreach ($permohonan as $index => $p) {
                // Alternating row background color
                $rowBg = ($index % 2 === 0) ? '#ffffff' : '#f8fafc';
                
                // Beautifully colored status pill
                $statusVal = strtolower($p->status);
                if ($statusVal === 'selesai') {
                    $statusHtml = '<span style="background-color: #e2fbf0; color: #107c41; padding: 4px 10px; border-radius: 4px; font-weight: bold; font-size: 9pt; border: 0.5pt solid #107c41;">Selesai</span>';
                } elseif ($statusVal === 'ditolak') {
                    $statusHtml = '<span style="background-color: #fde8e8; color: #c81e1e; padding: 4px 10px; border-radius: 4px; font-weight: bold; font-size: 9pt; border: 0.5pt solid #c81e1e;">Ditolak</span>';
                } else {
                    $statusHtml = '<span style="background-color: #fff4e5; color: #b76400; padding: 4px 10px; border-radius: 4px; font-weight: bold; font-size: 9pt; border: 0.5pt solid #b76400;">Pending</span>';
                }

                $html .= '
      <tr style="background-color: ' . $rowBg . ';">
        <td style="font-family: Arial, sans-serif; font-size: 9.5pt; color: #334155; padding: 10px 14px; border: 0.5pt solid #cbd5e1;">' . $p->created_at->format('d-m-Y') . '</td>
        <td style="font-family: Arial, sans-serif; font-size: 9.5pt; color: #334155; padding: 10px 14px; border: 0.5pt solid #cbd5e1; font-weight: bold;">' . $p->nomor_tiket . '</td>
        <td style="font-family: Arial, sans-serif; font-size: 9.5pt; color: #334155; padding: 10px 14px; border: 0.5pt solid #cbd5e1;">' . $p->jenis_layanan . '</td>
        <td style="font-family: Arial, sans-serif; font-size: 9.5pt; padding: 10px 14px; border: 0.5pt solid #cbd5e1;">' . $statusHtml . '</td>
        <td style="font-family: Arial, sans-serif; font-size: 9.5pt; color: #475569; padding: 10px 14px; border: 0.5pt solid #cbd5e1;">' . ($p->keterangan ?? '-') . '</td>
      </tr>';
            }
            
            $html .= '
    </tbody>
  </table>
</body>
</html>';

            fwrite($file, $html);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Update User Settings
     */
    public function updateSettings(Request $request)
    {
        $user = Auth::user();
        
        // Cek apakah user adalah model Masyarakat
        $isMasyarakat = $user instanceof \App\Models\Masyarakat;
        $table = $isMasyarakat ? 'masyarakat' : 'users';
        $idField = $isMasyarakat ? 'id_masyarakat' : 'id';
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:' . $table . ',email,' . $user->$idField . ',' . $idField,
            'phone' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:1024',
        ]);

        if ($isMasyarakat) {
            $data = [
                'nama' => $request->name,
                'email' => $request->email,
                'no_hp' => $request->phone,
            ];

            if ($request->hasFile('profile_photo')) {
                if ($user->foto_profil) {
                    Storage::disk('public')->delete($user->foto_profil);
                }
                $data['foto_profil'] = $request->file('profile_photo')->store('profile-photos', 'public');
            }
        } else {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ];

            if ($request->hasFile('profile_photo')) {
                if ($user->profile_photo_path) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                }
                $data['profile_photo_path'] = $request->file('profile_photo')->store('profile-photos', 'public');
            }
        }

        $user->update($data);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Profil berhasil diperbarui!'
            ]);
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update User Password
     */
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:4|confirmed',
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal 4 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Kata sandi saat ini tidak cocok.']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui!');
    }

    /**
     * Delete Profile Photo
     */
    public function deletePhoto()
    {
        $user = Auth::user();
        $isMasyarakat = $user instanceof \App\Models\Masyarakat;

        if ($isMasyarakat && $user->foto_profil) {
            Storage::disk('public')->delete($user->foto_profil);
            $user->update(['foto_profil' => null]);
            return redirect()->back()->with('success', 'Foto profil berhasil dihapus.');
        } elseif (!$isMasyarakat && $user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
            $user->update(['profile_photo_path' => null]);
            return redirect()->back()->with('success', 'Foto profil berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Tidak ada foto profil untuk dihapus.');
    }

    /**
     * Halaman Admin: List Permohonan
     */
    public function adminIndex(Request $request)
    {
        $user = Auth::user();
        $kecamatan = $user->kecamatan ?? 'Tegal Timur';
        
        $query = PengajuanLayanan::with(['masyarakat']);

        // Advanced Filtering
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('nik')) {
            $query->whereHas('masyarakat', function($q) use ($request) {
                $q->where('nik', 'LIKE', "%{$request->nik}%");
            });
        }

        if ($request->filled('name')) {
            $query->whereHas('masyarakat', function($q) use ($request) {
                $q->where('nama', 'LIKE', "%{$request->name}%");
            });
        }

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('id_pengajuan', 'LIKE', "%$search%")
                  ->orWhere('nomor_tiket', 'LIKE', "%$search%")
                  ->orWhereHas('masyarakat', function($u) use ($search) {
                      $u->where('nama', 'LIKE', "%$search%")
                        ->orWhere('nik', 'LIKE', "%$search%");
                  });
            });
        }

        // Filter untuk cabang (Bisa disesuaikan nanti, saat ini kita tampilkan semua atau filter berdasarkan kecamatan yang ada di alamat masyarakat)
        if ($user->role === 'cabang') {
            // Karena tidak ada kecamatan di tabel masyarakat, cabang melihat semua atau filter lain.
        }    // Saat ini kita lewati filter sekolah karena skema baru tidak menggunakan entitas sekolah per-user.

        $totalPermohonan = $query->count();
        $totalMenunggu = (clone $query)->where('status', 'menunggu_verifikasi')->count();
        $totalTerverifikasi = (clone $query)->where('status', 'terverifikasi')->count(); 
        $totalDitolak = (clone $query)->where('status', 'ditolak')->count();

        $permohonan = $query->orderByRaw("CASE 
                                WHEN status = 'menunggu_verifikasi' THEN 0
                                WHEN status = 'pending' THEN 1
                                WHEN status = 'terverifikasi' THEN 2
                                WHEN status = 'terjadwal' THEN 3
                                WHEN status = 'diproses' THEN 4
                                WHEN status = 'selesai' THEN 5
                                WHEN status = 'ditolak' THEN 6
                                ELSE 7
                            END ASC")
                            ->orderBy('tanggal_pengajuan', 'desc')
                            ->paginate(10)->withQueryString();
        
        // Rekap Lokasi untuk Dashboard Monitoring
        $rekapLokasi = PengajuanLayanan::selectRaw('lokasi_pelayanan, status, COUNT(*) as total')
            ->whereIn('status', ['menunggu_verifikasi', 'menunggu_kuota', 'terverifikasi', 'terjadwal', 'diproses'])
            ->where(function($q) {
                $q->where('jenis_pengajuan', '!=', 'Sekolah')
                  ->where('jenis_pengajuan', '!=', 'sekolah')
                  ->orWhereNull('jenis_pengajuan');
            })
            ->groupBy('lokasi_pelayanan', 'status')
            ->orderByDesc('total')
            ->get();
        
        $services = \Illuminate\Support\Facades\DB::table('services')->where('status', 'AKTIF')->get();
        return view('admin.permohonan', compact('permohonan', 'totalPermohonan', 'totalMenunggu', 'totalTerverifikasi', 'totalDitolak', 'rekapLokasi', 'services'));
    }

    /**
     * Halaman Admin: Detail Permohonan
     */
    public function adminShow($id)
    {
        $permohonan = PengajuanLayanan::with(['masyarakat'])->findOrFail($id);
        return view('admin.permohonan-detail', compact('permohonan'));
    }

    /**
     * Halaman Admin: Update Status Permohonan
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu_verifikasi,terverifikasi,terjadwal,diproses,selesai,ditolak',
            'keterangan' => 'nullable|string',
            'jumlah_realisasi' => 'nullable|integer|min:0',
            'jumlah_petugas' => 'nullable|integer|min:1',
            'jumlah_ikd' => 'nullable|integer|min:0',
            'jumlah_kia' => 'nullable|integer|min:0',
            'jadwal_tanggal' => 'nullable|date',
            'jadwal_waktu_mulai' => 'nullable|string',
            'jadwal_waktu_selesai' => 'nullable|string',
            'lokasi_pelayanan' => 'nullable|string'
        ]);

        $permohonan = PengajuanLayanan::findOrFail($id);
        $data = [
            'status' => $request->status,
            'keterangan' => $request->keterangan
        ];

        if ($request->filled('jumlah_petugas')) {
            $data['jumlah_petugas'] = $request->jumlah_petugas;
        }

        if ($request->status === 'selesai') {
            $data['tanggal_selesai'] = now();
            if ($request->filled('jumlah_realisasi')) {
                $data['jumlah_realisasi'] = $request->jumlah_realisasi;
            }
            if ($request->filled('jumlah_ikd')) {
                $data['jumlah_ikd'] = $request->jumlah_ikd;
            }
            if ($request->filled('jumlah_kia')) {
                $data['jumlah_kia'] = $request->jumlah_kia;
            }
        }

        $detail = json_decode($permohonan->detail_pengajuan, true) ?? [];

        if ($request->status === 'terjadwal') {
            if ($request->filled('jadwal_tanggal')) {
                $detail['usulan_tanggal'] = $request->jadwal_tanggal;
            }
            if ($request->filled('jadwal_waktu_mulai')) {
                $detail['usulan_jam_mulai'] = $request->jadwal_waktu_mulai;
            }
            if ($request->filled('jadwal_waktu_selesai')) {
                $detail['usulan_jam_selesai'] = $request->jadwal_waktu_selesai;
            }
            if ($request->filled('lokasi_pelayanan')) {
                $data['lokasi_pelayanan'] = $request->lokasi_pelayanan;
            }
            $data['detail_pengajuan'] = json_encode($detail);
        }

        $permohonan->update($data);

        // Jika status diubah menjadi "terjadwal", "diproses" atau "selesai", otomatis buat Jadwal Jemput Bola
        if (in_array($request->status, ['terjadwal', 'diproses', 'selesai'])) {
            $usulan_tanggal = $detail['usulan_tanggal'] ?? ($permohonan->tanggal_pengajuan ?? now());
            $usulan_jam_mulai = $detail['usulan_jam_mulai'] ?? '08:00';
            $usulan_jam_selesai = $detail['usulan_jam_selesai'] ?? '12:00';
            $jenis_lokasi = (strtolower($permohonan->jenis_pengajuan) === 'sekolah') ? 'Sekolah' : 'Kecamatan';
            $lokasi = $permohonan->lokasi_pelayanan ?? 'Alamat Pemohon: ' . ($permohonan->masyarakat->alamat ?? 'Tidak diketahui');
            
            \App\Models\JadwalJebol::updateOrCreate(
                ['nama_kegiatan' => 'Layanan Tiket ' . $permohonan->id_pengajuan],
                [
                    'lokasi' => $lokasi,
                    'tanggal_pelayanan' => $usulan_tanggal,
                    'jam_mulai' => $usulan_jam_mulai,
                    'jam_selesai' => $usulan_jam_selesai,
                    'petugas' => 'Tim Disdukcapil',
                    'jenis_layanan' => $permohonan->jenis_layanan ?? 'Pelayanan',
                    'jenis_lokasi' => $jenis_lokasi,
                    'deskripsi' => 'Jadwal di-generate otomatis dari sistem.',
                    'status' => $request->status === 'diproses' ? 'terjadwal' : $request->status,
                ]
            );
        }

        // Jika status ditolak, kita hapus jadwalnya jika sebelumnya sudah pernah dibuat
        if ($request->status === 'ditolak') {
            \App\Models\JadwalJebol::where('nama_kegiatan', 'Layanan Tiket ' . $permohonan->id_pengajuan)->delete();
        }

        // Cek Pengaturan Email Notifikasi Perubahan Jadwal/Status
        $settings = \Illuminate\Support\Facades\DB::table('app_settings')->first();
        $notifSettings = json_decode($settings->notification_settings ?? '{}');
        if (isset($notifSettings->email_perubahan_jadwal) && $notifSettings->email_perubahan_jadwal) {
            try {
                \Illuminate\Support\Facades\Mail::to($permohonan->masyarakat->email)
                    ->send(new \App\Mail\StatusUpdateMail($permohonan, $permohonan->masyarakat));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Gagal mengirim email update status: ' . $e->getMessage());
            }
        }

        // Cek Pengaturan SMS/WA Notifikasi Perubahan Jadwal/Status
        // Menggunakan checkbox wa_active dari setting gateway
        if (isset($notifSettings->wa_active) && $notifSettings->wa_active) {
            if ($request->status === 'selesai') {
                $pesanWa = "Halo Bapak/Ibu " . ($permohonan->masyarakat->nama ?? 'Warga') . ",\n\nKabar baik! Permohonan layanan kependudukan Anda dengan No. Tiket *" . $permohonan->id_pengajuan . "* telah selesai diproses.\n\nTerima kasih telah menggunakan layanan SI JEBOL (Sistem Jemput Bola) Disdukcapil Tegal. Semoga layanan kami memuaskan!\n\n_Pesan otomatis ini di-*generate* oleh Sistem Integrasi Gateway SI JEBOL._";
            } elseif ($request->status === 'ditolak') {
                $pesanWa = "Halo Bapak/Ibu " . ($permohonan->masyarakat->nama ?? 'Warga') . ",\n\nMohon maaf, permohonan layanan kependudukan Anda dengan No. Tiket *" . $permohonan->id_pengajuan . "* ditolak/dibatalkan.\nKeterangan: " . ($request->keterangan ?? 'Tidak ada keterangan') . ".\n\nSilakan cek aplikasi SI JEBOL untuk informasi lebih lanjut.";
            } else {
                $pesanWa = "Halo Bapak/Ibu " . ($permohonan->masyarakat->nama ?? 'Warga') . ",\n\nStatus tiket pengajuan Anda (*" . $permohonan->id_pengajuan . "*) telah diperbarui menjadi: *" . strtoupper($request->status) . "*.\nSilakan cek aplikasi untuk detailnya.";
            }
            \App\Services\WhatsAppService::send($permohonan->masyarakat->no_hp ?? '081234567890', $pesanWa);
        }

        return redirect()->back()->with('success', 'Status permohonan berhasil diperbarui.');
    }

    /**
     * Halaman Admin: Bulk Schedule Lokasi
     */
    public function bulkSchedule(Request $request)
    {
        $request->validate([
            'lokasi_pelayanan' => 'required|string',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'nullable|string',
            'jumlah_petugas' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $lokasi = $request->lokasi_pelayanan;
        $tanggal = $request->tanggal;
        
        // Cari semua permohonan di lokasi ini yang masih menunggu kuota/verifikasi atau sudah terverifikasi
        $pengajuans = PengajuanLayanan::where('lokasi_pelayanan', $lokasi)
            ->whereIn('status', ['menunggu_verifikasi', 'menunggu_kuota', 'terverifikasi'])
            ->get();

        if ($pengajuans->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada pengajuan yang siap dijadwalkan di lokasi ini.');
        }

        // Buat Jadwal JEBOL
        \App\Models\JadwalJebol::create([
            'nama_kegiatan' => 'Jemput Bola - ' . $lokasi,
            'lokasi' => $lokasi,
            'tanggal_pelayanan' => $tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai ?? '14:00',
            'petugas' => 'Tim Disdukcapil',
            'jenis_layanan' => 'Pelayanan Massal',
            'jenis_lokasi' => 'Kecamatan',
            'deskripsi' => $request->keterangan ?? 'Jadwal massal dibuat dari monitoring kuota.',
        ]);

        // Update status masal
        foreach ($pengajuans as $p) {
            $p->update([
                'status' => 'terjadwal',
                'keterangan' => $request->keterangan,
                'jumlah_petugas' => $request->jumlah_petugas
            ]);

            // Kirim notifikasi jika aktif
            $settings = \Illuminate\Support\Facades\DB::table('app_settings')->first();
            $notifSettings = json_decode($settings->notification_settings ?? '{}');
            
            if (isset($notifSettings->wa_active) && $notifSettings->wa_active) {
                $pesanWa = "Halo Bapak/Ibu,\n\nPengajuan layanan kependudukan Anda (Tiket *" . $p->nomor_tiket . "*) telah *TERJADWAL*.\n\nPelayanan JEBOL akan dilaksanakan di *" . $lokasi . "* pada tanggal *" . date('d-m-Y', strtotime($tanggal)) . "* jam *" . $request->jam_mulai . "*.\n\nMohon hadir tepat waktu dengan membawa berkas asli. Terima kasih!";
                \App\Services\WhatsAppService::send($p->no_hp ?? '081234567890', $pesanWa);
            }
        }

        return redirect()->back()->with('success', count($pengajuans) . ' pengajuan berhasil dijadwalkan secara masal!');
    }

    public function bulkComplete(Request $request)
    {
        $request->validate([
            'lokasi_pelayanan' => 'required|string',
            'total_hadir' => 'required|integer|min:0'
        ]);

        $lokasi = $request->lokasi_pelayanan;
        $total_hadir = (int) $request->total_hadir;

        $pengajuans = PengajuanLayanan::where('lokasi_pelayanan', $lokasi)
            ->whereIn('status', ['terjadwal', 'diproses'])
            ->get();

        if ($pengajuans->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada pengajuan yang siap diselesaikan di lokasi ini.');
        }

        $count = 0;
        foreach ($pengajuans as $p) {
            // Assign 1 if count < total_hadir, else 0
            $realisasi = ($count < $total_hadir) ? 1 : 0;
            
            $p->update([
                'status' => 'selesai',
                'tanggal_selesai' => now(),
                'jumlah_realisasi' => $realisasi,
                'jumlah_ikd' => 0,
                'jumlah_kia' => 0,
            ]);
            $count++;
        }

        return redirect()->back()->with('success', count($pengajuans) . ' pengajuan di lokasi ' . $lokasi . ' berhasil diselesaikan. Total yang dilayani: ' . min($total_hadir, count($pengajuans)) . ' warga.');
    }

    public function cekStatus(Request $request)
    {
        $search = $request->query('search');
        $permohonan = null;
        $riwayat = collect();
        $totalSelesai = 0;
        $totalBelum = 0;
        $totalPengajuan = 0;
        $totalDitolak = 0;
        $targetOrang = 0;
        $selesaiOrang = 0;

        if ($search) {
            $searchClean = ltrim(trim($search), '#');
            $permohonan = PengajuanLayanan::with(['masyarakat'])
                ->where('nomor_tiket', $searchClean)
                ->orWhereHas('masyarakat', function($q) use ($searchClean) {
                    $q->where('nik', $searchClean);
                })
                ->first();
            $riwayat = new \Illuminate\Pagination\LengthAwarePaginator(collect(), 0, 5);
        } else if (Auth::check()) {
            // Jika tidak mencari, tampilkan riwayat milik user tersebut
            $userNik = Auth::user()->nik;
            $riwayat = PengajuanLayanan::where('nik', $userNik)
                ->orderBy('tanggal_pengajuan', 'desc')
                ->paginate(5)
                ->withQueryString();
                
            $totalSelesai = PengajuanLayanan::where('nik', $userNik)->where('status', 'selesai')->count();
            $totalBelum = PengajuanLayanan::where('nik', $userNik)->whereIn('status', ['pending', 'diproses'])->count();
            $totalPengajuan = PengajuanLayanan::where('nik', $userNik)->count();
            $totalDitolak = PengajuanLayanan::where('nik', $userNik)->where('status', 'ditolak')->count();
            
            $targetOrang = 0; // Not applicable for pengajuan layanan base fields
            $selesaiOrang = 0; // Not applicable for pengajuan layanan base fields
        } else {
            $riwayat = new \Illuminate\Pagination\LengthAwarePaginator(collect(), 0, 5);
        }

        return view('masyarakat.cek-status', compact('permohonan', 'search', 'riwayat', 'totalSelesai', 'totalBelum', 'totalPengajuan', 'totalDitolak', 'targetOrang', 'selesaiOrang'));
    }

    public function destroy($id)
    {
        $permohonan = PengajuanLayanan::findOrFail($id);
        $permohonan->delete();

        return redirect()->route('admin.permohonan')->with('success', 'Permohonan berhasil dihapus.');
    }
}
