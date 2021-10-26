<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PemilihAuth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('TemaModel');
        $this->load->model('HasilModel');
        $this->load->model('PemilihModel');
        $this->load->helper('captcha');
    }

    public function index() {
        if($this->input->post('login-pemilih')) {
            $this->form_validation->set_message('required', 'Tidak Boleh Kosong');
            $this->form_validation->set_rules('nopemilih', 'Nomor Pemilih', 'required|trim');
            $this->form_validation->set_rules('capt', 'Captcha', 'required|trim');
            if($this->form_validation->run() == FALSE) {
               // $this->load->view('login_layout/pemilih_login');
               $this->buka_index();
            } else {
                $this->_loginPemilih();
            }
        } else {
            $this->buka_index();
        }
    }

    private function buka_index()
    {
        $config = array(
            'img_url' => base_url() . 'assets/image_for_captcha/',
            'img_path' => 'assets/image_for_captcha/',
            'font_path'     => FCPATH.'system/fonts/texb.ttf',
            'img_height' => 60,
            'word_length' => 4,
            'img_width' => '250',
            'pool' => 'ABCDEGHIJKLMNOPQRSTUVWXYZ',
            'font_size'     => 72,
            'colors'        => array(
                    'background' => array(255, 255, 255),
                    'border' => array(255, 255, 255),
                    'text' => array(0, 0, 0),
                    'grid' => array(255, 40, 40)
            )
        );
        $captcha = create_captcha($config);
        $this->session->unset_userdata('valuecaptchaCode');
        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
        $data['captchaImg'] = $captcha['image'];

        $data['fakultas'] = $this->db->get_where('fakultas', ['status' => 1])->result_array()[0]['nama_fakultas'];
        $data['tema'] = $this->db->get_where('tb_tema_pemilihan', ['tema_is_active' => "1"])->result_array();
        
        date_default_timezone_set('Asia/Jakarta');
        $timenow=time();

        // echo date('m-d-Y h:i A', $data['tema'][0]['tema_mulai'])." ".$data['tema'][0]['tema_mulai']."<br>";
        // echo date('m-d-Y h:i A', $data['tema'][0]['tema_batas'])." ".$data['tema'][0]['tema_batas']."<br>";
        // echo date('m-d-Y h:i A', $timenow)." ".$timenow;

        if($timenow < $data['tema'][0]['tema_mulai']){
            $this->load->view('login_layout/pemilih_login_blm', $data);
        }
        else if($timenow > $data['tema'][0]['tema_batas']){
            $this->load->view('login_layout/pemilih_login_selesai', $data);
        }
        else
            $this->load->view('login_layout/pemilih_login', $data);
    }

    public function refresh()
    {
        $config = array(
            'img_url' => base_url() . 'assets/image_for_captcha/',
            'img_path' => 'assets/image_for_captcha/',
            'font_path'     => FCPATH.'system/fonts/texb.ttf',
            'img_height' => 60,
            'word_length' => 4,
            'img_width' => '250',
            'pool' => 'ABCDEGHIJKLMNOPQRSTUVWXYZ',
            'font_size'     => 72,
            'colors'        => array(
                    'background' => array(255, 255, 255),
                    'border' => array(255, 255, 255),
                    'text' => array(0, 0, 0),
                    'grid' => array(255, 40, 40)
            )
        );
        $captcha = create_captcha($config);
        $this->session->unset_userdata('valuecaptchaCode');
        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
        echo $captcha['image'];
    }

    private function _loginPemilih() {
        $username = $this->input->post('nopemilih');
		$password = $this->input->post('passwd');

        $captcha_insert = $this->input->post('capt');
        $contain_sess_captcha = $this->session->userdata('valuecaptchaCode');

        if (strtoupper($captcha_insert) != $contain_sess_captcha) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Captcha Tidak Sesuai!</div>');
            redirect('PemilihAuth');
        }
		
		//SSO Cybercampus
		//test 041311333032 Mia
		if ($password!='' or $password!='')
		{
            // $username = $this->input->post('username');
            // $password = $this->input->post('password');

            $ch = curl_init();

            $dataForm=array(
                'LoginForm[username]' => $username, 
                'LoginForm[password]' => $password
            );

            curl_setopt($ch, CURLOPT_URL, 'https://apicybercampus.unair.ac.id/api/auth/login');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$dataForm);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
            curl_setopt($ch, CURLOPT_TIMEOUT, 300);

            // In real life you should use something like:
            // curl_setopt($ch, CURLOPT_POSTFIELDS, 
            //          http_build_query(array('postvar1' => 'value1')));

            // Receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output = curl_exec($ch);

            curl_close ($ch);

            $mydata = json_decode($server_output, true);

            $data['fakultas'] = $this->db->get_where('fakultas', ['status' => 1])->result_array();

            if($mydata['status']=='error'){
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                NIM / Password salah </div>');
                redirect('PemilihAuth');
            }
            else
            {
                if($mydata['data']['role'] != "mhs"){
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Anda Tidak Memilik Hak Akses </div>');
                    redirect('PemilihAuth');
    
                }
                else if($mydata['data']['fakultas'] != $data['fakultas'][0]['id_fakultas']){
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Fakultas Anda Tidak Sesuai </div>');
                    redirect('PemilihAuth');
                }
                else
                {
                    $this->db->where('pemilih_akun', $mydata['data']['username']);
                    $pemilih = $this->db->get('tb_pemilih')->result_array();
                    $flag = 0;
                    
                    if(count($pemilih) == 0){
                        $insert_array = array(
                            'pemilih_akun' => $mydata['data']['username'],
                            'pemilih_nama' => $mydata['data']['name'],
                            'pemilih_contact' => $mydata['data']['phone'],
                            'pemilih_verifikasi' => "1",
                            'pemilih_status' => "0",
                            'id_program_studi' => $mydata['data']['mahasiswa']['ID_PROGRAM_STUDI'],
                            'angkatan' => $mydata['data']['mahasiswa']['THN_ANGKATAN_MHS'],
                        );
    
                        $this->db->set($insert_array);
                        $this->db->insert('tb_pemilih');
    
                        $flag =1;
    
                    }
                    else if($pemilih[0]['pemilih_status'] == 1)
                    {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Anda Telah Memberikan Suara</div>');
                        redirect('PemilihAuth');
                    }
                    else{
                        $flag =1;
                    }
    
                    if($flag){
                        $this->kirim_otp($mydata['data']['username'], $mydata['data']['phone']);
                        $data['user'] = $mydata['data']['username'];
                        $data['usernama'] = $mydata['data']['name'];
                           
                        $data['tema']= $this->db->query("select * from tb_tema_pemilihan where tema_is_active='1' and status_vote=1")->result_array();
                        $data['countTema'] = $this->TemaModel->countTema();
                        $data['hasilCount'] = $this->HasilModel->countPemilih($data['user']);
                        $data['phone'] = $mydata['data']['phone'];
                        //$data['']
    
                        $sesdata = [
                            'pemilih_nomor' => $mydata['data']['username'],
                            'pemilih_id' => $mydata['data']['username'],
                            'pemilih_contact' => $mydata['data']['phone'],
                            'tema' => $data['tema'],
                            'otp_verif' => 0,
                            'prodi' => $mydata['data']['mahasiswa']['ID_PROGRAM_STUDI']
                        ];
                        $this->session->set_userdata($sesdata);
    
                        $this->load->view('layout/pemilih_header');
                        $this->load->view('content/pemilih_auth', $data);
                        $this->load->view('layout/pemilih_footer');
    
    
                    }
                    else
                    {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        Unknown Error</div>');
                        redirect('PemilihAuth');
                    }
    
                    
    
                    
                }
            }

            
            


            //$noHP = '62'.substr($nopemilih, 1);
			//$user = $this->db->get_where('tb_pemilih', ['pemilih_contact' => $nopemilih])->row_array();
			/* edit yunus 30/01/2021 */
			// $user = $this->db->query("select pemilih_nama,pemilih_contact,password,pemilih_verifikasi,pemilih_id,pemilih_akun,
			// 			   case when ( pemilih_id in (select pemilih_id from tb_suara)) then 1 else 0 end as pemilih_status 
			// 			   from tb_pemilih where pemilih_contact='$nopemilih'")->row_array();


            // if($user) {
				
            //     if(password_verify(strtoupper($passwd), $user['password'])) {
            //         if($user['pemilih_verifikasi'] == 1) {
            //             if($user['pemilih_status'] == 0) {
                            
                            
            //                 //redirect('PemilihAuth/pemilihIsLogin');

            //                 $this->kirim_otp($user['pemilih_id'], $user['pemilih_contact']);

            //                 $data['user'] = $user['pemilih_id'];
                       
            //                 $data['tema']= $this->db->query("select * from tb_tema_pemilihan where tema_is_active='1' and (status='0')")->result_array();
            //                 $data['countTema'] = $this->TemaModel->countTema();
            //                 $data['hasilCount'] = $this->HasilModel->countPemilih($data['user']);

            //                 $sesdata = [
            //                     'pemilih_nomor' => $user['pemilih_akun'],
            //                     'pemilih_id' => $user['pemilih_id'],
            //                     'pemilih_contact' => $user['pemilih_contact'],
            //                     'tema' => $data['tema'],
            //                     'otp_verif' => 0
            //                 ];
            //                 $this->session->set_userdata($sesdata);

            //                 $this->load->view('layout/pemilih_header');
            //                 $this->load->view('content/pemilih_auth', $data);
            //                 $this->load->view('layout/pemilih_footer');
            //             }
            //             else{
            //                 $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            //                 Anda Sudah Memilih!</div>');
            //                 redirect('PemilihAuth');

            //             }

            //         } else {
            //             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            //             Anda Belum Diverifikasi!</div>');
            //             redirect('PemilihAuth');
            //         }
            //     } else {
            //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            //         Username atau Password Salah!</div>'); 
            //         redirect('PemilihAuth');
            //     }
            // } else {
            //     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            //     Data Anda Tidak Terdaftar!</div>');
            //     redirect('PemilihAuth');
            // }
		
			
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
			User dan Password Anda tidak boleh kosong </div>');
			redirect('PemilihAuth');
		}
		
    }

    
    // private function _loginPemilih() {
    //     $nopemilih = $this->input->post('nopemilih');
	// 	$passwd = $this->input->post('passwd');

    //     $captcha_insert = $this->input->post('capt');
    //     $contain_sess_captcha = $this->session->userdata('valuecaptchaCode');

    //     if (strtoupper($captcha_insert) != $contain_sess_captcha) {
    //         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    //         Captcha Tidak Sesuai!</div>');
    //         redirect('PemilihAuth');
    //     }
		
	// 	//SSO Cybercampus
	// 	//test 041311333032 Mia
	// 	if ($nopemilih!='' or $passwd!='')
	// 	{
    //         //$noHP = '62'.substr($nopemilih, 1);
	// 		//$user = $this->db->get_where('tb_pemilih', ['pemilih_contact' => $nopemilih])->row_array();
	// 		/* edit yunus 30/01/2021 */
	// 		$user = $this->db->query("select pemilih_nama,pemilih_contact,password,pemilih_verifikasi,pemilih_id,pemilih_akun,
	// 					   case when ( pemilih_id in (select pemilih_id from tb_suara)) then 1 else 0 end as pemilih_status 
	// 					   from tb_pemilih where pemilih_contact='$nopemilih'")->row_array();


    //         if($user) {
				
    //             if(password_verify(strtoupper($passwd), $user['password'])) {
    //                 if($user['pemilih_verifikasi'] == 1) {
    //                     if($user['pemilih_status'] == 0) {
                            
                            
    //                         //redirect('PemilihAuth/pemilihIsLogin');

    //                         $this->kirim_otp($user['pemilih_id'], $user['pemilih_contact']);

    //                         $data['user'] = $user['pemilih_id'];
                       
    //                         $data['tema']= $this->db->query("select * from tb_tema_pemilihan where tema_is_active='1' and (status='0')")->result_array();
    //                         $data['countTema'] = $this->TemaModel->countTema();
    //                         $data['hasilCount'] = $this->HasilModel->countPemilih($data['user']);

    //                         $sesdata = [
    //                             'pemilih_nomor' => $user['pemilih_akun'],
    //                             'pemilih_id' => $user['pemilih_id'],
    //                             'pemilih_contact' => $user['pemilih_contact'],
    //                             'tema' => $data['tema'],
    //                             'otp_verif' => 0
    //                         ];
    //                         $this->session->set_userdata($sesdata);

    //                         $this->load->view('layout/pemilih_header');
    //                         $this->load->view('content/pemilih_auth', $data);
    //                         $this->load->view('layout/pemilih_footer');
    //                     }
    //                     else{
    //                         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    //                         Anda Sudah Memilih!</div>');
    //                         redirect('PemilihAuth');

    //                     }

    //                 } else {
    //                     $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    //                     Anda Belum Diverifikasi!</div>');
    //                     redirect('PemilihAuth');
    //                 }
    //             } else {
    //                 $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    //                 Username atau Password Salah!</div>'); 
    //                 redirect('PemilihAuth');
    //             }
    //         } else {
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
    //             Data Anda Tidak Terdaftar!</div>');
    //             redirect('PemilihAuth');
    //         }
		
			
	// 	} else {
	// 		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
	// 		User dan Password Anda tidak boleh kosong </div>');
	// 		redirect('PemilihAuth');
	// 	}
		
    // }

    /*
    public function pemilihIsLogin() {
        $this->user['user'] = $this->db->get_where('tb_pemilih', ['pemilih_nomor'  => $this->session->userdata('pemilih_nomor')])->row_array();
        if($this->user['user'] == "") {
            redirect('PemilihAuth', 'refresh');
        }
        $data['user'] = $this->user['user']['pemilih_id'];
        $data['usernama'] = $this->user['user']['pemilih_nama'];
        $data['tema'] = $this->TemaModel->getTemaActive()->result_array();
        $data['countTema'] = $this->TemaModel->countTema();
        $data['hasilCount'] = $this->HasilModel->countPemilih($data['user']);
        $this->load->view('layout/pemilih_header');
        $this->load->view('content/pemilih_auth', $data);
        $this->load->view('layout/pemilih_footer');
    }*/
    
    public function pemilihIsLogin() {
        $this->user['user'] = $this->db->get_where('tb_pemilih', ['pemilih_id'  => $this->session->userdata('pemilih_id')])->row_array();
        if($this->user['user'] == "") {
            redirect('PemilihAuth', 'refresh');
        }
        $data['user'] = $this->user['user']['pemilih_id'];
        $data['usernama'] = $this->user['user']['pemilih_nama'];
		//$data['kode_prodi'] = $this->user['user']['kd_prodi'];
        //$data['tema'] = $this->TemaModel->getTemaActive()->result_array();
		$data['tema']= $this->db->query("select * from tb_tema_pemilihan where tema_is_active='1' and (status='0')")->result_array();
        $data['countTema'] = $this->TemaModel->countTema();
        $data['hasilCount'] = $this->HasilModel->countPemilih($data['user']);
        $this->load->view('layout/pemilih_header');
        $this->load->view('content/pemilih_auth', $data);
        $this->load->view('layout/pemilih_footer');
    }


    /*public function pemilihMemilih($id) {
        $this->user['user'] = $this->db->get_where('tb_pemilih', ['pemilih_nomor'  => $this->session->userdata('pemilih_nomor')])->row_array();
        if($this->user['user'] == "") {
            redirect('PemilihAuth', 'refresh');
        }
        $data['tema'] = $this->TemaModel->getTema($id)->row_array();
        $data['calon'] = $this->HasilModel->getCalon($id)->result_array();
        $this->load->view('layout/pemilih_header');
        $this->load->view('content/pemilih_memilih', $data);
        $this->load->view('layout/pemilih_footer');
    }*/

    public function pemilihMemilih() {
        if($this->session->userdata('otp_verif')==1)
        {
            //$id = $this->session->userdata("tema")[0]["tema_id"];
            $this->user['user'] = $this->db->get_where('tb_pemilih', ['pemilih_akun'  => $this->session->userdata('pemilih_id')])->row_array();
            if($this->user['user'] == "") {
                redirect('PemilihAuth', 'refresh');
            }
            // $data['tema'] = $this->TemaModel->getTema($id)->row_array();
            // $data['calon'] = $this->HasilModel->getCalon($id)->result_array();

            $data['calon'] =array();
            $mytemadata['calon']=array();
            $help=array();

            $array_select = array(
                'tck.calon_ketua_id',
                'tck.calon_ketua_nama',
                'tck.calon_ketua_nourut',
                'tck.calon_ketua_foto',
                'tck.tema_id',
                'ttp.tema_nama'
            );
            $this->db->select($array_select);
            $this->db->from('tb_calon_ketua as tck');
            $this->db->join('tb_tema_pemilihan as ttp', 'tck.tema_id = ttp.tema_id');
            $this->db->where('tck.id_program_studi IS NULL');
            $this->db->where('ttp.tema_is_active', "1");
            $this->db->where('ttp.status_vote', 1);
            $this->db->order_by('tck.tema_id, tck.calon_ketua_nourut');
            $result = $this->db->get()->result_array();
            //$data['calon']['global'] = $result;

            for($i=0; $i<count($result); $i++){
                if(!array_key_exists($result[$i]['tema_id'], $data['calon']))
                {
                    $data['calon'][$result[$i]['tema_id']] = array(
                        'tema_id' => $result[$i]['tema_id'],
                        'tema_nama' => $result[$i]['tema_nama'],
                        'calon' => array()
                    );
                }     
                $num = count($data['calon'][$result[$i]['tema_id']]['calon']);
                $data['calon'][$result[$i]['tema_id']]['calon'][$num] = array(
                    'calon_ketua_id' => $result[$i]['calon_ketua_id'],
                    'calon_ketua_nama' => $result[$i]['calon_ketua_nama'],
                    'calon_ketua_nourut' => $result[$i]['calon_ketua_nourut'],
                    'calon_ketua_foto' => $result[$i]['calon_ketua_foto'],
                );  
                
                //$arnum = count($mytemadata['tema']);
                $help[$result[$i]['tema_id']] = array(
                    'tema_id' => $result[$i]['tema_id'],
                    'tema_nama'=>$result[$i]['tema_nama']
                );
                $mytemadata['calon'][$result[$i]['calon_ketua_id']] = $data['calon'][$result[$i]['tema_id']]['calon'][$num];
            }

            $this->db->select($array_select);
            $this->db->from('tb_calon_ketua as tck');
            $this->db->join('tb_tema_pemilihan as ttp', 'tck.tema_id = ttp.tema_id');
            $this->db->where('tck.id_program_studi IS NOT NULL');
            $this->db->where('ttp.tema_is_active', "1");
            $this->db->where('ttp.status_vote', 1);
            $this->db->where('id_program_studi', $this->session->userdata('prodi'));
            $this->db->order_by('tck.tema_id, tck.calon_ketua_nourut');
            $result = $this->db->get()->result_array();
            //$data['calon']['prodi'] = $result;

            for($i=0; $i<count($result); $i++){
                if(!array_key_exists($result[$i]['tema_id'], $data['calon']))
                {
                    $data['calon'][$result[$i]['tema_id']] = array(
                        'tema_id' => $result[$i]['tema_id'],
                        'tema_nama' => $result[$i]['tema_nama'],
                        'calon' => array()
                    );
                }     
                $num = count($data['calon'][$result[$i]['tema_id']]['calon']);
                $data['calon'][$result[$i]['tema_id']]['calon'][$num] = array(
                    'calon_ketua_id' => $result[$i]['calon_ketua_id'],
                    'calon_ketua_nama' => $result[$i]['calon_ketua_nama'],
                    'calon_ketua_nourut' => $result[$i]['calon_ketua_nourut'],
                    'calon_ketua_foto' => $result[$i]['calon_ketua_foto'],
                );   
                
                $help[$result[$i]['tema_id']] = array(
                    'tema_id' => $result[$i]['tema_id'],
                    'tema_nama'=>$result[$i]['tema_nama']
                );
                $mytemadata['calon'][$result[$i]['calon_ketua_id']] = $data['calon'][$result[$i]['tema_id']]['calon'][$num];
            }

            $i=0;
            foreach($help as $te){
                $mytemadata['tema'][$i] = $te;
                $i++;
            }


            $footerdata['data'] = base64_encode(json_encode($mytemadata));
            

            $this->load->view('layout/pemilih_header');
            $this->load->view('content/pemilih_memilih', $data);
            $this->load->view('layout/pemilih_memilih_footer', $footerdata);
        }
        else
        {
            echo "FORBIDDEN";
        }
        
    }

    public function mySuara(){
        //print_r($this->input->post());
        date_default_timezone_set('Asia/Jakarta');
        $timestamp=date('Y-m-d H:i:s');
        $suratSuara = json_decode($this->input->post()['suratSuara'], true);
        //print_r($suratSuara);

        //whether ip is from share internet
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   
        {
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from proxy
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
        {
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //whether ip is from remote address
        else
        {
        $ip_address = $_SERVER['REMOTE_ADDR'];
        }

        $toSubmit = array();
        $i=0;
        foreach($suratSuara as $sSuara){
            $toSubmit[$i]=array(
                'nim' => $this->session->userdata()['pemilih_id'],
                'tema_id' => $sSuara['tema_id'],
                'calon_id' => $sSuara['calon_id'],
                'tanggal' => $timestamp,
                'ip_pemilih' => $ip_address
            );

            $i++;
        }
        
        $this->db->trans_start();
        $this->db->insert_batch('tb_suara', $toSubmit);
        $this->db->set('pemilih_status', '1');
        $this->db->where('pemilih_akun', $this->session->userdata()['pemilih_id']);
        $this->db->update('tb_pemilih');
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            echo 'Proses submit Suara Anda Gagal, silahkan anda ulangi lagi!';
        }
        else
        {
            $this->session->sess_destroy();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Suara Anda Berhasil Disimpan </div>');
            redirect('PemilihAuth');
            //redirect('PemilihAuth/pemilihIsLogin', 'referesh');
        }
    }

    public function memilih($id) {
        if($this->session->userdata('otp_verif')==1)
        {
            $this->user['user'] = $this->db->get_where('tb_pemilih', ['pemilih_id'  => $this->session->userdata('pemilih_id')])->row_array();
            if($this->user['user'] == "") {
                redirect('PemilihAuth', 'refresh');
            }

            $this->load->model('KetuaModel');
            $ketua = $this->KetuaModel->getKetua($id)->row_array();
            $suara = $ketua['calon_ketua_suara'] + 1;

            $this->db->where('calon_ketua_id', $id);
            $this->db->update('tb_calon_ketua', ['calon_ketua_suara' => $suara]);

            $hasil = $this->HasilModel->getTemaInCalon($id)->row_array();
            $pemilih_id = $this->user['user']['pemilih_id'];
            $ketua_id = $id;
            $tema_id = $hasil['tema_id'];

            //whether ip is from share internet
            if (!empty($_SERVER['HTTP_CLIENT_IP']))   
            {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
            }
            //whether ip is from proxy
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
            {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            //whether ip is from remote address
            else
            {
            $ip_address = $_SERVER['REMOTE_ADDR'];
            }

            $obj = [
                'pemilih_id' => $pemilih_id,
                'tema_id' => $tema_id,
                'calon_id' => $id,
                'ip_pemilih' => $ip_address
            ];

            $this->HasilModel->insertSuara($obj);
            redirect('PemilihAuth/pemilihIsLogin', 'referesh');
        }
        else
            echo "FORBIDDEN!";
        

        // $this->db->where('pemilih_nomor', $this->user['user']['pemilih_nomor']);
        // $this->db->update('tb_pemilih', ['pemilih_status' => "1"]);
        // $this->session->set_flashdata('berhasil', 'Anda Sudah Berhasil Memilih');
        // $this->_logout();
    }

    public function logout() {
        
        // if($this->user['user'] == "") {
        //     redirect('PemilihAuth', 'refresh');
        // }
    
        $this->session->sess_destroy();
        $this->db->where('pemilih_akun', $this->session->userdata('pemilih_id'));
        $this->db->update('tb_pemilih', ['pemilih_status' => "1"]);
        $this->session->set_flashdata('berhasil', 'Anda Sudah Berhasil Memilih');        
        redirect('PemilihAuth');
    }

    private function _logout() {
        $this->session->unset_userdata();
        redirect('PemilihAuth');
    }

    public function verifOTP()
    {
/*        print_r($_POST);
        print_r($this->session->userdata());
*/
        $this->db->select("pemilih_akun");
        $this->db->from("tb_pemilih");
        $this->db->where('otp', $this->input->post("otp"));
        $res = $this->db->get()->result_array();

        if($res)
        {
            if($res[0]['pemilih_akun'] == $this->session->userdata("pemilih_id"))
            {
                $this->session->set_userdata('otp_verif', 1);
            //    $this->db->set('pemilih_status', '1');
            //    $this->db->where('pemilih_id', $res[0]['pemilih_id']);
            //    $this->db->update('tb_pemilih');
                echo 0;
            }                
            else
                echo 1;
        }
        else
            echo 1;
        
    }

    private function generateRandomString($length = 5) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
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

    private function kirim_otp($nim, $hp)
    {
        $otp = $this->generateRandomString();
        $object = array(
            "otp" => $otp
        );

        $pesan = base64_encode("PEMIRA UA\r\nRahasiakan OTP Anda!\r\nOTP : ".$otp);

        //$this->PemilihModel->updatePemilih($id, $object);
        $this->db->set($object);
        $this->db->where("pemilih_akun", $nim);
        $this->db->update('tb_pemilih');
        $token = $this->build_token($hp);
        
        $resp = file_get_contents("https://apicybercampus.unair.ac.id/api/sms-gw/kirim-sms?token=$token&hp=$hp&pesan=$pesan");
        return $resp;
    }

    public function ajax_kirim_otp()
    {
        //echo $this->session->userdata('pemilih_id')." ".$this->session->userdata('pemilih_contact');
        $id = $this->session->userdata('pemilih_id');
        $hp = $this->session->userdata('pemilih_contact');
        $resp = $this->kirim_otp($id, $hp);
        $arr = json_decode($resp, true);
        if($arr['status'] == 'sukses')
        {
            echo 0;
        }
        else
        {
            echo 1;
        }

    }
}