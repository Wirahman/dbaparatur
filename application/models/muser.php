<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class muser extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function my_md5($pass) {
        $md5_1 = md5($pass . 'AMR');
        $md5_2 = md5('DASHBOARD' . $pass);
        return substr($md5_1, 16, 16) . substr($md5_2, 0, 16);
    }

    public function auth($nip, $password, $namapegawaisaatini, $existonanotherdb) {
        $sql = "SELECT * FROM pegawai WHERE nip=? AND password=?";
        $res = $this->db->query($sql, array($nip, $this->my_md5($password)));
        
     
        if ($res->num_rows() == 1) {
            $row = $res->row(1);
			if ($row->status==0)
				return 'User Anda diblok, hubungi Administrator';
            $this->session->set_userdata('nip', $nip);
            $this->session->set_userdata('role', $row->ref_role);
            $this->session->set_userdata('unit_organisasi', $row->unit_organisasi);
            $this->session->set_userdata('nama_pegawai', $namapegawaisaatini);
            $this->session->set_userdata('existonanotherdb', $existonanotherdb);
            $this->db->query("UPDATE pegawai SET waktu_login_terakhir=?, ip_login_terakhir=? WHERE nip=?", array(date('Y-m-d H:i:s'), $this->common->get_host(), $nip));
			
            return AJAX_SUCCESS;
        }
        return 'NIP pengguna dan kata sandi yang anda masukkan tidak cocok <br> Silahkan Periksa dan coba lagi.';
    }
	
	public function logout() {
      
        $this->db->query("UPDATE pegawai SET waktu_akses_terakhir=?, ip_login_terakhir=? WHERE nip=?", array(date('Y-m-d H:i:s'), $this->common->get_host(), $this->session->userdata('nip')));
    }
	
	public function add($data, $username_edited) {
		$this->mutil->access_record(__CLASS__.'.'.__FUNCTION__, $username_edited.';'.var_export($data, true));
		if (strlen($username_edited)==0) {
//			$data['insert_datetime'] = $this->common->get_mysql_date();
			$res = $this->db->insert('pegawai', $data);
			$report = 'User '.$data['nip'].' berhasil ditambahkan';
		} else {
//			$data['update_datetime'] = $this->common->get_mysql_date();
			$res = $this->db->update('pegawai', $data, array('nip'=>$username_edited));
			$report = 'User '.$username_edited.' berhasil diupdate';
		}
		
		if (!$res) {
			return 'Proses gagal'.$this->db->_error_message();
		} else {
			$this->session->set_userdata('form_success', $report);
			return AJAX_SUCCESS;
		}
	}
	
	public function is_username_exist($nip) {
		$res = $this->db->query("SELECT * FROM pegawai WHERE nip='$nip'");
		return $res->num_rows()>0;
	}
	
	public function is_email_exist($email) {
		$res = $this->db->query("SELECT * FROM pegawai WHERE email='$email'");
		return $res->num_rows()>0;
	}
	
	public function get_menus($is_left_menu=1) {
		$arr = array();
		// parent_id=0 -> tidak punya parent
		$res = $this->db->query("SELECT * FROM tr_menu WHERE is_left_menu=$is_left_menu AND parent_id=0 ORDER BY position");
		foreach ($res->result() as $row) {
			$arr[$row->menu_url] = $row->has_child;
		}
		return $arr;
	}
	
	public function get_submenus($parent_url) {
		$arr = array();
		// parent_id=0 -> tidak punya parent
		$res = $this->db->query("SELECT * FROM tr_menu WHERE is_left_menu=1 AND parent_id=(SELECT id FROM tr_menu WHERE menu_url='$parent_url') ORDER BY position");
		foreach ($res->result() as $row) {
			$arr[] = $row->menu_url;
		}
		return $arr;
	}
	
	public function get_authorized_menu($ref_role) {
		$arr_name = array();
		$arr_icon_class = array();
		$sql = "SELECT * FROM t_role_menu rm, tr_menu m WHERE rm.ref_menu=m.id AND ref_role=?";
		$res = $this->db->query($sql, array($ref_role));
		foreach ($res->result() as $row) {
			$arr_name[$row->menu_url] = $row->menu_name;
			$arr_icon_class[$row->menu_url] = $row->icon_class;
		}
		return array('name'=>$arr_name, 'icon_class'=>$arr_icon_class);
	}
	
	public function get_authorized_url($role_id) {
		$arr = array();
		$sql = "SELECT * FROM t_role_menu rm, tr_menu m WHERE rm.ref_menu=m.id AND ref_role=?";
		$res = $this->db->query($sql, array($role_id));
		foreach ($res->result() as $row) {
			$arr[$row->menu_url] = $row->menu_name;
		}
		return $arr;
	}
	
	public function has_access_to($url) {
		$sql = "SELECT * FROM t_role_menu rm, tr_menu m WHERE rm.ref_menu=m.id AND ref_role=? AND menu_url=?";
		$res = $this->db->query($sql, array($this->session->userdata('role'), $url));
		return ($res->num_rows()==1);
	}
	
	public function get_user_list() {
		$res = $this->db->query("SELECT * FROM pegawai ORDER BY nip");
		return $res;
	}
        
        public function get_pegawai_list() {
		$res = $this->db->query("SELECT *
                FROM pegawai a
                LEFT JOIN jabatan b ON  a.id_jabatan=b.id");
		return $res;
	}
        
    function ambil_detail_pegawai_dari_other_db(){       
        $q = $this->db->query("SELECT peg_nm, peg_gol_pangkat FROM mpegawai ");
    

        return $q;
    }
        

	
	public function get_combo_role() {
		$res = $this->db->query("SELECT * FROM tr_role ORDER BY detil");
		$data = array(''=>'--- Pilih Role ---');
		foreach ($res->result() as $row) {
			$data[$row->id] = $row->detil;
		}
		return $data;
	}
	
	public function get_user($nip) {
		$res = $this->db->query("SELECT * FROM pegawai WHERE nip=?", array($nip));
		if ($res->num_rows()==0)
			return null;
		$row = $res->row(1);
		return $row;
	}
	
	public function get_nip($nip) {
		$res = $this->db->query("SELECT * FROM pegawai WHERE nip=?", array($nip));
		if ($res->num_rows()==0)
			return array();
		$row = $res->row_array();
		return $row;
	}
	
	public function get_email($email) {
		$res = $this->db->query("SELECT * FROM pegawai WHERE email=?", array($email));
		if ($res->num_rows()==0)
			return array();
		$row = $res->row_array();
		return $row;
	}
	
	public function get_role_list() {
		$res = $this->db->query("SELECT * FROM tr_role ORDER BY detil");
		return $res;
	}
	
	public function get_user_by_role($role_id) {
		$res = $this->db->query("SELECT * FROM pegawai WHERE ref_role=? ORDER BY nip", array($role_id));
		return $res;
	}
	
	public function is_role_name_exist($role_name) {
		$res = $this->db->query("SELECT * FROM tr_role WHERE detil=?", array($role_name));
		return ($res->num_rows()>0);
	}
	
	public function add_role($role_name) {
		$this->mutil->access_record(__CLASS__.'.'.__FUNCTION__, $role_name);
		
		$res = $this->db->insert('tr_role', array('detil'=>$role_name));
		
		if (!$res) {
			return 'Proses gagal';
		} else {
			$this->session->set_userdata('form_success', 'Role '.$role_name.' berhasil ditambahkan');
			return AJAX_SUCCESS;
		}
	}
	
	public function edit_role_name($role_id, $role_name) {
		$this->mutil->access_record(__CLASS__.'.'.__FUNCTION__, $role_id.';'.$role_name);
		
		$res = $this->db->update('tr_role', array('detil'=>$role_name), array('id'=>$role_id));
		
		if (!$res) {
			$this->session->set_userdata('form_error', 'Role '.$role_name.' gagal diedit');
			return 'xx dont care';
		} else {
			$this->session->set_userdata('form_success', 'Role '.$role_name.' berhasil diedit');
			return 'xx dont care';
		}
	}
	
	public function get_role($role_id) {
		$res = $this->db->query("SELECT * FROM tr_role WHERE id=?", array($role_id));
		if ($res->num_rows()==0)
			return array();
		$row = $res->row_array();
		return $row;
	}
	
	public function delete_role($role_id, $role_name) {
		$this->mutil->access_record(__CLASS__.'.'.__FUNCTION__, $role_id.'='.$role_name);
		
		$res = $this->db->query("SELECT COUNT(*) AS count1 FROM pegawai WHERE ref_role=$role_id");
		$row = $res->row(1);
		if ($row->count1 > 0) {
			$this->session->set_userdata('form_error', 'Ada '.$row->count1.' user yang memiliki role '.$role_name.', penghapusan dibatalkan');
			return 'xx dont care';
		}
		
		$res = $this->db->delete('tr_role', array('id'=>$role_id));
		if (!$res) {
			$this->session->set_userdata('form_error', 'Role '.$role_name.' gagal dihapus');
			return 'xx dont care';
		} else {
			$this->session->set_userdata('form_success', 'Role '.$role_name.' berhasil dihapus');
			return 'xx dont care';
		}
	}
	
	public function edit_role_access($role_id, $role_name, $arr_menu_id) {
		$this->mutil->access_record(__CLASS__.'.'.__FUNCTION__, $role_id.';'.var_export($arr_menu_id, true));
		$this->db->trans_begin();
		
		$res = $this->db->delete('t_role_menu', array('ref_role'=>$role_id));
		if (!$res) {
			$this->db->trans_rollback();
			return 'Akses untuk role '.$role_name.' gagal diupdate';
		}
		foreach ($arr_menu_id as $val) {
			$res = $this->db->insert('t_role_menu', array('ref_role'=>$role_id, 'ref_menu'=>$val));
			if (!$res) {
				$this->db->trans_rollback();
				return 'Akses untuk role '.$role_name.' gagal diupdate';
			}
		}
		
		$this->db->trans_commit();
		$this->session->set_userdata('form_success', 'Akses untuk role '.$role_name.' berhasil diupdate');
		return AJAX_SUCCESS;
	}
	
	public function delete($nip) {
		$this->mutil->access_record(__CLASS__.'.'.__FUNCTION__, $nip);
		$res = $this->db->delete('pegawai', array('nip'=>$nip));
		if (!$res) {
			return 'NIP '.$nip.' gagal dihapus karena masih digunakan sebagai referensi di data lain';
		} else {
			return AJAX_SUCCESS;
		}
	}
	
	public function change_password($data, $nip) {
        $this->mutil->access_record(__CLASS__ . '.' . __FUNCTION__, $nip.';'.var_export($data, true));
        $res = $this->db->update('pegawai', $data, array('nip' => $nip));
        if (!$res) {
            return 'Proses ubah password gagal';
        } else {
            return AJAX_SUCCESS;
        }
    }
	
	public function get_notif($nip, $unread, $limit='') {
		$res = $this->db->query("
		SELECT
		b.id AS id,
		b.read_datetime AS read_datetime,
		a.n_datetime AS n_datetime,
		a.uraian AS uraian,
		a.notif_url AS notif_url
		FROM t_notifikasi a, t_notifikasi_user b
		WHERE a.id=b.ref_notifikasi
		AND b.ref_username='$nip'
		".($unread?"AND b.read_datetime IS NULL":"")."
		ORDER BY a.id DESC
		".(strlen($limit)>0?"LIMIT 0, $limit":"")."
		");
		return $res;
	}
}
