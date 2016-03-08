<?php

class Movimentacao extends MY_Model {

    function __construct() {
        parent::__construct();

        $this->setTable('movimentacao');
        $this->logs->setTableOrigin('movimentacao');
    }

    public function lancar($dados) {
        return $this->db->insert($this->table, $dados);
    }

    public function listEntradas($idcaixa, $campos = '*') {
        $this->db->select($campos);
        $query = $this->db->get_where($this->table, array('mov_idcaixa' => $idcaixa, 'mov_tipo' => 'entrada'));

        return $query->result_array();
    }

    public function listSaidas($idcaixa, $campos = '*') {
        $this->db->select($campos);
        $query = $this->db->get_where($this->table, array('mov_idcaixa' => $idcaixa, 'mov_tipo' => 'saida'));

        return $query->result_array();
    }

    public function getEntradas($idcaixa) {
        $this->db->select(array('mov_valor'));
        $query = $this->db->get_where($this->table, array('mov_idcaixa' => $idcaixa, 'mov_tipo' => 'entrada'));
        $resultado = $query->result('array');

        $valorTotal = '';
        foreach ($resultado as $linhas) {
            $valorTotal = $valorTotal + $linhas['mov_valor'];
        }

        return $valorTotal;
    }

    public function getSaidas($idcaixa) {
        $this->db->select(array('mov_valor'));
        $query = $this->db->get_where($this->table, array('mov_idcaixa' => $idcaixa, 'mov_tipo' => 'saida'));
        $resultado = $query->result('array');

        $valorTotal = '';
        foreach ($resultado as $linhas) {
            $valorTotal = $valorTotal + $linhas['mov_valor'];
        }

        return $valorTotal;
    }

}
