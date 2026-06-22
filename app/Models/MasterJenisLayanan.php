<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterJenisLayanan extends Model
{
    use HasFactory;

    protected $table = 'master_jenis_layanan';
    protected $fillable = ['kode', 'nama', 'deskripsi', 'status'];
}
