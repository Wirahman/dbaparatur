<?php $this->load->view('vheader'); ?>

<script src="<?= base_url() ?>assets/js/select2.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery_form.js"></script>
<script type="text/javascript">
          $(document).ready(function() { 
              $("#nama_jabatan").select2();});
          $(document).ready(function() { 
              $("#nama_jabatan1").select2();  
    });
    
</script>

<div class="space-10"></div>
<div id="tambahkegiatan" class="modal fade tambahkegiatan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Tugas Kegiatan</h4>
            </div>
            <div class="modal-body row">
                  <div class="form-group col-sm-14">
     
<!--<form action="<?= site_url() ?>/referensi/simpanterminal" method="post" id="form" name="form" enctype="multipart/form-data" onSubmit="return validasi(this)">-->
<div class="widget-header"><h5><i class="icon-edit"></i>Tambah Kegiatan </h5></div>
<div class="widget-body">
	<div class="form-horizontal" role="form">
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
			<div class="col-sm-3">
				<span id="form_error" style="color:red;"></span>
			</div>
		</div>
                
                <div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Jabatan </label>
			<div class="col-sm-7">
                            <select id="nama_jabatan" style="width: 245px;">
                                    <option value='' selected='selected'> -- Pilih Jabatan -- </option>
                            <?php foreach($nama_jabatan->result() as $opt)
                                 echo "<option value='".$opt->id."'> ".$opt->deskripsi." </option>";
                            ?>

                            </select> <span style="font-size:12px; color:red;">*</span>
          	        </div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Kegiatan</label>
			<div class="col-sm-8">
                            <input  type="text" size="30" rel="tooltip" title="nama Kegiatan"   id="kegiatan" placeholder="Nama Kegiatan"  /> <span style="font-size:12px; color:red;">*</span> <br>
                   
                             <span id="usr_verify" class="verify"></span>
          	        </div>
		</div>
                <div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Satuan Kuantitas </label>
			<div class="col-sm-8">
                            <input  type="text" size="10" name="satuan_kuantitas"  rel="tooltip" maxlength="11" title="Satuan Kuantitas" onkeyup="return satuan_kuantitas();" placeholder="satuan_kuantitas"  id="satuan_kuantitas"  />   
                            <span style="font-size:12px; color:red;">*</span>  <br>
                         
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


<div id="editkegiatan" class="modal fade editkegiatan" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Kegiatan Jabatan</h4>
            </div>
            <div class="modal-body row">
                  <div class="form-group col-sm-14">
     
<!--<form action="<?= site_url() ?>/Listrik/simpanListrik" method="post" id="form" name="form" enctype="multipart/form-data" onSubmit="return validasi(this)">-->
<div class="widget-header"><h5><i class="icon-edit"></i>Edit Kegiatan Jabatan </h5></div>
<div class="widget-body">
	<div class="form-horizontal" role="form">
		<div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1"></label>
			<div class="col-sm-3">
				<span id="form_error" style="color:red;"></span>
			</div>
		</div>
                <div class="form-group">
                    <input  type="hidden" size="30" name="id"    id="idedit"  />
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Jabatan </label>
			<div class="col-sm-6">
                        
                         
                        <?php foreach($nama_jabatan->result() as $opt)
                           //  echo "<option value='".$opt->id_regionGas."'> ".$opt->nama_region." </option>";
                        ?>
                            <input type="text" name="nama_jabatan1" id="nama_reg1" value="<?= $opt->deskripsi ?>" readonly />
                        
          	        </div>
		</div>
                <div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Kegiatan</label>
                    <div class="col-sm-8">
                        <input type="text" onkeypress="return entsubFilter(event)" size="30" id="kegiatanedit" name="kegiatanedit"  autocomplete="off" />
                    </div>                    
                </div>
                <div class="form-group">
			<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Satuan Kuantitas </label>
			<div class="col-sm-8">
                            <input  type="text" size="10" name="satuan_kuantitasedit"  rel="tooltip" maxlength="11" title="Satuan Kuantitas"  placeholder="satuan_kuantitas"  id="satuan_kuantitasedit"  />   
                            <span style="font-size:12px; color:red;">*</span>  <br>
                         
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
<div class="widget-header"><h5><i class="icon-align-justify"></i> Kegiatan</h5></div>
<div class="widget-body">
<span id="form_error" style="color:red;"></span>

<div class="row">
  <div class="col-xs-12">
   
        <div class="table-header">
            <div  align='right'>    
               <a href="#tambahkegiatan" class="btn btn-xs btn-success green"  data-toggle="modal" style="margin-top: 0%;">
                <i class="icon-plus bigger-110">
                    Tambah
                </i>
            </a>
	    </div>
	</div>

	<div class="table-responsive">
	<table id="referensiKegiatan" class="table table-striped table-bordered table-hover">
	<thead>
            <tr>
                <th class="nomor">No</th>
                <th class="name">Nama Jabatan</th>
                <th class="name">Nama Kegiatan</th>
                <th class="name">Satuan</th>
                <th> Aksi </th>
            </tr>
	</thead>

	<tbody>
	<?php
	$i=1; 
	foreach($refkegiatan->result() as $kegiatan)
	{
	?> 
        <tr class="record">
	<td align="center">
            <a href="#"><?php  echo $i; ?> </a>
	</td>
        <td><?php echo ucfirst($kegiatan->deskripsi);?> </td> 
        <td><?php echo ucfirst($kegiatan->kegiatan);?> </td> 
        <td><?php echo ucfirst($kegiatan->satuan_kuantitas);?> </td> 
      
	<td>
	<div class="visible-md visible-lg hidden-sm hidden-xs action-buttons">
           <a  href="#editkegiatan" class="green edit_data" data-toggle="modal" data-target="#editkegiatan"
                                                        
                                                        data-id_jabatan="<?php echo $kegiatan->deskripsi ?>"
                                                        data-kegiatan="<?php echo $kegiatan->kegiatan ?>"
                                                        data-satuan_kuantitas="<?php echo $kegiatan->satuan_kuantitas ?>"
                                                        data-id="<?php echo $kegiatan->id;?>" title="edit" rel="tooltip">
            <i class="icon-pencil bigger-130"></i>
	</a>
            <a href="#" id="<?php echo $kegiatan->id;?>" class="hapusreferensikegiatan" title="hapus" rel="tooltip">
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
                         $terminal=$("#terminal").val();
                       $("#terminal").blur(function(){
                        if($("#terminal").val().length >= 4)
                        {
                        $.ajax({
                         type: "POST",
                         url: "<?php echo base_url();?>index.php/referensi/check_data_terminal",
                         data: "terminal="+$("#terminal").val(),
                         success: function(msg){
                           if(msg == 1)
                            {
                                    $("#usr_verify").html("Nama Terminal sudah ada").css({ "color": "red" });
                              var nama_depot=document.getElementById('terminal');
                              nama_depot.value="";


                            }
                            else 
                            {
                                  $("#usr_verify").html('Nama Terminal dapat dipakai').css({ "color": "green" });
                                  

                            }
                         }
                        });
                        }
                        else 
                        {
                              $("#usr_verify").html('jumlah kata kurang dari 4 karakter').css({ "color": "red" });
                              terminal.value="";
                        }
                       });
                      });
                </script>

                <script type="text/javascript">
      
                    $("#tambahkegiatan").on("show", function() { // wire up the OK button to dismiss the modal when shown
                    $("#tambahkegiatan a.btn").on("click", function(e) {
                    console.log("button pressed"); // just as an example...
                    $("#tambahkegiatan").modal('hide'); // dismiss the dialog
                    });
                    });
                </script>
                <script type="text/javascript">
      
                    $("#editkegiatan").on("show", function() { // wire up the OK button to dismiss the modal when shown
                    $("#editkegiatan a.btn").on("click", function(e) {
                    console.log("button pressed"); // just as an example...
                    $("#editkegiatan").modal('hide'); // dismiss the dialog
                    });
                    });
                </script>
                
                <script type="text/javascript">
                    $(document).ready(function(){
                    $("#submit").click(function(){
                      
                    var kegiatan=$("#kegiatan").val();
                    var id_jabatan=$("#nama_jabatan").val();
                    var satuan_kuantitas=$("#satuan_kuantitas").val();
                
                 
                    var dataString = 'kegiatan='+kegiatan + '&id_jabatan=' + id_jabatan  + '&satuan_kuantitas='+ satuan_kuantitas;
                   //alert(dataString);
                        if(kegiatan=='' || id_jabatan=='' || satuan_kuantitas=='')
                         {
                         alert("Data harus diisi dengan lengkap");
                         }
                         else
                         {
                            blockUI();
                          $.ajax({
                          type: "POST",
                          url:siteUrl+'/referensi/simpanKegiatan',
                          data: dataString,
                          cache: false,
                          success: function(result){
                              unblockUI();
                              $("#tambahkegiatan").modal('hide'); // dismiss the dialog
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
                    var nama_jabatan = $(this).data('id_jabatan');
                    var kegiatan = $(this).data('kegiatan');
                    var satuan_kuantitas = $(this).data('satuan_kuantitas');

                    $("#idedit").val(id);
                    $("#nama_reg1").val(nama_jabatan);
                    $("#kegiatanedit").val(kegiatan);
                    $("#satuan_kuantitasedit").val(satuan_kuantitas);
                   });

                </script>
                  
                <script type="text/javascript">
                   
                    $(document).ready(function(){
                    $("#update").click(function(){
//                        blockUI();
                        
                    var id=$("#idedit").val();
                    var id_jabatan= $("#nama_jabatan").val();
                    var kegiatan= $("#kegiatanedit").val();
                    var satuan_kuantitas= $("#satuan_kuantitasedit").val();
                
                 
                    var dataString = 'id='+ id + '&id_jabatan='+ id_jabatan + '&kegiatan='+ kegiatan
                                     + '&satuan_kuantitas='+ satuan_kuantitas;
                    alert(dataString);
                    if(  kegiatan=='' || satuan_kuantitas=='')
                        {
                            alert("Data Harus Diisi terlebih dahulu");
                        }
                    else
                    {
                        blockUI();   
                        $.ajax({
                        type: "POST",
                        url:siteUrl+'/referensi/updateKegiatan',
                        data: dataString,
                        cache: false,
                   
                        success: function(result){
                           unblockUI();
                           $("#editkegiatan").modal('hide'); // dismiss the dialog
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
                $(".hapusreferensikegiatan").click(function(){
                   
                var element = $(this);
                var del_id = element.attr("id");
                  $("#error").hide();
                var info = 'id=' + del_id;
                alert(info);
               var con;
                if(con=confirm("Apakah anda ingin menghapus data ini?"))
                {
                    if (con==true){
                         blockUI();
                 $.ajax({
                   type: "POST",
                   url:siteUrl+'/referensi/hapus_referensiKegiatan',
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
                        window.location.href=siteUrl+'/referensi/kegiatan';
                        
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
					var oTable1 = $('#referensiKegiatan').dataTable( {
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
                                                { "bSortable": false, "aTargets": [ 3 ] }
                                        ],
                                                //jumlah sorting table
                                        "aSorting": [[ 3, 'asc','desc']]

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


	 <script type="text/javascript">
        
         $(document).ready(function() {
         $('#provinsi').change(function() {
               //  alert("#aa");
                $.post("<?php echo site_url(); ?>/referensi/get_kabupatenkota/"+ $('#provinsi').val(), {}, function(obj) {
                    $('#kabupatenkota').html(obj);
                
                });
                 });
           });   
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
