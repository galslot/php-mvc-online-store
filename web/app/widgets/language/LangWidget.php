<?php

namespace app\widgets\language;

use core\App;

class LangWidget
{
    protected $tpl;
    protected array $languages; # все языки поддерживаемые

    protected $language;  #

    public function __construct()
    {
        $this->tpl = __DIR__ . '/language_tpl.php';
        $this->startWidget();
    }

    protected function startWidget(): void
    {
        $this->languages = App::$container->getProp('languages');
        $this->language  = App::$container->getProp('language');
        echo $this->getHtml();
    }

    /**
     * @param $languages
     * @return false|mixed
     */
    public static function getLanguage($languages)
    {
        $lang = App::$container->getProp('lang');
        $languageBase = App::$container->getProp('language_base');

        if($lang && array_key_exists($lang, $languages)) {
            $key = $lang;
        }elseif(!$lang){
            $key = $languageBase;
        }else{
            return false;
        }

        $langInfo = $languages[$key];
        $langInfo['code'] = $key;
        return $langInfo;
    }

    protected function getHtml(): string
    {
        ob_start();
        require_once $this->tpl;
        return ob_get_clean();
    }

}