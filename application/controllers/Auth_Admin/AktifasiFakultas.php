<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AktifasiFakultas extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
        if(!isset($this->session->userdata['username']))
        {
		    redirect('AdminLogin');
        }

        // if($this->session->userdata['role_id'] != 1)
        // {
        //     $this->load->view('403');
        //     return;
        // }
    }

    public function index() {

        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        $data['title'] = "Aktifasi Fakultas - E-voting";
        $data['fakultas']=$this->db->get('fakultas')->result_array();

        // print_r($data);

        // echo '<br><br>'.$data['user']['role_id'];
        
        $this->load->view('layout/header_layout', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        if($data['user']['role_id']==1)
            $this->load->view('content/aktifasiFakultas', $data);
        else
            $this->load->view('content/aktifasiFakultas2', $data);
		$this->load->view('layout/footer_layout_2');
        $this->load->view('content/aktifasiFakultas_js');
    }

    public function aktifasi($id, $status){
        $this->db->set('status', 0);
        $this->db->update('fakultas');

        $this->db->set('status', 1);
        $this->db->where('id_fakultas', $id);
        $this->db->update('fakultas');

        redirect('Auth_Admin/AktifasiFakultas');
    }
}
?>