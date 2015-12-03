<?php $this->load->view('vheader'); ?>
<script src="<?= base_url() ?>assets/Highcharts-3.0.7/js/highcharts.js"></script>
<script src="<?= base_url() ?>assets/Highcharts-3.0.7/js/highcharts-more.js"></script>
<script src="<?= base_url() ?>assets/Highcharts-3.0.7/js/drilldown.js"></script>
<script src="<?= base_url() ?>assets/Highcharts-3.0.7/js/data.js"></script>
<script src="<?= base_url() ?>assets/liscroll/jquery.li-scroller.1.0.js"></script>
<link rel="stylesheet" href="<?= base_url(); ?>assets/liscroll/li-scroller.css" />
<style>
    .ace-file-input {
        margin-bottom: 0;
    }
    .panel-default {
        border-color: transparent;
    }
</style>
<div class="widget-header"><h5> <i class="icon-user"></i> REALISASI SKP</h5></div>
<div class="widget-body">
    <span id="form_error" style="color:red;"></span>

    <div class="row">
        <div class="col-xs-12">

            <div class="table-header" align="center">  
                PELAPORAN REALISASI SASARAN KERJA PEGAWAI NEGERI SIPIL       
            </div>

            <div class="table-responsive overflow-auto">
                <table id="realisasitable"  class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="center" rowspan="2">NO</th>
                            <th class="left" rowspan="2">I. KEGIATAN TUGAS JABATAN</th>
                            <th class="center" rowspan="2">AK</th>
                            <th class="center" colspan="6">TARGET</th>
                            <th class="center" rowspan="2">AK</th>
                            <th class="center" colspan="6">REALISASI</th>
                            <th class="center" rowspan="2">PENGHITUNGAN</th>
                            <th class="center" rowspan="2">NILAI CAPAIAN SKP</th>
                            <th class="center" rowspan="2">AKSI</th>
                        </tr>
                        <tr>
                            <td align="center" colspan="2">Kuant /Output</td>
                            <td align="center">Kual /Mutu</td>
                            <td align="center" colspan="2">Waktu</td>
                            <td align="left">Biaya</td> 
                            <td align="center" colspan="2">Kuant / Output</td>
                            <td align="center">Kual /Mutu</td>
                            <td align="center" colspan="2">Waktu</td>
                            <td align="left" >Biaya</td>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                            $number = 0;
                            foreach($tugas_jabatan as $ktj):
                        ?>
                        <tr>
                            <td align="center"><?php echo ++$number.".";?></td>
                            <td align="left">
                                <?php echo $ktj->kegiatan; ?>
                            </td>
                            <td align="center">
                                <?php echo $ktj->target_angka_kredit; ?>
                            </td>    
                            <td align="center">
                                <?php echo $ktj->target_kuantitas; ?>
                            </td>
                            <td align="center">
                                <?php echo $ktj->satuan_kuantitas; ?>
                            </td>
                            <td align="center">
                                <?php echo $ktj->target_kualitas; ?>
                            </td>
                            <td align="left">
                                <?php echo $ktj->target_waktu; ?>
                            </td> 
                            <td align="center">
                                <?php echo $ktj->satuan_waktu; ?>
                            </td> 
                            <td align="center">
                                <?php echo number_format($ktj->target_biaya,0,",","."); ?>
                            </td> 
                            <td align="center">
                                <?php if(isset($ktj->realisasi_angka_kredit)): echo $ktj->realisasi_angka_kredit; else: echo '-'; endif; ?>
                            </td>
                            <td align="center">
								<a class="green edit_data" data-toggle="modal" data-target="#realisasi_<?php echo $ktj->id;?>" data-id="<?php echo $ktj->id;?>"  rel="tooltip">
								<?php if(isset($ktj->realisasi_kuantitas)): echo $ktj->realisasi_kuantitas; else: echo '-'; endif; ?>
								</a>
							</td>
                            <td align="center">
                                <?php echo $ktj->satuan_kuantitas; ?>
                            </td>
                            <td align="left" >
                                <?php if(isset($ktj->realisasi_kualitas)): echo $ktj->realisasi_kualitas; else: echo '-'; endif; ?>
                            </td>
                            <td align="center">
                                <?php if(isset($ktj->realisasi_waktu)): echo $ktj->realisasi_waktu; else: echo '-'; endif; ?>
                            </td>
                            <td align="center">
                                <?php echo $ktj->satuan_waktu; ?>
                            </td> 
                            <td align="center">
                                <?php if(isset($ktj->realisasi_biaya)): echo number_format($ktj->realisasi_biaya,0,",","."); else: echo '-'; endif; ?>
                            </td> 
                            
                            <td align="center">
                                <?php if(isset($ktj->penghitungan)): echo $ktj->penghitungan; else: echo '0'; endif; ?>
                            </td> 
                            <td align="center">
                                <?php if(isset($ktj->nilai_capaian_skp)): echo $ktj->nilai_capaian_skp; else: echo '0'; endif; ?>
                            </td>
                            <td align="center">
                                <?php 
                                if(isset($ktj->kegiatan)):
									$jsArray = isset($jsArray) ?  $jsArray . "tugas_jabatan['$ktj->id'] = '$ktj->kegiatan';\n" : "var tugas_jabatan = [];\ntugas_jabatan['$ktj->id'] = '$ktj->kegiatan';\n";
								?>
                                    <button id="LaporkanRealisasi" value="<?php echo $ktj->id;?>" class="btn btn-primary btn-xs padding-20 <?php echo ($status == 2) ? '' : 'hide';?>" rel="tooltip" title="Laporkan Realisasi" data-placement="bottom" data-satuanwaktu="<?php echo $ktj->satuan_waktu; ?>">
                                        <i class="icon-plus"></i>
                                    </button>
                                <?php
                                endif;
                                ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td align="center"></td>
                            <td align="left" class="bolder">
                                II. TUGAS TAMBAHAN DAN KREATIVITAS :
                            </td>
                            <td align="center"></td>    
                            <td align="center"></td>
                            <td align="center"></td>
                            <td align="center"></td>
                            <td align="left"></td> 
                            <td align="center"></td> 
                            <td align="center"></td> 
                            
                            <td align="center"></td>
                            <td align="center"></td>
                            <td align="center"></td>
                            <td align="left" ></td>
                            <td align="center"></td>
                            <td align="center"></td> 
                            <td align="center"></td> 
                            
                            <td align="center"></td> 
                            <td align="center"></td> 
                            <td align="center"></td> 
                        </tr>
                        <!--tugas tambahan-->
                        <?php
                            $i=1;
                            foreach($tugas_tambahan as $tt):
                        ?>
                        <tr>
                            <td align="center"><?php echo $i == 1 ? '1.' : '';?></td>
                            <td align="left">
                                <?php echo $tt->kegiatan; ?>
                            </td>
                            <td align="center">
                            </td>    
                            <td align="center">
                            </td>
                            <td align="center">
                            </td>
                            <td align="center">
                            </td>
                            <td align="left">
                            </td> 
                            <td align="center">
                            </td> 
                            <td align="center">
                            </td>                             
                            <td align="center">
                            </td>
                            <td align="center">
								<a title="Download Dokumen" class="dokumen_ttk green edit_data" data-id="<?php echo $tt->id;?>" rel="tooltip">1</a>
							</td>
                            <td align="center">
                            </td>
                            <td align="left" >
                            </td>
                            <td align="center">
                            </td>
                            <td align="center">
                            </td> 
                            <td align="center">
                            </td>                             
                            <td align="center">
                            </td> 
                            <td align="center">
                            </td>
                            <td align="center">
								<button value="<?php echo $tt->id;?>" class="delete_ttk btn btn-danger btn-xs padding-20 <?php echo ($status == 2) ? '' : 'hide';?>" rel="tooltip" title="Hapus Tugas Tambahan/Kreatifitas" data-placement="bottom">
									<i class="icon-remove"></i>
                                </button>							
                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
						<!--kreatifitas-->
                        <?php
                            $i=2;
                            foreach($kreatifitas as $kr):
                        ?>
                        <tr>
                            <td align="center"><?php echo $i == 2 ? '2.' : '';?></td>
                            <td align="left">
                                <?php echo $kr->kegiatan; ?>
                            </td>
                            <td align="center">
                            </td>    
                            <td align="center">
                            </td>
                            <td align="center">
                            </td>
                            <td align="center">
                            </td>
                            <td align="left">
                            </td> 
                            <td align="center">
                            </td> 
                            <td align="center">
                            </td>                             
                            <td align="center">
                            </td>
                            <td align="center">
								<a title="Download Dokumen" class="dokumen_ttk green edit_data" data-id="<?php echo $kr->id;?>" rel="tooltip">1</a>
							</td>
                            <td align="center">
                            </td>
                            <td align="left" >
                            </td>
                            <td align="center">
                            </td>
                            <td align="center">
                            </td> 
                            <td align="center">
                            </td>                             
                            <td align="center">
                            </td> 
                            <td align="center">
                            </td>
                            <td align="center">
								<button value="<?php echo $kr->id;?>" class="delete_ttk btn btn-danger btn-xs padding-20 <?php echo ($status == 2) ? '' : 'hide';?>" rel="tooltip" title="Hapus Tugas Tambahan/Kreatifitas" data-placement="bottom">
									<i class="icon-remove"></i>
                                </button>							
	
                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                    </tbody>
                </table>

            </div>
            <div class="panel panel-default col-sm-12 width-100">
                <div class="panel-body">
                    <hr>
                    <button id="LaporTugasTambahan" class="btn btn-primary btn-sm padding-20 <?php echo ($status == 2) ? '' : 'hide';?>" rel="tooltip" title="Lapor Tugas Tambahan" data-placement="bottom">
                        <i class="icon-plus"></i>
                        Laporkan Tugas Tambahan
                    </button>
                    <button id="selesai" value="<?php echo $id_tugas_jabatan;?>" class="btn btn-primary btn-sm padding-20 <?php echo ($status == 2) ? '' : 'hide';?>" rel="tooltip" title="Selsai dan Laporkan SKP" data-placement="bottom">
                        <i class="icon-check-sign"></i>
                        Selesai dan Laporkan SKP
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>     
<br/>
<div class="alert alert-block alert-danger <?php echo isset($error) ? '' : 'hide';?>">
	<button type="button" class="close" data-dismiss="alert">
		<i class="icon-remove"></i>
	</button>
	<p>
		<strong>
			<i class="icon-remove"></i>
		</strong>
		&nbsp;<?php echo isset($error) ? $error : '';?>
	</p>
</div>
<?php
if($this->session->flashdata('message')) echo $this->session->flashdata('message');
?>
<div class = "modal fade" id = "ModalLaporkanRealisasi" role = "dialog">
    <div class = "modal-dialog">
        <div class="widget-main">
            <form id="FormLaporRealisasi" method="post" enctype="multipart/form-data">
                <div class = "modal-content">
                    <div class = "modal-header">
                        <h3>Form Pelaporan Realisasi</h3>
                    </div>
                    <div class = "modal-body row">
                        <div id="select_kegiatan_form_group" class="form-group col-sm-12">
                            <label class="col-xs-12 col-sm-5 col-md-4 control-label no-padding-right">Kegiatan Tugas Jabatan</label>
                            <div class="col-xs-12 col-sm-7">
                                <span class="block input-icon input-icon-right">
									<input type="hidden" id="id_kegiatan_tugas_jabatan" name="id_kegiatan_tugas_jabatan"/>
                                    <input type="text" id="kegiatan_tugas_jabatan" name="kegiatan_tugas_jabatan" class="width-80-uppercase" readonly value=""/>
                                    <span id="laporrealisasi_satuanwaktu"></span>
                                    <i id="kuantitas_remove_sign" class="icon-remove-sign hidden"></i>
                                </span>
                            </div>
                        </div>
                        <div id="kuantitas_form_group" class="form-group col-sm-12">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label no-padding-right">Kuantitas</label>
                            <div class="col-xs-12 col-sm-8">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" id="kuantitas" name="kuantitas" class="width-80-uppercase" value=""/>
                                    <span id="laporrealisasi_satuanwaktu"></span>
                                    <i id="kuantitas_remove_sign" class="icon-remove-sign hidden"></i>
                                </span>
                            </div>
                        </div>
                        <div id="dokumen_form_group" class="form-group col-sm-12">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label no-padding-right">Dokumen</label>
                            <div class="col-xs-12 col-sm-6">
                                <span class="block input-icon input-icon-right">
                                    <input type="file" name="inputfilerealisasi" id="inputfilerealisasi" />
                                    <div id="progress_bar" class="progress progress-mini progress-striped active hidden">
                                        <div id="bar_graph" class="progress-bar progress-success" style="width: 0%;"></div>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div id="biaya_form_group" class="form-group col-sm-12">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label no-padding-right">Biaya</label>
                            <div class="col-xs-12 col-sm-8">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" id="biaya" name="biaya" class="width-80-uppercase" value=""/>
                                    <i id="biaya_remove_sign" class="icon-remove-sign hidden"></i>
                                </span>
                            </div>
                        </div>
                        <div id="AK_form_group" class="form-group col-sm-12">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label no-padding-right">AK</label>
                            <div class="col-xs-12 col-sm-8">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" id="ak" name="ak" class="width-80-uppercase" value=""/>
                                    <i id="AK_remove_sign" class="icon-remove-sign hidden"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- modal body -->
                    <div class = "modal-footer">
                        <button id="submitRealisasi" class="btn btn-primary btn-sm" type="submit" name="submit">
							<i class='icon-ok'></i>&nbsp;Laporkan
						</button>
						<button class="btn btn-danger btn-sm" data-dismiss = "modal">
							<i class='icon-remove'></i>&nbsp;Tutup
						</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class = "modal fade" id = "ModalLaporTugasTambahan" role = "dialog">
    <div class = "modal-dialog">
        <div class="widget-main">
            <form id="FormLaporTugasTambahan" method="post" enctype="multipart/form-data">
                <div class = "modal-content">
                    <div class = "modal-header">
                        <h3>Lapor Tugas Tambahan</h3>
                    </div>
                    <div class = "modal-body row">
                        <div id="select_kegiatan_form_group" class="form-group col-sm-12">
                            <label class="col-xs-12 col-sm-5 col-md-4 control-label no-padding-right">Kegiatan Tugas Jabatan</label>
                            <div class="col-xs-12 col-sm-7">
                                <input name="jenis_kegiatan" type="radio" value="2" checked="checked">Tugas Tambahan
                                <input name="jenis_kegiatan" type="radio" value="3">Kreatifitas
                            </div>
                        </div>
                        <div id="deskripsikegiatan_form_group" class="form-group col-sm-12">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label no-padding-right">Deskripsi Kegiatan</label>
                            <div class="col-xs-12 col-sm-8">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" id="kegiatan" name="kegiatan" class="width-80-uppercase" value=""/>
                                </span>
                            </div>
                        </div>
                        <div id="dokumen_form_group" class="form-group col-sm-12">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label no-padding-right">Dokumen</label>
                            <div class="col-xs-12 col-sm-6">
                                <span class="block input-icon input-icon-right">
                                    <input type="file" name="inputfilerealisasitambahan" id="inputfilerealisasitambahan" />
                                    <div id="progress_bar" class="progress progress-mini progress-striped active hidden">
                                        <div id="bar_graph" class="progress-bar progress-success" style="width: 0%;"></div>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div><!-- modal body -->
                    <div class = "modal-footer">
                        <button id="btnLaporTambahan" name="btnLaporTambahan" class="btn btn-primary btn-sm" type="submit" name="submit">
							<i class='icon-ok'></i>&nbsp;Laporkan
						</button>
						<button class="btn btn-danger btn-sm" data-dismiss = "modal">
							<i class='icon-remove'></i>&nbsp;Tutup
						</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class = "modal fade" id = "ModalTetapkanRealisasi" role = "dialog">
    <div class = "modal-dialog">
        <div class="widget-main">
            <form id="FormLaporRealisasi" method="post" action="#" enctype="multipart/form-data">
                <div class = "modal-content">
                    <div class = "modal-header">
                        <h3>Form Pelaporan Realisasi</h3>
                    </div>
                    <div class = "modal-body row">
                        <div id="kualmutu_form_group" class="form-group">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label no-padding-right">Kual/Mutu</label>
                            <div class="col-xs-12 col-sm-8">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" id="kualmutu" name="kualmutu" class="width-80-uppercase" value=""/>
                                    <i id="kualmutu_remove_sign" class="icon-remove-sign hidden"></i>
                                    <span id="satuanwaktu"></span>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div id="waktu_form_group" class="form-group">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label no-padding-right">Waktu</label>
                            <div class="col-xs-12 col-sm-8">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" id="waktu" name="waktu" class="width-80-uppercase" value=""/>
                                    <i id="waktu_remove_sign" class="icon-remove-sign hidden"></i>
                                </span>
                            </div>
                        </div>
                        <br>
                    </div><!-- modal body -->
                    <div class = "modal-footer">
                        <button id="btnLapor" class="btn btn-primary" type="submit" name="submit">&nbsp;Tetapkan</button>
                        <a class = "btn btn-primary" data-dismiss = "modal">Tutup</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
	<?php foreach ($tugas_jabatan as $tj) : ?>
	<div id="realisasi_<?php echo $tj->id;?>" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="blue bigger">Realisasi SKP</h4>
				</div>
				<div class="modal-body row">
					<div class="form-group col-sm-14">
						<div class="widget-header"><h5><i class="icon-edit"></i>Kegiatan: <?php echo $tj->kegiatan;?></h5></div>
						<div class="table-responsive">
							<table id="referensiKegiatan" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th class="center">No</th>
										<th class="center">Kuantitas</th>
										<th class="center">Biaya</th>
										<th class="center">AK</th>
										<th class="center">Aksi</i></th>
									</tr>
								</thead>
								<tbody>
								<?php
									$i=1; 
									foreach($realisasi[$tj->id] as $item)
									{
								?> 
									<tr class="record">
										<td class="center"><a href="#"><?php  echo $i;?></a></td>
										<td><?php echo $item->kuantitas;?> </td> 
										<td align="right"><?php echo number_format($item->biaya,0,",",".");?> </td> 
										<td><?php echo $item->ak;?> </td>
										<td class="center">
											<button id="dokumen" title="Download Dokumen" class="dokumen btn btn-purple btn-xs" value="<?php echo $item->dokumen;?>">
											<i class="icon-download-alt"></i>
											</button>
											<button id="delete" title="Hapus Realisasi" class="delete btn btn-danger btn-xs <?php echo ($status == 2) ? '' : 'hide';?>" value="<?php echo $item->id;?>">
											<i class="icon-remove"></i>
											</button>
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
			</div>           
		</div>   
	</div>
	<?php endforeach; ?>
<script type="text/javascript">
	$(document).ready(function(){
		// Pilih jenis kegiatan		
		$('#selesai').click(function(){
			bootbox.confirm('<p>Apa anda yakin telah menyelesaikan pelaporan SKP anda? <br> Perubahan tidak akan bisa dilakukan sampai Pejabat Penilai telah melakukan evaluasi pada SKP yang anda laporkan. </span>', 
			function (confirm){
				if (confirm === false){
					bootbox.hideAll();
					return;
				} else {
					$.ajax({
						type        : 'POST',
						url         : siteUrl+ '/skp/laporkan_realisasi/' + $('#selesai').val(), 
						data        : {
									},
						dataType    : 'json',
						success		: function(data) {
										window.location = siteUrl + '/skp/realisasi';
									},
						error		: function() {
										window.location = siteUrl + '/skp/realisasi';
									}
					});
					return;
				}
			});
		});
	});
	// Download dokumen
	$(".dokumen").click(function(){
		window.open(siteUrl+ '/skp/download_dokumen/' +  this.value,'_blank');
		return false;
	});
	
	// Download dokumen TTK
	$(".dokumen_ttk").click(function(){
		window.open(siteUrl+ '/skp/download_dokumen_ttk/' + $(this).data("id"),'_blank');
		return false;
	});	
	
	// Hapus Realisasi
	$(".delete").click(function(){
		var id = this.value;
		bootbox.confirm('<p>Apakah anda yakin akan menghapus realisasi SKP ini?', 
			function (confirm){
				if (confirm === false){
					bootbox.hideAll();
					return;
				} else {
					$.ajax({
						type        : 'POST',
						url         : siteUrl+ '/skp/delete_realisasi/' + id, 
						data        : {
									},
						dataType    : 'json',
						success		: function(data) {
										window.location = siteUrl + '/skp/realisasi';
									},
						error		: function() {
										window.location = siteUrl + '/skp/realisasi';
									}
					});
					return;
				}
			});
	});

	// Hapus Realisasi
	$(".delete_ttk").click(function(){
		var id = this.value;
		bootbox.confirm('<p>Apakah anda yakin akan menghapus tugas tambahan/kreatifitas ini?', 
			function (confirm){
				if (confirm === false){
					bootbox.hideAll();
					return;
				} else {
					$.ajax({
						type        : 'POST',
						url         : siteUrl+ '/skp/delete_ttk/' + id, 
						data        : {
									},
						dataType    : 'json',
						success		: function(data) {
										window.location = siteUrl + '/skp/realisasi';
									},
						error		: function() {
									}
					});
					return;
				}
			});
	});

    $(document).on("click", "#LaporkanRealisasi", function(e) {
		<?php echo $jsArray;?>
		$('#id_kegiatan_tugas_jabatan').val(this.value);
		$('#kegiatan_tugas_jabatan').val(tugas_jabatan[this.value]);
        $('#ModalLaporkanRealisasi').modal({backdrop: 'static', keyboard: false});
        $('#ModalLaporkanRealisasi').modal('show');
    });
    $(document).on("click", "#LaporTugasTambahan", function(e) {
        $('#ModalLaporTugasTambahan').modal({backdrop: 'static', keyboard: false});
        $('#ModalLaporTugasTambahan').modal('show');
    });
    $(document).on("click", ".tetapkan", function(e) {
        //var satuanwaktu = $(this).attr("satuanwaktu");
        var _self = $(this);
        var satuanwaktu = _self.data('satuanwaktu');
        $("#satuanwaktu").html(satuanwaktu);
        $('#ModalTetapkanRealisasi').modal({backdrop: 'static', keyboard: false});
        $('#ModalTetapkanRealisasi').modal('show');
    });
	
    jQuery(function($) {
        $('#inputfilerealisasi, #inputfilerealisasitambahan').ace_file_input({
            no_file: 'Tidak ada file yang dipilih...',
            btn_choose: 'Pilih',
            btn_change: 'Ubah',
            droppable: false,
            thumbnail: false //| true | large
            //whitelist:'gif|png|jpg|jpeg'
            //blacklist:'exe|php|html|js|sh|bat|'
        }).on('change', function() {
            var filename = $('#inputfilerealisasi, #inputfilerealisasitambahan').val();
            var ekstensi = filename.substring(filename.lastIndexOf('.') + 1).toLowerCase();
            switch (ekstensi) {
                case 'png':
                case 'jpg':
                case 'jpeg':
                case 'gif':
                case 'xls' :
                case 'xlsx' :
                case 'doc' :
                case 'docx' :
                case 'ppt' :
                case 'pptx' :
                case 'odf' :
                case 'odt' :
                case 'ods' :
                case 'odp' :
				case 'pdf' :
				case 'zip' :
				case 'rar' :
				case 'tar' :
				case 'gz' :
                    return false;
                default:
					return false;
                    var file_input = $('#inputfilerealisasi, #inputfilerealisasitambahan');
                    file_input.ace_file_input('reset_input');
                    bootbox.alert("File berekstensi tersebut tidak diperkenankan");
            };
        });
        //#inputfilerealisasitambahan
    });
</script>
<?php $this->load->view('vfooter'); ?>

