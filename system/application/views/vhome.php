<?php $this->load->view('vheader'); ?>
<?php
$data_notif_realisasi_pekerjaan = $this->mkegiatan->get_notif_realisasi_pekerjaan_bulan_ini();
$data_notif_realisasi_anggaran = $this->mkegiatan->get_notif_realisasi_anggaran_bulan_ini();
?>
								<div class="alert alert-block alert-info">
									<button type="button" class="close" data-dismiss="alert">
										<i class="icon-remove"></i>
									</button>

									<i class="icon-ok blue"></i>
									Selamat datang di 
									<strong class="blue">
										SMEP (Sistem Monitoring, Evaluasi, dan Pelaporan)
									</strong>
									, 
									Perusahaan Gas Negara(PGN)<br />
									<i class="icon-ok blue"></i>
									Saat ini ada <u><a href="<?=site_url()?>/kegiatan/index/nofilter/"><?=$num_kegiatan?> Kegiatan</a></u> di Tahun Anggaran <?=$this->session->userdata('processing_year')?>
								</div>

								<div class="row">
									<div class="space-6"></div>

									<div class="col-sm-7 infobox-container">
										<div class="infobox infobox-blue  ">
											<div class="infobox-icon">
												<i class="icon-briefcase"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?=$pekerjaan_semua_realisasi?></span>
												<div class="infobox-content">Realisasi Pekerjaan</div>
											</div>
										</div>

										<div class="infobox infobox-green  ">
											<div class="infobox-icon">
												<i class="icon-briefcase"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?=$pekerjaan_realisasi_bulan_ini?></span>
												<div class="infobox-content">Realisasi <?=$this->common->decode_month(date('m'))?></div>
											</div>
										</div>

										<div class="infobox infobox-red  ">
											<div class="infobox-data">
												<span class="infobox-text"><?=$pekerjaan_persen_realisasi?><br />Realisasi Pekerjaan</span>
											</div>
										</div>

										<div class="infobox infobox-blue  ">
											<div class="infobox-icon">
												<i class="icon-calendar"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number" style="font-size:12px;"><strong>Rp <?=$this->common->number_format_ind($anggaran_semua_realisasi, true)?></strong></span>
												<div class="infobox-content">Realisasi Anggaran</div>
											</div>
										</div>

										<div class="infobox infobox-green  ">
											<div class="infobox-icon">
												<i class="icon-calendar"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number" style="font-size:12px;"><strong>Rp <?=$this->common->number_format_ind($anggaran_realisasi_bulan_ini, true)?></strong></span>
												<div class="infobox-content">Realisasi <?=$this->common->decode_month(date('m'))?></div>
											</div>
										</div>

										<div class="infobox infobox-red  ">
											<div class="infobox-data">
												<span class="infobox-text"><?=$anggaran_persen_realisasi?><br />Realisasi Anggaran</span>
											</div>
										</div>

										<div class="space-6"></div>

										<div class="infobox infobox-purple infobox-small infobox-dark">
											<div class="infobox-progress">
												<div class="easy-pie-chart percentage" data-percent="0" data-size="0">
													<span class="percent"><?=$num_kegiatan_tahap_1?></span>
												</div>
											</div>

											<div class="infobox-data">
												<div class="infobox-content">Fase</div>
												<div class="infobox-content">Persiapan</div>
											</div>
										</div>

										<div class="infobox infobox-pink infobox-small infobox-dark">
											<div class="infobox-progress">
												<div class="easy-pie-chart percentage" data-percent="0" data-size="0">
													<span class="percent"><?=$num_kegiatan_tahap_2?></span>
												</div>
											</div>

											<div class="infobox-data">
												<div class="infobox-content">Fase</div>
												<div class="infobox-content">Pelaksanaan</div>
											</div>
										</div>

										<div class="infobox infobox-orange infobox-small infobox-dark">
											<div class="infobox-progress">
												<div class="easy-pie-chart percentage" data-percent="0" data-size="0">
													<span class="percent"><?=$num_kegiatan_tahap_3?></span>
												</div>
											</div>

											<div class="infobox-data">
												<div class="infobox-content">Fase</div>
												<div class="infobox-content">Penyelesaian</div>
											</div>
										</div>
									</div>

									<div class="vspace-sm"></div>

									<div class="col-sm-5">
										<div class="widget-box">
											<div class="widget-header widget-header-flat widget-header-small">
												<h5>
													<i class="icon-exclamation-sign"></i>
													Notifikasi
												</h5>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<div class="clearfix">
														<div class="grid2">
															<a href="<?=site_url()?>/pekerjaan/index/nofilter/">
																<span class="grey">
																	<i class="icon-exclamation-sign icon-2x red"></i>
																</span>
																<h4 class="bigger pull-right"><?=$num_kegiatan_belum_realisasi_pekerjaan?></h4>
																<br /><br />
																kegiatan belum memiliki realisasi pekerjaan
															</a>
														</div>

														<div class="grid2">
															<a href="<?=site_url()?>/anggaran/index/nofilter/">
																<span class="grey">
																	<i class="icon-exclamation-sign icon-2x red"></i>
																</span>
																<h4 class="bigger pull-right"><?=$num_kegiatan_belum_realisasi_anggaran?></h4>
																<br /><br />
																kegiatan belum memiliki realisasi anggaran
															</a>
														</div>
													</div>
												</div><!-- /widget-main -->
											</div><!-- /widget-body -->
										</div><!-- /widget-box -->
									</div><!-- /span -->
								</div><!-- /row -->

								<div class="hr hr32 hr-dotted"></div>
								
								<?php
								if (( count($data_notif_realisasi_pekerjaan)+count($data_notif_realisasi_anggaran) )>0) {
									echo '<h3>Notifikasi</h3>';
									$merge = array_merge($data_notif_realisasi_pekerjaan, $data_notif_realisasi_anggaran);
									foreach ($merge as $link=>$desc) {
										echo '<a href="'.$link.'">
										<div style="color:#FF0000;">
										<i class="icon-exclamation-sign red"></i>
										&nbsp;&nbsp;
										&nbsp;&nbsp;'.$desc.'
										</div>
										</a>';
									}
									
								}
								?>
								
<?php $this->load->view('vfooter'); ?>