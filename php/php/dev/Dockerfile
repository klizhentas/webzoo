from ubuntu:12.10
ENV DEBIAN_FRONTEND noninteractive
run apt-get update
run apt-get install -q -y apache2
run apt-get install -q -y libapache2-mod-php5
run apt-get install -q -y php5
expose 80
run service apache2 restart
