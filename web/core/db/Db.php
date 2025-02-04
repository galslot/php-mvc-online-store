<?php

namespace core\db;

use RedBeanPHP\R;
use core\TSingleton;

class Db
{
    use TSingleton;

    private function __construct()
    {
        $db = require_once CONFIG. "/config_db.php";

        R::setup( $db['dsn'], $db['username'], $db['password'], );
        if(!R::testConnection()){
            throw new \Exception("Connection failed to db", 500);
        }

        // замораживаем модификации
        R::freeze(true);

        if(DEBUG){
            // включает отладку (рекомендуемый способ)
            R::fancyDebug( TRUE );
        }

    }
}
