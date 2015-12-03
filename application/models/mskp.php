<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Mskp extends CI_Model {
        
         public function __construct() {
         parent::__construct();
    }
    
    public function get_combo_kegiatan(){
        
      $nama_kegiatan="select * from kegiatan_tugas_jabatan"; 
              return $this->db->query($nama_kegiatan);
    }
    
     public function get_combo_jenis_kegiatan(){
        
      $jenis_kegiatan="select * from jenis_kegiatan"; 
            return $this->db->query($jenis_kegiatan);
    }
    
   public function get_combo_kegiatan1() {
              
          $nama_jabatan="select * from jabatan"; 
          return $this->db->query($nama_jabatan);
     } 
    public function get_list_kegiatan(){
        
      $kegiatan="select * from get_list_kegiatan"; 
              return $this->db->query($kegiatan);
              
    }
    
    public function get_jabatan($id){      
       $jabatan="select * from jabatan WHERE id ='$id'"; 
       $ret['rows'] = $this->db->query($jabatan)->row();
            return $ret;
            
    }
    
    
    public function add_perencanaanSkp($data){
//        $data= array(); 
//        $data['id'] = $this->common->auto_generated(MIN_LENGTH_PASSWORD);
//        $data['nip'] = $this->session->userdata('nip');
//        $data['created_on'] = date('Y-m-d H:i:s');
         $insertinto=$this->db->insert('penilaian_skp',$data);
          if($insertinto){
              return true;
          }else{
              return false;
          }
    }
    
        function ambil_detail_pegawai_dari_other_db($currentnip){       
        $q = "SELECT peg_nm, peg_gol_pangkat, peg_jabatan, peg_gol_pangkat, peg_unit FROM mpegawai WHERE peg_nip = '$currentnip'";
        $ret['rows'] = $this->db->query($q)->row();

        $tmp = $this->db->query($q)->num_rows();
        $ret['num_rows'] = $tmp;

        return $ret;
    }
    
      public function input_kegiatan($datakegiatan){
          $insertintokegiatan=$this->db->insert('kegiatan_tugas_jabatan',$datakegiatan);
          if($insertintokegiatan){
              return true;
          }else{
              return false;
          }
    }
    
    
    
    
 }
?>
