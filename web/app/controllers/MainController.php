<?php

namespace app\controllers;

use app\models\MainModel;
use core\Controller;
use RedBeanPHP\R;

/** @property MainModel $model */
class MainController extends Controller
{

    //public string|false $layout = 'default';

    public function indexAction(): void
    {
        $this->setMeta('Главная страница', 'Description...', 'keywords...');

        $names = $this->model->getNames();

        $oneName = R::getRow('SELECT * FROM name WHERE id = 2');

        $this->set(compact('names'));

    }
}
