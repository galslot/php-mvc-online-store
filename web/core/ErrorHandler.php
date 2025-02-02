<?php

    namespace core;

    use JetBrains\PhpStorm\NoReturn;

    class ErrorHandler
    {
        public function __construct()
        {
            if(DEBUG){
                error_reporting(E_ALL);
            }else{
                error_reporting(0);
            }

            set_exception_handler([$this, 'exceptionHandler']);
            set_error_handler([$this, 'errorHandler']);

            ob_start(); # Включение буферизации
            register_shutdown_function([$this, 'shutdownFatalErrorHandler']);
        }

        public function errorHandler($errno, $errstr, $errfile, $errline): void
        {
            $this->logError($errstr, $errfile, $errline);
            $this->displayError($errno, $errstr, $errfile, $errline);
        }

        public function shutdownFatalErrorHandler(): void
        {
            $error = error_get_last();

            // если была ошибка и она фатальна
            if (!empty($error) AND $error['type'] & ( E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR))
            {
                $this->logError($error['message'], $error['file'], $error['line']);
                // очищаем буффер (не выводим стандартное сообщение об ошибке)
                ob_end_clean();

                $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
            }else{
                // отправка (вывод) буфера и его отключение
                ob_end_flush();
            }
        }

        public function exceptionHandler(\Throwable $exception): void
        {
            $this->logError($exception->getMessage(), $exception->getFile(), $exception->getLine());
            $this->displayError("Исключение",
                $exception->getMessage(),
                $exception->getFile(),
                $exception->getLine(),
                $exception->getCode()
            );
        }

        protected function logError($message = '', $file = '', $line = 0): void
        {
            if(!is_dir(LOGS)){
                if (!mkdir(LOGS, PERMISSION_VAR, true)) {
                    die('Не удалось создать директорию.');
                }
            }

            file_put_contents(LOGS. '/error-'.date("Y-m-d").'.log',
                '['.date("Y-m-d H:i:s").'] = '. $message. ' | File:'. $file. ' | Line:'.$line. PHP_EOL,
                FILE_APPEND | LOCK_EX
            );
        }

        protected function displayError($errno, $errstr, $errfile, $errline, $responce = 500): void
        {
            if($responce == 0){
                $responce = 404;
            }

            http_response_code($responce);

            if($responce == 404 && !DEBUG){
                require_once WWW. '/err/404.php';
                die();
            }

            if(DEBUG){
                require_once WWW. '/err/dev.php';
            }else{
                require_once WWW. '/err/prod.php';
            }
            die();
        }

    }