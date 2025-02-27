FROM dunglas/frankenphp:php8.2
LABEL maintainer="Eka S Ariaputra <ekasatria.ariaputra@gmail.com>"
ENV SERVER_NAME=":80"

# Set working directory
WORKDIR /app
# Install system dependencies
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    libzip-dev \
    libicu-dev \
    libxml2-dev \
    libonig-dev \
    libxslt1-dev \
    zlib1g-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    unzip \
    git \
    nano \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp --with-xpm \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install -j$(nproc) mysqli pdo pdo_mysql zip intl mbstring xml xsl opcache curl


# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# composer install
# RUN composer install