<?php
$files = [
    __DIR__ . '/routes/web.php',
    __DIR__ . '/resources/views/beranda.blade.php',
    __DIR__ . '/resources/views/ulasan.blade.php'
];

foreach ($files as $file) {
    if (!file_exists($file)) continue;
    $content = file_get_contents($file);
    
    // PHP/Routes
    $content = str_replace("with('user')", "with('masyarakat')", $content);
    $content = str_replace("whereNotNull('saran')", "whereNotNull('kritik_saran')", $content);
    $content = str_replace("where('rating'", "where('nilai_kepuasan'", $content);
    $content = str_replace("orderBy('rating'", "orderBy('nilai_kepuasan'", $content);
    $content = str_replace("avg('rating')", "avg('nilai_kepuasan')", $content);
    $content = str_replace("->latest()", "->orderBy('tanggal_input', 'desc')", $content);
    $content = str_replace("->oldest()", "->orderBy('tanggal_input', 'asc')", $content);
    
    // Blade variables
    $content = str_replace("->user->", "->masyarakat->", $content);
    $content = str_replace("->rating", "->nilai_kepuasan", $content);
    $content = str_replace("->saran", "->kritik_saran", $content);
    $content = str_replace("->created_at", "->tanggal_input", $content);
    
    file_put_contents($file, $content);
    echo "Updated $file\n";
}
