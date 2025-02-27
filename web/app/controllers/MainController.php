<?php

namespace app\controllers;

use app\controllers\AppBase\BaseController;
use app\models\MainModel;

/** @property MainModel $model */
class MainController extends BaseController
{

    public function indexAction(): void
    {

        $this->setMeta(
            i18n('main_index_meta_title'),
            i18n('main_index_meta_description'),
            i18n('main_index_meta_keywords')
        );

        $slides = $this->model->getSlides();
        $this->set(compact('slides'));

        $products = $this->model->getHit($this->getLang('id'), 6);

        $this->set(compact('slides', 'products'));
    }
}
