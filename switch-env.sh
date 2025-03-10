#!/bin/bash

case "$1" in
  "dev")
    docker compose -f docker/dev/docker-compose.yml --env-file .env.dev up -d
    ;;
  "prod")
    docker compose -f docker/prod/docker-compose.prod.yml --env-file .env.prod up -d
    ;;
  "live")
    docker compose -f docker/live/docker-compose.live.yml --env-file .env.live up -d
    ;;
  *)
    echo "Usage: $0 {dev|prod|live}"
    exit 1
    ;;
esac 