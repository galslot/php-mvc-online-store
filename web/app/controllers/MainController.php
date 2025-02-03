<?php

    namespace app\controllers;

    class MainController
    {
        public function __construct(array $route = [])
        {

        }

        public function indexAction()
        {
            echo __METHOD__;
        }
    }