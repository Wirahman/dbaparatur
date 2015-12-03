<?php $this->load->view('vheader'); ?>
<div class="page-content">
	<div class="page-header">
		<h1>
			Detail Data Pegawai
		</h1>
	</div><!-- /.page-header -->

	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<div class="alert alert-block alert-success hide">
				<button type="button" class="close" data-dismiss="alert">
					<i class="icon-remove"></i>
				</button>
				<p>
					<strong>
						<i class="icon-ok"></i>
					</strong>
					&nbsp;Update data pegawai berhasil.
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
					&nbsp;Update data pegawai gagal.
				</p>
			</div>

			<form id="formPegawai" class="form-horizontal" role="form">
				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> NIP </label>
					<div class="col-sm-9">
						<input id="nip" readonly type="text" id="form-field-1" value="<?=$nip?>" class="input-large" />
					</div>
				</div>

				<div class="space-4"></div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Nama </label>
					<div class="col-sm-9">
						<input readonly type="text" id="form-field-2" value="<?=$nama?>" class="input-xlarge" />
					</div>
				</div>

				<div class="space-4"></div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> Pangkat / Gol.Ruang </label>
					<div class="col-sm-9">
						<input readonly="" type="text" class="input-mini" id="form-input-readonly" value="<?=$pangkat?>" />
					</div>
				</div>

				<div class="space-4"></div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> Jabatan </label>

					<div class="col-sm-9">
						<select id="id_jabatan" name="id_jabatan">
						<?php foreach($list_jabatan as $jabatan) {
								if($jabatan->id == $id_jabatan)
									echo '<option selected value="'.$jabatan->id . '">' . $jabatan->deskripsi .'</option>';
								else
									echo '<option value="'.$jabatan->id . '">' . $jabatan->deskripsi .'</option>';
							}
						?>
						</select>
					</div>
				</div>
				
				<div class="space-4"></div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> Unit Kerja </label>
					<div class="col-sm-9">
						<input readonly="" type="text" class="input-xlarge" id="form-input-readonly" value="" />
					</div>
				</div>
				
				<div class="space-4"></div>

				<div class="form-group">
					<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> Pejabat Penilai </label>
					<div class="col-sm-9">
						<input readonly="" type="text" class="input-xlarge" id="form-input-readonly" value="<?=$nama_pejabat_penilai?>" />
					</div>
				</div>
				<div class="clearfix form-actions">
					<div class="col-md-offset-3 col-md-9">
						<button id="save" name="save" class="btn btn-success btn-sm" type="submit">
							<i class="icon-ok"></i>
							Simpan
						</button>
						<button id="back" name="back" class="btn btn-danger btn-sm" type="button">
							<i class="icon-caret-left"></i>
							Kembali
						</button>
					</div>
				</div>
			</form>
<?php $this->load->view('vfooter'); ?>

<script language="JavaScript">
$(document).ready(function() {
    $('#formPegawai').submit(function(event) {

		var error = $('.alert-danger');
		var success = $('.alert-success');
		var info = $('.alert-info');
		
		success.addClass('hide');
		error.addClass('hide');
		info.removeClass('hide');

        $.ajax({
            type        : 'POST',
            url         : '../edit/' + $("#nip").val(), 
            data        : {
							'id_jabatan' : $("#id_jabatan").val(),
						},
            dataType    : 'json',
			success		: function(data) {
							info.addClass('hide');
							error.addClass('hide');
							success.removeClass('hide');		
						},
			error		: function() {
							info.addClass('hide');
							error.removeClass('hide');
							success.addClass('hide');		
						}
        });
		return false;
    });
	$('#back').click(function(event){
		window.history.back();
	});
});
</script>