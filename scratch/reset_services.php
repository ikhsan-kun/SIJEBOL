<?php

require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

use Illuminate\Support\Facades\DB;

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    DB::table('services')->truncate();
    DB::table('services')->insert([
        [
            'name' => 'KTP-el',
            'estimation' => '3 Hari Kerja',
            'icon' => 'badge',
            'color' => 'blue',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'KIA',
            'estimation' => '2 Hari Kerja',
            'icon' => 'child_care',
            'color' => 'purple',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'IKD',
            'estimation' => '1 Hari Kerja',
            'icon' => 'fingerprint',
            'color' => 'indigo',
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ]);
    echo "SUCCESS: Services reset to KTP-el, KIA, and IKD.";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
