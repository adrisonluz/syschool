<?php

class User extends MY_Model {

    function __construct() {
        parent::__construct();

        $this->setTable('user');
        $this->logs->setTableOrigin('user');
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

        return $this->db->update($this->table, $campos, array('id' => $id));
    }

    function listar($id = '', $campos = '*') {
        $query = $this->db->select($campos);
        if ($id !== '') {
            $query = $this->db->get_where($this->table, array('id' => $id));
        } else {
            $query = $this->db->get_where($this->table, array('lixeira' => 0, 'nivel' => 1));
        }

        return $query->result_array();
    }

    public function excluirDefinitivo($id) {
        $query = $this->db->get_where($this->table, array('id' => $id));
        $campos = $query->result_array();

        $this->logs->setAcao('EXCLUIR');
        $this->logs->setCamposVal($campos[0]);
        $this->logs->setCodigo('DELETE');
        $this->logs->inserir();

        return $this->db->delete($this->table, array('id' => $id));
    }

    public function excluir($id, $restaurar = false) {
        $query = $this->db->get_where($this->table, array('id' => $id));
        $campos = $query->result_array();

        $this->logs->setAcao('LIXEIRA');
        $this->logs->setCamposVal($campos[0]);
        $this->logs->setCodigo('LIXEIRA');
        $this->logs->inserir();

        if ($restaurar == true) {
            return $this->db->update($this->table, array('lixeira' => 0), array('id' => $id));
        } else {
            return $this->db->update($this->table, array('lixeira' => 1), array('id' => $id));
        }
    }

    public function getProfessor($id = '', $campos = '*') {
        $query = $this->db->select($campos);
        if ($id !== '') {
            $query = $this->db->get_where($this->table, array('id' => $id, 'nivel' => 2));
        } else {
            $query = $this->db->get_where($this->table, array('lixeira' => 0, 'nivel' => 2));
        }

        return $query->result_array();
    }

}
