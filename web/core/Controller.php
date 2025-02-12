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

    public function errorView($segment = "Error", $view = '404', $response = 404): void
    {
        http_response_code($response);
        $this->setMeta(i18n('tp_error_N404'));
        $this->route['controller'] = $segment;
        $this->view = $view;
    }

}
