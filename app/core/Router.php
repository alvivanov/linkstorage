<?php

//namespace app\core;

class Router
{
    public $controller = DEFAULT_CONTROLLER;
    public $method = DEFAULT_METHOD;
    public $params = [];

    public function get_page()
    {
        $url = $this->parseUrl();
        if($url === false) $url[0] = ucfirst(DEFAULT_CONTROLLER);

        if(file_exists('app/controllers/' . $url[0] . '.php')){
            $this->controller = $url[0];
            unset($url[0]);
        } else {
            $error = new Error_handler();
            $error->handle(404);
            exit;
        }

        $this->controller = new $this->controller;

        if(isset($url[1])){
            if(method_exists($this->controller, $url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [0];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl(string $url = '')
    {
        if(empty($url) && !isset($_GET['url'])) return false;

        $url = empty($url) ? $_GET['url'] : $url;
        return explode('/', filter_var(rtrim(ucfirst($url), '/'), FILTER_SANITIZE_URL));
    }

    public function redirect(string $destination, array $data = [])
    {
        $query = '';
        if(!empty($data)) $query = '?' . http_build_query($data);

        header('Location: ' . $destination . $query);
        exit;
    }
}