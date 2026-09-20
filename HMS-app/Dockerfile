# Use PHP 8.2 with Apache (Fixes Composer lock PHP requirement)
FROM php:8.2-apache

# Install system dependencies and Node.js (for frontend compilation)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Enable Apache mod_rewrite (required for Laravel routing)
RUN a2enmod rewrite

# Change Apache document root to Laravel's 'public' folder
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set working directory
WORKDIR /var/www/html

# Copy the application code into the container
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies and compile Tailwind/Livewire frontend
RUN npm install
# (Laravel 8 usually uses Laravel Mix, so we run production. If it fails, fallback to npm run build is not needed for Mix)
RUN npm run production

# Set proper permissions for Laravel's storage and cache folders
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Render automatically exposes port 80/8080. Apache listens on 80 by default.
EXPOSE 80

# Run database migrations automatically, then start the Apache server
CMD php artisan migrate --force && php artisan db:seed --class=DoctorAndAppointmentSeeder --force && apache2-foreground

