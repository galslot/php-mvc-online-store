<?php

namespace app\models;

use app\models\AppBase\BaseModel;
use RedBeanPHP\R;

class MainModel extends BaseModel
{
    public function getHit($lang = 1, $limit = 3): array
    {
        return R::getAll("SELECT p.*, pd.* FROM product p JOIN product_description pd ON p.id 
                 = pd.product_id WHERE p.status = 1 AND p.hit = 1 AND pd.language_id = ? LIMIT ?", [$lang, $limit]);
    }

    public function getSlides(): array
    {
        return R::findAll('slider');
    }

}
