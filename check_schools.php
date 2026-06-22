<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$schools = \App\Models\School::select('nama_sekolah', 'kecamatan', 'cabang_id')->get();
echo "Total Schools: " . $schools->count() . "\n";
foreach ($schools as $school) {
    echo $school->nama_sekolah . " | " . $school->kecamatan . " | Cabang ID: " . $school->cabang_id . "\n";
}
