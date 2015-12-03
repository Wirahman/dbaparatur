<?php $this->load->view('vheader'); ?>

<script src="<?= base_url() ?>assets/js/select2.min.js"></script>

<div class="space-10"></div>



<div id="tambahjabatan" class="modal fade tambahjabatan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Jabatan</h4>
            </div>
            <div class="modal-body row">
                  <div class="form-group col-sm-14">
     
<!--<form action="<?= site_url() ?>/referensi/simpanterminal" method="post" id="form" name="form" enctype="multipart/form-data" onSubmit="return validasi(this)">-->
<div class="widget-header"><h5><i class="icon-edit"></i>Tambah Jabatan </h5></div>
<div class="widget-body">
	<div class="form-horizontal" role="form">
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
			<div class="col-sm-3">
				<span id="form_error" style="color:red;"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Jabatan</label>
			<div class="col-sm-8">
                            <input  type="text" size="30" rel="tooltip" title="nama Jabatan"   id="deskripsi" placeholder="Nama Jabatan"  /> <span style="font-size:12px; color:red;">*</span> <br>
                   
                             <span id="usr_verify" class="verify"></span>
          	        </div>
		</div>
   
		
	</div>
</div>

            <div class="modal-footer">
                <button class="btn btn-sm btn-primary" rel="tooltip" title="Tambah" id="submit"> <i class="icon-plus"></i>Tambah</button>
                <button class="btn btn-sm btn-danger" rel="tooltip" title="Batal" data-dismiss="modal">
                    <i class="icon-remove"></i>
                        Batal
                </button>

                
            </div><!-- <div class="modal-footer"> -->
</form>
               </div>
        </div>
        </div>
            
                 </div>
   
</div>


<div id="editJabatan" class="modal fade editJabatan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Referensi Jabatan</h4>
            </div>
            <div class="modal-body row">
                  <div class="form-group col-sm-14">
     
<!--<form action="<?= site_url() ?>/Listrik/simpanListrik" method="post" id="form" name="form" enctype="multipart/form-data" onSubmit="return validasi(this)">-->
<div class="widget-header"><h5><i class="icon-edit"></i>Edit Jabatan </h5></div>
<div class="widget-body">
	<div class="form-horizontal" role="form">
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
			<div class="col-sm-3">
				<span id="form_error" style="color:red;"></span>
			</div>
		</div>
                <div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Jabatan</label>
                    <div class="col-sm-8">
                        <input  type="hidden" size="30" name="id" id="idedit"  />
                        <input type="text" onkeypress="return entsubFilter(event)" size="30" id="deskripsiedit" name="deskripsiedit"  autocomplete="off" />
                    </div>
                </div>
            
	</div>
</div>

            <div class="modal-footer">
                <button class="btn btn-sm btn-success" id="update" title="Update" rel="tooltip">Ubah</button>
                <button class="btn btn-sm btn-danger" data-dismiss="modal" title="batal" rel="tooltip">
                    <i class="icon-remove"></i>
                        Batal
                </button>
 
            </div><!-- <div class="modal-footer"> -->
<!--</form>-->
               </div>
        </div>
        </div>
            
      </div>
   
</div>


   <?php
    $pesan = $this->session->flashdata('message');
    if (!empty($pesan)) {
        ?>

    <div class="alert alert-success">
        <button class="close" data-dismiss="alert" type="button">
            <i class="icon-remove"></i>
        </button>
        <center><strong>
                <?php echo $this->session->flashdata('message'); ?>
            </strong>
            <br></center>
    </div>

    <?php
}
?>
<div class="widget-header"><h5><i class="icon-align-justify"></i> Jabatan</h5></div>
<div class="widget-body">
<span id="form_error" style="color:red;"></span>

<div class="row">
  <div class="col-xs-12">
   
        <div class="table-header">
            <div  align='right'>    
               <a href="#tambahjabatan" class="btn btn-xs btn-success green"  data-toggle="modal" style="margin-top: 0%;">
                <i class="icon-plus bigger-110">
                    Tambah
                </i>
            </a>
	    </div>
	</div>

	<div class="table-responsive">
	<table id="referensiJabatan" class="table table-striped table-bordered table-hover">
	<thead>
            <tr>
                <th class="nomor">No</th>
                <th class="name">Nama Jabatan</th>
                <th> Aksi </th>
            </tr>
	</thead>

	<tbody>
	<?php
	$i=1; 
	foreach($refjabatan->result() as $jabatan)
	{
	?> 
        <tr class="record">
	<td align="center">
	<a href="#"><?php  echo $i; ?> </a>
	</td>
        <td><?php echo ucfirst($jabatan->deskripsi);?> </td> 
      
	<td>
	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
           <a  href="#editJabatan" class="green edit_data" data-toggle="modal" data-target="#editJabatan"
                                                              
                                                        data-deskripsi="<?php echo $jabatan->deskripsi ?>"
                                                        data-id="<?php echo $jabatan->id;?>" title="edit" rel="tooltip">
            <i class="icon-pencil bigger-130"></i>
	</a>
            <a href="#" id="<?php echo $jabatan->id;?>" class="hapusreferensijabatan" title="hapus" rel="tooltip">
	<i class="icon-trash bigger-130 red"></i>
	</a>
	</div>
	</td>
	</tr>
        <?php $i++; ?> 
        <?php } ?>
	</tbody>
	</table>
	</div>
	</div>
	</div>
</div>

<?php $this->load->view('vfooter'); ?>

		<script src="<?= base_url() ?>/assets/js/jquery.dataTables.min.js"></script>
		<script src="<?= base_url() ?>/assets/js/jquery.dataTables.bootstrap.js"></script>
                   
                    <script type="text/javascript">
                       $(document).ready(function(){
                         $deskripsi=$("#deskripsi").val();
                       $("#deskripsi").blur(function(){
                        if($("#deskripsi").val().length >= 4)
                        {
                        $.ajax({
                         type: "POST",
                         url: "<?php echo base_url();?>index.php/referensi/check_data_jabatan",
                         data: "deskripsi="+$("#deskripsi").val(),
                         success: function(msg){
                           if(msg == 1)
                            {
                                    $("#usr_verify").html("Nama deskripsi sudah ada").css({ "color": "red" });
                              var nama_depot=document.getElementById('deskripsi');
                              nama_depot.value="";


                            }
                            else 
                            {
                                  $("#usr_verify").html('Nama deskripsi dapat dipakai').css({ "color": "green" });
                                  

                            }
                         }
                        });
                        }
                       });
                      });
                </script>

                <script type="text/javascript">
      
                    $("#tambahJabatan").on("show", function() { // wire up the OK button to dismiss the modal when shown
                    $("#tambahJabatan a.btn").on("click", function(e) {
                    console.log("button pressed"); // just as an example...
                    $("#tambahJabatan").modal('hide'); // dismiss the dialog
                    });
                    });
                </script>
                <script type="text/javascript">
      
                    $("#editJabatan").on("show", function() { // wire up the OK button to dismiss the modal when shown
                    $("#editJabatan a.btn").on("click", function(e) {
                    console.log("button pressed"); // just as an example...
                    $("#editJabatan").modal('hide'); // dismiss the dialog
                    });
                    });
                </script>
                
                <script type="text/javascript">
                    $(document).ready(function(){
                    $("#submit").click(function(){
                      
                    var id=$("#id").val();
                    var deskripsi=$("#deskripsi").val();
                
                    var dataString = 'id1='+id + '&deskripsi1='+deskripsi;
                   //alert(dataString);
                        if(deskripsi=='')
                         {
                         alert("Data harus diisi dengan lengkap");
                         }
                         else
                         {
                            blockUI();
                          $.ajax({
                          type: "POST",
                          url:siteUrl+'/referensi/simpanJabatan',
                          data: dataString,
                          cache: false,
                          success: function(result){
                              unblockUI();
                              $("#tambahJabatan").modal('hide'); // dismiss the dialog
                              location.reload();
                              clearAll();

                        }
                        });
                        }
                        return false;
                        });
                        });   
                </script> 
                
                <script type="text/javascript">
                 
                    $(document).on( "click", '.edit_data',function(e) {
                    var id = $(this).data('id');
                    var deskripsi = $(this).data('deskripsi');

                    $("#idedit").val(id);
                    $("#deskripsiedit").val(deskripsi);
                   });

                </script>
                  
                <script type="text/javascript">
                   
                    $(document).ready(function(){
                    $("#update").click(function(){
//                        blockUI();
                        
                    var id=$("#idedit").val();
                    var deskripsi= $("#deskripsiedit").val();
                
                 
                    var dataString = 'id='+ id + '&deskripsi='+ deskripsi  ;
                   // alert(dataString);
                    if(id== '' || deskripsi=='')
                        {
                            alert("Data Harus Diisi terlebih dahulu");
                        }
                    else
                    {
                        blockUI();   
                        $.ajax({
                        type: "POST",
                        url:siteUrl+'/referensi/updateJabatan',
                        data: dataString,
                        cache: false,
                   
                        success: function(result){
                           unblockUI();
                           $("#editJabatan").modal('hide'); // dismiss the dialog
                           location.reload();
                    }
                    });
                    }
                    return false;
                    });
                    });

                        
               </script> 
                
               <script type="text/javascript">
                $(function() {
                $(".hapusreferensijabatan").click(function(){
                   
                var element = $(this);
                var del_id = element.attr("id");
                  $("#error").hide();
                var info = 'id=' + del_id;
               // alert(info);
               var con;
                if(con=confirm("Apakah anda ingin menghapus data ini?"))
                {
                    if (con==true){
                         blockUI();
                 $.ajax({
                   type: "POST",
                   url:siteUrl+'/referensi/hapus_referensiJabatan',
                   data: info,
                   success: function(){
                        unblockUI();
                        location.reload();
                          
                 }
                });
                
                       $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
                      .animate({ opacity: "hide" }, "slow");
                
                    }else 
                    {
                        window.location.href=siteUrl+'/referensi/jabatan';
                        
                    }
               
                 }
                return false;
                });
                });
                 </script>
		<!-- inline scripts related to this page -->
                <!-- Line Table -->
		<script type="text/javascript">
				jQuery(function($) {
					var oTable1 = $('#referensiJabatan').dataTable( {
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
                                                { "bSortable": false, "aTargets": [ 2 ] }
                                        ],
                                                //jumlah sorting table
                                        "aSorting": [[ 2, 'asc','desc']]

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
