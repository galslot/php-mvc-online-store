<?php

namespace core;

class Router
{
    protected static array $routes = []; # таблица маршрутов
    protected static array $route = [];  # конкретный маршрут

    public static function add($regexp, $route = []): void
    {
        self::$routes[$regexp] = $route;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }

    public static function getRoute(): array
    {
        return self::$route;
    }

    protected static function removeGetQueryStr($query): string
    {
        if(!$query){
            return '';
        }

        $params = explode('&', $query, 2);
        if(false === str_contains($params[0], '=')){
            return rtrim($params[0], '/');
        }

        return rtrim(strstr($params[0], '?', true), '/');
    }

    public static function dispatch($query): void
    {
        $query = self::removeGetQueryStr($query);

        if(!self::matchRoute($query)) {
            throw new \Exception("Маршрут не найден.", 404);
        }

        if(self::$route['admin_pref'] == 'admin'){
            $controller = 'app\\controllers\\admin\\'. self::$route['controller'].'Controller';
        }else{
            $controller = 'app\\controllers\\'. self::$route['controller'].'Controller';
        }

        if(!class_exists($controller)) {
            throw new \Exception("Контроллер {$controller} не найден.", 404);
        }

        /** @var Controller $controllerObject */
        $controllerObject = new $controller(self::$route);

        $controllerObject->getModel();

        $action = self::lowerNameCamelCase(self::$route['action']). 'Action';

        if(!method_exists($controllerObject, $action)) {
            throw new \Exception("Метод {$controller}::{$action}.  не найден.", 404);
        }

        $controllerObject->$action();
        $controllerObject->getView();
    }

    public static function matchRoute($query): bool
    {
        foreach (self::$routes as $regexp => $route) {

            if (preg_match("~{$regexp}~i", $query, $matches)) {

                foreach ($matches as $key => $value) {
                    if(is_string($key)) {
                        $route[$key] = $value;
                    }
                }

                if(empty($route['action'])) {
                    $route['action'] = 'index';
                }

                if(!isset($route['admin_pref'])) {
                    $route['admin_pref'] = '';
                }

                $route['controller'] = self::upNameCamelCase($route['controller']);
                self::$route = $route;

                return true;
            }
        }
        return false;
    }

    protected static function upNameCamelCase($name): string
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    protected static function lowerNameCamelCase($name): string
    {
        return lcfirst(self::upNameCamelCase($name));
    }

}
