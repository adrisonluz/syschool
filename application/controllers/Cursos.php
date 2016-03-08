<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cursos extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->setTitle('Aline Rosa | Cursos');
        $this->setSector('Cursos');
        $this->dados['sector'] = $this->getSector();
        $this->setModel('Curso', 'curso_model');

        //$this->load->model('Model', '', TRUE);
        $this->dados['url'] = $this->url;
        $this->dados['current'] = 'Cursos';

        $sidebar = new Sidebar();
        $sidebar->setSidebar('Nova Turma', base_url('turmas/cadastro'));
        $sidebar->setSidebar('Cursos', base_url('cursos/listar'));
        $sidebar->setSidebar('Lixeira', base_url('lixeira/cursos'));
        $sidebar->setSidebar('Logs', base_url('logs/cursos'));

        $this->dados['sidebar'] = $sidebar->getSidebar();
    }

    public function listar() {
        $this->dados['campos_tabela'] = array('curso_id', 'curso_nome', 'curso_qtd_aulas',);
        $this->dados['lista'] = $this->curso_model->listar($this->id, $this->dados['campos_tabela']);

        $this->load->view('listar', $this->dados);
    }

    public function cadastro() {
        $form = form_open('#', array('class' => 'niceform'));
        $form .= '<table class="cadForm">';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Nome:', '', array('for' => 'email'));
        $form .= form_input('curso_nome', '', array('size' => 30));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Quantidade de aulas:', '', array('for' => 'email'));
        $form .= form_input('curso_qtd_aulas', '', array('size' => 20));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td></td>';
        $form .= '<td>';
        $form .= form_submit('cadastrar', 'Enviar', 'id="submit"');
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '</table>';
        $form .= form_close();
        $form .= '<span class="obs">Todos os campos são obrigatórios.</span>';

        $this->dados['form'] = $form;
        $this->load->view('cadastro', $this->dados);
    }

    public function editar() {
        if (!$this->dados['infos'] = $this->curso_model->listar($this->id)) {
            redirect('../cursos/listar');
        }

        $dadosCurso = $this->dados['infos'][0];

        $form = form_open('#', array('class' => 'niceform'));
        $form .= '<table class="cadForm">';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Nome:', '', array('for' => 'email'));
        $form .= form_input('curso_nome', $dadosCurso['curso_nome'], array('size' => 30));
        $form .= form_hidden('curso_id', $dadosCurso['curso_id']);
        $form .= form_hidden('lixeira', $dadosCurso['lixeira']);
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Quantidade de aulas:', '', array('for' => 'email'));
        $form .= form_input('curso_qtd_aulas', $dadosCurso['curso_qtd_aulas'], array('size' => 20));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td></td>';
        $form .= '<td>';
        $form .= form_submit('cadastrar', 'Enviar', 'id="submit"');
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '</table>';
        $form .= form_close();
        $form .= '<span class="obs">Todos os campos são obrigatórios.</span>';

        $this->dados['form'] = $form;
        $this->load->view('editar', $this->dados);
    }

    public function enviar() {
        $dados = $_POST;
        $msg = '';
        $editCad = (!empty($_POST['curso_id']) ? 'edit' : 'cad');

        $importantes = array(
            'curso_nome' => 'Nome:',
            'curso_qtd_aulas' => 'Quantidade de aulas:'
        );


        foreach ($importantes as $indice => $real) {
            $listaImportantes[] = $indice;
        }

        foreach ($dados as $campo => $valor) {
            if ($valor == '' AND in_array($campo, $listaImportantes)) {
                $msg = "Todos os campos são obrigatórios.";
            }
        }

        /* Valores padrões */
        $dados['lixeira'] = ($editCad == 'edit' ? $dados['lixeira'] : 0);

        if ($msg !== '') {
            $msgError = array("msg" => "alert", "text" => $msg);
            echo json_encode($msgError);
        } else {

            switch ($editCad) {
                case 'edit':
                    $editCadExec = $this->curso_model->editar($dados['curso_id'], $dados);
                    $action = ' editado';
                    break;
                case 'cad':
                    $editCadExec = $this->curso_model->inserir($dados);
                    $action = ' cadastrado';
                    break;
            }

            if ($editCadExec) {
                $msg = array("msg" => "sucess", "text" => $dados['curso_nome'] . $action . ' com sucesso!');
                echo json_encode($msg);
            } else {
                $msg = array("msg" => "error", "text" => 'Ocorreu algum erro no processo, ' . $dados['curso_nome'] . ' não foi' . $action . ' corretamente.');
                echo json_encode($msg);
            }
        }

        exit();
    }

    public function relatorio() {
        $lista = $this->get();

        $this->dados['lista'] = $lista;
        $this->load->view('relatorio', $this->dados);
    }

    public function delete() {
        if ($this->curso_model->excluir($this->id)) {
            $msg = array("msg" => "sucess", "text" => 'Excluído com sucesso!');
        } else {
            $msg = array("msg" => "error", "text" => 'Houve um erro ao tentar excluir.');
        }
        echo json_encode($msg);
        exit();
    }

}
