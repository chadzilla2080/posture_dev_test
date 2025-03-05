FROM wordpress:latest

# Install Node.js 20.x using NodeSource
RUN apt-get update && apt-get install -y curl gnupg \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install development tools
RUN apt-get install -y \
    inotify-tools \
    && npm install -g sass

WORKDIR /var/www/html

# Copy package.json and install dependencies
COPY package.json .
RUN npm install

# Add a startup script for SASS watching
COPY docker-entrypoint-custom.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint-custom.sh
