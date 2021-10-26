<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaksiModel extends CI_Model {

    public function getSaksi() {
        return $this->db->get('tb_saksi')->result_array();
    }

    public function getSaksiOne($id) {
        return $this->db->get_where('tb_saksi', ['saksi_id' => $id])->row_array();
    }

    public function insertSaksi($data) {
        return $this->db->insert('tb_saksi', $data);
    }

    public function updateSaksi($id, $data) {
        $this->db->where('saksi_id', $id);
        return $this->db->update('tb_saksi', $data);
    }

    public function deleteSaksi($id) {
        return $this->db->delete('tb_saksi', ['saksi_id', $id]);
    }
}