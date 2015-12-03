<?php $this->load->view('vheader'); ?>
<?php if ($this->session->flashdata('success_message')):?>
        <div id="validation-success" class="alert alert-success fade in">
            <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <?php echo $this->session->flashdata('success_message');?>
        </div>
<?php endif; ?>
<?php if ($this->session->flashdata('error_message')):?>
        <div id="validation-error" class="alert alert-danger fade in">
            <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <?php echo $this->session->flashdata('error_message');?>
        </div>
<?php endif; ?>
<div class="row">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-header widget-header-blue widget-header-flat">
                <h4 class="lighter">Profil Pegawai</h4>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <form class="form-horizontal" id="profil-form" method="POST" action="<?= site_url() ?>/profil/simpanperubahan/">
                                <div id="nama_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Nama</label>
                                    <div class="col-xs-12 col-sm-5">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" id="nama" name="nama" class="width-80-uppercase" readonly="readonly" value="<?php echo $nama; ?>"/>
                                            <i id="nama_remove_sign" class="icon-remove-sign hidden"></i>
                                        </span>
                                    </div>
                                    <div id="nama_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden"> Error tip help! </div>
                                </div>
                                <div id="nip_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">NIP</label>
                                    <div class="col-xs-12 col-sm-5">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" id="nip" name="nip" class="width-80-uppercase" readonly="readonly" value="<?php echo $this->session->userdata('nip');?>"/>
                                            <i id="nip_remove_sign" class="icon-remove-sign hidden"></i>
                                        </span>
                                    </div>
                                    <div id="nip_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden"> Error tip help! </div>
                                </div>
                                <div id="pangkat_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Pangkat / Gol.Ruang</label>
                                    <div class="col-xs-12 col-sm-5">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" id="pangkat" name="pangkat" class="width-80-uppercase" readonly="readonly" value="<?php echo $pangkat;?>"/>
                                            <i id="pangkat_remove_sign" class="icon-remove-sign hidden"></i>
                                        </span>
                                    </div>
                                    <div id="pangkat_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden"> Error tip help! </div>
                                </div>
                                <div id="select_jabatan_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Jabatan (*)</label>
                                    <div class="col-xs-12 col-sm-5">
                                        <span class="block input-icon input-icon-right">
                                            <select id="select_jabatan" name="select_jabatan" class="select2style" style="width: 80%;">
                                                    <option value="0">Pilih Jabatan</option>
                                                <?php foreach ($jabatan as $dj): ?>
                                                    <option value="<?php echo $dj->id; ?>" <?php if ($dj->id == $id_jabatan): echo 'selected="selected"'; endif; ?>><?php echo $dj->deskripsi; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <i id="select_jabatan_remove_sign" class="icon-remove-sign hidden"></i>
                                        </span>
                                    </div>
                                    <div id="select_jabatan_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden"> Error tip help! </div>
                                </div>
                                <div id="unit_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Unit Kerja (*)</label>
                                    <div class="col-xs-12 col-sm-5">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" id="unit" name="unit" class="width-80-uppercase" value="<?php echo $unit_organisasi;?>"/>
                                            <i id="unit_remove_sign" class="icon-remove-sign hidden"></i>
                                        </span>
                                    </div>
                                    <div id="unit_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden"> Error tip help! </div>
                                </div>
                                <div id="pejabat_penilai_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Pejabat Penilai (*)</label>
                                    <div class="col-xs-12 col-sm-5">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" id="pejabat_penilai_nip" class="hidden" name="pejabat_penilai_nip" value="<?php echo $pejabat_penilai_nip; ?>">
                                            <div style="position: relative;">
                                                <input type="text" name="pejabat_penilai_nama" id="autocomplete-ajax" value="<?php echo $pejabat_penilai_nama; ?>"/>
                                            </div>
                                            <i id="spinner" class="icon-refresh spin hidden"></i>
                                        </span>
                                    </div>
                                    <!--<div id="selction-ajax"></div>-->
                                    <div id="pejabat_penilai_error_tip" class="help-block col-xs-12 col-sm-reset inline hidden red"> * Terjadi kesalahan </div>
                                </div>
                                <div id="unit_form_group" class="form-group">
                                    <label class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right"></label>
                                    <div class="col-xs-12 col-sm-5">
                                        <button id="simpan_perubahan" class="btn btn-primary">
                                            <i class="icon-save"></i>
                                            Simpan Perubahan
                                        </button>
                                    </div>
                                </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url() ?>assets/js/jquery.autocomplete.js"></script>
<script>
$(function () {
    'use strict';

    $('#autocomplete-ajax').autocomplete({
        serviceUrl: '<?php echo site_url().'/profil/ambildaftarpejabatpenilai'?>',
        onSelect: function(suggestion) {
            $("#spinner").addClass('hidden');
            $('#pejabat_penilai_nip').attr('value', suggestion.data);
            $('input[name=pejabat_penilai_nama]').attr('value', suggestion.value);
            //$('#selction-ajax').html('You selected: ' + suggestion.value + ', ' + suggestion.data);
            $("#pejabat_penilai_error_tip").addClass('hidden');
        },
        onInvalidateSelection: function() {
            $("#spinner").addClass('hidden');
            $('#pejabat_penilai_nip').attr('value', '');
            $('input[name=pejabat_penilai_nama]').attr('value', '');
            //$('#selction-ajax').html('You selected: none');
            $("#pejabat_penilai_error_tip").removeClass('hidden');
        }
    });
});
</script>
<?php $this->load->view('vfooter'); ?>
