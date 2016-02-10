<?php

class Contrato extends MY_Model{
    function __construct() {
        parent::__construct();
        
        $this->setTable('contratos');
    }
 
    function inserir($data) {
        return $this->db->insert($this->table, $data);
    }
 
    public function editar($id,  $campos) {
        return $this->db->update($this->table, $campos, array('id' => $id));
    }
    
    function listar($id = '', $campos = '*') {          
        if($id == ''){
            $query = $this->db->select('ctr.id');
            $query = $this->db->from('contratos ctr','','LEFT');
            $query = $this->db->join('user',  'ctr.id_aluno = user.id');
        }else{
            $query = $this->db->select($campos);
            $query = $this->db->where('id',$id);
            $query = $this->db->from($this->table);
            $query = $this->db->join('user',  $this->table.'id_aluno = user.id');
        }

        return $query->get();
            
    }
        
    public function excluir($id) {  
        return $this->db->delete($this->table, array('id' => $id));
    }
}
