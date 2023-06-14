<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About Project

A Simple application manage booking escape rooms.
this project follow the facade design pattern.

## Facade Design Pattern

The facade pattern (also spelled façade) is a software-design pattern commonly used in object-oriented programming.
Analogous to a facade in architecture, a facade is an object that serves as a front-facing interface masking more
complex underlying or structural code
You can read more at: [wikipedia](https://en.wikipedia.org/wiki/Facade_pattern)

## First Steps

- Run `https://github.com/magerishere/escape_room.git` For Pull project from GitHub in your system.
- Run `composer install` for install needed package.
- Run `cp .env.example .env` for create a copy of .env.example as `.env` project.
- Fill the database credentials at `.env` file.
- Run `php artisan key:generate` for generate `APP_KEY` value in your `.env` file.
- After creating your database in your mysql, Run `php artisan migrate --seed`
- Run `php artisan serve` to run project at: `http://127.0.0.1:8000`,Or you can use your own virtual host.
- Make sure `APP_URL` in your `.env` file has same value with your virtual host url.
- Because this project is full manage by Restful Api, for easy to use please
  install `Postman`: [download](https://www.postman.com/downloads/)
- I prepare for you
  my `postman collection`: [download](https://github.com/magerishere/escape_room/blob/master/public/escape_room.postman_collection)
- If you download my `postman collection`,make sure your `env` postman has two key: `base_api_url` and `token`,or you
  can move your own way.

## Run Testing Project

Almost funny part of each project, is TDD (Test-driven
development). [Read More](https://en.wikipedia.org/wiki/Test-driven_development).
<br>
if you want run test in this project follow these steps:

- Run `cp .env.example .env.testing` For creating env file for your test development.
- Fill the database credentials at `.env.testing` file. **Note**: database credentials testing must different with main
  database credentials
- Run `php artisan test` for running both Feature Test and Unit Test.

## License

this project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
