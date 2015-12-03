<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
	
	public function login() {
        if (isset($_POST['nip']) && isset($_POST['password'])) {
            $res = $this->muser->auth($this->common->filter($this->input->post('nip')), $this->common->filter($this->input->post('password')));
            if ($res == AJAX_SUCCESS) {
			    
				if($this->session->userdata('role') == '2'){
					redirect('dasboard_pelanggan');
				}else{
					redirect('dashboard');
				}

                return;
            }
            $this->session->set_userdata('error', $res);
            redirect('login');
            return;
        }
        redirect('login');
    }

    public function logout() {
        if (!$this->session->userdata('nip')) {
            redirect('login');
            return;
        }
        $this->muser->logout(); // harus dipanggil sebelum sess_destroy karena di dalamnya ada pemanggilan session
        $this->session->sess_destroy();
        redirect('login');
    }
	
	public function test() {
		echo $this->muser->my_md5('a');
	}
}

?>
