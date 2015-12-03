<?php $this->load->helper('pusdiklat');?>
<?php $this->load->view('vheader'); ?>
<style>
    .panel-default {
        border-color: transparent;
    }
</style>

<div class="widget-header"><h5> <i class="icon-certificate"></i>Hasil Penilaian Prestasi Kerja Tahun <?php echo $pk->tahun . " (SKP ke-" . $pk->penilaian_ke . ")"; ?></h5></div>
<div class="widget-body">
    <span id="form_error" style="color:red;"></span>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default col-sm-12 width-100">
                <div class="panel-body">
                    <div class="tabbable">
                        <ul class="nav nav-tabs padding-12 tab-color-green background-green" id="tabdetail">
                            <li class="active">
                                <a data-toggle="tab" href="#prestasikerja">Prestasi Kerja</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#sasarankerjapns">Sasaran Kerja PNS (SKP)</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#perilakukerja">Perilaku Kerja</a>
                            </li>
                        </ul>

                        <div class="tab-content" style="min-height: 250px;">
                            <div id="prestasikerja" class="tab-pane in active">
                                <div class="table-responsive overflow-auto">

                                    <table id="realisasitable" class="table table-bordered table-striped table-hover">
                                        <tbody>
                                            <tr class="align-center">
                                                <td>No.</td>
                                                <td>Unsur yang Dinilai</td>
                                                <td>Nilai</td>
                                                <td>Bobot</td>
                                                <td>Jumlah</td>
                                            </tr>
                                            <tr>
                                                <td>1.</td>
                                                <td>Sasaran Kerja PNS (SKP)</td>
                                                <td class="align-center"><?php echo ($pk->rata_capaian_skp) ? $pk->rata_capaian_skp : "-";?></td>
                                                <td class="align-center">60%</td>
                                                <td class="align-center"><?php echo ($pk->nilai_capaian_skp) ? number_format(0.6 * $pk->nilai_capaian_skp,2,",","") : "-";?></td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Perilaku Kerja</td>
                                                <td class="align-center"><?php echo $pk->rata_perilaku_kerja ? $pk->rata_perilaku_kerja : "-";?></td>
                                                <td class="align-center">40%</td>
                                                <td class="align-center"><?php echo $pk->nilai_perilaku_kerja ? number_format($pk->nilai_perilaku_kerja,2,",",".") : "-";?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td class="align-center">
                                                    <?php 														
														$nilai_prestasi_kerja =  ($pk->nilai_capaian_skp && $pk->nilai_perilaku_kerja) ? number_format($pk->nilai_capaian_skp + $pk->nilai_perilaku_kerja,2,",",".") : "-";
														echo $nilai_prestasi_kerja;	
													?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td class="align-center">
												<?php echo keterangan_nilai($nilai_prestasi_kerja);?>												
												</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
								<?php if($pk->status >= 4) { ?>
                                <div class="well" style="min-height: 125px;">
                                    <h4 class="green small lighter">Keberatan</h4>
                                    <?php echo $pk->keberatan;?>&nbsp;&nbsp;&nbsp;
									<hr>
                                    Tanggal: <?php echo $pk->tanggal_keberatan == NULL ? '' : date_format(date_create($pk->tanggal_keberatan),"d/m/Y H:i:s");?>                                
								</div>
                                <div class="well" style="min-height: 125;">
                                    <h4 class="green small lighter">Tanggapan Pejabat Penilai</h4>
                                    <?php echo $pk->tanggapan;?>
	                                 <hr>
                                    Tanggal: <?php echo $pk->tanggal_tanggapan == NULL ? '' : date_format(date_create($pk->tanggal_tanggapan),"d/m/Y H:i:s");?>
								</div>
                                <div class="well" style="min-height: 125px;">
                                    <h4 class="green small lighter">Keputusan Atasan Pejabat Penilai</h4>
                                    <?php echo $pk->keputusan;?>&nbsp;
									<button id="keputusan" class="btn btn-primary btn-sm <?php echo ($pk->status == 4 && $pk->keberatan != NULL  && strlen($pk->keberatan) > 0) ? '' : 'hide';?>" rel="tooltip" title="Tetapkan Keputusan" data-placement="bottom">
                                        <i class="icon-ok"></i>
										Tetapkan Keputusan
                                    </button>
                                    <hr>
                                    Tanggal: <?php echo $pk->tanggal_keputusan == NULL ? '' : date_format(date_create($pk->tanggal_keputusan),"d/m/Y H:i:s");?>
                                </div>                     
                                <div class="well" style="min-height: 125px;">
                                    <h4 class="green small lighter">Rekomendasi</h4>
                                    <?php echo $pk->rekomendasi;?>&nbsp;&nbsp;&nbsp;
                                    <hr>
                                    Tanggal: <?php echo $pk->tanggal_rekomendasi == NULL ? '' : date_format(date_create($pk->tanggal_rekomendasi),"d/m/Y H:i:s");?>
                                </div>
                                <h5 class='<?php echo $pk->tanggal_dibuat_penilai == NULL ? 'hide' : '';?>'>Dibuat oleh Pejabat Penilai pada tanggal <?php echo date_format(date_create($pk->tanggal_dibuat_penilai),"d/m/Y H:i:s");?></h5>
                                <h5 class='<?php echo $pk->tanggal_diterima_yang_dinilai == NULL ? 'hide' : '';?>'>Diterima oleh Pegawain yang diniai pada tanggal <?php echo date_format(date_create($pk->tanggal_diterima_yang_dinilai),"d/m/Y H:i:s");?></h5>
                                <h5 class="<?php echo $pk->tanggal_diterima_atasan_penilai == NULL ? 'hide' : '';?>">Diterima oleh Atasan Pejabat Penilai pada tanggal <?php echo date_format(date_create($pk->tanggal_diterima_atasan_penilai),"d/m/Y H:i:s");?></h5>
								<?php } ?>
								<br/>
                            </div>
                            <!-- end tab -->
                      
                            <div id="sasarankerjapns" class="tab-pane in">
                                <div class="table-responsive overflow-auto">
                                    <table id="realisasitable"  class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="center" rowspan="2">NO</th>
                                                <th class="align-center" rowspan="2">I. KEGIATAN TUGAS JABATAN</th>
                                                <th class="center" rowspan="2">AK</th>
                                                <th class="center" colspan="6">TARGET</th>
                                                <th class="center" rowspan="2">AK</th>
                                                <th class="center" colspan="6">REALISASI</th>
                                                <th class="center" rowspan="2">JUMLAH</th>
                                                <th class="center" rowspan="2">NILAI CAPAIAN SKP</th>
												<th class="center" rowspan="2">Aksi</th>
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
													if(isset($ktj->kegiatan))
														$jsArray = isset($jsArray) ?  $jsArray . "tugas_jabatan['$ktj->id'] = '$ktj->kegiatan';\n" : "var tugas_jabatan = [];\ntugas_jabatan['$ktj->id'] = '$ktj->kegiatan';\n";								
													if($pk->status == 3):
													?>
														<button id="penilaianKualitas" value="<?php echo $ktj->id;?>" class="penilaianKualitas btn btn-primary btn-xs padding-20" rel="tooltip" title="Isi penilaian kualitas/mutu" data-placement="bottom">
															<i class="icon-pencil"></i>
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
													<?php if(isset($tt->nilai_capaian_skp)): echo $tt->nilai_capaian_skp; else: echo '0'; endif; ?>
												</td>
												<td align="center">      
													<?php 
													if(isset($tt->kegiatan)) :
														$jsArrayTTK = isset($jsArrayTTK) ?  $jsArrayTTK . "ttk['$tt->id'] = '$tt->kegiatan';\n" : "var ttk = [];\nttk['$tt->id'] = '$tt->kegiatan';\n";								
													endif;
													if($pk->status == 3):
													?>
														<button id="penilaianTugasTambahan" value="<?php echo $tt->id;?>" class="penilaianTugasTambahan btn btn-primary btn-xs padding-20" rel="tooltip" title="Isi penilaian tugas tambahan/kreatifitas" data-placement="bottom">
															<i class="icon-pencil"></i>
														</button>
													<?php
													endif;
													?>
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
													<?php if(isset($kr->nilai_capaian_skp)): echo $kr->nilai_capaian_skp; else: echo '0'; endif; ?>
												</td>
												<td align="center">
													<?php 
													if(isset($kr->kegiatan)) :
														$jsArrayTTK = isset($jsArrayTTK) ?  $jsArrayTTK . "ttk['$kr->id'] = '$kr->kegiatan';\n" : "var ttk = [];\nttk['$kr->id'] = '$kr->kegiatan';\n";								
													endif;
													if($pk->status == 3):
													?>
														<button id="penilaianTugasTambahan" value="<?php echo $kr->id;?>" class="penilaianTugasTambahan btn btn-primary btn-xs padding-20" rel="tooltip" title="Isi penilaian tugas tambahan/kreatifitas" data-placement="bottom">
															<i class="icon-pencil"></i>
														</button>
													<?php
													endif;
													?>												
												</td>
											</tr>
											<?php $i++; endforeach; ?>
											<tr class="bolder">
												<td align="right" colspan="17">
													Nilai Capaian SKP
												</td>
												<td align="center">
													<?php if (isset($pk->rata_capaian_skp)): echo number_format($pk->rata_capaian_skp,2,",",".");else: echo '0';endif; ?>
												</td>    
											</tr>
										</tbody>
									</table>
									<?php  if($pk->status == 1){?>
									 <div class="align-left">
										<button id="setuju" class="btn btn-primary btn-sm" rel="tooltip" title="Setuju" data-placement="bottom">
											<i class="icon-ok"></i>
											Setuju
										</button>
										<button id="koreksi" class="btn btn-danger btn-sm" rel="tooltip" title="Koreksi" data-placement="bottom">
											<i class="icon-edit"></i>
											Koreksi
										</button>
									</div> 
									<?php }?>
								</div>
							</div>
                            <!-- end tab -->
                            <div id="perilakukerja" class="tab-pane in">
                                <div class="table-responsive overflow-auto">
                                    <table id="realisasitable" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Unsur yang dinilai</th>
                                                <th class="align-center">Nilai</th>
                                                <th class="align-center">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Orientasi Pelayanan</td>
                                                <td class="align-center"><?php echo number_format($pk->nilai_orientasi_pelayanan,2,",",".");?></td>
                                                <td class="align-center"><?php echo keterangan_nilai($pk->nilai_orientasi_pelayanan);?></td>
                                            </tr>
                                            <tr>
                                                <td>Integritas</td>
                                                <td class="align-center"><?php echo number_format($pk->nilai_integritas,2,",",".");?></td>
                                                <td class="align-center"><?php echo keterangan_nilai($pk->nilai_integritas);?></td>
                                            </tr>
                                            <tr>
                                                <td>Komitmen</td>
                                                <td class="align-center"><?php echo number_format($pk->nilai_komitmen,2,",",".");?></td>
                                                <td class="align-center"><?php echo keterangan_nilai($pk->nilai_komitmen);?></td>
                                            </tr>
                                            <tr>
                                                <td>Disiplin</td>
                                                <td class="align-center"><?php echo number_format($pk->nilai_disiplin,2,",",".");?></td>
                                                <td class="align-center"><?php echo keterangan_nilai($pk->nilai_disiplin);?></td>
                                            </tr>
                                            <tr>
                                                <td>Kerjasama</td>
                                                <td class="align-center"><?php echo number_format($pk->nilai_kerjasama,2,",",".");?></td>
                                                <td class="align-center"><?php echo keterangan_nilai($pk->nilai_kerjasama);?></td>
                                            </tr>
                                            <tr>
                                                <td>Kepemimpinan</td>
                                                <td class="align-center"><?php echo number_format($pk->nilai_kepemimpinan,2,",",".");?></td>
                                                <td class="align-center"><?php echo keterangan_nilai($pk->nilai_kepemimpinan);?></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="align-right">Jumlah</td>
                                                <td class="align-center"><?php if (isset($pk->jumlah_perilaku_kerja)): echo $pk->jumlah_perilaku_kerja; else: echo "0"; endif; ?></td>
                                                <td class="align-center"></td>
                                            </tr>
                                            <tr>
                                                <td class="align-right">Nilai rata-rata</td>
                                                <td class="align-center"><?php if (isset($pk->rata_perilaku_kerja)): echo $pk->rata_perilaku_kerja; else: echo "0"; endif; ?></td>
                                                <td class="align-center"><?php echo keterangan_nilai($pk->rata_perilaku_kerja);?></td>
                                            </tr>
                                            <tr>
                                                <td class="align-right">Bobot</td>
                                                <td class="align-center">40%</td>
                                                <td class="align-center"></td>
                                            </tr>
                                            <tr>
                                                <td class="align-right">Nilai Perilaku Kerja</td>
                                                <td class="align-center"><?php if (isset($pk->nilai_perilaku_kerja)): echo $pk->nilai_perilaku_kerja; else: echo "0"; endif; ?></td>
                                                <td class="align-center"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	                                
    <div class = "modal fade" id = "ModalKeputusan" role = "dialog">
        <div class = "modal-dialog">
            <div class="widget-main">
                <form id="FormKeputusan" method="post">
                    <div class = "modal-content">
                        <div class = "modal-header">
                            <h3>Keputusan</h3>
                        </div>
                        <div class = "modal-body row">
                            <textarea id="input_keputusan" name="input_keputusan" style="width: 100%; min-height: 250px;" class="overflow-auto" placeholder="..."></textarea>
						</div><!-- modal body -->
                        <div class = "modal-footer">
                            <button id="submitKeputusan" class="btn btn-primary btn-sm" rel="tooltip" title="Tetapkan Keputusan" data-placement="bottom">
                                <i class="icon-ok"></i>
                                Tetapkan Keputusan
                            </button>
							<button class="btn btn-sm btn-danger" rel="tooltip" title="Batal" data-dismiss="modal">
								<i class="icon-remove"></i>
								Batal
							</button>
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
										<th class="center">Dokumen</i></th>
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
											<button id="dokumen" class="dokumen btn btn-purple btn-xs" value="<?php echo $item->dokumen;?>">
											<i class="icon-download-alt"></i>
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
			// Submit Keputusan Atasan Pejabat Penilai
			$("#submitKeputusan").click(function(){
				$.ajax({
					type        : 'POST',
					url         : siteUrl+ '/skp/submit_keputusan/<?php echo $pk->id;?>', 
					data        : {
									'input_keputusan' : $("#input_keputusan").val(),
								},
					dataType    : 'json',
					success		: function(data) {
									$('#ModalKeputusan').modal('hide');
									location.reload();
								},
					error		: function() {
									$('#ModalKeputusan').modal('hide');
								}
				});
				return false;
			});

			// Tampilkan Form Penetapan Keputusan
			$("#keputusan").click(function(){
				$('#ModalKeputusan').modal({backdrop: 'static', keyboard: false});
				$('#ModalKeputusan').modal('show');
			});
		});
		// Download dokumen
		$(".dokumen").click(function(){
			window.open(siteUrl+ '/skp/download_dokumen/' +  this.value ,'_blank');
			return false;
		});
		
		// Submit Rekomendasi
		$(".dokumen_ttk").click(function(){
			window.open(siteUrl+ '/skp/download_dokumen_ttk/' + $(this).data("id"),'_blank');
			return false;
		});
	</script>
<?php $this->load->view('vfooter'); ?>