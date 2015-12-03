<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class referensi extends CI_Controller {

        public function __construct() {
            parent::__construct();
            if (!$this->session->userdata('nip')) {
                redirect('login');
                return;
            }
            //$this->load->model('mdb');
            $this->load->model('mreferensi');
            $this->load->library("form_validation");
        }
        
        
        public function index() {
            if (!$this->muser->has_access_to(__CLASS__ . '/' . __FUNCTION__)) {
                redirect('error/noaccess');
                return;
            } 	
        }
        
        public function jabatan(){  
            
            $show['title'] = $this->mutil->get_menu_name('referensi/jabatan');
            $show['refjabatan'] = $this->mreferensi->get_nama_jabatan();
            $this->load->view('vreferensiJabatan', $show);
        }
        
        public function kegiatan(){
            
            $show['title'] = $this->mutil->get_menu_name('referensi/kegiatan');
            $show['nama_jabatan'] = $this->mreferensi->get_combo_kegiatan1();
            $show['refkegiatan'] = $this->mreferensi->get_nama_kegiatan();
            $this->load->view('vreferensiKegiatan', $show);
        }
        
        
        public function simpanJabatan(){
            $this->mutil->access_record(__CLASS__ . '.' . __FUNCTION__, $this->session->userdata('nip'));
            $id = $this->input->post('id1'); 
            $nama_jabatan=$this->input->post('deskripsi1'); 
            $datajabatan=array( 
                      'id'      => $html['id'] = $this->common->auto_generated(MIN_LENGTH_PASSWORD),
                      'deskripsi'=>$nama_jabatan       
            );
            
           $insertdatatoDB=$this->mreferensi->inputJabatan($datajabatan);  
           if($insertdatatoDB==true){
              $this->session->set_flashdata('message', 'Data Berhasil Diinput..!');    
           }else
           {
               $this->session->set_flashdata('message', 'Data Gagal Diinput..!');
           }
        }
        
        public function simpanKegiatan(){
            $this->mutil->access_record(__CLASS__ . '.' . __FUNCTION__, $this->session->userdata('nip'));
            $nama_kegiatan=$this->input->post('kegiatan'); 
            $id_jabatan=$this->input->post('id_jabatan'); 
            $satuan_kuantitas=$this->input->post('satuan_kuantitas'); 
            $datakegiatan=array(          
                      'kegiatan'=>$nama_kegiatan,
                      'id_jabatan'=>$id_jabatan,
                      'satuan_kuantitas'=>$satuan_kuantitas
            );
            
           $insertdatatoDB=$this->mreferensi->input_kegiatan($datakegiatan);  
           if($insertdatatoDB==true){
              $this->session->set_flashdata('message', 'Data Berhasil Diinput..!');    
           }else
           {
               $this->session->set_flashdata('message', 'Data Gagal Diinput..!');
           }
        }
        
           
        public function updateJabatan(){
            $this->mutil->access_record(__CLASS__ . '.' . __FUNCTION__, $this->session->userdata('nip'));
            $id = $this->input->post('id');
            $jabatan = $this->input->post('deskripsi');
            
            $this->mreferensi->update_referensiJabatan($id, $jabatan);
            $this->session->set_flashdata('message', 'Data Berhasil Diperbarui..!');
        }
        
        public function updateKegiatan(){
            $this->mutil->access_record(__CLASS__ . '.' . __FUNCTION__, $this->session->userdata('nip'));
            $id = $this->input->post('id');
            $id_jabatan = $this->input->post('id_jabatan');
            $kegiatan = $this->input->post('kegiatan');
            $satuan_kuantitas = $this->input->post('satuan_kuantitas ');
            
            $this->mreferensi->update_referensiKegiatan($id, $id_jabatan,$kegiatan, $satuan_kuantitas);
            $this->session->set_flashdata('message', 'Data Berhasil Diperbarui..!');
        }
        
        public function hapus_referensiJabatan(){
             $this->mutil->access_record(__CLASS__ . '.' . __FUNCTION__, $this->session->userdata('nip'));
             $id=$this->input->post('id'); 
             $this->mreferensi->hapusdatareferensiJabatan($id);
             $this->session->set_flashdata('message', 'Data Berhasil DiHapus..!');
            
        }
        public function hapus_referensiKegiatan(){
             $this->mutil->access_record(__CLASS__ . '.' . __FUNCTION__, $this->session->userdata('nip'));
             $id=$this->input->post('id');
             $this->mreferensi->hapusdatareferensiKegiatan($id);
             $this->session->set_flashdata('message', 'Data Berhasil DiHapus..!');
            
        }
        
         public function check_data_jabatan(){
            $jabatan=$this->input->post('deskripsi');
            $cek=$this->mreferensi->check_data_jabatan($jabatan);
            if($cek==false){
                echo 0;
            }else{
                echo 1;
            }
        }
        
}
?>
