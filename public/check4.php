<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$route = \Illuminate\Support\Facades\Route::getRoutes()->getByName('masyarakat.settings.update');
if ($route) {
    echo json_encode([
        'uri' => $route->uri(),
        'action' => $route->getActionName(),
    ]);
} else {
    echo "Route not found";
}
