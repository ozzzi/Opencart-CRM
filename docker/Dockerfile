FROM php:8.2-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    libsodium-dev \
    unzip \
    apt purge -y --auto-remove

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip sodium intl opcache sockets

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN groupadd -g 1000 www-data
RUN useradd -u 1000 -ms /bin/bash -g www www

COPY ../ /var/www
COPY --chown=www:www ./ /var/www

# Change current user to www
USER 1000

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
