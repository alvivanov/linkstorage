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

    public function view(string $name, array $data = []){
        extract($data, EXTR_SKIP);
        require_once 'app/views/' . $name . '.php';
    }

    public function model(string $name){
        $name = ucfirst($name . '_model');
        return $this->parent->{strtolower($name)} = new $name;
    }
}