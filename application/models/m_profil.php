<?php
class m_profil extends CI_Model{
    function ambil_detail_pegawai_dari_other_db($currentnip){       
        $q = "SELECT peg_nm, peg_gol_pangkat FROM mpegawai WHERE peg_nip = '$currentnip'";
        $ret['rows'] = $this->db->query($q)->row();

        $tmp = $this->db->query($q)->num_rows();
        $ret['num_rows'] = $tmp;

        return $ret;
    }
    function ambil_detail_pegawai_dari_current_db($currentnip){       
        $q = "SELECT pegawai.unit_organisasi, pegawai.pejabat_penilai, pegawai.id_jabatan, jabatan.deskripsi FROM pegawai LEFT JOIN jabatan ON pegawai.id_jabatan = jabatan.id WHERE nip = '$currentnip'";
        $ret['rows'] = $this->db->query($q)->row();
        return $ret;
    }
    function ambil_daftar_jabatan(){       
        $q = "SELECT * FROM jabatan";
        $ret = $this->db->query($q)->result();

        return $ret;
    }
    function simpanperubahanprofil($jabatan, $unit, $currentnip, $pejabat_penilai_nip){
        $query = "UPDATE pegawai SET id_jabatan = '$jabatan', unit_organisasi = '$unit', pejabat_penilai = '$pejabat_penilai_nip' "
                . " WHERE nip = '$currentnip'";
        $run = $this->db->query($query);
        if ($run) {
            $this->db->trans_commit();
            return TRUE;
        } else {
            $this->db->trans_rollback();
            return "Gagal melakukan perubahan";
        }
    }
    function ambil_daftar_nip_pegawai_selain($currentnip){
        $q = "SELECT nip FROM pegawai WHERE nip != '$currentnip'";
        $ret = $this->db->query($q)->result();
        return $ret;
    }
    function ambil_daftar_nama_nip_pegawai($concateniparray, $namapegawai){
        $q = "SELECT peg_nip, peg_nm FROM mpegawai WHERE peg_nm LIKE '%$namapegawai%' AND peg_nip IN ('$concateniparray') ";
        $ret = $this->db->query($q)->result();
        return $ret;
    }
}
