<?php
ini_set('display_error', '0');
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminLogin extends CI_Controller {

	public function index()
	{
		if($this->input->post('login')) {
			$this->form_validation->set_message('required', 'Tidak Boleh Kosong');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			if($this->form_validation->run() == FALSE) {
				$this->load->view('login_layout/admin_login');
			} else {
				$this->_login();
			}
		} else {
			$this->load->view('login_layout/admin_login');
		}
	}

/*	private function _login() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->db->get_where('tb_admin', ['admin_username' => $username])->row_array();

		if($user) {
			if(password_verify($password, $user['admin_password'])) {
				$data = [
					'username' => $user['admin_username'],
					'role_id' => $user['role_id']
				];
				$this->session->set_userdata($data);
				redirect('/Auth_Admin/Beranda', 'refresh');
				
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah</a>');
				redirect('AdminLogin');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username Tidak Terdaftar</a>');
			redirect('AdminLogin');
		}
	}
*/

	private function _login() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$ch = curl_init();

        $data=array(
            'LoginForm[username]' => $username, 
            'LoginForm[password]' => $password
        );

        curl_setopt($ch, CURLOPT_URL, 'https://apicybercampus.unair.ac.id/api/auth/login');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
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

		if($data['status'] == 'success') {
			$this->db->where('admin_username', $data['data']['username']);
			$user = $this->db->get('tb_admin')->result_array();

			

			if(count($user)) {
				$data = [
					'username' => $user[0]['admin_username'],
					'role_id' => $user[0]['role_id'],
					'nama' => $user[0]['admin_nama']
				];
				$this->session->set_userdata($data);
				redirect('/Auth_Admin/Beranda', 'refresh');
				
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah</a>');
				redirect('AdminLogin');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username Tidak Terdaftar</a>');
			redirect('AdminLogin');
		}

	}


	public function logout() {
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_id');
		redirect('AdminLogin');
	}
}
