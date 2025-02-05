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
}