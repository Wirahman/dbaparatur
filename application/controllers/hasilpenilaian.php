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
class hasilpenilaian extends CI_Controller {
    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('nip')){
            redirect('login');
            return;
        }
        $this->menu = "hasilpenilaian";
        $this->title = "Hasil Penilaian";
        $this->load->model('m_penilaianskp');
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
        $this->load->library('PHPExcel');
    }
    function index(){
        $data['title'] = $this->title;
        $data['menu'] = $this->menu;
        $this->load->helper('pusdiklat');
        $currentYYYY = getCurrentYYYY();
        $data['availableYYYY'] = $this->m_penilaianskp->ambildaftartahunyangtersedia();
        
        if (isset($_POST['tahun'])):
            $tahunyangdinilaisaatini = $this->common->filter($this->input->post('tahun'));
        else:
            $tahunyangdinilaisaatini = $currentYYYY;
        endif;
        $data['tahunyangdinilaisaatini'] = $tahunyangdinilaisaatini;
        $currentnip = $this->session->userdata('nip');
        $this->load->view('vhasilpenilaian', $data);
    }
    
    
    
     public function unduhexcel(){
         
     $objPHPExcel = new PHPExcel();
       
       //array style
        $style_header = array(
            'font' => array(
             'bold' => true,
            ),
            'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            ),
            'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            
            ),
            'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
            'rotation' => 90,
            'startcolor' => array(
            'argb' => 'FFA0A0A0'
            ),
            'endcolor' => array(
            'argb' => 'FFFFFFFF'
            )
            )
 
        );
       
        // Add some data
        $objset = $objPHPExcel->setActiveSheetIndex(0); //inisiasi set object
        $objget = $objPHPExcel->getActiveSheet();  //inisiasi get object
        
        
        // Merge cells
        $objPHPExcel->getActiveSheet()->mergeCells('A9:K9');
        $objPHPExcel->getActiveSheet()->setCellValue('A9', "PENILAIAN PRESTASI KERJA");
        $objPHPExcel->getActiveSheet()->getStyle('A9:K9')->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('A9')->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle('A9:K9')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A9:K9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objPHPExcel->getActiveSheet()->mergeCells('A10:K10');
        $objPHPExcel->getActiveSheet()->setCellValue('A10', "PEGAWAI NEGERI SIPIL");
        $objPHPExcel->getActiveSheet()->getStyle('A10:K10')->getFont()->setName('Times New Roman');
        $objPHPExcel->getActiveSheet()->getStyle('A10')->getFont()->setSize(14);
        $objPHPExcel->getActiveSheet()->getStyle('A10:K10')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A10:K10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // Nomor 
        $objget->setCellValue('B16', '1.');
        $objget->getStyle('B16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('B16:B21')->applyFromArray($style_header);// set font weight 
        $objget->getColumnDimension('B')->setWidth(10); // set witdh colom
        $objget->getStyle('B16')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        
        $objget->setCellValue('B22', '2.');
        $objget->getStyle('B22')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('B22:B27')->applyFromArray($style_header);// set font weight 
        $objget->getColumnDimension('B')->setWidth(10); // set witdh colom
        $objget->getStyle('B22')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objget->setCellValue('B28', '3.');
        $objget->getStyle('B28')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('B28:B33')->applyFromArray($style_header);// set font weight 
        $objget->getColumnDimension('B')->setWidth(10); // set witdh colom
        $objget->getStyle('B28')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objget->setCellValue('B38', '4.');
        $objget->getStyle('B38')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('B38:B49')->applyFromArray($style_header);// set font weight 
        $objget->getColumnDimension('B')->setWidth(10); // set witdh colom
        $objget->getStyle('B38')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        
        
        $objget->setCellValue('C16', 'YANG DINILAI');
        $objget->getStyle('C16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C16')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(15); // set witdh colom
        $objget->getStyle('C16')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('C16:J16');      
        $objget->setCellValue('C22', 'PEJABAT PENILAI');
        $objget->getStyle('C22')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C22')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(15); // set witdh colom
        $objget->getStyle('C22')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('C22:J22');
        $objget->setCellValue('C28', 'ATASAN PEJABAT PENILAI');
        $objget->getStyle('C28')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C28')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(15); // set witdh colom
        $objget->getStyle('C28')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('C28:J28');
        $objget->setCellValue('C38', 'UNSUR YANG DINILAI');
        $objget->getStyle('C38')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C38')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(15); // set witdh colom
        $objget->getStyle('C38')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('C38:I38');
        
        $objget->setCellValue('J38', 'JUMLAH');
        $objget->getStyle('J38')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('J38')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(15); // set witdh colom
        $objget->getStyle('J38')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        
        $objget->setCellValue('J39', '53');
        $objget->getStyle('J39')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('J39')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(10); // set witdh colom
        $objget->getStyle('J39')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objPHPExcel->getActiveSheet()->mergeCells('J39:J40');
        
        $objget->setCellValue('C17', 'a.');
        $objget->getStyle('C17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C17')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(5); // set witdh colom
        $objget->getStyle('C17')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objget->setCellValue('C18', 'b.');
        $objget->getStyle('C18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C18')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(5); // set witdh colom
        $objget->getStyle('C18')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);  
        $objget->setCellValue('C19', 'c.');
        $objget->getStyle('C19')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C19')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(5); // set witdh colom
        $objget->getStyle('C19')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objget->setCellValue('C20', 'd.');
        $objget->getStyle('C20')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C20')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(5); // set witdh colom
        $objget->getStyle('C20')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objget->setCellValue('C21', 'e.');
        $objget->getStyle('C21')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C21')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(5); // set witdh colom
        $objget->getStyle('C21')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objget->setCellValue('C23', 'a.');
        $objget->getStyle('C23')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C23')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(5); // set witdh colom
        $objget->getStyle('C23')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);  
        $objget->setCellValue('C24', 'b.');
        $objget->getStyle('C24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C24')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(5); // set witdh colom
        $objget->getStyle('C24')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objget->setCellValue('C25', 'c.');
        $objget->getStyle('C25')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C25')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(5); // set witdh colom
        $objget->getStyle('C25')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objget->setCellValue('C26', 'd.');
        $objget->getStyle('C26')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C26')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(5); // set witdh colom
        $objget->getStyle('C26')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objget->setCellValue('C27', 'e.');
        $objget->getStyle('C27')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C27')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(5); // set witdh colom
        $objget->getStyle('C27')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objget->setCellValue('C29', 'a.');
        $objget->getStyle('C29')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C29')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(5); // set witdh colom
        $objget->getStyle('C29')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);  
        $objget->setCellValue('C30', 'b.');
        $objget->getStyle('C30')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C30')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(5); // set witdh colom
        $objget->getStyle('C30')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objget->setCellValue('C31', 'c.');
        $objget->getStyle('C31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C31')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(5); // set witdh colom
        $objget->getStyle('C31')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objget->setCellValue('C32', 'd.');
        $objget->getStyle('C32')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C32')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(5); // set witdh colom
        $objget->getStyle('C32')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objget->setCellValue('C33', 'e.');
        $objget->getStyle('C33')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C33')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(5); // set witdh colom
        $objget->getStyle('C33')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        
        $objget->setCellValue('C39', 'a. Sasaran Kerja Pegawai/Nilai Prestasi Akademik');
        $objget->getStyle('C39')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C39')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(10); // set witdh colom
        $objget->getStyle('C39')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objPHPExcel->getActiveSheet()->mergeCells('C39:I39');
        $objPHPExcel->getActiveSheet()->mergeCells('C39:C40');
        
        $objget->getStyle('C39')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objget->setCellValue('C41', 'b.');
        $objget->getStyle('C41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('C41')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('C')->setWidth(5); // set witdh colom
        $objget->getStyle('C41')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objPHPExcel->getActiveSheet()->mergeCells('C41:C49');


        
        $objget->setCellValue('D23', 'Nama');
        $objget->getStyle('D23')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('D23')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('D')->setWidth(20); // set witdh colom
        $objget->getStyle('D23')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('D23:F23'); 
        $objget->setCellValue('D24', 'NIP');
        $objget->getStyle('D24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('D24')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('D')->setWidth(20); // set witdh colom
        $objget->getStyle('D24')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('D24:F24');
        $objget->setCellValue('D25', 'Pangkat, Golongan Ruang, TMT');
        $objget->getStyle('D25')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('D25')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('D')->setWidth(20); // set witdh colom
        $objget->getStyle('D25')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('D25:F25'); 
        $objget->setCellValue('D26', 'Jabatan/Pekerjaan');
        $objget->getStyle('D26')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('D26')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('D')->setWidth(20); // set witdh colom
        $objget->getStyle('D26')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('D26:F26');
        $objget->setCellValue('D27', 'Unit Organisasi');
        $objget->getStyle('D27')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('D27')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('D')->setWidth(20); // set witdh colom
        $objget->getStyle('D27')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('D27:F27');
        $objget->setCellValue('D29', 'Nama');
        $objget->getStyle('D29')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('D29')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('D')->setWidth(20); // set witdh colom
        $objget->getStyle('D29')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('D29:F29'); 
        $objget->setCellValue('D30', 'NIP');
        $objget->getStyle('D30')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('D30')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('D')->setWidth(20); // set witdh colom
        $objget->getStyle('D30')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('D30:F30');
        $objget->setCellValue('D31', 'Pangkat, Golongan Ruang, TMT');
        $objget->getStyle('D31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('D31')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('D')->setWidth(20); // set witdh colom
        $objget->getStyle('D31')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('D31:F31'); 
        $objget->setCellValue('D32', 'Jabatan/Pekerjaan');
        $objget->getStyle('D32')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('D32')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('D')->setWidth(20); // set witdh colom
        $objget->getStyle('D32')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('D32:F32');
        $objget->setCellValue('D33', 'Unit Organisasi');
        $objget->getStyle('D33')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('D33')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('D')->setWidth(20); // set witdh colom
        $objget->getStyle('D33')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('D33:F33');
        $objget->setCellValue('D41', 'PRILAKU KERJA');
        $objget->getStyle('D41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('D41')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('D')->setWidth(20); // set witdh colom
        $objget->getStyle('D41')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('D41:D49');
        
        
        
        
        
        $objget->setCellValue('D17', 'Nama');
        $objget->getStyle('D17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('D17')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('D')->setWidth(10); // set witdh colom
        $objget->getStyle('D17')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('D17:F17');
        
        $objget->setCellValue('D18', 'NIP');
        $objget->getStyle('D18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('D18')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('D')->setWidth(10); // set witdh colom
        $objget->getStyle('D18')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('D18:F18');
        
        $objget->setCellValue('D19', 'Pangkat, Golongan Ruang, TMT');
        $objget->getStyle('D19')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('D19')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('D')->setWidth(10); // set witdh colom
        $objget->getStyle('D19')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('D19:F19');
        
        $objget->setCellValue('D20', 'Jabatan/Pekerjaan');
        $objget->getStyle('D20')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('D20')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('D')->setWidth(10); // set witdh colom
        $objget->getStyle('D20')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('D20:F20');
  
        $objget->setCellValue('D21', 'Unit Organisasi');
        $objget->getStyle('D21')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('D21')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('D')->setWidth(10); // set witdh colom
        $objget->getStyle('D21')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('D21:F21');
        
        
        $objget->setCellValue('E41', '1.');
        $objget->getStyle('E41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('E41')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('E')->setWidth(5); // set witdh colom
        $objget->getStyle('E41')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objget->setCellValue('E42', '2.');
        $objget->getStyle('E42')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('E42')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('E')->setWidth(5); // set witdh colom
        $objget->getStyle('E42')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objget->setCellValue('E43', '3');
        $objget->getStyle('E43')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('E43')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('E')->setWidth(5); // set witdh colom
        $objget->getStyle('E43')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objget->setCellValue('E44', '4.');
        $objget->getStyle('E44')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('E44')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('E')->setWidth(5); // set witdh colom
        $objget->getStyle('E44')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objget->setCellValue('E45', '5.');
        $objget->getStyle('E45')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('E45')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('E')->setWidth(5); // set witdh colom
        $objget->getStyle('E45')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objget->setCellValue('E46', '6.');
        $objget->getStyle('E46')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('E46')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('E')->setWidth(5); // set witdh colom
        $objget->getStyle('E46')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objget->setCellValue('E47', '7.');
        $objget->getStyle('E47')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('E47')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('E')->setWidth(5); // set witdh colom
        $objget->getStyle('E47')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objget->setCellValue('E48', '8.');
        $objget->getStyle('E48')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('E48')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('E')->setWidth(5); // set witdh colom
        $objget->getStyle('E48')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objget->setCellValue('E49', '9.');
        $objget->getStyle('E49')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('E49')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('E')->setWidth(5); // set witdh colom
        $objget->getStyle('E49')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        
        $objget->setCellValue('F41', 'Orientasi Pelayanan');
        $objget->getStyle('F41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('F41')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('F')->setWidth(10); // set witdh colom
        $objget->getStyle('F41')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('F41:G41');
        $objget->setCellValue('F42', 'Integritas');
        $objget->getStyle('F42')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('F42')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('F')->setWidth(10); // set witdh colom
        $objget->getStyle('F42')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objPHPExcel->getActiveSheet()->mergeCells('F42:G42');
        $objget->setCellValue('F43', 'Komitmen');
        $objget->getStyle('F43')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('F43')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('F')->setWidth(10); // set witdh colom
        $objget->getStyle('F43')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objPHPExcel->getActiveSheet()->mergeCells('F43:G43');
        $objget->setCellValue('F44', 'Disiplin');
        $objget->getStyle('F44')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('F44')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('F')->setWidth(10); // set witdh colom
        $objget->getStyle('F44')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objPHPExcel->getActiveSheet()->mergeCells('F44:G44');
        $objget->setCellValue('F45', 'Kerjasama');
        $objget->getStyle('F45')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('F45')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('F')->setWidth(10); // set witdh colom
        $objget->getStyle('F45')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objPHPExcel->getActiveSheet()->mergeCells('F45:G45');
        $objget->setCellValue('F46', 'Kepemimpinan');
        $objget->getStyle('F46')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('F46')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('F')->setWidth(10); // set witdh colom
        $objget->getStyle('F46')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objPHPExcel->getActiveSheet()->mergeCells('F46:G46');
        $objget->setCellValue('F47', 'Jumlah');
        $objget->getStyle('F47')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('F47')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('F')->setWidth(10); // set witdh colom
        $objget->getStyle('E47')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objPHPExcel->getActiveSheet()->mergeCells('F47:G47');
        $objget->setCellValue('F48', 'Nilai Rata-rata');
        $objget->getStyle('F48')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('F48')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('F')->setWidth(10); // set witdh colom
        $objget->getStyle('F48')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objPHPExcel->getActiveSheet()->mergeCells('F48:G48');
        $objget->setCellValue('F49', 'Nilai Perilaku Kerja');
        $objget->getStyle('F49')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('F49')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('F')->setWidth(10); // set witdh colom
        $objget->getStyle('F49')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objPHPExcel->getActiveSheet()->mergeCells('F49:G49');
        
        $objget->setCellValue('H41', '85.00');
        $objget->getStyle('H41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('H41')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('H')->setWidth(5); // set witdh colom
        $objget->getStyle('H41')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('H42', '85.00');
        $objget->getStyle('H42')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('H42')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('H')->setWidth(5); // set witdh colom
        $objget->getStyle('H42')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('H43', '85.00');
        $objget->getStyle('H43')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('H43')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('H')->setWidth(5); // set witdh colom
        $objget->getStyle('H43')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('H44', '85.00');
        $objget->getStyle('H44')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('H44')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('H')->setWidth(5); // set witdh colom
        $objget->getStyle('H44')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('H45', '85.00');
        $objget->getStyle('H45')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('H45')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('H')->setWidth(5); // set witdh colom
        $objget->getStyle('H45')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('H46', '85.00');
        $objget->getStyle('H46')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('H46')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('H')->setWidth(5); // set witdh colom
        $objget->getStyle('H46')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('H47', '85.00');
        $objget->getStyle('H47')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('H47')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('H')->setWidth(5); // set witdh colom
        $objget->getStyle('H47')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('H48', '85.00');
        $objget->getStyle('H48')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('H48')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('H')->setWidth(5); // set witdh colom
        $objget->getStyle('H48')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('H49', '85.00');
        $objget->getStyle('H49')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('H49')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('H')->setWidth(5); // set witdh colom
        $objget->getStyle('H49')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        
        $objget->setCellValue('I41', '');
        $objget->getStyle('I41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('I41')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('I')->setWidth(5); // set witdh colom
        $objget->getStyle('I41')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('I42', '');
        $objget->getStyle('I42')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('I42')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('I')->setWidth(5); // set witdh colom
        $objget->getStyle('I42')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('I43', '');
        $objget->getStyle('I43')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('I43')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('I')->setWidth(5); // set witdh colom
        $objget->getStyle('I43')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('I44', '');
        $objget->getStyle('I44')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('I44')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('I')->setWidth(5); // set witdh colom
        $objget->getStyle('I44')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('I45', '');
        $objget->getStyle('I45')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('I45')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('I')->setWidth(5); // set witdh colom
        $objget->getStyle('I45')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('I46', '');
        $objget->getStyle('I46')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('I46')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('I')->setWidth(5); // set witdh colom
        $objget->getStyle('I46')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('I47', '');
        $objget->getStyle('I47')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('I47')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('I')->setWidth(5); // set witdh colom
        $objget->getStyle('I47')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('I48', '');
        $objget->getStyle('I48')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('I48')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('I')->setWidth(5); // set witdh colom
        $objget->getStyle('I48')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('I49', 'X 40%');
        $objget->getStyle('I49')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('I49')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('I')->setWidth(5); // set witdh colom
        $objget->getStyle('I49')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        
        $objget->setCellValue('J41', '');
        $objget->getStyle('J41')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('J41')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('J')->setWidth(10); // set witdh colom
        $objget->getStyle('J41')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('J42', '');
        $objget->getStyle('J42')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('J42')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('J')->setWidth(10); // set witdh colom
        $objget->getStyle('J42')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('J43', '');
        $objget->getStyle('J43')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('J43')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('J')->setWidth(10); // set witdh colom
        $objget->getStyle('J43')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('J44', '');
        $objget->getStyle('J44')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('J44')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('J')->setWidth(10); // set witdh colom
        $objget->getStyle('J44')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('J45', '');
        $objget->getStyle('J45')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('J45')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('J')->setWidth(10); // set witdh colom
        $objget->getStyle('J45')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('J46', '');
        $objget->getStyle('J46')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('J46')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('J')->setWidth(10); // set witdh colom
        $objget->getStyle('J46')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('J47', '');
        $objget->getStyle('J47')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('J47')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('J')->setWidth(10); // set witdh colom
        $objget->getStyle('J47')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('J48', '');
        $objget->getStyle('J48')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('J48')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('J')->setWidth(10); // set witdh colom
        $objget->getStyle('J48')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        $objget->setCellValue('J49', '34.00');
        $objget->getStyle('J49')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('J49')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('J')->setWidth(10); // set witdh colom
        $objget->getStyle('J49')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);

        
        
        $objget->setCellValue('G17', '');
        $objget->getStyle('G17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('G17')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('G')->setWidth(10); // set witdh colom
        $objget->getStyle('G17')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('G17:J17');  
        $objget->setCellValue('G18', '');
        $objget->getStyle('G18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('G18')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('G')->setWidth(10); // set witdh colom
        $objget->getStyle('G18')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('G18:J18');
        $objget->setCellValue('G19', '');
        $objget->getStyle('G19')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('G19')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('G')->setWidth(10); // set witdh colom
        $objget->getStyle('G19')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('G19:J19');
        $objget->setCellValue('G20', '');
        $objget->getStyle('G20')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('G20')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('G')->setWidth(10); // set witdh colom
        $objget->getStyle('G20')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('G20:J20');
        $objget->setCellValue('G21', '');
        $objget->getStyle('G21')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('G21')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('G')->setWidth(10); // set witdh colom
        $objget->getStyle('G21')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('G21:J21');  
        $objget->setCellValue('G23', '');
        $objget->getStyle('G23')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('G23')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('G')->setWidth(10); // set witdh colom
        $objget->getStyle('G23')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('G23:J23');  
        $objget->setCellValue('G24', '');
        $objget->getStyle('G24')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('G24')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('G')->setWidth(10); // set witdh colom
        $objget->getStyle('G24')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('G24:J24');
        $objget->setCellValue('G25', '');
        $objget->getStyle('G25')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('G25')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('G')->setWidth(10); // set witdh colom
        $objget->getStyle('G25')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('G25:J25');
        $objget->setCellValue('G26', '');
        $objget->getStyle('G26')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('G26')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('G')->setWidth(10); // set witdh colom
        $objget->getStyle('G26')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('G26:J26');
        $objget->setCellValue('G27', '');
        $objget->getStyle('G27')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('G27')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('G')->setWidth(10); // set witdh colom
        $objget->getStyle('G27')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('G27:J27');
        $objget->setCellValue('G29', '');
        $objget->getStyle('G29')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('G29')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('G')->setWidth(10); // set witdh colom
        $objget->getStyle('G29')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('G29:J29');  
        $objget->setCellValue('G30', '');
        $objget->getStyle('G30')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('G30')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('G')->setWidth(10); // set witdh colom
        $objget->getStyle('G30')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('G30:J30');
        $objget->setCellValue('G31', '');
        $objget->getStyle('G31')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('G31')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('G')->setWidth(10); // set witdh colom
        $objget->getStyle('G31')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('G31:J31');
        $objget->setCellValue('G32', '');
        $objget->getStyle('G32')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('G32')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('G')->setWidth(10); // set witdh colom
        $objget->getStyle('G32')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('G32:J32');
        $objget->setCellValue('G33', '');
        $objget->getStyle('G33')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('G33')->applyFromArray($style_header );// set font weight  
        $objget->getColumnDimension('G')->setWidth(10); // set witdh colom
        $objget->getStyle('G33')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT); 
        $objPHPExcel->getActiveSheet()->mergeCells('G33:J33');
        
        $objget->setCellValue('B50', 'NILAI PRESTASI KERJA');
        $objget->getStyle('B50')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('B50')->applyFromArray($style_header);// set font weight 
        $objget->getColumnDimension('B')->setWidth(10); // set witdh colom
        $objget->getStyle('B50')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objPHPExcel->getActiveSheet()->mergeCells('B50:I50');
        $objPHPExcel->getActiveSheet()->mergeCells('B50:B53');
        
        $objget->setCellValue('J51', '87.86 (BAIK)');
        $objget->getStyle('J51')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('J50:J53')->applyFromArray($style_header);// set font weight 
        $objget->getColumnDimension('J')->setWidth(10); // set witdh colom
        $objget->getStyle('J51')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_00);
        
        $objget->setCellValue('B55','5.');
        $objget->setCellValue('C55','KEBERATAN DARI PEGAWAI NEGERI SIPIL');
        $objget->setCellValue('C56','YANG DINILAI (APABILA ADA)');
        $objget->setCellValue('F60','Tanggal, .......');
        $objget->getStyle('B54')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('B54:J61')->applyFromArray($style_header);// set font weight 
        $objget->getColumnDimension('B')->setWidth(10); // set witdh colom
        $objget->getStyle('B54')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        
        $objget->setCellValue('B69','6');
        $objget->setCellValue('C69','TANGGAPAN PEJABAT PENILAI');
        $objget->setCellValue('C70','ATAS KEBERATAN )');
        $objget->setCellValue('I78','Tanggal, .......');
        $objget->getStyle('B69')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('B69:J81')->applyFromArray($style_header);// set font weight 
        $objget->getColumnDimension('B')->setWidth(10); // set witdh colom
        $objget->getStyle('B69')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        
        $objget->setCellValue('B83','7.');
        $objget->setCellValue('C83','KEPUTUSAN ATASAN PEJABAT');
        $objget->setCellValue('C84','PENILAI ATAS KEBERATAN )');
        $objget->setCellValue('I89','Tanggal, .......');
        $objget->getStyle('B82')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('B82:J92')->applyFromArray($style_header);// set font weight 
        $objget->getColumnDimension('B')->setWidth(10); // set witdh colom
        $objget->getStyle('B82')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        
        $objget->setCellValue('B101','8.');
        $objget->setCellValue('C101','REKOMENDASI');
        $objget->setCellValue('I110','Tanggal, .......');
        $objget->getStyle('B100')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('B100:J113')->applyFromArray($style_header);// set font weight 
        $objget->getColumnDimension('B')->setWidth(10); // set witdh colom
        $objget->getStyle('B100')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        
        $objget->setCellValue('G116','9. DIBUAT TANGGAL, .........');
        $objget->setCellValue('G117','PEJABAT PENILAI');
        $objget->setCellValue('G122','Dra. Indriyati, MM');
        $objget->setCellValue('G123','195710231984032001');
        $objget->setCellValue('B124','10. DITERIMA TANGGAL, .........');
        $objget->setCellValue('C125','PEGAWAI NEGERI SIPIL YANG');
        $objget->setCellValue('D126','DINILAI');
        $objget->setCellValue('D130','Drs Zulkifli., M.Si');
        $objget->setCellValue('D131','196802291994031001');
        $objget->setCellValue('G133','10. DITERIMA TANGGAL, …………………');
        $objget->setCellValue('G134','ATASAN PEJABAT YANG MENILAI');
        $objget->setCellValue('G138','Mochamad Teguh Pamudji, SH, MH');
        $objget->setCellValue('G139','195711121980031000');
        $objget->getStyle('B114')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objget->getStyle('B114:J140')->applyFromArray($style_header);// set font weight 
        $objget->getColumnDimension('B')->setWidth(10); // set witdh colom
        $objget->getStyle('G123')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objget->getStyle('D131')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objget->getStyle('G139')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

        
        
        
        
        
        
        $sharedStyle1 = new PHPExcel_Style();
        $sharedStyle2 = new PHPExcel_Style();

        $sharedStyle1->applyFromArray(
         array('borders' => array(
         'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
         'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
         'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
         'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
         ),
         ));
        
         $sharedStyle2->applyFromArray(
         array('borders' => array(
         'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
         'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
         'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
         'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
         ),
         ));
        
        
       //Merge cell
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "B53:I53"); 
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "B50:B53");
        
        
         
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "C16:J16");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "C22:J22");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "C28:J28");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "C38:I38");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "C39:I39");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "C40:I40");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "C39:C40");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "C41:C49");
        
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "F41:G41");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "F42:G42");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "F43:G43");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "F44:G44");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "F45:G45");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "F46:G46");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "F47:G47");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "F48:G48");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "F49:G49");
        
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "J38");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "J39");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "J39:J40");
           
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "D17:F17");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "D18:F18");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "D19:F19");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "D20:F20");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "D23:F23");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "D24:F24");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "D25:F25");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "D26:F26");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "D27:F27");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "D29:F29");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "D30:F30");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "D31:F31");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "D32:F32");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "D33:F33");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "D41:D49");
        
        
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "D21:F21");
        
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "G17:J17");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "G18:J18");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "G19:J19");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "G20:J20");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "G21:J21");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "G23:J23");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "G24:J24");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "G25:J25");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "G26:J26");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "G27:J27");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "G29:J29");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "G30:J30");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "G31:J31");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "G32:J32");
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "G33:J33");
        
        
        
        // Rename sheet
        $objPHPExcel->getActiveSheet()->setTitle('Simple'); 
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        
        
        
        
        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="DataPenilaianSKP.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        
    }
}
