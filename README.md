## Getting started

Install composer dependencies.

`composer install`

Move .env.example to .env.

`cp .env.example .env`

Generate app key.

`php artisan key:generate`

Create sqlite database.

`touch database/database.sqlite`

Adjust .env to reflect sqlite use. Set connection and remove all other fields.

`DB_CONNECTION=sqlite`

Boot up sail.

Run `./vendor/bin/sail up`

Migrate and (optionally) seed the database.

`./vendor/bin/sail artisan migrate --seed`

Bundle CSS & JavaScript.

`./vendor/bin/sail yarn && ./vendor/bin/sail yarn production`

## Deploying

For the smoothest experience it is recommended that you use a service like [Laravel Forge](https://forge.laravel.com/).

From the [Laravel Documentation](https://laravel.com/docs/8.x/deployment#deploying-with-forge-or-vapor):

> If you aren't quite ready to manage your own server configuration or aren't comfortable configuring all of the various services needed to run a robust Laravel application, Laravel Forge is a wonderful alternative.
>
> Laravel Forge can create servers on various infrastructure providers such as DigitalOcean, Linode, AWS, and more. In addition, Forge installs and manages all of the tools needed to build robust Laravel applications, such as Nginx, MySQL, Redis, Memcached, Beanstalk, and more.

If you wish to set it up yourself, then you can use the nginx configuration found in the [Laravel Documentation](https://laravel.com/docs/8.x/deployment#nginx).