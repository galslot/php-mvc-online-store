<?php

namespace app\controllers;

use app\controllers\AppBase\BaseController;
use app\models\MainModel;
use RedBeanPHP\R;

/** @property MainModel $model */
class MainController extends BaseController
{

    public function indexAction(): void
    {
        $this->setMeta('Главная страница', 'Description...', 'keywords...');

        $slides = R::findAll('slider');
        $this->set(compact('slides'));

    }
}
