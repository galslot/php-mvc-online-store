<?php

namespace core;

class View
{
    public string $content = '';

    public function __construct(
        public $route,
        public $layout = '',
        public $view = '',
        public $meta = [],
    )
    {
        if(false !== $this->layout){
            $this->layout = $this->layout ?: LAYOUT_NAME;
        }
    }

    public function render($data)
    {
        if(is_array($data)){
            extract($data);
        }

        // TODO
        $pref = '';
        if($this->route['admin_pref'] == 'admin'){
            $pref = 'admin/';
        }

        $view_file = VIEWS . "/{$pref}{$this->route['controller']}/{$this->view}.php";
        if(!is_file($view_file)){
            throw new \Exception("Не найден вид {$view_file}", 500);
        }

        ob_start();
        require_once $view_file;
        $this->content = ob_get_clean();

        if(false !== $this->layout){
            $layout_file = LAYOUT_DIR . "/{$this->layout}.php";
            if(!is_file($layout_file)){
                throw new \Exception("Не найден шаблон {$layout_file}", 500);
            }

            require_once $layout_file;
        }
    }
}
