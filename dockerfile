FROM ubuntu

# Upgrading / Updating
RUN apt update -y
RUN apt upgrade -y

# Installing Dependencies (https://www.digitalocean.com/community/tutorials/how-to-install-lamp-stack-on-ubuntu)
RUN apt install apache2 -y
RUN apt install php libapache2-mod-php php-mysql -y

# Copying src to Apache Website Folder (in case of not using volumes)
#COPY . /var/www/webdev.com/

# (https://greenwebpage.com/community/how-to-setup-apache-virtual-hosts-on-ubuntu-22-04/, https://www.digitalocean.com/community/tutorials/how-to-install-lamp-stack-on-ubuntu, https://youtu.be/51nOk4xiIUA?si=FY6NdGq0eaEPZBUP, https://docs.rackspace.com/docs/set-up-apache-virtual-hosts-on-the-ubuntu-operating-system)
# Creating Virtual Host
RUN touch /etc/apache2/sites-available/webdev.com.conf
RUN echo \
"<VirtualHost *:80> \n\
    ServerAdmin admin@localhost\n\
    ServerName webdev.com\n\
    ServerAlias www.webdev.com\n \
    DirectoryIndex index.html\n\
    DocumentRoot /var/www/webdev.com\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>\n" > etc/apache2/sites-available/webdev.com.conf

# Enabling Virtual Host
RUN a2ensite webdev.com

# Running (https://stackoverflow.com/questions/49764989/cannot-start-apache-automatically-with-docker)
CMD ["apachectl", "-D", "FOREGROUND"]

# -------> Change hosts file to map DNS
# In linux, simply add a new line to /etc/hosts with 127.0.0.1 yourdomainname. (https://superuser.com/questions/597817/how-to-add-entry-to-local-dns-resolver)
# Access with http://yourdomainname

# mysql (Docker Image): (https://hub.docker.com/_/mysql)