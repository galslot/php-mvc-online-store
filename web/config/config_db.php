<?php

$dsn = "mysql:host=". DB_HOST. ";dbname=". DB_NAME. ";charset=utf8mb4";

return [
    'dsn' => $dsn,
    'username' => DB_USER,
    'password' => DB_PASS,
];
