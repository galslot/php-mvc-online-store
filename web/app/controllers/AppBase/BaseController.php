<?php

namespace app\controllers\AppBase;

use core\Controller;

class BaseController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
    }

}