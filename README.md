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
