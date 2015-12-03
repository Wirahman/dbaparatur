<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mreferensi extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    
    
    
     public function get_combo_kegiatan1() {
              
          $nama_jabatan="select * from jabatan"; 
          return $this->db->query($nama_jabatan);
     } 
     public function get_nama_jabatan(){
         
         $jabatan = ("SELECT * FROM jabatan ");
         return $this->db->query($jabatan);
                 
    }
    public function get_nama_kegiatan(){
        $kegiatan = ("SELECT b.id, a.deskripsi, b.id_jabatan, b.kegiatan, b.satuan_kuantitas
                      FROM jabatan a
                      JOIN kegiatan_tugas_jabatan b ON a.id = b.id_jabatan
                     ");
        return $this->db->query($kegiatan);
    }
    
    
    public function inputJabatan($datajabatan){
          $insertintojabatan=$this->db->insert('jabatan',$datajabatan);
          if($insertintojabatan){
              return true;
          }else{
              return false;
          }
    }
    
     public function input_kegiatan($datakegiatan){
          $insertintokegiatan=$this->db->insert('kegiatan_tugas_jabatan',$datakegiatan);
          if($insertintokegiatan){
              return true;
          }else{
              return false;
          }
    }
      
    public function update_referensiJabatan($id, $jabatan){
        
        $referensiJabatan = array('deskripsi' => $jabatan);
        $this->db->where('id', $id);
        $this->db->update('jabatan',$referensiJabatan);
    }
    
    public function update_referensiKegiatan($id, $id_jabatan,$kegiatan, $satuan_kuantitas){
        
        $referensiKegiatan = array
                            ( 'id_jabatan' => $id_jabatan,
                              'kegiatan' => $kegiatan,
                              'satuan_kuantitas' => $satuan_kegiatan);
        $this->db->where('id', $id);
        $this->db->update('kegiatan_tugas_jabatan',$referensiKegiatan);
    }
    
    public function hapusdatareferensiJabatan($uri){
        $hapusjabatan="delete  from jabatan where id='".$uri."'";
        return $this->db->query($hapusjabatan);
    }
    
    public function hapusdatareferensiKegiatan($uri){
        $hapuskegiatan="delete  from kegiatan_tugas_jabatan where id='".$uri."'";
        return $this->db->query($hapuskegiatan);
    }
    
    public function check_data_jabatan($jabatan){
           $this->db->where("deskripsi",$jabatan);
           $query=$this->db->get("jabatan");
           if($query->num_rows()>0)
           {
            return true;
           }
           else
           {
            return false;
           }
    }
    
    
    
    
}    
?>
