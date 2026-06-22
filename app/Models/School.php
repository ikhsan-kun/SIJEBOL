<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';

    protected $fillable = [
        'npsn',
        'nama_sekolah',
        'alamat',
        'kecamatan',
        'kelurahan',
        'tingkat',
        'jumlah_siswa',
        'status',
        'status_jempol',
        'cabang_id',
        'fokus_layanan'
    ];
}
