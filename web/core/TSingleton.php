<?php

    namespace core;

    trait TSingleton
    {
        private static ?self $instance = null;

        private function __construct(){}

        public static function getInstance(): static
        {
            if (!isset(static::$instance)) {
                static::$instance = new static();
            }

            return static::$instance;
        }
    }