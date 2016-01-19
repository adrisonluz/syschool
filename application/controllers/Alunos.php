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
        $form = form_open('#', array('class' => 'niceform'));   
        $form .= '<table class="cadForm">';
        
        /* Dados pessoais */
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Nome*:', '' , array('for' => 'email'));
        $form .= form_input('nome', '', array('size'=> 30));
        $form .= '</td>';
        $form .= '<td rowspan="3"></td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Data de nascimento*:', '' , array('for' => 'email'));
        $form .= form_input('data_nasc', '', array('size'=> 20));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('RG*:', '' , array('for' => 'email'));
        $form .= form_input('rg', '', array('size'=> 30));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('CPF*:', '' , array('for' => 'email'));
        $form .= form_input('cpf', '', array('size'=> 30));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Login*:', '' , array('for' => 'email'));
        $form .= form_input('login', '', array('size'=> 15));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Email*:', '' , array('for' => 'email'));
        $form .= form_input('email', '', array('size'=> 30));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Senha*:', '' , array('for' => 'email'));
        $form .= form_password('senha', '', array('size'=> 20));        
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Telefone residencial:', '' , array('for' => 'email'));
        $form .= form_input('tel', '', array('size'=> 25));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Telefone celular:', '' , array('for' => 'email'));
        $form .= form_input('cel', '', array('size'=> 30));       
        $form .= '</td>';
        $form .= '</tr>';
        
        /* Dados localização */
        $form .= '<tr>';
        $form .= '<td colspan="2">';
        $form .= form_label('Endereço*:', '' , array('for' => 'email'));
        $form .= form_input('endereco', '', array('size'=> 30));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('CEP:', '' , array('for' => 'email'));
        $form .= form_input('cep', '', array('size'=> 20));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Bairro:', '' , array('for' => 'email'));
        $form .= form_input('bairro', '', array('size'=> 30));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Cidade:', '' , array('for' => 'email'));
        $form .= form_input('cidade', '', array('size'=> 30));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Nome pai**:', '' , array('for' => 'email'));
        $form .= form_input('nome_pai', '', array('size'=> 30));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Celular pai**:', '' , array('for' => 'email'));
        $form .= form_input('cel_pai', '', array('size'=> 30));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Nome mãe**:', '' , array('for' => 'email'));
        $form .= form_input('nome_mae', '', array('size'=> 30));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Celular mãe**:', '' , array('for' => 'email'));
        $form .= form_input('cel_mae', '', array('size'=> 30));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Email responsável**:', '' , array('for' => 'email'));
        $form .= form_input('email_resp', '', array('size'=> 30));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Contratos e boletos em nome de*:', '' , array('for' => 'email'));
        $form .= form_input('boleto_nome', null, array('size'=> 50, 'class' => 'large' ));
        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('CPF*:', '' , array('for' => 'email'));
        $form .= form_input('boleto_cpf', '', array('size'=> 30));
        $form .= '</td>';
        $form .= '</tr>';
        
        /* Dados saúde */
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Apresenta algum problema de saúde? Qual?', '' , array('for' => 'email'));
        $form .= form_input('saude', null, array('size'=> 50, 'class' => 'large' ));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Tem algum tipo de alergia? Qual?', '' , array('for' => 'email'));
        $form .= form_input('alergia', null, array('size'=> 50, 'class' => 'large' ));
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Toma algum medicamento? Qual?', '' , array('for' => 'email'));
        $form .= form_input('medicamento', null, array('size'=> 50, 'class' => 'large' ));
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
        $form .= '<span class="obs">*Campos obrigatórios. **Campos obrigatórios quando aluno menor de idade.</span>';
        
        $this->dados['form'] = $form;
        $this->load->view('cadastro', $this->dados);
    }           
    
    public function enviar() {
        $dados = $_POST;
        $msg = '';
        
        $importantes = array(
            'nome' => 'Nome:',
            'data_nasc' => 'Data de nascimento:',
            'rg' => 'RG:',
            'cpf' => 'CPF:',
            'email' => 'Email:',
            'login' => 'Login:',
            'senha' => 'Senha:',
            'endereco' => 'Endereço:',
            'boleto_nome' => 'Contratos e boletos no nome de:',
            'boleto_cpf' => 'CPF de boletos:'
        );
        
        $data = $dados['data_nasc'];
        if($data !== ''){
            list($dia, $mes, $ano) = explode('/', $data);
            $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
            $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
            $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
         
            if($idade < 18){
                $importantes['nome_mae'] = 'Nome mãe:';
                $importantes['cel_mae'] = 'Celular mãe:';
                $importantes['email_resp'] = 'Email do responsável:';
            }            
            $dados['idade'] = $idade;
        }
        
        foreach ($importantes as $indice => $real){
            $listaImportantes[] = $indice;
        }
        
        foreach($dados as $campo => $valor){
            if($valor == '' AND in_array($campo, $listaImportantes)){
                $msg .=  "O campo \"$importantes[$campo]\" é obrigatório.\n";
            }
        }        
        
        /* Valores padrões */
        $dados['nivel'] = 1;
        
        if($msg !== ''){
            $msgError = array("msg" => "error", "text" => $msg);
            echo json_encode($msgError);      
        }else{
            $this->load->model('User', 'user_model', TRUE);

            if ($this->user_model->inserir($dados)) {
                $msg = array("msg" => "sucess", "text" => $dados['nome'] . ' cadastrado com sucesso!');
                echo json_encode($msg);
            } else {
                $msg = array("msg" => "error", "text" => 'Erro ao tentar cadastrar '. $dados['nome']);
                echo json_encode($msg);
            }
        }
        
        exit();
    }
    
    public function relatorio()
    {
        $lista = $this->get();
        
        $this->dados['lista'] = $lista;
        $this->load->view('relatorio', $this->dados);
    }
}
