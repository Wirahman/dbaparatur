<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class kegiatan_tugas_jabatan extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $data['parameter'] = "";
        if (!$this->session->userdata('nip')){
            redirect('login');
            return;
        }
		
		$this->load->model('model_kegiatan_tugas_jabatan');
    }
	
	function create() {
		$data = array('id_jabatan' => $this->input->post('id_jabatan',TRUE),
					'kegiatan' => $this->input->post('kegiatan',TRUE),
					'satuan_kuantitas' => $this->input->post('satuan_kuantitas',TRUE)
				);
		$this->model_kegiatan_tugas_jabatan->insert($data);
		$response = array();
		echo json_encode($response);
	}

}