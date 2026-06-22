<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Http\Kernel::class)->handle(Illuminate\Http\Request::capture());

$user = App\Models\User::first();
echo "ID: " . $user->id . "\n";
echo "Name: " . $user->name . "\n";
echo "Role: " . $user->role . "\n";
echo "Foto: " . $user->foto_profil . "\n";
