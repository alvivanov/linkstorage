<?php
/**
 * Created by PhpStorm.
 * Main: aleksandr
 * Date: 31/10/2018
 * Time: 12:57
 */

class Loader
{
    protected $parent;

    public function __construct(Controller &$parent)
    {
        $this->parent = $parent;
    }

    public function view(string $view, array $data = []){
        extract($data, EXTR_SKIP);
        require_once 'app/views/' . $view . '.php';
    }

    public function model(string $model){
        $model = ucfirst($model . '_model');
        return $this->parent->{strtolower($model)} = new $model;
    }

    public function controller(string $controller){
        $controller = ucfirst($controller);
        return $this->parent->{strtolower($controller)} = new $controller;
    }
}