<?php $this->load->view('vheader'); ?>
<script type="text/javascript">
function deleteRecord(nip) {
	//e.preventDefault();
	$("#form_success").html("");
	$("#form_error").html("");
	$("#dialog-confirm1").removeClass("hide").dialog({
		resizable: false,
		modal: true,
		buttons: [
			{
				html: "<i class='icon-trash bigger-110'></i>&nbsp; Hapus",
				"class" : "btn btn-danger btn-xs",
				click: function() {
					$(this).dialog("close");
					blockUI();
					$.post(siteUrl+"/user/dodelete/", {
						nip: nip
					}, function(resp) {
						unblockUI();
						if (resp=="<?=AJAX_SUCCESS?>") {
							$("#row_"+nip).fadeOut(200);
							$("#form_success").html("nip "+nip+" berhasil dihapus");
						} else {
							$("#form_error").html(resp);
						}
					});
				}
			},{
				html: "<i class='icon-remove bigger-110'></i>&nbsp; Batal",
				"class" : "btn btn-xs",
				click: function() {
					$(this).dialog("close");
				}
			}
		]
	});
}
</script>
<div id="dialog-confirm1" class="hide">Anda yakin akan menghapus user ini?</div>
<button class="btn btn-sm btn-primary" onclick="window.location='<?=site_url()?>/user/add/'">Tambah User</button>
<br />
<br />
<div class="table-responsive">
	<span style="color:blue;" id="form_success"></span>
	<span style="color:red;" id="form_error"></span>
	<table id="sample-table-1" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th width="50">#</th>
				<th>NIP</th>
				<th>Unit Organisasi</th>
				<th>Role</th>
				<th class="hidden-480">Status</th>
				<?php
				if ($has_access)
					echo '<th>Opsi</th>';
				?>
			</tr>
		</thead>

		<tbody>
			<?php
			// TODO, edit & delete user
			$no = (isset($range1)?$range1:1);
			foreach ($data->result() as $row) {
				echo '<tr id="row_'.$row->nip.'">
					<td>'.($no++).'</td>
					<td>'.$row->nip.'</td>
					<td>'.ucwords($row->unit_organisasi).'</td>
					<td>'.ucwords($data_role_map[$row->ref_role]).'</td>
					<td>
						<span class="label label-sm '.$data_status_icon_map[$row->status].'">'.$data_status_map[$row->status].'</span>
					</td>';
				echo '<td>';
				if ($has_access && strtolower($row->nip)!=strtolower($this->session->userdata('nip'))) {
					echo '<a href="'.site_url().'/user/add/'.$row->nip.'">
						<img src="'.base_url().'assets/img/edit.png" />
						</a>';
					echo '<img src="'.base_url().'assets/img/delete.png" onclick="deleteRecord(\''.$row->nip.'\')" style="cursor:pointer;" />';
				}
				echo '</td>';
				echo '</tr>';
			}
			?>
		</tbody>
	</table>
</div><!-- /.table-responsive -->
<?php $this->load->view('vfooter'); ?>