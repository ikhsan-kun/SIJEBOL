<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$q1 = \App\Models\PengajuanLayanan::take(5)->get();
echo json_encode($q1);
echo "\n---\n";
echo json_encode(\App\Models\PengajuanLayanan::select('lokasi_pelayanan', \Illuminate\Support\Facades\DB::raw('count(*) as total'))->groupBy('lokasi_pelayanan')->get());
echo "\n---\n";
echo json_encode(\App\Models\User::whereNotNull('nik')->select('nik', 'school', 'location_type')->take(5)->get());
