
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_prodi extends CI_Model {

    public function get_prodi_fakultas(){
        $this->db->select('id_fakultas');
        $this->db->where('status', 1);
        $id_fak = $this->db->get('fakultas')->result_array();

        $this->db->where('id_fakultas', $id_fak[0]['id_fakultas']);
        $this->db->where('status', 1);
        $this->db->from('program_studi as p');
        $this->db->join('jenjang as j', 'p.id_jenjang=j.id_jenjang');
        $this->db->order_by('j.nama_jenjang, p.nama_prodi');
        return $this->db->get()->result_array();
    }
}
