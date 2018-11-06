<?php

    class Main extends Controller
    {
        public function index(){
            if($this->request->get('main')){
                $this->router->redirect('/');
            }

            $this->load->model('links');
            $data['links'] = $this->links_model->get('private=0');
            $data['title'] = 'Хранилище ссылок';
            $this->load->view('main/main', $data);
        }
    }