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
    }

    public function getModel(): void
    {
        // TODO
        $pref = '';
        if($this->route['admin_pref'] == 'admin'){
            $pref = 'admin/';
        }

        $model = 'app\\models\\'. $pref. $this->route['controller']. "Model";
        if(class_exists($model)){
            $this->model = new $model();
        }
    }

    /**
     * @throws \Exception
     */
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
        $title = $title ?? '';
        $description = $description ?? '';
        $keywords = $keywords ?? '';

        $this->meta = [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords
        ];
    }

    public function redirect($http = false): void
    {
        if($http){
            $header = $http;
        }else{
            $header = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : HOME_PAGE;
        }
        header("Location: $header");
        die();
    }

}
