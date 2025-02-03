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