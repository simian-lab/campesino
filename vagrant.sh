# Point everything in the right direction
rm -rf /var/www/public
ln -fs /vagrant /var/www/public

cp /vagrant/stack/admin-virtualhost.conf /etc/apache2/sites-available/admin.conf