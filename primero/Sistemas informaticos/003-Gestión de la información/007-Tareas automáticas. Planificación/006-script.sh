#!/bin/bash

# Define variables
DB_NAME="futbol"
DB_USER="futbol"
DB_PASSWORD="futbol"

# Get current epoch time
EPOCH=$(date +%s)

# Define the output file name with the epoch timestamp
OUTPUT_FILE="futbol_dump_$EPOCH.sql"

# Run mysqldump command
mysqldump -u "$DB_USER" -p"$DB_PASSWORD" "$DB_NAME" > "$OUTPUT_FILE"

# Check if the command was successful
if [ $? -eq 0 ]; then
  echo "Database backup successful! Saved as $OUTPUT_FILE"
else
  echo "Database backup failed!"
fi