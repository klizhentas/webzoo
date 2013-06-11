from ubuntu:12.10
ENV DEBIAN_FRONTEND noninteractive
run apt-get update
run apt-get install -q -y build-essential
run apt-get install -q -y ruby-full
run apt-get install -q -y wget
run locale-gen en_US.UTF-8
run update-locale LANG=en_US.UTF-8
run wget http://production.cf.rubygems.org/rubygems/rubygems-2.0.3.tgz --output-document=/tmp/rubygems.tgz
run tar -C /tmp -xzf /tmp/rubygems.tgz
ENV LC_ALL en_US.UTF-8
ENV LANG en_US.UTF-8
run cd /tmp/rubygems-2.0.3 && ruby setup.rb
run gem update --system
run gem install thin
run gem install sinatra
add ./src /mnt
expose 4567
cmd ["ruby", "/mnt/hello.rb"]
