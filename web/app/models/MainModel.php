<?php

namespace app\models;

use app\models\AppBase\BaseModel;
use RedBeanPHP\R;

class MainModel extends BaseModel
{
    public function getHit($langId = 1, $limit = 3): array
    {
        return R::getAll("SELECT p.*, pd.* FROM product AS p JOIN product_description AS pd ON p.id 
                 = pd.product_id WHERE p.status = 1 AND p.hit = 1 AND pd.language_id = ? LIMIT ?", [$langId, $limit]);
    }

    public function getSlides(): array
    {
        return R::findAll('slider');
    }

}
