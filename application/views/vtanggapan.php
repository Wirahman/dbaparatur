<?php $this->load->view('vheader'); ?>
<style>
    .panel-default {
        border-color: transparent;
    }
</style>
<div class="widget-header"><h5> <i class="icon-user"></i>TANGGAPAN</h5></div>
<div class="widget-body">
    <span id="form_error" style="color:red;"></span>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default col-sm-12 width-100">
                <div class="panel-body">
                    <form id="tampil" class="col-sm-12" method="POST" action="<?php echo site_url() . '/tanggapan'; ?>">
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
                                    <th>Keberatan/Tanggapan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        07 Juni 2015 - 19:48 - "Mohon Peninjauan kembali..." <br>
                                        <span class="space-30"></span><i class="icon-reply-all"></i> 
                                        07 Juni 2015 - 19:52 - "Untuk menanggapi apa yang telah Bapak..."</td>
                                    <td>
                                        <button id="lihat_keberatan" class="btn btn-primary btn-xs padding-20" rel="tooltip" title="Lihat Tanggapan" data-placement="bottom">
                                            <i class="icon-ok"></i>
                                            Detail keberatan yang diajukan
                                        </button>
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

    <div class = "modal fade" id = "ModalTanggapan" role = "dialog">
        <div class = "modal-dialog">
            <div class="widget-main">
                <form id="FormTanggapan" method="post" action="#" enctype="multipart/form-data">
                    <div class = "modal-content">
                        <div class = "modal-header">
                            <h3>Tanggapan</h3>
                        </div>
                        <div class = "modal-body row">
                            <textarea id="tanggapan" name="tanggapan" style="width: 100%; min-height: 250px;" class="overflow-auto">Mohon Peninjauan kembali pak, mengenai beberapa parameter sebelumnya, jika saya lihat...</textarea>
                        </div><!-- modal body -->
                        <div class = "modal-footer">
                            <a class = "btn btn-primary" data-dismiss = "modal">Tutup</a>
                        </div>
                    </div>
                </form>
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
                            <textarea id="keberatan" name="keberatan" style="width: 100%; min-height: 250px;" class="overflow-auto">Untuk menanggapi apa yang telah Bapak tanyakan, untuk beberapa parameter kami nilai Bapak cukup baik...</textarea>
                        </div><!-- modal body -->
                        <div class = "modal-footer">
                            <a class = "btn btn-primary" data-dismiss = "modal">Tutup</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).on("click", "#lihat_tanggapan", function(e) {
            $('#ModalTanggapan').modal({backdrop: 'static', keyboard: false});
            $('#ModalTanggapan').modal('show');
        });
        $(document).on("click", "#lihat_keberatan", function(e) {
            $('#ModalKeberatan').modal({backdrop: 'static', keyboard: false});
            $('#ModalKeberatan').modal('show');
        });
        $(document).on("click", "#lihat_tanggapan", function(e) {
            
        });
    </script>
    <?php $this->load->view('vfooter'); ?>
