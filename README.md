# Docker Setup, Container Commands

1. Install Docker Desktop
2. Run `docker compose up`
3. Run `docker compose down` to stop the container
4. Run `docker compose exec wordpress bash` to get a bash shell into the container
5. Run `docker compose exec wordpress wp --info` to get information about the WordPress installation
6. Run `docker compose exec wordpress wp --version` to get the WordPress version
7. Run `docker compose exec wordpress wp --help` to get help about the WordPress CLI
8. Run `docker compose exec wordpress wp --info` to get information about the WordPress installation
9. Run `docker compose exec wordpress wp --version` to get the WordPress version
10. Run `docker compose exec wordpress wp --help` to get help about the WordPress CLI

# Docker Compose Development Mode

Run `docker compose up -d` in one terminal to start the container in "development mode"

Run `docker compose exec wordpress npm run watch-sass` in another terminal to watch for changes in the `sass` and `js` folders and automatically compile them.

- The container will also watch for changes in the `wp-content/themes/posture_cool_things` folder and will automatically sync them to the container.
- The container will also watch for changes in the `wp-content/plugins` folder and will automatically sync them to the container.
- The container will also watch for changes in the `wp-content/languages` folder and will automatically sync them to the container.
- The container will also watch for changes in the `wp-content/uploads` folder and will automatically sync them to the container.

# WordPress Admin

- The WordPress admin is available at `http://localhost:8080/wp-admin`
- The WordPress admin credentials are `chadzilla` for the username and `starkindustries` for the password

# WordPress Theme Development

- The theme is located in the `wp-content/themes/posture_cool_things` folder
- The `sass` and `js` folders are compiled to the `wp-content/themes/posture_cool_things/dist` folder
- The `sass` and `js` folders are compiled to the `wp-content/themes/posture_cool_things/dist` folder
- The `sass` and `js` folders are compiled to the `wp-content/themes/posture_cool_things/dist` folder

# WordPress Plugin Development

- The plugins are located in the `wp-content/plugins` folder
- The plugins are compiled to the `wp-content/plugins/dist` folder
- The plugins are compiled to the `wp-content/plugins/dist` folder

# WordPress Language Development

- The languages are located in the `wp-content/languages` folder
- The languages are compiled to the `wp-content/languages/dist` folder
- The languages are compiled to the `wp-content/languages/dist` folder

# WordPress Uploads

- The uploads are located in the `wp-content/uploads` folder
- The uploads are compiled to the `wp-content/uploads/dist` folder
- The uploads are compiled to the `wp-content/uploads/dist` folder

# WordPress Core Development

- The core is located in the `wp-content/core` folder
- The core is compiled to the `wp-content/core/dist` folder
- The core is compiled to the `wp-content/core/dist` folder

# WordPress Configuration

- The configuration is located in the `wp-content/config` folder
- The configuration is compiled to the `wp-content/config/dist` folder
- The configuration is compiled to the `wp-content/config/dist` folder

# WordPress Debugging

- The debugging is located in the `wp-content/debug` folder
- The debugging is compiled to the `wp-content/debug/dist` folder
- The debugging is compiled to the `wp-content/debug/dist` folder

# WordPress Development Tools

- The development tools are located in the `wp-content/development-tools` folder
- The development tools are compiled to the `wp-content/development-tools/dist` folder
- The development tools are compiled to the `wp-content/development-tools/dist` folder

# Cool Things WordPress Theme Development

This project involves converting a Figma design into a fully functional WordPress theme for a technical assessment. The design features a modern, clean interface with mobile-responsive components and dynamic content sections.

## Table of Contents

1. **Project Setup**

   - Development Environment Configuration
   - Docker Configuration
   - WordPress Installation
   - Theme Structure Setup

2. **Design Assets**

   - Figma Design Analysis
   - Asset Export Guidelines
   - Color Palette & Typography
   - Image Optimization Strategy

3. **Theme Development**

   - Header Component
   - Hero Section ("WE HAE A SOLUTION...")
   - Features Section ("WE'RE THE BEST AT THINGS")
   - Call-to-Action Section ("THIS IS WHY THE THING MATTERS")
   - News & Updates Carousel
   - Footer Component

4. **Core Functionality**

   - WordPress Template Hierarchy
   - Custom Post Types
   - Advanced Custom Fields Setup
   - Navigation Menus
   - Dynamic Content Areas

5. **Interactive Elements**

   - News Carousel Implementation
   - Button Animations
   - Responsive Navigation
   - Scroll Effects

6. **Responsive Design**

   - Mobile-First Approach
   - Breakpoint Strategy
   - Media Queries
   - Image Scaling

7. **Performance Optimization**

   - Asset Loading
   - Image Optimization
   - Caching Strategy
   - Code Minification

8. **Testing & Quality Assurance**

   - Cross-Browser Testing
   - Mobile Device Testing
   - Performance Testing
   - WordPress Standards Compliance

9. **Deployment**
   - Production Environment Setup
   - Launch Checklist
   - Performance Monitoring
   - Maintenance Plan

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

## Getting Started

[Development setup instructions will be added here]

## Contributing

This is a technical assessment project and is not open for contributions.

## License

[License information will be added here]

## Design Analysis

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

This analysis will help us structure our theme development and ensure we capture all necessary design elements. Would you like to focus on any particular aspect to begin the implementation?

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

docker compose exec wordpress wp plugin install figma-to-wp --activate

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
