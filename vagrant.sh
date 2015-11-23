# Point everything in the right direction
rm -rf /var/www/public
ln -fs /vagrant /var/www/public

# Make sure log folder exists
mkdir /vagrant/logs
mkdir /vagrant/logs/admin
mkdir /vagrant/logs/preevento
mkdir /vagrant/logs/evento

# Create some dirs for the app
mkdir /vagrant/admin/multimedia/articulos
mkdir /vagrant/admin/multimedia/aliados

# Create a database
mysql --user=root --password=root < /vagrant/stack/eltiempo_co_cyber_lunes_live2.sql

# Create the Websites
cp /vagrant/stack/admin-virtualhost.conf /etc/apache2/sites-available/admin.conf
a2ensite admin

cp /vagrant/stack/preevento-virtualhost.conf /etc/apache2/sites-available/preevento.conf
a2ensite preevento

cp /vagrant/stack/bfr-virtualhost.conf /etc/apache2/sites-available/bfr.conf
a2ensite bfr

cp /vagrant/stack/cyl-virtualhost.conf /etc/apache2/sites-available/cyl.conf
a2ensite cyl

cp /vagrant/stack/cys-virtualhost.conf /etc/apache2/sites-available/cys.conf
a2ensite cys

# Restart for good measure
service apache2 restart -y