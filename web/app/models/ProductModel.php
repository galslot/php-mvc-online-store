<?php

namespace app\models;

use app\models\AppBase\BaseModel;
use RedBeanPHP\R;

class ProductModel extends BaseModel
{
    public function getProductGallery($productId): array
    {
        return R::getAll("SELECT * FROM product_gallery AS pg
                  WHERE pg.product_id = ?", [$productId]);
    }
    
}
