FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libzip-dev \
    libicu-dev \
    libsodium-dev \
    libonig-dev

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip sodium intl opcache sockets

COPY php.ini /usr/local/etc/php/conf.d/php.ini

RUN { \
    echo '[www]'; \
    echo 'user = www-data'; \
    echo 'group = www-data'; \
    echo 'listen = 9000'; \
    echo 'pm = dynamic'; \
    echo 'pm.max_children = 50'; \
    echo 'pm.start_servers = 5'; \
    echo 'pm.min_spare_servers = 5'; \
    echo 'pm.max_spare_servers = 35'; \
    echo 'pm.max_requests = 500'; \
    echo 'access.log = /proc/self/fd/2'; \
    echo 'catch_workers_output = yes'; \
    echo 'decorate_workers_output = no'; \
    echo 'php_admin_flag[log_errors] = on'; \
    echo 'php_admin_value[error_log] = /proc/stderr'; \
    echo 'php_admin_flag[allow_url_fopen] = on'; \
    echo 'php_admin_flag[allow_url_include] = off'; \
    echo 'php_admin_value[session.cookie_httponly] = 1'; \
    echo 'php_admin_value[session.use_only_cookies] = 1'; \
} > /usr/local/etc/php-fpm.d/www.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN usermod -u 1001 www-data && groupmod -g 1001 www-data
RUN chown -R www-data:www-data /var/www

WORKDIR /var/www

# Change current user to www
USER 1001

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
