<?php $this->load->view('vheader'); ?>
<script type="text/javascript">
function entsub(e) {
	if (e.keyCode == 13) {
		submitForm();
	} else {
		return true;
	}
}
function submitForm() {
	$("#form_success").html("");
	$("#form_error").html("");
	blockUI();
	$.post(siteUrl+"/user/password/", {
		oldpass: $("#oldpass").val(),
		newpass1: $("#newpass1").val(),
		newpass2: $("#newpass2").val()
	}, function(resp) {
		unblockUI();
		if (resp=="<?=AJAX_SUCCESS?>") {
			$("#oldpass").val("");
			$("#newpass1").val("");
			$("#newpass2").val("");
			$("#form_success").html("Proses ubah password berhasil");
		} else {
			$("#form_error").html(resp);
		}
	});
}
</script>
<div id="login-container" style="width:500px;">
	<div id="login-header">
		<h3>Ganti Password</h3>
	</div>
	<div>
		
			<div style="border: 1px solid #DDD;padding: 20px;">
				<table border="0" cellpadding="2">
				<tr>
					<td colspan="2">
						<span id="form_success" style="color:blue;"></span>
						<span id="form_error" style="color:red;"></span>
					</td>
				</tr>
				<tr>
					<td>Password Lama</td>
					<td><input onkeypress="return entsub(event)" type="password" id="oldpass" /></td>
				</tr>
				<tr>
					<td>Password Baru</td>
					<td><input onkeypress="return entsub(event)" type="password" id="newpass1" /></td>
				</tr>
				<tr>
					<td>Konfirmasi Password Baru</td>
					<td><input onkeypress="return entsub(event)" type="password" id="newpass2" /></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<button class="btn btn-primary" onclick="submitForm()">Submit</button>
					</td>
				</tr>
				</table>
			</div>
		
	</div>
</div>
<?php $this->load->view('vfooter'); ?>
