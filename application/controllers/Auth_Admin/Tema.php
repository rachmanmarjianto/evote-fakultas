<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tema extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('TemaModel');
        $this->load->model('AdminModel');
        if(!isset($this->session->userdata['username']))
        {
		    redirect('AdminLogin');
        }
        //$data = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        // if($data['role_id'] != 1) {
        //     redirect('/Auth_Admin/Beranda');
        // }
        date_default_timezone_set("Asia/Makassar");
    }

    public function index() {
        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        $tema['tema'] = $this->TemaModel->showTema()->result_array();
        $data['title'] = "Tema Pemilihan - E-voting";
        $this->load->view('layout/header_layout', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/topbar', $data);
        $this->load->view('content/tema', $tema);
		$this->load->view('layout/footer_layout');
    }

    public function tambahTema() {
        if($this->input->post('simpan-tema')) {
            
            $this->form_validation->set_message('required', 'Tidak Boleh Kosong');
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
            $this->form_validation->set_rules('date', 'Waktu', 'trim|required');
            $this->form_validation->set_rules('dateMulai', 'Waktu', 'trim|required');
            if($this->form_validation->run() == FALSE) {
                $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
                $data['title'] = "Tema Pemilihan - E-voting";
                $this->load->view('layout/header_layout', $data);
                $this->load->view('layout/sidebar');
                $this->load->view('layout/topbar', $data);
                $this->load->view('content/tema_tambah');
                $this->load->view('layout/footer_layout');
            } else {
                $config['upload_path'] = './assets/img';
                $config['allowed_types'] = 'jpg|png|JPG|PNG';
                $config['max_size'] = '4096';

                $this->load->library('upload', $config);
                if($this->upload->do_upload('foto')) {
                    $file = array('upload_data' => $this->upload->data());

                    $nama = $this->input->post('nama');
                    $date = $this->input->post('date');
                    $dateMulai = $this->input->post('dateMulai');
                    $image = $file['upload_data']['file_name'];

                    if(isset($this->input->post()['prodi']))
                        $prodi = 1;
                    else
                        $prodi = 0;

                    $convert = strtotime($date);
                    $convertMulai = strtotime($dateMulai);
                    // $obj = ['tema_nama' => $nama, 'tema_mulai' => $convertMulai, 'tema_batas' => $convert, 'tema_logo' => '', 'tema_is_active' => "0", 'prodi' => $prodi];
                    $obj = ['tema_nama' => $nama, 'tema_logo' => '', 'tema_is_active' => "0", 'prodi' => $prodi];
                    $this->TemaModel->insertTema($obj);

                    $setTime = array('tema_mulai' => $convertMulai, 'tema_batas' => $convert);
                    $this->db->set($setTime);
                    $this->db->update('tb_tema_pemilihan');
                    redirect('/Auth_Admin/Tema', 'refresh');
                }
                else
                {
                    $nama = $this->input->post('nama');
                    $date = $this->input->post('date');
                    $dateMulai = $this->input->post('dateMulai');
                    $convert = strtotime($date);
                    $convertMulai = strtotime($dateMulai);

                    if(isset($this->input->post()['prodi']))
                        $prodi = 1;
                    else
                        $prodi = 0;

                    // $obj = ['tema_nama' => $nama, 'tema_mulai' => $convertMulai, 'tema_batas' => $convert, 'tema_logo' => '', 'tema_is_active' => "0", 'prodi' => $prodi];
                    $obj = ['tema_nama' => $nama, 'tema_logo' => '', 'tema_is_active' => "0", 'prodi' => $prodi];
                    $this->TemaModel->insertTema($obj);

                    $setTime = array('tema_mulai' => $convertMulai, 'tema_batas' => $convert);
                    $this->db->set($setTime);
                    $this->db->update('tb_tema_pemilihan');
                    
                    redirect('/Auth_Admin/Tema', 'refresh');
                }
            }
        } else {
            $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
            $data['title'] = "Tema Pemilihan - E-voting";
            $this->load->view('layout/header_layout', $data);
            $this->load->view('layout/sidebar');
            $this->load->view('layout/topbar', $data);
            $this->load->view('content/tema_tambah');
		    $this->load->view('layout/footer_layout');
        } 
    }

    public function ubahTema($id) {
        if($this->input->post('simpan-tema')) {
            
            if(empty($_FILES['foto']['name'])) {
                $this->form_validation->set_message('required', 'Tidak Boleh Kosong');
                $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
                $this->form_validation->set_rules('date', 'Waktu', 'trim|required');
                $this->form_validation->set_rules('dateMulai', 'Waktu', 'trim|required');
                if($this->form_validation->run() == FALSE) {
                    $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
                    $tema['tema'] = $this->TemaModel->getTema($id)->row_array();
                    $data['title'] = "Tema Pemilihan - E-voting";
                    $this->load->view('layout/header_layout', $data);
                    $this->load->view('layout/sidebar');
                    $this->load->view('layout/topbar', $data);
                    $this->load->view('content/tema_ubah', $tema);
                    $this->load->view('layout/footer_layout');
                } else {
                    $date = $this->input->post('date');
                    $convert = strtotime($date);
                    $dateMulai = $this->input->post('dateMulai');
                    $convertMulai = strtotime($dateMulai);
                    if(isset($this->input->post()['prodi']))
                        $prodi = 1;
                    else
                        $prodi = 0;

                    $obj = ['tema_nama' => $this->input->post('nama'), 'prodi' => $prodi];
                    $this->TemaModel->updateTema($id, $obj);

                    $setTime = array('tema_mulai' => $convertMulai, 'tema_batas' => $convert);
                    $this->db->set($setTime);
                    $this->db->update('tb_tema_pemilihan');

                    redirect('/Auth_Admin/Tema', 'refresh');
                }
            } else {
                $this->form_validation->set_message('required', 'Tidak Boleh Kosong');
                $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
                $this->form_validation->set_rules('date', 'Waktu', 'trim|required');
                $this->form_validation->set_rules('dateMulai', 'Waktu', 'trim|required');
                if($this->form_validation->run() == FALSE) {
                    $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
                    $tema['tema'] = $this->TemaModel->getTema($id)->row_array();
                    $data['title'] = "Tema Pemilihan - E-voting";
                    $this->load->view('layout/header_layout', $data);
                    $this->load->view('layout/sidebar');
                    $this->load->view('layout/topbar', $data);
                    $this->load->view('content/tema_ubah', $tema);
                    $this->load->view('layout/footer_layout');
                } else {
                    $theme = $this->TemaModel->getTema($id)->row_array();
                    unlink('./assets/img/'.$theme['tema_logo']);

                    $config['upload_path'] = './assets/img';
                    $config['allowed_types'] = 'jpg|png|JPG|PNG';
                    $config['max_size'] = '4096';

                    $this->load->library('upload', $config);
                    if($this->upload->do_upload('foto')) {
                        $file = array('upload_data' => $this->upload->data());
                        $date = $this->input->post('date');
                        $convert = strtotime($date);
                        $dateMulai = $this->input->post('dateMulai');
                        $convertMulai = strtotime($dateMulai);
                        $image = $file['upload_data']['file_name'];

                        if(isset($this->input->post()['prodi']))
                            $prodi = 1;
                        else
                            $prodi = 0;

                        $obj = ['tema_nama' => $this->input->post('nama'), 'tema_logo' => $image, 'prodi' => $prodi];
                        $this->TemaModel->updateTema($id, $obj);

                        $setTime = array('tema_mulai' => $convertMulai, 'tema_batas' => $convert);
                        $this->db->set($setTime);
                        $this->db->update('tb_tema_pemilihan');
                        redirect('/Auth_Admin/Tema', 'refresh');
                    }
                    else
                    {
                        $date = $this->input->post('date');
                        $convert = strtotime($date);
                        $dateMulai = $this->input->post('dateMulai');
                        $convertMulai = strtotime($dateMulai);

                        if(isset($this->input->post()['prodi']))
                            $prodi = 1;
                        else
                            $prodi = 0;

                        $obj = ['tema_nama' => $this->input->post('nama'), 'tema_logo' => '', 'prodi' => $prodi];
                        $this->TemaModel->updateTema($id, $obj);

                        $setTime = array('tema_mulai' => $convertMulai, 'tema_batas' => $convert);
                        $this->db->set($setTime);
                        $this->db->update('tb_tema_pemilihan');
                        redirect('/Auth_Admin/Tema', 'refresh');
                    }
                }
            }
        } else {
            $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
            $tema['tema'] = $this->TemaModel->getTema($id)->row_array();
            $data['title'] = "Tema Pemilihan - E-voting";
            $this->load->view('layout/header_layout', $data);
            $this->load->view('layout/sidebar');
            $this->load->view('layout/topbar', $data);
            $this->load->view('content/tema_ubah', $tema);
		    $this->load->view('layout/footer_layout');
        }
    }

    public function hapusTema($id) {
        $theme = $this->TemaModel->getTema($id)->row_array();
        unlink('./assets/img/'.$theme['tema_logo']);
        $this->TemaModel->deleteTema($id);
        redirect('/Auth_Admin/Tema', 'refresh');
    }

    public function activeTema($id) {
        $tema = $this->TemaModel->getTema($id)->row_array();
        if($tema['tema_is_active'] == 0) {
            $this->TemaModel->updateTema($id, ['tema_is_active' => "1"]);
            redirect('/Auth_Admin/Tema', 'refresh');
        } else {
            $this->TemaModel->updateTema($id, ['tema_is_active' => "0"]);
            redirect('/Auth_Admin/Tema', 'refresh');
        }
    }

    public function activeEvote($id) {
        $tema = $this->TemaModel->getTema($id)->row_array();
        if($tema['status_vote'] == 0) {
            $this->TemaModel->updateTema($id, ['status_vote' => "1"]);
            redirect('/Auth_Admin/Tema', 'refresh');
        } else {
            $this->TemaModel->updateTema($id, ['status_vote' => "0"]);
            redirect('/Auth_Admin/Tema', 'refresh');
        }
    }
}