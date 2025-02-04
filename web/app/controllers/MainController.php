<?php

namespace app\controllers;

use core\Controller;

use RedBeanPHP\R;

class MainController extends Controller
{

    //public string|false $layout = 'default';

    public function indexAction()
    {
        $this->setMeta('Главная страница', 'Description...', 'keywords...');

        $names = R::findAll("name");

        $this->set(compact('names'));

    }
}
