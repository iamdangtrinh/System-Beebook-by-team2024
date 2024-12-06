#!/bin/bash
php artisan db:seed --class=ProductsSeeder
if [ $? -ne 0 ]; then
    echo "$(date): Seeding failed" >> /var/log/seeder.log
else
    echo "$(date): Seeding completed successfully" >> /var/log/seeder.log
fi
