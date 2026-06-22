<?php
require 'vendor/autoload.php';
require 'bootstrap/app.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = App\Models\User::where('nik', '1234567890123456')->first();
file_put_contents('user_debug.txt', "Role: '" . $user->role . "'\n");
echo "Done";
