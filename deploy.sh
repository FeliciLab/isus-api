# Turn on maintenance mode
docker exec -i isus-api_php-fpm_1 php artisan down || true

# Pull the latest changes from the git repository
# git reset --hard
# git clean -df
git pull

# Run database migrations
docker exec -i isus-api_php-fpm_1 php artisan migrate --force

# Clear caches
docker exec -i isus-api_php-fpm_1 php artisan cache:clear

# Clear and cache config
docker exec -i isus-api_php-fpm_1 php artisan config:cache

# Clear and cache views
docker exec -i isus-api_php-fpm_1 php artisan view:cache

# Install/update composer dependecies
docker exec -i isus-api_php-fpm_1 composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Turn off maintenance mode
docker exec -i isus-api_php-fpm_1 php artisan up
