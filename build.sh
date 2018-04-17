#!/bin/bash
#
# REQUIREMENT: All the operations in this script are idempotent. This means that the script
# can run multiple times with no ill effect. Pay particular attention to the "php artisan" 
# commands and make sure they meet this requirement.


# Put the application in "maintenance" mode.
php artisan down

# Make sure certain folders have the proper permissions
chmod -R a+rw ./bootstrap ./storage

# Initialize DB, if not done already.
php artisan migrate
php artisan db:seed

# Install composer and npm dependencies
composer install
npm install --production

# Put the application back in "production mode.
php artisan up