<?php
require 'vendor/autoload.php';
require 'bootstrap/app.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

file_put_contents('debug.json', json_encode([
    'admin' => \App\Models\Admin::count(),
    'users' => \App\Models\User::select('role')->selectRaw('count(*) as total')->groupBy('role')->get()
]));
