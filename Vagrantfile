Vagrant.configure(2) do |config|
  config.vm.box = "scotch/box"
  config.vm.network 'private_network', ip: '192.168.100.116'
  config.vm.provision :shell, :path => 'vagrant.sh'
  config.vm.synced_folder ".", "/vagrant", nfs: true
end