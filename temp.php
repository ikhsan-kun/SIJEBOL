<?php
require 'vendor/autoload.php';
require 'bootstrap/app.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

file_put_contents('users.json', json_encode(App\Models\User::all(), JSON_PRETTY_PRINT));
echo "Done";
