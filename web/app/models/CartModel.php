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

    public function addToCart(array $product, int $quantity = 1): bool
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

    public function deleteProductFromCart($product_id): bool
    {
        if(empty($product_id)) return false;

        $quantity_minus = $_SESSION['cart'][ $product_id ]['quantity'];
        $sum_minus      = $_SESSION['cart'][ $product_id ]['quantity'] * $_SESSION['cart'][ $product_id ]['price'];

        $_SESSION['cart.quantity'] -= $quantity_minus;
        $_SESSION['cart.sum'] -= $sum_minus;

        unset($_SESSION['cart'][$product_id]);
        return true;
    }

    public function deleteAllFromCart(): bool
    {
        unset($_SESSION['cart']);
        unset($_SESSION['cart.quantity']);
        unset($_SESSION['cart.sum']);

        return true;
    }

    public static function translateCart($lang)
    {
        if(empty($_SESSION['cart'])){
            return;
        }

        $ids = implode(',', array_keys($_SESSION['cart']));

        $products = R::getAll("SELECT p.id, pd.title FROM product AS p JOIN product_description AS pd 
                      ON p.id = pd.product_id
                      WHERE p.id IN ($ids) AND pd.language_id = ?", [$lang['id']]
        );

        foreach ($products as $product) {
            $_SESSION['cart'][$product['id']]['title'] = $product['title'];
        }


    }


}
