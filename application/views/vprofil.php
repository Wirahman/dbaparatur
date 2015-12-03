<?php $this->load->view('vheader'); ?>
<?php if ($this->session->flashdata('success_message')): ?>
    <div id="validation-success" class="alert alert-success fade in">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
        <?php echo $this->session->flashdata('success_message'); ?>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('error_message')): ?>
    <div id="validation-error" class="alert alert-danger fade in">
        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
        <?php echo $this->session->flashdata('error_message'); ?>
    </div>
<?php endif; ?>
<div class="row">
    <div class="span12">
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active">
                    <a data-toggle="tab" href="#profil">
                        <i class="green icon-user bigger-110"></i>
                        Profil
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#pendidikan">
                        <i class="green icon-building bigger-110"></i>
                        Riwayat Pendidikan
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#_jabatan">
                        <i class="green icon-arrow-up bigger-110"></i>
                        Riwayat Jabatan
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#diklat">
                        <i class="green icon-check bigger-110"></i>
                        Riwayat Diklat
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#penghargaan">
                        <i class="green icon-certificate bigger-110"></i>
                        Penghargaan
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#keluarga">
                        <i class="green icon-group bigger-110"></i>
                        Riwayat Keluarga
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#pengalaman">
                        <i class="green icon-file bigger-110"></i>
                        Riwayat Pengalaman
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#gaji">
                        <i class="green icon-money bigger-110"></i>
                        Riwayat Gaji
                    </a>
                </li>

            </ul>

            <div class="tab-content">
                <div id="profil" class="tab-pane in active">
                    <div class="widget-box">
                        <div class="widget-header widget-header-blue widget-header-flat">
                            <h4 class="lighter">Profil</h4>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <div id="nama_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Nama</label>

                                    <div class="col-xs-12 col-sm-5">
                                        <span class="block input-icon input-icon-right">
                                            <p id="nama" class="width-80-uppercase"><?php echo $nama; ?></p>
                                            <i id="nama_remove_sign" class="icon-remove-sign hidden"></i>
                                        </span>
                                    </div>
                                    <div id="nama_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden"> Error tip help!</div>
                                </div>

                                <div id="nip_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">NIP</label>

                                    <div class="col-xs-12 col-sm-5">
                                        <span class="block input-icon input-icon-right">
                                            <p id="nip" class="width-80-uppercase"><?php echo $this->session->userdata('nip'); ?></p>
                                            <i id="nip_remove_sign" class="icon-remove-sign hidden"></i>
                                        </span>
                                    </div>
                                    <div id="nip_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden"> Error tip help!</div>
                                </div>

                                <div id="nip_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Tempat / Tanggal Lahir</label>

                                    <div class="col-xs-12 col-sm-5">
                                        <span class="block input-icon input-icon-right">
                                            <p id="nip" class="width-80-uppercase">Jakarta, 13 Maret 1990</p>
                                            <i id="nip_remove_sign" class="icon-remove-sign hidden"></i>
                                        </span>
                                    </div>
                                    <div id="nip_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden"> Error tip help!</div>
                                </div>

                                <div id="nip_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Jenis Kelamin</label>

                                    <div class="col-xs-12 col-sm-5">
                            <span class="block input-icon input-icon-right">
                                <p id="nip" class="width-80-uppercase">Laki-laki</p>
                                <i id="nip_remove_sign" class="icon-remove-sign hidden"></i>
                            </span>
                                    </div>
                                    <div id="nip_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden"> Error tip help!</div>
                                </div>
                                <div id="nip_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Agama</label>

                                    <div class="col-xs-12 col-sm-5">
                            <span class="block input-icon input-icon-right">
                                <p id="nip" class="width-80-uppercase">Islam</p>
                                <i id="nip_remove_sign" class="icon-remove-sign hidden"></i>
                            </span>
                                    </div>
                                    <div id="nip_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden"> Error tip help!</div>
                                </div>
                                <div id="nip_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Status Perkawinan</label>

                                    <div class="col-xs-12 col-sm-5">
                            <span class="block input-icon input-icon-right">
                                <p id="nip" class="width-80-uppercase">Belum kawin</p>
                                <i id="nip_remove_sign" class="icon-remove-sign hidden"></i>
                            </span>
                                    </div>
                                    <div id="nip_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden"> Error tip help!</div>
                                </div>
                                <div id="pangkat_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Pangkat / Golongan</label>

                                    <div class="col-xs-12 col-sm-5">
                            <span class="block input-icon input-icon-right">
                                <p id="pangkat" class="width-80-uppercase"><?php echo $pangkat; ?></p>
                                <i id="pangkat_remove_sign" class="icon-remove-sign hidden"></i>
                            </span>
                                    </div>
                                    <div id="pangkat_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden"> Error tip help!</div>
                                </div>
                                <div id="select_jabatan_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Jabatan</label>

                                    <div class="col-xs-12 col-sm-5">
                            <span class="block input-icon input-icon-right">
                                <p id="jabatan" class="width-80-uppercase"><?php echo $deskripsi_jabatan; ?></p>
                            </span>
                                    </div>
                                    <div id="select_jabatan_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden"> Error tip help!</div>
                                </div>
                                <div id="unit_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">TMT Jabatan Terakhir</label>

                                    <div class="col-xs-12 col-sm-5">
                            <span class="block input-icon input-icon-right">
                                <p id="unit" class="width-80-uppercase"><?php echo $unit_organisasi; ?></p>
                                <i id="unit_remove_sign" class="icon-remove-sign hidden"></i>
                            </span>
                                    </div>
                                    <div id="unit_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden"> Error tip help!</div>
                                </div>
                                <div id="unit_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Nomor Telepon Rumah</label>

                                    <div class="col-xs-12 col-sm-5">
                            <span class="block input-icon input-icon-right">
                                <p id="unit" class="width-80-uppercase">(021) 1212899</p>
                                <i id="unit_remove_sign" class="icon-remove-sign hidden"></i>
                            </span>
                                    </div>
                                    <div id="unit_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden"> Error tip help!</div>
                                </div>
                                <div id="unit_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Nomor Telepon HP</label>

                                    <div class="col-xs-12 col-sm-5">
                            <span class="block input-icon input-icon-right">
                                <p id="unit" class="width-80-uppercase">0812 8728 8977</p>
                                <i id="unit_remove_sign" class="icon-remove-sign hidden"></i>
                            </span>
                                    </div>
                                    <div id="unit_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden"> Error tip help!</div>
                                </div>
                                <div id="pejabat_penilai_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden red"> * Terjadi kesalahan</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="pendidikan" class="tab-pane">
                    <div class="widget-box">
                        <div class="widget-header widget-header-blue widget-header-flat">
                            <h4 class="lighter">Riwayat Pendidikan</h4>
                        </div>
                        <div class="widget-body">
                            <div class="table-responsive">
                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="center">
                                            No.
                                        </th>
                                        <th>Tingkat Pendidikan</th>
                                        <th>Jurusan</th>
                                        <th>Nama Sekolah / Universitas</th>

                                        <th>Tahun Lululs</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>MIN</td>
                                        <td>-</td>
                                        <td>MIN BEREUNEUN</td>
                                        <td>1972</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="_jabatan" class="tab-pane">
                    <div class="widget-box">
                        <div class="widget-header widget-header-blue widget-header-flat">
                            <h4 class="lighter">Riwayat Jabatan</h4>
                        </div>
                        <div class="widget-body">
                            <div class="table-responsive">
                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="center">
                                            No.
                                        </th>
                                        <th>Nama Jabatan</th>
                                        <th>TMT</th>
                                        <th>Instansi</th>

                                        <th>Keterangan</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>PJS. KASUBAG BANTUAN HUKUM</td>
                                        <td>23-03-1992</td>
                                        <td>SETWILDA TK.II PIDIE</td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="diklat" class="tab-pane">
                    <div class="widget-box">
                        <div class="widget-header widget-header-blue widget-header-flat">
                            <h4 class="lighter">Riwayat Diklat</h4>
                        </div>
                        <div class="widget-body">
                            <div class="table-responsive">
                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="center">
                                            No.
                                        </th>
                                        <th>Nama Diklat Struktural / Teknis</th>
                                        <th>Tahun</th>
                                        <th>Tempat</th>

                                        <th>Lembaga Penyelenggara</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>PELATIHAN PRAJABATAN TK.II</td>
                                        <td>1989</td>
                                        <td>SIGLI</td>
                                        <td>PEMDAKAB. PIDIE</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="penghargaan" class="tab-pane">
                    <div class="widget-box">
                        <div class="widget-header widget-header-blue widget-header-flat">
                            <h4 class="lighter">Penghargaan Yang Diterima</h4>
                        </div>
                        <div class="widget-body">
                            <div class="table-responsive">
                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="center">
                                            No.
                                        </th>
                                        <th>Nama Penghargaan</th>
                                        <th>Tahun</th>
                                        <th>Lembaga Yang Memberikan</th>

                                        <th>Keterangan</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="keluarga" class="tab-pane">
                    <div class="widget-box">
                        <div class="widget-header widget-header-blue widget-header-flat">
                            <h4 class="lighter">Data Keluarga</h4>
                        </div>
                        <div class="widget-body">
                            <div class="table-responsive">
                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                    <thead>

                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="pengalaman" class="tab-pane">
                    <div class="widget-box">
                        <div class="widget-header widget-header-blue widget-header-flat">
                            <h4 class="lighter">Riwayat Pengalaman Berorganisasi</h4>
                        </div>
                        <div class="widget-body">
                            <div class="table-responsive">
                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                    <thead>

                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="gaji" class="tab-pane">
                    <div class="widget-box">
                        <div class="widget-header widget-header-blue widget-header-flat">
                            <h4 class="lighter">Data Riwayat Gaji</h4>
                        </div>
                        <div class="widget-body">
                            <div class="table-responsive">
                                <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                    <thead>

                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<?php $this->load->view('vfooter'); ?>
