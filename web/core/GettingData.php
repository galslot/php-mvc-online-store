<?php

namespace core;

class GettingData
{

    /**
     * @param string $key Key of $_GET[]
     * @param string $type Values 'i', 'f', 's'
     * @return float|int|string
     */
    public static function get(string $key, string $type = "i"): float|int|string
    {
        $param = $key;
        $$param = $_GET[$param] ?? '';

        if($type == "i") {
            return (int)$$param;
        }elseif($type == "f") {
            return (float)$$param;
        }else{
            return trim($$param);
        }
    }

    /**
     * @param string $key Key of $_POST[]
     * @param string $type Values 's', 'i', 'f'
     * @return float|int|string
     */
    public static function post(string $key, string $type = "s"): float|int|string
    {
        $param = $key;
        $$param = $_POST[$param] ?? '';

        if($type == "i") {
            return (int)$$param;
        }elseif($type == "f") {
            return (float)$$param;
        }else{
            return trim($$param);
        }
    }

}