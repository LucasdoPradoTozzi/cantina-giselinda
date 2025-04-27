# MyApp

Projeto em Laravel rodando com Docker.

## Requisitos

- Docker
- Docker Compose

## Instalação


# Copie o arquivo de exemplo do ambiente
cp .env.example .env

# Suba os containers com o Docker
docker-compose up --build

# Instale as dependências do PHP
docker exec myapp-php composer install

# Gere a chave da aplicação
docker exec myapp-php php artisan key:generate

# Rode as migrations
docker exec myapp-php php artisan migrate

# Crie o link simbólico do storage
docker exec myapp-php php artisan storage:link
