<?php

namespace app\controllers;

use app\controllers\AppBase\BaseController;
use app\models\CartModel;
use core\App;
use core\GettingData;

/** @property CartModel $model */
class CartController extends BaseController
{
    public function addAction(): bool
    {
        $language = App::$container->getProp('language');

        $id = GettingData::get('id', 'i');
        $quantity = GettingData::get('quantity', 'i');

        if(!$id){
            return false;
        }

        $product = $this->model->getProduct($id, $language['id']);
        if(!$product){
            return false;
        }

        $this->model->addToCart($product, $quantity);

        if($this->isAjaxRequest()){
            dd($_SESSION);
            die();
        }

        $this->redirect();
        return false;
    }
}
