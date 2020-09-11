# Turn on maintenance mode
docker exec -i isusapi_php-fpm_1 php artisan down || true

# Pull the latest changes from the git repository
# git reset --hard
# git clean -df
git pull

# Install/update composer dependecies
docker exec -i isusapi_php-fpm_1 composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Run database migrations
docker exec -i isusapi_php-fpm_1 php artisan migrate --force

# Clear caches
docker exec -i isusapi_php-fpm_1 php artisan cache:clear

# Clear and cache config
docker exec -i isusapi_php-fpm_1 php artisan config:cache

# Clear and cache views
docker exec -i isusapi_php-fpm_1 php artisan view:cache

# Turn off maintenance mode
docker exec -i isusapi_php-fpm_1 php artisan up