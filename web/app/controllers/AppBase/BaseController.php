<?php

namespace app\controllers\AppBase;

use app\models\AppBase\BaseModel;
use app\widgets\language\LangWidget;
use core\App;
use core\Controller;

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
    }

}