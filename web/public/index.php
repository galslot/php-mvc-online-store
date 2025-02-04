<?php

use core\App;

if(PHP_MAJOR_VERSION < 8){
    die("Необходима версия PHP >= 8");
}

require_once dirname(__DIR__) . '/config/init.php';
require_once HELPERS . '/func.php';
require_once CONFIG . '/routes.php';

new App();
App::$container->setProp("test", "TEST");


//throw new Exception('Возникла ошибочка', 404);



