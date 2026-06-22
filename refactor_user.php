<?php
$files = [
    __DIR__ . '/routes/web.php',
    __DIR__ . '/app/Http/Controllers/CabangController.php',
    __DIR__ . '/app/Console/Commands/SendJadwalReminder.php',
    __DIR__ . '/resources/views/cabang/sekolah.blade.php',
];

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    
    // Admin occurrences: where('role', 'petugas'), where('role', 'admin')
    $content = str_replace('\App\Models\User::where(\'role\', \'petugas\')', '\App\Models\Admin::where(\'role\', \'petugas\')', $content);
    $content = str_replace('\App\Models\User::where(\'role\', \'admin\')', '\App\Models\Admin::where(\'role\', \'admin\')', $content);
    
    // User occurrences (citizen)
    $content = str_replace('\App\Models\User::where(\'role\', \'user\')', '\App\Models\Masyarakat::query()', $content);
    
    // General user queries (usually masyarakat)
    $content = preg_replace('/\\\\App\\\\Models\\\\User::(where|query|count|findOrFail|firstOrCreate|whereNotNull)/', '\\\\App\\\\Models\\\\Masyarakat::$1', $content);
    $content = preg_replace('/User::(where|query|count|findOrFail|firstOrCreate|whereNotNull|create)/', '\\\\App\\\\Models\\\\Masyarakat::$1', $content);
    
    file_put_contents($file, $content);
    echo "Updated $file\n";
}
