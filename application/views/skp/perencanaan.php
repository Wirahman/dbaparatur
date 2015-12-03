<?php $this->load->view('vheader'); ?>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery_form.js"></script>
    <script src="<?=base_url()?>assets/liscroll/jquery.li-scroller.1.0.js"></script>

    <script type="text/javascript">
        $(document).ready(function() { 
              $("#nama_kegiatan").select2();
              $("#nama_jabatan").select2();
              $("#pejabat_penilai").select2();
              $("#pejabat").select2();
              $("#satuan_waktu").select2();
		});
	</script>

	<div class="widget-header"><h5> <i class="icon-book"></i> PERENCANAAN SKP</h5></div>
	<div class="widget-body">
		<span id="form_error" style="color:red;"></span>
		<div class="row">
			<div class="col-xs-12">
				<div class="table-header" align="center">  
					FORMULIR SASARAN KERJA PEGAWAI NEGERI SIPIL       
				</div>

				<div class="table-responsive">     
					<table id="perencanaanskp"  class="table table-striped table-bordered table-hover">
						<thead>
						<tr>
							<th class="center" width="5%">NO</th>
							<th class="center" colspan="2" width="40%">PEJABAT PENILAI</th>
							<th class="center" width="5%">NO</th>
							<th class="center" colspan="6">PEGAWAI NEGERI SIPIL YANG DINILAI</th>
						</tr>
						</thead>       
						<tr>
							<td align="center"> 1</td>
							<td align="left" width="15%">Nama</td>
							<th align="left"><?php  echo $nama_atasan; ?></th>    
							<td align="center">1</td>
							<td align="left" width="15%" >Nama</td> 
							<th colspan="5" align="left">&nbsp;&nbsp; <?php  echo $nama; ?></th>   
						</tr>
						<tr>
							<td align="center">2</td>
							<td align="left" width="15%">NIP</td>
							<th align="center"><?php  echo $nip_atasan; ?></th>    
							<td align="center">2</td>
							<td align="left" width="15%">NIP</td> 
							<td colspan="5" align="left" ><b>&nbsp;&nbsp;&nbsp;<?= $nip ?></b></td>  
						</tr>
						<tr>
							<td align="center">3</td>
							<td align="left" width="15%">Pangkat/Gol.Ruang</td>
							<th align="left"><?php  echo $pangkat_atasan; ?></th>    
							<td align="center">3</td>
							<td align="left" width="15%">Pangkat/Gol.Ruang</td> 
							<th colspan="5" align="left">&nbsp;&nbsp; <?php  echo $pangkat; ?></th>  
						</tr>
						<tr>
							<td align="center">4</td>
							<td align="left" width="15%">Jabatan</td>
							<th align="left">   
								<?php  echo $jabatan_atasan; ?>
							</th>    
							<td align="center">4</td>
							<td align="left" width="15%">Jabatan</td> 
							<th colspan="5" align="left">        
							   &nbsp;&nbsp;
							   <?php echo $jabatan;?>
							</th>
						</tr>
						<tr>
							<td align="center">5</td>
							<td align="left" width="15%">Unit Kerja</td>
							<th align="left"><?php  echo $unit_kerja_atasan; ?></th>    
							<td align="center">5</td>
							<td align="left" width="15%">Unit Kerja</td> 
							<th colspan="5" align="left">&nbsp;&nbsp; <?php  echo $unit_kerja; ?></th>   
						</tr>
					</table>
                </div>

                <div class="widget-header"><h5> <i class="icon-folder-open-alt"></i> INPUT SKP</h5></div>  
				<div class="table-responsive"> 
					<table id="perencanaanskp"  class="table table-striped table-bordered table-hover">
						<tr>
							<td class="center bolder" rowspan="2">KEGIATAN TUGAS JABATAN</td>
							<td class="center bolder" rowspan="2">AK</td>
							<td class="center bolder" colspan="6">TARGET</td>
							<td class="center bolder" rowspan="2">Action</td>
						</tr>
						<tr>          
							<td colspan="2" class="center bolder">Kuant/Output</td>
							<td class="center bolder">Kual/Mutu</td>
							<td colspan="2" class="center bolder">Waktu</td>
							<td align="left" class="center bolder">Biaya</td> 
						</tr>
						<tbody id="planning">
						<?php echo $skp;?>
						</tbody>
						<tbody id="add" class='<?php echo $hide = ($status == 0) ? "" : "hide";?>'>
						<form id="formAdd">
						<input type="hidden" id="id_prestasi_kerja" value="<?php echo $id_prestasi_kerja;?>"/>
						<tr>   
							<td>
								<div class="col-sm-6">
									<select id="kegiatan_tugas_jabatan" name ="kegiatan_tugas_jabatan" style="width: 300px;">
										<option value='' selected='selected'> -- Pilih Kegiatan -- </option>
										<?php 
											$jsArray = "var satuan = [];\n";
											foreach($kegiatan_tugas_jabatan as $opt){
												echo "<option value='".$opt->id."'> ".$opt->kegiatan." </option>";
												$jsArray .= "satuan['" . $opt->id. "'] = '" . addslashes($opt->satuan_kuantitas) . "';\n";											
											}
										?> 
									</select>
								</div>
								<div  align='center' style=" margin-top: 5px; margin-right: -160px;"> 
									<a href="#tambahkegiatan"  data-toggle="modal">
									   <i class="icon-plus"></i>
									</a>
								</div>
							</td>
							<td>
								<input name="target_angka_kredit" type="text" id="target_angka_kredit" size="5"  autocomplete="off"/>
							</td>
							<td>
								<input type="text" id="target_kuantitas"  name="target_kuantitas" size="5" autocomplete="off"/>
							</td>
							<td>
								<input type="text" id="satuan_kuantitas"  name="satuan_kuantitas" size="5" readonly autocomplete="off"/>
							</td>
							<td>
								<input name="target_kualitas" type="text" id="target_kualitas" size="5" autocomplete="off"/>
							</td>
							<td>
								<input name="target_waktu" type="text" id="target_waktu" size="5" autocomplete="off"/>
							</td>
							<td>
								<select id="satuan_waktu" name ="satuan_waktu"> 
									<option value='Bulan' selected='selected'>Bulan</option>
									<option value='Minggu'>Minggu</option>
									<option value='Hari'>Hari</option>
								 </select>    
							</td>
							<td>
								<input name="target_biaya" type="text" id="target_biaya" size="10" autocomplete="off"/>
							</td>
							<td>
								<div>
									<button class="btn btn-primary btn-sm padding-20" rel="tooltip" btn-success" name ="kirim" id="kirim" rel="tooltip">
										<i class="icon-plus"></i>
									</button>
								</div>
							</td>
						</tr>
						</form>
						</tbody>
					</table>
					<div style="margin-left: 25px; margin-bottom:10px;">
						<button id="LaporkanRealisasi" class="btn btn-primary btn-sm padding-20 <?php echo $hide = ($status == 0) ? '' : 'hide';?>" rel="tooltip" title="Laporkan Realisasi" data-placement="bottom">
							<i class="icon-file"></i>Laporkan Perencanaan SKP
						</button>
					</div>
				</div>
			</div>
        </div>
	</div>
	<br/>
	    
	<?php
		$pesan = $this->session->flashdata('message');
		if (!empty($pesan)) {
    ?>

    <div class="alert alert-success">
        <button class="close" data-dismiss="alert" type="button">
            <i class="icon-remove"></i>
        </button>
        <center>
		<strong>
                <?php echo $this->session->flashdata('message'); ?>
        </strong>
        <br>
		</center>
    </div>

    <?php
		}
    ?>
   
	<div class="alert alert-block alert-warning <?php echo (strlen($pk->koreksi) == 0 || $pk->status > 0) ? 'hide' : '';?>">
		<button type="button" class="close" data-dismiss="alert">
			<i class="icon-remove"></i>
		</button>
		<p>
			<strong>
				<i class="icon-info-sign"></i>
			</strong>
			<?php echo " [" . date_format(date_create($pk->tanggal_koreksi),"d/m/Y H:i:s") . "] " . $pk->koreksi;?>
		</p>
	</div>
	<div class="alert alert-block alert-success hide">
		<button type="button" class="close" data-dismiss="alert">
			<i class="icon-remove"></i>
		</button>
		<p>
			<strong>
				<i class="icon-ok"></i>
			</strong>
			&nbsp;
		</p>
	</div>
	<div class="alert alert-block alert-info hide">
		<button type="button" class="close" data-dismiss="alert">
			<i class="icon-remove"></i>
		</button>

		<p>
			<strong>
				<i class="icon-spin icon-spinner"></i>
			</strong>
			&nbsp;Silahkan tunggu! Permintaan anda sedang diproses.
		</p>
	</div>
	<div class="alert alert-block alert-danger hide">
		<button type="button" class="close" data-dismiss="alert">
			<i class="icon-remove"></i>
		</button>
		<p>
			<strong>
				<i class="icon-remove"></i>
			</strong>
			&nbsp;
		</p>
	</div>

	<br/>
	<br/>
	<div class="space-10"></div>
	<div id="tambahkegiatan" class="modal fade tambahkegiatan" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="blue bigger">Tugas Kegiatan</h4>
				</div>
				<div class="modal-body row">
					<div class="form-group col-sm-14">
						<!--<form action="<?= site_url() ?>/referensi/simpanterminal" method="post" id="form" name="form" enctype="multipart/form-data" onSubmit="return validasi(this)">-->
						<div class="widget-header"><h5><i class="icon-edit"></i>Tambah Kegiatan </h5></div>
						<div class="widget-body">
							<div class="form-horizontal" role="form">
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
									<div class="col-sm-3">
										<span id="form_error" style="color:red;"></span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Jabatan </label>
									<div class="col-xs-12 col-sm-5">
										<span class="block input-icon input-icon-right">
											<input type="hidden" id="id_jabatan" name="id_jabatan" class="width-80-uppercase" readonly="readonly" value="<?php echo $id_jabatan; ?>"/>
											<input type="text" id="" name="" size="27" readonly="readonly" value="<?php echo $jabatan; ?>"/>
											<i id="nama_remove_sign" class="icon-remove-sign hidden"></i>
										</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Kegiatan</label>
									<div class="col-sm-8">
										<input  type="text" size="30" rel="tooltip" title="Nama Kegiatan"   id="kegiatan" placeholder="Nama Kegiatan"  /> <span style="font-size:12px; color:red;">*</span> <br>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Satuan Kuantitas </label>
									<div class="col-sm-8">
										<input  type="text" size="30" id="satuan_kuantitas1" name="satuan_kuantitas1"  rel="tooltip" maxlength="11" title="Satuan Kuantitas" onkeyup="return satuan_kuantitas();" placeholder="Satuan Kuantitas"  id="satuan_kuantitas"  />   
										<span style="font-size:12px; color:red;">*</span>  <br>
									</div>
								</div>	
							</div>
						</div>

						<div class="modal-footer">
							<button class="btn btn-sm btn-primary" rel="tooltip" title="Tambah" id="simpan"> <i class="icon-plus"></i>Tambah</button>
							<button class="btn btn-sm btn-danger" rel="tooltip" title="Batal" data-dismiss="modal">
								<i class="icon-remove"></i>Batal
							</button>
						</div>
						<!-- <div class="modal-footer"> -->
						<!--</form> -->
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->load->view('vfooter'); ?>
<script src="<?= base_url() ?>/assets/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/js/jquery.dataTables.bootstrap.js"></script>
<script type="text/javascript">
	$("#tambahkegiatan").on("show", function() { // wire up the OK button to dismiss the modal when shown
		$("#tambahkegiatan a.btn").on("click", function(e) {
			console.log("button pressed"); // just as an example...
			$("#tambahkegiatan").modal('hide'); // dismiss the dialog
		});
	});
</script>
                
<script type="text/javascript">
	
	$(document).ready(function(){
		// Pilih jenis kegiatan
		$("#kegiatan_tugas_jabatan").on('change',function() {
			<?php echo $jsArray;?>
			$("#satuan_kuantitas").val(satuan[this.value]);
		});
		
		// Tambah kegiatan tugas jabatan
		$("#simpan").click(function(){  
			var kegiatan=$("#kegiatan").val();
			var id_jabatan=$("#id_jabatan").val();
			var satuan_kuantitas=$("#satuan_kuantitas1").val();
		 
			var dataString = 'kegiatan='+kegiatan + '&id_jabatan=' + id_jabatan  + '&satuan_kuantitas='+ satuan_kuantitas;
			if(kegiatan=='' || id_jabatan=='' || satuan_kuantitas=='') {
				alert("Data harus diisi dengan lengkap");
			} else {
				blockUI();
				$.ajax({
					type: "POST",
					url:siteUrl+'/kegiatan_tugas_jabatan/create',
					data: dataString,
					cache: false,
					success: function(result){
						unblockUI();
						$("#tambahkegiatan").modal('hide'); // dismiss the dialog
						location.reload();
						clearAll();
					}
				});
			}
			return false;
		});
		
		$('#delete .btn-danger').click(function(){
			var error = $('.alert-danger');
			var success = $('.alert-success');
			var info = $('.alert-info');
			
			success.html('<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><p><strong><i class="icon-ok"></i></strong>&nbsp;Penghapusan kegiatan tugas jabatan berhasil.</p>');
			success.addClass('hide');
			error.html('<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><p><strong><i class="icon-remove"></i></strong>&nbsp;Penghapusan kegiatan tugas jabatan gagal.</p>');
			error.addClass('hide');
			info.removeClass('hide');

			$.ajax({
				type        : 'POST',
				url         : siteUrl+ '/skp/delete_kegiatan_tugas_jabatan/' + this.value, 
				data        : {
								'id_prestasi_kerja' : $("#id_prestasi_kerja").val(),
							},
				dataType    : 'json',
				success		: function(data) {
								info.addClass('hide');
								error.addClass('hide');
								success.removeClass('hide');
								$("#planning").html(data['html']);	
							},
				error		: function() {
								info.addClass('hide');
								error.removeClass('hide');
								success.addClass('hide');		
							}
			});
			return false;
		});
		
		// Tambah item SKP
		$("#formAdd").submit(function() {
			var error = $('.alert-danger');
			var success = $('.alert-success');
			var info = $('.alert-info');
			
			success.html('<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><p><strong><i class="icon-ok"></i></strong>&nbsp;Penambahan kegiatan tugas jabatan berhasil.</p>');
			success.addClass('hide');
			error.html('<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><p><strong><i class="icon-remove"></i></strong>&nbsp;Penambahan kegiatan tugas jabatan gagal.</p>');
			error.addClass('hide');
			info.removeClass('hide');

			$.ajax({
				type        : 'POST',
				url         : siteUrl+ '/skp/add_kegiatan_tugas_jabatan', 
				data        : {
								'id_prestasi_kerja' : $("#id_prestasi_kerja").val(),
								'kegiatan_tugas_jabatan' : $("#kegiatan_tugas_jabatan").val(),
								'target_angka_kredit' : $("#target_angka_kredit").val(),
								'target_kuantitas' : $("#target_kuantitas").val(),
								'satuan_kuantitas' : $("#satuan_kuantitas").val(),
								'target_kualitas' : $("#target_kualitas").val(),
								'target_waktu' : $("#target_waktu").val(),
								'satuan_waktu' : $("#satuan_waktu").val(),
								'target_biaya' : $("#target_biaya").val(),
							},
				dataType    : 'json',
				success		: function(data) {
								info.addClass('hide');
								error.addClass('hide');
								success.removeClass('hide');
								$("#planning").html(data['html']);								
							},
				error		: function() {
								info.addClass('hide');
								error.removeClass('hide');
								success.addClass('hide');		
							}
			});
			return false;
		});
		
		$("#LaporkanRealisasi").click(function(){
			var error = $('.alert-danger');
			var success = $('.alert-success');
			var info = $('.alert-info');
			var warning = $('.alert-warning');
			
			success.html('<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><p><strong><i class="icon-ok"></i></strong>&nbsp;Pelaporan kegiatan tugas jabatan berhasil.</p>');
			success.addClass('hide');
			error.html('<button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><p><strong><i class="icon-remove"></i></strong>&nbsp;Pelaporan kegiatan tugas jabatan gagal.</p>');
			error.addClass('hide');
			info.removeClass('hide');
			warning.removeClass('hide');

			$.ajax({
				type        : 'POST',
				url         : siteUrl+ '/skp/update_status', 
				data        : {
								'id_prestasi_kerja' : $("#id_prestasi_kerja").val(),
								'status' : '1'
							},
				dataType    : 'json',
				success		: function(data) {
								info.addClass('hide');
								error.addClass('hide');
								success.removeClass('hide');
								$("#planning").html(data['html']);
								$("#add").addClass('hide');
								$("#LaporkanRealisasi").addClass('hide');	
							},
				error		: function() {
								info.addClass('hide');
								error.removeClass('hide');
								success.addClass('hide');		
							}
			});
			return false;
		});
	});   
</script> 
