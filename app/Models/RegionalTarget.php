<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionalTarget extends Model
{
    protected $table = 'regional_targets';

    protected $fillable = [
        'kecamatan',
        'target_ktp',
        'target_kia',
        'target_ikd',
    ];
}
