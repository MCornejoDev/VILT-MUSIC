# Usar la imagen oficial de PHP 8.3 con Apache
FROM php:8.3-apache

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install mysqli pdo pdo_mysql zip

# Copiar archivo de configuración PHP personalizado si es necesario
# COPY ./config/php.ini /usr/local/etc/php/

# Configurar el directorio de trabajo
WORKDIR /var/www/html

RUN chmod -R 755 /var/www/html

# Exponer el puerto 80 para Apache
EXPOSE 80

# Habilitar mod_rewrite de Apache (útil para frameworks como Laravel o Symfony)
RUN a2enmod rewrite
