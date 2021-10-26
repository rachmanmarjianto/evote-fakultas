<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet;

class Cetak extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('SuaraModel');
        $this->load->model('AdminModel');
        $this->load->model('TemaModel');
        $this->load->model('HasilModel');
        $this->load->model('KetuaModel');
        if(!isset($this->session->userdata['username']))
        {
		    redirect('AdminLogin');
        }
        $data = $this->AdminModel->getAdmin($this->session->userdata('username'))->row_array();
        if($data['role_id'] > 2) {
            redirect('/Auth_Admin/Beranda');
        }

       
    }

    public function cetakSuara() {

        $suara = $this->db->query("select ttp.tema_id, ttp.tema_nama, tck.calon_ketua_id, tck.calon_ketua_nourut, tck.calon_ketua_nama, tck.id_program_studi, coalesce(s1.calon_ketua_suara,0) as calon_ketua_suara from tb_calon_ketua as tck
                                    join tb_tema_pemilihan as ttp on tck.tema_id = ttp.tema_id
                                    left join (select tema_id,calon_id,count(suara_id) as calon_ketua_suara from tb_suara
                                    group by tema_id,calon_id) s1 on tck.tema_id=s1.tema_id and tck.calon_ketua_id=s1.calon_id 
                                    order by ttp.tema_id, tck.id_program_studi, tck.calon_ketua_nourut")->result_array();
        
        $result = $this->db->get_where('fakultas', ['status'=>1])->result_array();
        $id_fakultas = $result[0]['id_fakultas'];
        $nama_fakultas = $result[0]['nama_fakultas'];

        $this->db->select('p.id_program_studi, p.nama_prodi, j.nama_jenjang');
        $this->db->from('program_studi as p');
        $this->db->join('jenjang as j', 'p.id_jenjang = j.id_jenjang');
        $this->db->where(['id_fakultas'=>$id_fakultas,'status'=>1]);
        $prodi = $this->db->get()->result_array();

        $arr_prodi = array();

        for($i=0; $i<count($prodi); $i++){
            $arr_prodi[$prodi[$i]['id_program_studi']] = $prodi[$i]['nama_jenjang']." ".$prodi[$i]['nama_prodi'];
        }
     

        $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));

        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getProperties()->setCreator("PEMIRA UA")
                                ->setLastModifiedBy("PEMIRA UA")
                                ->setTitle("Office 2007 XLSX Test Document")
                                ->setSubject("Office 2007 XLSX Test Document")
                                ->setDescription("Hasil PEMIRA")
                                ->setKeywords("office 2007 openxml php")
                                ->setCategory("Hasil PEMIRA");

        $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A1', 'Tema')
                                ->setCellValue('B1', 'Prodi')
                                ->setCellValue('C1', 'No Urut')
                                ->setCellValue('D1', 'Nama Calon')
                                ->setCellValue('E1', 'Jumlah Suara');
    
        for($i=0; $i<count($suara); $i++){
            if($suara[$i]['id_program_studi']==""){
                $prodi = "";
            }
            else{
                $prodi = $arr_prodi[$suara[$i]['id_program_studi']];
            }

            $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.($i+2), $suara[$i]['tema_nama'])
                                ->setCellValue('B'.($i+2), $prodi)
                                ->setCellValue('C'.($i+2), $suara[$i]['calon_ketua_nourut'])
                                ->setCellValue('D'.($i+2), $suara[$i]['calon_ketua_nama'])
                                ->setCellValue('E'.($i+2), $suara[$i]['calon_ketua_suara']);
        }

        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save("assets/Suara_".$nama_fakultas.".xls");
        header("Content-Type: application/vnd-ms-excel");
        redirect(base_url()."assets/Suara_".$nama_fakultas.".xls");


/*        $suara = $this->SuaraModel->getSuara($id)->result_array();
        $tema = $this->SuaraModel->getTema($id)->row_array();
        $filename = "hasil_pemilihan_".$tema['tema_nama']."xlsx";

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('B1', $tema['tema_nama']);
        
        $sheet->setCellValue('A3', 'No.');
        $sheet->setCellValue('B3', 'Nama Calon');
        $sheet->setCellValue('C3', 'Hasil Suara Pemilihan');
        $row = 5;
        foreach($suara as $s) {
            $sheet->setCellValue('A'. $row, $s['calon_ketua_nourut']);
            $sheet->setCellValue('B'. $row, $s['calon_ketua_nama']);
            $sheet->setCellValue('C'. $row, $s['calon_ketua_suara']);
            $row++;
        }

        $newRow = $row+3;

        $sheet->setCellValue('A'.$newRow, "Tanda Tangan Saksi");

        $write = new Xlsx($spreadsheet);
        $write->save("assets/".$filename);
        header("Content-Type: application/vnd.ms-excel");
        redirect(base_url()."/assets/".$filename);
*/
    }

    public function unduh_pemilih($id_prodi){
        $pemilih = $this->db->query("select pemilih_nama,angkatan,password,pemilih_verifikasi,pemilih_id,pemilih_akun,pemilih_status,pemilih_utusan,otp, 
                                    case when ( pemilih_akun in (select nim from tb_suara)) then 'vote'
                                    when otp IS NOT NULL then 'otp' 
                                    else 'blm otp' end as pemilih_vote 
                                    from tb_pemilih 
                                    where id_program_studi = ".$id_prodi." order by pemilih_akun, angkatan")->result_array();
        
        $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));

        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getProperties()->setCreator("PEMIRA UA")
                                ->setLastModifiedBy("PEMIRA UA")
                                ->setTitle("Office 2007 XLSX Test Document")
                                ->setSubject("Office 2007 XLSX Test Document")
                                ->setDescription("List Pemberi Suara")
                                ->setKeywords("office 2007 openxml php")
                                ->setCategory("List Pemberi Suara");

        $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A1', 'NIM')
                                ->setCellValue('B1', 'Nama Pemilih')
                                ->setCellValue('C1', 'Angkatan');
    
        $x=0;
        for($i=0; $i<count($pemilih); $i++){
            if($pemilih[$i]['pemilih_vote'] == 'vote')
            {
                $objPHPExcel->setActiveSheetIndex(0)
                                ->setCellValue('A'.($x+2), $pemilih[$i]['pemilih_akun'])
                                ->setCellValue('B'.($x+2), $pemilih[$i]['pemilih_nama'])
                                ->setCellValue('C'.($x+2), $pemilih[$i]['angkatan']);
                $x++;
            }
            
        }

        $this->db->select('nama_prodi');
        $this->db->where('id_program_studi', $id_prodi);
        $nama_prodi = $this->db->get('program_studi')->result_array()[0]['nama_prodi'];

        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save("assets/Suara_".$nama_prodi.".xls");
        header("Content-Type: application/vnd-ms-excel");
        redirect(base_url()."assets/Suara_".$nama_prodi.".xls");
    }

    public function cetakPemilih($id) {
        $data = $this->HasilModel->getPemilihInSuara($id)->result_array();
        $tema = $this->SuaraModel->getTema($id)->row_array();

        $this->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));

        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getProperties()->setCreator("IKA UA")
							 ->setLastModifiedBy("IKA UA")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("List Pemberi Suara")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("List Pemberi Suara");

        $objPHPExcel->setActiveSheetIndex(0)
                             ->setCellValue('A1', 'id_pemilih')
                             ->setCellValue('B1', 'Waktu memberi Suara')
                             ->setCellValue('C1', 'Suara');
        

        for($i=0; $i<count($data); $i++){
            $objPHPExcel->setActiveSheetIndex(0)
                             ->setCellValue('A'.($i+2), $data[$i]['pemilih_id'])
                             ->setCellValue('B'.($i+2), $data[$i]['tanggal'])
                             ->setCellValue('C'.($i+2), $data[$i]['calon_ketua_nourut']);
        }

        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save("assets/Pemilih.xls");
        header("Content-Type: application/vnd-ms-excel");
        redirect(base_url()."assets/Pemilih.xls");
    }

}