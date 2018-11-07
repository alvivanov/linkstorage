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
            $data['links'] = $this->links_model->get('user = 0');
            $data['status'] = $this->get_status();
            $this->load->view('links/table', $data);
        }

        public function view($id){
            $id_num = @+$id;
            $user = 0;

            if($id_num === 0) $this->router->redirect('/links');

            elseif(strlen($id) !== strlen($id_num)) {
                $this->router->redirect('/links/view/' . $id_num);
            }

            $link = $this->links_model->get('id=' . $id_num)[0];
            if(empty($link) || $link['user'] != $user) $this->router->redirect('/links');

            $data['link'] = $link;
            $data['title'] = 'Просмотр ссылки  "' . $link['title'] . '"';
            $data['disabled'] = 'disabled';
            $data['action'] = 'edit';
            $data['button_name'] = 'Редактировать';
            $this->load->view('links/manage', $data);
        }

        public function edit($id){
            $id_num = @+$id;
            $user = 0;

            if($id_num === 0) $this->router->redirect('/links');

            elseif(strlen($id) !== strlen($id_num)) {
                $this->router->redirect('/links/view/' . $id_num);
            }

            $link = $this->links_model->get('id=' . $id_num)[0];
            if(empty($link) || $link['user'] != $user) $this->router->redirect('/links');

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
                    if(!$this->links_model->add($data)) $this->router->redirect('/links/add');
                }
                if($data['action'] == 'update'){
                    if(!$this->links_model->update($data)) $this->router->redirect('/links/edit/' . $data['id']);
                }
                elseif($data['action'] == 'edit' && !empty($data['id'])) $this->router->redirect('/links/edit/' . $data['id']);
            }
            $this->router->redirect('/links/');
        }

        public function delete($id){
            $this->links_model->delete($id);
            $this->router->redirect('/links/');
        }

    }