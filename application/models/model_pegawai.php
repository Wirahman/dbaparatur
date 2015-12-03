<?php
class model_pegawai extends CI_Model{
	function get($id) {
		$query = $this->db->get_where('pegawai',array('nip'=>$id),1,0);
		return $query->result() ? $query->result()[0] : NULL ;		
	}
	
	function get_by_params($data) {
		$query = $this->db->get_where('pegawai',$data,1,0);
		return $query->result() ? $query->result()[0] : NULL ;		
	}
	
	function get_where($data) {
		$query = $this->db->get_where('pegawai',$data,1,0);
		$result = $query->result();
		return  $result ? $result[0] : NULL ;
	}
	
	function get_all() {
		$query = $this->db->query("
				SELECT *
				FROM pegawai P
                LEFT JOIN jabatan J ON  P.id_jabatan=J.id");
		return $query->result();
	}
	
	function get_detail($nip) {
		$data = array('peg_nip'=>$nip);
		$query = $this->db->get_where('mpegawai',$data,1,0);
		return $query->result() ? $query->result()[0] : NULL ;	
	}
	
	function update($nip,$data) {
		$this->db->where('nip', $nip);
		$this->db->update('pegawai', $data); 
	}
}
