<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$nik = '1111222233334444';
$pass = 'margadana123';

$provider = \Illuminate\Support\Facades\Auth::getProvider();
$user = $provider->retrieveByCredentials(['nik' => $nik, 'password' => $pass]);
if (!$user) {
    echo "Retrieve failed.\n";
} else {
    echo "User retrieved.\n";
    $valid = $provider->validateCredentials($user, ['nik' => $nik, 'password' => $pass]);
    echo "Valid credentials? " . ($valid ? 'YES' : 'NO') . "\n";
}

$attempt = \Illuminate\Support\Facades\Auth::attempt(['nik' => $nik, 'password' => $pass]);
echo "Auth attempt returns: " . ($attempt ? 'TRUE' : 'FALSE') . "\n";
