<?php $this->load->view('vheader'); ?>
<script src="<?=base_url()?>assets/Highcharts-3.0.7/js/highcharts.js"></script>
<script src="<?=base_url()?>assets/Highcharts-3.0.7/js/highcharts-more.js"></script>
<script src="<?=base_url()?>assets/Highcharts-3.0.7/js/drilldown.js"></script>
<script src="<?=base_url()?>assets/Highcharts-3.0.7/js/data.js"></script>
<script src="<?=base_url()?>assets/liscroll/jquery.li-scroller.1.0.js"></script>
<link rel="stylesheet" href="<?= base_url();?>assets/liscroll/li-scroller.css" />


<div class="widget-header"><h5> <i class="icon-user"></i> REALISASI SKP</h5></div>
<div class="widget-body">
<span id="form_error" style="color:red;"></span>

<div class="row">
  <div class="col-xs-12">
  
        <div class="table-header" align="center">  
               PENILAIAN CAPAIAN SASARAN KERJA PEGAWAI NEGERI SIPIL       
	</div>
 
        <div class="table-responsive">
	<table id=""  class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="center" rowspan="2">NO</th>
                <th class="left" rowspan="2">KEGIATAN TUGAS JABATAN</th>
                <th class="center">AK</th>
                <th class="center" colspan="4">TARGET</th>
                <th class="center">AK</th>
                <th class="center" colspan="4">REALISASI</th>
                <th class="center" rowspan="2">PENGHITUNGAN</th>
                <th class="center" rowspan="2">NILAI CAPAIAN SKP</th>
            </tr>
            </thead>
            <tbody> 
            <tr>
                <td align="center"></td>
                <td align="left"></td>
                <td align="center"></td>    
                <td align="center">Kuant/ Output</td>
                <td align="center">Kual/Mutu</td>
                <td align="center">Waktu</td>
                <td align="left">Biaya</td> 
                <td align="center"></td> 
                <td align="center">Kuant/ Output</td>
                <td align="center">Kual/Mutu</td>
                <td align="center">Waktu</td>
                <td align="left" >Biaya</td>
                <td align="center"></td>
                <td align="center"></td> 
            </tr>
            </tbody>
   
	</table>
        
	</div>
	</div>
	</div>
</div>     

<br>
<br>
<div class="row">
   <div class="col-sm-12">

   </div>


<script type="text/javascript">
    /*
   function pindah(url)
   {
   window.location = url;
   }*/
</script>
<?php $this->load->view('vfooter'); ?>

