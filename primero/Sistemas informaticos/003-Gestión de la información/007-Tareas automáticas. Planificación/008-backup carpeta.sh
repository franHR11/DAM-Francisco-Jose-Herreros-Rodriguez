#!/bin/bash

# Get the current epoch time
epoch=$(date +%s)

# Define the source and destination directories
source="/var/www/html/jocarsa"
backup="/var/www/html/backup/jocarsa_$epoch"

# Copy the directory to the backup location with the timestamp in the folder name
cp -r "$source" "$backup"