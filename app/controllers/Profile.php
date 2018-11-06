<?php

    class Profile extends Controller
    {
        public function index(){
            $this->load->model('profile');
            $data['title'] = 'Насторойки пользователя';
            $this->load->view('profile/view', $data);
        }
    }