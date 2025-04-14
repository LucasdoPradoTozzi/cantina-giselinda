FROM php:8.2-apache

# Instala dependências necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    default-mysql-client \
    && docker-php-ext-install zip pdo pdo_mysql bcmath



# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia os arquivos da aplicação Laravel para o contêiner
COPY . /var/www/html

# Copia o arquivo de configuração do Apache para o contêiner
COPY ./docker/php/000-default.conf /etc/apache2/sites-available/000-default.conf

# Dá permissões para a pasta storage e bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Habilita o módulo rewrite para o Laravel
RUN a2enmod rewrite

# Reinicia o Apache para garantir que as configurações sejam aplicadas
RUN service apache2 restart

# Comando para iniciar o Apache
CMD ["apache2-foreground"]
