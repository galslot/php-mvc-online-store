<?php

namespace app\controllers\AppBase;

use app\models\AppBase\BaseModal;
use core\Controller;

class BaseController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new BaseModal();
    }

}