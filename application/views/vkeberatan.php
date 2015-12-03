<?php $this->load->view('vheader'); ?>
<style>
    .panel-default {
        border-color: transparent;
    }
</style>
<div class="widget-header"><h5> <i class="icon-user"></i>PENGAJUAN KEBERATAN</h5></div>
<div class="widget-body">
    <span id="form_error" style="color:red;"></span>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default col-sm-12 width-100">
                <div class="panel-body">
                    <form id="tampil" class="col-sm-6" method="POST" action="<?php echo site_url() . '/keberatan'; ?>">
                        <select name="tahun" class="select2style">
                            <?php foreach ($availableYYYY as $ay): ?>
                                <option value="<?php echo $ay->tahun; ?>" <?php if ($tahunyangdinilaisaatini == $ay->tahun): echo 'selected="selected"';endif; ?>><?php echo $ay->tahun; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="space-30"></span>
                        <button id="tampilkan" class="btn btn-primary btn-xs padding-20" rel="tooltip" title="Tampilkan" data-placement="bottom">
                            <i class="icon-ok"></i>
                            Tampilkan
                        </button>
                    </form>
                    <div class="align-right col-sm-6">
                        <button id="keberatan" class="btn btn-primary btn-xs padding-20" rel="tooltip" title="Ajukan Keberatan" data-placement="bottom">
                            <i class="icon-ok"></i>
                            Ajukan Keberatan
                        </button>
                    </div>
                    <hr>
                    <div class="table-responsive overflow-auto">

                        <h5 class="lighter">PEJABAT PENILAI</h5>
                        <table id="realisasitable">
                            <tbody>
                                <tr>
                                    <td class="col-sm-4">Nama</td>
                                    <td>:</td>
                                    <td><?php echo $pejabat_penilai_nama; ?></td>
                                </tr>
                                <tr>
                                    <td class="col-sm-4">NIP</td>
                                    <td>:</td>
                                    <td><?php echo $pejabat_penilai_nip; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <table id="table" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Unsur yang dinilai</th>
                                    <th>Nilai</th>
                                    <th>Persentase</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sasaran Kerja Pegawai (SKP)</td>
                                    <td><?php echo $nilai_capaian_skp; ?></td>
                                    <td>X 60%</td>
                                    <td><?php echo $nilai_prestasi_akademik; ?></td>
                                </tr>
                                <tr>
                                    <td>Perilaku Kerja (Nilai rata-rata)</td>
                                    <td><?php echo $nilai_rata_rata; ?></td>
                                    <td>X 40%</td>
                                    <td><?php echo $nilai_perilaku_kerja; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" rowspan="2" class="align-middle align-center bolder">Nilai Prestasi Kerja</td>
                                    <td><?php echo $total_nilai; ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $kriteria_nilai; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <table id="table" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Keberatan yang pernah diajukan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>07 Juni 2015 - 19:48 - "Mohon Peninjauan kembali..."</td>
                                    <td><span class="label label-success">Telah ditanggapi</span></td>
                                    <td>
                                        <button id="lihat_tanggapan" class="btn btn-primary btn-xs padding-20" rel="tooltip" title="Lihat Tanggapan" data-placement="bottom">
                                            <i class="icon-ok"></i>
                                            Lihat Tanggapan
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class = "modal fade" id = "ModalPengajuanKeberatan" role = "dialog">
        <div class = "modal-dialog">
            <div class="widget-main">
                <form id="FormPengajuanKeberatan" method="post" action="#" enctype="multipart/form-data">
                    <div class = "modal-content">
                        <div class = "modal-header">
                            <h3>Ajukan Keberatan</h3>
                        </div>
                        <div class = "modal-body row">
                            <textarea id="keberatan" name="keberatan" value="" style="width: 100%; min-height: 250px;" class="overflow-auto"></textarea>
                        </div><!-- modal body -->
                        <div class = "modal-footer">
                            <button id="btnPengajuan" class="btn btn-primary" type="submit" name="submit">&nbsp;Ajukan</button>
                            <a class = "btn btn-primary" data-dismiss = "modal">Tutup</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var siteUrl = "<?php echo site_url();?>";
        $(document).on("click", "#keberatan", function(e) {
            $('#ModalPengajuanKeberatan').modal({backdrop: 'static', keyboard: false});
            $('#ModalPengajuanKeberatan').modal('show');
        });
        $(document).on("click", "#lihat_tanggapan", function(e) {
            window.location.replace(siteUrl+'/tanggapan/');
        });
    </script>
    <?php $this->load->view('vfooter'); ?>
