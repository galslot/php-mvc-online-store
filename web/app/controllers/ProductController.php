<?php

namespace app\controllers;

use app\controllers\AppBase\BaseController;
use app\models\ProductModel;
use app\models\BreadCrumbsModel;
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
            $this->errorView();
            return;
        }

        $breadCrumbs = BreadCrumbsModel::getBreadCrumbs($product['category_id'], $product['title']);

        $gallery = $this->model->getProductGallery($product['id']);
        $this->setMeta($product['title'], $product['description'], $product['keywords']);

        $this->set(compact('gallery', 'product', 'breadCrumbs'));
    }

}
