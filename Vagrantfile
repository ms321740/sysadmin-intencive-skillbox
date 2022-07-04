# -*- mode: ruby -*-
# vi: set ft=ruby :

# All Vagrant configuration is done below. The "2" in Vagrant.configure
# configures the configuration version (we support older styles for
# backwards compatibility). Please don't change it unless you know what
# you're doing.
Vagrant.configure("2") do |config|
  # The most common configuration options are documented and commented below.
  # For a complete reference, please see the online documentation at
  # https://docs.vagrantup.com.

  # Every Vagrant development environment requires a box. You can search for
  # boxes at https://vagrantcloud.com/search.
  config.vm.box = "ubuntu/focal64"

  # Disable automatic box update checking. If you disable this, then
  # boxes will only be checked for updates when the user runs
  # `vagrant box outdated`. This is not recommended.
  # config.vm.box_check_update = false

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine. In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  # NOTE: This will enable public access to the opened port
  # config.vm.network "forwarded_port", guest: 80, host: 8080

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine and only allow access
  # via 127.0.0.1 to disable public access
  config.vm.network "forwarded_port", guest: 80, host: 8080, host_ip: "127.0.0.1"
  config.vm.network "forwarded_port", guest: 81, host: 8081, host_ip: "127.0.0.1"
  config.vm.network "forwarded_port", guest: 82, host: 8082, host_ip: "127.0.0.1"

  # Create a private network, which allows host-only access to the machine
  # using a specific IP.
  # config.vm.network "private_network", ip: "192.168.33.10"

  # Create a public network, which generally matched to bridged network.
  # Bridged networks make the machine appear as another physical device on
  # your network.
  # config.vm.network "public_network"

  # Share an additional folder to the guest VM. The first argument is
  # the path on the host to the actual folder. The second argument is
  # the path on the guest to mount the folder. And the optional third
  # argument is a set of non-required options.
  # config.vm.synced_folder "./cfg", "/vagrant_cfg"

  # Provider-specific configuration so you can fine-tune various
  # backing providers for Vagrant. These expose provider-specific options.
  # Example for VirtualBox:
  #
  # config.vm.provider "virtualbox" do |vb|
  #   # Display the VirtualBox GUI when booting the machine
  #   vb.gui = true
  #
  #   # Customize the amount of memory on the VM:
  #   vb.memory = "1024"
  # end
  #
  # View the documentation for the provider you are using for more
  # information on available options.

  # Enable provisioning with a shell script. Additional provisioners such as
  # Ansible, Chef, Docker, Puppet and Salt are also available. Please see the
  # documentation for more information about their specific syntax and use.
  config.vm.provision "shell", inline: <<-SHELL
      cd 
      apt-get update
      apt-get install -y apache2 libapache2-mod-php php-curl php-gd php-mbstring php-xml php-xmlrpc php-soap php-intl php-zip php-mysql mysql-server php-mysql
      mysql < /vagrant/wp.sql
      mysql < /vagrant/drupal.sql
      cp /vagrant/wp.conf /etc/apache2/sites-available/
      ln -s /etc/apache2/sites-available/wp.conf /etc/apache2/sites-enabled/
      
      wget https://ru.wordpress.org/latest-ru_RU.tar.gz -O ./wp.tar.gz -q
      tar -xf ./wp.tar.gz -C /var/www
      mv /var/www/wordpress /var/www/wp
      rm ./wp.tar.gz
      cp  /vagrant/wp-config.php /var/www/wp/
      wget https://api.wordpress.org/secret-key/1.1/salt/ -q -O - >> /var/www/wp/wp-config.php

      cp /vagrant/drupal.conf /etc/apache2/sites-available/
      ln -s /etc/apache2/sites-available/drupal.conf /etc/apache2/sites-enabled/
      wget https://www.drupal.org/download-latest/tar.gz -O ./drupal.tar.gz -q
      tar -xf ./drupal.tar.gz -C /var/www
      mv /var/www/drupal-* /var/www/drupal
      cp /vagrant/drupal.settings.php /var/www/drupal/sites/default/default.settings.php
      php -r "echo 'return ' . bin2hex(openssl_random_pseudo_bytes(10)) . ';';" > /var/www/drupal/sites/default/hash_salt.php
      chown -R www-data:www-data /var/www/wp
      chown -R www-data:www-data /var/www/drupal
      service apache2 reload 
  SHELL
end
