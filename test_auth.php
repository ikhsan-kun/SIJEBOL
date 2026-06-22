<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$nik = '1111222233334444';
$pass = 'margadana123';

$user = \App\Models\User::where('nik', $nik)->first();
if (!$user) {
    echo "User not found\n";
    exit;
}

echo "User found: " . $user->name . "\n";
$hashed = $user->password;
$check = \Illuminate\Support\Facades\Hash::check($pass, $hashed);
echo "Hash check: " . ($check ? "TRUE" : "FALSE") . "\n";

$attempt = \Illuminate\Support\Facades\Auth::attempt(['nik' => $nik, 'password' => $pass]);
echo "Auth attempt: " . ($attempt ? "TRUE" : "FALSE") . "\n";
