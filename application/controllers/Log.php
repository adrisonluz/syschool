<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->setTitle('Aline Rosa | Logs');
        $this->setSector('Logs');
        $this->dados['sector'] = $this->getSector();
        $this->setModel('Logs', 'logs_model');

        //$this->load->model('Model', '', TRUE);
        $this->dados['url'] = $this->url;
        $this->dados['current'] = 'Logs';

        $sidebar = new Sidebar();
        $sidebar->setSidebar('Novo Aluno', base_url('alunos/cadastro'));
        $sidebar->setSidebar('Contratos', base_url('contratos/listar'));
        $sidebar->setSidebar('Logs', base_url('logs/listar'));

        $sidebar->setSubmenu('Financeiro', base_url('relatorios/financeiro'));
        $sidebar->setSubmenu('Horarios', base_url('relatorios/horarios'));
        $sidebar->setSidebar('Relatórios', '#', $sidebar->getSubmenu());

        $this->dados['sidebar'] = $sidebar->getSidebar();
    }

    public function listar() {
        $this->dados['campos_tabela'] = array('id', 'Tabela', 'Acao', 'Campos', 'Valores', 'id_agent', 'data_modificacao');
        $this->dados['lista'] = $this->logs_model->listar($this->id, $this->dados['campos_tabela']);

        $this->load->view('listar', $this->dados);
    }

}
