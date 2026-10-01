# Gunakan image PHP 8.2 FPM
FROM php:8.2-fpm

# Install system dependencies & Node.js (untuk build assets)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx \
    nodejs \
    npm

# Bersihkan cache instalasi
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install ekstensi PHP yang dibutuhkan Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Dapatkan Composer terbaru dari image resmi
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set direktori kerja (root project di dalam container)
WORKDIR /var/www

# Copy seluruh file project ke dalam direktori kerja
COPY . .

# Install dependensi PHP (tanpa depedensi dev untuk production)
RUN composer install --no-dev --optimize-autoloader

# Install dependensi Node (seperti Tailwind/Vite) dan build
RUN npm install && npm run build

# Copy konfigurasi Nginx dari folder docker/
COPY docker/nginx.conf /etc/nginx/sites-enabled/default

# Copy script start dari folder docker/
COPY docker/start.sh /usr/local/bin/start
RUN chmod u+x /usr/local/bin/start

# Berikan hak akses kepada user www-data (Nginx & PHP)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Buka port 80 untuk akses web
EXPOSE 80

# Eksekusi script start saat container dinyalakan
CMD ["/usr/local/bin/start"]
