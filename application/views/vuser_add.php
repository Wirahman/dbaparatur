<?php $this->load->view('vheader'); ?>

<script type="text/javascript">
$(function() {
	$("#username").focus();
});
function entsub(e) {
	if (e.keyCode == 13) {
		submitForm();
	} else {
		return true;
	}
}
function submitForm() {
	blockUI();
	$.post(siteUrl+"/user/doadd/", {
		username_edited: "<?=@$username_edited?>",
		nip: $("#nip").val(),
		password: $("#password").val(),
                pejabat_penilai: $("#pejabat_penilai").val(),
		ref_role: $("#role").val(),
		unit_organisasi: $("#unit_organisasi").val()

	}, function(resp) {
		unblockUI();
		if (resp=="<?=AJAX_SUCCESS?>")
			window.location = siteUrl+"/user/index/";
		else
			$("#form_error").html(resp);
	});
}
</script>

<div class="widget-header"><h5><?=(strlen(@$username_edited)>0?'Edit':'Tambah')?> User</h5></div>
<div class="widget-body">
	<div class="form-horizontal" role="form">
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
			<div class="col-sm-9">
				<span id="form_error" style="color:red;"></span>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">NIP</label>
			<div class="col-sm-9">
				<?php
				if (strlen(@$username_edited)>0)
					echo '<input type="text" size="50" id="nip" value="'.$username_edited.'" disabled="disabled" />';
				else
					echo '<input onkeypress="return entsub(event)" type="text" size="50" id="nip" autocomplete="off" />';
				?>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-2">Password</label>
			<div class="col-sm-9">
				<?php
				if (isset($username_edited))
					echo '<input onkeypress="return entsub(event)" type="password" size="50" id="password" /><span style="font-size:9px;">kosongkan jika tidak ada perubahan</span>';
				else
					echo '<input onkeypress="return entsub(event)" type="text" size="50" id="password" value="'.$random_password.'" /><span style="font-size:9px;">auto-generate</span>';
				?>
			</div>
		</div>
                <div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Pejabat Penilai</label>
			<div class="col-sm-9">
				<input onkeypress="return entsub(event)" type="text" size="50" id="pejabat_penilai" value="<?=@$row->pejabat_penilai?>" />
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-2">Role</label>
			<div class="col-sm-9">
				<?=$this->common->combo_id('role', $arr_role, @$row->ref_role)?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Unit Organisasi</label>
			<div class="col-sm-9">
				<input onkeypress="return entsub(event)" type="text" size="50" id="unit_organisasi" value="<?=@$row->unit_organisasi?>" />
			</div>
		</div>
		

	
		
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-2"></label>
			<div class="col-sm-9">
				<button class="btn btn-sm btn-primary" onclick="submitForm()">Submit</button>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('vfooter'); ?>
