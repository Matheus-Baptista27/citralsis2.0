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

# Copiar todo o projeto
COPY . .

# Instalar dependências PHP
RUN composer install --no-dev --optimize-autoloader

# Instalar dependências Node
RUN npm install

# Build dos assets (Vite / Tailwind)
RUN npm run build

# Verificar build
RUN ls -la public/build

# Porta usada pelo Render
EXPOSE 10000

# Iniciar aplicação
CMD php artisan serve --host=0.0.0.0 --port=10000
