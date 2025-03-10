FROM wordpress:latest

# Install Node.js 20.x using NodeSource
RUN apt-get update && apt-get install -y curl gnupg \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install development tools, WP-CLI, and MySQL client
RUN apt-get install -y \
    inotify-tools \
    default-mysql-client \
    && npm install -g sass \
    && curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

WORKDIR /var/www/html

# Copy package.json and install dependencies
COPY package.json .
RUN npm install

# Add a startup script for SASS watching
COPY docker-entrypoint-custom.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint-custom.sh
