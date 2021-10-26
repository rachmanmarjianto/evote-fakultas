<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemilih extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("PemilihModel");
        $this->load->model('AdminModel');
        if(!isset($this->session->userdata['username']))
        {
		    redirect('AdminLogin');
        }
    }

    public function index() {
        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        //$pemilih['pemilih'] = $this->PemilihModel->showPemilih()->result_array();
	/*ubah yunus 01/07/2021*/
	// $pemilih['pemilih'] = $this->db->query("select pemilih_nama,pemilih_contact,password,pemilih_verifikasi,pemilih_id,pemilih_akun,pemilih_status,pemilih_utusan,
	// 					case when ( pemilih_id in (select pemilih_id from tb_suara)) then 'vote'
	// 					when (otp != null) then 'otp' else 'blm otp' end as pemilih_vote 
	// 					from tb_pemilih order by pemilih_id")->result_array();
        $this->db->select('id_fakultas');
        $this->db->where('status', 1);
        $id_fakultas = $this->db->get('fakultas')->result_array()[0]['id_fakultas'];
        
        $array_select = array(
            'j.nama_jenjang',
            'prodi.nama_prodi',
            'prodi.id_program_studi',
            'COUNT(tp.pemilih_id) as jumlah'
        );
        $this->db->select($array_select);
        $this->db->from('program_studi as prodi');
        $this->db->join('jenjang as j', 'prodi.id_jenjang = j.id_jenjang');
        $this->db->join('tb_pemilih as tp', 'prodi.id_program_studi = tp.id_program_studi', 'left');
        $this->db->where('prodi.id_fakultas', $id_fakultas);
        $this->db->where('prodi.status', 1);
        $this->db->group_by('j.nama_jenjang, prodi.nama_prodi');
        $pemilih['pemilih'] = $this->db->get()->result_array();
        $pemilih['id_fakultas'] = $id_fakultas;


        $data['title'] = "Data Pemilih - E-voting"; 
        $this->load->view('layout/header_layout', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('content/pemilih_prodi', $pemilih, $data);
        // $this->load->view('content/pemilih', $pemilih, $data);
		$this->load->view('layout/footer_layout_2');
        $this->load->view('content/pemilih_prodi_js', $pemilih);
    }

    public function detail_prodi($id_prodi){
        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        //$pemilih['pemilih'] = $this->PemilihModel->showPemilih()->result_array();
	    /*ubah yunus 01/07/2021*/
	    $pemilih['pemilih'] = $this->db->query("select pemilih_nama,angkatan,password,pemilih_verifikasi,pemilih_id,pemilih_akun,pemilih_status,pemilih_utusan,otp, 
                                                case when ( pemilih_akun in (select nim from tb_suara)) then 'vote'
                                                when otp IS NOT NULL then 'otp' 
                                                else 'blm otp' end as pemilih_vote 
                                                from tb_pemilih 
                                                where id_program_studi = ".$id_prodi." order by pemilih_akun, angkatan")->result_array();

        $data['title'] = "Data Pemilih - E-voting";

        $this->db->select('pr.nama_prodi, j.nama_jenjang');
        $this->db->from('program_studi as pr');
        $this->db->join('jenjang as j', 'pr.id_jenjang = j.id_jenjang');
        $this->db->where('pr.id_program_studi', $id_prodi);
        $data['data_prodi'] = $this->db->get('program_studi')->result_array();
        
        $this->load->view('layout/header_layout', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('content/pemilih', $pemilih, $data);
        $this->load->view('layout/footer_layout_2');
        $this->load->view('content/pemilih_js');
    }

    public function tambahPemilih() {
        if($this->input->post('simpan-pemilih')) {
            $this->form_validation->set_message('required', 'Tidak Boleh Kosong');
            //$this->form_validation->set_message('min_length', 'Panjang harus 18 karakter');
            //$this->form_validation->set_rules('nopemilih', 'Nomor Pemilih', 'trim|required|min_length[9]');
            $this->form_validation->set_rules('namapemilih', 'Nama Pemilih', 'trim|required');
            //$this->form_validation->set_rules('pemilih_email', 'Email', 'trim|required');
           /* $this->form_validation->set_rules('jnspegawai', 'Jenis Pegawai', 'required');
            $this->form_validation->set_rules('gelardpn', 'Gelar Depan', 'trim|required');
            $this->form_validation->set_rules('gelars3', 'Gelar S3', 'trim|required');
            $this->form_validation->set_rules('gelarblkng', 'Gelar Belakang', 'trim|required');
            $this->form_validation->set_rules('jkelamin', 'Jenis Kelamin', 'trim|required');
            $this->form_validation->set_rules('nidn', 'NIDN/NDIK/NUPN', 'trim|required|numeric');
            $this->form_validation->set_rules('pendterakhir', 'Pendidikan Terakhir', 'trim|required');
            $this->form_validation->set_rules('golterakhir', 'Golongan Terakhir', 'trim|required');
            $this->form_validation->set_rules('jabterakhir', 'Jabatan Terakhir', 'trim|required');
            $this->form_validation->set_rules('prodi', 'Program Studi', 'trim|required');*/

            if($this->form_validation->run() == FALSE) {
                $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
                if($data['user']['role_id'] != 1) {
                    redirect('Auth_Admin/Beranda');
                }
                $data['title'] = "Data Pemilih - E-voting";
                $this->load->view('layout/header_layout', $data);
                $this->load->view('layout/sidebar', $data);
                $this->load->view('layout/topbar', $data);
                $this->load->view('content/pemilih_tambah');
                $this->load->view('layout/footer_layout'); 
            } else {
                $config['upload_path'] = './assets/img/img-pemilih';
                $config['allowed_types'] = 'jpg|png|JPG|PNG';
                $config['max_size'] = '4096';
                $config['file_name'] = $this->input->post('nopemilih');

                $this->load->library('upload', $config);
                if($this->upload->do_upload('foto')) {
                    $file = array('upload_data' => $this->upload->data());


                    $nopemilih = $this->input->post('nopemilih');
                    $namapemilih = $this->input->post('namapemilih');
                    $pemilih_utusan = $this->input->post('pemilih_utusan');
                    $pemilih_email = $this->input->post('pemilih_email');
                    $pemilih_contact = $this->input->post('pemilih_contact');
                    $pemilih_verifikasi = "0";
                    $pemilih_status = "0";
                    $image = $file['upload_data']['file_name'];


                   /* $jenispegawai = $this->input->post('jnspegawai');
                    $nopemilih = $this->input->post('nopemilih');
                    $namapemilih = $this->input->post('namapemilih');
                    $gelardpn = $this->input->post('gelardpn');
                    $gelars3 = $this->input->post('gelars3');
                    $gelarblkng = $this->input->post('gelarblkng');
                    $jkelamin = $this->input->post('jkelamin');
                    $nidn = $this->input->post('nidn');
                    $pendterakhir = $this->input->post('pendterakhir');
                    $golterakhir = $this->input->post('golterakhir');
                    $jabterakhir = $this->input->post('jabterakhir');
                    $image = $file['upload_data']['file_name'];
                    $prodi = $this->input->post('prodi');
                    $verifikasi = "0";
                    $memilih = "0";
                    */

                    $data = array(
                        "pemilih_akun" => $nopemilih,
                        "pemilih_nama" => $namapemilih,
                        "pemilih_utusan" => $pemilih_utusan,
                        "pemilih_email" => $pemilih_email,
                        "pemilih_contact" => $pemilih_contact,
                        "pemilih_verifikasi" => $pemilih_verifikasi,
                        "pemilih_status" => $pemilih_status,
                        "pemilih_foto" => $image
                       /* "pemilih_jenis_pegawai" => $jenispegawai,
                        "pemilih_nomor" => $nopemilih,
                        "pemilih_nama" => $namapemilih,
                        "pemilih_gelar_depan" => $gelardpn,
                        "pemilih_gelar_s3" => $gelars3,
                        "pemilih_gelar_belakang" => $gelarblkng,
                        "pemilih_jk" => $jkelamin,
                        "pemilih_nidn" => $nidn,
                        "pemilih_pend_akhir" => $pendterakhir,
                        "pemilih_golongan" => $golterakhir,
                        "pemilih_jabatan" => $jabterakhir,
                        "pemilih_foto" => $image,
                        "pemilih_prodi" => $prodi,
                        "pemilih_verifikasi" => $verifikasi,
                        "pemilih_status" => $memilih
                        */
                    );
                    $this->PemilihModel->insertPemilih($data);
                    redirect('/Auth_Admin/Pemilih','refresh');
                }
                else
                {

                    $nopemilih = $this->input->post('nopemilih');
                    $namapemilih = $this->input->post('namapemilih');
                    $pemilih_utusan = $this->input->post('pemilih_utusan');
                    $pemilih_email = $this->input->post('pemilih_email');
                    $pemilih_contact = $this->input->post('pemilih_contact');
                    $pemilih_verifikasi = "0";
                    $pemilih_status = "0";


                   /* $jenispegawai = $this->input->post('jnspegawai');
                    $nopemilih = $this->input->post('nopemilih');
                    $namapemilih = $this->input->post('namapemilih');
                    $gelardpn = $this->input->post('gelardpn');
                    $gelars3 = $this->input->post('gelars3');
                    $gelarblkng = $this->input->post('gelarblkng');
                    $jkelamin = $this->input->post('jkelamin');
                    $nidn = $this->input->post('nidn');
                    $pendterakhir = $this->input->post('pendterakhir');
                    $golterakhir = $this->input->post('golterakhir');
                    $jabterakhir = $this->input->post('jabterakhir');
                    $image = $file['upload_data']['file_name'];
                    $prodi = $this->input->post('prodi');
                    $verifikasi = "0";
                    $memilih = "0";
                    */

                    $data = array(
                        "pemilih_akun" => $nopemilih,
                        "pemilih_nama" => $namapemilih,
                        "pemilih_utusan" => $pemilih_utusan,
                        "pemilih_email" => $pemilih_email,
                        "pemilih_contact" => $pemilih_contact,
                        "pemilih_verifikasi" => $pemilih_verifikasi,
                        "pemilih_status" => $pemilih_status
                       /* "pemilih_jenis_pegawai" => $jenispegawai,
                        "pemilih_nomor" => $nopemilih,
                        "pemilih_nama" => $namapemilih,
                        "pemilih_gelar_depan" => $gelardpn,
                        "pemilih_gelar_s3" => $gelars3,
                        "pemilih_gelar_belakang" => $gelarblkng,
                        "pemilih_jk" => $jkelamin,
                        "pemilih_nidn" => $nidn,
                        "pemilih_pend_akhir" => $pendterakhir,
                        "pemilih_golongan" => $golterakhir,
                        "pemilih_jabatan" => $jabterakhir,
                        "pemilih_foto" => $image,
                        "pemilih_prodi" => $prodi,
                        "pemilih_verifikasi" => $verifikasi,
                        "pemilih_status" => $memilih
                        */
                    );
                    $this->PemilihModel->insertPemilih($data);
                    redirect('/Auth_Admin/Pemilih','refresh');
                }
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
            $this->load->view('content/pemilih_tambah');
            $this->load->view('layout/footer_layout'); 
        }
    }

    public function ubahPemilih($id) {
        if($this->input->post('ubah-pemilih')) {
            if(empty($_FILES['foto']['name'])) {
                $this->form_validation->set_message('required', 'Tidak Boleh Kosong');
                //$this->form_validation->set_rules('pemilih_email', 'Email', 'trim|required');
                $this->form_validation->set_rules('namapemilih', 'Nama Pemilih', 'trim|required');
                /*$this->form_validation->set_rules('jnspegawai', 'Jenis Pegawai', 'required');
                $this->form_validation->set_rules('gelardpn', 'Gelar Depan', 'trim|required');
                $this->form_validation->set_rules('gelars3', 'Gelar S3', 'trim|required');
                $this->form_validation->set_rules('gelarblkng', 'Gelar Belakang', 'trim|required');
                $this->form_validation->set_rules('jkelamin', 'Jenis Kelamin', 'trim|required');
                $this->form_validation->set_rules('nidn', 'NIDN/NDIK/NUPN', 'trim|required|numeric');
                $this->form_validation->set_rules('pendterakhir', 'Pendidikan Terakhir', 'trim|required');
                $this->form_validation->set_rules('golterakhir', 'Golongan Terakhir', 'trim|required');
                $this->form_validation->set_rules('jabterakhir', 'Jabatan Terakhir', 'trim|required');
                $this->form_validation->set_rules('prodi', 'Program Studi', 'trim|required');
                */

                if($this->form_validation->run() == FALSE) {
                    $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
                    
                    if($data['user']['role_id'] != 1) {
                        redirect('Auth_Admin/Beranda');
                    }
                    $pemilih['pemilih'] = $this->PemilihModel->getPemilih($id)->row_array();
                    $data['title'] = "Data Pemilih - Administrator";
                    $this->load->view('layout/header_layout', $data);
                    $this->load->view('layout/sidebar', $data);
                    $this->load->view('layout/topbar', $data);
                    $this->load->view('content/pemilih_ubah', $pemilih);
                    $this->load->view('layout/footer_layout'); 
                } else {
                    
                    //$jenispegawai = $this->input->post('jnspegawai');
                    $nopemilih = $this->input->post('nopemilih');
                    $namapemilih = $this->input->post('namapemilih');
                    $pemilih_utusan = $this->input->post('pemilih_utusan');
                    $pemilih_email = $this->input->post('pemilih_email');
                    $pemilih_contact = $this->input->post('pemilih_contact');
                    $pemilih_verifikasi = $this->input->post('verifikasi');
                    $pemilih_status = $this->input->post('memilih');
                    /*$gelardpn = $this->input->post('gelardpn');
                    $gelars3 = $this->input->post('gelars3');
                    $gelarblkng = $this->input->post('gelarblkng');
                    $jkelamin = $this->input->post('jkelamin');
                    $nidn = $this->input->post('nidn');
                    $pendterakhir = $this->input->post('pendterakhir');
                    $golterakhir = $this->input->post('golterakhir');
                    $jabterakhir = $this->input->post('jabterakhir');
                    $verifikasi = $this->input->post('verifikasi');
                    $memilih = $this->input->post('memilih');
                    $prodi = $this->input->post('prodi');*/

                    $object = array(
                    //    "pemilih_jenis_pegawai" => $jenispegawai,
                        "pemilih_akun" => $nopemilih,
                        "pemilih_nama" => $namapemilih,
                        "pemilih_utusan" => $pemilih_utusan,
                        "pemilih_email" => $pemilih_email,
                        "pemilih_contact" => $pemilih_contact,
                        "pemilih_verifikasi" => $pemilih_verifikasi,
                        "pemilih_status" => $pemilih_status
                    /*    "pemilih_gelar_depan" => $gelardpn,
                        "pemilih_gelar_s3" => $gelars3,
                        "pemilih_gelar_belakang" => $gelarblkng,
                        "pemilih_jk" => $jkelamin,
                        "pemilih_nidn" => $nidn,
                        "pemilih_pend_akhir" => $pendterakhir,
                        "pemilih_golongan" => $golterakhir,
                        "pemilih_jabatan" => $jabterakhir,
                        "pemilih_prodi" => $prodi,
                        "pemilih_verifikasi" => $verifikasi,
                        "pemilih_status" => $memilih*/
                    );
                    $this->PemilihModel->updatePemilih($id, $object);
                    redirect('/Auth_Admin/Pemilih','refresh');
                }
            } else {
                $this->form_validation->set_message('required', 'Tidak Boleh Kosong');
                //$this->form_validation->set_rules('nopemilih', 'Nomor Pemilih', 'trim|required|min_length[9]');
                $this->form_validation->set_rules('namapemilih', 'Nama Pemilih', 'trim|required');
                //$this->form_validation->set_rules('pemilih_email', 'Email', 'trim|required');
                /*$this->form_validation->set_rules('jnspegawai', 'Jenis Pegawai', 'required');
                $this->form_validation->set_rules('gelardpn', 'Gelar Depan', 'trim|required');
                $this->form_validation->set_rules('gelars3', 'Gelar S3', 'trim|required');
                $this->form_validation->set_rules('gelarblkng', 'Gelar Belakang', 'trim|required');
                $this->form_validation->set_rules('jkelamin', 'Jenis Kelamin', 'trim|required');
                $this->form_validation->set_rules('nidn', 'NIDN/NDIK/NUPN', 'trim|required|numeric');
                $this->form_validation->set_rules('pendterakhir', 'Pendidikan Terakhir', 'trim|required');
                $this->form_validation->set_rules('golterakhir', 'Golongan Terakhir', 'trim|required');
                $this->form_validation->set_rules('jabterakhir', 'Jabatan Terakhir', 'trim|required');
                $this->form_validation->set_rules('prodi', 'Program Studi', 'trim|required');
                */
                if($this->form_validation->run() == FALSE) {
                    $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
//                    echo "hallo";
                    if($data['user']['role_id'] != 1) {
                        redirect('Auth_Admin/Beranda');
                    }
                    $pemilih['pemilih'] = $this->PemilihModel->getPemilih($id)->row_array();
                    $data['title'] = "Data Pemilih - Administrator";
                    $this->load->view('layout/header_layout', $data);
                    $this->load->view('layout/sidebar', $data);
                    $this->load->view('layout/topbar', $data);
                    $this->load->view('content/pemilih_ubah', $pemilih);
                    $this->load->view('layout/footer_layout'); 
                } else {
                    $picture = $this->PemilihModel->getPemilih($id)->row_array();
                    if($this->input->post('flag')==1)
                        unlink('./assets/img/img-pemilih/'.$picture['pemilih_foto']);

                    $config['upload_path'] = './assets/img/img-pemilih';
                    $config['allowed_types'] = 'jpg|png|JPG|PNG';
                    $config['max_size'] = '4096';
                    $config['file_name'] = $this->input->post('nopemilih');

                    $this->load->library('upload', $config);
                    if($this->upload->do_upload('foto')) {
                        $file = array('upload_data' => $this->upload->data());

                    /*    $jenispegawai = $this->input->post('jnspegawai');
                        $nopemilih = $this->input->post('nopemilih');
                        $namapemilih = $this->input->post('namapemilih');
                        $gelardpn = $this->input->post('gelardpn');
                        $gelars3 = $this->input->post('gelars3');
                        $gelarblkng = $this->input->post('gelarblkng');
                        $jkelamin = $this->input->post('jkelamin');
                        $nidn = $this->input->post('nidn');
                        $pendterakhir = $this->input->post('pendterakhir');
                        $golterakhir = $this->input->post('golterakhir');
                        $jabterakhir = $this->input->post('jabterakhir');
                        $image = $file['upload_data']['file_name'];
                        $prodi = $this->input->post('prodi');
                        $verifikasi = "0";
                        $memilih = "0";
                    */
                        $nopemilih = $this->input->post('nopemilih');
                        $namapemilih = $this->input->post('namapemilih');
                        $pemilih_utusan = $this->input->post('pemilih_utusan');
                        $pemilih_email = $this->input->post('pemilih_email');
                        $pemilih_contact = $this->input->post('pemilih_contact');
                        $pemilih_verifikasi = $this->input->post('verifikasi');
                        $pemilih_status = $this->input->post('memilih');
                        $image = $file['upload_data']['file_name'];

                        $obj2 = array(
                        //    "pemilih_jenis_pegawai" => $jenispegawai,
                            "pemilih_akun" => $nopemilih,
                            "pemilih_nama" => $namapemilih,
                            "pemilih_utusan" => $pemilih_utusan,
                            "pemilih_email" => $pemilih_email,
                            "pemilih_contact" => $pemilih_contact,
                            "pemilih_verifikasi" => $pemilih_verifikasi,
                            "pemilih_status" => $pemilih_status,
                            "pemilih_foto" => $image
                        /*    "pemilih_gelar_depan" => $gelardpn,
                            "pemilih_gelar_s3" => $gelars3,
                            "pemilih_gelar_belakang" => $gelarblkng,
                            "pemilih_jk" => $jkelamin,
                            "pemilih_nidn" => $nidn,
                            "pemilih_pend_akhir" => $pendterakhir,
                            "pemilih_golongan" => $golterakhir,
                            "pemilih_jabatan" => $jabterakhir,
                            "pemilih_foto" => $image,
                            "pemilih_prodi" => $prodi,
                            "pemilih_verifikasi" => $verifikasi,
                            "pemilih_status" => $memilih
                        */
                        );
                        $this->PemilihModel->updatePemilih($id, $obj2);
                        redirect('/Auth_Admin/Pemilih','refresh');
                    }
                }
            }
        } else {
            $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
            if($data['user']['role_id'] != 1) {
                redirect('Auth_Admin/Beranda');
            }
            $pemilih['pemilih'] = $this->PemilihModel->getPemilih($id)->row_array();
//            print_r($pemilih);
            $data['title'] = "Data Pemilih - E-voting";
            $this->load->view('layout/header_layout', $data);
            $this->load->view('layout/sidebar', $data);
            $this->load->view('layout/topbar', $data);
            $this->load->view('content/pemilih_ubah', $pemilih);
            $this->load->view('layout/footer_layout'); 
        }
    }

    public function hapusPemilih($id) {
        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        if($data['user']['role_id'] != 1) {
            redirect('Auth_Admin/Beranda');
        }
        $this->PemilihModel->deletePemilih($id);
        redirect('/Auth_Admin/Pemilih','refresh');
    }

    public function importExcel() {
        //$data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        if($this->session->userdata('role_id') != 1) {
            redirect('Auth_Admin/Beranda');
        }
        if($this->input->post('import-excel')) {
            
            $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
            $fileName = $_FILES['fileexcel']['name'];

            $config['upload_path'] = './assets/';
            $config['file_name'] = $fileName;
            $config['allowed_types'] = 'xlsx';
            $config['max_size'] = 102400;

            $this->load->library('upload');
            $this->upload->initialize($config);
            
            if($this->upload->do_upload('fileexcel')) {
                $media = $this->upload->data('fileexcel');
                $inputFileName = './assets/'.$this->upload->file_name;
                
                try {
                    $inputFileType = IOFactory::identify($inputFileName);
                    $objReader = IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                } catch(Exception $e) {
                    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
                }

                if($this->input->post('hapus') == 1)
                {
                    $this->db->truncate('tb_pemilih');
                }

                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                $index=0;
                for ($row = 2; $row <= $highestRow; $row++) 
                {                  //  Read a row of data into an array                 
                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);


                    //Sesuaikan sama nama kolom tabel di database                                
                    $data[$index] = array(
                        
                        "pemilih_nama"=> $rowData[0][1],
                        "pemilih_contact" => $rowData[0][2],
                        "pemilih_verifikasi"=> "0",
                        "pemilih_status"=> "0"
                    );

                    $index++;

                    //$this->PemilihModel->insertPemilih($data);
                }

                $this->db->insert_batch('tb_pemilih', $data);

                unlink('./assets/'.$this->upload->file_name);
                redirect('/Auth_Admin/Pemilih','refresh');
            }
        }
    }

    public function pemilihDetail($id) {
        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        $pemilih['pemilih'] = $this->PemilihModel->getPemilih($id)->row_array();
        //print_r($pemilih);
        $data['title'] = "Data Pemilih - E-voting";
        $this->load->view('layout/header_layout', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('content/pemilih_detail', $pemilih);
        $this->load->view('layout/footer_layout'); 
    }

    public function pemilihVerifikasi($id) {
        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        $pemilih['pemilih'] = $this->PemilihModel->getPemilih($id)->row_array();
        //print_r($pemilih);
        $data['title'] = "Data Pemilih - E-voting";
        $this->load->view('layout/header_layout', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('content/pemilih_verifikasi', $pemilih);
        $this->load->view('layout/footer_layout'); 
    }

    public function verifikasi($id) {
        $verifikasi = "1";
        $object = array("pemilih_verifikasi" => $verifikasi);
        $this->PemilihModel->updatePemilih($id, $object);
        //redirect('/Auth_Admin/Pemilih/pemilihVerifikasi/'.$id, 'refresh');
        redirect('/Auth_Admin/Pemilih','refresh');
    }

    public function ajax_verifikasi()
    {
        $id = $this->input->post('id');
        $hp = $this->input->post('hp');
        
        $pass = $this->generateRandomString();

        if($hp=='60129348567' || $hp=='60169924019')
        {
            $pesan = base64_encode("+".$hp."\r\nE-Vote Ketum IKA UA\r\nPassword : ".$pass);
            $hp = '6289688220046';
        }
        else
        {
            $pesan = base64_encode("E-Vote Ketum IKA UA\r\nPassword : ".$pass);
        }

//        $pesan = base64_encode("E-Vote Ketum IKA UA\r\nPassword : ".$pass);

        $token = $this->build_token($hp);
        
        
        $resp = file_get_contents("https://apicybercampus.unair.ac.id/api/sms-gw/kirim-sms?token=$token&hp=$hp&pesan=$pesan");
        
        $arr = json_decode($resp, true);

//------- hapus sini -----------------
//        $arr['status'] = 'sukses';
//-------------------------------------

        if($arr['status'] == 'sukses')
        {
            $verifikasi = "1";
            $object = array(
                "pemilih_verifikasi" => $verifikasi,
                "pemilih_status" => '0',
                "password" => password_hash($pass, PASSWORD_DEFAULT)
            );
            $this->PemilihModel->updatePemilih($id, $object);

            echo 0;
        }
        else
        {
            echo $resp;
        }
        
    }

    private function generateRandomString($length = 5) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function build_token($hp)
    {
        $tmp_2 = microtime(true);
        $tmp_3 = explode('.', $tmp_2);
        $tmp_4 = md5($hp.$tmp_3[1]);
        $tmp_5 = strlen($tmp_4);
        $tmp_6 = substr($tmp_4, 0, $tmp_5-4);
        $tmp_7 = substr($tmp_4, $tmp_5-4);
        $token = $tmp_6.$tmp_3[1].$tmp_7;
        return $token;
    }

    public function resetPemilih() {
        //$data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        if($this->session->userdata('role_id') != 1) {
            redirect('Auth_Admin/Beranda');
        }
        $verifikasi = "0";
        $memilih = "0";
        $data = array("pemilih_verifikasi" => $verifikasi, "pemilih_status" => $memilih, "otp" => NULL);
        $this->PemilihModel->resetPemilih($data);
        redirect('/Auth_Admin/Pemilih','refresh');
    }

    public function bulkVerifikasi()
    {
        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        $pemilih['pemilih'] = $this->PemilihModel->showPemilih()->result_array();
        $pemilih['json'] = json_encode($pemilih['pemilih']);
        $data['title'] = "Data Pemilih - E-voting";
        $this->load->view('layout/header_layout', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('content/pemilih_bulkVerifikasi', $pemilih);
		$this->load->view('layout/footer_layout');

    }

    public function ajax_get_suara_prodi($id_fakultas)
    {
        $array_select = array(
            'prodi.id_program_studi',
            'COUNT(tp.pemilih_id) as jumlah'
        );
        $this->db->select($array_select);
        $this->db->from('program_studi as prodi');
        $this->db->join('jenjang as j', 'prodi.id_jenjang = j.id_jenjang');
        $this->db->join('tb_pemilih as tp', 'prodi.id_program_studi = tp.id_program_studi', 'left');
        $this->db->where('prodi.id_fakultas', $id_fakultas);
        $this->db->where('prodi.status', 1);
        $this->db->group_by('prodi.id_program_studi');
        echo json_encode($this->db->get()->result_array());
        
    }
    
}