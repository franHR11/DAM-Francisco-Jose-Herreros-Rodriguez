<?php
// Define the CSV file path
$csvFile = 'server_data.csv';

// Open the file for appending
$fileHandle = fopen($csvFile, 'a');
if ($fileHandle === false) {
    die("Unable to open or create the file.");
}

// Check if the file is empty
$isFileEmpty = filesize($csvFile) === 0;

// If the file is empty, write headers
if ($isFileEmpty) {
    $headers = array_keys($_SERVER); // Use raw headers without enclosing
    fputcsv($fileHandle, $headers, '|');
}

// Write the $_SERVER data without enclosing in single quotes
fputcsv($fileHandle, $_SERVER, '|');

// Close the file handle
fclose($fileHandle);

// Output success message
echo "Data has been saved to the CSV file.";
?>