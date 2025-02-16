<?php

namespace app\widgets\content;

use core\App;
use core\Cache;
use RedBeanPHP\R;

class ContentWidget
{
    CONST DEFAULT_TEMPLATE_CONTENT_WIDGET_FILE = "content_menu_tpl.php";

    protected ?array $language;
    protected string $tpl;
    protected string $containerHtml = 'ul';
    protected string $class = 'content-menu';
    protected int $cacheExpire = 0;
    protected string $cacheKey = 'shop_content_menu';
    protected string $menuContentHtml;
    protected string $prependHtml = ''; # возможный html который может быть добавлен пред меню
    protected array $attrs = []; # доп.атрибуты в меню
    protected $data;

    public function __construct($options = [])
    {
        $this->language = App::$container->getProp('language');
        $this->tpl = __DIR__ . '/'. self::DEFAULT_TEMPLATE_CONTENT_WIDGET_FILE;
        $this->getOptions($options);
        $this->startWidget();
    }

    protected function getOptions($options): void
    {
        foreach($options as $key => $value){
            switch ($key) {
                case 'class': $this->class = $value; break;
                case 'attrs': $this->attrs = $value; break;
                case 'prepend_html': $this->prependHtml = $value; break;
                case 'container_html': $this->containerHtml = $value; break;
                case 'tpl': $this->tpl = $value; break;
                case 'cache_expire': $this->cacheExpire = $value; break;
            }
        }
    }

    protected function startWidget(): void
    {
        $cache = Cache::getInstance();
        $this->menuContentHtml = $cache->getCache("{$this->cacheKey}_{$this->language['code']}");

        if (!$this->menuContentHtml) {
            $this->data = R::getAssoc("SELECT c.*, cd.* FROM content AS c 
                        JOIN content_description AS cd
                        ON c.id = cd.content_id
                        WHERE cd.language_id = ?", [$this->language['id']]
            );

            $this->menuContentHtml = $this->getMenuContentHtml();
            if ($this->cacheExpire) {
                $cache->setCache("{$this->cacheKey}_{$this->language['code']}", $this->menuContentHtml, $this->cacheExpire);
            }
        }

        $this->output();
    }

    protected function getMenuContentHtml(): string
    {
        $html = '';
        foreach ($this->data as $key => $content) {
            $html .= $this->contentToTemplate($content);
        }
        return $html;
    }

    protected function output(): void
    {
        $attrs = '';
        if(!empty($this->attrs)){
            foreach($this->attrs as $key => $value){
                $attrs .= "{$key}='{$value}'";
            }
        }
        echo "<{$this->containerHtml} class='{$this->class}' {$attrs}>";
        echo $this->prependHtml;
        echo $this->menuContentHtml;
        echo "</{$this->containerHtml}>";
    }

    protected function contentToTemplate($content): bool|string
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }
}