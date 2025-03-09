#!/bin/bash

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
NC='\033[0m' # No Color

# Error handling
set -e

echo "Starting SASS compilation..."

# Development mode with source maps
if [ "$1" = "dev" ]; then
    sass --style=expanded --source-map \
        sass/main.scss:style.css \
        --watch

# Production mode with minification
else
    echo "Building for production..."
    sass --style=compressed \
        sass/main.scss:style.css

    echo -e "${GREEN}Build completed successfully!${NC}"
fi

# Error handling
if [ $? -ne 0 ]; then
    echo -e "${RED}Build failed!${NC}"
    exit 1
fi 