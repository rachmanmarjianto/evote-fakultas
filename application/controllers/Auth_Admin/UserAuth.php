<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserAuth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('AdminModel');
        //$data = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        // if($data['role_id'] != 1) {
        //     redirect('/Auth_Admin/Beranda');
        // }
        if(!isset($this->session->userdata['username']))
        {
		    redirect('AdminLogin');
        }
    }

	public function index()
	{
        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        $data['userdata'] = $this->UserModel->showUser()->result_array();
        $data['title'] = "User Management - E-voting";
        $data['role_id'] = $_SESSION['role_id'];

        
        $this->load->view('layout/header_layout', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('content/user', $data);
		$this->load->view('layout/footer_layout');
        
    }
    
    public function tambahUser() {
        if($this->input->post('simpan-user')) {
            $this->form_validation->set_message('required', 'Tidak Boleh Kosong');
            $this->form_validation->set_message('is_unique', 'Username Sudah Digunakan');
            $this->form_validation->set_message('min_length', 'Username Minimal 6 Karakter');
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[tb_admin.admin_username]|min_length[6]');
            // $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', ['matches' => "Password don't match!", 'min_length' => 'Password too short!']);
		    // $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
            $this->form_validation->set_rules('role', 'Role', 'trim|required');
            if($this->form_validation->run() == FALSE) {
                $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
                $data['title'] = "User Management - E-voting";
                $data['role'] = $this->UserModel->getLessPrivRole()->result_array();
                $this->db->where('status', 1);
                $data['fakultas'] = $this->db->get('fakultas')->result_array();

                $this->load->view('layout/header_layout', $data);
                $this->load->view('layout/sidebar', $data);
                $this->load->view('layout/topbar', $data);
                $this->load->view('content/user_tambah', $data);
                $this->load->view('layout/footer_layout_2'); 
                $this->load->view('content/user_tambah_js');
            } else {
                
                $nama = $this->input->post('nama');
                $username = $this->input->post('username');
                //$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
                $role = $this->input->post('role');

                $obj = [
                    'admin_nama' => $nama,
                    'admin_username' => $username,
                    //'admin_password' => $password,
                    'role_id' => $role
                ];

                $this->UserModel->insertUser($obj);
                redirect('Auth_Admin/UserAuth', 'refresh');

            }
        } else {
            $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
            $data['title'] = "User Management - E-voting";
            $data['role'] = $this->UserModel->getLessPrivRole()->result_array();

            $this->db->where('status', 1);
            $data['fakultas'] = $this->db->get('fakultas')->result_array();

            $this->load->view('layout/header_layout', $data);
            $this->load->view('layout/sidebar', $data);
            $this->load->view('layout/topbar', $data);
            $this->load->view('content/user_tambah', $data);
            $this->load->view('layout/footer_layout_2'); 
            $this->load->view('content/user_tambah_js');
        }
    }
    public function hapusUser($id) {
        // $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        // if($data['user']['role_id'] != 1) {
        //     redirect('Auth_Admin/Beranda');
        // }
        $this->UserModel->deleteUser($id);
        redirect('Auth_Admin/UserAuth');
    }

    public function getUserFromCyber(){
        $role = $this->input->post()['role'];
        $nim = $this->input->post()['nim'];
        $fakultas = $this->input->post()['fakultas'];

        switch($role){
            case '0': //Mahasiswa
                $url='https://apicybercampus.unair.ac.id/api/mahasiswa-v3?access-token=23pZFzBJOV8FDFTgSBEGn7Q2DMRek_eU&NIM_MHS='.$nim.'&expand=programStudi';
                break;
            case '1'://Pegawai
                $url='https://apicybercampus.unair.ac.id/api/pegawai?access-token=23pZFzBJOV8FDFTgSBEGn7Q2DMRek_eU&NIP_PEGAWAI='.$nim;
                break;
            case '2':
                $url='https://apicybercampus.unair.ac.id/api/dosen-v3?access-token=23pZFzBJOV8FDFTgSBEGn7Q2DMRek_eU&NIP_DOSEN='.$nim.'&expand=programStudi';
                break;
        }

        $ch = curl_init();

        // $data=array(
        //     'LoginForm[username]' => $username, 
        //     'LoginForm[password]' => $password
        // );

        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        curl_setopt($ch, CURLOPT_TIMEOUT, 300);

        // In real life you should use something like:
        // curl_setopt($ch, CURLOPT_POSTFIELDS, 
        //          http_build_query(array('postvar1' => 'value1')));

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close ($ch);

        $data = json_decode($server_output, true);
        
        //print_r($data);
        
        if($_SESSION['role_id']==1)
        {
            if(count($data['items']) > 0)
            {
                echo $server_output;
            }
            else
            {
                echo 0;
            }
        }
        else
        {
            

            if(count($data['items']) > 0)
            {
                if($data['items'][0]['pengguna']['JOIN_TABLE']==1){
                    $this->db->where('id_unit_kerja', $data['items'][0]['id_unit_kerja_sd']);
                    $tabel = $this->db->get('unit_kerja')->result_array();
        
                    $id_fakultas = $tabel[0]['id_fakultas'];
        
                }
                //dosen / mahasiswa
                else{
                    $id_fakultas = $data['items'][0]['programStudi']['fakultas']['id'];
                }
                
                if($fakultas == $id_fakultas)
                    echo $server_output;
                else
                    echo 0;
            }
            else{
                echo 0;
            }

        }

        
        
    }
}
