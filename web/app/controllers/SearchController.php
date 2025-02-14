<?php

namespace app\controllers;

use app\controllers\AppBase\BaseController;
use app\models\SearchModel;
use core\App;
use core\GettingData;
use core\Pagination;

/** @property SearchModel $model */
class SearchController extends BaseController
{
    public function viewAction(): void
    {
        $language = App::$container->getProp('language');

        $search = trim(GettingData::get('search', 's'));

        $total = $this->model->getCountSearchProducts($search, $language['id']);

        $page = GettingData::get('page', 'i');
        $countItemsOnPage = App::$container->getProp('pagination');
        $pagination = new Pagination($page, $total, $countItemsOnPage);
        $startLimit = $pagination->getStart();

        $products = $this->model->getFindProducts($search, $language['id'], $startLimit, $countItemsOnPage);

        $this->setMeta(i18n('tp_search_title'));

        $this->set(compact(
            'search', 'pagination', 'total', 'products' )
        );
    }
}
