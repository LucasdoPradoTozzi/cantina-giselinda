FROM php:8.2-apache

ARG user
ARG uid

# Instala dependências
RUN apt-get update && apt-get install -y \
    libzip-dev unzip default-mysql-client \
    && docker-php-ext-install zip pdo pdo_mysql bcmath

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cria usuário não-root
RUN useradd -G www-data -u $uid -d /home/$user -m $user && \
    mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Copia a aplicação
COPY . /var/www/html

# Permissões
RUN chown -R $user:www-data /var/www/html && \
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configura Apache
COPY ./docker/php/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Troca o usuário para não-root
USER $user

CMD ["apache2-foreground"]
