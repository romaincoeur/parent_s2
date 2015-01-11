#!/bin/sh
php app/console doctrine:schema:update --force
yes y | php app/console doctrine:fixtures:load
php app/console assets:install
php app/console cache:clear --env=test
phpunit -c app
