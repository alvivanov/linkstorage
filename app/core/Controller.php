<?php
/**
 * Created by PhpStorm.
 * Main: aleksandr
 * Date: 30/10/2018
 * Time: 00:05
 */

class Controller
{
    public $load;
    public $request;
    public $router;

    public function __construct()
    {
        $this->load = new Loader($this);
        $this->request = new Request;
        $this->router = new Router;

        $class =  $this->router->parseUrl()[0];
        if($this->request->get($class . '/' . DEFAULT_METHOD) ){
            $this->router->redirect('/' . strtolower($class));
        }
    }

    public function get_status(){
        if(!isset($_SESSION['status'])) return null;

        $status = $_SESSION['status'];
        unset($_SESSION['status']);
        return $status;
    }

    public function set_status(string $data){
        $_SESSION['status'] = $data;
    }
}
