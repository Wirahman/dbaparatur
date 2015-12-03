<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
	
	public function login() {
        if (isset($_POST['nip']) && isset($_POST['password'])) {
            //ambil nama pegawai
            $postnip = $this->common->filter($this->input->post('nip'));
            $this->load->model('m_synchronize');
            $result_ambilnamapegawai = $this->m_synchronize->ambil_nama_pegawai_other_db($postnip);
            $res = 'NIP pengguna dan kata sandi yang anda masukkan tidak cocok <br> Silahkan Periksa dan coba lagi.';
            //if ($result_ambilnamapegawai['num_rows'] != 0):
                //agar admin bisa login
                if ($result_ambilnamapegawai['num_rows'] != 0):
                    $namapegawaisaatini = $result_ambilnamapegawai['rows']->peg_nm;
                    $res = $this->muser->auth($this->common->filter($this->input->post('nip')), $this->common->filter($this->input->post('password')), $namapegawaisaatini);
                    if ($res == AJAX_SUCCESS):
                        $this->mutil->access_record(__CLASS__ . '.' . __FUNCTION__, $this->session->userdata('nip'));
                        redirect('profil');
                        return;
                    endif;
                else:
                    $this->load->database('default',TRUE);
                    $resultcurrent_ambilnamapegawai = $this->m_synchronize->ambil_nama_pegawai_current_db($postnip);
                    if ($resultcurrent_ambilnamapegawai['num_rows'] != 0):
                        $namapegawaisaatini = $resultcurrent_ambilnamapegawai['rows']->nip;
                        $res = $this->muser->auth($this->common->filter($this->input->post('nip')), $this->common->filter($this->input->post('password')), $namapegawaisaatini);
                        if ($res == AJAX_SUCCESS):
                            $this->mutil->access_record(__CLASS__ . '.' . __FUNCTION__, $this->session->userdata('nip'));
                            redirect('profil');
                            return;
                        endif;
                    endif;
                endif;
                    $this->session->set_userdata('error', $res);
                    redirect('login');
                    return;
            //endif;
        }
        redirect('login');
    }

    public function logout() {
        $this->mutil->access_record(__CLASS__ . '.' . __FUNCTION__, $this->session->userdata('nip'));
        if (!$this->session->userdata('nip')) {
            redirect('login');
            return;
        }
        $this->muser->logout(); // harus dipanggil sebelum sess_destroy karena di dalamnya ada pemanggilan session
        $this->session->sess_destroy();
        redirect('login');
    }
}

?>
