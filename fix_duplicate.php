<?php
// The rebuild script accidentally prepended new HTML before the old file content.
// The JS section is in the SECOND copy of the file (after line 452).
// We need to:
// 1. Take the new HTML (lines 1-451)
// 2. Extract the JS from the second copy
// 3. Combine them

$content = file_get_contents('resources/views/masyarakat/pengajuan.blade.php');

// Find the point where the second copy begins (second <!DOCTYPE html>)
$secondDoctype = strpos($content, '<!DOCTYPE html>', 5); // skip the first one

// Find the script section in the second copy
$scriptMarker = '<script>
        lucide.createIcons();';
$scriptPos = strpos($content, $scriptMarker, $secondDoctype);

if ($scriptPos === false) {
    // Try with \r\n
    $scriptMarker = "<script>\r\n        lucide.createIcons();";
    $scriptPos = strpos($content, $scriptMarker, $secondDoctype);
}

if ($scriptPos === false) {
    echo "Script not found!\n";
    exit;
}

// Get just the JS+closing from the second copy
$jsAndClosing = substr($content, $scriptPos);

// Get the new HTML from the first copy (everything before the second DOCTYPE)
$newHtml = substr($content, 0, $secondDoctype);

// Trim trailing whitespace/newlines from the HTML part
$newHtml = rtrim($newHtml);

// Combine
$final = $newHtml . "\n\n    " . $jsAndClosing;

file_put_contents('resources/views/masyarakat/pengajuan.blade.php', $final);
echo "Fixed! Lines: " . substr_count($final, "\n") . "\n";
