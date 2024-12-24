<?php
function processFolder($source, $target) {
    // Ensure target folder exists
    if (!file_exists($target)) {
        mkdir($target, 0777, true);
    }

    // Scan the source directory
    $items = scandir($source);

    foreach ($items as $item) {
        // Skip current and parent directory references
        if ($item === '.' || $item === '..') {
            continue;
        }

        $sourcePath = $source . DIRECTORY_SEPARATOR . $item;
        $targetPath = $target . DIRECTORY_SEPARATOR . $item;

        if (is_dir($sourcePath)) {
            // If it's a folder, create a folder in the target
            mkdir($targetPath, 0777, true);

            // Create an empty .txt file inside the folder
            $txtFilePath = $targetPath . DIRECTORY_SEPARATOR . $item . '.txt';
            file_put_contents($txtFilePath, '');

            // Recurse into the folder
            processFolder($sourcePath, $targetPath);
        } else if (is_file($sourcePath)) {
            // If it's a file, create a folder named after the file (with extension)
            $fileNameWithExtension = pathinfo($item, PATHINFO_BASENAME);
            $fileFolderPath = $target . DIRECTORY_SEPARATOR . $fileNameWithExtension;

            mkdir($fileFolderPath, 0777, true);

            // Create a .txt file inside this folder with the same name as the original file
            $txtFilePath = $fileFolderPath . DIRECTORY_SEPARATOR . $fileNameWithExtension . '.txt';
            file_put_contents($txtFilePath, '');
        }
    }
}

// Example usage
$sourceFolder = '../../admin'; // Replace with the path to your source folder
$targetFolder = 'docs/admin'; // Replace with the path to your target folder

processFolder($sourceFolder, $targetFolder);

echo "Processing complete!\n";
