<?php

namespace app\models;

use app\models\AppBase\BaseModel;
use RedBeanPHP\R;

class SearchModel extends BaseModel
{
    public function getCountSearchProducts(string $search, int $languageId): int
    {
        $search = "%" . $search . "%";
        return R::getCell(
            "SELECT COUNT(*) FROM product AS p 
                JOIN product_description AS pd ON p.id = pd.product_id
                WHERE p.status = 1 AND pd.language_id = ? AND pd.title LIKE ?", [$languageId, $search]
        );
    }

    public function getFindProducts(string $search, int $languageId, $startLimit, $countItemsOnPage): array
    {
        $search = "%" . $search . "%";
        return R::getAll("SELECT p.*, pd.* FROM product AS p 
                JOIN product_description AS pd ON p.id = pd.product_id 
                 WHERE p.status = 1 AND pd.language_id = ? AND pd.title LIKE ? LIMIT ?,?",
            [$languageId, $search, $startLimit, $countItemsOnPage]);
    }
}
