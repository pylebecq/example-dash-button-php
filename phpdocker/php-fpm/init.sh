#!/bin/sh

set -e

zenaton start
zenaton listen --laravel

/usr/bin/php-fpm
