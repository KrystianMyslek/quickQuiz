# Laravel + Vue

For developing  
composer run setup  
php artisan db:seed  
php artisan storage:link  
composer run dev

for production  
git pull  
composer install --optimize-autoloader --no-dev  
php artisan migrate --force  
php artisan optimize  
npm install  
npm run build

If no npm on server just do it localy and send public/build manually
