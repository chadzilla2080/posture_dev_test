#!/bin/bash

# Change to theme directory before running SASS watch
cd /var/www/html/wp-content/themes/posture_cool_things && npm run watch-sass &

# Execute the original WordPress entrypoint
exec docker-entrypoint.sh apache2-foreground 