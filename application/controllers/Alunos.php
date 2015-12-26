<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alunos extends MY_Controller {
    public $dados;


    public function __construct() {
        parent::__construct();
        
        //$this->load->model('Model', '', TRUE);
        $dados['url'] = $this->url;
    }
    
    public function listar()
    {
        $dados['teste'] = 'teste';
        $this->load->view('listar', $dados);
    }
    
    public function cadastro()
    {
        $dados['teste'] = 'teste';
        $this->load->view('cadastro', $dados);
    }
    
    public function relatorio()
    {
        $dados['teste'] = 'teste';
        $this->load->view('relatorio', $dados);
    }
}
