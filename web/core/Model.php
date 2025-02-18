<?php

namespace core;

use core\db\Db;
use RedBeanPHP\R;
use RedBeanPHP\RedException\SQL;
use Valitron\Validator;

abstract class Model
{
    /**
     * авто заполнение модели данными
     * @var array
     */
    public array $attributes = [];

    public array $errors = [];

    public array $rules = []; # правила валидации

    public array $labels = [];

    public function __construct()
    {
       Db::getInstance();
    }

    public function loadData(array $data): void
    {
        foreach ($this->attributes as $name => $value) {
            if(isset($data[$name])){
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    public function validate($data, $lang_code = 'en'): bool
    {
        $langDir = APP.'/lang/valitron/lang';
        $filename = $langDir.'/'.$lang_code.'.php';
        if(file_exists($filename)){
            Validator::langDir($langDir);
            Validator::lang($lang_code);
        }
        $validator = new Validator($data);
        $validator->rules($this->rules);
        $validator->labels($this->getLabels());

        if($validator->validate()) return true;

        $this->errors = $validator->errors();
        return false;
    }

    public function getErrors(): void
    {
        $errorsStr = '<ul>';
        foreach ($this->errors as $error) {
            foreach ($error as $item){
                $errorsStr .= '<li>' . $item . '</li>';
            }
        }
        $errorsStr .= '</ul>';
        $_SESSION['errors'] = $errorsStr;
    }

    public function getLabels(): array
    {
        $labels = [];
        foreach ($this->labels as $key => $label_field) {
            $labels[$key] = i18n($label_field);
        }
        return $labels;
    }

    /**
     * @throws SQL
     */
    public function save($nameTable): int|string
    {
        $modelTable = R::dispense($nameTable);
        foreach ($this->attributes as $name => $value) {
            if(isset($value) && $value !=''){
                $modelTable->$name = $value;
            }
        }
        return R::store($modelTable);
    }

}
