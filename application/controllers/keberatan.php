<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of keberatan
 *
 * @author mssbinertekno
 */
class keberatan extends CI_Controller{
    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('nip')){
            redirect('login');
            return;
        }
        $this->load->model('m_profil');
        $this->load->model('m_penilaianskp');
        $this->load->model('m_realisasiskp');
        $this->load->model('m_penilaianperilakukerja');
        $this->menu = "hasilpenilaian";
        $this->submenu = "keberatan";
        $this->title = "Hasil Penilaian - Keberatan";
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
        
        $status_penilaian_skp = FALSE;
        $status_penilaian_perilaku_kerja = FALSE;
        $status_complete = FALSE;
        
        //hitung nilai_capaian_skp_rata_rata
        $raw_nilai_capaian_skp = $this->m_realisasiskp->ambilpenilaianskp_average_nilai_capaian_skp($currentnip, $tahunyangdinilaisaatini);
        if ( $raw_nilai_capaian_skp->average != NULL ): 
            $nilai_capaian_skp = $raw_nilai_capaian_skp->average;
            $status_penilaian_skp = TRUE;
        else: 
            $nilai_capaian_skp = 0; 
        endif;
        $data['nilai_capaian_skp'] = $nilai_capaian_skp;
        $nilai_prestasi_akademik = $nilai_capaian_skp * (60/100);
        $data['nilai_prestasi_akademik'] = $nilai_prestasi_akademik;
        
        $raw_penilaianperilakukerja = $this->m_penilaianperilakukerja->ambilnilaiperilaku($tahunyangdinilaisaatini, $currentnip);
        
        if (isset($raw_penilaianperilakukerja->nilai_rata_rata)):
            $nilai_rata_rata = $raw_penilaianperilakukerja->nilai_rata_rata;
            $status_penilaian_perilaku_kerja = TRUE;
        else:
            $nilai_rata_rata = 0;
        endif;
        
        if ( ($status_penilaian_skp == TRUE) && ($status_penilaian_perilaku_kerja == TRUE) ):
            $status_complete = TRUE;
        endif;
        $data['status_complete'] = $status_complete;
        $data['nilai_rata_rata'] = $nilai_rata_rata;
        $nilai_perilaku_kerja = $nilai_rata_rata * (40/100);
        $data['nilai_perilaku_kerja'] = $nilai_perilaku_kerja;
        //=IF(R26<=50;"(Buruk)";IF(R26<=60;"(Sedang)";IF(R26<=75;"(Cukup)";IF(R26<=90.99;"(Baik)";"(Sangat Baik)"))))
        $total_nilai = $nilai_prestasi_akademik + $nilai_perilaku_kerja;
        if ($status_complete == FALSE):
            $kriteria_nilai = "-";
        else:
            switch($total_nilai):
                case ($total_nilai <= 50):
                    $kriteria_nilai = "Buruk";
                    break;
                case ($total_nilai <= 60):
                    $kriteria_nilai = "Sedang";
                    break;
                case ($total_nilai <= 75):
                    $kriteria_nilai = "Cukup";
                    break;
                case ($total_nilai <= 90.99):
                    $kriteria_nilai = "Baik";
                    break;
                case ($total_nilai >= 91):
                    $kriteria_nilai = "Sangat Baik";
                    break;
            endswitch;
        endif;
        $data['status_complete'] = $status_complete;
        $data['total_nilai'] = $total_nilai;
        $data['kriteria_nilai'] = $kriteria_nilai;
        $this->load->view('vkeberatan', $data);
    }
}
