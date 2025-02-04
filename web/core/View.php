<?php

namespace core;

use RedBeanPHP\R;

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

    public function getMeta(): string
    {
        $out_meta = '<title>'. hsc($this->meta['title']). '</title>'. PHP_EOL;
        $out_meta .= '<meta name="description" content="'. hsc($this->meta['description']). '" />'. PHP_EOL;
        $out_meta .= '<meta name="keywords" content="'. hsc($this->meta['keywords']). '" />'. PHP_EOL;
        return $out_meta;
    }

    public function isDebug(): bool
    {
        if(DEBUG) return true;
        return false;
    }

    public function getDbLogs(): void
    {
        if($this->isDebug()){
            $logs = R::getDatabaseAdapter()
                ->getDatabase()
                ->getLogger();

            $logs = array_merge(
                $logs->grep( 'SELECT' ), $logs->grep( 'select' ),
                $logs->grep( 'UPDATE' ), $logs->grep( 'update' ),
                $logs->grep( 'DELETE' ), $logs->grep( 'delete' ),
                $logs->grep( 'INSERT' ), $logs->grep( 'insert' ),
            );

            dd($logs);
        }
    }
}
