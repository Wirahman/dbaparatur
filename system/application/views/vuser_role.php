<?php $this->load->view('vheader'); ?>

<script type="text/javascript">
$(function() {
	$("#role").focus();
});
function entsub(e) {
	if (e.keyCode == 13) {
		addRole();
	} else {
		return true;
	}
}
function entsub1(e, roleId) {
	if (e.keyCode == 13) {
		saveRole(roleId);
	} else {
		return true;
	}
}
function addRole() {
	blockUI();
	$.post(siteUrl+"/user/doaddrole/", {
		ROLE: $("#ROLE").val()
	}, function(resp) {
		unblockUI();
		if (resp=="<?=AJAX_SUCCESS?>")
			window.location = location.href;
		else
			$("#form_error").html(resp);
	});
}
function editRole(roleId) {
	$("#span_"+roleId).hide();
	$("#edit_"+roleId).hide();
	$("#input_"+roleId).fadeIn(300);
	$("#save_"+roleId).fadeIn(300);
	$("#cancel_"+roleId).fadeIn(300);
	$("#input_"+roleId).select();
}
function saveRole(roleId) {
	$("#save_"+roleId).hide();
	$("#cancel_"+roleId).hide();
	blockUI();
	
	$.post(siteUrl+"/user/doeditrolename/", {
		id: roleId,
		detil: $("#input_"+roleId).val()
	}, function(resp) {
		$("#save_"+roleId).show();
		$("#cancel_"+roleId).show();
		window.location = location.href;
	});
}
function deleteRole(id, detil) {
	bootbox.confirm("Anda yakin ingin menghapus role "+detil+"?", function(result) {
		if (result) {
			blockUI();
			$.post(siteUrl+"/user/dodeleterole/", {
				id: id,
				detil: detil
			}, function(resp) {
				window.location = location.href;
			});
		}
	});
}
</script>

<!--<p align="center">
	Tambah Role <input onkeypress="return entsub(event)" type="text" id="ROLE" /> 
	<button class="btn btn-sm btn-primary" onclick="addRole()">Submit</button>
	<span id="form_error" style="color:red;"></span>
</p>-->
<?php


echo '<div class="table-responsive">';
echo '<table id="sample-table-1" class="table table-striped table-bordered table-hover">';
echo '<thead>';
echo '<tr>';
echo '<th width="30">No</th>';
echo '<th>Nama Role</th>';
echo '<th>Username yang Terdaftar</th>';
echo '<th width="90">Edit Nama</th>';
echo '<th width="90">Edit Akses</th>';
echo '<th width="90">Hapus</th>';
echo '</tr>';
echo '</thead>';

$i = 1;
foreach($data_role->result() as $row) {
	$id = $row->id;
	echo '<tr id="role_'.$id.'">';
	echo '<td align="center">'.($i++).'</td>';
	echo '<td>
		<input onkeypress="return entsub1(event, '.$id.')" type="text" id="input_'.$id.'" value="'.$row->detil.'" style="display:none;" />
		<span id="span_'.$id.'">'.$row->detil.'</span>
		</td>';
	echo '<td>';
	$data_user = $this->muser->get_user_by_role($row->id);
	$users_concat = '';
	foreach ($data_user->result() as $row2) {
		$users_concat .= $row2->nip.', ';
	}
	$users_concat = substr($users_concat, 0, strlen($users_concat)-2); // ngilangin koma+spasi
	echo $users_concat.'</td>';
	if ($row->id != $this->session->userdata('role')) {
		echo '<td align="center">
			<img id="edit_'.$id.'" src="'.base_url().'assets/img/edit.png" onclick="editRole('.$id.')" style="cursor:pointer;" />
			<img id="save_'.$id.'" src="'.base_url().'assets/img/save.png" onclick="saveRole('.$id.')" style="cursor:pointer;display:none;" />
			<img id="cancel_'.$id.'" src="'.base_url().'assets/img/delete.png" onclick="location.href=\''.$this->input->server('REQUEST_URI').'\'" style="cursor:pointer;display:none;" />
			</td>';
		echo '<td align="center"><a href="'.site_url().'/user/roleaccess/'.$row->id.'/">
			<img src="'.base_url().'assets/img/edit.png" /></a></td>';
		echo '<td align="center">';
		if (strlen($users_concat)==	0)
			echo '<img src="'.base_url().'assets/img/delete.png" style="cursor:pointer;" onclick="deleteRole('.$row->id.', \''.$row->detil.'\')" />';
		else
			echo '&nbsp;';
		echo '</td>';
	} else {
		echo '<td align="center"></td>';
		echo '<td align="center"></td>';
		echo '<td align="center"></td>';
	}
}
echo '</table>';
echo '</div>';


$this->load->view('vfooter');
?>