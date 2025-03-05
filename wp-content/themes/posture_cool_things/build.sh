#!/bin/bash

# Copy the header first
cp style.css.header style.css

# Run sass in watch mode and pipe output to a temporary file
sass sass/main.scss:style.css.temp --watch --source-map &
SASS_PID=$!

# Watch for changes to the temporary file and update style.css
while true; do
    if [ -f style.css.temp ]; then
        cat style.css.header style.css.temp > style.css
    fi
    sleep 1
done &
WATCH_PID=$!

# Wait for either process to exit
wait $SASS_PID $WATCH_PID 