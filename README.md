# Drivvn Backend Task

This has been using Laravel

## Minimum Requirements
* ✅ The API should allow the adding, deleting and listing of cars
* ✅ The age of each car submitted can not be older than four years
* ✅ There should be four initial colour options - red, blue, white and black
* ✅ The API should respond with appropriate HTTP response codes and messages
* ✅ The API should accept and return valid JSON
* ✅ A suite of suitable tests should be created for these requirements

## Optional Requirements
* ✅ Endpoints to add, update, delete and list additional colours
* ✅ A short description of how extra data models could improve the design
    * Adding a 'make' model (eg Audi), used by both car and color models/tables
    * Adding an 'options' model - linking to a specific car, which could include things like engine/wheel size (things that are needed, but can be customisied per car)
* ✅ A short description on how best the API could be documented
    * Install/adding something like https://swagger.io to generate documentation

## Prerequisites
* Composer
* PHP

## Local Setup
* Clone repo
* `cd` into folder
* run `php artisan serve`
* run `php artisan migrate`

## Endpoints
### Cars
```
POST /cars
GET /cars/<id>
DELETE /cars/<id>
GET /cars
PUT /cars/<id>
```

### Colors
```
POST /colors
GET /colors/<id>
GET /colors
```

## Running Tests
* run `php artisan test`