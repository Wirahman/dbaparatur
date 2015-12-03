<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetBawahan
 *
 * @author mssbinertekno
 */
class GetBawahan {
    //put your code here
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->model('m_synchronize');
		$this->CI->load->model('model_jabatan');
		$this->CI->load->model('model_pegawai');
    }
    function get_bawahan($nip){
        $raw_results_bawahan_level_1 = $this->m_synchronize->get_bawahan_level_1($nip);
        return $raw_results_bawahan_level_1;
    }
	
	function get_list($nip) {
		$pegawai = $this->model_pegawai->get($nip);
		$jabatan = $this->model_jabatan->get($pegawai->id_jabatan);
		$bawahan = $this->model_jabatan->get_where(array('id_atasan'=>$jabatan->id));
		$list = array();
		$i = 0;
		foreach($bawahan as $b) {
			$peg = $this->model_pegawai->get_where(array('id_jabatan'=>$b->id));
			if($peg) {
				$peg_detail = $this->model_pegawai->get_detail($peg->nip);
				$list = $list + array($i => $peg_detail);
			}
			$i++;
		}
		return $list;
	}
}
