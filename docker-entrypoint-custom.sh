#!/bin/bash

# Start SASS watching in the background
npm run watch-sass &

# Execute the original WordPress entrypoint
exec docker-entrypoint.sh apache2-foreground 