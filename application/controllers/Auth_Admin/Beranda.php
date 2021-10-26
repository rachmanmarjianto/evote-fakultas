<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
        if(!isset($this->session->userdata['username']))
        {
		    redirect('AdminLogin');
        }
    }

	public function index()
	{
        // $data['user'] = $this->db->get_where('tb_admin', ['admin_username' => $this->session->userdata('username')])->row_array();
        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        $data['title'] = "Beranda - Administrator";
        $data['jlhPemilih'] = $this->db->count_all('tb_pemilih');
        $data['jenis'] = $this->db->get_where('tb_tema_pemilihan', ['tema_is_active'=> "1"])->result_array();
        $data['hadir'] = $this->db->query("SELECT COUNT(pemilih_id) AS hadir FROM tb_pemilih WHERE pemilih_status='1'")->row_array();
        $this->load->view('layout/header_layout', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        if(count($data['jenis']))
        {
            $this->load->view('content/beranda', $data);
            $this->load->view('layout/footer_layout_2');
            $this->load->view('content/beranda_js', $data);
        }            
        else
        {
            $this->load->view('content/beranda_2', $data);
            $this->load->view('layout/footer_layout_2');
        }
	}

    public function ajax_get_data(){
        $this->db->select('tema_id');
        $this->db->where('tema_is_active', "1");
        $tema = $this->db->get('tb_tema_pemilihan')->result_array();

        $data['tema']=array();

        for($i=0; $i<count($tema); $i++){            
            $this->db->select("COUNT(DISTINCT nim) as jumlah");
            $this->db->where('tema_id', $tema[$i]['tema_id']);
            $data['tema'][$i]=array(
                'jumlah' => $this->db->get('tb_suara')->result_array()[0]['jumlah'],
                'tema_id' => $tema[$i]['tema_id']
            );
        }

        $this->db->select("COUNT(DISTINCT pemilih_akun) as jumlah");
        $data['pemilih'] = $this->db->get('tb_pemilih')->result_array()[0]['jumlah'];

        $data['blmPilih'] = $this->db->query("SELECT COUNT(pemilih_id) AS tdkhadir FROM tb_pemilih WHERE pemilih_akun not in (select DISTINCT nim from tb_suara)")->row_array();
        $data['sdhPilih'] = $this->db->query("SELECT COUNT(pemilih_id) AS hadir FROM tb_pemilih WHERE pemilih_akun in (select DISTINCT nim from tb_suara)")->row_array();

        echo json_encode($data);
    }
}
