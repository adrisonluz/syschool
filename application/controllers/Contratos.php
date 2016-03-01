<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contratos extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->setTitle('Aline Rosa | Contratos');
        $this->setSector('Contratos');
        $this->dados['sector'] = $this->getSector();
        $this->setModel('Contrato', 'contrato_model');

        //$this->load->model('Model', '', TRUE);
        $this->dados['url'] = $this->url;
        $this->dados['current'] = 'contratos';

        $sidebar = new Sidebar();
        $sidebar->setSidebar('Novo Aluno', base_url('alunos/cadastro'));
        $sidebar->setSidebar('Contratos', base_url('contratos/listar'));
        //$sidebar->setSidebar('Logs', base_url('logs/listar'));

        $sidebar->setSubmenu('Financeiro', base_url('relatorios/financeiro'));
        $sidebar->setSubmenu('Horarios', base_url('relatorios/horarios'));
        $sidebar->setSidebar('Relatórios', '#', $sidebar->getSubmenu());

        $this->dados['sidebar'] = $sidebar->getSidebar();
    }

    public function listar() {
        $this->dados['campos_tabela'] = array('ID_Contrato', 'Nome', 'Tel', 'Curso', 'Data');
        $this->dados['lista'] = $this->contrato_model->listar($this->id, $this->dados['campos_tabela']);

        $this->load->view('listar', $this->dados);
    }

    public function cadastro() {
        $form = form_open('#', array('class' => 'niceform'));
        $form .= '<table class="cadForm">';

        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Aluno*:', '', array('for' => 'email'));

        $this->load->model('User', 'user_model', TRUE);
        $alunosResult = $this->user_model->listar('', 'nome, id, idade');
        foreach ($alunosResult as $alunosList => $list) {
            $alunos[] = $list;
        }
        $option[] = array(0 => 'Selecione um aluno:');
        foreach ($alunos as $keys => $valores) {
            $option[] = array($valores['id'] => $valores['nome']);
        }
        $form .= form_dropdown('id_aluno', $option, '', array('size' => 1, 'style' => 'width: 210px;'));

        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Data do contrato:', '', array('for' => 'email'));
        $form .= form_input('data', date('d/m/Y'), array('size' => 30, 'class' => 'formDate'));
        $form .='</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Curso:', '', array('for' => 'email'));
        $form .= form_input('curso', '', array('size' => 30));
        $form .='</td>';
        $form .= '<td>';
        $form .= form_label('Quantidade de dias:', '', array('for' => 'email'));
        $form .= form_input('carga_horaria', '', array('size' => 30));
        $form .='</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Dias:', '', array('for' => 'email'));
        $form .= form_input('dias', '', array('size' => 30));
        $form .='</td>';
        $form .= '<td>';
        $form .= form_label('Horário:', '', array('for' => 'email'));
        $form .= form_input('horario', '', array('size' => 30));
        $form .='</td>';
        $form .= '</tr>';
        $form .='<tr>';
        $form .= '<td></td>';
        $form .='<td>';
        $form .= form_label('Duração do contrato (meses):', '', array('for' => 'email'));
        $form .= form_input('meses', ' ', array('size' => 10, 'style' => 'width:50px;'));
        $form .='</td>';
        $form .= '</tr>';
        $form .= '<tr><td collspan="2"></td></tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Total de mensalidades:', '', array('for' => 'email'));
        $form .= form_input('mensalidades', '', array('size' => 30, 'style' => 'width:80px;'));
        $form .='</td>';
        $form .= '<td>';
        $form .= form_label('Valor de cada mensalidade (R$):', '', array('for' => 'email'));
        $form .= form_input('valor_mensalidade', '', array('size' => 30, 'style' => 'width:80px;', 'class' => 'formDin'));
        $form .='</td>';
        $form .= '</tr>';
        $form .='<tr>';
        $form .= '<td></td>';
        $form .='<td>';
        $form .= form_label('Taxa de matrícula (R$):', '', array('for' => 'email'));
        $form .= form_input('valor_matricula', ' ', array('size' => 10, 'style' => 'width:80px;', 'class' => 'formDin'));
        $form .='</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td></td>';
        $form .= '<td>';
        $form .= form_submit('cadastrar', 'Enviar', 'id = "submit"');
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '</table>';
        $form .= form_close();
        $form .= '<span class = "obs">*Todos os campos são obrigatórios.</span>';

        $this->dados['form'] = $form;
        $this->load->view('cadastro', $this->dados);
    }

    public function editar() {
        if ($this->id == '') {
            redirect('../contratos/listar');
        }

        if (!$this->dados['infos'] = $this->contrato_model->listar($this->id)) {
            redirect('../contratos/listar');
        }

        $this->dados['infos'] = $this->contrato_model->listar($this->id);
        $dadosContrato = $this->dados['infos'][0];

        $form = form_open('#', array('class' => 'niceform'));
        $form .= '<table class="cadForm">';

        $form .= '<tr>';
        $form .= '<td>';

        $this->load->model('User', 'user_model', TRUE);
        $alunosResult = $this->user_model->listar($dadosContrato['id_aluno'], 'nome, id, idade');
        $aluno = $alunosResult[0];
        //$form .= form_label($aluno['nome'], '', array('for' => 'email', 'class' => 'nome_contrato'));

        $form .= form_hidden('id_contrato', $dadosContrato['id_contrato']);
        $form .= form_hidden('id_aluno', $aluno['id']);

        $form .= '</td>';
        $form .= '<td>';
        $form .= form_label('Data do contrato:', '', array('for' => 'email'));
        $form .= form_input('data', $dadosContrato['data'], array('size' => 30, 'class' => 'formDate'));
        $form .='</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Curso:', '', array('for' => 'email'));
        $form .= form_input('curso', $dadosContrato['curso'], array('size' => 30));
        $form .='</td>';
        $form .= '<td>';
        $form .= form_label('Quatidade de dias:', '', array('for' => 'email'));
        $form .= form_input('carga_horaria', $dadosContrato['carga_horaria'], array('size' => 30));
        $form .='</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Dias:', '', array('for' => 'email'));
        $form .= form_input('dias', $dadosContrato['dias'], array('size' => 30));
        $form .='</td>';
        $form .= '<td>';
        $form .= form_label('Horário:', '', array('for' => 'email'));
        $form .= form_input('horario', $dadosContrato['horario'], array('size' => 30));
        $form .='</td>';
        $form .= '</tr>';
        $form .='<tr>';
        $form .= '<td></td>';
        $form .='<td>';
        $form .= form_label('Duração do contrato (meses):', '', array('for' => 'email'));
        $form .= form_input('meses', $dadosContrato['meses'], array('size' => 10, 'style' => 'width:50px;'));
        $form .='</td>';
        $form .= '</tr>';
        $form .= '<tr><td collspan="2"></td></tr>';
        $form .= '<tr>';
        $form .= '<td>';
        $form .= form_label('Total de mensalidades:', '', array('for' => 'email'));
        $form .= form_input('mensalidades', $dadosContrato['mensalidades'], array('size' => 30, 'style' => 'width:80px;'));
        $form .='</td>';
        $form .= '<td>';
        $form .= form_label('Valor da cada mensalidade (R$):', '', array('for' => 'email'));
        $form .= form_input('valor_mensalidade', $dadosContrato['valor_mensalidade'], array('size' => 30, 'style' => 'width:80px;', 'class' => 'formDin'));
        $form .='</td>';
        $form .= '</tr>';
        $form .='<tr>';
        $form .= '<td></td>';
        $form .='<td>';
        $form .= form_label('Taxa de matrícula (R$):', '', array('for' => 'email'));
        $form .= form_input('valor_matricula', $dadosContrato['valor_matricula'], array('size' => 10, 'style' => 'width:80px;', 'class' => 'formDin'));
        $form .='</td>';
        $form .= '</tr>';
        $form .= '<tr>';
        $form .= '<td></td>';
        $form .= '<td>';
        $form .= form_submit('cadastrar', 'Enviar', 'id = "submit"');
        $form .= '<a href="' . base_url('contratos/imprimir/id/' . $dadosContrato['id_contrato']) . '" target="_new" class="bt_green"><span class="bt_green_lft"></span><strong>IMPRIMIR</strong><span class="bt_green_r"></span></a>';
        $form .= '</td>';
        $form .= '</tr>';
        $form .= '</table>';
        $form .= form_close();
        $form .= '<span class = "obs">*Todos os campos são obrigatórios.</span>';

        $this->dados['form'] = $form;
        $this->load->view('editar', $this->dados);
    }

    public function enviar() {
        $dados = $_POST;
        $msg = '';
        $editCad = (!empty($_POST['id_contrato']) ? 'edit' : 'cad');


        if (in_array('', $dados)) {
            $msgError = array("msg" => "alert", "text" => 'Todos os campos são obrigatórios.');
            echo json_encode($msgError);

            exit();
        }

        /* Valores padrões */
        //$dados['id_agent'] = ($editCad == 'edit' ? $dados['nivel'] : 1);
        $dados['data_modificacao'] = date('d/m/Y');
        //$dados['data'] = strtotime($dados['data']);

        switch ($editCad) {
            case 'edit':
                $editCadExec = $this->contrato_model->editar($dados['id_contrato'], $dados);
                $action = ' editado';
                break;
            case 'cad':
                $editCadExec = $this->contrato_model->inserir($dados);
                $action = ' cadastrado';
                break;
        }

        if ($editCadExec) {
            $msg = array("msg" => "sucess", "text" => 'Contrato ' . $action . ' com sucesso!');
            echo json_encode($msg);
        } else {
            $msg = array("msg" => "error", "text" => 'Ocorreu algum erro no processo, o contrato não foi' . $action . ' corretamente.');
            echo json_encode($msg);
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
        if ($this->contrato_model->excluir($this->id)) {
            $msg = array("msg" => "sucess", "text" => 'Contrado excluído com sucesso!');
        } else {
            $msg = array("msg" => "error", "text" => 'Houve um erro ao excluir o contrato.');
        }
        echo json_encode($msg);
        exit();

        exit();
    }

    public function listaIdAluno($id_aluno) {
        $contratoInfos = $this->contrato_model->listarIdAluno($id_aluno);

        return $contratoInfos;
    }

    public function imprimir() {
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');

        $dadosResult = $this->contrato_model->listar($this->id, 'nome, cpf, idade, endereco, bairro, cidade, curso, dias, data, horario, meses, valor_matricula, mensalidades, valor_mensalidade, carga_horaria, boleto_nome, boleto_cpf');
        $dados = $dadosResult[0];

        $html = "<html>";
        $html .= "<head><title>Contrato | " . $dados['nome'] . "</title></head>";
        $html .= "<body>";

        if ($dados['idade'] < 18) {
            $menor = ' responsável <strong>' . $dados['boleto_nome'] . '</strong>, cpf <strong>' . $dados['boleto_cpf'] . '</strong>';
        } else {
            $menor = '';
        }

        $valor_matricula = ($dados['valor_matricula'] == '00,00' ? 'Isento' : 'R$ ' . $dados['valor_matricula']);

        $html .= '<p style="text-align: center;"><strong>CONTRATO DE PRESTAÇÃO DE SERVIÇOS</strong></p>
        <p style="font-size:10px; text-align: justify;">Pelo presente instrumento particular de serviços, Escola de Dança Aline Rosa com sede nesta capital na Av. Assis Brasil 2100, 2° andar, bairro Passo D\'Areia, Porto Alegre/RS, CNPJ 00714970/0001-59 neste ato representado por sua diretora abaixo firmado doravante denominada simplesmente <strong>CONTRATADO</strong>, e do outro lado, doravante denominado <strong>CONTRATANTE</strong> Sr(a) <strong>' . $dados['nome'] . '</strong>, CPF <strong>' . $dados['cpf'] . '</strong>' . $menor . ' residente no endereço <strong>' . $dados['endereco'] . '</strong>, no bairro <strong>' . $dados['bairro'] . '</strong> na cidade de <strong>' . $dados['cidade'] . '</strong>/RS tem justo e contratado:</p>
        <p style="font-size:10px; text-align: justify;"><strong>Cláusula 1°:</strong> O presente contrato é estabelecido sob os preceitos da Lei de Diretrizes e Bases da Educação e regimento dos cursos livre, tem por finalidade a prestação de serviços educacionais em Dança. O contratado colocará a disposição do contratante aulas de: <strong>' . $dados['curso'] . '</strong> no(s) dia(s) <strong>' . $dados['dias'] . '</strong> no horário <strong>' . $dados['horario'] . '</strong> nas dependências da Escola de Dança Aline Rosa. A duração do presente contrato é de <strong>' . $dados['meses'] . '</strong> meses à contar da data de assinatura do mesmo até dezembro do corrente ano.</p>
        <p style="font-size:10px; text-align: justify;"><strong>Cláusula 2°:</strong> O contratante pagará ao contratado pelos serviços prestados o seguinte: taxa de matrícula no valor de <strong>' . $valor_matricula . '</strong>, e mais <strong>' . $dados['mensalidades'] . '</strong> mensalidades no valor de R$ <strong>' . $dados['valor_mensalidade'] . '</strong>. O valor é antecipado no dia 10 de cada mês. Sendo a Escola da iniciativa privada, as mensalidades são pagas integralmente do período de entrada a dezembro, sem descontos. A quantidade de aulas do ano letivo é de <strong>' . $dados['carga_horaria'] . '</strong> aulas. A mensalidade de dezembro deverá ser paga integralmente, pois a carga horária deste mês foi completada durante o ano levito através de aulas extras, ensaios. <strong>No caso de inadimplência no período de dois meses o aluno não poderá frequentar as aulas até quitar as mensalidades pendentes</strong>.</p>
        <p style="font-size:10px; text-align: justify;"><strong>Cláusula 3°:</strong> A cobrança de mensalidades será realizada através de boleto bancário fornecido pelo Contratado. O contratante deverá pagar `custa dos encargos, juros e demais taxas em caso de atraso. Não será aceito pagamento na secretaria da Escola por motivo de segurança. A assuidade as aulas é responsabilidade do contratante. Em caso de falta a recuperação será realizada nos horários e turmas compatíveis que o contratado dispõe. Em caso de falta o aluno não haverá desconto na mensalidade. O material das aulas teóricas não está incluso na mensalidade sendo cobrado separadamente de acordo com o andamento do curso e o nível técnico dos alunos.</p>
        <p style="font-size:10px; text-align: justify;"><strong>Cláusula 4°:</strong> O aluno que desistir no decorrer do ano letivo deverá assinar o termo de cancelamento na secretaria da Escola, estar com as mensalidades dos meses anteriores em dia para cancelar o presente contrato. Haverá uma taxa de R$ 60,00 para o cancelamento, pois as turmas têm números de vagas limitado. Caso não seja assinado o termo de cancelamento as mensalidades estarão correndo por conta do COntratante até o final do presente contrato, e sujeitos a cobrança judicial.</p>
        <p style="font-size:10px; text-align: justify;"><strong>Cláusula 5°:</strong> O ingresso do estudante na Escola pressupõe que tenha condições de saúde para frequentar as aulas e realizar esforço físico, sendo de sua inteira responsablilidade informar a Escola eventuais lesões, uso contínuo de medicamentos, doenças ou sequelas de tratamentos realizados.</p>
        <p style="font-size:10px; text-align: justify;"><strong>Cláusula 6°:</strong> Passeios extras, amostras de arte, festivais de dança deverão ter a autorização por escrito e será responsabilidade dos pais o custeio dos mesmos quando menor de idade. Toda a atividade, ensaio, apresentação compõem a carga horária e são consideradas como aula dada.</p>
        <p style="font-size:10px; text-align: justify;"><strong>Cláusula 7°:</strong> O contratante reconhece a competência da Escola de Dança e aceita os programas de ensino adotados, acatando ao seu regimento interno, normas diciplinares, agrupamento de estudantes em turmas conforme nível técnico, com a inclusão - ou não - nas diversas danças, apresentações ocasionais ou festivais competitivos. Comprometendo-se oferecer aulas ministradas por profissionais qualificados, procurar contribuir para o desenvolvimento físico e intelectual do estudante; promover objetivamente o progresso técnico e artístico do estudante com suas aptidões e possibilidades individuais. O contratado se reserva o direito de mudanças técnicas e de professor ao seu critério. Os professores muito embora se comprometam a despender a todos os estudantes a mesma atenção e ensinamentos, não garantem os mesmos resultados e promoções iguais a todos. É do conhecimento do contratante que as condições físicas são individuais e distintas, e que o tempo para atingir cada nível de progresso varia de aluno para aluno.</p>
        <p style="font-size:10px; text-align: justify;"><strong>Cláusula 8°:</strong> As apresentações realizadas pela Escola serão organizadas pela mesma, ficando aos pais ou responsável o compromisso de pagar o figurino e a taxa de participação para a inclusão do aluno na atividade. Será assinado um contrato especial para participação neste evento.</p>
        <p style="font-size:10px; text-align: justify;"><strong>Cláusula 9°:</strong> Todos são responsáveis pela conservação da Escola em todos os seus aspectos, devendo pagar os danos como fator de justiça, todo aquele que os causar. O aluno é responsável pelo seu material, mochila, bolsa, roupa, carteira, celular ou objetos de valor. A Escola dispõe de armários rotativos ou fixos para guardar os pertences com segurança.</p>
        <p style="font-size:10px; text-align: justify;"><strong>Cláusula 10°:</strong> O aluno, ou seus pais, caso seja menor, desde já cedem a Escola o direito de imagem, autorizando a veiculação de sua imagem em todos os meios de publicação e difusão que interessem aos fins artísticos e/ou comerciais da Escola de Dança Aline Rosa como entidades voltadas a fins educacionais e culturais.</p>
        <p style="font-size:10px; text-align: justify;"><strong>Cláusula 11°:</strong> O contratado deverá comunicar ao contratante toda e qualquer modificação técnica ou atividade realizada na Escola. Todas as infomações que constam na ficha de cadastro são de responsabilidade do contratante. Em caso de alteração nos dados deve o contratante informar a secretaria da Escola para evitar falhas na comunicação.</p>
        <p style="font-size:10px; text-align: justify;"><strong>Cláusula 12°:</strong> Fica claramente entendido que tanto os serviços que o contratado presta, bem como o presente contrato, não serão em nenhum momento considerados experimentais.</p>
        <p style="font-size:12px;">Assim por estarem justas e contratadas, as partes assinam o presente em duas vias de igual teor e forma.</p>
        <br/>
        <p style="width:300px; float:left;  border-top:2px solid #000000; text-align: center; font-weight: bold;">Contratado</p>
        <p style="width:300px; float:right; margin-top: 0px; border-top:2px solid #000000; text-align: center; font-weight: bold;">Contratante</p>
        <br/>
        <p style="clear:both; text-align:right;">Porto Alegre, _______ de _____________________ de 2016.</p>
        ';

        $html .= "</body>";
        $html .= "</html>";

        $nomeArquivo = str_replace(" ", "-", strtolower($dados['nome']));
        pdf($html, 'contrato-' . $nomeArquivo, 'Contrato ' . $dados['nome'], 'Visite nosso site: www.escoladancaalinerosa.com.br');
    }

}
