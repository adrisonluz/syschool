<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alunos extends MY_Controller {
    public $dados;

    public function __construct() {
        parent::__construct();
        
        $this->setTitle('Aline Rosa | Alunos');
        $this->setSector('Alunos');
        $this->dados['sector'] = $this->getSector();
        
        //$this->load->model('Model', '', TRUE);
        $this->dados['url'] = $this->url;
        $this->dados['current'] = 'alunos';
    
        $this->dados['sidebar'][] = array(
            'titulo'    =>  'Novo Aluno',
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
        if(!empty($_GET['id'])){
            
        }else{
            
        }
        
        
        $this->load->view('listar', $this->dados);
    }
    
    public function cadastro()
    {
        $form = form_open('', array('class' => 'niceform')); 
        $form .= form_fieldset();
        $form .= '<dl>';
        $form .= '<dt>';
        $form .= form_label('Nome:', '' , array('for' => 'email'));
        $form .= '</dt>';
        $form .= '<dt>';
        $form .= form_input('', '', array('size'=> 31));
        $form .= '</dt>';
        $form .= '</dl>';
        $form .= '<dl>';
        $form .= '<dt>';
        $form .= form_label('RG:', '' , array('for' => 'email'));
        $form .= '</dt>';
        $form .= '<dt>';
        $form .= form_input('', '', array('size'=> 31));
        $form .= '</dt>';
        $form .= '</dl>';
        $form .= form_fieldset_close();
        
        /*
         * Idade
         * RG
         * CPF
         * Data Nasc
         * Email
         * Telefone Res
         * Telefone Cel
         * Login
         * Senha
         * Endereço
         * Bairro
         * Cidade
         * CEP
         * Nome Pai
         * Celular Pai
         * Nome Mãe
         * Celular Mãe
         * Email Responsável
         * Contrato e boletos em nome de:
         * CPF
         * Apresenta algum problema de saúde? Qual??
         * Tem algum tipo de alergia? Qual?
         * Toma algum medicamento ? Qual?
         */
        
        $form .= form_close(); 
        
        $this->dados['form'] = $form;
        $this->load->view('cadastro', $this->dados);
    }
    
    public function relatorio()
    {
        $this->load->view('relatorio', $this->dados);
    }
}
