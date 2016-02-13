<?php

class Contrato extends MY_Model {

    function __construct() {
        parent::__construct();

        $this->setTable('contratos');
        $this->logs->setTableOrigin('contratos');
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

        return $this->db->update($this->table, $campos, array('id_contrato' => $id));
    }

    function listar($id = '', $campos = '*') {
        if ($id == '') {
            $this->db->select($campos);
            $this->db->join('user', 'ctr.id_aluno = user.id');
        } else {
            $this->db->select($campos);
            $this->db->where('id_contrato', $id);
            $this->db->join('user', 'ctr.id_aluno = user.id');
        }
        $query = $this->db->get($this->table . ' ctr');
        return $query->result_array();
    }

    public function excluir($id) {
        $query = $this->db->get_where($this->table, array('id_contrato' => $id));
        $campos = $query->result_array();

        $this->logs->setAcao('EXCLUIR');
        $this->logs->setCamposVal($campos[0]);
        $this->logs->setCodigo('DELETE');
        $this->logs->inserir();

        return $this->db->delete($this->table, array('id_contrato' => $id));
    }

}
