<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterStatusLayanan extends Model
{
    use HasFactory;

    protected $table = 'master_status_layanan';
    protected $fillable = ['kode', 'nama', 'warna', 'deskripsi'];
}
