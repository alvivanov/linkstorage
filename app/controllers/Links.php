<?php

    class Links extends Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('links');
        }

        public function index(){
            if(isset($_GET['status'])) {
                if ($_GET['status'] === 'error') $data['status'] = 'Ошибка!';
                elseif ($_GET['status'] === 'is_exist') $data['status'] = 'Ссылка уже существует!';
                elseif ($_GET['status'] === 'success') $data['status'] = 'Ссылка добавлена!';
            }
            $data['title'] = 'Мои ссылки';
            $data['links'] = $this->links_model->get('user = 0');
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
            $data['title'] = 'Редактирование ссылки "' . $link['title'] . '"';
            $data['disabled'] = '';
            $data['action'] = 'update';
            $data['button_name'] = 'Сохранить';
            $this->load->view('links/manage', $data);
        }


        public function add(){
            $data['title'] = 'Добавление ссылки';
            $data['action'] = 'add';
            $data['disabled'] = '';
            $data['button_name'] = 'Добавить';
            $this->load->view('links/manage', $data);
        }

        public function do_action(){
            $response = [];
            if(!empty($_POST)) {
                $data = $_POST;
                if($data['action'] == 'add'){
                    if($this->is_link_exist($data['link'])) $response['status'] = 'is_exist';
                    else $response['status'] = $this->links_model->add($data);
                }
                elseif($data['action'] == 'update') $this->links_model->update($data);
                elseif($data['action'] == 'edit' && !empty($data['id'])) $this->router->redirect('/links/edit/' . $data['id'], $response);
                else $this->router->redirect('/links', $response);
            }
            $this->router->redirect('/links/', $response);
        }

        private function is_link_exist($current_link){
            $links = $this->links_model->get();
            foreach ($links as $link) {
                if($link['link'] === $current_link) return true;
            }
            return false;
        }

        public function delete($id){
            $this->links_model->delete($id);
            $this->router->redirect('/links/');
        }

    }