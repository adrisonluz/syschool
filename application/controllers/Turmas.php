<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Turmas extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->setTitle('Aline Rosa | Turmas');
        $this->setSector('Turmas');
        $this->dados['sector'] = $this->getSector();
        $this->setModel('Turma', 'turma_model');

        //$this->load->model('Model', '', TRUE);
        $this->dados['url'] = $this->url;
        $this->dados['current'] = 'Turmas';

        $sidebar = new Sidebar();
        $sidebar->setSidebar('Nova Turma', base_url('turmas/cadastro'));
        $sidebar->setSidebar('Cursos', base_url('cursos/listar'));
        $sidebar->setSidebar('Lixeira', base_url('lixeira/turmas'));
        $sidebar->setSidebar('Logs', base_url('logs/turmas'));

        $this->dados['sidebar'] = $sidebar->getSidebar();
    }

    public function listar() {
        $this->dados['campos_tabela'] = array('turma_id', 'curso_nome', 'turma_dias', 'turma_horario', 'turma_vagas');
        $this->dados['lista'] = $this->turma_model->listar($this->id, $this->dados['campos_tabela']);

        $i = 0;
        foreach ($this->dados['lista'] as $listVagas) {
            $matriculados = $this->turma_model->getMatriculados($listVagas['turma_id']);
            $this->dados['lista'][$i]['turma_vagas'] = $this->dados['lista'][$i]['turma_vagas'] - $matriculados;
            if ($this->dados['lista'][$i]['turma_vagas'] == 0) {
                $this->dados['lista'][$i]['turma_vagas'] = 'Lotado';
            }
            $i++;
        }
        $this->load->view('listar', $this->dados);
    }

    public function cadastro() {
        $form = form_open('#', array('class' => 'niceform'));
        $form .= '<table class="cadForm">';

        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Professor*:', '', array('for' => 'email'));

        $this->load->model('User', 'user_model', TRUE);
        $alunosResult = $this->user_model->getProfessor('', 'nome, id');
        foreach ($alunosResult as $alunosList => $list) {
            $alunos[] = $list;
        }

        $option[] = array(0 => 'Selecione um professor:');
        foreach ($alunos as $keys => $valores) {
            $option[] = array($valores['id'] => $valores['nome']);
        }
        $form .= form_dropdown('turma_idprof', $option, '', array('size' => 1, 'style' => 'width: 210px;'));

        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Curso*:', '', array('for' => 'email'));

        $this->load->model('Curso', 'curso_model', TRUE);
        $cursosResult = $this->curso_model->listar('', 'curso_id, curso_nome');
        foreach ($cursosResult as $cursosList => $list) {
            $cursos[] = $list;
        }
        $optionCurso[] = array(0 => 'Selecione um curso:');
        foreach ($cursos as $keys => $valores) {
            $optionCurso[] = array($valores['curso_id'] => $valores['curso_nome']);
        }
        $form .= form_dropdown('turma_idcurso', $optionCurso, '', array('size' => 1, 'style' => 'width: 210px;'));

        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Dias*:', '', array('for' => 'email'));
        $form .= form_input('turma_dias', '', array('size' => 30));
        $form .='</td>';
        $form .= '<td>';
        $form .= form_label('Horário*:', '', array('for' => 'email'));
        $form .= form_input('turma_horario', '', array('size' => 30));
        $form .='</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('N° vagas*:', '', array('for' => 'email'));
        $form .= form_input('turma_vagas', '', array('size' => 10, 'style' => 'width:50px;'));
        $form .='</td>';
        $form .= '<td>';
        $form .= form_label('Aulas dadas:', '', array('for' => 'email'));
        $form .= form_input('turma_aulas_dadas', ' ', array('size' => 10, 'style' => 'width:50px;'));
        $form .='</td>';
        $form .= '</tr>';
        $form .='<tr>';
        $form .= '<td></td>';
        $form .='<td>';
        $form .= form_label('Valor da mensalidade* (R$):', '', array('for' => 'email'));
        $form .= form_input('turma_mensalidade', '', array('size' => 20, 'class' => 'formDin', 'style' => 'width:80px;'));
        $form .='</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td></td>';
        $form .= '<td>';
        $form .= form_submit('cadastrar', 'Enviar', 'id="submit"');
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '</table>';
        $form .= form_close();
        $form .= '<span class = "obs">*Campos são obrigatórios.</span>';

        $this->dados['form'] = $form;
        $this->load->view('cadastro', $this->dados);
    }

    public function editar() {
        if (!$this->dados['infos'] = $this->turma_model->listar($this->id)) {
            redirect('../turmas/listar');
        }

        $this->load->model('User', 'user_model', TRUE);
        $this->load->model('Curso', 'curso_model', TRUE);

        $dadosTurma = $this->dados['infos'][0];
        $professorResult = $this->user_model->listar($dadosTurma['turma_idprof'], 'nome');
        $cursoResult = $this->curso_model->listar($dadosTurma['turma_idcurso'], 'curso_nome');

        $curso = $cursoResult[0];
        $professor = $professorResult[0];

        $form = form_open('#', array('class' => 'niceform'));
        $form .= '<table class="cadForm">';

        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Dias*:', '', array('for' => 'email'));
        $form .= form_input('turma_dias', $dadosTurma['turma_dias'], array('size' => 30));
        $form .='</td>';
        $form .= '<td>';
        $form .= form_label('Horário*:', '', array('for' => 'email'));
        $form .= form_input('turma_horario', $dadosTurma['turma_horario'], array('size' => 30));
        $form .= form_hidden('turma_id', $dadosTurma['turma_id']);
        $form .= form_hidden('lixeira', $dadosTurma['lixeira']);
        $form .='</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('N° vagas*:', '', array('for' => 'email'));
        $form .= form_input('turma_vagas', $dadosTurma['turma_vagas'], array('size' => 10, 'style' => 'width:50px;'));
        $form .='</td>';
        $form .= '<td>';
        $form .= form_label('Aulas dadas:', '', array('for' => 'email'));
        $form .= form_input('turma_aulas_dadas', $dadosTurma['turma_aulas_dadas'], array('size' => 10, 'style' => 'width:50px;'));
        $form .='</td>';
        $form .= '</tr>';
        $form .='<tr>';
        $form .= '<td></td>';
        $form .='<td>';
        $form .= form_label('Valor da mensalidade* (R$):', '', array('for' => 'email'));
        $form .= form_input('turma_mensalidade', $dadosTurma['turma_mensalidade'], array('size' => 20, 'class' => 'formDin', 'style' => 'width:80px;'));
        $form .='</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td></td>';
        $form .= '<td>';
        $form .= form_submit('cadastrar', 'Enviar', 'id="submit"');
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '</table>';
        $form .= form_close();
        $form .= '<span class = "obs">*Campos são obrigatórios.</span>';

        $this->dados['infos'][0]['curso_nome'] = $curso['curso_nome'] . ' (' . $professor['nome'] . ')';
        $this->dados['form'] = $form;
        $this->load->view('editar', $this->dados);
    }

    public function enviar() {
        $dados = $_POST;
        $msg = '';
        $editCad = (!empty($_POST['turma_id']) ? 'edit' : 'cad');

        $importantes = array(
            'turma_idprof' => 'Professor:',
            'turma_idcurso' => 'Curso:',
            'turma_vagas' => 'N° de vagas:',
            'turma_dias' => 'Dias:',
            'turma_horario' => 'Horario:',
            'turma_mensalidade' => 'Valor da mensalidade (R$):'
        );

        foreach ($importantes as $indice => $real) {
            $listaImportantes[] = $indice;
        }

        foreach ($dados as $campo => $valor) {
            if ($valor == '' AND in_array($campo, $listaImportantes)) {
                $msg .= "O campo \"$importantes[$campo]\" é obrigatório. <br/>";
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
                    $editCadExec = $this->turma_model->editar($dados['turma_id'], $dados);
                    $action = ' editada';
                    break;
                case 'cad':
                    $editCadExec = $this->turma_model->inserir($dados);
                    $action = ' cadastrada';
                    break;
            }

            if ($editCadExec) {
                $msg = array("msg" => "sucess", "text" => 'Turma ' . $action . ' com sucesso!');
                echo json_encode($msg);
            } else {
                $msg = array("msg" => "error", "text" => 'Ocorreu algum erro no processo, a turma não foi' . $action . ' corretamente.');
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

    public function perfil() {
        if ($this->id == '') {
            redirect('../turmas/listar');
        }

        $this->dados['perfil'] = $this->user_model->listar($id);
        $this->load->view('perfil', $this->dados);
    }

    public function delete() {
        if ($this->turma_model->excluir($this->id)) {
            $msg = array("msg" => "sucess", "text" => 'Excluído com sucesso!');
        } else {
            $msg = array("msg" => "error", "text" => 'Houve um erro ao tentar excluir.');
        }
        echo json_encode($msg);
        exit();
    }

    public function consultaTurma() {
        $idConsult = $_POST['turma_id'];

        $turmaResult = $this->turma_model->listar($idConsult);
        $turma = $turmaResult[0];

        foreach ($turma as $key => $val) {
            $msg[$key] = $val;
        }

        echo json_encode($msg);
        exit();
    }

}
