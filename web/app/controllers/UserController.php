<?php

namespace app\controllers;

use app\controllers\AppBase\BaseController;
use app\models\UserModel;
use core\App;
use core\helpers\FormHelpers;

/** @property UserModel $model */
class UserController extends BaseController
{
    public function registrationAction(): void
    {
        if(UserModel::checkAuth()){
            $this->redirect(baseUrl());
        }

        $lang_code = App::$container->getProp('lang');

        if (!empty($_POST)) {
            $dataForm = $_POST;
            $this->model->loadData($dataForm);

            if(!$this->model->validate($dataForm, $lang_code) ||
               !$this->model->checkFieldUnique('email', i18n('user_signup_error_email_unique'))
            ){
                $this->model->getErrors();
                $_SESSION['form_data'] = $dataForm;
            }else{
                FormHelpers::deleteFieldFromSession();
                $this->model->setPasswordHash();

                if ($this->model->save()) {
                    $_SESSION['success'] = i18n('user_signup_success_register');
                } else {
                    $_SESSION['errors'] = i18n('user_signup_error_register');
                }
            }
            $this->redirect();
        }

        $this->setMeta(i18n('tp_register'));
    }


    public function loginAction(): void
    {
        if(UserModel::checkAuth()){
            $this->redirect(baseUrl());
        }

        $this->setMeta(i18n('tp_login'));

        if (!empty($_POST)) {
            if (!$this->model->login($_POST)) {
                $_SESSION['errors'] = i18n('user_login_error_login');
                $this->redirect();
            }

            $_SESSION['success'] = i18n('user_login_success_login');
            $this->redirect(baseUrl());
        }
    }

    public function cabinetAction(): void
    {
        if(UserModel::checkAuth()){
            $this->redirect(baseUrl());
        }

        $this->setMeta(i18n('user_login_cabinet'));

    }

    public function logoutAction(): void
    {
        $this->model->logout();
        $this->redirect(baseUrl() . 'user/login');
    }

}
