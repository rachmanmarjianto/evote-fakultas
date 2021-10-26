<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HapusPemira extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SuaraModel');
        $this->load->model('AdminModel');
        $this->load->model('TemaModel');
        if(!isset($this->session->userdata['username']))
        {
		    redirect('AdminLogin');
        }
        $data = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        if($data['role_id'] > 2) {
            redirect('/Auth_Admin/Beranda');
        }
    }

    public function index() {
        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        $data['title'] = "Hapus - E-voting";

        $this->load->view('layout/header_layout', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('content/hapusPemira', $data);
        $this->load->view('layout/footer_layout_2');
            
    }

    public function hapus(){
        echo "coming soon!";
    }
}