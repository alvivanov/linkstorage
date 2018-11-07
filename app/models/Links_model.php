<?php

    class Links_model extends Model
    {
        public function add($data)
        {
            if (empty($data)) return false;
            if(empty($data['link'])){
                $this->set_status('Поле "Ссылка" должно быть заполнено.');
                return false;
            }

            if($this->is_link_exist($data['link'])){
                $this->set_status('Ссылка уже существует!');
                return false;
            }

            $link        = /*$this->db->quote(*/$data['link'];
            $title       = !empty($data['title']) ? /*$this->db->quote(*/$data['title'] : $data['link'];
            $description = !empty($data['description']) ? /*$this->db->quote(*/$data['description'] : '';
            $private     = isset($data['private']) ? '1' : '0';

            $q = 'INSERT INTO links (title, link, description, private, user) values ("' . $title . '","' . $link . '","' . $description . '",' . $private . ', 0);';

            if(!$this->db->query($q)){
                $this->set_status('Ошибка!');
                return false;
            }

            $this->set_status('Ссылка успешно добавлена!');
            return true;
        }

        private function is_link_exist($current_link){
            $links = $this->get();
            foreach ($links as $link) {
                if($link['link'] === $current_link) return true;
            }
            return false;
        }

        public function get(string $where = '')
        {
            if(!empty($where)) $where = ' WHERE ' . $where;

            $q = 'SELECT * FROM links' . $where;
            $links = $this->db->query($q)->fetchAll(PDO::FETCH_ASSOC);
            if(!$links) return false;

            foreach ($links as &$link){
                preg_match('/^(https?:\/\/)|^(\/\/)/', $link['link'], $matches);
                if(!$matches) $link['url'] = '//' . $link['link'];
                else $link['url'] = $link['link'];
            }
            return $links;
        }

        public function delete($id)
        {
            $q = 'DELETE FROM links WHERE id=' . $id;

            if(!$this->db->query($q)){
                $this->set_status('Ошибка!');
                return false;
            }

            $this->set_status('Ссылка успешно удалена!');
            return true;
        }

        public function update($data)
        {
            if(empty($data['id'])){
                $this->set_status('Ссылка не найдена!');
                return false;
            }
            if(empty($data['link'])){
                $this->set_status('Поле "Ссылка" должно быть заполнено.');
                return false;
            }

            $id          = $data['id'];
            $link        = isset($data['link']) ? $data['link'] : '';
            $title       = isset($data['title']) ? /*$this->db->quote(*/$data['title'] : $data['link'];
            $description = isset($data['description']) ? /*$this->db->quote(*/$data['description'] : '';
            $private     = isset($data['private']) ? '1' : '0';

            $q = 'UPDATE links SET title="' . $title . '", link="' . $link . '", description="' . $description . '", private=' . $private . '  WHERE id=' . $id;

            if(!$this->db->query($q)){
                $this->set_status('Ошибка!');
                return false;
            }

            $this->set_status('Ссылка успешно обновлена!');
            return true;
        }
    }