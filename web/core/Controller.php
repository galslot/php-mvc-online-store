<?php

namespace core;

abstract class Controller
{
    public array $data = [];
    public array $meta = ['title' => '', 'description' => '', 'keywords' => ''];
    public false|string $layout = '';
    public string $view = '';
    public ?object $model = null;

    public function __construct(public $route = [])
    {
        dd($this->route);
    }

    public function getModel(): void
    {
        $model = 'app\\model\\'. $this->route['admin_pref']. "\\". $this->route['controller'];
        if(class_exists($model)){
            $this->model = new $model();
        }
    }

    public function getView(): void
    {
        $this->view = $this->view ?: $this->route['action'];
        (new View($this->route, $this->layout, $this->view, $this->meta))->render($this->data);
    }

    public function set($data): void
    {
        $this->data = $data;
    }

    public function setMeta($title = '', $description = '', $keywords = ''): void
    {
        $this->meta = [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords
        ];
    }

}
