<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class mdasbord extends CI_Model {
    
        function caripenilaiankeakhir($currentnip, $currentYYYY, $jeniskegiatan){
            $q = "SELECT IFNULL( (SELECT penilaian_ke FROM penilaian_skp WHERE nip = '$currentnip' AND tahun = '$currentYYYY' AND jenis_kegiatan = '$jeniskegiatan' ORDER BY penilaian_ke DESC LIMIT 1), 1 ) AS penilaian_ke";
            $fetch = $this->db->query($q);
            return $fetch->row();
        }
        function gettotalkuantitas($jeniskegiatan, $currentnip, $currentYYYY, $penilaian_ke_akhir){
            //ambil yang paling akhir
            //$q = "SELECT SUM(`target_kuantitas`) AS sum_target_kuantitas, SUM(`realisasi_kuantitas`) AS sum_realisasi_kuantitas FROM penilaian_skp WHERE nip = '$currentnip' AND tahun = '$currentYYYY' AND jenis_kegiatan = '$jeniskegiatan' AND penilaian_ke = '$penilaian_ke_akhir'";
            $q = "SELECT IFNULL( (SELECT SUM(`target_kuantitas`) AS sum_target_kuantitas FROM penilaian_skp WHERE nip = '$currentnip' AND tahun = '$currentYYYY' AND jenis_kegiatan = '$jeniskegiatan' AND penilaian_ke = '$penilaian_ke_akhir'),0) AS sum_target_kuantitas, "
                    . "IFNULL( (SELECT SUM(`realisasi_kuantitas`) AS sum_realisasi_kuantitas FROM penilaian_skp WHERE nip = '$currentnip' AND tahun = '$currentYYYY' AND jenis_kegiatan = '$jeniskegiatan' AND penilaian_ke = '$penilaian_ke_akhir'),0) AS sum_realisasi_kuantitas ";
            $fetch = $this->db->query($q);
            return $fetch->row();
        }
        function getdaftartahunpribadi($currentnip, $jeniskegiatan){
            $q = "SELECT `tahun` FROM penilaian_skp WHERE nip = '$currentnip' AND jenis_kegiatan = '$jeniskegiatan'";
            $fetch = $this->db->query($q);
            $res['num_rows'] = $fetch->num_rows();
            $res['rows'] = $fetch->row();
            return $res;
        }
}
?>