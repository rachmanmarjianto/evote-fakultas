<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saksi extends CI_Controller {
    

    public function __construct() {
        parent::__construct();
        $this->load->model('SaksiModel');
        $this->load->model('AdminModel');
        if(!isset($this->session->userdata['username']))
        {
		    redirect('AdminLogin');
        }
    }

    public function index() {
        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        $data['title'] = "Data Pemilih - E-voting";
        $data['saksi'] = $this->SaksiModel->getSaksi();
        $this->load->view('layout/header_layout', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('content/saksi', $data);
		$this->load->view('layout/footer_layout');
    }

    public function tambahSaksi() {
        if($this->input->post('tambah')) {
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
            $this->form_validation->set_rules('nip', 'NIP', 'trim|required|min_length[17]|numeric');
            $this->form_validation->set_rules('pangkat', 'Pangkat', 'trim|required');
            if($this->form_validation->run() == FALSE) {
                $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
                if($data['user']['role_id'] != 1) {
                    redirect('Auth_Admin/Beranda');
                }
                $data['title'] = "Data Pemilih - E-voting";
                $this->load->view('layout/header_layout', $data);
                $this->load->view('layout/sidebar', $data);
                $this->load->view('layout/topbar', $data);
                $this->load->view('content/saksi_tambah');
                $this->load->view('layout/footer_layout');
            } else {
                $nama = $this->input->post('nama');
                $nip = $this->input->post('nip');
                $pangkat = $this->input->post('pangkat');
                $obj = [
                    "saksi_nama" => $nama,
                    "saksi_nip" => $nip,
                    "saksi_pangkat" => $pangkat
                ];
                $this->SaksiModel->insertSaksi($obj);
                redirect('Auth_Admin/Saksi');
            }
        } else {
            $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
            if($data['user']['role_id'] != 1) {
                redirect('Auth_Admin/Beranda');
            }
            $data['title'] = "Data Pemilih - E-voting";
            $this->load->view('layout/header_layout', $data);
            $this->load->view('layout/sidebar', $data);
            $this->load->view('layout/topbar', $data);
            $this->load->view('content/saksi_tambah');
            $this->load->view('layout/footer_layout');
        }
    }

    public function editSaksi($id) {
        if($this->input->post('edit')) {
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
            $this->form_validation->set_rules('nip', 'NIP', 'trim|required|min_length[17]|numeric');
            $this->form_validation->set_rules('pangkat', 'Pangkat', 'trim|required');
            if($this->form_validation->run() == FALSE) {
                $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
                if($data['user']['role_id'] != 1) {
                    redirect('Auth_Admin/Beranda');
                }
                $data['title'] = "Data Pemilih - E-voting";
                $this->load->view('layout/header_layout', $data);
                $this->load->view('layout/sidebar', $data);
                $this->load->view('layout/topbar', $data);
                $this->load->view('content/saksi_edit', $data);
                $this->load->view('layout/footer_layout');
            } else {
                $nama = $this->input->post('nama');
                $nip = $this->input->post('nip');
                $pangkat = $this->input->post('pangkat');
                $obj = [
                    "saksi_nama" => $nama,
                    "saksi_nip" => $nip,
                    "saksi_pangkat" => $pangkat
                ];
                $this->SaksiModel->updateSaksi($id, $obj);
                redirect('Auth_Admin/Saksi');
            }
        } else {
            $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
            if($data['user']['role_id'] != 1) {
                redirect('Auth_Admin/Beranda');
            }
            $data['title'] = "Data Pemilih - E-voting";
            $data['saksi'] = $this->SaksiModel->getSaksiOne($id);
            $this->load->view('layout/header_layout', $data);
            $this->load->view('layout/sidebar', $data);
            $this->load->view('layout/topbar', $data);
            $this->load->view('content/saksi_edit', $data);
            $this->load->view('layout/footer_layout');
        }
    }

    public function hapusSaksi($id) {
        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        if($data['user']['role_id'] != 1) {
            redirect('Auth_Admin/Beranda');
        }
        $this->SaksiModel->deleteSaksi($id);
        redirect('Auth_Admin/Saksi');
    }
}