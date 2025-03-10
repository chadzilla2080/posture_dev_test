#!/bin/bash

# Pull latest changes
git pull origin main

# Build and deploy with production configuration
docker compose -f docker/prod/docker-compose.prod.yml --env-file .env.prod down
docker compose -f docker/prod/docker-compose.prod.yml --env-file .env.prod build
docker compose -f docker/prod/docker-compose.prod.yml --env-file .env.prod up -d

# Clean up unused images
docker image prune -f 