<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepuasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rating',
        'petugas',
        'waktu',
        'sistem',
        'saran',
        'foto_path',
        'admin_response',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
