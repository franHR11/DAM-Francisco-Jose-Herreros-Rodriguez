#!/bin/bash

# A script to install Python libraries using pip

# List of libraries to install
LIBRARIES=(
    numpy
    pandas
    flask
    requests
    matplotlib
    pandas
    django
)

# Update pip
echo "Updating pip..."
pip3 install --upgrade pip

# Install each library
echo "Installing libraries..."
for LIB in "${LIBRARIES[@]}"
do
    echo "Installing $LIB..."
    pip3 install "$LIB"
done

echo "All libraries installed successfully!"
