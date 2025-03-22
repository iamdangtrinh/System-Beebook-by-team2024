# Laravel 10 store book

## Installation with composer
## required:
php 8.2
mysql 8.0

#### 1. Clone the project
```bash
git clone here
```
#### 2. Run `composer install`
Navigate into project folder using terminal and run
#### 3. Copy `.env.example` into `.env`
```bash
cp .env.example .env
```
#### 4. Run migrations

```bash
php artisan migrate
```

## -- run db seeder
php artisan db:seed TaxonomySeeder
php artisan db:seed CategoryProductSeeder
php artisan db:seed CouponSeeder
php artisan db:seed PostSeeder
php artisan db:seed ProductsSeeder
php artisan db:seed favoriteSeeder
php artisan db:seed AfterSeeder
php artisan db:seed Comments
php artisan db:seed BillsSeeder
php artisan db:seed PostProductSeeder

## Demo

## 
