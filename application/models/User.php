<?php

class User extends MY_Model{
    function __construct() {
        parent::__construct();
    }
 
    function inserir($data) {
        return $this->db->insert('user', $data);
    }
 
    function listar() {
            $query = $this->db->get('user');
            return $query->result();
    }
}
