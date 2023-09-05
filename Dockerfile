FROM php:8.1-apache

RUN rm -rf /var/www/html/*
WORKDIR /var/www/html/

# Install Node
RUN apt-get update && apt-get -y install curl gnupg
RUN set -uex; \
    apt-get update; \
    apt-get install -y ca-certificates curl gnupg; \
    mkdir -p /etc/apt/keyrings; \
    curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key \
     | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg; \
    NODE_MAJOR=18; \
    echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_MAJOR.x nodistro main" \
     > /etc/apt/sources.list.d/nodesource.list; \
    apt-get update; \
    apt-get install nodejs -y;

# Install PHP modules
RUN docker-php-ext-install mysqli

# Install Node depdencies
COPY package.json .
COPY config.env.php config.php
RUN npm install
# Install PoracleWeb
COPY . .
