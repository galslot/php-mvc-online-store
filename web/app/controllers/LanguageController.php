<?php

namespace app\controllers;

use app\controllers\AppBase\BaseController;
use core\GettingData;

class LanguageController extends BaseController
{
    public function changeAction(): void
    {
        $lang = GettingData::get('lang', 's');

        if( empty($lang) ||  empty($_SERVER['HTTP_REFERER']) || !array_key_exists($lang, $this->languages) ){
            $this->redirect();
        }

        // $_SERVER['HTTP_REFERER']
        // step1. убираем базовый Url
        $url = trim( str_replace(HOME_PAGE, '', $_SERVER['HTTP_REFERER']), "/" );

        // step2. разбивка
        $url_section = explode('/', $url, 2);

        // step3. ищем 1-ю часть (старый язык) в массиве языков
        if(array_key_exists($url_section[0], $this->languages)){
            // новый язык (если он не базовый) [1]
            if($lang != $this->languageBase){
                $url_section[0] = $lang;
            }else{
                // если базовый - убираем его из URL запроса
                array_shift($url_section);
            }
        }else{
            // новый язык (если он не базовый) [2]
            if($lang != $this->languageBase){
                array_unshift($url_section, $lang);
            }
        }

        $url_new = HOME_PAGE. "/". implode('/', $url_section);
        $this->redirect($url_new);
    }
}
