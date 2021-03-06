<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Alunos extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->setTitle('Aline Rosa | Alunos');
        $this->setSector('Alunos');
        $this->dados['sector'] = $this->getSector();
        $this->setModel('User', 'user_model');

        //$this->load->model('Model', '', TRUE);
        $this->dados['url'] = $this->url;
        $this->dados['current'] = 'Alunos';

        $sidebar = new Sidebar();
        $sidebar->setSidebar('Novo Aluno', base_url('alunos/cadastro'));

        if (!empty($this->id)) {
            $this->load->model('Contrato', 'contrato_model', TRUE);
            if ($contrato = $this->contrato_model->listaIdAluno($this->id)) {
                $sidebar->setSidebar('Contratos', base_url('contratos/editar/id/' . $contrato[0]['id_contrato']));
            } else {
                $sidebar->setSidebar('Contratos', base_url('contratos/listar'));
            }
        } else {
            $sidebar->setSidebar('Contratos', base_url('contratos/listar'));
        }
        $sidebar->setSidebar('Lixeira', base_url('lixeira/alunos'));
        $sidebar->setSidebar('Logs', base_url('logs/alunos'));

        $sidebar->setSubmenu('Financeiro', base_url('relatorios/financeiro'));
        $sidebar->setSubmenu('Horarios', base_url('relatorios/horarios'));
        $sidebar->setSidebar('Relatórios', '#', $sidebar->getSubmenu());

        $this->dados['sidebar'] = $sidebar->getSidebar();
    }

    public function listar() {
        $this->dados['campos_tabela'] = array('ID', 'Nome', 'Idade', 'RG', 'Tel');
        $this->dados['lista'] = $this->user_model->listar($this->id, $this->dados['campos_tabela']);

        $this->load->view('listar', $this->dados);
    }

    public function cadastro() {
        $form = form_open('#', array('class' => 'niceform'));
        $form .= '<table class="cadForm">';

        /* Dados pessoais */
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Nome*:', '', array('for' => 'email'));
        $form .= form_input('nome', '', array('size' => 30));
        $form .= '</td>';
        $form .= '<td rowspan="3"></td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Data de nascimento*:', '', array('for' => 'email'));
        $form .= form_input('data_nasc', '', array('size' => 20, 'class' => 'formDate'));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('RG:', '', array('for' => 'email'));
        $form .= form_input('rg', '', array('size' => 30));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('CPF:', '', array('for' => 'email'));
        $form .= form_input('cpf', '', array('size' => 30, 'class' => 'formCPF'));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Login*:', '', array('for' => 'email'));
        $form .= form_input('login', '', array('size' => 15));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Email:', '', array('for' => 'email'));
        $form .= form_input('email', '', array('size' => 30));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Senha:', '', array('for' => 'email'));
        $form .= form_password('senha', '', array('size' => 20));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Telefone residencial:', '', array('for' => 'email'));
        $form .= form_input('tel', '', array('size' => 25, 'class' => 'formFone'));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Telefone celular:', '', array('for' => 'email'));
        $form .= form_input('cel', '', array('size' => 30, 'class' => 'formFone'));
        $form .= '</td>';
        $form .= '</tr>';

        /* Dados localização */
        $form .= '<tr>';
        $form .= '<td colspan="2">';
        $form .= form_label('Endereço*:', '', array('for' => 'email'));
        $form .= form_input('endereco', '', array('size' => 30));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('CEP:', '', array('for' => 'email'));
        $form .= form_input('cep', '', array('size' => 20, 'class' => 'formCEP'));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Bairro:*', '', array('for' => 'email'));
        $form .= form_input('bairro', '', array('size' => 30));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Cidade*:', '', array('for' => 'email'));
        $form .= form_input('cidade', '', array('size' => 30));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Nome pai:', '', array('for' => 'email'));
        $form .= form_input('nome_pai', '', array('size' => 30));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Celular pai:', '', array('for' => 'email'));
        $form .= form_input('cel_pai', '', array('size' => 30, 'class' => 'formFone'));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Nome mãe:', '', array('for' => 'email'));
        $form .= form_input('nome_mae', '', array('size' => 30));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Celular mãe:', '', array('for' => 'email'));
        $form .= form_input('cel_mae', '', array('size' => 30, 'class' => 'formFone'));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Email responsável:', '', array('for' => 'email'));
        $form .= form_input('email_resp', '', array('size' => 30));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Contratos e boletos em nome de*:', '', array('for' => 'email'));
        $form .= form_input('boleto_nome', null, array('size' => 50, 'class' => 'large'));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('CPF*:', '', array('for' => 'email'));
        $form .= form_input('boleto_cpf', '', array('size' => 30, 'class' => 'formCPF'));
        $form .= '</td>';
        $form .= '</tr>';

        /* Dados saúde */
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Apresenta algum problema de saúde? Qual?', '', array('for' => 'email'));
        $form .= form_input('saude', null, array('size' => 50, 'class' => 'large'));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Tem algum tipo de alergia? Qual?', '', array('for' => 'email'));
        $form .= form_input('alergia', null, array('size' => 50, 'class' => 'large'));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Toma algum medicamento? Qual?', '', array('for' => 'email'));
        $form .= form_input('medicamento', null, array('size' => 50, 'class' => 'large'));
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
        $form .= '<span class="obs">*Campos obrigatórios.</span>';

        $this->dados['form'] = $form;
        $this->load->view('cadastro', $this->dados);
    }

    public function editar() {
        if (!$this->dados['infos'] = $this->user_model->listar($this->id)) {
            redirect('../alunos/listar');
        }

        $dadosUser = $this->dados['infos'][0];

        $form = form_open('#', array('class' => 'niceform'));
        $form .= '<table class="cadForm">';

        /* Dados pessoais */
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Nome*:', '', array('for' => 'email'));
        $form .= form_input('nome', $dadosUser['nome'], array('size' => 30));
        $form .= '</td>';
        $form .= '<td rowspan="3">';
        $form .= form_hidden('id', $dadosUser['id']);
        $form .= form_hidden('nivel', $dadosUser['nivel']);
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Data de nascimento*:', '', array('for' => 'email'));
        $form .= form_input('data_nasc', date('d/m/Y', strtotime($dadosUser['data_nasc'])), array('size' => 20, 'class' => 'formDate'));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('RG:', '', array('for' => 'email'));
        $form .= form_input('rg', $dadosUser['rg'], array('size' => 30, 'class' => 'formRG'));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('CPF:', '', array('for' => 'email'));
        $form .= form_input('cpf', $dadosUser['cpf'], array('size' => 30, 'class' => 'formCPF'));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Login*:', '', array('for' => 'email'));
        $form .= form_input('login', $dadosUser['login'], array('size' => 15));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Email:', '', array('for' => 'email'));
        $form .= form_input('email', $dadosUser['email'], array('size' => 30));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Senha:', '', array('for' => 'email'));
        $form .= form_password('senha', $dadosUser['senha'], array('size' => 20));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Telefone residencial:', '', array('for' => 'email'));
        $form .= form_input('tel', $dadosUser['tel'], array('size' => 25, 'class' => 'formFone'));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Telefone celular:', '', array('for' => 'email'));
        $form .= form_input('cel', $dadosUser['cel'], array('size' => 30, 'class' => 'formFone'));
        $form .= '</td>';
        $form .= '</tr>';

        /* Dados localização */
        $form .= '<tr>';
        $form .= '<td colspan="2">';
        $form .= form_label('Endereço*:', '', array('for' => 'email'));
        $form .= form_input('endereco', $dadosUser['endereco'], array('size' => 30));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('CEP:', '', array('for' => 'email'));
        $form .= form_input('cep', $dadosUser['cep'], array('size' => 20, 'class' => 'formCEP'));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Bairro*:', '', array('for' => 'email'));
        $form .= form_input('bairro', $dadosUser['bairro'], array('size' => 30));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Cidade*:', '', array('for' => 'email'));
        $form .= form_input('cidade', $dadosUser['cidade'], array('size' => 30));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Nome pai:', '', array('for' => 'email'));
        $form .= form_input('nome_pai', $dadosUser['nome_pai'], array('size' => 30));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Celular pai:', '', array('for' => 'email'));
        $form .= form_input('cel_pai', $dadosUser['cel_pai'], array('size' => 30, 'class' => 'formFone'));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Nome mãe:', '', array('for' => 'email'));
        $form .= form_input('nome_mae', $dadosUser['nome_mae'], array('size' => 30));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Celular mãe:', '', array('for' => 'email'));
        $form .= form_input('cel_mae', $dadosUser['cel_mae'], array('size' => 30, 'class' => 'formFone'));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Email responsável:', '', array('for' => 'email'));
        $form .= form_input('email_resp', $dadosUser['email_resp'], array('size' => 30));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Contratos e boletos em nome de*:', '', array('for' => 'email'));
        $form .= form_input('boleto_nome', $dadosUser['boleto_nome'], array('size' => 50, 'class' => 'large'));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('CPF*:', '', array('for' => 'email'));
        $form .= form_input('boleto_cpf', $dadosUser['boleto_cpf'], array('size' => 30, 'class' => 'formCPF'));
        $form .= '</td>';
        $form .= '</tr>';

        /* Dados saúde */
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Apresenta algum problema de saúde? Qual?', '', array('for' => 'email'));
        $form .= form_input('saude', $dadosUser['saude'], array('size' => 50, 'class' => 'large'));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Tem algum tipo de alergia? Qual?', '', array('for' => 'email'));
        $form .= form_input('alergia', $dadosUser['alergia'], array('size' => 50, 'class' => 'large'));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Toma algum medicamento? Qual?', '', array('for' => 'email'));
        $form .= form_input('medicamento', $dadosUser['medicamento'], array('size' => 50, 'class' => 'large'));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td></td>';
        $form .= '<td>';
        $form .= form_submit('editar', 'Salvar', 'id="submit"');
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '</table>';
        $form .= form_close();
        $form .= '<span class="obs">*Campos obrigatórios.</span>';

        $this->dados['form'] = $form;
        $this->load->view('editar', $this->dados);
    }

    public function enviar() {
        $dados = $_POST;
        $msg = '';
        $editCad = (!empty($_POST['id']) ? 'edit' : 'cad');

        $importantes = array(
            'nome' => 'Nome:',
            'data_nasc' => 'Data de nascimento:',
            'login' => 'Login:',
            'senha' => 'Senha:',
            'endereco' => 'Endereço:',
            'cidade' => 'Cidade:',
            'bairro' => 'Bairro:',
            'boleto_nome' => 'Contratos e boletos no nome de:',
            'boleto_cpf' => 'CPF de boletos:'
        );


        $data = $dados['data_nasc'];
        if ($data !== '') {
            list($dia, $mes, $ano) = explode('/', $data);
            $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $nascimento = mktime(0, 0, 0, $mes, $dia, $ano);
            $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);

            /* if ($idade < 18) {
              $importantes['nome_mae'] = 'Nome mãe:';
              $importantes['cel_mae'] = 'Celular mãe:';
              $importantes['email_resp'] = 'Email do responsável:';
              } */
            $dados['idade'] = $idade;
        }

        foreach ($importantes as $indice => $real) {
            $listaImportantes[] = $indice;
        }

        foreach ($dados as $campo => $valor) {
            if ($valor == '' AND in_array($campo, $listaImportantes)) {
                $msg .= "O campo \"$importantes[$campo]\" é obrigatório. <br/>";
            }
        }

        /* Valores padrões */
        $dados['nivel'] = ($editCad == 'edit' ? $dados['nivel'] : 1);
        $dados['lixeira'] = ($editCad == 'edit' ? $dados['lixeira'] : 0);
        $dados['data_nasc'] = date('Y-m-d', strtotime($dados['data_nasc']));

        if ($msg !== '') {
            $msgError = array("msg" => "alert", "text" => $msg);
            echo json_encode($msgError);
        } else {

            $dados['email'] = ($dados['email'] == '' ? 'não informado' : $dados['email']);
            $dados['email_resp'] = ($dados['email_resp'] == '' ? 'não informado' : $dados['email_resp']);

            if ($dados['idade'] < 18) {
                $arrayEmail = array('Email responsável' => $dados['email_resp']);
            } else {
                $arrayEmail = array('Email' => $dados['email'], 'Email responsável' => $dados['email_resp']);
            }

            foreach ($arrayEmail as $email => $val) {
                if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                    if ($val !== 'não informado') {
                        $msgError = array("msg" => "alert", "text" => 'Erro no campo: "' . $email . '". Email inválido.');
                        echo json_encode($msgError);
                        exit();
                    }
                }
            }

            switch ($editCad) {
                case 'edit':
                    $editCadExec = $this->user_model->editar($dados['id'], $dados);
                    $action = ' editado';
                    break;
                case 'cad':
                    $editCadExec = $this->user_model->inserir($dados);
                    $action = ' cadastrado';
                    break;
            }

            if ($editCadExec) {
                $msg = array("msg" => "sucess", "text" => $dados['nome'] . $action . ' com sucesso!');
                echo json_encode($msg);
            } else {
                $msg = array("msg" => "error", "text" => 'Ocorreu algum erro no processo, ' . $dados['nome'] . ' não foi' . $action . ' corretamente.');
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
            redirect('../alunos/listar');
        }

        $this->dados['perfil'] = $this->user_model->listar($id);
        $this->load->view('perfil', $this->dados);
    }

    public function delete() {
        if ($this->user_model->excluir($this->id)) {
            $msg = array("msg" => "sucess", "text" => 'Excluído com sucesso!');
        } else {
            $msg = array("msg" => "error", "text" => 'Houve um erro ao tentar excluir.');
        }
        echo json_encode($msg);
        exit();
    }

    public function consultaIdade() {
        $idConsult = $_POST['id_consult'];

        $this->load->model('User', 'user_model', TRUE);
        $alunosResult = $this->user_model->listar($idConsult, 'nome, id, idade, nome_pai, cel_pai, nome_mae, cel_mae, email_resp');
        $aluno = $alunosResult[0];

        if ($aluno['idade'] >= 18) {
            $msg = array("id" => $aluno['id'], "nome" => $aluno['nome']);
        } else {
            foreach ($aluno as $key => $val) {
                $msg[$key] = $val;
            }
        }

        echo json_encode($msg);
        exit();
    }

}
