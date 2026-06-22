<?php

$viewsDir = __DIR__ . '/resources/views';
$compiledDir = __DIR__ . '/storage/framework/views';
$mapping = [];

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsDir));

foreach ($iterator as $info) {
    if ($info->isFile() && $info->getExtension() === 'php') {
        $bladePath = $info->getPathname();
        
        // Laravel 8+ uses sha1 of the real path for the compiled view
        $hash = sha1($bladePath);
        $compiledPath = $compiledDir . '/' . $hash . '.php';
        
        if (file_exists($compiledPath)) {
            $bladeContent = file_get_contents($bladePath);
            $compiledContent = file_get_contents($compiledPath);
            
            // Only use this compiled view if it DOES NOT contain jbl- (meaning it's from before the change)
            if (strpos($compiledContent, 'jbl-') === false) {
                
                // Extract all class attributes
                preg_match_all('/class=[\'"]([^\'"]+)[\'"]/', $bladeContent, $bladeMatches);
                preg_match_all('/class=[\'"]([^\'"]+)[\'"]/', $compiledContent, $compiledMatches);
                
                $bladeClasses = $bladeMatches[1];
                $compiledClasses = $compiledMatches[1];
                
                // If they have the same number of class attributes, we can align them!
                if (count($bladeClasses) === count($compiledClasses)) {
                    for ($i = 0; $i < count($bladeClasses); $i++) {
                        $bClasses = preg_split('/\s+/', trim($bladeClasses[$i]));
                        $cClasses = preg_split('/\s+/', trim($compiledClasses[$i]));
                        
                        if (count($bClasses) === count($cClasses)) {
                            for ($j = 0; $j < count($bClasses); $j++) {
                                $jbl = $bClasses[$j];
                                $original = $cClasses[$j];
                                
                                if (strpos($jbl, 'jbl-') === 0 && $original !== '') {
                                    $mapping[$jbl] = $original;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

file_put_contents(__DIR__ . '/recovered_mapping_from_views.json', json_encode($mapping, JSON_PRETTY_PRINT));
echo "Recovered " . count($mapping) . " mappings from parallel views!\n";
