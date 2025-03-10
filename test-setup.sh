#!/bin/bash

echo "Creating necessary directories..."
mkdir -p docker/{dev,prod,live}

echo "Moving files to their new locations..."
# Move files to prod directory if they're not already there
[ -f docker-compose.prod.yml ] && mv docker-compose.prod.yml docker/prod/
[ -f Dockerfile.prod ] && mv Dockerfile.prod docker/prod/
[ -f nginx.conf ] && mv nginx.conf docker/prod/nginx.prod.conf

echo "Setting up environment files..."
# Create env files if they don't exist
[ ! -f .env.dev ] && cp .env .env.dev
[ ! -f .env.prod ] && cp .env .env.prod
[ ! -f .env.live ] && cp .env .env.live

echo "Making scripts executable..."
chmod +x docker/dev/docker-entrypoint-custom.sh 2>/dev/null || echo "Dev entrypoint script not found"
chmod +x docker/prod/deploy.prod.sh 2>/dev/null || echo "Prod deploy script not found"
chmod +x docker/live/deploy.live.sh 2>/dev/null || echo "Live deploy script not found"

echo "Testing production configuration..."
if [ -f docker/prod/docker-compose.prod.yml ]; then
    docker compose -f docker/prod/docker-compose.prod.yml --env-file .env.prod config
    echo "Production config test complete"
else
    echo "Production docker-compose file not found!"
fi

echo "Verifying backup path..."
if [ -d wp-content/themes/posture_cool_things/backups ]; then
    echo "Backup directory exists"
    ls -la wp-content/themes/posture_cool_things/backups/
else
    echo "Backup directory not found!"
fi 