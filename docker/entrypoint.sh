#!/bin/bash
set -e

APP_DIR="/var/www/html/public_html/qualita_new"

mkdir -p "${APP_DIR}/protected/runtime" "${APP_DIR}/assets"
chown -R www-data:www-data "${APP_DIR}/protected/runtime" "${APP_DIR}/assets" 2>/dev/null || true

if [ -f /var/www/html/public_html/composer.json ] && [ ! -d /var/www/html/public_html/vendor ]; then
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
    (cd /var/www/html/public_html && composer install --no-dev --no-interaction)
fi

exec apache2-foreground
