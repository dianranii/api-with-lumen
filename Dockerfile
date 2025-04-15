# Pakai PHP 8 + Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Copy semua file ke dalam container
COPY . .

# Install Composer dan dependency project
RUN apt-get update && apt-get install -y unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader

# Expose port (Render pakai default 10000)
EXPOSE 10000

# Start Lumen dengan PHP Built-in Server
CMD ["php", "-S", "0.0.0.0:10000", "-t", "public"]
