# social_monitization
Marlon's site

#Create a public/.htaccess entry
`RewriteEngine On`
`RewriteCond %{REQUEST_FILENAME} !-f`
`RewriteRule ^ index.php [QSA,L]`

# Enable mod_rewrite
`a2enmod rewrite`

#modify apache2/sites-available/ sites-name.conf file and add this between the <VirtualHost> directives
`    <Directory "/var/www/html/social_monitization/public">`
`        AllowOverride All`
`        Order allow,deny`
`        Allow from all`
`    </Directory>`