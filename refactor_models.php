<?php

$files = [];
$dir = new RecursiveDirectoryIterator(__DIR__ . '/app');
$iterator = new RecursiveIteratorIterator($dir);
foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $files[] = $file->getPathname();
    }
}
$dir = new RecursiveDirectoryIterator(__DIR__ . '/routes');
$iterator = new RecursiveIteratorIterator($dir);
foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $files[] = $file->getPathname();
    }
}

foreach ($files as $file) {
    $content = file_get_contents($file);
    $original = $content;
    
    // Replace models
    $content = str_replace('App\Models\Permohonan', 'App\Models\PengajuanLayanan', $content);
    $content = str_replace('Permohonan::', 'PengajuanLayanan::', $content);
    
    $content = str_replace('App\Models\Jadwal', 'App\Models\JadwalJebol', $content);
    $content = str_replace('Jadwal::', 'JadwalJebol::', $content);
    
    $content = str_replace('App\Models\Kepuasan', 'App\Models\KepuasanWarga', $content);
    $content = str_replace('Kepuasan::', 'KepuasanWarga::', $content);
    
    if ($content !== $original) {
        file_put_contents($file, $content);
        echo "Updated $file\n";
    }
}
echo "Done replacing model names.\n";
