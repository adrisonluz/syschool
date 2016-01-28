<?php (defined('BASEPATH')) OR exit('No direct script access allowed');


class MY_Model extends CI_Model {
    public $table;
            
    function __construct() {
        parent::__construct();
    }
    
    public function setTable($nome) {
        $this->table = $nome;
    }
    
    public function getTable() {
        return $this->table;
    }
}