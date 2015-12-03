<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdata extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    
     public function get_nama_jabatan(){
         
         $jabatan = ("SELECT *, b.id_jabatan, b.pejabat_penilai FROM jabatan a 
              LEFT JOIN pegawai b ON a.id =b.id_jabatan");
         return $this->db->query($jabatan);
                 
    }
    
     function ambil_detail_pegawai_dari_current_db(){       
        $q = "SELECT  pegawai.pejabat_penilai, pegawai.id_jabatan, jabatan.id_atasan,jabatan.deskripsi
              FROM pegawai LEFT JOIN jabatan ON pegawai.id_jabatan = jabatan.id ";
        $ret['rows'] = $this->db->query($q)->row();
        return $ret;
    }
    
     public function get_jabatan($id){      
       $jabatan="select * from jabatan WHERE id ='$id'"; 
       $ret['rows'] = $this->db->query($jabatan)->row();
            return $ret;
            
    }
    
    function ambil_daftar_jabatan(){       
        $q = "SELECT * FROM jabatan";
        $ret = $this->db->query($q)->result();

        return $ret;
    }
    
}
?>
