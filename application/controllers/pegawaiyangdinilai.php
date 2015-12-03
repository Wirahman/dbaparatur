<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pegawaiyangdinilai
 *
 * @author mssbinertekno
 */
class pegawaiyangdinilai extends CI_Controller {
    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('nip')){
            redirect('login');
            return;
        }
        $this->menu = "pegawaiyangdinilai";
    }
    function getpegawaiyangdinilailevel1()
    {
        $nipterkaitsaatini = $this->common->filter($this->uri->segment(3));
        $data['menu'] = $this->menu;
        $data['submenu'] = "lvl1_".$nipterkaitsaatini;
        $this->load->view('vgetpegawaiyangdinilailevel1_hasilpenilaianoverview', $data);
        
    }
    function getpegawaiyangdinilailevel2()
    {
        $nipterkaitsebelum = $this->common->filter($this->uri->segment(3));
        $nipterkaitsaatini = $this->common->filter($this->uri->segment(4));
        $data['menu'] = $this->menu;
        $data['submenu'] = "lvl1_".$nipterkaitsebelum;
        $data['submenu1'] = "lvl2_".$nipterkaitsaatini;
        $this->load->view('vgetpegawaiyangdinilailevel1_hasilpenilaianoverview', $data);
    }
}
