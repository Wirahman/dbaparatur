<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of realisasiskp
 *
 * @author mssbinertekno
 */
class realisasiskp extends CI_Controller{
    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('nip')){
            redirect('login');
            return;
        }
        $this->load->model('m_realisasiskp');
    }
    function index(){
        $this->load->helper('pusdiklat');
        $currentYYYY = getCurrentYYYY();
        $currentnip = $this->session->userdata('nip');
        //ambil data dari penilaian skp
        $data['kegiatan_tugas_jabatan'] = $this->m_realisasiskp->ambilpenilaianskp_ktj($currentnip, $currentYYYY);
        //ambil data tugas tambahan dan kreativitas
        $data['tugas_tambahan_kreativitas'] = $this->m_realisasiskp->ambilpenilaianskp_tt_k($currentnip, $currentYYYY);
        
        //hitung nilai_capaian_skp_rata_rata
        $data['nilai_capaian_skp'] = $this->m_realisasiskp->ambilpenilaianskp_average_nilai_capaian_skp($currentnip, $currentYYYY);
        $this->load->view("vrealisasiSkp", $data);
    }
}
