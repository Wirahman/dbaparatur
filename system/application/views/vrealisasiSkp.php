<?php $this->load->view('vheader'); ?>
<script src="<?= base_url() ?>assets/Highcharts-3.0.7/js/highcharts.js"></script>
<script src="<?= base_url() ?>assets/Highcharts-3.0.7/js/highcharts-more.js"></script>
<script src="<?= base_url() ?>assets/Highcharts-3.0.7/js/drilldown.js"></script>
<script src="<?= base_url() ?>assets/Highcharts-3.0.7/js/data.js"></script>
<script src="<?= base_url() ?>assets/liscroll/jquery.li-scroller.1.0.js"></script>
<link rel="stylesheet" href="<?= base_url(); ?>assets/liscroll/li-scroller.css" />
<style>
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
                PENILAIAN CAPAIAN SASARAN KERJA PEGAWAI NEGERI SIPIL       
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
                            foreach($kegiatan_tugas_jabatan as $ktj):
                        ?>
                        <tr>
                            <td align="center"><?php echo ++$number.".";?></td>
                            <td align="left">
                                <?php echo $ktj->desc_kegiatan; ?>
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
                                <?php echo $ktj->target_biaya; ?>
                            </td> 
                            
                            <td align="center">
                                <?php if(isset($ktj->realisasi_angka_kredit)): echo $ktj->realisasi_angka_kredit; else: echo '-'; endif; ?>
                            </td>
                            <td align="center">
                                <?php if(isset($ktj->realisasi_kuantitas)): echo $ktj->realisasi_kuantitas; else: echo '-'; endif; ?>
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
                            <td align="center">TUGAS TAMBAHAN DAN KREATIVITAS : 
                                <?php if(isset($ktj->realisasi_biaya)): echo $ktj->realisasi_biaya; else: echo '-'; endif; ?>
                            </td> 
                            
                            <td align="center">
                                <?php if(isset($ktj->penghitungan)): echo $ktj->penghitungan; else: echo '0'; endif; ?>
                            </td> 
                            <td align="center">
                                <?php if(isset($ktj->nilai_capaian_skp)): echo $ktj->nilai_capaian_skp; else: echo '0'; endif; ?>
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
                        </tr>
                        <tr class="bolder">
                            <td align="center" colspan="17">
                                NILAI CAPAIAN SKP
                            </td>
                            <td align="center">
                                <?php if(isset($nilai_capaian_skp->average)): echo $nilai_capaian_skp->average; else: echo '0'; endif; ?>
                            </td>    
                        </tr>
                        <!--tugas tambahan dan kreatifitas-->
                        <?php
                            $numberttk = 0;
                            foreach($tugas_tambahan_kreativitas as $ttk):
                        ?>
                        <tr>
                            <td align="center"><?php echo ++$numberttk.".";?></td>
                            <td align="left">
                                <?php echo $ttk->desc_kegiatan; ?>
                            </td>
                            <td align="center">
                                <?php echo $ttk->target_angka_kredit; ?>
                            </td>    
                            <td align="center">
                                <?php echo $ttk->target_kuantitas; ?>
                            </td>
                            <td align="center">
                                <?php echo $ttk->satuan_kuantitas; ?>
                            </td>
                            <td align="center">
                                <?php echo $ttk->target_kualitas; ?>
                            </td>
                            <td align="left">
                                <?php echo $ttk->target_waktu; ?>
                            </td> 
                            <td align="center">
                                <?php echo $ttk->satuan_waktu; ?>
                            </td> 
                            <td align="center">
                                <?php echo $ttk->target_biaya; ?>
                            </td> 
                            
                            <td align="center">
                                <?php if(isset($ttk->realisasi_angka_kredit)): echo $ttk->realisasi_angka_kredit; else: echo '-'; endif; ?>
                            </td>
                            <td align="center">
                                <?php if(isset($ttk->realisasi_kuantitas)): echo $ttk->realisasi_kuantitas; else: echo '-'; endif; ?>
                            </td>
                            <td align="center">
                                <?php echo $ttk->satuan_kuantitas; ?>
                            </td>
                            <td align="left" >
                                <?php if(isset($ttk->realisasi_kualitas)): echo $ttk->realisasi_kualitas; else: echo '-'; endif; ?>
                            </td>
                            <td align="center">
                                <?php if(isset($ttk->realisasi_waktu)): echo $ttk->realisasi_waktu; else: echo '-'; endif; ?>
                            </td>
                            <td align="center">
                                <?php echo $ttk->satuan_waktu; ?>
                            </td> 
                            <td align="center">
                                <?php if(isset($ttk->realisasi_biaya)): echo $ttk->realisasi_biaya; else: echo '-'; endif; ?>
                            </td> 
                            
                            <td align="center">
                                <?php if(isset($ttk->penghitungan)): echo $ttk->penghitungan; else: echo '0'; endif; ?>
                            </td> 
                            <td align="center">
                                <?php if(isset($ttk->nilai_capaian_skp)): echo $ttk->nilai_capaian_skp; else: echo '0'; endif; ?>
                            </td> 
                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>

            </div>
            <div class="panel panel-default col-sm-12 width-100">
                <div class="panel-body">
                    <hr>
                    <button id="LaporkanRealisasi" class="btn btn-primary btn-sm padding-20" rel="tooltip" title="Laporkan Realisasi" data-placement="bottom">
                        <i class="icon-file"></i>
                        Laporkan Realisasi
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>     

<div class = "modal fade" id = "ModalLaporkanRealisasi" role = "dialog">
    <div class = "modal-dialog">
        <div class="widget-main">
            <form id="FormLaporRealisasi" method="post" action="#" enctype="multipart/form-data">
                <div class = "modal-content">
                    <div class = "modal-header">
                        <h3>Form Pelaporan Realisasi</h3>
                    </div>
                    <div class = "modal-body row">
                        <div id="select_kegiatan_form_group" class="form-group">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label no-padding-right">Kegiatan Tugas Jabatan</label>
                            <div class="col-xs-12 col-sm-7">
                                <span class="block input-icon input-icon-right">
                                    <select id="select_kegiatan" name="select_kegiatan" class="select2style" style="width: 80%; min-width: max-content;">
                                        <option>Pilih Kegiatan Tugas Jabatan</option>
                                        <!--dummy-->
                                        <option>Melaksanakan pengelolaan Penegakan Disiplin  PNS</option>
                                        <!--dummy-->
                                    </select>
                                    <i id="select_kegiatan_remove_sign" class="icon-remove-sign hidden"></i>
                                </span>
                            </div>
                        </div>
                        <br><br>
                        <div id="dokumen_form_group" class="form-group">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label no-padding-right">Dokumen</label>
                            <div class="col-xs-12 col-sm-6">
                                <span class="block input-icon input-icon-right">
                                    <input type="file" name="inputfileupload" id="id-input-file-2" />
                                    <div id="progress_bar" class="progress progress-mini progress-striped active hidden">
                                        <div id="bar_graph" class="progress-bar progress-success" style="width: 0%;"></div>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div id="biaya_form_group" class="form-group">
                            <label class="col-xs-12 col-sm-4 col-md-4 control-label no-padding-right">Biaya</label>
                            <div class="col-xs-12 col-sm-8">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" id="biaya" name="biaya" class="width-80-uppercase" value=""/>
                                    <i id="biaya_remove_sign" class="icon-remove-sign hidden"></i>
                                </span>
                            </div>
                        </div>
                        <br>
                    </div><!-- modal body -->
                    <div class = "modal-footer">
                        <button id="btnLapor" class="btn btn-primary" type="submit" name="submit">&nbsp;Laporkan</button>
                        <a class = "btn btn-primary" data-dismiss = "modal">Tutup</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).on("click", "#LaporkanRealisasi", function(e) {
        $('#ModalLaporkanRealisasi').modal({backdrop: 'static', keyboard: false});
        $('#ModalLaporkanRealisasi').modal('show');
    });
    jQuery(function($) {
        $('#id-input-file-2').ace_file_input({
            no_file: 'Tidak ada file yang dipilih...',
            btn_choose: 'Pilih',
            btn_change: 'Ubah',
            droppable: false,
            thumbnail: false //| true | large
            //whitelist:'gif|png|jpg|jpeg'
            //blacklist:'exe|php|html|js|sh|bat|'
        }).on('change', function() {
            var filename = $('#id-input-file-2').val();
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
                    return false;
                default:
                    var file_input = $('#id-input-file-2');
                    file_input.ace_file_input('reset_input');
                    bootbox.alert("File berekstensi tersebut tidak diperkenankan");
            }
            ;
        });
    });
</script>
<?php $this->load->view('vfooter'); ?>

