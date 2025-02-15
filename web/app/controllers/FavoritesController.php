<?php

namespace app\controllers;

use app\controllers\AppBase\BaseController;
use app\models\FavoritesModel;
use core\App;
use core\GettingData;

/** @property FavoritesModel $model */

class FavoritesController extends BaseController
{
    public function listAction()
    {
        $language = App::$container->getProp('language');
        $products = $this->model->getFavoritesProducts($language['id']);

        $this->setMeta(i18n('favorites_index_title'));
        $this->set(compact('products'));
    }

    public function addAction()
    {
        $id = GettingData::get('id', 'i');
        if (!$id) {
            exit(json_encode($this->getResError('add')));
        }

        $product = $this->model->getProductByIdFavorite($id);
        if ($product) {
            $this->model->addToFavorites($id);
            $response = $this->getResSuccess('add');
        } else {
            $response = $this->getResError('add');
        }
        exit(json_encode($response));
    }

    public function deleteAction()
    {
        $id = GettingData::get('id', 'i');
        if (!$id) {
            exit(json_encode($this->getResError('del')));
        }

        $product = $this->model->getProductByIdFavorite($id);
        if ($product && $this->model->deleteFromFavorite($id)) {
            $response = $this->getResSuccess('del');
        } else {
            $response = $this->getResError('del');
        }
        exit(json_encode($response));
    }

    private function getResError(string $type): array
    {
        $text = '';
        if($type == 'add'){
            $text = i18n('tp_favorites_add_error');
        }
        if($type == 'del'){
            $text = i18n('tp_favorites_delete_error');
        }

        return [
            'result' => 'error',
            'text' => $text,
        ];
    }

    private function getResSuccess(string $type): array
    {
        $text = '';
        if($type == 'add'){
            $text = i18n('tp_favorites_add_success');
        }
        if($type == 'del'){
            $text = i18n('tp_favorites_delete_success');
        }

        return [
            'result' => 'success',
            'text' => $text,
        ];
    }

}
