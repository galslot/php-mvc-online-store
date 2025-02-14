<?php

namespace app\models;

use app\models\AppBase\BaseModel;
use core\App;
use core\GettingData;
use RedBeanPHP\R;

class CategoryModel extends BaseModel
{
    public function getCategory(string $slug, int $languageId): array
    {
        return R::getRow("SELECT c.*, cd.* FROM category AS c JOIN category_description AS cd 
                  ON c.id = cd.category_id 
                  WHERE c.slug = ? AND cd.language_id = ?", [$slug, $languageId]);
    }

    public function getIdAllChild($id):string
    {
        $language = App::$container->getProp('language');
        $categories = App::$container->getProp("categories_{$language['code']}");

        $idAll = '';
        foreach ($categories as $id_key => $item) {
            if($item['parent_id'] == $id) {
                $idAll .= $id_key . ",";
                $idAll .= $this->getIdAllChild($id_key);
            }
        }
        return $idAll;
    }

    public function getProducts(string $idAll, int $languageId, $startLimit, $countItemsOnPage): array
    {
        $sort_white_list = [
            'title_asc' => 'ORDER BY title ASC',
            'title_desc' => 'ORDER BY title DESC',
            'price_asc' => 'ORDER BY price ASC',
            'price_desc' => 'ORDER BY price DESC',
        ];

        $order_by = '';
        $sort = GettingData::get('sort', 's');
        if( $sort && array_key_exists($sort, $sort_white_list)) {
            $order_by = $sort_white_list[$sort];
        }

        return R::getAll("SELECT p.*, pd.* FROM product AS p 
                JOIN product_description AS pd ON p.id = pd.product_id 
                 WHERE p.status = 1 AND p.category_id IN (?) AND pd.language_id = ? {$order_by} LIMIT ?,?",
            [$idAll, $languageId, $startLimit, $countItemsOnPage]);
    }

    public function getCountProducts($ids): int
    {
        return R::count('product', "category_id IN ($ids) AND status = 1");
    }

}
