<h1 align="center">Laravel Vue Admin Panel</h1>
<h3 align="center">A Single page Vue admin panel for Laravel projects.</h3>

## Built with
- [Laravel 9](https://github.com/laravel/framework)
- [spatie/laravel-permission](https://github.com/spatie/laravel-permission)
- [Laravel Breeze](https://github.com/laravel/breeze)
- [Vue 3](https://vuejs.org/)
- [Tailwind CSS](https://tailwindcss.com/)
- [Inertiajs](https://inertiajs.com/)
- [Admin One - Admin Dashboard](https://github.com/justboil/admin-one-vue-tailwind)

## Installation
- Create a new database
- Clone this repo 
- Create a new file in the root folder named `.env`
- Copy the contents of the `.env.sample` file into `.env` file
- Update the following info:
    - `APP_URL`
    - `VITE_APP_URL`
    - `DB_DATABASE`
    - `DB_USERNAME`
    - `DB_PASSWORD`
    - `OPEN_WEATHER_MAP_API_KEY`
- Run the following commands in the root folder:
    - `composer install`
    - `npm install`
    - `php artisan key:generate`
    - `php artisan migrate --seed --seeder=AdminCoreSeeder`
    - `php artisan vendor:publish --provider="BalajiDharma\LaravelAdminCore\AdminCoreServiceProvider"`
    - `php artisan vendor:publish --provider="BalajiDharma\LaravelMenu\MenuServiceProvider"`
    - `php artisan serve`
    - `npm run dev`
  - Now open your application in the browser

###### Super Admin Login
- Email - superadmin@example.com
- Password - password

#### Admin Configuration:

To change the Admin Prefix, change `prefix` on `config/admin.php` or add the `ADMIN_PREFIX` on env 

```php
'prefix' => env('ADMIN_PREFIX', 'admin'),
```

#### Run the Cron job
- Open your server's crontab configuration by running `crontab -e`
- Add the following line to schedule Laravel's task scheduler to run every ten minute:
```php
* * * * * cd /path-to-your-laravel-project && php artisan schedule:run >> /dev/null 2>&1
```
- Save the changes to the crontab configuration and exit the text editor.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
