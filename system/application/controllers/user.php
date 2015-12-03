<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {

	public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('nip')) {
            redirect('login');
		}
    }

	public function index() {
		if (!$this->muser->has_access_to('user/index')) { redirect('dashboard');return; }
		$html['title'] = $this->mutil->get_menu_name('user/index');
		$html['data'] = $this->muser->get_user_list();
		$html['data_role_map'] = $this->mutil->get_table_map('tr_role');
		$html['data_status_map'] = $this->mutil->get_status_map();
		$html['data_status_icon_map'] = $this->mutil->get_status_icon_map();
		$html['has_access'] = $this->muser->has_access_to('user/add');
		$this->load->view('vuser_index', $html);
	}
        
        public function aktifitas(){
                $currentnip = $this->session->userdata('nip');
                $html['query'] = $this->mutil->get_access_record($currentnip);
                $this->load->view('vuser_aktifitas', $html);
        }
	
	public function add($nip='') {
		if (!$this->muser->has_access_to(__CLASS__.'/'.__FUNCTION__)) { redirect('dashboard');return; }
		if (strlen($nip)>0) {
			if (!ctype_alnum($nip)) { redirect('dashboard');return; }
			if (strtolower($nip)==strtolower($this->session->userdata('nip'))) { redirect('dashboard');return; }
			$html['row'] = $this->muser->get_user($nip);
			if (is_null($html['row'])) { redirect('dashboard');return; }
			$html['username_edited'] = $nip;
		}
		$html['subtitle'] = $this->mutil->get_menu_name('user/add/'); // yg lainnya pake title, ini subtitle karena bentuknya form
		$html['random_password'] = $this->common->my_rand_number(MIN_LENGTH_PASSWORD);
		$html['arr_role'] = $this->muser->get_combo_role();
                
		$this->load->view('vuser_add', $html);
	}
	
	public function doadd() { // via AJAX
		if (!$this->muser->has_access_to('user/add')) { redirect('dashboard');return; }
		
		$data = array();
		$error = array();
		$username_edited = $this->common->filter($this->input->post('username_edited'));
		if (strlen($username_edited)>0 && !ctype_alnum($username_edited)) die('Invalid nip');
		
		$post = array(
			'nip'=>'Username',
			'password'=>'Password',
                        'pejabat_penilai'=>'Pejabat Penilai',
			'ref_role'=>'Role',
			'unit_organisasi'=>'Unit Organisaasi',
		
		);

		foreach ($post as $key=>$val) {
			$input = $this->common->filter($this->input->post($key));
			if (strlen($username_edited)==0) { // add
				if (strlen($input)==0)
					$error[] = 'Anda harus mengisi '.$val;
			} else { // edit
				if (strlen($input)==0 && !in_array($key, array('password')))
					$error[] = 'Anda harus mengisi '.$val;
			}
			$data[$key] = $input;
		}
		
		if (count($error)==0) {
			if (strlen($username_edited)==0) { // add
				if (!ctype_alnum($data['nip'])) {
					$error[] = 'NIP harus karakter alfanumerik';
				} else {
					$test = $this->muser->get_user($data['nip']);
					if (!is_null($test))
						$error[] = 'NIP '.$data['nip'].' sudah terdaftar';
				}
				if (strlen($data['password']) < MIN_LENGTH_PASSWORD)
					$error[] = 'Panjang password minimum '.MIN_LENGTH_PASSWORD.' karakter';
				
			} else { // edit
				unset($data['nip']);
				$test = $this->muser->get_user($username_edited);
				if (is_null($test)) die('Invalid nip');
				if (strlen($data['password']) > 0 && strlen($data['password']) < MIN_LENGTH_PASSWORD)
					$error[] = 'Panjang password minimum '.MIN_LENGTH_PASSWORD.' karakter';
				if (strlen($data['password']) == 0)
					unset($data['password']);
				
			}
			
		
		
		}
		
		if (count($error)>0) {
			echo implode('<br />', $error);
			return;
		}
		if (isset($data['password']) && strlen($data['password'])>0) // karena jika kasus edit dan password dikosongkan maka tidak perlu ada encrypt password
			$data['password'] = $this->muser->my_md5($data['password']);
		echo $this->muser->add($data, $username_edited);
	}
	
	public function role() {
		if (!$this->muser->has_access_to(__CLASS__.'/'.__FUNCTION__)) { redirect('dashboard');return; }
		$html['title'] = $this->mutil->get_menu_name('user/role/');
		$html['data_role'] = $this->muser->get_role_list();
		$this->load->view('vuser_role', $html);
	}
	
	public function doaddrole() {
		if (!$this->muser->has_access_to('user/addrole')) { redirect('dashboard');return; }
		
		$error = array();
		
		$role = $this->input->post('ROLE');
		if (strlen($role)==0)
			$error[] = 'Anda harus mengisi nama role';
		elseif ($this->muser->is_role_name_exist($role))
			$error[] = 'Role '.$role.' sudah terdaftar';
		
		if (count($error)>0) {
			echo implode('<br />', $error);
			return;
		}
		echo $this->muser->add_role($role);
	}
	
	public function doeditrolename() {
		if (!$this->muser->has_access_to('user/rolename')) { redirect('dashboard');return; }
		
		$role_id = $this->input->post('id');
		$role_name = $this->input->post('detil');
		if (strlen($role_name)==0) {
			echo $this->session->set_userdata('form_error', 'Nama role harus diisi');
			return '';
		}
		echo $this->muser->edit_role_name($role_id, $role_name);
	}
	
	public function roleaccess($role_id='') {
		if (!$this->muser->has_access_to(__CLASS__.'/'.__FUNCTION__)) { redirect('dashboard');return; }
		if (strlen($role_id)==0 || !ctype_digit($role_id)) {
			redirect('dashboard');
			return;
		}
		if ($role_id==$this->session->userdata('role')) {
			redirect('dashboard');
			return;
		}
		$role_prop = $this->muser->get_role($role_id);
		if (count($role_prop)==0) {
			redirect('dashboard');
			return;
		}
		$html['title'] = $this->mutil->get_menu_name('user/role/').' '.$role_prop['detil'];
		$html['arr_menu'] = $this->muser->get_authorized_url($role_id);
		$html['data_menu'] = $this->mutil->get_menu_list();
		$html['role_id'] = $role_id;
		$html['role_name'] = $role_prop['detil'];
		$this->load->view('vuser_role_access', $html);
	}
	
	public function dodeleterole() {
		if (!$this->muser->has_access_to(__CLASS__.'/'.__FUNCTION__)) { redirect('dashboard');return; }
		
		$role_id = $this->input->post('id');
		$role_name = $this->input->post('detil');
		if (!ctype_digit($role_id)) die();
		echo $this->muser->delete_role($role_id, $role_name);
	}
	
	// input: menu_1,menu_3,menu_5, ..........
	public function doeditroleaccess() { // via AJAX
		if (!$this->muser->has_access_to('user/roleaccess')) { redirect('dashboard');return; }
		
		$role_id = $this->input->post('role_id');
		$role_name = $this->input->post('role_name');
		
		if ($role_id==$this->session->userdata('role'))
			die('Unauthorized access');
		
		$str = $this->input->post('str');
		$arr_menu = explode(',', $str);
		$arr_menu_id = array();
		foreach ($arr_menu as $val) {
			if (strlen($val)>0) {
				// misal: menu_9
				$arr_temp = explode('_', $val);
				if (count($arr_temp)==2) {
					$arr_menu_id[] = $arr_temp[1];
				}
			}
		}
		echo $this->muser->edit_role_access($role_id, $role_name, $arr_menu_id);
	}
	
	public function dodelete() { // via AJAX
		if (!$this->muser->has_access_to('user/delete')) { redirect('dashboard');return; }
		$nip = $this->common->filter($this->input->post('nip'));
		if (strtolower($nip)==strtolower($this->session->userdata('nip'))) die('Unauthorized access');
		echo $this->muser->delete($nip);
	}
	
	public function password() {
        if ($this->input->is_ajax_request() && isset($_POST['oldpass'])) {
			$error = array();
            if (strlen($this->input->post('oldpass')) == 0)
                $error[] = 'Anda harus mengisi password lama';
            else {
                $user = $this->muser->get_user($this->session->userdata('nip'));
                if ($this->muser->my_md5($this->input->post('oldpass')) != $user->password)
                    $error[] = 'Password lama salah';
            }
            if (strlen($this->input->post('newpass1')) < MIN_LENGTH_PASSWORD)
                $error[] = 'Password minimum '.MIN_LENGTH_PASSWORD.' karakter';
            if (strlen($this->input->post('newpass2')) == 0)
                $error[] = 'Anda harus mengisi konfirmasi password baru';
            if ($this->input->post('newpass1') != $this->input->post('newpass2'))
                $error[] = 'Password Baru tidak sama dengan Konfirmasi Password Baru';

            if (count($error) > 0) {
                echo implode('<br />', $error);
            } else {
                $data = array(
                    'password' => $this->muser->my_md5($this->input->post('newpass1'))
                );
                echo $this->muser->change_password($data, $this->session->userdata('nip'));
            }
        } else {
            $this->load->view('vpassword');
        }
    }
}
