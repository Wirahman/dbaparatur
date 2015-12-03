<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Passing extends CI_Controller {
	function __construct(){
		 parent:: __construct();
		 $this->load->model('model_passing','',TRUE);
		 $data['parameter'] = "";
	}
  
	public function index(){
		if(isset($_POST['kirim'])){
			$data['parameter'] = $_POST['parameter'] . "-" . $_POST['data1'] . "-" . $_POST['data2'] . "-" . $_POST['data3'] . "-" . $_POST['data4'];
		}else{
			$data['parameter'] = "";
		}
		
		if(isset($_POST['hapus'])){
			$data['urut'] = $_POST['urutan'];
			$data['parameter'] = $_POST['parameter'];
			$list = explode("-",$data['parameter']);
			$parameter = "";
			for($i=1;$i<count($list);$i++){
				if($i == $data['urut'] || $i == $data['urut']+1 || $i == $data['urut']+2 || $i == $data['urut']+3){
				
				}else{
					$parameter .= "-" . $list[$i];
				}
			}
			$data['parameter'] = $parameter;
		}
		
		if(isset($_POST['simpan'])){
			$data['parameter'] = $_POST['parameter'];
			$list = explode("-",$data['parameter']);
			for($i=1;$i<count($list);$i+=4){
				// Prepare data untuk disimpan di tabel
				$data = array(
							'data1' => $list[$i],
							'data2' => $list[$i+1],
							'data3'	=> $list[$i+2],
							'data4' => $list[$i+3]
						);
				// Proses simpan data 
				$this->model_passing->add($data);
			}
			$data['parameter'] = "";
		}
		
		$this->load->view('vpassing', $data);
	}
}
