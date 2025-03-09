#!/bin/bash

# Pull latest changes
git pull origin main

# Build and deploy with production configuration
docker-compose -f docker-compose.prod.yml down
docker-compose -f docker-compose.prod.yml build
docker-compose -f docker-compose.prod.yml up -d

# Clean up unused images
docker image prune -f 