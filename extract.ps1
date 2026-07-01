$content = Get-Content -Raw "d:\laragon\www\jeboll\resources\views\partials\sidebar-masyarakat.blade.php" -Encoding UTF8
$lines = $content -split "`r?`n"
$css = $lines[69..636] -join "`r`n"
$css = $css -replace "\{\{ asset\('([^']+)'\) \}\}", '/$1'
[System.IO.File]::WriteAllText("d:\laragon\www\jeboll\public\css\masyarakat.css", $css, [System.Text.Encoding]::UTF8)

$js = $lines[641..704] -join "`r`n"
[System.IO.File]::WriteAllText("d:\laragon\www\jeboll\public\js\masyarakat.js", $js, [System.Text.Encoding]::UTF8)
