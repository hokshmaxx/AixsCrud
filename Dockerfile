# Use an official PHP runtime
FROM php:8.2-fpm

# Install required system dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libzip-dev \  # Ensure libzip is installed
    libpq-dev \
    libpng-dev

# Install PHP extensions
RUN docker-php-ext-configure zip \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Set working directory
WORKDIR /var/www/html

# Copy Laravel files
COPY . .

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Expose Cloud Run's expected port
EXPOSE 8080

# Start Laravel using PHP-FPM
CMD ["php-fpm"]
