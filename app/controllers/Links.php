<?php

    class Links extends Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('links');
        }

        public function index(){
            $data['title'] = 'Мои ссылки';
            $data['links'] = $this->links_model->get();
            $data['status'] = $this->get_status();
            $this->load->view('links/table', $data);
        }

        public function view($id){

            $user = 0;

            if(!is_numeric($id)) $this->error(404);

            $link = $this->links_model->get($id);
            if(empty($link) || $link['user'] != $user) $this->error(404);

            $data['link'] = $link;
            $data['title'] = 'Просмотр ссылки  "' . $link['title'] . '"';
            $data['disabled'] = 'disabled';
            $data['action'] = 'edit';
            $data['button_name'] = 'Редактировать';
            $this->load->view('links/manage', $data);
        }

        public function edit($id){
            $user = 0;

            if(!is_numeric($id)) $this->error(404);

            $link = $this->links_model->get($id);
            if(empty($link) || $link['user'] != $user) $this->error(404);

            $data['link'] = $link;
            $data['status'] = $this->get_status();
            $data['title'] = 'Редактирование ссылки "' . $link['title'] . '"';
            $data['disabled'] = '';
            $data['action'] = 'update';
            $data['button_name'] = 'Сохранить';
            $this->load->view('links/manage', $data);
        }


        public function add(){
            $data['status'] = $this->get_status();
            $data['title'] = 'Добавление ссылки';
            $data['action'] = 'add';
            $data['disabled'] = '';
            $data['button_name'] = 'Добавить';
            $this->load->view('links/manage', $data);
        }

        public function do_action(){
            if(!empty($_POST)) {
                $data = $_POST;
                if($data['action'] == 'add'){
                    if(!$this->links_model->add($data)) $this->redirect('/links/add');
                }
                if($data['action'] == 'update'){
                    if(!$this->links_model->update($data)) $this->redirect('/links/edit/' . $data['id']);
                }
                elseif($data['action'] == 'edit' && !empty($data['id'])) $this->redirect('/links/edit/' . $data['id']);
            }
            $this->redirect('/links/');
        }

        public function delete($id){
            $this->links_model->delete($id);
            $this->redirect('/links/');
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