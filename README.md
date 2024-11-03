# Smart Kikoba

## What is Smart Kikoba?

Smart Kikoba is a small project implemented to help my friend manage his Kikoba members and savings records.
It replaces his current paper work and this app digitizes all activities.

This repository holds source code for the backend and API writted using Codeignioter 4 framework.

## To deploy to your test local environment

1. Rename env file to `.env` and put it in the same directory
2. In the .env file:
   1. Uncomment CI_ENVIRONMENT and update value to be `development`,
   2. Uncomment app.baseURL and update value to `http://localhost/smart_kikoba/public'`,
   3. Uncomment database configuration and specify database settings like password and database name,
3. Tables for the database are available, just run the root folder in termina and run `php spark migrate`
4. Dont forget to run `composer install` for dependencies.

## Contributing

We welcome contributions from the community.

## Server Requirements

PHP version 8.1 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
