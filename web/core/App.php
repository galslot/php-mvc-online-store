<?php

namespace core;

class App
{
    public static Container $container;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $query = trim(urldecode($_SERVER['REQUEST_URI']), '/');
        new ErrorHandler();

        self::$container = Container::getInstance();
        $this->getParams();

        session_start();

        Router::dispatch($query);
    }

    protected function getParams(): void
    {
        $params = require_once CONFIG . '/params.php';
        if(!empty($params)){
            foreach ($params as $key => $value) {
                self::$container->setProp($key, $value);
            }
        }
    }

}
