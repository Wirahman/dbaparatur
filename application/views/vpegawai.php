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
<script src="<?= base_url() ?>assets/js/jquery_form.js"></script>
<div id="dialog-confirm1" class="hide">Anda yakin akan menghapus user ini?</div>
<button class="btn btn-sm btn-primary" onclick="window.location='<?=site_url()?>/user/add/'">Tambah Pegawai</button>
<br />
<br />
<div class="row">
  <div class="col-xs-12">
<div class="table-responsive">
	<span style="color:blue;" id="form_success"></span>
	<span style="color:red;" id="form_error"></span>
	<table id="pegawai" class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th width="50">#</th>
				<th>NIP</th>
				<th>Nama Pegawai</th>
				<th>Jabatan</th>
				<th>Atasan</th>
				<th>Unit Organisasi</th>
				<th>Role</th>
				<th class="hidden-480">Status</th>
				<?php
				if ($has_access)
					echo '<th class="center">Opsi</th>';
				?>
			</tr>
		</thead>

		<tbody>
			<?php
			// TODO, edit & delete user
			$no = (isset($range1)?$range1:1);
			foreach ($data as $row) {
				echo '<tr id="row_'.$row->nip.'">
					<td>'.($no++).'</td>
					<td>'.$row->nip.'</td>
					<td>'.$row->nama.'</td>
					<td>'.$row->deskripsi.'</td>
					<td>'.$row->atasan.'</td>
					<td>'.ucwords($row->unit_organisasi).'</td>
					<td>'.ucwords($data_role_map[$row->ref_role]).'</td>
					<td>
						<span class="label label-sm '.$data_status_icon_map[$row->status].'">'.$data_status_map[$row->status].'</span>
					</td>';
				echo '<td width=270>';
				if ($has_access && strtolower($row->nip)!=strtolower($this->session->userdata('nip'))) {
					echo '<a href="'.site_url().'/user/add/'.$row->nip.'">
						<img src="'.base_url().'assets/img/edit.png" />
					      </a>';
					echo '<img src="'.base_url().'assets/img/delete.png" onclick="deleteRecord(\''.$row->nip.'\')" style="cursor:pointer;" />';?>
						<button id="lihatdetail" class="btn btn-primary btn-xs" rel="tooltip" data-placement="bottom">
							<i class="icon-eye-open"></i>
							 Lihat Detail
						</button>  
						<button id="riwayataktifitas" class="btn btn-primary btn-xs" rel="tooltip" data-placement="bottom">
							<i class="icon-eye-open"></i>
							 Histori Aktifitas
						</button>                                 
				<?php }
				echo '</td>';
				echo '</tr>';
			}
			?>
		</tbody>
	</table>
</div><!-- /.table-responsive -->

  </div>
</div>
<?php $this->load->view('vfooter'); ?>
<script src="<?= base_url() ?>/assets/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/assets/js/jquery.dataTables.bootstrap.js"></script>

<script>
        jQuery(document).on('click','#riwayataktifitas', function(e){
           window.location.href=siteUrl+'/user/aktifitas/'
        });
</script>

<script>
        jQuery(document).on('click','#lihatdetail', function(e){
           window.location.href=siteUrl+'/profil/'; 
        });
</script>
<script type="text/javascript">
				jQuery(function($) {
					var oTable1 = $('#pegawai').dataTable( {
                                           "fnDrawCallback": function ( oSettings ) {
                                          /* Need to redo the counters if filtered or sorted */
                                          if ( oSettings.bSorted || oSettings.bFiltered )
                                          {
                                                  for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                                                  {
                                                          $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
                                                  }
                                          }
                                     },
                                        "aoColumnDefs": [
                                                 //jumlah table
                                                { "bSortable": false, "aTargets": [ 6 ] }
                                        ],
                                                //jumlah sorting table
                                        "aSorting": [[ 1, 'asc','desc']]

				     } );
				
					$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
					function tooltip_placement(context, source) {
						var $source = $(source);
						var $parent = $source.closest('table')
						var off1 = $parent.offset();
						var w1 = $parent.width();
				
						var off2 = $source.offset();
						var w2 = $source.width();
				
						if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
						return 'left';
					}
				})


				</script>
    <script language="javascript">
           $(document).ready(function(){
              $.fn.modal.Constructor.prototype.enforceFocus = function () {
              var that = this;
              $(document).on('focusin.modal', function (e) {
                 if ($(e.target).hasClass('select2-input')) {
                    return true;
                 }

                 if (that.$element[0] !== e.target && !that.$element.has(e.target).length) {
                    that.$element.focus();
                 }
              });
           };
            $("[rel='tooltip']").tooltip();

            });
        </script>
