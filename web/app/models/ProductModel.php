<?php

namespace app\models;

use app\models\AppBase\BaseModal;
use RedBeanPHP\R;

class ProductModel extends BaseModal
{
    public function getProduct($slug, $lang = 1)
    {
        return R::getAll("SELECT p.*, pd.* FROM product p JOIN product_description pd ON p.id 
                 = pd.product_id WHERE p.status = 1 AND pd.language_id = ? AND p.slug = ?", [$lang, $slug]);
    }
}