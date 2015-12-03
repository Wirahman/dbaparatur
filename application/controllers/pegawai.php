<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class pegawai extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('nip')){
            redirect('login');
            return;
        }
        $this->load->database('other',TRUE);
        $this->load->model('model_pegawai');
		$this->load->model('model_jabatan');
    }

	public function index() {
		$data['title'] = "Data - Pegawai";
		$data['data_role_map'] = $this->mutil->get_table_map('tr_role');
		$data['data_status_map'] = $this->mutil->get_status_map();
		$data['data_status_icon_map'] = $this->mutil->get_status_icon_map();
		$data['has_access'] = $this->muser->has_access_to('user/add');
        
		$pegawai = $this->model_pegawai->get_all();
		$i = 0;
		foreach($pegawai as $pg) {	
			$detail = $this->model_pegawai->get_detail($pg->nip);
			$pegawai[$i]->atasan = "";
			$pegawai[$i]->nama = "";
			if($detail) {
				$pegawai[$i]->nama = $detail->peg_nm;
				$atasan = $this->model_pegawai->get_by_params(array('id_jabatan'=>$pg->id_atasan));
				if($atasan){
					$detail_atasan = $this->model_pegawai->get_detail($atasan->nip);
					$pegawai[$i]->atasan = $detail_atasan->peg_nm;
				}
			}
			$i++;
		}
		$data['data'] = $pegawai;
		$this->load->view('pegawai/index', $data);
	}
	
	public function view($nip) {
        $data['title'] = "Detail Data Pegawai";
        $data['menu'] = "datapegawai";

		// Ambil data pegawai dari database SID, table mpegawai
		$pegawai = $this->model_pegawai->get_detail($nip);
		$data['nip'] = $nip;
		$data['nama'] = $pegawai->peg_nm;
		$data['pangkat'] = $pegawai->peg_gol_pangkat;
		$data['unit_organisasi'] = "";
		
		// Ambil data pegawai dari tabel pegawai
		$pegawai = $this->model_pegawai->get($nip);
		$data['id_jabatan'] = $pegawai->id_jabatan;
		
		// Cari data id_atasan dari tabel jabatan
		$jabatan = $this->model_jabatan->get($pegawai->id_jabatan);		

		// Cari data atasan dari tabel pegawai
		$data['nip_pejabat_penilai'] = "";
		$data['nama_pejabat_penilai'] = "";

		if($jabatan) {
			$atasan = $this->model_pegawai->get_by_params(array('id_jabatan'=>$jabatan->id_atasan));
			if($atasan){
				$detail_atasan = $this->model_pegawai->get_detail($atasan->nip);
				$data['nip_pejabat_penilai'] = $detail_atasan->peg_nip;
				$data['nama_pejabat_penilai'] = $detail_atasan->peg_nm;
			}
		}	

		$data['list_jabatan'] = $this->model_jabatan->get_all();
        $this->load->view('pegawai/view', $data);
	}
 
	public function edit($nip) {
		$data = array('id_jabatan' => $this->input->post('id_jabatan',TRUE));
		$this->model_pegawai->update($nip,$data);
		$response = array();
		echo json_encode($response);
	}
 
/*
    public function jabatan(){
        $data['comjabatan'] = $this->mdata->ambil_daftar_jabatan();
        $data['jabatan'] = $this->mdata->get_nama_jabatan();
        

        $results = $this->mdata->ambil_detail_pegawai_dari_current_db();
        $nip_atasan = $results['rows']->id_jabatan;
        $id = $results['rows']->id_jabatan;
            $result = $this->mdata->ambil_detail_pegawai_dari_current_db($id);
            if($result == 0):
                $data['jabatan1'] = NULL;
                $data['id_jabatan'] = NULL;
            else: 
                $data['jabatan1'] = $result['rows']->deskripsi;
                $data['id_jabatan'] = $result['rows']->id_atasan;
            endif;
        

        $this->load->view('vjabatan', $data);
    }
    
    public function tugaskegiatan(){
        
         $data['nama_jabatan'] = $this->mreferensi->get_combo_kegiatan1();
         $data['refkegiatan'] = $this->mreferensi->get_nama_kegiatan();
         $this->load->view('vtugaskegiatan', $data);
    }
    
    function pegawai(){
        
         //if (!$this->muser->has_access_to('data/pegawai')) { redirect('dashboard');return; }
		$data['title'] = $this->mutil->get_menu_name('user/index');
		$data['data'] = $this->muser->get_pegawai_list();
                
		$data['data_role_map'] = $this->mutil->get_table_map('tr_role');
		$data['data_status_map'] = $this->mutil->get_status_map();
		$data['data_status_icon_map'] = $this->mutil->get_status_icon_map();
		$data['has_access'] = $this->muser->has_access_to('user/add');
              
               

           //ambil data pegawai
             $data['nama'] = $this->muser->ambil_detail_pegawai_dari_other_db();
   
		$this->load->view('vpegawai', $data);
    }
*/
}  
?>
