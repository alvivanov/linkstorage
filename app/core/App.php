<?php

class App
{
//    public $controller;
//    public $method;
//    public $params;

    public function __construct(){
        require_once 'app/config/db_config.php';
        require_once 'app/config/route_config.php';
        require_once 'app/helpers/general_helper.php';

        spl_autoload_register([$this, 'autoloader']);
    }

    private static function autoloader($className){
        $directories = [
            'app/core/',
            'app/controllers/',
            'app/models/'
        ];

        foreach ($directories as $directory) {
            $file = $directory . $className . '.php';
            if(file_exists($file)) include_once $file;
        }
    }

    public function run(){
        session_start();
        $router = new Router;
        call_user_func_array([new $router->controller, $router->method], $router->params);
    }
}