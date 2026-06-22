<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiJebol extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lokasi',
        'kecamatan',
        'kelurahan',
        'alamat_lengkap',
        'kuota_peserta',
        'status',
    ];
}
