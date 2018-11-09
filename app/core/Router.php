<?php

class Router
{
    public $controller = DEFAULT_CONTROLLER;
    public $method = DEFAULT_METHOD;
    public $params = [];

    public function __construct()
    {
        $url = $this->parseUrl($_SERVER['REQUEST_URI']);
        if(!empty($url[0])){
            if(class_exists($url[0])) {
                $this->controller = $url[0];
                unset($url[0]);
            }
            else{
                $this->controller = 'Error_handler';
                $this->method = 'error';
                $url = [404];
            }
        }

        if(!empty($url[1])){
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
            else{
                $this->controller = 'Error_handler';
                $this->method = 'error';
                $url = [404];
            }
        }

        $this->params = $url ? array_values($url) : [0];
    }

    public function parseUrl(string $url)
    {
        return explode('/', filter_var(ucfirst(trim($url, '/')), FILTER_SANITIZE_URL));
    }
}