<?php

namespace app\controllers;

use app\controllers\AppBase\BaseController;
use app\models\MainModel;
use core\App;

/** @property MainModel $model */
class MainController extends BaseController
{

    public function indexAction(): void
    {
        $this->setMeta('Главная страница', 'internet shop of digital technology', 'internet shop, digital, electronics');

        $slides = $this->model->getSlides();
        $this->set(compact('slides'));

        $products = $this->model->getHit($this->getLang('id'), 3);

        $this->set(compact('slides', 'products'));
    }
}
