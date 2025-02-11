<?php

namespace app\controllers;

use app\controllers\AppBase\BaseController;
use app\models\ProductModel;
use core\App;

/** @property ProductModel $model  */

class ProductController extends BaseController
{
    public function itemAction(): void
    {
        $language = App::$container->getProp('language');
        $slug = $this->route['slug'];

        $product = $this->model->getProduct($slug, $language['id']);
        if(!$product){
            throw new \Exception("Товар {$slug} не найден", 404);
        }

        $gallery = $this->model->getProductGallery($product['id']);
        $this->setMeta($product['title'], $product['description'], $product['keywords']);

        $this->set(compact('gallery', 'product'));
    }

}
