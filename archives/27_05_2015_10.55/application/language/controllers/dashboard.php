<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('nip')){
            redirect('login');
            return;
        }
        //$this->load->model('mdb');
        $this->load->model('mdasbord');
    }

    public function index() {

        //data table diambil dari data terakhir

       
        $data['title'] = $this->mutil->get_menu_name('dashboard/index');
        $this->load->view('vdashboard', $data);
        //$this->load->view('vchart');
    }

   


}
