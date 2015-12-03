<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_penilaianskp
 *
 * @author mssbinertekno
 */
class m_penilaianskp extends CI_Model{
    function ambil_detail_pegawai_dari_other_db($nip_pejabat_penilai){
        $q = "SELECT peg_nm, peg_gol_pangkat FROM mpegawai WHERE peg_nip = '$currentnip'";
        $ret['rows'] = $this->db->query($q)->row();

        $tmp = $this->db->query($q)->num_rows();
        $ret['num_rows'] = $tmp;

        return $ret;
    }
    function ambil_detail_pegawai_dari_current_db_join_jabatan($currentnip){       
        $q = "SELECT pegawai.unit_organisasi, pegawai.pejabat_penilai, pegawai.id_jabatan, jabatan.deskripsi FROM pegawai LEFT JOIN jabatan ON jabatan.id = pegawai.id_jabatan WHERE nip = '$currentnip'";
        $ret['rows'] = $this->db->query($q)->row();
        return $ret;
    }
    function ambildaftartahunyangtersedia(){
        $q = "SELECT tahun FROM penilaian_skp";
        $fetch = $this->db->query($q);
        return $fetch->result();
    }
}
