<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of penilaianPrestasiKerja
 *
 * @author mssbinertekno
 */
class penilaianSKP extends CI_Controller {
    //put your code here
    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('nip')){
            redirect('login');
            return;
        }
        $this->load->model('m_profil');
        $this->load->model('m_penilaianskp');
        $this->load->model('m_realisasiskp');
        $this->menu = "hasilpenilaian";
        $this->submenu = "penilaianskp";
        $this->title = "Hasil Penilaian - Penilaian SKP";
    }
    function index(){
        //$data['title'] = $this->mutil->get_menu_name('dashboard/index');
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $data['submenu'] = $this->submenu;
        
        $this->load->helper('pusdiklat');
        $currentYYYY = getCurrentYYYY();
        $data['availableYYYY'] = $this->m_penilaianskp->ambildaftartahunyangtersedia();
        
        if (isset($_POST['tahun'])):
            $tahunyangdinilaisaatini = $this->common->filter($this->input->post('tahun'));
        else:
            $tahunyangdinilaisaatini = $currentYYYY;
        endif;
        $data['tahunyangdinilaisaatini'] = $tahunyangdinilaisaatini;

        $currentnip = $this->session->userdata('nip');
        
        $results_pejabat_penilai_i = $this->m_profil->ambil_detail_pegawai_dari_current_db($currentnip);
        
         //ambil detail pejabat penilai
        $nip_pejabat_penilai = $results_pejabat_penilai_i['rows']->pejabat_penilai;
        if ($nip_pejabat_penilai == NULL):
            $data['pejabat_penilai_nip'] = "-";
            $data['pejabat_penilai_nama'] = "-";
            $data['pejabat_penilai_pangkat'] = "-";
            $data['pejabat_penilai_unit_organisasi'] = NULL;
            $data['pejabat_penilai_id_jabatan'] = NULL;
            $data['pejabat_penilai_desc_jabatan'] = NULL;
        else:
            $this->load->database('other',TRUE);
            $results_pejabat_penilai_other = $this->m_profil->ambil_detail_pegawai_dari_other_db($nip_pejabat_penilai);
            $data['pejabat_penilai_nip'] = $nip_pejabat_penilai;
            if ($results_pejabat_penilai_other['num_rows'] != 0):
                $data['pejabat_penilai_nama'] = $results_pejabat_penilai_other['rows']->peg_nm;
                $data['pejabat_penilai_pangkat'] = $results_pejabat_penilai_other['rows']->peg_gol_pangkat;
            else:
                $data['pejabat_penilai_nama'] = "-";
                $data['pejabat_penilai_pangkat'] = "-";
            endif;
            //ambil jabatan, unit organisasi dari currentdb 
            $results_pejabat_penilai_ii = $this->m_penilaianskp->ambil_detail_pegawai_dari_current_db_join_jabatan($nip_pejabat_penilai);
            $data['pejabat_penilai_unit_organisasi'] = $results_pejabat_penilai_ii['rows']->unit_organisasi;
            $data['pejabat_penilai_id_jabatan'] = $results_pejabat_penilai_ii['rows']->id_jabatan;
            $data['pejabat_penilai_desc_jabatan'] = $results_pejabat_penilai_ii['rows']->deskripsi;
        endif;
        //hitung nilai_capaian_skp_rata_rata
        $raw_nilai_capaian_skp = $this->m_realisasiskp->ambilpenilaianskp_average_nilai_capaian_skp($currentnip, $tahunyangdinilaisaatini);
        if ( $raw_nilai_capaian_skp->average != NULL ): $nilai_capaian_skp = $raw_nilai_capaian_skp->average; else: $nilai_capaian_skp = 0; endif;
        $data['nilai_capaian_skp'] = $nilai_capaian_skp;
        $nilai_prestasi_akademik = $nilai_capaian_skp * (60/100);
        $data['nilai_prestasi_akademik'] = $nilai_prestasi_akademik;
        
        $this->load->view('vpenilaianSKP', $data);
    }
}
