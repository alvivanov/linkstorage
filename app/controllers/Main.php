<?php

    class Main extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('links');
        }

        public function index(){
            $data['links'] = $this->links_model->get();
            $data['title'] = 'Хранилище ссылок';
            $this->load->view('main/main', $data);
        }
    }