<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanJebol extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal_usulan',
        'lokasi',
        'perkiraan_peserta',
        'status',
        'catatan_disdukcapil',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wargaUsulan()
    {
        return $this->hasMany(WargaUsulanJebol::class);
    }
}
