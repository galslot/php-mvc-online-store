<?php
/*
 * view_func
 */

use core\Language;

function i18n(string $key)
{
    return Language::get($key);
}

function eI18n(string $key)
{
    echo Language::get($key);
}