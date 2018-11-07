<?php

    class Links_model extends Model
    {
        public function add($data)
        {
            if (empty($data)) return false;

            $link        = /*$this->db->quote(*/$data['link'];
            $title       = !empty($data['title']) ? /*$this->db->quote(*/$data['title'] : $data['link'];
            $description = !empty($data['description']) ? /*$this->db->quote(*/$data['description'] : '';
            $private     = isset($data['private']) ? '1' : '0';

            $q = 'INSERT INTO links (title, link, description, private, user) values ("' . $title . '","' . $link . '","' . $description . '",' . $private . ', 0);';
            if(!$this->db->query($q)) return 'error';
            else return 'success';
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
            return $this->db->query($q);
        }

        public function update($data)
        {
            if(empty($data['id']) || empty($data['link'])) return false;

            $id          = $data['id'];
            $link        = isset($data['link']) ? $data['link'] : '';
            $title       = isset($data['title']) ? /*$this->db->quote(*/$data['title'] : $data['link'];
            $description = isset($data['description']) ? /*$this->db->quote(*/$data['description'] : '';
            $private     = isset($data['private']) ? '1' : '0';

            $q = 'UPDATE links SET title="' . $title . '", link="' . $link . '", description="' . $description . '", private=' . $private . '  WHERE id=' . $id;
            return $this->db->query($q);
        }
    }