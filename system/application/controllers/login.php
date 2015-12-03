<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        ini_set('memory_limit', '-1');
        ini_set('post_max_size', '-1');
        ini_set('max_execution_time', '-1');
        ini_set('max_input_time', '-1');
        set_time_limit(0);
        $this->__synchronize();
        if ($this->session->userdata('username')) {
            redirect('profil');
            return;
        }
    }
    public function __synchronize(){
        $this->load->model('m_synchronize');
        //ambil dari database saat ini
        $results_current = $this->m_synchronize->ambil_nip_pegawai_current_db();
        $nip_current = array();
        foreach ($results_current as $cn => $iln):
            array_push($nip_current, $iln['nip']);
        endforeach;
        //ambil dari database mpegawai lain yang terkait
        $this->load->database('other',TRUE);
        $results_other = $this->m_synchronize->ambil_nip_pegawai_other_db();
        $nip_other = array();
        foreach ($results_other as $cn => $iln):
            array_push($nip_other, $iln['peg_nip']);
        endforeach;
        $diff_nip = array_diff_key($nip_other, $nip_current);
        //insert to current db
        $this->load->database('default',TRUE);
        foreach($diff_nip as $dn => $iln):
            $genpass = $this->muser->my_md5($iln);
            $this->m_synchronize->tambahkan_ke_current_db_pegawai($iln, $genpass);
        endforeach;
    }
    
    public function index() {
        $this->load->view('vlogin');
    }

}
