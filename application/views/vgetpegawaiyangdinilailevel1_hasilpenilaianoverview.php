<?php $this->load->view('vheader'); ?>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery_form.js"></script>
    <script src="<?=base_url()?>assets/liscroll/jquery.li-scroller.1.0.js"></script>
    <link rel="stylesheet" href="<?= base_url(); ?>assets/liscroll/li-scroller.css" />
<style>
    .ace-file-input {
        margin-bottom: 0;
    }
    .panel-default {
        border-color: transparent;
    }
</style>


<div class="table-header" align="center">  
      Hasil Penilaian Prestasi Kerja Tahun     
</div>

<div class="table-responsive overflow-auto"  >     
<table id="penilaiskp " class="table table-bordered">     
<tr>
        <td align="right">Nama Pegawai</td>
        <td align="center">:</td>
        <th align="left"><?php echo $nama ;?></th>    
        <td align="right">Jabatan</td> 
        <td align="center">:</td>
        <th align="left"><?php echo $jabatan ;?></th>   
</tr>

    <tr>
        <td align="right">NIP</td>
        <td align="center">:</td>
        <th align="center"><?php echo $nip ;?></th>    
        <td align="right">Unit Kerja</td> 
        <td align="center">:</td>
        <td align="left" ><b><?php echo $unit_organisasi ;?></b></td>  
    </tr>
    <tr>
        <td align="right">Pangkat/Gol.Ruang</td>
        <td align="center">:</td>
        <th align="left"><?php echo $pangkat_peg ;?></th>    
        <td align="right" width="15%">Pejabat Penilai</td> 
        <td align="center">:</td>
        <th align="left"><?php echo $pejabat_penilai_nama ?></th>  
    </tr>
</table>
</div>

 <div class="panel">
                        <select name="tahun" class="select2style">
                          
                                <option value="<?php echo $tahun; ?>"><?php echo $tahun?></option>
                            
                        </select>
 </div>

<div class="row">
  <div class="col-xs-12">
	<div class="table-responsive overflow-auto">
	<table id="penilaiaanSkp" class="table table-striped table-bordered table-hover">
	<thead>
            <tr>
                <th class="nomor">No</th>
                <th class="name">Awal Penilaian</th>
                <th class="name">Akhir Penilaian</th>
                <th class="name">Pejabat Penilai</th>
                <th class="name">Atasan Pejabat Penilai</th>
                <th class="name">Nilai</th>
                <th class="name">Keterangan</th>
                <th class="name">Status</th>
                <th> Aksi </th>
            </tr>
	</thead>

	<tbody>
	<?php
	$i=1; 
	?> 
        <tr class="record">
	<td align="center">
            <a href="#"><?php  echo $i; ?> </a>
	</td>
        <td>01 Januari 2015</td> 
        <td>30 Mei 2015</td>
        <td><?php echo ucfirst($pejabat_penilai_nama);?> </td>  
        <td>Djati walujastono</td> 
        <td>95</td> 
        <td>SANGAT BAIK </td> 
        <td>Perencanaan</td> 
	<td>
	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
           <button id="detailpenilaian" class="btn btn-primary btn-xs padding-20" rel="tooltip" title="Lihat Detail Penilaian" data-placement="bottom">
                                            <i class="icon-eye-open"></i>
                                            Detail Penilaian
           </button>
             <button id="unduh_excel" class="btn btn-primary btn-xs padding-20" rel="tooltip" title="Unduh ke Dalam Format Excel" data-placement="bottom">
                                            <i class="icon-download-alt"></i>
                                             Excel
             </button>
	</div>
	</td>
	</tr>
        <?php $i++; ?> 
	</tbody>
	</table>
	</div>
	</div>
	</div>


<script>
    jQuery(document).on('click','#detailpenilaian', function(e){
       window.location.href=siteUrl+'/pegawaiyangdinilai/detail_penilaian'; 
    });
</script>

<?php $this->load->view('vfooter'); ?>