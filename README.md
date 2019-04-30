# README

## User management system

It requires admin user to be able to manage the users list.

## Available API Call:

  > send `CONTENT_TYPE` with value `application/json` with each request for API JSON response.

  > GET `/api/users` List users from system, it requires Logged in Admin

  > PUT `/api/users/{user}` Update user attributes.

  > GET `/api/users/{user}` Show user attributes.

  > POST `/api/users` Create a new user.

  > DELETE `/api/users/{user}` Destroy user.


## Rus Application

  > cd project folder

  > start the server on port 8000 `php artisan serve`


## Seed data :

  > cd project folder

  > run `php artisan db:seed`


## Project Details:

* Environment

  > PHP laravel with API support Project

  > PHP 7.1.23

  > Laravel 5.8

  > MySql database


* Configuration

  > cd project folder

  > update config file `.env`

  > rubn `composer install`

* Database config

  > create the database

  > cd project folder

  > run `php artisan migrate`

  > run `php artisan db:seed`

## Tests

  > start the server on port 8000 `php artisan serve`

  > run test `php vendor/bin/phpunit`
