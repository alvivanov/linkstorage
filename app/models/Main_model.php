<?php

    class Main_model extends Model
    {
        public function get(){
            return $this->db->query('SELECT * FROM links')->fetchAll();
        }
    }