<?php

namespace app\controllers;

use app\controllers\AppBase\BaseController;
use app\models\CartModel;
use core\App;
use core\GettingData;

/** @property CartModel $model */
class CartController extends BaseController
{

    /**
     * @throws \Exception
     */
    public function addAction(): bool
    {
        $language = App::$container->getProp('language');

        $id = GettingData::get('id', 'i');
        if(!$id) return false;

        $quantity = GettingData::get('quantity', 'i');

        $product = $this->model->getProduct($id, $language['id']);
        if(!$product) return false;

        $this->model->addToCart($product, $quantity);

        $this->ajaxRequestToView();
        return true;
    }

    /**
     * @return bool
     */
    public function showAction(): bool
    {
        $this->ajaxRequestToView();
        return true;
    }

    private function ajaxRequestToView(): void
    {
        if($this->isAjaxRequest()){
            $params['is_cart_not_empty'] = !empty($_SESSION['cart']);
            $params['cart_products'] = $_SESSION['cart'] ?? [];
            $params['cart_quantity'] = $_SESSION['cart.quantity'] ?? '';
            $params['cart_sum']      = $_SESSION['cart.sum'] ?? '';
            $this->loadView('cart_modal', $params);
        }
    }

    /**
     * POST
     * @return bool
     */
    public function deletePostAction(): bool
    {
        $product_id = GettingData::post('id', 'i');
        if(!$product_id) return false;

        if(isset($_SESSION['cart'][$product_id])){
            $this->model->deleteProductFromCart($product_id);
        }

        $this->ajaxRequestToView();
        return true;
    }

    public function deleteAllAction(): bool
    {
        if(empty($_SESSION['cart'])){
            return false;
        }

        $this->model->deleteAllFromCart();

        $params['is_cart_not_empty'] = false;
        $params['cart_products'] = [];
        $params['cart_quantity'] = '';
        $params['cart_sum']      = '';
        $this->loadView('cart_modal', $params);

        return true;
    }

    /**
     * POST
     * @return void
     */
    public function cartQuantityPostAction(): void
    {
        if($this->isAjaxRequest()){
            echo !empty($_SESSION['cart.quantity']) ? $_SESSION['cart.quantity'] : '';
        }else{
            echo '';
        }
        die();
    }
}
