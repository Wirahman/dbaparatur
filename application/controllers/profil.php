<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class profil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('nip')) {
            redirect('login');
            return;
        }
        $this->load->model('m_profil');
        $this->menu = "profilpegawai";
        $this->title = "Profil Pegawai";
    }

    public function index()
    {
        //$data['title'] = $this->mutil->get_menu_name('dashboard/index');
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        //ambil data pegawai dari other db
        $currentnip = $this->session->userdata('nip');

        $results_current = $this->m_profil->ambil_detail_pegawai_dari_current_db($currentnip);
        $data['unit_organisasi'] = $results_current['rows']->unit_organisasi;
        $data['id_jabatan'] = $results_current['rows']->id_jabatan;
        $data['deskripsi_jabatan'] = $results_current['rows']->deskripsi;
        //ambil daftar jabatan
        $data['jabatan'] = $this->m_profil->ambil_daftar_jabatan();

        $this->load->database('other', TRUE);
        $results_other = $this->m_profil->ambil_detail_pegawai_dari_other_db($currentnip);
        if ($results_other['num_rows'] != 0):
            $data['nama'] = $results_other['rows']->peg_nm;
            $data['pangkat'] = $results_other['rows']->peg_gol_pangkat;
        else:
            $data['nama'] = $this->session->userdata('nama_pegawai');
            $data['pangkat'] = "-";
        endif;
        //ambil nama pejabat penilai
        $nip_pejabat_penilai = $results_current['rows']->pejabat_penilai;
        $results_pejabat_penilai = $this->m_profil->ambil_detail_pegawai_dari_other_db($nip_pejabat_penilai);
        if ($results_pejabat_penilai['num_rows'] == 0):
            $data['pejabat_penilai_nip'] = NULL;
            $data['pejabat_penilai_nama'] = NULL;
        else:
            $data['pejabat_penilai_nip'] = $nip_pejabat_penilai;
            $data['pejabat_penilai_nama'] = $results_pejabat_penilai['rows']->peg_nm;
        endif;

        $this->load->database('default', TRUE);

        //update session nama_pegawai
        //$this->session->set_userdata('nama_pegawai', $namapegawaisaatini);
        $this->load->view('vprofil', $data);
    }

    function ambildaftarpejabatpenilai($currentnip = 'admin')
    {
        //====== untuk daftar pejabat penilai
        $namapegawai = $this->input->post('namapegawai');
        //ambil daftar nip (current_db)
        $results_nip = $this->m_profil->ambil_daftar_nip_pegawai_selain($currentnip);
        $nip_array = array();
        foreach ($results_nip as $rn):
            array_push($nip_array, $rn->nip);
        endforeach;
        $concateniparray = implode("','", $nip_array);
        // ambil nama (other_db)
        $this->load->database('other', TRUE);
        $results_nama_nip = $this->m_profil->ambil_daftar_nama_nip_pegawai($concateniparray, $namapegawai);

        $reply = array();
        $reply['query'] = $namapegawai;
        $reply['suggestions'] = array();
        foreach ($results_nama_nip as $rnn) {
            $reply['suggestions'][] = array('value' => htmlentities(stripslashes($rnn->peg_nm)), 'data' => $rnn->peg_nip);
        }
        echo json_encode($reply);
    }

    public function simpanperubahan()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br>');

        $this->form_validation->set_rules('select_jabatan', 'Jabatan', 'required|check_default');
        $this->form_validation->set_message('check_default', 'The Jabatan field is required');

        $this->form_validation->set_rules('unit', 'Unit Kerja', 'xss_clean|required');
        $this->form_validation->set_rules('pejabat_penilai_nip', 'Pejabat Penilai', 'xss_clean|required');
        if ($this->form_validation->run() === false):
            $this->session->set_flashdata('error_message', validation_errors());
            redirect('profil', 'refresh');
        else:
            $jabatan = $this->common->filter($this->input->post('select_jabatan'));
            $unit = $this->common->filter($this->input->post('unit'));
            $pejabat_penilai_nip = $this->common->filter($this->input->post('pejabat_penilai_nip'));
            $currentnip = $this->session->userdata('nip');
            $res = $this->m_profil->simpanperubahanprofil($jabatan, $unit, $currentnip, $pejabat_penilai_nip);
            if ($res == AJAX_SUCCESS):
                $this->session->set_flashdata('success_message', "Berhasil melakukan perubahan");
                redirect('profil', 'refresh');
            else:
                $this->session->set_flashdata('error_message', $res);
                redirect('profil', 'refresh');
            endif;
        endif;
    }
}
