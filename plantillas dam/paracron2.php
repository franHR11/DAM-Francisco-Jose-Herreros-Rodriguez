<?php

// Database credentials
$dbHost = 'localhost';
$dbUsername = 'crimson';
$dbPassword = 'crimson';
$dbName = 'crimson';

// Path to store backup
$backupDir = '/var/www/html/backups/';

// Get current date and time in YmdHis format
$timestamp = date('YmdHis');

// Filename for the backup file
$backupFile = $backupDir . $timestamp . '_crimson.sql';

// Command to run mysqldump
$command = "mysqldump --user={$dbUsername} --password={$dbPassword} --host={$dbHost} {$dbName} > {$backupFile}";

// Execute the command
$output = null;
$return_var = null;
exec($command, $output, $return_var);

// Check if the mysqldump command was successful
if ($return_var === 0) {
    echo "Backup created successfully: " . $backupFile;
} else {
    echo "Error creating backup.";
}

?>

