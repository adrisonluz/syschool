<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Padrao extends MY_Controller {
    public $dados;


    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $dados['teste'] = 'teste';
        
        $this->load->view('padrao', $dados);
    }
}
