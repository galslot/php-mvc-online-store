<?php

namespace core\helpers;

class FormHelpers
{
    public static function getFieldFromSession($field): string
    {
        return isset($_SESSION['form_data'][$field]) ? hsc($_SESSION['form_data'][$field]) : '';
    }

    public static function deleteFieldFromSession(): void
    {
        if (isset($_SESSION['form_data'])){
            unset($_SESSION['form_data']);
        }
    }
}
