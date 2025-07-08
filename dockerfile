FROM ubuntu

# Upgrading / Updating
RUN apt update -y
RUN apt upgrade -y

# Installing Dependencies (https://www.digitalocean.com/community/tutorials/how-to-install-lamp-stack-on-ubuntu)
RUN apt install apache2 -y
RUN apt install php libapache2-mod-php php-mysql -y

# Copying src to Apache Website Folder (in case of not using volumes)
#COPY . /var/www/ink.io/

# (https://greenwebpage.com/community/how-to-setup-apache-virtual-hosts-on-ubuntu-22-04/, https://www.digitalocean.com/community/tutorials/how-to-install-lamp-stack-on-ubuntu, https://youtu.be/51nOk4xiIUA?si=FY6NdGq0eaEPZBUP, https://docs.rackspace.com/docs/set-up-apache-virtual-hosts-on-the-ubuntu-operating-system)
# Creating Virtual Host
RUN touch /etc/apache2/sites-available/ink.io.conf
RUN echo \
"<VirtualHost *:80> \n\
    ServerAdmin admin@localhost\n\
    ServerName ink.io\n\
    ServerAlias www.ink.io\n \
    DirectoryIndex gallery.php\n\
    DocumentRoot /var/www/ink.io/src/public\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>\n" > etc/apache2/sites-available/ink.io.conf

# Enabling Virtual Host
RUN a2ensite ink.io

# Adding permissions (https://stackoverflow.com/questions/8103860/move-uploaded-file-gives-failed-to-open-stream-permission-denied-error)
RUN chown www-data /var/www/
RUN chown www-data /tmp/

RUN chmod 755 /var/www
RUN chmod 755 /tmp/

# Installing composer (https://getcomposer.org/download/ | https://stackoverflow.com/questions/41274829/php-error-the-zip-extension-and-unzip-command-are-both-missing-skipping | https://stackoverflow.com/questions/20632258/change-directory-command-in-docker)
WORKDIR /var/www/ink.io/
RUN apt-get install php-zip -y
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

# Installing Project Dependencies (https://getcomposer.org/doc/01-basic-usage.md)
COPY composer.json composer.json
COPY composer.lock composer.lock
RUN php composer.phar install

# Running (https://stackoverflow.com/questions/49764989/cannot-start-apache-automatically-with-docker)
CMD ["apachectl", "-D", "FOREGROUND"]

# -------> Change hosts file to map DNS
# In linux, simply add a new line to /etc/hosts with 127.0.0.1 yourdomainname. (https://superuser.com/questions/597817/how-to-add-entry-to-local-dns-resolver)
# Access with http://yourdomainname

# mysql (Docker Image): (https://hub.docker.com/_/mysql)
# https://docs.docker.com/guides/databases/