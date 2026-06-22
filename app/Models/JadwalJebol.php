<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalJebol extends Model
{
    protected $table = 'jadwal_jebol';
    protected $primaryKey = 'id_jadwal';

    public $timestamps = true;

    protected $casts = [
        'tanggal_pelayanan' => 'datetime',
    ];

    protected $fillable = [
        'nama_kegiatan',
        'jenis_lokasi',
        'lokasi',
        'tanggal_pelayanan',
        'jam_mulai',
        'jam_selesai',
        'jenis_layanan',
        'kuota',
        'petugas',
        'deskripsi',
        'status',
        'foto',
    ];
}
