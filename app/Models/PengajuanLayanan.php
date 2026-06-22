<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanLayanan extends Model
{
    protected $table = 'pengajuan_layanan';
    protected $primaryKey = 'id_pengajuan';

    // Disable default created_at / updated_at as it only has tanggal_pengajuan
    public $timestamps = false;

    protected $fillable = [
        'nik',
        'nomor_tiket',
        'jenis_layanan',
        'jenis_pengajuan',
        'no_hp',
        'alamat',
        'keterangan',
        'berkas_pendukung',
        'lokasi_pelayanan',
        'tanggal_pengajuan',
        'tanggal_selesai',
        'status',
        'detail_pengajuan',
        'file_upload',
        'catatan_admin',
        'file_balasan',
        'jumlah_realisasi',
        'jumlah_petugas',
        'jumlah_ikd',
        'jumlah_kia',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'datetime',
        'tanggal_selesai'   => 'datetime',
    ];

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'nik', 'nik');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'nik', 'nik');
    }

    public function getJumlahOrangAttribute()
    {
        $detail = json_decode($this->detail_pengajuan, true);
        return $detail['jumlah_anak'] ?? 1;
    }

    public function getFileKkAttribute()
    {
        $detail = json_decode($this->detail_pengajuan, true);
        return $detail['file_kk'] ?? null;
    }

    public function getFileKtpAttribute()
    {
        $detail = json_decode($this->detail_pengajuan, true);
        return $detail['file_ktp'] ?? $detail['file_ktp_lama'] ?? null;
    }

    public function getFileSuratPengantarAttribute()
    {
        $detail = json_decode($this->detail_pengajuan, true);
        return $detail['file_surat_pengantar'] ?? null;
    }

    public function getFileDaftarSiswaAttribute()
    {
        $detail = json_decode($this->detail_pengajuan, true);
        return $detail['file_daftar_siswa'] ?? null;
    }

    public function getFileDokumenKolektifAttribute()
    {
        $detail = json_decode($this->detail_pengajuan, true);
        return $detail['file_dokumen_kolektif'] ?? null;
    }

    public function getTanggalKedatanganAttribute()
    {
        // 1. Check if there is an associated JadwalJebol by name (Layanan Tiket {id})
        $jadwal = JadwalJebol::where('nama_kegiatan', 'Layanan Tiket ' . $this->id_pengajuan)->first();
        if ($jadwal) {
            return $jadwal->tanggal_pelayanan;
        }

        // 2. Or check if there is an usulan_tanggal in detail_pengajuan (usually for pending/menunggu)
        $detail = json_decode($this->detail_pengajuan, true);
        if (isset($detail['usulan_tanggal']) && $detail['usulan_tanggal']) {
            return $detail['usulan_tanggal'];
        }

        // 3. Or check by lokasi_pelayanan / school name in JadwalJebol if any
        if ($this->lokasi_pelayanan) {
            $schoolName = $this->lokasi_pelayanan;
            if (str_starts_with($schoolName, 'Sekolah ')) {
                $schoolName = substr($schoolName, 8);
            }
            // Strip any trailing detail in parentheses
            if (preg_match('/\((.*?)\)/', $schoolName)) {
                $schoolName = trim(preg_replace('/\((.*?)\)/', '', $schoolName));
            }
            $jadwal = JadwalJebol::where('lokasi', 'like', '%' . $schoolName . '%')
                ->orderBy('tanggal_pelayanan', 'desc')
                ->first();
            if ($jadwal) {
                return $jadwal->tanggal_pelayanan;
            }
        }

        return null;
    }
}
