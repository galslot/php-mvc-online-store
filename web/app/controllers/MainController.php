<?php

namespace app\controllers;

use core\Controller;

class MainController extends Controller
{

    //public string|false $layout = 'default';

    public function indexAction()
    {
        $this->setMeta('Главная страница', 'Description...', 'keywords...');

        $names = ['Name1', 'Name2', 'Name3', 'Name4'];
        $this->set(compact('names'));

    }
}
