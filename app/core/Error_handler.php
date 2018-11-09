<?php

    Class Error_handler extends Controller
    {
        public function error($status)
        {
            $data['status'] = $status;
            $data['title'] = 'Ошибка ' . $status;
            http_response_code($status);
            $this->load->view('template/error_template', $data);
            die();
        }
    }