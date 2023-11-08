# Etapa de construcción para instalar dependencias con Composer
FROM composer:2.6.5 as build
WORKDIR /app
COPY composer.json composer.lock /app/
# Instalar dependencias optimizando el autoloader
RUN composer install --no-dev --optimize-autoloader

# Etapa de producción con la imagen base de PHP y Apache para PHP 8.2
FROM php:8.2-apache

# Configurar Apache para escuchar en el puerto 8080
RUN echo "Listen 8080" >> /etc/apache2/ports.conf
# Habilitar mod_rewrite para soportar las URLs amigables
RUN a2enmod rewrite

# Copiar los archivos desde la etapa de construcción
COPY --from=build /app /var/www/html

# Establecer los permisos adecuados para la carpeta storage y otras necesarias
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html/storage

# Exponer el puerto 8080
EXPOSE 8080

# Configurar el directorio raíz de Apache al directorio public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Cuando se inicia el contenedor, este comando inicia Apache
CMD ["apache2-foreground"]
