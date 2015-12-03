<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('nip')){
            redirect('login');
            return;
        }
        //$this->load->model('mdb');
        $this->load->model('mdasbord');
        $this->menu = "berandaawal";
        $this->title = "Beranda Awal";
    }

    public function index() {
        $data['menu'] = $this->menu;
        $data['title'] = $this->title;
        $this->load->helper('pusdiklat');
        $currentYYYY = getCurrentYYYY();
        $data['currentYYYY'] = $currentYYYY;
        
        $currentnip = $this->session->userdata('nip');
        //ambil total target kuantitas dan total realisasi kuantitas
        $jeniskegiatan = 1;
        //ambil penilaian_ke terakhir
        $penilaian_ke_akhir = $this->mdasbord->caripenilaiankeakhir($currentnip, $currentYYYY, $jeniskegiatan)->penilaian_ke;
        //speedometer
        $data['total_kuantitas'] = $this->mdasbord->gettotalkuantitas($jeniskegiatan, $currentnip, $currentYYYY, $penilaian_ke_akhir);
        
        //column bar
        //ambil daftar tahun yang dimiliki
        $raw_daftar_tahun_pribadi_currentnip = $this->mdasbord->getdaftartahunpribadi($currentnip, $jeniskegiatan);

        if ($raw_daftar_tahun_pribadi_currentnip['num_rows'] != 0):
            $daftar_tahun_pribadi_currentnip = $raw_daftar_tahun_pribadi_currentnip['rows'];
        else:
            $daftar_tahun_pribadi_currentnip = $currentYYYY;
        endif;
        
        $array_dtpc = array();
        $obj_kuantitas = new stdClass();
        
        if ($raw_daftar_tahun_pribadi_currentnip['num_rows'] != 0):
            foreach ($daftar_tahun_pribadi_currentnip as $dtpc):
                array_push($array_dtpc, $dtpc);
                //ambil penilaian_ke terakhir
                $penilaian_ke_akhir_dtpc = $this->mdasbord->caripenilaiankeakhir($currentnip, $dtpc, $jeniskegiatan)->penilaian_ke;
                $total_kuantitas_dtpc = $this->mdasbord->gettotalkuantitas($jeniskegiatan, $currentnip, $dtpc, $penilaian_ke_akhir_dtpc);
                $obj_kuantitas->tahun = $dtpc;
                $obj_kuantitas->target = $total_kuantitas_dtpc->sum_target_kuantitas;
                $obj_kuantitas->realisasi = $total_kuantitas_dtpc->sum_realisasi_kuantitas;
            endforeach;
        else:
            array_push($array_dtpc, $currentYYYY);
            $obj_kuantitas->tahun = $currentYYYY;
            $obj_kuantitas->target = 0;
            $obj_kuantitas->realisasi = 0;
        endif;
        $imploded_array_dtpc = implode(",", $array_dtpc);
        //column chart
        $data['daftar_tahun'] = $imploded_array_dtpc;
        //target
        $array_target = (array) $obj_kuantitas->target;
        //realisasi
        $array_realisasi = (array) $obj_kuantitas->realisasi;
        $data['column_data_target'] = implode(",", $array_target);
        $data['column_data_realisasi'] = implode(",", $array_realisasi);
        //data table diambil dari data terakhir
        //$data['title'] = $this->mutil->get_menu_name('dashboard/index');
        $this->load->view('vdashboard', $data);
    }

   


}
