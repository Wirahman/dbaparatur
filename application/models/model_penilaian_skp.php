<?php
class model_penilaian_skp extends CI_Model{
	// Insert new record
	function trans_start() {
		$this->db->trans_start();
	}
	
	function trans_complete() {
		$this->db->trans_complete();
	}
	
	function insert($data) {
		$this->db->insert('penilaian_skp', $data); 
		return $this->db->insert_id();
	}
	
	// Update a record
	function update($id,$data) {
		$this->db->where('id', $id);
		$this->db->update('penilaian_skp', $data);
		return 0;	
	}
		
	function delete($data) {
		$this->db->delete('penilaian_skp', $data);
		return 0;
	}
	
	// Get data by primary key
	function get_last_record($data) {
		$this->db->order_by('id','asc');
		$query = $this->db->get_where('penilaian_skp',$data,1,0);
		$result = $query->result(); 
		return  $result ? $result[0] : NULL ;		
	}
	
	// Get data by primary key
	function get($id) {
		$query = $this->db->get_where('penilaian_skp',array('id'=>$id),1,0);
		return $query->result() ? $query->result()[0] : NULL ;		
	}
	
	// Get data by parameters
	function get_where($data) {
		$query = $this->db->get_where('penilaian_skp',$data);
		return $query->result();		
	}
}
