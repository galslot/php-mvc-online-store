<?php

namespace app\controllers\AppBase;

use app\models\AppBase\BaseModel;
use app\widgets\language\LangWidget;
use core\App;
use core\Controller;
use core\Language;

class BaseController extends Controller
{
    protected array $languages; # [] все языки поддерживаемые
    protected string $languageBase;  # базовый язык

    /**
     * @throws \Exception
     */
    public function __construct($route)
    {
        parent::__construct($route);
        $baseModel = new BaseModel();

        $this->languages = $baseModel->getLanguages();
        $this->languageBase = $baseModel->getLanguageBase();

        App::$container->setProp('languages', $this->languages);
        App::$container->setProp('language_base', $this->languageBase);

        $language = LangWidget::getLanguage($this->languages);

        if(false === $language){
            // TODO - нужен редирект на главную в таком случае
            throw new \Exception("Not found language.", 404);
        }

        App::$container->setProp('language', $language);

        Language::load($language['code'], $this->route);
    }

    public function getLang(string $key)
    {
        $lang = App::$container->getProp('language');
        return $lang[$key];
    }

    public function isAjaxRequest(): bool
    {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        {
            // Если Ajax запрос
            return true;
        }
        return false;
    }

    public function loadView(string $view, array $params = []): void
    {
        if(is_array($params)){
            extract($params);
        }

        // TODO
        $pref = '';

        $view_file = VIEWS . "/{$pref}{$this->route['controller']}/{$view}.php";
        if(!is_file($view_file)){
            throw new \Exception("Не найден вид {$view_file}", 500);
        }

        require $view_file;
        die();
    }


}