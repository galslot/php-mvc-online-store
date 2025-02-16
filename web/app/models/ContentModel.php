<?php

namespace app\models;

use app\models\AppBase\BaseModel;
use RedBeanPHP\R;

class ContentModel extends BaseModel
{
    public function getContent($slug, $languageId)
    {
        return R::getRow("SELECT c.*, cd.* FROM content AS c
                JOIN content_description AS cd ON c.id = cd.content_id
                 WHERE c.slug = :slug AND cd.language_id = :language_id", [':slug' => $slug, ':language_id' => $languageId]
        );
    }
}
