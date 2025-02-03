<?php

use core\App;

if(PHP_MAJOR_VERSION < 8){
    die("Необходима версия PHP >= 8");
}

require_once dirname(__DIR__) . '/config/init.php';


new App();

App::$container->setProp("test", "TEST");
var_dump(App::$container->getProps());

//throw new Exception('Возникла ошибочка', 404);

echo $test;

