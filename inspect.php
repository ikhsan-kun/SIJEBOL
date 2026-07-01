<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \Illuminate\Support\Facades\DB::table('masyarakat')->where('email', 'muf@gmail.com')->first();
print_r($user);


