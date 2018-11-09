<?php

class Controller extends App
{
    public $load;
    public $error_handler;

    public function __construct()
    {
        $this->load = new Loader($this);

    }

    public function redirect(string $destination)
    {
        header('Location: ' . $destination);
        die();
    }

    public function error($status)
    {
        $error_handler = new Error_handler;
        $error_handler->error($status);
    }
}
