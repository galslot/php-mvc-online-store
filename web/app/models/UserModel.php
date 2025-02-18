<?php

namespace app\models;

use app\models\AppBase\BaseModel;
use RedBeanPHP\R;

class UserModel extends BaseModel
{
    CONST TABLE_DB_FOR_MODEL_USER = "users";

    public array $attributes = [
        'email'    => '',
        'password' => '',
        'name'     => '',
        'lastname' => '',
        'address'  => '',
    ];

    public array $rules = [
        'required' => ['email', 'password', 'name', 'address',],
        'email' => ['email',],
        'lengthMin' => [
            ['email', 5],
            ['password', 6],
            ['name', 3],
            ['address', 4],
        ],
    ];

    public array $labels = [
        'email'    => 'form_signup_email_input',
        'password' => 'form_signup_password_input',
        'name'     => 'form_signup_name_input',
        'lastname' => 'form_signup_lastname_input',
        'address'  => 'form_signup_address_input',
    ];

    public static function checkAuth(): bool
    {
        return isset($_SESSION['user']);
    }

    public function setPasswordHash(): void
    {
        $this->attributes['password'] = password_hash($this->attributes['password'], PASSWORD_DEFAULT);
    }

    public function save($nameTable = self::TABLE_DB_FOR_MODEL_USER): int|string
    {
        return parent::save($nameTable);
    }

    public function checkFieldUnique($field, $textError = ''): bool
    {
        $user = R::findOne(self::TABLE_DB_FOR_MODEL_USER, $field.' = ?', [$this->attributes[$field]]);
        if ($user) {
            $this->errors['unique'][] = $textError;
            return false;
        }

        return true;
    }

    public function login($data): bool
    {
        $email    = $data['email'];
        $password = $data['password'];
        if(!(isset($email) && isset($password))) {
            return false;
        }

        $user = R::findOne(self::TABLE_DB_FOR_MODEL_USER, 'email =:email ', [':email' => $email]);

        if(!(isset($user) && password_verify($password, $user->password))){
            return false;
        }

        $_SESSION['user']['id'] = $user->id;
        $_SESSION['user']['email'] = $user->email;
        $_SESSION['user']['name'] = $user->name;
        $_SESSION['user']['lastname'] = $user->lastname;
        $_SESSION['user']['address'] = $user->address;
        $_SESSION['user']['role'] = $user->role;

        return true;
    }

    public function logout(): void
    {
        if(self::checkAuth()) {
            unset($_SESSION['user']);
        }
    }
}
