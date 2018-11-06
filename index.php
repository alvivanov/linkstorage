<?php    ini_set('display_errors', 1);    require_once 'app/config/db_config.php';    require_once 'app/config/route_config.php';    require_once 'app/helpers/general_helper.php';    spl_autoload_register('myAutoloader');    function myAutoloader($className)    {        $directories = [            'app/core/',            'app/controllers/',            'app/models/'        ];        foreach ($directories as $directory) {            $file = $directory . $className . '.php';            if(file_exists($file)) include_once $file;        }    }    $router = new Router;    $router->get_page();