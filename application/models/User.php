<?php

class User extends MY_Model{
    function __construct() {
        parent::__construct();
        
        $this->setTable('user');
    }
 
    function inserir($data) {
        return $this->db->insert($this->table, $data);
    }
 
    function listar($id = '', $campos = '*') {
        $query = $this->db->select($campos);
        if($id !== ''){
            $query = $this->db->get_where($this->table, array('id' => $id));
        }else{
            $query = $this->db->get($this->table);
        }

        return $query->result_array();
            
    }
    
    public function excluir($id) {  
        return $this->db->delete($this->table, array('id' => $id));
    }
}
