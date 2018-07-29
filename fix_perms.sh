#!/bin/bash


chown -R www-data:www-data .
find -type d -exec chmod g+s {} \;
