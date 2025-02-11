<?php

namespace app\models\AppBase;

use core\Model;
use RedBeanPHP\R;

class BaseModel extends Model
{
    /**
     * # все языки поддерживаемые
     * @return array
     */
    public function getLanguages(): array
    {
        return R::getAssoc("SELECT code, title, base, id FROM language ORDER BY base DESC");
    }

    public function getLanguageBase(): string
    {
        $base = R::getAssoc("SELECT code, base, id FROM language WHERE base = 1");
        return key($base);
    }

    public function getProductById($id, $languageId)
    {
        return R::getRow("SELECT p.*, pd.* FROM product AS p 
                 JOIN product_description AS pd ON p.id = pd.product_id 
                 WHERE p.status = 1 AND pd.language_id = ? AND p.id = ?", [$languageId, $id]);
    }

    public function getProduct($slug, $languageId): array
    {
        return R::getRow("SELECT p.*, pd.* FROM product AS p JOIN product_description AS pd 
                  ON p.id = pd.product_id 
                  WHERE p.status = 1 AND pd.language_id = ? AND p.slug = ?", [$languageId, $slug]);
    }

}
