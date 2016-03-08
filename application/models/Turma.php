<?php

class Turma extends MY_Model {

    function __construct() {
        parent::__construct();

        $this->setTable('turmas');
        $this->logs->setTableOrigin('turmas');
    }

    function inserir($data) {
        $this->logs->setAcao('INSERIR');
        $this->logs->setCamposVal($data);
        $this->logs->setCodigo('INSERT INTO');
        $this->logs->inserir();

        return $this->db->insert($this->table, $data);
    }

    public function editar($id, $campos) {
        $this->logs->setAcao('EDITAR');
        $this->logs->setCamposVal($campos);
        $this->logs->setCodigo('UPDATE');
        $this->logs->inserir();

        return $this->db->update($this->table, $campos, array('turma_id' => $id));
    }

    function listar($id = '', $campos = '*') {
        if ($id == '') {
            $this->db->select($campos);
            $this->db->where('tur.lixeira', 0);
            $this->db->join('cursos cur', 'tur.turma_idcurso = cur.curso_id');
        } else {
            $this->db->select($campos);
            $this->db->where('turma_id', $id);
            $this->db->join('cursos cur', 'tur.turma_idcurso = cur.curso_id');
        }
        $query = $this->db->get($this->table . ' tur');
        return $query->result_array();
    }

    public function excluirDefinitivo($id) {
        $query = $this->db->get_where($this->table, array('turma_id' => $id));
        $campos = $query->result_array();

        $this->logs->setAcao('EXCLUIR');
        $this->logs->setCamposVal($campos[0]);
        $this->logs->setCodigo('DELETE');
        $this->logs->inserir();

        return $this->db->delete($this->table, array('turma_id' => $id));
    }

    public function excluir($id, $restaurar = false) {
        $query = $this->db->get_where($this->table, array('turma_id' => $id));
        $campos = $query->result_array();

        $this->logs->setAcao('LIXEIRA');
        $this->logs->setCamposVal($campos[0]);
        $this->logs->setCodigo('LIXEIRA');
        $this->logs->inserir();

        if ($restaurar == true) {
            return $this->db->update($this->table, array('lixeira' => 0), array('turma_id' => $id));
        } else {
            return $this->db->update($this->table, array('lixeira' => 1), array('turma_id' => $id));
        }
    }

    public function getCurso($idturma) {
        $this->load->model('Curso', 'curso_model');
        $turmaResult = $this->listar($idturma, 'turma_idcurso');
        $curso_result = $this->curso_model->listar($turmaResult[0]['turma_idcurso']);
        $curso = $curso_result[0]['curso_nome'];

        return $curso;
    }

    public function matricula($idaluno, $idturma, $status = 1) {
        return $this->db->insert('matriculas', array('matricula_idaluno' => $idaluno, 'matricula_idturma' => $idturma, 'matricula_status' => $status));
    }

    public function transfMatricula($idaluno, $idturma) {
        return $this->db->update('matriculas', array('matricula_idturma' => $idturma, 'matricula_status' => 1), array('matricula_idaluno' => $idaluno));
    }

    public function getMatriculados($idturma) {
        $this->db->select('*');
        $query = $this->db->get_where('matriculas', array('matricula_idturma' => $idturma));
        return $query->num_rows();
    }

}
