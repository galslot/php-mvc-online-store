<?php

namespace app\controllers;

use app\models\MainModel;
use core\Controller;

/** @property MainModel $model */
class MainController extends Controller
{

    //public string|false $layout = 'default';

    public function indexAction(): void
    {
        $this->setMeta('Главная страница', 'Description...', 'keywords...');

        $names = $this->model->getNames();

        $this->set(compact('names'));

    }
}
