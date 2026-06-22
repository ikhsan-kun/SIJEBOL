<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KepuasanWarga extends Model
{
    protected $table = 'kepuasan_warga';
    protected $primaryKey = 'id_kepuasan';

    public $timestamps = false;

    protected $fillable = [
        'nik',
        'nilai_kepuasan',
        'rating_kecepatan',
        'rating_kemudahan',
        'rating_keramahan',
        'rating_kejelasan',
        'status_layanan',
        'penilaian_petugas',
        'penilaian_waktu',
        'penilaian_sistem',
        'kritik_saran',
        'foto_path',
        'tanggal_input'
    ];

    protected $casts = [
        'tanggal_input' => 'datetime',
    ];

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'nik', 'nik');
    }
}
