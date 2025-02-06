<?php

function dd($data, $exit = false): void
{
    echo '<pre>'. print_r($data, true) .'</pre>';
    if($exit) die();
}

function br(): void
{
    echo '<br />';
}

function hsc($str): string
{
    return htmlspecialchars($str);
}

function baseUrl(): string
{
    $lang = core\App::$container->getProp('lang');

    if(empty($lang)) {
        return HOME_PAGE. "/";
    }

    return HOME_PAGE. "/". $lang. "/";
}


