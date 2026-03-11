FROM php:8.2-cli

WORKDIR /app

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    zip \
    curl \
    nodejs \
    npm \
    libpq-dev

# Extensões PHP necessárias
RUN docker-php-ext-install zip pdo pdo_pgsql pgsql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar arquivos de dependências primeiro (melhora cache)
COPY composer.json composer.lock ./

RUN composer install --no-dev --optimize-autoloader

# Copiar dependências do Node
COPY package.json package-lock.json ./

RUN npm install

# Agora copiar o restante do projeto
COPY . .

# Build do Vite
RUN npm run build

# Garantir que assets foram gerados
RUN ls -la public/build

# Porta usada pelo Render
EXPOSE 10000

# Iniciar aplicação
CMD php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=10000
