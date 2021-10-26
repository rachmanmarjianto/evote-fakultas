<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KetuaModel extends CI_Model {

    public function showKetua(){
        $this->db->select('*');
        $this->db->from('tb_calon_ketua');
        $this->db->join('tb_tema_pemilihan', 'tb_tema_pemilihan.tema_id = tb_calon_ketua.tema_id');
        $this->db->join('program_studi', 'program_studi.id_program_studi =  tb_calon_ketua.id_program_studi', 'left');
        $this->db->join('jenjang', 'program_studi.id_jenjang = jenjang.id_jenjang', 'left');
        $this->db->where('tb_tema_pemilihan.tema_is_active', "1");
        $this->db->order_by('tb_calon_ketua.tema_id ASC, tb_calon_ketua.id_program_studi ASC, tb_calon_ketua.calon_ketua_nourut ASC');
        return $this->db->get();
    }

    public function insertKetua($data) {
        return $this->db->insert('tb_calon_ketua', $data);
    }

    public function getKetua($id) {
        $this->db->select('*');
        $this->db->from('tb_calon_ketua');
        $this->db->join('tb_tema_pemilihan', 'tb_tema_pemilihan.tema_id = tb_calon_ketua.tema_id');
        $this->db->join('program_studi', 'program_studi.id_program_studi =  tb_calon_ketua.id_program_studi', 'left');
        $this->db->join('jenjang', 'program_studi.id_jenjang = jenjang.id_jenjang', 'left');
        $this->db->where('calon_ketua_id', $id);
        return $this->db->get();
    }

    public function getCalon($id) {
        return $this->db->get_where('tb_calon_ketua', ['calon_ketua_id', $id]);
    }

    public function updateKetua($id, $data) {
        $this->db->where('calon_ketua_id', $id);
        return $this->db->update('tb_calon_ketua', $data);
    }

    public function deleteKetua($id) {
        return $this->db->delete('tb_calon_ketua', array('calon_ketua_id' => $id));
    }
}