<?php
class model_penilaian_prestasi_kerja extends CI_Model{
	// Insert new record
	function insert($data) {
		$this->db->insert('penilaian_prestasi_kerja', $data); 
		return 0;
	}
	
	// Update a record
	function update($id,$data) {
		$this->db->where('id', $id);
		$this->db->update('penilaian_prestasi_kerja', $data);
		return 0;	
	}
	
	// Get data by primary key
	function get($id) {
		$query = $this->db->get_where('penilaian_prestasi_kerja',array('id'=>$id),1,0);
		return $query->result() ? $query->result()[0] : NULL ;		
	}
	
	// Get data by parameters
	function get_where($data) {
		$query = $this->db->get_where('penilaian_prestasi_kerja',$data);
		return $query->result();		
	}
	
	// Get records where status less than 7
	function get_status_lt7($nip) {
		$where = "status <= 2 AND nip='" . $nip . "'";
		$this->db->where($where);
		$query = $this->db->get('penilaian_prestasi_kerja');
		return $query->result() ? $query->result()[0] : NULL ;
	}
	
	function get_status_lt5($nip) {
		$where = "status < 5 AND nip='" . $nip . "'";
		$this->db->where($where);
		$query = $this->db->get('penilaian_prestasi_kerja');
		return $query->result() ? $query->result()[0] : NULL ;
	}
	
	function get_count($data) {
		$this->db->where($data);
		$this->db->from('penilaian_prestasi_kerja');
		$count = $this->db->count_all_results();
		return $count;
	}
	
	function get_last_record($data) {
		$this->db->order_by('id','asc');
		$query = $this->db->get_where('penilaian_prestasi_kerja',$data,1,0);
		return $query->result() ? $query->result()[0] : NULL ;				
	}
}
