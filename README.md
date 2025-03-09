# Cool Things WordPress Theme

A modern, responsive WordPress theme built with SASS and Docker. Features a dynamic front page with hero section, features showcase, CTA sections, and a news feed.

## Table of Contents

| Section & Subsections   | Description                       | Location                                                      | Line |
| ----------------------- | --------------------------------- | ------------------------------------------------------------- | ---- |
| **Theme Structure**     | Directory layout and organization | [Theme Structure](#theme-structure)                           | ~35  |
| └─ Directory Tree       | Detailed file structure           | [Directory Tree](#theme-structure)                            | ~37  |
| **Development Setup**   | Setup and installation            | [Development Setup](#development-setup)                       | ~54  |
| └─ Prerequisites        | Required software and tools       | [Prerequisites](#prerequisites)                               | ~56  |
| └─ Installation         | Step-by-step setup guide          | [Installation](#installation)                                 | ~62  |
| **Docker Development**  | Local development environment     | [Docker Development](#docker-development)                     | ~81  |
| └─ Container Commands   | Basic docker commands             | [Container Commands](#docker-setup-container-commands)        | ~83  |
| └─ Development Mode     | Working with docker watchers      | [Development Mode](#docker-compose-development-mode)          | ~91  |
| **Docker Production**   | Production environment setup      | [Production Docker Setup](#production-docker-setup)           | ~240 |
| └─ Installation Steps   | Server setup process              | [Production Installation](#production-installation)           | ~244 |
| └─ SSL Configuration    | Setting up HTTPS                  | [SSL Setup](#ssl-configuration)                               | ~260 |
| └─ Monitoring           | Logs and container status         | [Monitoring](#monitoring)                                     | ~280 |
| **Theme Development**   | Theme implementation details      | [Theme Development](#cool-things-wordpress-theme-development) | ~110 |
| └─ Project Overview     | Goals and requirements            | [Project Overview](#project-overview)                         | ~114 |
| └─ Key Features         | Core functionality                | [Key Features](#key-features)                                 | ~124 |
| └─ Development Stack    | Technologies used                 | [Development Stack](#development-stack)                       | ~134 |
| **Design System**       | Visual design specifications      | [Design Analysis](#design-analysis)                           | ~315 |
| └─ Color Palette        | Brand colors                      | [Color Palette](#color-palette)                               | ~319 |
| └─ Typography           | Fonts and text styles             | [Typography](#typography)                                     | ~326 |
| └─ Layout Components    | UI component specs                | [Layout Components](#layout-components)                       | ~336 |
| **Asset Management**    | Required files and resources      | [Required Assets](#required-assets-for-export)                | ~380 |
| └─ Critical Elements    | Essential design assets           | [Critical Elements](#critical-elements)                       | ~382 |
| └─ Export Checklist     | Asset export guide                | [Export Checklist](#figma-export-checklist-by-section)        | ~400 |
| **Disaster Recovery**   | Backup and restore                | [Disaster Recovery](#disaster-recovery)                       | ~420 |
| └─ Backup Procedures    | Database backup steps             | [Backup Database](#backup-database)                           | ~422 |
| └─ Recovery Steps       | Manual recovery guide             | [Manual Recovery](#manual-recovery-steps-macro-steps)         | ~430 |
| **Database Management** | Database operations and backups   | [Database Management](#database-management)                   | ~450 |
| └─ Manual Backups       | Manual backup commands            | [Manual Backups](#manual-database-backups)                    | ~452 |
| └─ Automated Backups    | Scheduled backup configuration    | [Automated Backups](#automated-database-backups)              | ~465 |
| └─ Backup Recovery      | Restoring from backups            | [Backup Recovery](#restoring-from-database-backups)           | ~475 |

## Theme Structure

```
posture_cool_things/
├── assets/
│   ├── images/      # Theme images and SVGs
│   ├── js/          # JavaScript files
│   └── sass/        # SASS structure
│       ├── abstracts/   # Variables, mixins, tokens
│       ├── base/        # Base styles
│       ├── components/  # Reusable components
│       ├── layout/      # Layout structures
│       └── pages/       # Page-specific styles
├── dist/            # Compiled assets
├── template-parts/  # Reusable template parts
├── functions.php    # Theme functionality
├── front-page.php   # Homepage template
└── style.css       # Theme information
```

## Development Setup

### Prerequisites

- Docker Desktop
- Node.js (v14+)
- npm (v6+)

### Installation Steps

1. Clone the repository:

```bash
git clone [repository-url]
```

2. Start Docker Dev Environment:

```bash
# Initial setup
docker compose up -d

# Watch for changes
docker compose watch

# If you modify Docker files
docker compose up --build && docker compose watch
```

### Docker Development Commands

1. Start container

```bash
docker compose up
```

2. Stop container

```bash
docker compose down
```

3. Access container shell

```bash
docker compose exec wordpress bash
```

4. WordPress CLI commands

```bash
docker compose exec wordpress wp --info
docker compose exec wordpress wp --version
docker compose exec wordpress wp --help
```

### Development Mode

When making changes to Docker files while watchers are running:

```bash
# Reset containers
docker compose down -v

# Rebuild and watch
docker compose up --build && docker compose watch

# Start dev mode
docker compose up -d

# Watch SASS changes
docker compose exec wordpress npm run watch-sass
```

The container will automatically watch and sync changes in:

- `wp-content/themes/posture_cool_things/`
- `wp-content/plugins/`
- `wp-content/languages/`
- `wp-content/uploads/`

## Production Docker Setup

### Initial Docker Installation

```bash
# Install Docker
curl -fsSL https://get.docker.com -o get-docker.sh
sh get-docker.sh

# Install Docker Compose
sudo curl -L "https://github.com/docker/compose/releases/download/v2.23.0/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
sudo chmod +x /usr/local/bin/docker-compose
```

### Project Structure

```
.
├── docker-compose.prod.yml  # Production Docker Compose configuration
├── Dockerfile.prod         # Production Dockerfile
├── nginx.conf             # Nginx reverse proxy configuration
├── deploy.sh             # Deployment script
├── .env                  # Environment variables (do not commit)
└── wp-content/          # WordPress theme and plugins
```

### SSL Configuration

```bash
# Install certbot
sudo apt-get update
sudo apt-get install certbot

# Generate certificate
sudo certbot certonly --standalone -d your-domain.com

# Setup SSL directory and copy certificates
mkdir -p ssl
sudo cp /etc/letsencrypt/live/your-domain.com/fullchain.pem ssl/
sudo cp /etc/letsencrypt/live/your-domain.com/privkey.pem ssl/
```

### Environment Setup

```env
DB_NAME=your_database_name
DB_USER=your_database_user
DB_PASSWORD=your_secure_password
DB_ROOT_PASSWORD=your_secure_root_password
WP_TABLE_PREFIX=wp_
```

### Theme Deployment

```bash
# Clone theme repository
git clone https://github.com/your-repo/your-wordpress-theme.git
cd your-wordpress-theme

# Make deploy script executable and run
chmod +x deploy.sh
./deploy.sh
```

### SSL Auto-renewal Setup

```bash
# Test SSL renewal
sudo certbot renew --dry-run

# Setup automatic renewal (runs at midnight on the 1st of each month)
sudo crontab -e
0 0 1 * * certbot renew
```

### Container Management

```bash
# View container logs
docker-compose -f docker-compose.prod.yml logs          # All containers
docker-compose -f docker-compose.prod.yml logs wordpress  # Specific container

# Check container status
docker-compose -f docker-compose.prod.yml ps

# View recent logs
docker-compose -f docker-compose.prod.yml logs --tail=100

# Restart services
docker-compose -f docker-compose.prod.yml restart wordpress
```

### Security Configuration

```bash
# Configure firewall
sudo ufw allow 80
sudo ufw allow 443
sudo ufw allow 22
sudo ufw enable

# Set proper file permissions
sudo chown -R www-data:www-data wp-content
```

This README provides a comprehensive guide for deploying and maintaining your WordPress application in production. Each section includes the necessary commands and configurations for a complete setup.

# Cool Things WordPress Theme Development

This project involves converting a Figma design into a fully functional WordPress theme for a technical assessment. The design features a modern, clean interface with mobile-responsive components and dynamic content sections.

## Project Overview

This WordPress theme is being developed as part of a technical assessment. The primary goal is to accurately translate a Figma design into a fully functional WordPress theme while demonstrating:

- Clean, maintainable code
- WordPress best practices
- Responsive design implementation
- Performance optimization
- Modern development workflows

## Key Features

- Modern, clean design
- Responsive layout
- Dynamic news carousel
- Custom post types for content management
- Interactive UI elements
- Optimized performance
- Mobile-first approach

## Development Stack

- WordPress
- PHP 8.x
- MySQL
- Docker
- SASS/SCSS
- JavaScript/jQuery
- ACF (Advanced Custom Fields)

# Design Analysis

### Color Palette

- Primary Blue: #00B2CB (Used in background sections)
- White: #FFFFFF (Text and cards)
- Dark Navy: #2D3047 (Text and icons)
- Orange/Yellow: #FFB84D (Logo dot and CTA buttons)

### Typography

- Headings: Appears to be a bold sans-serif font
  - "WE HAE A SOLUTION..." - Large hero text
  - "WE'RE THE BEST AT THINGS" - Section heading
  - "THIS IS WHY THE THING MATTERS" - Section heading
  - "NEWS & UPDATES" - Section heading
- Body Text: Light/Regular weight sans-serif font
  - Lorem ipsum placeholder text used throughout

### Layout Components

1. **Header**

   - Logo with "Cool Things" text and orange dot
   - (Navigation menu not visible in screenshot but should be planned for)

2. **Hero Section**

   - Full-width blue background
   - Large white text headline
   - "PRODUCTS" CTA button with white border

3. **Features Card**

   - White card with drop shadow
   - Left side: Illustration of phone with person
   - Right side: Heading and descriptive text
   - "SERVICES" CTA button in orange/yellow

4. **Call-to-Action Section**

   - Blue background
   - Left side: White text content
   - Right side: Large phone illustration with person
   - "SERVICES" CTA button with white border

5. **News & Updates Section**
   - White background
   - Carousel/slider functionality
   - Three card layout with navigation arrows
   - Each card contains:
   - Image
   - Title text
   - Card shadow effects
   - "GO TO NEWS FEED" button centered below

### Required Assets for Export

1. **Images**

   - Logo and orange dot
   - Phone illustration with person (Features section)
   - Phone illustration with person (CTA section)
   - News article images
   - Left/Right carousel arrows

2. **Icons**

   - Navigation arrows for carousel
   - Any UI icons in the phone illustrations

3. **Interactive Elements**
   - Button hover states
   - Carousel navigation
   - Card hover effects

### Responsive Considerations

- Hero section will need text scaling
- Features card should stack on mobile
- CTA section should stack on mobile
- News carousel should adapt to single column on mobile
- Maintain readable text sizes across breakpoints

### Animation Requirements

- Carousel sliding effect
- Button hover states
- Possible scroll animations for sections
- Card hover effects

### Asset Export Checklist

1. **Logo & Branding**
   - [ ] "Cool Things" logo with orange dot (#FFB84D)
   - [ ] Brand font specifications
2. **Hero Section**

   - [ ] Background image/overlay (turquoise blue #00B2CB)
   - [ ] "PRODUCTS" button styles (white border, transparent background)

3. **Features Section**

   - [ ] Phone mockup with person illustration (left side)
   - [ ] Card shadow specifications
   - [ ] "SERVICES" button (orange/yellow #FFB84D)

4. **CTA Section**

   - [ ] Phone mockup with woman illustration
   - [ ] Decorative elements (white shapes/patterns if any)
   - [ ] "SERVICES" button (white border variant)

5. **News & Updates Section**

   - [ ] Carousel navigation arrows (left/right)
   - [ ] Card shadow specifications
   - [ ] "GO TO NEWS FEED" button with icon
   - [ ] Sample news images for testing

6. **UI Elements**

   - [ ] Button states (normal, hover, active)
   - [ ] Card hover effects
   - [ ] Shadow values for cards
   - [ ] Spacing measurements between sections

7. **Responsive Breakpoints**
   - [ ] Desktop (shown in design)
   - [ ] Tablet breakpoint specifications
   - [ ] Mobile breakpoint specifications

### Design Asset Inventory

#### Critical Elements

- [ ] Logo with orange dot
- [ ] Hero section background/overlay
- [ ] Phone mockup with person (Features)
- [ ] Phone mockup with woman (CTA)
- [ ] News carousel arrows
- [ ] Sample news images

#### Typography

- [ ] Heading font family
- [ ] Body font family
- [ ] Font weights used
- [ ] Line heights
- [ ] Letter spacing values

#### Measurements

- [ ] Section padding values
- [ ] Component spacing
- [ ] Card padding
- [ ] Button padding
- [ ] Responsive breakpoints

#### Interactive Elements

- [ ] Button hover states
- [ ] Card hover effects
- [ ] Carousel interaction

### Figma Export Checklist (By Section)

#### 1. Header Assets

- [ ] Logo "Cool Things" text
- [ ] Orange dot
- [ ] Combined logo as SVG (if possible)

#### 2. Hero Section Assets

- [ ] Background overlay/pattern
- [ ] "PRODUCTS" button (normal state)
- [ ] "PRODUCTS" button (hover state)

#### 3. Features Card Assets

- [ ] Phone mockup with person
- [ ] Card shadow/background
- [ ] "SERVICES" button (orange version)

#### 4. CTA Section Assets

- [ ] Phone mockup with woman
- [ ] Any background patterns/elements
- [ ] "SERVICES" button (white version)

#### 5. News Section Assets

- [ ] Left arrow icon
- [ ] Right arrow icon
- [ ] Sample news image
- [ ] "GO TO NEWS FEED" button

Export Format Guide:

- Logos/Icons: SVG preferred
- Photos/Complex Images: PNG (2x for retina)
- UI Elements: SVG where possible

## Theme Features

### Front Page Sections

1. **Hero Section**

   - Full-width background with overlay
   - Responsive typography
   - Call-to-action button

2. **Features Section**

   - Card layout with enhanced shadow
   - SVG illustrations
   - Responsive content

3. **CTA Section**

   - Brand color background
   - Offset image positioning
   - White text on brand background

4. **News Section**
   - Dynamic post grid (3 columns)
   - Custom image sizes (384x212)
   - Hover effects and transitions
   - "Go to News Feed" fancy button

### WordPress Integration

- Custom image sizes for news thumbnails
- Dynamic post queries
- Proper template hierarchy
- Theme setup functions
- Google Fonts integration

## Browser Support

- Last 2 versions of major browsers
- IE 11 (basic support)
- Mobile-first approach

## Disaster Recovery

### Backup Database

```bash
# Create a backup
docker compose exec backup-service /scripts/backup.sh
```

### Restore Database

```bash
# Restore from latest backup
docker compose exec backup-service /scripts/restore.sh
```

### Manual Recovery Steps (if no backup) - Macro Steps

1. **WordPress Core Setup**

   - Complete WordPress installation
   - Set permalink structure (Settings > Permalinks)
   - Create required pages (Home, Blog, etc.)
   - Set static front page (Settings > Reading)

2. **Theme Setup**

   - Activate Cool Things theme
   - Upload required media:
     - Logo.svg
     - Rectangle1.svg (hero)
     - Man and phone 1.svg
     - Woman on phone 1.svg

3. **Navigation**

   - Create Primary Menu
   - Add menu items
   - Assign to Primary Menu location

4. **Content Recovery**

   - Create essential pages
   - Add sample blog posts
   - Set featured images
   - Configure ACF fields

5. **Plugin Setup**
   - Install/activate required plugins:
     - Advanced Custom Fields
     - Any other required plugins

### Manual Recovery Steps - Micro Steps

1. **Create Pages:**

   - Home/Front Page
   - Blog
   - About
   - Contact

2. **WordPress Settings:**

   - Settings > Reading
   - Set "Your homepage displays" to "A static page"
   - Set Homepage to "Home"
   - Set Posts page to "Blog"

3. **Theme Settings:**

   - Activate the Cool Things theme
   - Appearance > Customize
   - Set up site identity (logo, title)

4. **Create Menu:**

   - Appearance > Menus
   - Create "Primary Menu"
   - Add pages to menu
   - Set location to "Primary Menu"

5. **Add Content:**
   - Create sample blog posts
   - Upload media files
   - Set featured images

### Preventive Measures

1. **Regular Backups**

   ```bash
   # Scheduled via cron in docker-compose.override.yml
   # Manual backup:
   docker compose exec backup-service /scripts/backup.sh
   ```

2. **Version Control**

   - Keep theme files in Git
   - Export and commit ACF configurations
   - Document custom post types and taxonomies

3. **Documentation**
   - Maintain list of required plugins
   - Document custom field configurations
   - Keep records of critical site settings

## Database Management

### Manual Database Backups

To manually create a database backup from the WordPress Docker container:

```bash
# Basic database export
docker exec posture_code_test_wp wp db export "backup-$(date +%Y%m%d-%H%M%S).sql" --allow-root

# Export to specific backup location
docker exec posture_code_test_wp wp db export "/var/www/html/wp-content/themes/posture_cool_things/backups/backup-$(date +%Y%m%d-%H%M%S).sql" --allow-root

# Alternative method using mysqldump directly
# IMPORTANT: Replace 'chadzilla' and 'starkindustries' with your database username and password
docker exec posture_code_test_db mysqldump -u <your_username> -p<your_password> posture_db > backup.sql
```

> **Note:** When using these commands, replace:
>
> - `<your_username>` with your database username
> - `<your_password>` with your database password
> - `posture_db` with your database name if different

### Automated Database Backups

The project includes automated backups configured in `docker-compose.override.yml`. Backups are scheduled to run daily at 2 AM EST.

To modify the backup schedule:

```yaml
# In docker-compose.override.yml
services:
  backup-service:
    # ... existing configuration ...
    command:
      - |
        # Modify the cron schedule as needed (currently set to 2 AM daily)
        echo "0 2 * * * /scripts/backup.sh >> /backups/backup.log 2>&1"
```

### Restoring from Database Backups

To restore a database from a backup file:

```bash
# Using WP-CLI
docker exec posture_code_test_wp wp db import /path/to/backup.sql --allow-root

# Using MySQL directly
# IMPORTANT: Replace credentials with your own
docker exec -i posture_code_test_db mysql -u <your_username> -p<your_password> posture_db < backup.sql
```

> **Important Security Note:**
>
> - Never commit real database credentials to version control
> - Use environment variables or `.env` files for sensitive information
> - The example credentials shown above are for demonstration only
