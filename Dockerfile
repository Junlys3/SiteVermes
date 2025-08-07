# Escolhe imagem oficial com PHP + Apache
FROM php:8.2-apache

# Instala extensões necessárias do Laravel
RUN apt-get update && apt-get install -y \
    git unzip zip curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Habilita mod_rewrite do Apache (necessário para Laravel)
RUN a2enmod rewrite

# Copia o projeto para o container
COPY . /var/www/html

# Define o diretório de trabalho
WORKDIR /var/www/html

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Permissões para o storage e cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expõe a porta 80
EXPOSE 80
