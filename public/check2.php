<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$user = \Illuminate\Support\Facades\DB::table('users')->where('email', 'muf@gmail.com')->first();
echo json_encode($user);
