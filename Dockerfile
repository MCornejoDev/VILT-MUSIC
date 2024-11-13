# Use the official PHP 8.3 image with Apache
FROM php:8.3-apache

# Install necessary dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Configure and install PHP extensions one by one to identify potential issues
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd

RUN docker-php-ext-install mysqli pdo pdo_mysql zip
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install dom
RUN docker-php-ext-install xml
RUN docker-php-ext-install xmlwriter

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Enable mod_rewrite for Apache (useful for frameworks like Laravel or Symfony)
RUN a2enmod rewrite

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Change permissions for the Apache user
RUN chown -R www-data:www-data /var/www/html

# Create logs directory and set permissions
RUN mkdir -p /var/www/html/logs && \
    touch /var/www/html/logs/error.log && \
    chown -R www-data:www-data /var/www/html/logs

# Copy custom PHP configuration
COPY ./php.ini /usr/local/etc/php/php.ini

# Expose port 80 for Apache
EXPOSE 80

# Copy the custom Apache configuration to set the DocumentRoot to the public folder
COPY ./apache-config.conf /etc/apache2/sites-available/000-default.conf

# Copy the application source code to the container
COPY . /var/www/html

# Start Apache in the foreground
CMD ["apache2-foreground"]
