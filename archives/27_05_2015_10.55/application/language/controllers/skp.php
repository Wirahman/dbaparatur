<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class skp extends CI_Controller {

    public function __construct() {
        parent::__construct();
         $data['parameter'] = "";
        if (!$this->session->userdata('nip')){
            redirect('login');
            return;
        }
        $this->load->model('mskp');

    }
      
    public function perencanaanSkp(){  
        if(isset($_POST['kirim'])){
            
            $data['parameter'] = $_POST['parameter'];
            $data['nama_kegiatan'] = "";
			$data['parameter'] = $_POST['parameter'] . "-" . $_POST['data1'] . "-" . $_POST['nama_kegiatan'] . "-" . $_POST['data3'] 
                        . "-" . $_POST['data4']. "-" . $_POST['data5']. "-" . $_POST['data6']. "-" . $_POST['data7'];
		}else{
			$data['parameter'] = "";
		}
		
		if(isset($_POST['hapus'])){
			$data['urut'] = $_POST['urutan'];
			$data['parameter'] = $_POST['parameter'];
			$list = explode("-",$data['parameter']);
			$parameter = "";
			for($i=1;$i<count($list);$i++){
				if($i == $data['urut'] || $i == $data['urut']+1 || $i == $data['urut']+2 || $i == $data['urut']+3
                                        || $i == $data['urut']+4 || $i == $data['urut']+5 || $i == $data['urut']+6){
				
				}else{
					$parameter .= "-" . $list[$i];
				}
			}
			$data['parameter'] = $parameter;
		}
		
		if(isset($_POST['simpan'])){
			$data['parameter'] = $_POST['parameter'];
			$list = explode("-",$data['parameter']);
			for($i=1;$i<count($list);$i+=7){
				// Prepare data untuk disimpan di tabel
				$data = array(
							'data1' => $list[$i],
							'nama_kegiatan' => $list[$i+1],
							'data3'	=> $list[$i+2],
							'data4' => $list[$i+3],
                                                        'data5' => $list[$i+4],
							'data6' => $list[$i+5],
							'data7'	=> $list[$i+6]
	
						);
				// Proses simpan data 
				$this->model_passing->add($data);
			}
			$data['parameter'] = "";
		}
		
            $data['nama_kegiatan'] = $this->mskp->get_combo_kegiatan(); 
            $data['title'] = $this->mutil->get_menu_name('skp/perencanaanSkp');
            $this->load->view("vperencanaanSkp", $data);
    }
    
    public function realisasiSkp(){
       
        $this->load->view("vrealisasiSkp");
    }
    
    
}
?>
