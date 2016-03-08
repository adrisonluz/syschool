<?php

class CaixaMov extends MY_Model {

    function __construct() {
        parent::__construct();

        $this->setTable('caixa');
        $this->logs->setTableOrigin('caixa');
    }

    public function hoje() {
        $query = $this->db->get_where($this->table, array('caixa_data' => date('d/m/Y'), 'caixa_hora_fechamento' => ''));

        return $query->result_array();
    }

    public function extrato($campos) {
        $query = $this->db->select($campos);
        $query = $this->db->get_where($this->table);

        return $query->result_array();
    }

    function abrir($data) {
        $this->logs->setAcao('ABRIR CAIXA');
        $this->logs->setCamposVal($data);
        $this->logs->setCodigo('INSERT INTO');
        $this->logs->inserir();

        return $this->db->insert($this->table, $data);
    }

    public function fechar($id, $campos) {
        $this->logs->setAcao('FECHAR CAIXA');
        $this->logs->setCamposVal($campos);
        $this->logs->setCodigo('UPDATE');
        $this->logs->inserir();

        return $this->db->update($this->table, $campos, array('caixa_id' => $id));
    }

    public function editar($id, $campos) {
        $this->logs->setAcao('EDITAR');
        $this->logs->setCamposVal($campos);
        $this->logs->setCodigo('UPDATE');
        $this->logs->inserir();

        return $this->db->update($this->table, $campos, array('id' => $id));
    }

    function listar() {
        $query = $this->db->select('*');
        $query = $this->db->get_where($this->table, array('caixa_data' => date('d/m/Y'), 'caixa_hora_fechamento' => ''));

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

}
