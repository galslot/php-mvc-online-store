# PHP MVC project - Online store.


** Pre-Requisites: **
 1. GIT
 2. Docker
 3. Docker-compose


** Installation Instructions: **
 1. git clone https://github.com/galslot/php-mvc-online-store.git
 2. cd php-mvc-online-store
 3. docker-compose build
 4. docker-compose up
 5. in a new tab: docker-compose exec php8 /bin/sh
 6. cd web
 7. composer install
 8. chmod -Rf 777 /var/www/html/web


** Import database Mysql **
 1. Start it up phpMyAdmin: http://localhost:9000
 2. user: root
 3. password - MYSQL_ROOT_PASSWORD: 123456
 4. Import the database from the project folder /app/data/db/newshop.sql.zip


** Launch the website **
 1. http://localhost


** Project parameters **
 1. Project parameters are stored in the folder:
	/config/
     - init.php
     - params.php





