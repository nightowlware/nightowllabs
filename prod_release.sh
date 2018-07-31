#!/bin/bash

set -e


if [[ -z $1 ]]
then
    echo "prod_release: merely pulling"
else
    echo "prod_release: checking out new branch"
    git checkout $1
fi


git pull

composer install
npm install
php artisan migrate


echo "--------"
echo "DONE"
echo "--------"
