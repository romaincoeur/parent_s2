#!/bin/bash

# this bash script install app on a Debian server as a #
# first installation with LAMP

# parameters
read -p "username: " username
read -p "root password: " rootpwd

cd /var/www

# Install libraries
yes | apt-get install git
yes | apt-get install php5-common libapache2-mod-php5 php5-cli php5-curl php5-mysql php5-gd
yes | apt-get install curl
yes | apt-get install mysql-server mysql-client libmysqlclient15-dev mysql-common
curl -sS https://getcomposer.org/installer | php

# Create database
mysql -u root -pazerty1234 -e "CREATE DATABASE parent_test"

# get and configure App
git clone https://github.com/romaincoeur/parent_s2.git
cd vistagram_plateform_sf2
file="app/config/parameters.yml"
echo "    parameters:                   " > $file
echo "    database_driver: pdo_mysql    " >> $file
echo "    database_host: 127.0.0.1      " >> $file
echo "    database_port: null           " >> $file
echo "    database_name: parent_test    " >> $file
echo "    database_user: root           " >> $file
echo "    database_password: azerty1234 " >> $file
echo "    mailer_transport: smtp        " >> $file
echo "    mailer_host: 127.0.0.1        " >> $file
echo "    mailer_user: null             " >> $file
echo "    mailer_password: null         " >> $file
echo "    locale: fr" >> $file
echo "    secret: ThisT23okenIsNoqmlpos2dtSoSecr56etChang32eIt" >> $file
../composer.phar update -n
chmod 777 -R app/cache app/logs
php app/console doctrine:schema:update --force
yes y | php app/console doctrine:fixtures:load
php app/console cache:clear --env=test
phpunit -c app

