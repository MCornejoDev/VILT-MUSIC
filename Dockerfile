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

# Habilitar mod_rewrite de Apache (útil para frameworks como Laravel o Symfony)
RUN a2enmod rewrite

# Configurar el directorio de trabajo en /var/www/html
WORKDIR /var/www/html

# Cambiar los permisos para el usuario de Apache
RUN chown -R www-data:www-data /var/www/html

# Crear la carpeta de logs y otorgar permisos para escribir en ella
RUN mkdir -p /var/www/html/logs && \
    touch /var/www/html/logs/error.log && \
    chown -R www-data:www-data /var/www/html/logs

# Copiar configuración personalizada de PHP
COPY ./php.ini /usr/local/etc/php/php.ini

# Exponer el puerto 80 para Apache
EXPOSE 80

# Copiar la configuración personalizada de Apache para apuntar a la carpeta public
COPY ./apache-config.conf /etc/apache2/sites-available/000-default.conf

# Copiar el código fuente al contenedor
COPY . /var/www/html

# Comando de inicio
CMD ["apache2-foreground"]
