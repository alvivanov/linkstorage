<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 31/10/2018
 * Time: 16:30
 */

class Request
{
    public function get(string $path = ''){
        $router = new Router;
        $current_url = $router->parseUrl();
        $aim_url = $router->parseUrl($path);
        if($current_url == $aim_url) return true;

        return false;
    }
}