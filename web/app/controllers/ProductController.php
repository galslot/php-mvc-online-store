<?php

namespace app\controllers;

use app\controllers\AppBase\BaseController;

class ProductController extends BaseController
{
    public function itemAction(): void
    {
        $this->setMeta('Продукт', 'internet shop of digital technology', 'internet shop, digital, electronics');

        $slug = $this->route['slug'];

        $product = $this->model->getProduct($slug);
        
    }

}