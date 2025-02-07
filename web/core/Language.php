<?php

namespace core;

class Language
{
    public static array $langData = []; # фразы страниц
    public static array $langLayout = []; # фразы шаблона
    public static array $langView = []; # фразы View

    public static function load($langCode, $route): void
    {
        $l_Layout = APP. "/lang/{$langCode}.php";
        $l_View = APP. "/lang/{$langCode}/{$route['controller']}/{$route['action']}.php";

        if(file_exists($l_Layout)){
            self::$langLayout = require_once $l_Layout;
        }

        if(file_exists($l_View)){
            self::$langView = require_once $l_View;
        }

        self::$langData = array_merge(self::$langLayout, self::$langView);
    }

    public static function get($key)
    {
        return self::$langData[$key] ?? $key;
    }
}