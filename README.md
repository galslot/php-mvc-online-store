# PHP MVC project - Online store.


** Pre-Requisites: **
    1. GIT
    2. Docker
    3. Docker-compose


** Installation Instructions: **
 1. git clone ssh://git@gitlab.sorq.org:2222/riga-devs-be/sorqpay.git
 2. cd sorqpay
 3. docker-compose build
 4. docker-compose up
 5. in a new tab: docker-compose exec php8 /bin/sh
 6. cd web
 7. composer install
 8. chmod -Rf 777 /var/www/html/web


** Import database Mysql **
 1. Start it up phpMyAdmin:
	http://localhost:9000
 2  user: root
    password - MYSQL_ROOT_PASSWORD: 123456
 3. Import the database from the project folder /app/data/db/newshop.sql.zip


** Launch the website **
 1. http://localhost


** Project parameters **
 1. Project parameters are stored in the folder:
	/config/
     - init.php
     - params.php





