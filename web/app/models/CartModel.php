<?php

namespace app\models;

use app\models\AppBase\BaseModel;
use RedBeanPHP\R;

class CartModel extends BaseModel
{
    public function getProduct($id, $langId)
    {
        return R::getRow("SELECT p.*, pd.* FROM product AS p 
                 JOIN product_description AS pd ON p.id = pd.product_id 
                 WHERE p.status = 1 AND pd.language_id = ? AND p.id = ?", [$langId, $id]);
    }

    public function addToCart($product, $quantity = 1): bool
    {
        $quantity = abs($quantity);
        $product_id = $product['id'];
        if(empty($product_id) || empty($quantity)){
            return false;
        }

        $cart_product = $_SESSION['cart'][ $product_id ] ?? null;
        if($product['is_download'] && isset($cart_product)) {
            return false;
        }

        if(isset($cart_product)){
            $_SESSION['cart'][ $product_id ]['quantity'] += $quantity;
        }else{
            if($product['is_download']){
                $quantity = 1;
            }

            $_SESSION['cart'][ $product_id ] = [
                'title' => $product['title'],
                'slug'  => $product['slug'],
                'price' => $product['price'],
                'img'   => $product['img'],
                'is_download' => $product['is_download'],
                'quantity' => $quantity,
            ];
        }

        $total = $product['price'] * $quantity;
        $_SESSION['cart.quantity'] = !empty($_SESSION['cart.quantity']) ? $_SESSION['cart.quantity'] + $quantity : $quantity;
        $_SESSION['cart.sum'] = !empty($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $total : $total;

        return true;
    }

}
