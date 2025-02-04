<?php

namespace core;

use core\db\Db;

abstract class Model
{

    /**
     * авто заполнение модели данными
     * @var array
     */
    public array $attributes = [];

    public array $errors = [];

    public array $rules = [];

    public array $labels = [];

    public function __construct()
    {
       Db::getInstance();
    }

}