# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    libpq-dev \
    libpng-dev \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Copy Laravel project
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chmod -R 777 storage bootstrap/cache

# Expose port 8080
EXPOSE 8080

# Start Apache
CMD ["apache2-foreground"]
