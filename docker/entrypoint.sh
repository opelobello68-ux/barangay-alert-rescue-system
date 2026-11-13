#!/bin/sh
set -e

PORT="${PORT:-10000}"

# Render supplies PORT at runtime. Apache normally listens on 80.
sed -ri "s/^Listen [0-9]+/Listen ${PORT}/" /etc/apache2/ports.conf
sed -ri "s#<VirtualHost \*:[0-9]+>#<VirtualHost *:${PORT}>#" /etc/apache2/sites-available/000-default.conf

cat > /etc/apache2/conf-available/bars-document-root.conf <<APACHE
<Directory /var/www/html/public>
    AllowOverride All
    Require all granted
</Directory>
APACHE

a2enconf bars-document-root >/dev/null

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

php artisan migrate --force
if [ "${BARS_SEED:-false}" = "true" ]; then
    php artisan db:seed --force
fi
php artisan storage:link || true

# Keep the web process in the foreground for Render.
exec apache2-foreground
