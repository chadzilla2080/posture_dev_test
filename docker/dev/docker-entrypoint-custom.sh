#!/bin/bash

# Change to theme directory before running SASS watch
cd /var/www/html/wp-content/themes/posture_cool_things && \
sass --watch sass/main.scss:style.css --style=compressed &

# Execute the original WordPress entrypoint
exec docker-entrypoint.sh apache2-foreground 