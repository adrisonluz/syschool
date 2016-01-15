<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turmas extends MY_Controller {
    public $dados;


    public function __construct() {
        parent::__construct();
        
        //$this->load->model('Model', '', TRUE);
        $this->dados['url'] = $this->url;
        $this->dados['current'] = 'turmas';
    
        $this->dados['sidebar'][] = array(
            'titulo'    =>  'Nova Turma',
            'link'      =>  'cadastro',
            'submenu'   =>  false
        );
        
        $this->dados['sidebar'][] = array(
            'titulo'    =>  'Relatórios',
            'link'      =>  '#',
            'submenu'   =>  array(
                array(
                    'titulo'    =>  'Financeiro',
                    'link'      =>  'relatorio/financeiro'
                    ),
                array(
                    'titulo'    =>  'Horários',
                    'link'      =>  'relatorio/horários'
                    )
            )
        );
    }
    
    public function listar()
    {              
        $this->load->view('listar', $this->dados);
    }
    
    public function cadastro()
    {
        $this->load->view('cadastro', $this->dados);
    }
    
    public function relatorio()
    {
        $this->load->view('relatorio', $this->dados);
    }
}
