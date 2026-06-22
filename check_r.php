<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

$routes = app('router')->getRoutes();
foreach ($routes as $route) {
    if (strpos($route->uri(), 'settings') !== false) {
        echo $route->uri() . "\n";
    }
}
