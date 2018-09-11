# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "ncaro/php7-debian8-apache-nginx-mysql"
  config.vm.network :private_network, ip: '192.168.2.20'
  config.vm.synced_folder "src", "/var/www"
end
