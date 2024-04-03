# List of commands and configurations used for deployment

- lamp.sh contents
```bash
#!/bin/bash
set -e

# update apt
sudo apt update

# install apache2
sudo apt install apache2 -y

# install php
# add the ondrej/php repository - needed to install PHP ^8.0
sudo add-apt-repository ppa:ondrej/php -y

# update apt - since we added a new repository
sudo apt update

# install PHP 8.3
sudo apt install php8.3 \
    libapache2-mod-php8.3 \
    php8.3-mysql \
    php8.3-curl \
    php8.3-imagick \
    php8.3-intl \
    php8.3-mbstring \
    php8.3-xml \
    php8.3-zip \
	composer -y

# install mysql
sudo apt install mysql-server -y

# run mysql secure installation
sudo mysql_secure_installation

# Prompt for MYSQL root password
echo "Enter a password for MySQL root user:"
read -s MYSQL_ROOT_PASS

# Set mysql root password
sudo mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED WITH caching_sha2_password BY '$MYSQL_ROOT_PASS';"

# Restart Apache web server
sudo systemctl restart apache2

# Install Certbot
sudo apt install certbot python3-certbot-apache -y

# enable mod_ssl
sudo a2enmod ssl

# enable mod_rewrite
sudo a2enmod rewrite

# Restart Apache web server
sudo systemctl restart apache2
```

- To run the script, use the following command:
```bash
bash lamp.sh
```

- Other commands used

```bash
# change ownership of html directory - ubuntu is default user, www-data is apache user
sudo chown -R ubuntu:ubuntu /var/www/html

# generate key
ssh-keygen -C "ryan.mclaren@nscc.ca"

# print contents of public key
cat ~/.ssh/id_rsa.pub

# clone a repo
git clone {repository_url} .

# download wordpress files
wget https://wordpress.org/latest.tar.gz

# extract files
tar -xvf latest.tar.gz

# move files to html directory
sudo mv wordpress/* .

# move theme to themes directory
sudo mv wordpress/wp-content/themes/twentytwentyfour ./wp-content/themes/

# remove wordpress directory and tar file
sudo rm -rf wordpress latest.tar.gz

# generate self signed cert
sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/selfsigned.key -out /etc/ssl/certs/selfsigned.crt

# connect to mysql
sudo mysql -u root -p

# create database
CREATE DATABASE {db_name};

# import database
mysql -u root -p [database_name] < [database_name].sql

# test apache config
sudo apachectl configtest

# reload apache
sudo systemctl reload apache2

# install wp-cli - do this in /var/www/html
sudo curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar

# how to update urls
php8.3 wp-cli.phar search-replace [OLD_URL] [NEW_URL] --all-tables
```

# WordPress constants
- two constants needed in the wp-config.php file to tell WordPress what domain to use

```php
define('WP_HOME','https://nstech.com');
define('WP_SITEURL','https://nstech.com');
```

# Apache vhost config
- here is a sample of what the vhost config file should look like
  
```apache
<VirtualHost *:80>
    ServerName nstech.com
    ServerAlias www.nstech.com

    DocumentRoot /var/www/html

    # this allows .htaccess files to work
    <Directory /var/www/html>
        Options FollowSymLinks
        AllowOverride Limit Options FileInfo
        DirectoryIndex index.php
        Require all granted
    </Directory>
</VirtualHost>

<VirtualHost *:443>
    ServerName nstech.com
    ServerAlias www.nstech.com
    
    DocumentRoot /var/www/html

    # this allows .htaccess files to work
    <Directory /var/www/html>
        Options FollowSymLinks
        AllowOverride Limit Options FileInfo
        DirectoryIndex index.php
        Require all granted
    </Directory>

    SSLEngine on
    SSLCertificateFile /etc/ssl/certs/selfsigned.crt
    SSLCertificateKeyFile /etc/ssl/private/selfsigned.key
</VirtualHost>
```

# .htaccess
- htaccess needs to contain the following, customized to match the domain name

```apache
<IfModule mod_rewrite.c>
# redirect http to https
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# rewrite www to non-www
RewriteCond %{HTTP_POST} ^www.nstech.com
RewriteRule ^(.*)$ https://nstech.com/$1 [L,R=301]
</IfModule>
```