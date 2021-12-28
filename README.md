# Arcacare Api App

[![Build Status](https://img.shields.io/travis/gothinkster/laravel-realworld-example-app/master.svg)](https://travis-ci.org/gothinkster/laravel-realworld-example-app) [![Gitter](https://img.shields.io/gitter/room/realworld-dev/laravel.svg)](https://gitter.im/realworld-dev/laravel) [![GitHub stars](https://img.shields.io/github/stars/gothinkster/laravel-realworld-example-app.svg)](https://github.com/gothinkster/laravel-realworld-example-app/stargazers) [![GitHub license](https://img.shields.io/github/license/gothinkster/laravel-realworld-example-app.svg)](https://raw.githubusercontent.com/gothinkster/laravel-realworld-example-app/master/LICENSE)

----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://lumen.laravel.com/docs/8.x/installation)

Alternative installation is possible without local dependencies relying on [Docker](#docker). 

Clone the repository

    git clone git@bitbucket.org:arcadev/arcacare-api.git

Switch to the repo folder

    cd arcacare-api

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Generate a new API authentication token key

    php artisan jwt:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php -S localhost:800 -t public 

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone git@bitbucket.org:arcadev/arcacare-api.git
    cd arcacare-api
    composer install
    cp .env.example .env
    php artisan key:generate
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php -S localhost:8000 -t public 


## Docker

To install with [Docker](https://www.docker.com), run following commands:

```
git clone git@bitbucket.org:arcadev/arcacare-api.git
cd arcacare-api
cp .env.example.docker .env
docker run -v $(pwd):/app composer install
cd ./docker
docker-compose up -d
docker-compose exec php php artisan key:generate
docker-compose exec php php artisan migrate
docker-compose exec php php -S localhost:8000 -t public
```

The api can be accessed at [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation).    

 
# Swagger Lume Documentaion setup with Authentication
 
Install all the Swagger Lume dependencies using composer

       composer require "darkaonline/swagger-lume:8.*"

Open your bootstrap/app.php file and:
uncomment this line (around line 26) in Create The Application section:
   
     $app->withFacades();


add this line before Register Container Bindings section:

     $app->configure('swagger-lume');

add this line in Register Service Providers section:

    $app->register(\SwaggerLume\ServiceProvider::class);

Run php artisan swagger-lume:publish-config to publish configs (config/swagger-lume.php)
Make configuration changes if needed
Run php artisan swagger-lume:publish to publish everything    


## Authentication

add this in security section in config/swagger-lume.php:

      'bearer_token' => [ // Unique name of security
            'type' => 'apiKey', // Valid values are "basic", "apiKey" or "oauth2".
            'description' => 'Enter token in format (Bearer <token>)',
            'name' => 'Authorization', // The name of the header or query parameter to be used.
            'in' => 'header', // The location of the API key. Valid values are "query" or "header".
         ],

 you can follow this guid for authentication
 
   https://lumen.laravel.com/docs/8.x/authentication

----------    


# Code overview

## Dependencies

- [api_token](https://lumen.laravel.com/docs/8.x/authentication) - For authentication using JSON Web Tokens

## Folders

- `app` - Contains all the Eloquent models
- `app/Http/Controllers/Api` - Contains all the api controllers
- `app/Http/Middleware` - Contains the api auth middleware
- `config` - Contains all the application configuration files
- `database/factories` - Contains the model factory for all the models
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `routes` - Contains all the api routes defined in web.php file
- `tests` - Contains all the application tests
- `tests/Feature/Api` - Contains all the api tests

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Testing API

Run the laravel development server

    php -S localhost:8000 -t public 

The api can now be accessed at

    http://localhost:8000/api/documentation

Request headers

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| Yes      	| Content-Type     	| application/json 	|
| Optional 	| Authorization    	| Token {api_token}      	|

Refer the [api specification](#api-specification) for more info.

----------