<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## SafeBoda Promotion Module 

The Application was built to generate promotion codes for user during rides. The promotion codes are set to be a percentage of the ride cost. The percentage is returned as a value in the api/promo endpoint. This is to be used for calculations with the value ride cost value. 

This module has not calculated ride cost, this was assumed to be outside the scope of the assignment but the structure can be modified to calculate the same.

## Installation

To install the node dependancies run 
```
npm run install
```
then run 

```
composer install
```


You will need to set up the .env file, this can be done by copying the .env.example file and editing the variables based on your set up

You will need to add two additional fields for the application to function as expected.
```
JWT_SECRET=puSxYea6Glx4ZuJnnfe3Mii9DHhyr871B5b43lPJ4bQDf9tOlJLPijJreA58SPPd
GOOGLE_API=
```

The Google API can be acquired by following the instructions shared at https://developers.google.com/maps/documentation/directions/overview

## Endpoints 

1. api/auth/login
2. api/promocode/all
3. api/promocode/active
4. api/promo
5. api/promocode/deactivate
6. api/promolocation/delete

A postman collection and env has been added for purposes of testing the api

## Code Generation

Using a schedule command, promo codes are generated periodically. This can be triggered by running

```
php artisan  promocode:generate
```
For the specifc command or 

```
php artisan schedule:run
```
to run all schedules commands in the system.

## Testing 

Set up the testing env by running 

```
php artisan migrate --seed --env=testing
```
then 

```
php artisan test
```

