<?php $this->load->view('vheader'); ?>
<style>
    .panel-default {
        border-color: transparent;
    }
</style>
<div class="widget-header"><h5> <i class="icon-user"></i>Hasil Penilaian Prestasi Kerja Tahun <?php echo $tahunyangdinilaisaatini; ?></h5></div>
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
                                                <td class="align-center">87</td>
                                                <td class="align-center">60%</td>
                                                <td class="align-center">52.2</td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Perilaku Kerja</td>
                                                <td class="align-center">90</td>
                                                <td class="align-center">40%</td>
                                                <td class="align-center">36</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td class="align-center">
                                                    88.2
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td class="align-center">(Baik)</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
                                            <tr>
                                                <td align="center"></td>
                                                <td align="left">
                                                    
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
                                            </tr>
                                            
                                            <tr class="bolder">
                                                <td align="center" colspan="17">
                                                    NILAI CAPAIAN SKP
                                                </td>
                                                <td align="center">
                                                    <?php if (isset($nilai_capaian_skp->average)): echo $nilai_capaian_skp->average;else: echo '0';endif; ?>
                                                </td>    
                                            </tr>
                                        </tbody>

                                    </table>

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
                                                <td class="align-center"></td>
                                                <td class="align-center">-</td>
                                            </tr>
                                            <tr>
                                                <td>Integritas</td>
                                                <td class="align-center"></td>
                                                <td class="align-center">-</td>
                                            </tr>
                                            <tr>
                                                <td>Komitmen</td>
                                                <td class="align-center"></td>
                                                <td class="align-center">-</td>
                                            </tr>
                                            <tr>
                                                <td>Disiplin</td>
                                                <td class="align-center"></td>
                                                <td class="align-center">-</td>
                                            </tr>
                                            <tr>
                                                <td>Kerjasama</td>
                                                <td class="align-center"></td>
                                                <td class="align-center">-</td>
                                            </tr>
                                            <tr>
                                                <td>Kepemimpinan</td>
                                                <td class="align-center"></td>
                                                <td class="align-center">-</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td class="align-center">Jumlah</td>
                                                <td class="align-center"><?php if (isset($penilaianperilakukerja->jumlah)): echo $penilaianperilakukerja->jumlah; else: echo "0"; endif; ?></td>
                                                <td class="align-center">-</td>
                                            </tr>
                                            <tr>
                                                <td class="align-center">Nilai rata-rata</td>
                                                <td class="align-center"><?php if (isset($penilaianperilakukerja->nilai_rata_rata)): echo $penilaianperilakukerja->nilai_rata_rata; else: echo "0"; endif; ?></td>
                                                <td class="align-center">-</td>
                                            </tr>
                                            <tr>
                                                <td class="align-center">Bobot</td>
                                                <td class="align-center">40%</td>
                                                <td class="align-center"></td>
                                            </tr>
                                            <tr>
                                                <td class="align-center">Nilai Perilaku Kerja</td>
                                                <td class="align-center"><?php if (isset($penilaianperilakukerja->nilai_perilaku_kerja)): echo $penilaianperilakukerja->nilai_perilaku_kerja; else: echo "0"; endif; ?></td>
                                                <td class="align-center">-</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <?php
                                //demo tampilan
                                if ($showcompletemode == FALSE):
                            ?>
                                <div class="align-center">
                                    <button id="setuju" class="btn btn-primary padding-20" rel="tooltip" title="Setuju" data-placement="bottom">
                                        <i class="icon-eye-open"></i>
                                        Setuju
                                    </button>
                                    <button id="keberatan" class="btn btn-danger padding-20" rel="tooltip" title="Keberatan" data-placement="bottom">
                                        <i class="icon-eye-open"></i>
                                        Keberatan
                                    </button>
                                </div>
                            <?php
                                else:
                            ?>
                                <div class="well" style="min-height: 125px;">
                                    <h4 class="green small lighter">Keberatan</h4>
                                    [Isian keberatan]
                                    <br><hr>
                                    Tanggal: DD Month YYYY h:i:s
                                </div>
                                <div class="well" style="min-height: 125;">
                                    <h4 class="green small lighter">Tanggapan Pejabat Penilai</h4>
                                    [Isian tanggapan pejabat penilai]
                                    <br><hr>
                                    Tanggal: DD Month YYYY h:i:s
                                </div>
                                <div class="well" style="min-height: 125px;">
                                    <h4 class="green small lighter">Keputusan Atasan Pejabat Penilai</h4>
                                    [Isian keputusan atasan pejabat penilai]
                                    <br><hr>
                                    Tanggal: DD Month YYYY h:i:s
                                </div>                     
                                <div class="well" style="min-height: 125px;">
                                    <h4 class="green small lighter">Rekomendasi</h4>
                                    [Isian rekomendasi]
                                    <br><hr>
                                    Tanggal: DD Month YYYY h:i:s
                                </div>
                                <h5>Dibuat oleh Pejabat Penilai pada tanggal (DD MONTH YYYY --> tanggal evaluasi)</h4>
                                <h5>Dibuat oleh Pejabat Penilai pada tanggal (DD MONTH YYYY --> tanggal PNS setuju/keberatan)</h4>
                                <h5>Diterima oleh Atasan Pejabat Penilai pada tanggal (DD MONTH YYYY --> tanggal PNS setuju/keberatan)</h4>
                            <?php
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class = "modal fade" id = "ModalKeberatan" role = "dialog">
        <div class = "modal-dialog">
            <div class="widget-main">
                <form id="FormKeberatan" method="post" action="#" enctype="multipart/form-data">
                    <div class = "modal-content">
                        <div class = "modal-header">
                            <h3>Keberatan</h3>
                        </div>
                        <div class = "modal-body row">
                            <textarea id="keberatan" name="keberatan" style="width: 100%; min-height: 250px;" class="overflow-auto" placeholder="..."></textarea>
                            <input type="text" class="hidden" id="textinput_keberatan" name="textinput_keberatan" value=""/>
                        </div><!-- modal body -->
                        <div class = "modal-footer">
                            <button id="laporkeberatan" class="btn btn-primary" rel="tooltip" title="Laporkan Keberatan" data-placement="bottom">
                                <i class="icon-ok-sign"></i>
                                Lapor Keberatan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).on("click", "#setuju", function(e) {

        });
        $(document).on("click", "#keberatan", function(e) {
            $('#ModalKeberatan').modal({backdrop: 'static', keyboard: false});
            $('#ModalKeberatan').modal('show');
        });
    </script>
<?php $this->load->view('vfooter'); ?>