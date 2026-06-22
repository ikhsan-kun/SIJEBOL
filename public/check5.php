<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$cols = \Illuminate\Support\Facades\Schema::getColumnListing('masyarakat');
echo json_encode($cols);
