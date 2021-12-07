<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## SafeBoda Promotion Module 

The Application was built to generate promotion codes for user during rides. The promotion codes are set to be a percentage of the ride cost. The percentage is returned as a value in the api/promo endpoint. This is to be used for calculations with the value ride cost value. 

This module has not calculated ride cost, this was assumed to be outside the scope of the assignment but the structure can be modified to calculate the same.

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

## 


