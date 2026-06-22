<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Masyarakat extends Authenticatable
{
    use Notifiable;

    protected $table = 'masyarakat';
    protected $primaryKey = 'id_masyarakat';

    protected $fillable = [
        'nik',
        'nama',
        'email',
        'password',
        'no_hp',
        'alamat',
        'foto_profil',
        'role',
        'kecamatan',
        'tipe_pendaftar',
        'school'
    ];

    protected $hidden = [
        'password',
    ];

    // Disable default timestamps if they only want created_at, but we added updated_at for convenience in Laravel
    public $timestamps = true;

    public function pengajuanLayanan()
    {
        return $this->hasMany(PengajuanLayanan::class, 'nik', 'nik');
    }

    public function kepuasanWarga()
    {
        return $this->hasMany(KepuasanWarga::class, 'nik', 'nik');
    }
}
