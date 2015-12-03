<?php
class model_kegiatan_tugas_jabatan extends CI_Model{
	function insert($data) {
		$this->db->insert('kegiatan_tugas_jabatan', $data); 
		return 0;
	}
	
	function get($id) {
		$query = $this->db->get_where('kegiatan_tugas_jabatan',array('id'=>$id),1,0);
		return $query->result() ? $query->result()[0] : NULL ;		
	}
	
	function get_where($data) {
		$query = $this->db->get_where('kegiatan_tugas_jabatan',$data);
		return $query->result();		
	}
	
	function get_all() {
		$query = $this->db->get('kegiatan_tugas_jabatan');
		return $query->result();
	}
}
