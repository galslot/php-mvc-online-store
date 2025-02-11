<?php

namespace app\widgets\menu;

use RedBeanPHP\R;
use core\App;
use core\Cache;

class MenuWidget
{
    CONST DEFAULT_TEMPLATE_WIDGET_FILE = "menu_tpl.php";

    protected array $tree;
    protected string $menuHtml;
    protected string $tpl;
    protected string $containerHtml = 'ul';

    protected string $class = 'menu';
    protected int $cacheExpire = 0; # секунды хранения в кеше
    protected string $cacheKey = 'shop_menu_master';
    protected array $attrs = []; # доп.атрибуты в меню
    protected string $prependHtml = ''; # возможный html который может быть добавлен пред меню

    protected ?array $language;

    public function __construct($options = [])
    {
        $this->language = App::$container->getProp('language');
        $this->tpl = __DIR__ . '/'. self::DEFAULT_TEMPLATE_WIDGET_FILE;
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
        $this->menuHtml = $cache->getCache("{$this->cacheKey}_{$this->language['code']}");

        if(!$this->menuHtml){
            $categories = App::$container->getProp("categories_{$this->language['code']}");
            $this->tree = $this->getBuildingTree($categories);
            $this->menuHtml = $this->getMenuHtml($this->tree);
            if((int)$this->cacheExpire > 0){
                $cache->setCache("{$this->cacheKey}_{$this->language['code']}", $this->menuHtml, $this->cacheExpire);
            }
        }

        $this->output();
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
        echo $this->menuHtml;
        echo "</{$this->containerHtml}>";
    }

    protected function getBuildingTree($data): array
    {
        $tree = [];
        foreach ($data as $id => &$node) {
            if (!$node['parent_id']){
                $tree[$id] = &$node;
            } else {
                $data[$node['parent_id']]['children'][$id] = &$node;
            }
        }
        return $tree;
    }

    protected function getMenuHtml($tree): string
    {
        $str = '';
        foreach($tree as $id => $category){
            $str .= $this->catToTemplate($category);
        }
        return $str;
    }

    protected function catToTemplate($category): bool|string
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }
}
