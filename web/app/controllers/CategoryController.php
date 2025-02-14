<?php

namespace app\controllers;

use app\controllers\AppBase\BaseController;
use app\models\BreadCrumbsModel;
use app\models\CategoryModel;
use core\App;
use core\GettingData;
use core\Pagination;

/** @property CategoryModel $model */

class CategoryController extends BaseController
{
    public function viewAction(): void
    {
        $language = App::$container->getProp('language');
        $slug = $this->route['slug'];

        $category = $this->model->getCategory($slug, $language['id']);
        if(!$category){
            $this->errorView();
            return;
        }

        $breadCrumbs = BreadCrumbsModel::getBreadCrumbs($category['id']);

        $idAllChild = $this->model->getIdAllChild($category['id']);
        $idAllChild = !$idAllChild ? $category['id'] : $idAllChild . $category['id'];

        $page = GettingData::get('page', 'i');
        $countItemsOnPage = App::$container->getProp('pagination');
        $total = $this->model->getCountProducts($idAllChild);

        $pagination = new Pagination($page, $total, $countItemsOnPage);
        $startLimit = $pagination->getStart();

        $products = $this->model->getProducts($idAllChild, $language['id'], $startLimit, $countItemsOnPage);

        $this->setMeta($category['title'], $category['description'], $category['keywords']);
        $this->set(compact(
            'category', 'breadCrumbs', 'products', 'total', 'pagination'
            )
        );
    }
}
