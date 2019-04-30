# README

## User management system

It requires admin user to be able to manage the users list.

## Available API Calls:

  > send `CONTENT_TYPE` with value `application/json` with each request for API JSON response, All actions require Logged in Admin

  * Users

    > GET `/api/users` List users from system

    > PUT `/api/users/{user}` Update user attributes.

    > GET `/api/users/{user}` Show user attributes.

    > POST `/api/users` Create a new user.

    > DELETE `/api/users/{user}` Destroy user.

  * Groups

    > GET `/api/groups` List groups from system

    > POST `/api/groups` Create a new group.

    > DELETE `/api/groups/{group}` Destroy group.


## Run Application

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

  > We have 33 tests, 120 assertions.

  > start the server on port 8000 `php artisan serve`

  > run test `php vendor/bin/phpunit`

## ToDo:

  > Using Middlewares to Restrict Access

  > Add caching (Action and Page caching)

  > Add pagination to users listing

  > Add API documentation tool

  > Add Authentication to the API

  > Use API versioning

  > Include more test coverage


## UMLs:

  > UsersSystem.png

  > UsersSystem-DB.png

