<?php
require_once dirname(__DIR__) . '/config/init.php';
require_once HELPERS . '/func.php';

//[1]
// присвоение по ссылке
$a = 5;
$b = &$a;
$a = 10;

var_dump($a, $b);
echo "<br>";


//[2]
// Передача переменой в функцию по ссылке
// ссылка на эту переменную может изменять значение аргумента

$x = 5;

function test( &$arg): void
{
    ++$arg;
    var_dump($arg);
}

test($x);
var_dump($x);
echo "<br>";


$arr = [1, 2, 3, 4];
dd($arr);

foreach ($arr as &$value) {
    $value *=2;
}
unset($value);

dd($arr);
echo "<br>";


foreach ($arr as $value) {
    echo $value;
}
dd($arr);
echo "<br>";






