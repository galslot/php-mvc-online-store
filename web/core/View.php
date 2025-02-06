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

    public function render($data): void
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

    public function getParam($nameParameter): string
    {
        return App::$container->getProp($nameParameter);
    }

    public function getMeta(): string
    {
        $out_meta = '<title>'. $this->getParam('site_name'). " - ". hsc($this->meta['title']). '</title>'. PHP_EOL;
        $out_meta .= '<meta name="description" content="'. hsc($this->meta['description']). '" />'. PHP_EOL;
        $out_meta .= '<meta name="keywords" content="'. hsc($this->meta['keywords']). '" />'. PHP_EOL;
        return $out_meta;
    }

    public function getEmbed($file, $data = null): void
    {
        if(is_array($data)){
            extract($data);
        }

        $fileEmbed = VIEWS . "/_embed/". $file. ".php";
        if(!is_file($fileEmbed)){
            throw new \Exception("Не найден {$fileEmbed}", 500);
        }

        require $fileEmbed;
    }

    public function getUrlToRoute($nameUrl)
    {
        switch ($nameUrl){
            case 1:
                $routeName = "about";
                break;
            case 2:
                $routeName = "shop";
                break;
            case 3:
                $routeName = "contact";
                break;
            default:
                $routeName = "main";
                break;
        }

         echo HOME_PAGE. "/". $routeName;
    }

    public function isDebug(): bool
    {
        if(DEBUG) return true;
        return false;
    }

    public function getDbLogs(): void
    {
        if(!$this->isDebug()) return;

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

    public function getRouteLog(): void
    {
        if(!$this->isDebug()) return;

        dd($this->route);
    }

    public function getAppContainer(): void
    {
        if(!$this->isDebug()) return;

        dd(App::$container->getProps());
    }
}
