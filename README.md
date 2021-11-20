 # CA
Graphical review representation.

## Requirements
- PHP >= 7.2
- symfony >= 5.3
- Vue >= 2.6

## Installation 
Symfony utilizes composer to manage its dependencies. So, before using symfony, make sure you have composer installed on your machine. To download all required packages run a following commands or you can download [Composer](https://getcomposer.org/doc/00-intro.md).
```
> composer install OR COMPOSER_MEMORY_LIMIT=-1 composer install
```

To get all required packages run this command.
```
> npm install
```

## Database
Make database change as per your in the .env file.
```
DATABASE_URL="mysql://db_user:db_password@host:port/db_name
```

Use following commands to create and run migration for your database.
- mkdir migrations (use if migrations folder not found or created)
- php bin/console doctrine:database:create
- php bin/console make:migration
- php bin/console doctrine:migrations:migrate 
- php bin/console doctrine:fixtures:load

## How to run 
For Backend
```
> symfony server:start 
OR
> php bin/console server:run
```
For Frontend
```
> npm run watch
```

## How to test
For Backend
```
> vendor/bin/phpunit
```
For Frontend
```
> npm test
```