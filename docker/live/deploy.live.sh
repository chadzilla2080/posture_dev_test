#!/bin/bash

# Pull latest changes
git pull origin main

# Renew SSL certificates if needed
certbot renew

# Build and deploy with live configuration
docker compose -f docker/live/docker-compose.live.yml --env-file .env.live down
docker compose -f docker/live/docker-compose.live.yml --env-file .env.live build
docker compose -f docker/live/docker-compose.live.yml --env-file .env.live up -d

# Clean up unused images
docker image prune -f 