<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$users = \Illuminate\Support\Facades\DB::table('users')->select('id', 'name', 'email', 'profile_photo_path')->get();
echo json_encode($users);
