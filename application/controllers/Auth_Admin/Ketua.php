<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ketua extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('KetuaModel');
        $this->load->model('AdminModel');
        $this->load->model('TemaModel');
        $this->load->model('M_prodi');
        if(!isset($this->session->userdata['username']))
        {
		    redirect('AdminLogin');
        }
    }

	public function index()
	{
        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        $data['ketua'] = $this->KetuaModel->showKetua()->result_array();
        $data['jenis'] = $this->db->get('tb_tema_pemilihan')->result_array();
        $data['title'] = "Calon Ketua - E-voting";

        $this->load->view('layout/header_layout', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        if(count($data['jenis']))
            $this->load->view('content/ketua', $data);
        else
            $this->load->view('content/ketua_2', $data);
		$this->load->view('layout/footer_layout');
    }
    
    public function tambahKetua()
	{
        if($this->input->post('simpan_ketua')) {
            
            $this->form_validation->set_message('required', 'Tidak Boleh Kosong');
            $this->form_validation->set_message('numeric', 'Hanya Boleh Diisi Angka');
            $this->form_validation->set_rules('nama', 'Nama Calon Ketua', 'trim|required');
            $this->form_validation->set_rules('nourut', 'Nomor Urut', 'trim|required');
            $this->form_validation->set_rules('jenis', 'Jenis', 'required');
            if($this->form_validation->run() == FALSE) {
                $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
                
                if($data['user']['role_id'] != 1) {
                    redirect('Auth_Admin/Beranda');
                }
                $data['tema'] = $this->TemaModel->getTemaActive()->result_array();
                $data['title'] = "Calon Ketua - E-voting";
                $data['prodi'] = $this->M_prodi->get_prodi_fakultas(); 

                $this->load->view('layout/header_layout', $data);
                $this->load->view('layout/sidebar', $data);
                $this->load->view('layout/topbar', $data);
                $this->load->view('content/ketua_tambah', $data);
                $this->load->view('layout/footer_layout_2');
                $this->load->view('content/ketua_tambah_js', $data);
            } else {
                $config['upload_path'] = './assets/img';
                $config['allowed_types'] = 'jpg|png|JPG|PNG';
                $config['max_size'] = '4096';

                $this->load->library('upload', $config);
                if($this->upload->do_upload('foto')) {
                    $file = array('upload_data' => $this->upload->data());

                    $nama = $this->input->post('nama');
                    $nourut = $this->input->post('nourut');
                    $image = $file['upload_data']['file_name'];
                    $visimisi = $this->input->post('visimisi');
                    $jenis = $this->input->post('jenis');
                    
                    if($this->input->post('denganProdi')==1)
                        $id_prodi = $this->input->post('prodi');
                    else
                        $id_prodi = null;
                    
                    $object = array(
                        'calon_ketua_nama' => $nama,
                        'calon_ketua_nourut' => $nourut,
                        'calon_ketua_foto' => $image,
                        'calon_ketua_visimisi' => $visimisi,
                        'calon_ketua_suara' => 0,
                        'tema_id' => $jenis,
                        'id_program_studi' => $id_prodi
                    );

                    $this->KetuaModel->insertKetua($object);
                    redirect('/Auth_Admin/Ketua','refresh');
                }
                else
                {
                    $nama = $this->input->post('nama');
                    $nourut = $this->input->post('nourut');
                    $visimisi = $this->input->post('visimisi');
                    $jenis = $this->input->post('jenis');
                    
                    if($this->input->post('denganProdi')==1)
                        $id_prodi = $this->input->post('prodi');
                    else
                        $id_prodi = null;
                    
                    $object = array(
                        'calon_ketua_nama' => $nama,
                        'calon_ketua_nourut' => $nourut,
                        'calon_ketua_foto' => '',
                        'calon_ketua_visimisi' => $visimisi,
                        'calon_ketua_suara' => 0,
                        'tema_id' => $jenis,
                        'id_program_studi' => $id_prodi
                    );

                    $this->KetuaModel->insertKetua($object);
                    redirect('/Auth_Admin/Ketua','refresh');
                }
            }
        } else {
            $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
            
            if($data['user']['role_id'] != 1) {
                redirect('Auth_Admin/Beranda');
            }
            $data['tema'] = $this->TemaModel->getTemaActive()->result_array();
            $data['title'] = "Calon Ketua - E-voting";

            $data['prodi'] = $this->M_prodi->get_prodi_fakultas();            

            $this->load->view('layout/header_layout', $data);
            $this->load->view('layout/sidebar', $data);
            $this->load->view('layout/topbar', $data);
            $this->load->view('content/ketua_tambah', $data);
            $this->load->view('layout/footer_layout_2');
            $this->load->view('content/ketua_tambah_js', $data);

        }
    }
    
    public function ubahKetua($id) {
        if($this->input->post('ubah_ketua')) {
            if(empty($_FILES['foto']['name'])) {
                $this->form_validation->set_message('required', 'Tidak Boleh Kosong');
                $this->form_validation->set_message('numeric', 'Hanya Boleh Diisi Angka');
                $this->form_validation->set_rules('nama', 'Nama Calon Ketua', 'trim|required');
                $this->form_validation->set_rules('nourut', 'Nomor Urut', 'trim|required');
                if($this->form_validation->run() == FALSE) {
                    $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
                    if($data['user']['role_id'] != 1) {
                        redirect('Auth_Admin/Beranda');
                    }
                    $data['tema'] = $this->TemaModel->getTemaActive()->result_array();
                    $ketua['ketua'] = $this->KetuaModel->getKetua($id)->row();
                    $data['title'] = "Calon Ketua - E-voting";
                    $data['prodi'] = $this->M_prodi->get_prodi_fakultas();
                    $this->load->view('layout/header_layout', $data);
                    $this->load->view('layout/sidebar', $data);
                    $this->load->view('layout/topbar', $data);
                    $this->load->view('content/ketua_edit', $ketua);
                    $this->load->view('layout/footer_layout_2');
                    $this->load->view('content/ketua_edit_js', $data);
                } else {
                    $nama = $this->input->post('nama');
                    $nourut = $this->input->post('nourut');
                    $visimisi = $this->input->post('visimisi');
                    $jenis = $this->input->post('jenis');
                    if($this->input->post('prodi')=='0')
                        $prodi = null;
                    else
                        $prodi = $this->input->post('prodi');

                    $object = array(
                        "calon_ketua_nama" => $nama,
                        "calon_ketua_nourut" => $nourut,
                        "calon_ketua_visimisi" => $visimisi,
                        'tema_id' => $jenis,
                        "id_program_studi" => $prodi
                    );
                    $this->KetuaModel->updateKetua($id, $object);
                    redirect('/Auth_Admin/Ketua','refresh');
                }
            } else {
                $this->form_validation->set_message('required', 'Tidak Boleh Kosong');
                $this->form_validation->set_message('numeric', 'Hanya Boleh Diisi Angka');
                $this->form_validation->set_rules('nama', 'Nama Calon Ketua', 'trim|required');
                $this->form_validation->set_rules('nourut', 'Nomor Urut', 'trim|required');
                if($this->form_validation->run() == FALSE) {
                    $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
                    if($data['user']['role_id'] != 1) {
                        redirect('Auth_Admin/Beranda');
                    }
                    $data['tema'] = $this->TemaModel->getTemaActive()->result_array();
                    $ketua['ketua'] = $this->KetuaModel->getKetua($id)->row();
                    $data['title'] = "Calon Ketua - E-voting";
                    $this->load->view('layout/header_layout', $data);
                    $this->load->view('layout/sidebar', $data);
                    $this->load->view('layout/topbar', $data);
                    $this->load->view('content/ketua_edit', $ketua);
                    $this->load->view('layout/footer_layout_2');
                    $this->load->view('content/ketua_edit_js', $data);
                } else {
                    $getKetua = $this->KetuaModel->getKetua($id)->row();
                    unlink('./assets/img/'.$getKetua->calon_ketua_foto);

                    $config['upload_path'] = './assets/img';
                    $config['allowed_types'] = 'jpg|png|JPG|PNG';
                    $config['max_size'] = '4096';

                    $this->load->library('upload', $config);
                    if($this->upload->do_upload('foto')) {
                        $file = array('upload_data' => $this->upload->data());

                        $nama = $this->input->post('nama');
                        $nourut = $this->input->post('nourut');
                        $image = $file['upload_data']['file_name'];
                        $visimisi = $this->input->post('visimisi');
                        $jenis = $this->input->post('jenis');
                        if($this->input->post('prodi')=='0')
                            $prodi = null;
                        else
                            $prodi = $this->input->post('prodi');
                            
                        $object2 = array(
                            'calon_ketua_nama' => $nama,
                            'calon_ketua_nourut' => $nourut,
                            'calon_ketua_foto' => $image,
                            "calon_ketua_visimisi" => $visimisi,
                            'tema_id' => $jenis,
                            'id_program_studi' => $prodi
                        );
                        $this->KetuaModel->updateKetua($id, $object2);
                        redirect('/Auth_Admin/Ketua','refresh');
                    }
                }
            }
        } else {
            $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
            if($data['user']['role_id'] != 1) {
                redirect('Auth_Admin/Beranda');
            }
            $data['tema'] = $this->TemaModel->getTemaActive()->result_array();
            $ketua['ketua'] = $this->KetuaModel->getKetua($id)->row();
            $data['title'] = "Calon Ketua - E-voting";
            $data['prodi'] = $this->M_prodi->get_prodi_fakultas();

            $this->load->view('layout/header_layout', $data);
            $this->load->view('layout/sidebar', $data);
            $this->load->view('layout/topbar', $data);
            $this->load->view('content/ketua_edit', $ketua);
            $this->load->view('layout/footer_layout_2');
            $this->load->view('content/ketua_edit_js', $data);
        }
    }

    public function detailKetua($id) {
        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        $ketua['ketua'] = $this->KetuaModel->getKetua($id)->row_array();
        $data['title'] = "Calon Ketua - E-voting";
        $this->load->view('layout/header_layout', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('content/ketua_detail', $ketua);
        $this->load->view('layout/footer_layout');
    }

    public function hapusKetua($id) {
        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        if($data['user']['role_id'] != 1) {
            redirect('Auth_Admin/Beranda');
        }
        $getKetua = $this->KetuaModel->getKetua($id)->row();
        unlink('./assets/img/'.$getKetua->calon_ketua_foto);
        $this->KetuaModel->deleteKetua($id);
        redirect('/Auth_Admin/Ketua','refresh');
    }
}
