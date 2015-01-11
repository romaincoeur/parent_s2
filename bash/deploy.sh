#!/bin/bash
git fetch --all
git reset --hard origin/master
../composer.phar self-update
../composer.phar update
php app/console doctrine:schema:drop --force
php app/console doctrine:schema:update --force
yes y | php app/console doctrine:fixtures:load
php app/console cache:clear --env=prod
chmod 705 -R app/cache
chmod 705 -R app/logs
php app/console cache:clear --env=test
phpunit -c app
