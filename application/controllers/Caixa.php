<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Caixa extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->setTitle('Aline Rosa | Caixa');
        $this->setSector('Caixa');
        $this->dados['sector'] = $this->getSector();
        $this->setModel('CaixaMov', 'caixa_model');

        //$this->load->model('Model', '', TRUE);
        $this->dados['url'] = $this->url;
        $this->dados['current'] = 'Caixa';

        $sidebar = new Sidebar();
        if ($this->caixa_model->listar()) {
            $sidebar->setSidebar('Fechar Caixa', base_url('caixa/fechar'));
        } else {
            $sidebar->setSidebar('Abrir Caixa', base_url('caixa/abrir'));
        }

        $sidebar->setSidebar('Nova Entrada', base_url('caixa/entrada'));
        $sidebar->setSidebar('Nova Saida', base_url('caixa/saida'));


        $this->dados['sidebar'] = $sidebar->getSidebar();
    }

    public function hoje() {
        $hoje = $this->caixa_model->hoje();
        if ($hoje) {
            $this->dados['acao'] = 'Hoje';

            $form = form_open('#', array('class' => 'niceform'));
            $form .= '<table class="cadForm">';

            $this->dados['infos'] = $this->caixa_model->listar();
            $dadosCaixa = $this->dados['infos'][0];

            $form .= '<tr>';
            $form .= '<td>';
            $form .= form_label('Saldo inicial*:', '', array('for' => 'email'));
            $form .= form_input('caixa_saldo_inicial', $dadosCaixa['caixa_saldo_inicial'], array('size' => 30, 'disabled' => 'disabled'));
            $form .= '</td>';
            $form .= '<td>';
            $form .= form_label('Data:', '', array('for' => 'email'));
            $form .= form_input('caixa_data', date('d/m/Y'), array('size' => 30, 'class' => 'formDate', 'disabled' => 'disabled'));
            $form .='</td>';
            $form .= '</tr>';
            $form .= '<tr>';
            $form .= '<td>';
            $form .= form_hidden('caixa_id', $dadosCaixa['caixa_id']);
            $form .= form_hidden('caixa_saldo_inicial', $dadosCaixa['caixa_saldo_inicial']);
            $form .= '</td>';
            $form .= '<td>';
            $form .= '</td>';
            $form .= '</tr>';
            $form .= '</table>';
            $form .= form_close();

            $this->load->model('Movimentacao', 'mov_model');
            $this->dados['totalEntradas'] = $this->mov_model->listEntradas($dadosCaixa['caixa_id'], array('mov_id', 'mov_hora', 'mov_valor', 'mov_desc'));
            $this->dados['totalSaidas'] = $this->mov_model->listSaidas($dadosCaixa['caixa_id'], array('mov_id', 'mov_hora', 'mov_valor', 'mov_desc'));

            $this->dados['form'] = $form;
            $this->load->view('caixa_hoje', $this->dados);
        } else {
            $this->dados['campos_tabela'] = array('Caixa_ID', 'Caixa_Data', 'Caixa_Hora_Abertura', 'Caixa_Hora_Fechamento', 'Caixa_Saldo_Inicial', 'Caixa_Saldo_Final');
            $this->dados['lista'] = $this->caixa_model->extrato($this->dados['campos_tabela']);

            $this->load->view('caixa_extrato', $this->dados);
        }
    }

    public function abrir() {
        $form = form_open('#', array('class' => 'niceform'));
        $form .= '<table class="cadForm">';

        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Saldo inicial* (R$):', '', array('for' => 'email'));
        $form .= form_input('caixa_saldo_inicial', '', array('size' => 30, 'class' => 'formDin'));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Data:', '', array('for' => 'email'));
        $form .= form_input('caixa_data', date('d/m/Y'), array('size' => 30, 'class' => 'formDate'));
        $form .='</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td></td>';
        $form .= '<td>';
        $form .= form_submit('cadastrar', 'Abrir Caixa', 'id="submit"');
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '</table>';
        $form .= form_close();
        $form .= '<span class="obs">*Todos os campos obrigatórios.</span><br/><br/>';

        $this->dados['acao'] = 'Abrir';
        $this->dados['form'] = $form;
        $this->load->view('caixa_hoje', $this->dados);
    }

    public function fechar() {
        $form = form_open('#', array('class' => 'niceform'));
        $form .= '<table class="cadForm">';

        $this->dados['infos'] = $this->caixa_model->listar();
        $dadosCaixa = $this->dados['infos'][0];

        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Saldo inicial*:', '', array('for' => 'email'));
        $form .= form_input('caixa_saldo_inicial', $dadosCaixa['caixa_saldo_inicial'], array('size' => 30, 'disabled' => 'disabled'));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Data:', '', array('for' => 'email'));
        $form .= form_input('caixa_data', date('d/m/Y'), array('size' => 30, 'class' => 'formDate', 'disabled' => 'disabled'));
        $form .='</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_hidden('caixa_id', $dadosCaixa['caixa_id']);
        $form .= form_hidden('caixa_saldo_inicial', $dadosCaixa['caixa_saldo_inicial']);
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_submit('cadastrar', 'Fechar Caixa', 'id="submit"');
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '</table>';
        $form .= form_close();

        $this->load->model('Movimentacao', 'mov_model');
        $this->dados['totalEntradas'] = $this->mov_model->listEntradas($dadosCaixa['caixa_id'], array('mov_id', 'mov_hora', 'mov_valor', 'mov_desc'));
        $this->dados['totalSaidas'] = $this->mov_model->listSaidas($dadosCaixa['caixa_id'], array('mov_id', 'mov_hora', 'mov_valor', 'mov_desc'));

        $this->dados['acao'] = 'Fechar';
        $this->dados['form'] = $form;
        $this->load->view('caixa_hoje', $this->dados);
    }

    public function enviar() {
        $dados = $_POST;
        $msg = '';
        $abrirfechar = (!empty($_POST['caixa_id']) ? 'fechar' : 'abrir');

        if (in_array('', $dados)) {
            $msg = "Todos os campos são obrigatórios.";
        }

        /* Valores padrões */
        if ($abrirfechar == 'abrir') {
            $dados['caixa_hora_abertura'] = date('h:i');
        } else {
            $dados['caixa_hora_fechamento'] = date('h:i');

            $this->load->model('Movimentacao', 'mov_model');
            $dados['caixa_total_entradas'] = $this->mov_model->getEntradas($dados['caixa_id']);
            $dados['caixa_total_saidas'] = $this->mov_model->getSaidas($dados['caixa_id']);
            $dados['caixa_saldo_final'] = $dados['caixa_saldo_inicial'] + $dados['caixa_total_entradas'] - $dados['caixa_total_saidas'];
        }

        if ($msg !== '') {
            $msgError = array("msg" => "alert", "text" => $msg);
            echo json_encode($msgError);
        } else {

            switch ($abrirfechar) {
                case 'fechar':
                    $editCadExec = $this->caixa_model->fechar($dados['caixa_id'], $dados);
                    $action = ' fechado';
                    break;
                case 'abrir':
                    $editCadExec = $this->caixa_model->abrir($dados);
                    $action = ' aberto';
                    break;
            }

            if ($editCadExec) {
                $msg = array("msg" => "sucess", "text" => 'Caixa ' . $action . ' com sucesso!');
                echo json_encode($msg);
            } else {
                $msg = array("msg" => "error", "text" => 'Ocorreu algum erro no processo, caixa não foi' . $action . ' corretamente.');
                echo json_encode($msg);
            }
        }

        exit();
    }

    public function listar() {
        $this->dados['campos_tabela'] = array('Caixa_ID', 'Caixa_Data', 'Caixa_Hora_Abertura', 'Caixa_Hora_Fechamento', 'Caixa_Saldo_Inicial', 'Caixa_Saldo_Final');
        $this->dados['lista'] = $this->caixa_model->extrato($this->dados['campos_tabela']);

        $this->load->view('caixa_extrato', $this->dados);
    }

    public function saida() {
        $form = form_open('#', array('class' => 'caixaForm'));
        $form .= '<table class="cadForm">';

        $this->dados['infos'] = $this->caixa_model->listar();
        if ($this->dados['infos']) {
            $dadosCaixa = $this->dados['infos'][0];
        } else {
            redirect('caixa/hoje');
        }

        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Valor* (R$):', '', array('for' => 'email'));
        $form .= form_input('mov_valor', '', array('size' => 30, 'class' => 'formDin'));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td colspan="2" class="duplo">';
        $form .= form_label('Descrição*:', '', array('for' => 'email'));
        $form .= form_textarea('mov_desc', '', '', array('cols' => 43, 'rows' => 3));
        $form .='</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_hidden('caixa_id', $dadosCaixa['caixa_id']);
        $form .= form_hidden('mov_tipo', 'saida');
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_submit('lancar', 'Lançar', 'id="submit"');
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '</table>';
        $form .= form_close();

        $this->load->model('Movimentacao', 'mov_model');
        $this->dados['totalEntradas'] = $this->mov_model->listEntradas($dadosCaixa['caixa_id'], array('mov_id', 'mov_hora', 'mov_valor', 'mov_desc'));
        $this->dados['totalSaidas'] = $this->mov_model->listSaidas($dadosCaixa['caixa_id'], array('mov_id', 'mov_hora', 'mov_valor', 'mov_desc'));

        $this->dados['acao'] = 'Nova saida';
        $this->dados['form'] = $form;
        $this->load->view('caixa_hoje', $this->dados);
    }

    public function entrada() {
        $form = form_open('#', array('class' => 'caixaForm'));
        $form .= '<table class="cadForm">';

        $this->dados['infos'] = $this->caixa_model->listar();
        if ($this->dados['infos']) {
            $dadosCaixa = $this->dados['infos'][0];
        } else {
            redirect('caixa/hoje');
        }

        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Valor* (R$):', '', array('for' => 'email'));
        $form .= form_input('mov_valor', '', array('size' => 30, 'class' => 'formDin'));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td colspan="2" class="duplo">';
        $form .= form_label('Descrição*:', '', array('for' => 'email'));
        $form .= form_textarea('mov_desc', '', '', array('cols' => 43, 'rows' => 3));
        $form .='</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_hidden('caixa_id', $dadosCaixa['caixa_id']);
        $form .= form_hidden('mov_tipo', 'entrada');
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_submit('lancar', 'Lançar', 'id="submit"');
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '</table>';
        $form .= form_close();

        $this->load->model('Movimentacao', 'mov_model');
        $this->dados['totalEntradas'] = $this->mov_model->listEntradas($dadosCaixa['caixa_id'], array('mov_id', 'mov_hora', 'mov_valor', 'mov_desc'));
        $this->dados['totalSaidas'] = $this->mov_model->listSaidas($dadosCaixa['caixa_id'], array('mov_id', 'mov_hora', 'mov_valor', 'mov_desc'));

        $this->dados['acao'] = 'Nova entrada    ';
        $this->dados['form'] = $form;
        $this->load->view('caixa_hoje', $this->dados);
    }

    public function lancar() {
        $dados = $_POST;
        $msg = '';

        if (in_array('', $dados)) {
            $msg = "Todos os campos são obrigatórios.";
        }

        /* Valores padrões */
        $tipo = $dados['mov_tipo'];
        $dados['mov_hora'] = date('h:i');
        $dados['mov_idcaixa'] = $dados['caixa_id'];
        unset($dados['caixa_id']);

        if ($msg !== '') {
            $msgError = array("msg" => "alert", "text" => $msg);
            echo json_encode($msgError);
        } else {
            $this->load->model('Movimentacao', 'mov_model');
            $lacamento = $this->mov_model->lancar($dados);

            if ($lacamento) {
                $msg = array("msg" => "sucess", "text" => 'Valor lançado com sucesso!');
                echo json_encode($msg);
            } else {
                $msg = array("msg" => "error", "text" => 'Ocorreu algum erro no processo, não foi possível completar a transação.');
                echo json_encode($msg);
            }
        }

        exit();
    }

}
