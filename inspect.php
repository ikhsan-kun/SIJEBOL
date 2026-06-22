<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$school = App\Models\School::where('nama_sekolah', 'TK PIUS')->first();
$tahun = 2026;

$query = App\Models\PengajuanLayanan::where(function($q) use ($school) {
    $q->whereHas('user', function($uq) use ($school) {
        $uq->where('school', $school->nama_sekolah);
    })->orWhereHas('masyarakat', function($mq) use ($school) {
        $mq->where('school', $school->nama_sekolah);
    })->orWhere('lokasi_pelayanan', 'LIKE', '%' . $school->nama_sekolah . '%');
})->whereYear('tanggal_pengajuan', $tahun);

\Illuminate\Support\Facades\DB::enableQueryLog();
$results = $query->where('status', 'selesai')->get();
$log = \Illuminate\Support\Facades\DB::getQueryLog();

print_r([
    'school' => $school->toArray(),
    'query_sql' => $log[0]['query'],
    'query_bindings' => $log[0]['bindings'],
    'results_count' => $results->count(),
    'results' => $results->toArray()
]);
