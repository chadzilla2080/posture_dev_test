#!/bin/bash

# Build the assets
npm run build

# Remove development files from production
files_to_remove=(
    "node_modules"
    "package.json"
    "package-lock.json"
    "postcss.config.js"
    "sass"
    ".gitignore"
    "*.map"
)

# Create a deployment directory
deploy_dir="deploy"
mkdir -p "$deploy_dir"

# Copy all files
cp -r . "$deploy_dir"

# Remove development files
cd "$deploy_dir"
for file in "${files_to_remove[@]}"
do
    rm -rf "$file"
done

echo "Deployment package created in $deploy_dir" 