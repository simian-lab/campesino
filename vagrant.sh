# Point everything in the right direction
rm -rf /var/www/public
ln -fs /vagrant /var/www/public

# Make sure log folder exists
mkdir /vagrant/logs

# Create a database
mysql --user=root --password=root < /vagrant/stack/eltiempo_co_cyber_lunes_live2.sql

# Create the Websites
cp /vagrant/stack/admin-virtualhost.conf /etc/apache2/sites-available/admin.conf
a2ensite admin

# Restart for good measure
service apache2 restart -y