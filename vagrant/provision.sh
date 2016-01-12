#!/usr/bin/env bash
# DEBIAN_FRONTEND=noninteractive

apt-get update
timedatectl set-timezone Europe/Moscow
apt-get install -yqq git mc;

##
# MySql
##
apt-get install -yqq mysql5-server

echo 'create database test' | mysql -uroot -proot
echo "use mysql; update user set host='%' where user='root' and host='127.0.0.1';flush privileges;" | mysql -uroot -proot
##
# доступ к базе для всех по паролю
##

#echo "host all  all    0.0.0.0/0  md5" >> /etc/postgresql/9.4/main/pg_hba.conf
#sed -i "s/^listen_addresses='\*'//" /etc/postgresql/9.4/main/postgresql.conf
#echo "listen_addresses='*'" >> /etc/postgresql/9.4/main/postgresql.conf
#service postgresql restart;


echo Installing PHP...

apt-get install -yqq php5-cli php5-fpm php5-curl php5-pgsql php5-mcrypt php5-intl libxrender1 libfontconfig1 php5-mysql php5-gd
cp /vagrant/vagrant/config/php.ini /etc/php5/fpm/conf.d/
cp /vagrant/vagrant/config/php.ini /etc/php5/cli/conf.d/



echo Installing Nginx...

apt-get install -yqq nginx
cp /vagrant/vagrant/config/nginx.conf /etc/nginx/sites-enabled/
service nginx restart


echo Installing Composer...

curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

#su vagrant -l /vagrant/vagrant/project.sh