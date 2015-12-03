<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hasilpenilaian
 *
 * @author mssbinertekno
 */
class detailpenilaian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('nip')) {
            redirect('login');
            return;
        }
        $this->menu = "hasilpenilaian";
        $this->title = "Detail Penilaian";
        $this->load->model('m_penilaianskp');
    }

    function index()
    {
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $this->load->helper('pusdiklat');
        $currentYYYY = getCurrentYYYY();
        $data['availableYYYY'] = $this->m_penilaianskp->ambildaftartahunyangtersedia();

        //demo tampilan -- seharusnya bukan post
        if (isset($_POST['textinput_keberatan'])):
            $data['showcompletemode'] = TRUE;
        else:
            $data['showcompletemode'] = FALSE;
        endif;

        if (isset($_POST['tahun'])):
            $tahunyangdinilaisaatini = $this->common->filter($this->input->post('tahun'));
        else:
            $tahunyangdinilaisaatini = $currentYYYY;
        endif;
        $data['tahunyangdinilaisaatini'] = $tahunyangdinilaisaatini;

        $currentnip = $this->session->userdata('nip');

        $this->load->view('vdetailpenilaian', $data);
    }

}
