#!/bin/bash
set -eux
cd ~/todo_app
php artisan migrate --force
php artisan config:cache

