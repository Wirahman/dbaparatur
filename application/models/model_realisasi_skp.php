<?php
class model_realisasi_skp extends CI_Model{
	// Insert new record
	function update_realisasi($data,$awal_penilaian) {
		list($y0,$m0,$d0) = explode("-",$awal_penilaian);
		$m = date("m");
		$d = date("d");
		$bulan = (intval($m) - intval($m0)) + ((intval($d) >= intval($d0)) ? 1 : 0);
		$sql = 'UPDATE penilaian_skp ' . 
				'SET '. 
					'realisasi_kuantitas = realisasi_kuantitas + ' . $data['kuantitas'] . ',' . 
					'realisasi_biaya = realisasi_biaya + ' . $data['biaya'] . ',' . 
					'realisasi_angka_kredit  = realisasi_angka_kredit + ' . $data['ak'] . ',' . 
					'realisasi_waktu=' . $bulan . 
				' WHERE id="' . $data['id_skp'] . '"';
		$this->db->trans_start();
		$this->db->insert('realisasi_skp', $data); 		
		$this->db->query($sql);
		$this->db->trans_complete();
		return 0;
	}

	function delete_realisasi($realisasi) {
		$sql = 'UPDATE penilaian_skp ' . 
				'SET '. 
					'realisasi_kuantitas = realisasi_kuantitas - ' . $realisasi->kuantitas . ',' . 
					'realisasi_biaya = realisasi_biaya - ' . $realisasi->biaya . ',' . 
					'realisasi_angka_kredit  = realisasi_angka_kredit - ' . $realisasi->ak .
				' WHERE id="' . $realisasi->id_skp . '"';
		$this->db->trans_start();
		$this->db->delete('realisasi_skp', array('id'=>$realisasi->id)); 		
		$this->db->query($sql);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	function delete_ttk($id) {
		$this->db->trans_start();
		$this->db->delete('penilaian_skp', array('id'=>$id)); 	
		$this->db->delete('realisasi_skp', array('id_skp'=>$id)); 		
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	function insert($data) {
		$this->db->insert('realisasi_skp', $data); 		
		return $this->db->insert_id();
	}
	
	// Update a record
	function update($id,$data) {
		$this->db->where('id', $id);
		$this->db->update('realisasi_skp', $data);
		return 0;	
	}
	
	function delete($data) {
		$this->db->delete('realisasi_skp', $data);
		return 0;
	}
	
	// Get data by primary key
	function get($id) {
		$query = $this->db->get_where('realisasi_skp',array('id'=>$id),1,0);
		return $query->result() ? $query->result()[0] : NULL ;		
	}
	
	// Get data by parameters
	function get_where($data) {
		$query = $this->db->get_where('realisasi_skp',$data);
		return $query->result();		
	}
	
	function get_authorized_nips($filename) {
		$sql = "SELECT ppk.nip, ppk.nip_pejabat_penilai, ppk.nip_atasan_pejabat_penilai 
				FROM penilaian_prestasi_kerja ppk
				JOIN penilaian_skp ps ON ppk.id = ps.id_prestasi_kerja
				JOIN realisasi_skp rs ON ps.id = rs.id_skp
				WHERE rs.dokumen = '$filename'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result ? $result[0] : NULL;
	}
}
