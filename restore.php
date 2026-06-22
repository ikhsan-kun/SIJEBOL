<?php

$mappingFile = __DIR__ . '/full_mapping.json';
if (!file_exists($mappingFile)) {
    echo "No mapping file found.\n";
    exit;
}

$mapping = json_decode(file_get_contents($mappingFile), true);
if (!$mapping) {
    echo "Invalid mapping.\n";
    exit;
}

$directory = new RecursiveDirectoryIterator(__DIR__ . '/resources/views');
$iterator = new RecursiveIteratorIterator($directory);

$regexes = [];
$replacements = [];

// Sort mapping by key length descending to prevent partial matches (though we use word boundaries)
uksort($mapping, function($a, $b) {
    return strlen($b) - strlen($a);
});

foreach ($mapping as $jbl => $original) {
    $regexes[] = '/\b' . preg_quote($jbl, '/') . '\b/';
    $replacements[] = $original;
}

$cssLink = '<link rel="stylesheet" href="{{ asset(\'css/custom-style.css\') }}">';
$tailwindScript = '<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries,typography"></script>';

foreach ($iterator as $info) {
    if ($info->isFile() && $info->getExtension() === 'php') {
        $path = $info->getPathname();
        $content = file_get_contents($path);
        $originalContent = $content;

        $content = preg_replace($regexes, $replacements, $content);
        $content = str_replace($cssLink, $tailwindScript, $content);

        if ($content !== $originalContent) {
            file_put_contents($path, $content);
            echo "Restored $path\n";
        }
    }
}

echo "Restoration complete!\n";
