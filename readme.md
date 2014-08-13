# Blog

This is a simple blog, with user accounts, admin controls and more to come. It is written in PHP under the Laravel framework.

## Installation

To properly install this application, first clone the repo. Then run **bower install** and **composer install**. Finally, to configure the database, enter your connection details into _app/config/database.php_ then run **php artisan migrate** to run the migrations. 

Optionally, you may run **php artisan db:seed** in order to seed the tables, however for this to function as expected you'll probably have to modify _app/database/seeds/DatabaseSeeder.php_

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT). This repo is also licensed under MIT.

## Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, and caching.

### Official Documentation

Documentation for the entire framework can be found on the [Laravel website](http://laravel.com/docs).

### Contributing To Laravel

All issues and pull requests should be filed on the [laravel/framework](http://github.com/laravel/framework) repository.
