# WSG-Thesis-Project

Site located at: https://mytravelrental.com/

To commit changes SSH to VM and run: sudo git pull https://github.com/LidyaNuramo/WSG-Thesis-Project.git

To set up:
cd /opt/bitnami/apache2/htdocs 
sudo git init 
sudo git config --global --add safe.directory *
sudo git add . 
sudo git config --global user.email "lidyagnuramom@gmail.com" 
sudo git config --global user.name "LidyaNuramo" 
sudo git commit -m "initial commit" 
sudo git remote add origin https://github.com/LidyaNuramo/WSG-Thesis-Project.git
sudo git pull https://github.com/LidyaNuramo/WSG-Thesis-Project.git

To update:
cd /opt/bitnami/apache2/htdocs 
sudo git pull https://github.com/LidyaNuramo/WSG-Thesis-Project.git -allow-unrelated-histories 

Conflict:
sudo git pull https://github.com/LidyaNuramo/WSG-Thesis-Project.git --allow-unrelated-histories 

Allow Read+Write+Execute to directory:
sudo chmod -R a+rwx /opt/bitnami/apache2/htdocs

Start-up script
#!/bin/bash
cd /opt/bitnami/apache2/htdocs 
sudo chmod -R a+rwx /opt/bitnami/apache2/htdocs
rm index.html -f
git init 
git config --global user.email "lidyagnuramom@gmail.com" 
git config --global user.name "LidyaNuramo" 
git config --global --add safe.directory *
git add . 
git pull https://github.com/LidyaNuramo/WSG-Thesis-Project.git --commit --allow-unrelated-histories 
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
composer require google/cloud-storage


Start-up script
#! /bin/bash
sudo apt-get update
sudo apt-get install apache2 -y
sudo a2ensite default-ssl
sudo a2enmod ssl
sudo systemctl restart apache2
sudo apt-get install php libapache2-mod-php php php-cli php-fpm php-json -y
sudo apt-get install php php-common php-mysql -y
sudo apt-get install php libapache2-mod-php php php-cli php-fpm php-json -y
sudo apt-get install php-zip php-gd php-mbstring -y
sudo apt-get install php-curl php-xml php-bcmath -y
sudo apt-get install git -y
cd /
sudo chmod -R a+rwx /var/www/html/
cd /var/www/html/ 
sudo chmod -R a+rwx /var/www/html/
rm index.html -f
sudo git init || true
sudo git config --global user.email "lidyagnuramom@gmail.com" || true
sudo git config --global user.name "LidyaNuramo" || true
sudo git config --global --add safe.directory * || true
sudo git add . || true
sudo git pull https://github.com/LidyaNuramo/WSG-Thesis-Project.git --commit --quiet || true
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" || true
php composer-setup.php  || true
php -r "unlink('composer-setup.php');" || true
export COMPOSER_HOME="/var/www/html/composer" || true
composer require google/cloud-storage || true

#!/bin/bash
sudo apt-get update
sudo apt-get --assume-yes install apache2 php libapache2-mod-php
sudo apt --assume-yes install php php-cli php-fpm php-json php-common php-mysql php-zip php-gd php-mbstring php-curl php-xml \ 
php-bcmath
sudo apt-get --assume-yes install git
sudo a2ensite default-ssl
sudo systemctl reload apache2
sudo a2enmod ssl
sudo systemctl restart apache2
systemctl reload apache2
cd /
cd /var/www/html/ 
sudo chmod -R a+rwx /var/www/html/
rm index.html -f
git init 
git config --global user.email "lidyagnuramom@gmail.com" 
git config --global user.name "LidyaNuramo" 
git config --global --add safe.directory *
git add . 
git pull https://github.com/LidyaNuramo/WSG-Thesis-Project.git --commit --quiet 
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php  || true
php -r "unlink('composer-setup.php');"
composer require google/cloud-storage