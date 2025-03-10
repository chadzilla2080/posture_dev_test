# Local Production Environment Setup

A guide for setting up and running the WordPress site in a local production environment.

Note: If you are reading this on GitHub, use the anchor links to navigate to the sections you are interested in.

## Table of Contents

| Section & Subsections       | Description                 | Location                                                |
| --------------------------- | --------------------------- | ------------------------------------------------------- |
| **Prerequisites**           | Required software and tools | [Prerequisites](#prerequisites)                         |
| **Directory Structure**     | Project file organization   | [Directory Structure](#directory-structure)             |
| **Quick Start**             | Fast setup commands         | [Quick Start](#quick-start)                             |
| └─ Clean Environment        | Clean Docker setup          | [Clean Environment](#1-clean-environment)               |
| └─ Start Containers         | Launch Docker containers    | [Start Containers](#2-start-containers)                 |
| └─ Import Database          | Database restoration        | [Import Database](#3-import-database)                   |
| └─ Configure WordPress      | WordPress settings          | [Configure WordPress](#4-configure-wordpress)           |
| └─ Activate Plugins         | Plugin activation           | [Activate Plugins](#5-activate-plugins)                 |
| └─ Finalize Setup           | Final configuration         | [Finalize Setup](#6-finalize-setup)                     |
| **Setup Steps**             | Detailed installation steps | [Setup Steps](#setup-steps)                             |
| └─ Initial Setup            | Directory and file setup    | [Initial Setup](#initial-setup)                         |
| └─ Clean Docker Environment | Container cleanup           | [Clean Docker Environment](#clean-docker-environment)   |
| **Verification**            | Testing and validation      | [Verification](#verification)                           |
| **Common Issues**           | Troubleshooting guide       | [Common Issues](#common-issues-and-solutions)           |
| └─ 502 Bad Gateway          | Nginx connection issues     | [502 Bad Gateway](#502-bad-gateway)                     |
| └─ Database Connection      | Database troubleshooting    | [Database Issues](#database-connection-issues)          |
| **Maintenance**             | System maintenance tasks    | [Maintenance](#maintenance)                             |
| └─ Backup Database          | Database backup procedures  | [Backup Database](#backup-database)                     |
| └─ Update WordPress         | Core updates                | [Update WordPress](#update-wordpress-core)              |
| **WordPress Setup**         | WordPress configuration     | [WordPress Setup](#wordpress-setup)                     |
| └─ Install Plugins          | Plugin installation methods | [Install Plugins](#method-1-install-plugins-via-wp-cli) |
| └─ Theme Setup              | Theme configuration         | [Theme Setup](#theme-setup)                             |
| └─ Additional Configuration | Extra settings              | [Additional Config](#additional-configuration)          |

## Prerequisites

- Docker and Docker Compose installed
- Git repository cloned

## Directory Structure

project_root/
├── docker/
│ └── prod/
│ ├── docker-compose.prod.yml
│ ├── nginx.prod.conf
│ ├── Dockerfile.prod
│ └── deploy.prod.sh
└── .env.prod

## Setup Steps

1. **Initial Setup**

```bash
# Create necessary directories
mkdir -p docker/prod

# Copy configuration files
cp docker-compose.prod.yml docker/prod/
cp nginx.prod.conf docker/prod/
cp Dockerfile.prod docker/prod/
cp setup-plugins.sh docker/prod/

# Make setup script executable
chmod +x docker/prod/setup-plugins.sh
```

2. **Clean Docker Environment**

```bash
# Stop and remove existing containers
docker compose -f docker/prod/docker-compose.prod.yml down -v

# Remove any stuck containers
docker rm -f posture_code_test_db posture_code_test_wp posture_prod_nginx 2>/dev/null || true

# Clean up Docker system
docker system prune -f
```

3. **Start Containers**

```bash
docker compose -f docker/prod/docker-compose.prod.yml up -d --build
```

4. **Import Database**

```bash
docker exec posture_code_test_wp wp db import /var/www/html/wp-content/themes/posture_cool_things/backups/backup-20250309-190424.sql --allow-root --user=wordpress --password=wordpress_password --host=db
```

5. **Configure WordPress**

```bash
# Update site URLs
docker exec posture_code_test_wp wp option update home 'http://localhost' --allow-root
docker exec posture_code_test_wp wp option update siteurl 'http://localhost' --allow-root

# Activate plugins (using direct wp commands instead of script)
docker exec posture_code_test_wp wp plugin activate advanced-custom-fields --allow-root
docker exec posture_code_test_wp wp plugin activate classic-editor --allow-root
docker exec posture_code_test_wp wp plugin activate wp-post-page-clone --allow-root

# Flush cache
docker exec posture_code_test_wp wp cache flush --allow-root
```

6. **Verify Setup**

```bash
# Check WordPress version and status
docker exec posture_code_test_wp wp core version --allow-root

# Verify plugins are active
docker exec posture_code_test_wp wp plugin list --allow-root

# Check theme status
docker exec posture_code_test_wp wp theme list --allow-root
```

7. **Access WordPress**

- Open http://localhost in your browser
- You should see your WordPress site with all plugins activated

## Verification

- Access WordPress at: http://localhost
- Check container status: `docker ps`
- View logs:
  ```bash
  docker logs posture_code_test_wp
  docker logs posture_prod_nginx
  docker logs posture_code_test_db
  ```

## Common Issues and Solutions

### 502 Bad Gateway

If you see a 502 error:

1. Check nginx logs: `docker logs posture_prod_nginx`
2. Verify WordPress container is running: `docker ps`
3. Restart containers:
   ```bash
   docker compose -f docker/prod/docker-compose.prod.yml restart
   ```

### Database Connection Issues

If WordPress can't connect to the database:

1. Verify database container is running: `docker ps`
2. Check database credentials in .env.prod
3. Try restarting the database:
   ```bash
   docker compose -f docker/prod/docker-compose.prod.yml restart db
   ```

### Container Name Conflicts

If you see "container name already in use":

bash
docker compose -f docker/prod/docker-compose.prod.yml down -v
docker rm -f posture_code_test_db posture_code_test_wp posture_prod_nginx
docker system prune -f

## Maintenance

### Backup Database

bash
docker exec posture_code_test_wp wp db export /var/www/html/wp-content/themes/posture_cool_things/backups/backup-$(date +%Y%m%d-%H%M%S).sql --allow-root

### Update WordPress Core

bash
docker exec posture_code_test_wp wp core update --allow-root

### Update Plugins

bash
docker exec posture_code_test_wp wp plugin update --all --allow-root

## WordPress Setup

### Method 1: Install Plugins via WP-CLI

After containers are running, install required plugins:

```bash
# Wait for WordPress to be ready
until docker exec posture_code_test_wp wp core is-installed --allow-root; do
    echo "Waiting for WordPress to be ready..."
    sleep 5
done

# Install and activate plugins
docker exec posture_code_test_wp wp plugin install advanced-custom-fields classic-editor wp-post-page-clone --allow-root
docker exec posture_code_test_wp wp plugin activate advanced-custom-fields classic-editor wp-post-page-clone --allow-root

# Verify plugin installation
docker exec posture_code_test_wp wp plugin list --allow-root
```

### Method 2: Add to Dockerfile (Automated Installation)

Alternatively, you can add these to your Dockerfile.prod for automated installation:

```dockerfile
# After WordPress setup, install and activate required plugins
RUN wp plugin install advanced-custom-fields --activate --allow-root
```

### Required Plugins

- Advanced Custom Fields
- Classic Editor
- WP Post Page Clone

### Theme Setup

1. Activate the theme:

```bash
docker exec posture_code_test_wp wp theme activate posture_cool_things --allow-root
```

2. Verify theme settings:

```bash
docker exec posture_code_test_wp wp theme status posture_cool_things --allow-root
```

### Import Content (if needed)

```bash
# Import posts
docker exec posture_code_test_wp wp import /path/to/content.xml --authors=create --allow-root

# Import widget settings
docker exec posture_code_test_wp wp widget reset --all --allow-root
```

### Configure Permalinks

```bash
# Set permalinks to post name
docker exec posture_code_test_wp wp rewrite structure '/%postname%/' --allow-root
docker exec posture_code_test_wp wp rewrite flush --allow-root
```

### Additional Configuration

1. Update PHP settings if needed:

```bash
docker exec posture_code_test_wp wp config set WP_MEMORY_LIMIT 256M --allow-root
```

2. Set up development settings:

```bash
docker exec posture_code_test_wp wp config set WP_DEBUG true --allow-root
docker exec posture_code_test_wp wp config set WP_DEBUG_LOG true --allow-root
```

### Verify Installation

```bash
# Check WordPress version
docker exec posture_code_test_wp wp core version --allow-root

# List active plugins
docker exec posture_code_test_wp wp plugin list --allow-root

# Check theme status
docker exec posture_code_test_wp wp theme list --allow-root
```

## Quick Start

Here's a quick sequence of commands to get everything running:

### 1. Clean Environment

```bash
# Stop and clean everything
docker compose -f docker/prod/docker-compose.prod.yml down -v
docker rm -f posture_code_test_db posture_code_test_wp posture_prod_nginx 2>/dev/null || true
docker system prune -f
```

### 2. Start Containers

```bash
# Rebuild and start containers
docker compose -f docker/prod/docker-compose.prod.yml up -d --build

# Wait about 30 seconds for MySQL to initialize
```

### 3. Import Database

```bash
docker exec posture_code_test_wp wp db import \
    /var/www/html/wp-content/themes/posture_cool_things/backups/backup-20250309-190424.sql \
    --allow-root --user=wordpress --password=wordpress_password --host=db
```

### 4. Configure WordPress

```bash
# Update site URLs
docker exec posture_code_test_wp wp option update home 'http://localhost' --allow-root
docker exec posture_code_test_wp wp option update siteurl 'http://localhost' --allow-root
```

### 5. Activate Plugins

```bash
# Wait for WordPress to be ready
until docker exec posture_code_test_wp wp core is-installed --allow-root; do
    echo "Waiting for WordPress to be ready..."
    sleep 5
done

# Install and activate plugins
docker exec posture_code_test_wp wp plugin install advanced-custom-fields classic-editor wp-post-page-clone --allow-root
docker exec posture_code_test_wp wp plugin activate advanced-custom-fields classic-editor wp-post-page-clone --allow-root
```

### 6. Finalize Setup

```bash
# Flush cache
docker exec posture_code_test_wp wp cache flush --allow-root

# Verify plugins
docker exec posture_code_test_wp wp plugin list --allow-root
```

### 7. Access Site

Open [http://localhost](http://localhost) in your browser to verify the installation.
