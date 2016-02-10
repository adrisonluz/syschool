<?php

class Logs extends MY_Model{
    public $tableOrigin;
    public $campos = array();
    public $valores = array();
    public $acao;
    public $data;
    public $id_agent;
    public $codigo;
    
    function __construct() {
        parent::__construct();
        $this->data = date('d/m/Y H:i');
        //$this->id_agent = $user['id'];
        $this->id_agent = 1;
        
        $this->setTable('logs');
    }
 
    function inserir() {        
        return $this->db->insert($this->table, array(
            'tabela' => $this->tableOrigin,
            'acao' => $this->acao,
            'campos' => implode(', ', $this->campos),
            'valores' => implode(', ', $this->valores),
            'id_agent' => $this->id_agent,
            'data_modificacao' => $this->data,
            'codigo' => $this->codigo
        ));
    }
    
    function listar() {
        $query = $this->db->get($this->table);

        return $query->result_array();
            
    }
    
    public function setTableOrigin($table) {
        $this->tableOrigin = $table;
    }
    
    public function setCamposVal($camposVal) {
        foreach ($camposVal as $key => $val){
            $this->campos[] = $key;
            $this->valores[] = $val;
        }
    }
    
    public function setAcao($acao) {
        $this->acao = $acao;
    }
    
    public function setCodigo($codigo) {
        $this->codigo = $codigo;
    }
}
