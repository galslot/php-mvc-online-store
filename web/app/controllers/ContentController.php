<?php

namespace app\controllers;

use app\controllers\AppBase\BaseController;
use app\models\ContentModel;
use core\App;

/** @property ContentModel $model*/
class ContentController extends BaseController
{
    public function viewAction(): void
    {
        $language = App::$container->getProp('language');
        $slug = $this->route['slug'];

        $content = $this->model->getContent($slug, $language['id']);

        if(!$content){
            $this->errorView();
            return;
        }

        $this->setMeta($content['title'], $content['description'], $content['keywords']);
        $this->set(compact('content'));
    }
}
