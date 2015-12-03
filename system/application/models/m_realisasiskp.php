<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_realisasiskp
 *
 * @author mssbinertekno
 */
class m_realisasiskp extends CI_Model{
    function ambilpenilaianskp_ktj($currentnip, $year){
        $querystring = "SELECT *, kegiatan_tugas_jabatan.kegiatan AS desc_kegiatan, kegiatan_tugas_jabatan.satuan_kuantitas FROM penilaian_skp LEFT JOIN kegiatan_tugas_jabatan ON kegiatan_tugas_jabatan.id = penilaian_skp.kegiatan WHERE nip = '$currentnip' AND tahun = '$year' AND jenis_kegiatan = 1";
        $res = $this->db->query($querystring);
        return $res->result();
    }
    function ambilpenilaianskp_tt_k($currentnip, $year){
        $querystring = "SELECT *, kegiatan_tugas_jabatan.kegiatan AS desc_kegiatan, kegiatan_tugas_jabatan.satuan_kuantitas FROM penilaian_skp LEFT JOIN kegiatan_tugas_jabatan ON kegiatan_tugas_jabatan.id = penilaian_skp.kegiatan WHERE nip = '$currentnip' AND tahun = '$year' AND jenis_kegiatan != 1 ORDER BY jenis_kegiatan ASC";
        $res = $this->db->query($querystring);
        return $res->result();
    }
    function ambilpenilaianskp_average_nilai_capaian_skp($currentnip, $year){
        $querystring = "SELECT AVG(`nilai_capaian_skp`) AS average FROM penilaian_skp WHERE nip = '$currentnip' AND tahun = '$year' ";
        $res = $this->db->query($querystring);
        return $res->row();
    }
}
