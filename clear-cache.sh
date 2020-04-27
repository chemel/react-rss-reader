#!/bin/bash

php bin/console cache:clear

chown -R www-data:www-data var
find var -type d -exec chmod 777 {} \;
find var -type f -exec chmod 666 {} \;
