<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class data extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('nip')){
            redirect('login');
            return;
        }
        
         $this->load->model('mdata');
         $this->load->model('m_profil');
         $this->load->model('mreferensi');
         $this->load->model('muser');

    }
    
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
         $data['title'] = 'Kegiatan Tugas Jabatan';
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
   
    
    
  } 
?>
