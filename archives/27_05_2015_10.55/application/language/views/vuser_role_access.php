<?php $this->load->view('vheader'); ?>

<script type="text/javascript">
function updateAccess() {
	blockUI();
	var str = "";
	$("#sample-table-1 :checked").each(function() {
		str += $(this).val() + ",";
	});
	$.post(siteUrl+"/user/doeditroleaccess/", {
		role_id: <?=$role_id?>,
		role_name: "<?=$role_name?>",
		str: str
	}, function(resp) {
		if (resp=="<?=AJAX_SUCCESS?>")
			window.location = siteUrl + "/user/role/";
		else
			$("#form_error").html(resp);
	});
}
</script>
<span id="form_error" style="color:red;"></span>
<table id="sample-table-1" class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th width="30">No</th>
<th>Menu</th>
<th>Modul/URL</th>
<th width="100">Enable/Disable</th>
</tr>
</thead>
<tbody>

<?php
$i = 1;
$color1 = true;
foreach($data_menu->result() as $row) {
	if ($color1) echo '<tr bgcolor="#f6f6f6">';
	else echo '<tr bgcolor="#e6e6e6">';
	
	echo '<td class="select_content" align="center">'.($i++).'</td>';
	echo '<td class="select_content">'.$row->menu_name.'</td>';
	echo '<td class="select_content">'.$row->menu_url.'</td>';
	$checked = '';
	if (key_exists($row->menu_url, $arr_menu))
		$checked = ' checked="checked"';
	echo '<td class="select_content" align="center"><input value="menu_'.$row->id.'" type="checkbox"'.$checked.' /></td>';
	echo '</tr>';
	$color1 = !$color1;
}
?>
</tbody>
</table>

<p align="center">
<button class="btn btn-sm btn-primary" onclick="updateAccess()">Simpan</button>
<button class="btn btn-sm btn-warning" onclick="window.location='<?=site_url()?>/user/role/'">Batal</button>
</p>

<?php $this->load->view('vfooter'); ?>