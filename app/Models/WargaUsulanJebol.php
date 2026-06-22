<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WargaUsulanJebol extends Model
{
    use HasFactory;

    protected $fillable = [
        'permohonan_jebol_id',
        'nik',
        'nama',
        'jenis_layanan',
        'keterangan',
        'status_layanan',
    ];

    public function permohonan()
    {
        return $this->belongsTo(PermohonanJebol::class, 'permohonan_jebol_id');
    }
}
