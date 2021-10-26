<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suara extends CI_Controller {

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
        //$data = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        
    }

    public function index() {
        date_default_timezone_set("Asia/Jakarta");
        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        $suara['tema'] = $this->SuaraModel->getTemaActive()->result_array();
        $data['title'] = "Hasil Suara - E-voting";

        //  print_r($suara);


        $this->load->view('layout/header_layout', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        if($this->session->userdata('role_id')<3)
            $this->load->view('content/suara', $suara);
        else
        {
            if($suara['tema'][0]['status']==1)
                $this->load->view('content/suara', $suara);
            else
                $this->load->view('content/suara_tutup', $suara);
        }
		$this->load->view('layout/footer_layout', $suara);
    }

    public function detailSuara() {
        date_default_timezone_set("Asia/Jakarta");
        $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        //$suara['suara'] = $this->SuaraModel->getSuara($id)->result_array();
        
        /*$suara['suara'] = $this->db->query("select calon_ketua_nourut,calon_ketua_nama,s1.calon_ketua_suara,calon_ketua_foto from tb_calon_ketua
											left join (
											select tema_id,calon_id,count(suara_id) as calon_ketua_suara from tb_suara
											group by tema_id,calon_id) s1 on tb_calon_ketua.tema_id=s1.tema_id and tb_calon_ketua.calon_ketua_id=s1.calon_id
											where tb_calon_ketua.tema_id=$id")->result_array();
        */
        $suara['suara'] = $this->db->query("select ttp.tema_id, ttp.tema_nama, tck.calon_ketua_id, tck.calon_ketua_nourut, tck.calon_ketua_nama, tck.id_program_studi, coalesce(s1.calon_ketua_suara,0) as calon_ketua_suara from tb_calon_ketua as tck
                                            join tb_tema_pemilihan as ttp on tck.tema_id = ttp.tema_id
											left join (
											select tema_id,calon_id,count(suara_id) as calon_ketua_suara from tb_suara
											group by tema_id,calon_id) s1 on tck.tema_id=s1.tema_id and tck.calon_ketua_id=s1.calon_id 
                                            order by ttp.tema_id, tck.id_program_studi, tck.calon_ketua_nourut")->result_array();
        //print_r($suara);

    //    $this->db->select("count(pemilih_id) as jumlah");
    //    $suara['jumlah_pemilih']=$this->db->get('tb_pemilih')->result_array()[0]['jumlah'];
        
        $this->db->select("count(pemilih_id) as jumlah");
        $this->db->where("pemilih_verifikasi","1");
        $suara['jumlah_verifikasi']=$this->db->get('tb_pemilih')->result_array()[0]['jumlah'];
		
        $suara['tema'] = $this->SuaraModel->getTemaActive()->result_array();

        $id_fakultas = $this->db->get_where('fakultas', ['status'=>1])->result_array()[0]['id_fakultas'];

        $this->db->select('p.id_program_studi, p.nama_prodi, j.nama_jenjang');
        $this->db->from('program_studi as p');
        $this->db->join('jenjang as j', 'p.id_jenjang = j.id_jenjang');
        $this->db->where(['id_fakultas'=>$id_fakultas,'status'=>1]);
        $prodi = $this->db->get()->result_array();

        

        $arr_prodi = array();

        for($i=0; $i<count($prodi); $i++){
            $arr_prodi[$prodi[$i]['id_program_studi']] = array(
                'nama_prodi' => $prodi[$i]['nama_prodi'],
                'nama_jenjang' => $prodi[$i]['nama_jenjang']
            );
        }

        $gabung = array();

        for($i=0; $i<count($suara['tema']); $i++){
            if(!array_key_exists($suara['tema'][$i]['tema_id'], $gabung)){
                $gabung[$suara['tema'][$i]['tema_id']] = array();
            }

            $gabung[$suara['tema'][$i]['tema_id']]['tema_id'] = $suara['tema'][$i]['tema_id'];
            $gabung[$suara['tema'][$i]['tema_id']]['tema_nama'] = $suara['tema'][$i]['tema_nama'];
            $gabung[$suara['tema'][$i]['tema_id']]['calon'] = array();            
        }

        for($i=0; $i<count($suara['suara']); $i++){
            $num = count($gabung[$suara['suara'][$i]['tema_id']]['calon']);
            if($suara['suara'][$i]['id_program_studi']=='')
                $prodi_loop='';
            else
                $prodi_loop = $arr_prodi[$suara['suara'][$i]['id_program_studi']]['nama_jenjang']." ".$arr_prodi[$suara['suara'][$i]['id_program_studi']]['nama_prodi'];
            $gabung[$suara['suara'][$i]['tema_id']]['calon'][$num] = array(
                'calon_ketua_nourut' => $suara['suara'][$i]['calon_ketua_nourut'],
                'calon_ketua_nama' => $suara['suara'][$i]['calon_ketua_nama'],
                'calon_ketua_suara' => $suara['suara'][$i]['calon_ketua_suara'],
                'prodi' => $prodi_loop,
                'calon_ketua_id' => $suara['suara'][$i]['calon_ketua_id'],
            );
        }

        $suara['gabung'] = $gabung;
        

        $suara['count'] = $this->SuaraModel->countPemilih();
        $data['title'] = "Hasil Suara - E-voting";

        // if(time() <= $suara['tema']['tema_batas']) {
        //     echo "<meta http-equiv='refresh' content='1'>";
        // } else {}

//        print_r($suara);
        $this->load->view('layout/header_layout', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('layout/topbar', $data);
        $this->load->view('content/suara_detail', $suara);
		$this->load->view('layout/footer_layout_2', $suara);
    }

//     public function detailSuara($id) {
//         date_default_timezone_set("Asia/Jakarta");
//         $data['user'] = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
//         //$suara['suara'] = $this->SuaraModel->getSuara($id)->result_array();
        
//         /*$suara['suara'] = $this->db->query("select calon_ketua_nourut,calon_ketua_nama,s1.calon_ketua_suara,calon_ketua_foto from tb_calon_ketua
// 											left join (
// 											select tema_id,calon_id,count(suara_id) as calon_ketua_suara from tb_suara
// 											group by tema_id,calon_id) s1 on tb_calon_ketua.tema_id=s1.tema_id and tb_calon_ketua.calon_ketua_id=s1.calon_id
// 											where tb_calon_ketua.tema_id=$id")->result_array();
//         */
//         $suara['suara'] = $this->db->query("select calon_ketua_nourut,calon_ketua_nama,coalesce(s1.calon_ketua_suara,0) as calon_ketua_suara from tb_calon_ketua
// 											left join (
// 											select tema_id,calon_id,count(suara_id) as calon_ketua_suara from tb_suara
// 											group by tema_id,calon_id) s1 on tb_calon_ketua.tema_id=s1.tema_id and tb_calon_ketua.calon_ketua_id=s1.calon_id
// 											where tb_calon_ketua.tema_id=$id")->result_array();

//     //    $this->db->select("count(pemilih_id) as jumlah");
//     //    $suara['jumlah_pemilih']=$this->db->get('tb_pemilih')->result_array()[0]['jumlah'];
        
//         $this->db->select("count(pemilih_id) as jumlah");
//         $this->db->where("pemilih_verifikasi","1");
//         $suara['jumlah_verifikasi']=$this->db->get('tb_pemilih')->result_array()[0]['jumlah'];
		
//         $suara['tema'] = $this->SuaraModel->getTema($id)->row_array();
//         $suara['count'] = $this->SuaraModel->countPemilih($id);
//         $data['title'] = "Hasil Suara - E-voting";

//         if(time() <= $suara['tema']['tema_batas']) {
//             echo "<meta http-equiv='refresh' content='1'>";
//         } else {}

// //        print_r($suara);
//         $this->load->view('layout/header_layout', $data);
//         $this->load->view('layout/sidebar', $data);
//         $this->load->view('layout/topbar', $data);
//         $this->load->view('content/suara_detail', $suara);
// 		$this->load->view('layout/footer_layout', $suara);
//     }

    public function get_suara($id)
	{

        ignore_user_abort(true);

		header("Cache-Control: no-cache");
        header("Content-Type: text/event-stream");
//        header("Connection: keep-alive");

        
        echo "retry: 1000".PHP_EOL;
		
		while(true)
		{
            if(connection_aborted()){
                break;
            }
			$suara['suara'] = $this->db->query("select calon_ketua_nourut,calon_ketua_nama,s1.calon_ketua_suara from tb_calon_ketua
											left join (
											select tema_id,calon_id,count(suara_id) as calon_ketua_suara from tb_suara
											group by tema_id,calon_id) s1 on tb_calon_ketua.tema_id=s1.tema_id and tb_calon_ketua.calon_ketua_id=s1.calon_id
											where tb_calon_ketua.tema_id=$id")->result_array();

            $this->db->select("count(pemilih_id) as jumlah");
            $this->db->where("pemilih_verifikasi","1");
            $this->db->where("otp != ",null);
            $suara['penerima_otp']=$this->db->get('tb_pemilih')->result_array()[0]['jumlah'];
                        
            $json = json_encode($suara);
            echo "data:".$json.PHP_EOL;
            echo PHP_EOL;
            
            ob_end_flush();
            flush();

			sleep(2);			
		}
	}

    function ajax_get_suara()
    {
        $suara['suara'] = $this->db->query("select tck.calon_ketua_id, coalesce(s1.calon_ketua_suara,0) as calon_ketua_suara from tb_calon_ketua as tck
                                            join tb_tema_pemilihan as ttp on tck.tema_id = ttp.tema_id
                                            left join (select tema_id,calon_id,count(suara_id) as calon_ketua_suara from tb_suara
                                            group by tema_id,calon_id) s1 on tck.tema_id=s1.tema_id and tck.calon_ketua_id=s1.calon_id")->result_array();

        $this->db->select('COUNT(DISTINCT nim) as jumlah_pemilih');
        $suara['pemilih'] = $this->db->get('tb_suara')->result_array()[0]['jumlah_pemilih'];

        // $this->db->select("count(pemilih_id) as jumlah");
        // $this->db->where("pemilih_verifikasi","1");
        // $this->db->where("otp != ",null);
        // $suara['penerima_otp']=$this->db->get('tb_pemilih')->result_array()[0]['jumlah'];

        echo json_encode($suara);
    
    }

    function publish($status){
        if($status==1)
            $status=0;
        else
            $status=1;
        
        $this->db->set('status', $status);
        $this->db->update('tb_tema_pemilihan');

        redirect('/Auth_Admin/Suara');

    }
}