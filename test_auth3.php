<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

\Illuminate\Support\Facades\DB::enableQueryLog();
$provider = \Illuminate\Support\Facades\Auth::getProvider();
$provider->retrieveByCredentials(['nik' => '1111222233334444', 'password' => 'margadana123']);
print_r(\Illuminate\Support\Facades\DB::getQueryLog());
