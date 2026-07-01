$files = Get-ChildItem -Path "d:\laragon\www\jeboll\resources\views\masyarakat" -Filter "*.blade.php" -File

foreach ($file in $files) {
    $content = Get-Content -Raw $file.FullName -Encoding UTF8
    
    # Skip if already refactored
    if ($content -match "@extends\('layouts\.masyarakat'\)") {
        continue
    }

    # Extract Custom CSS
    $customStyle = ""
    if ($content -match '(?s)<style>(.*?)</style>') {
        $customStyle = $matches[1].Trim()
        $customStyle = $customStyle -replace '(?s):root\s*\{.*?\}', ''
        $customStyle = $customStyle -replace '(?s)body\.no-batik\s*\{.*?\}', ''
        $customStyle = $customStyle -replace '(?s)body\s*\{.*?\}', ''
        $customStyle = $customStyle -replace '(?s)\.dashboard-layout\s*\{.*?\}', ''
        $customStyle = $customStyle -replace '(?s)\.main-content\s*\{.*?\}', ''
        $customStyle = $customStyle -replace '(?s)@media \(max-width: 1024px\)\s*\{\s*\.main-content\s*\{.*?\}\s*\}', ''
        $customStyle = $customStyle.Trim()
    }

    # Extract Content
    $mainContent = ""
    if ($content -match '(?s)<main class="main-content">(.*?)<!-- Global Footer -->') {
        $mainContent = $matches[1].Trim()
    } elseif ($content -match '(?s)<div class="tracking-container">(.*?)<!-- Global Footer -->') {
        $mainContent = $matches[1].Trim()
    } elseif ($content -match '(?s)<main class="main-content">(.*?)</main>') {
        $mainContent = $matches[1].Trim()
    }

    if ($mainContent) {
        $newContent = "@extends('layouts.masyarakat')`r`n"
        if ($customStyle) {
            $newContent += "`r`n@push('styles')`r`n<style>`r`n$customStyle`r`n</style>`r`n@endpush`r`n"
        }
        $newContent += "`r`n@section('content')`r`n$mainContent`r`n@endsection`r`n"
        
        [System.IO.File]::WriteAllText($file.FullName, $newContent, [System.Text.Encoding]::UTF8)
        Write-Host "Refactored: $($file.Name)"
    } else {
        Write-Host "Could not find main content in $($file.Name)"
    }
}
