from ubuntu:12.10

ENV DEBIAN_FRONTEND noninteractive
run apt-get update
run apt-get install -q -y apache2
run apt-get install -q -y libapache2-mod-php5
run apt-get install -q -y php5

add ./src /var/www/
add ./conf.d /etc/apache2/conf.d/
expose 80
run service apache2 stop
run echo localhost > /etc/hostname

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log
cmd ["/usr/sbin/apache2", "-D", "FOREGROUND"]
