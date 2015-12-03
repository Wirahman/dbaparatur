<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    class Mskp extends CI_Model {
        
         public function __construct() {
         parent::__construct();
    }
    
    public function get_combo_kegiatan(){
        
      $nama_kegiatan="select * from jenis_kegiatan"; 
              return $this->db->query($nama_kegiatan);
    }
    
    
 }
?>
