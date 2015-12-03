<?php
class model_jabatan extends CI_Model{
	function get($id) {
		$data = array('id'=>$id);
		$query = $this->db->get_where('jabatan',$data,1,0);
		$result = $query->result();
		return  $result ? $result[0] : NULL ;
	}
	
	function get_where($data) {
		$query = $this->db->get_where('jabatan',$data);
		return $query->result();
	}
	
	function get_all() {
		$query = $this->db->get('jabatan');
		return $query->result();
	}
	
	function update($id,$data) {
		$this->db->where('id', $id);
		$this->db->update('jabatan', $data); 
	}
}
