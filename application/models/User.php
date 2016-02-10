<?php

class User extends MY_Model{
    function __construct() {
        parent::__construct();
        
        $this->setTable('user');
    }
                
    function inserir($data) {
        $this->logs->setTableOrigin('alunos');
        $this->logs->setAcao('INSERIR');
        $this->logs->setCamposVal($data);
        $this->logs->setCodigo('INSERT INTO');
        $this->logs->inserir();
        
        return $this->db->insert($this->table, $data);
    }
 
    public function editar($id,  $campos) {
        $this->logs->setTableOrigin('alunos');
        $this->logs->setAcao('EDITAR');
        $this->logs->setCamposVal($campos);
        $this->logs->setCodigo('UPDATE');
        $this->logs->inserir();
        
        return $this->db->update($this->table, $campos, array('id' => $id));
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
        $query = $this->db->get_where($this->table, array('id' => $id));
        $campos = $query->result_array();
        $this->logs->setTableOrigin('alunos');
        $this->logs->setAcao('EXCLUIR');
        $this->logs->setCamposVal($campos[0]);
        $this->logs->setCodigo('DELETE');
        $this->logs->inserir();
        
        return $this->db->delete($this->table, array('id' => $id));
    }
}
