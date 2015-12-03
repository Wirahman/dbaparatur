<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class skp extends CI_Controller {

    public function __construct() {
        parent::__construct();
         $data['parameter'] = "";
        if (!$this->session->userdata('nip')){
            redirect('login');
            return;
        }
            $this->load->model('mskp');
            $this->load->model('m_profil');
            $this->load->model('mreferensi');

    }
      
    public function perencanaanSkp(){ 
         
        if(isset($_POST['kirim'])){
            
            $target_angka_kredit="";
            $target_kuantitas="";
            $satuan_kuantitas="";
            $target_kualitas="";
            $target_waktu="";
            $satuan_waktu ="";
            $target_biaya ="";
            $data['parameter'] = $_POST['parameter'];
            $data['message'] = "";
            $data['nama_kegiatan'] = "";
            
            if (strlen($_POST['nama_kegiatan'])==0 && ($_POST['target_angka_kredit'])==0 && 
                    ($_POST['target_kuantitas'])==0 &&($_POST['satuan_kuantitas'])==0 &&($_POST['target_kualitas'])==0 
                    &&($_POST['target_waktu'])==0 &&($_POST['satuan_waktu'])==0 &&($_POST['target_biaya'])==0 )
			{
				$data['parameter'] .= $_POST['parameter'];
				$data['message'] .=  $this->session->set_flashdata('message',  "Isi Data dengan lengkap!<br>");
			}
			else
			$data['parameter'] = $_POST['parameter'] . "-" . $_POST['nama_kegiatan'] . "-" . $_POST['target_angka_kredit']
                        . "-" . $_POST['target_kuantitas']. "-" .$_POST['satuan_kuantitas']. "-" . $_POST['target_kualitas']. "-" . $_POST['target_waktu']. "-" . $_POST['satuan_waktu']. "-" . $_POST['target_biaya'];
		        
        }else{
            $data['parameter'] = "";
	}
	if(isset($_POST['hapus'])){
            $data['urut'] = $_POST['urutan'];
            $data['parameter'] = $_POST['parameter'];
            $list = explode("-",$data['parameter']);
            $parameter = "";
		for($i=1;$i<count($list);$i++){
				if($i == $data['urut'] || $i == $data['urut']+1 || $i == $data['urut']+2 || $i == $data['urut']+3
                                        || $i == $data['urut']+4 || $i == $data['urut']+5 || $i == $data['urut']+6
                                        || $i == $data['urut']+7|| $i == $data['urut']+7){
				}else{
					$parameter .= "-" . $list[$i] . "-" . $list[$i+1] . "-" . $list[$i+2] . "-" . $list[$i+3]
                                         . "-" . $list[$i+4] . "-" . $list[$i+5] . "-" . $list[$i+6] . "-" . $list[$i+7];
				}
			}
                        
                        
                        if (strlen($parameter) < strlen($_POST['parameter']))
			$data['parameter'] = $parameter;
		} 
                
//                $this->load->library('form_validation');
//                $this->form_validation->set_error_delimiters('', '<br>');
//                $this->form_validation->set_rules('nama_kegiatan','Kegiatan','required|check_default');
//                $this->form_validation->set_rules('set_message','Target Angka Kredit', 'required|check_default');
//                $this->form_validation->set_rules('target_kuantitas', 'Target Kuantitas', 'xss_clean|required');
//                $this->form_validation->set_rules('satuan_kuantitas', ' Satuan Kuantitas', 'xss_clean|required');
//                $this->form_validation->set_rules('target_kualitas', 'Target Penilai', 'xss_clean|required');
//                $this->form_validation->set_rules('target_waktu', 'Target Waktu', 'xss_clean|required');
//                $this->form_validation->set_rules('satuan_waktu', 'Satuan Waktu', 'xss_clean|required');
//                $this->form_validation->set_rules('target_biaya', 'Target Biaya', 'xss_clean|required');
//                
//                if (isset($_POST['submit']) && $this->form_validation->run() == FALSE)
//		{
//                         
//			 $this->session->set_flashdata('message', validation_errors());
//                         redirect('skp/perencanaanSkp', 'refresh');
//                }  
		if(isset($_POST['submit']) && strlen($_POST['parameter']) >0 && $this->form_validation->run() == FALSE){
			$data['parameter'] = $_POST['parameter'];
			$list = explode("-",$data['parameter']);
			for($i=1;$i<count($list);$i+=8){
				// Prepare data untuk disimpan di tabel
                              $jenis_kegiatan=$this->input->post('jenis_kegiatan');
				$data = array(
							'id' => $data['id'] = $this->common->auto_generated(MIN_LENGTH_PASSWORD),
                                                        'nip' => $data['nip'] = $this->session->userdata('nip'),
                                                        'created_on' =>$data['created_on'] = date('Y-m-d H:i:s'),
                                                        'tahun' =>$data['tahun'] = date('Y'),
                                                        'jenis_kegiatan'=>$jenis_kegiatan,
                                                        'kegiatan' => $list[$i],
							'target_angka_kredit' => $list[$i+1],
							'target_kuantitas' => $list[$i+2],
							'satuan_kuantitas' => $list[$i+3],
                                                        'target_kualitas' => $list[$i+4],
							'target_waktu' => $list[$i+5],
							'satuan_waktu'	=> $list[$i+6],
                                                        'target_biaya'	=> $list[$i+7]
	
						);
                               
				// Proses simpan data 
				$insertdatatoDB =  $this->mskp->add_perencanaanSkp($data);
			}
                         $data['parameter'] = "";

                         if($insertdatatoDB==true){
                            $this->session->set_flashdata('message', 'Data Berhasil Diinput..!');
                            redirect('skp/perencanaanSkp', 'refresh');
                         }else
                         {
                             $this->session->set_flashdata('message', 'Data Gagal Diinput..!');
                             redirect('skp/perencanaanSkp', 'refresh');
                         }
		}
                
             
             $currentnip = $this->session->userdata('nip');
             $results_current = $this->m_profil->ambil_detail_pegawai_dari_current_db($currentnip);
             $data['unit_organisasi'] = $results_current['rows']->unit_organisasi;
             $data['id_jabatan'] = $results_current['rows']->id_jabatan;
             
             $this->load->database('other',TRUE);
             //ambil data pegawai
             $results_other = $this->m_profil->ambil_detail_pegawai_dari_other_db($currentnip);
            if ($results_other['num_rows'] != 0):
                $data['nama'] = $results_other['rows']->peg_nm;
                $data['pangkat_peg'] = $results_other['rows']->peg_gol_pangkat;
            else:
                $data['nama'] = $this->session->userdata('nama_pegawai');
                $data['pangkat_peg'] = "-";
            endif;
            
             //ambil nama pejabat penilai
            $nip_pejabat_penilai = $results_current['rows']->pejabat_penilai;
            $results_pejabat_penilai = $this->mskp->ambil_detail_pegawai_dari_other_db($nip_pejabat_penilai);
            if ($results_pejabat_penilai['num_rows'] == 0):
                $data['pejabat_penilai_nip'] = NULL;
                $data['pejabat_penilai_nama'] = NULL;
                $data['penilai'] = NULL;
                $data['pangkat'] = NULL;
                $data['unit'] = NULL;
            else:
                $data['pejabat_penilai_nip'] = $nip_pejabat_penilai;
                $data['pejabat_penilai_nama'] = $results_pejabat_penilai['rows']->peg_nm;
                $data['penilai'] = $results_pejabat_penilai['rows']->peg_jabatan;
                $data['pangkat'] = $results_pejabat_penilai['rows']->peg_gol_pangkat; 
                $data['unit'] = $results_pejabat_penilai['rows']->peg_unit;
            endif;

		
            $data['nama_kegiatan'] = $this->mskp->get_combo_kegiatan(); 
            $data['title'] = $this->mutil->get_menu_name('skp/perencanaanSkp');
            $data['jsArray'] = "var prdName = new Array();\n";
            $data['jenis_kegiatan'] = $this->mskp->get_combo_jenis_kegiatan(); 
           
            $data['jabatan'] = $this->mskp->get_combo_jabatan(); 
            $data['pejabat'] = $this->mreferensi->get_combo_kegiatan1();

            $data['action'] = site_url('skp/perencanaanSkp');
            $this->load->view("vperencanaanSkp", $data);
    }
    

    

    
    public function realisasiSkp(){
       
        $this->load->view("vrealisasiSkp");
    }
    
    
}
?>
