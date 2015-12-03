<?php $this->load->helper('pusdiklat');?>
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
      Hasil Penilaian Prestasi Kerja Tahun <?=$tahun?>    
</div>

<div class="table-responsive overflow-auto">     
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
			<td align="left" ><b><?php echo $unit_kerja ;?></b></td>  
		</tr>
		<tr>
			<td align="right">Pangkat/Gol.Ruang</td>
			<td align="center">:</td>
			<th align="left"><?php echo $pangkat;?></th>    
			<td align="right" width="15%">Pejabat Penilai</td> 
			<td align="center">:</td>
			<th align="left"><?php echo $nama_pejabat_penilai;?></th>  
		</tr>
	</table>
</div>

 <div class="panel" align="right" valign="center">
	<span>Pilih Tahun SKP&nbsp;&nbsp;</span>
	<select id="tahun" name="tahun" class="select2style">
		<?php for($t=2000;$t<= date("Y")+1;$t++) {
			$selected = ($t == $tahun) ? "selected" : "";
			echo '<option value="'. $t . '"' . $selected. '>' . $t . '</option>';
		}
		?>
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
						$i = 1;
						foreach($skp as $item) {
					?> 
					<tr class="record">
						<td align="center">
							<a href="#"><?php  echo $i; ?> </a>
						</td>
						<td><?php echo $item->awal_penilaian;?></td> 
						<td><?php echo $item->akhir_penilaian;?></td>
						<td><?php echo $item->nama_pejabat_penilai;?> </td>  
						<td><?php echo $item->nama_atasan_pejabat_penilai;?></td> 
						<td><?php echo $item->nilai_prestasi_kerja;?></td> 
						<td><?php echo keterangan_nilai($item->nilai_prestasi_kerja);?></td> 
						<td><?php echo $item->status;?></td> 
						<td>
							<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
								<button id="detailpenilaian" value="<?php echo $item->id;?>" class="btn btn-primary btn-xs padding-20" rel="tooltip" title="Lihat Detail Penilaian" data-placement="bottom">
									<i class="icon-eye-open"></i>Detail
								</button>
								<button id="unduh_pdf" value="<?php echo $item->id;?>" class="btn btn-primary btn-xs padding-20" rel="tooltip" title="Unduh ke Dalam Format PDF" data-placement="bottom">
									<i class="icon-download-alt"></i>PDF
								 </button>
							</div>
						</td>
					</tr>
					<?php 
						$i++; 
						}
					?> 
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
	jQuery(document).on('change','#tahun', function(e){
       window.location.href=siteUrl+'/skp/penilaian_bawahan/<?php echo $nip?>/' + this.value; 
    });
    jQuery(document).on('click','#detailpenilaian', function(e){
       window.location.href=siteUrl+'/skp/detail_penilaian_bawahan/' + this.value; 
    });	
	jQuery(document).on('click','#unduh_pdf', function(e){
       window.open(siteUrl+'/skp/unduh_pdf/'+ this.value); 
    });
</script>

<?php $this->load->view('vfooter'); ?>