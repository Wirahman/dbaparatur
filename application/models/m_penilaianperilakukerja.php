<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_penilaianperilakukerja
 *
 * @author mssbinertekno
 */
class m_penilaianperilakukerja extends CI_Model{
    function ambilnilaiperilaku($tahun, $nip){
        $q = "SELECT * FROM penilaian_perilaku_kerja WHERE nip = '$nip' AND tahun = '$tahun'";
        $fetch = $this->db->query($q);
        return $fetch->row();
    }
}
