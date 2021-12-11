FROM php:8.0-apache

ENV APACHE_DOCUMENT_ROOT=/var/www/public

# 1. development packages
RUN apt-get update \
    && apt-get install -y npm git sudo \
#     zip \
#     curl \
    && docker-php-ext-install pdo_mysql \
# 2. apache configs + document root 
    && sed -i 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -i 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
# 3. mod_rewrite for URL rewrite and mod_headers for .htaccess extra headers like Access-Control-Allow-Origin-
    && a2enmod rewrite headers && \
# 4. start with base php config, then add extensions
    mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# 5. composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www
COPY . /var/www
# 6. we need a user with the same UID/GID with host user
# so when we execute CLI commands, all the host file's ownership remains intact
# otherwise command from inside container will create root-owned files and directories
ARG UID=1000
RUN useradd -G www-data,root -u $UID -d /home/devuser devuser && \
    mkdir -p /home/devuser/.composer && \
    chown -R www-data:www-data /var/www/storage /var/www/bootstrap