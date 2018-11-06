<?php

    class Auth extends Controller
    {
        public function index(){

        }

        public function registration(){
            $data['title'] = 'Регистрация';
            $this->load->view('auth/registration', $data);
        }

        public function login(){
            $data['title'] = 'Вход в учетную запись';
            $this->load->view('auth/login', $data);
        }
    }