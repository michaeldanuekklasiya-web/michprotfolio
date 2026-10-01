#!/bin/bash

# Pastikan environment berjalan di production (kecuali di-override oleh env Render)
export APP_ENV=${APP_ENV:-production}

# Menjalankan migrasi database jika tersedia konfigurasi database
# Jika tidak ingin migrasi otomatis jalan, baris ini bisa dikomentari
php artisan migrate --force

# Membersihkan dan meload konfigurasi cache baru
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Menjalankan PHP-FPM di background
php-fpm -D

# Menjalankan Nginx di foreground (agar container Render tidak otomatis tertutup)
nginx -g "daemon off;"
