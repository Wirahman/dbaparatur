<?php $this->load->view('vheader'); ?>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery_form.js"></script>
    <script src="<?=base_url()?>assets/liscroll/jquery.li-scroller.1.0.js"></script>

    <script type="text/javascript">
          $(document).ready(function() { 
              $("#nama_kegiatan").select2();
              $("#nama_jabatan").select2();
              $("#pejabat_penilai").select2();
              $("#pejabat").select2();
              $("#satuan_waktu").select2();

    });
    
  </script>
    
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

  




           
        <div class="widget-header"><h5> <i class="icon-user"></i> PERENCANAAN SKP</h5></div>
                <div class="widget-body">
                    <span id="form_error" style="color:red;"></span>
                    <div class="row">
                    <div class="col-xs-12">
        <?php if ($status >= 1){ ?>
                            <div class="table-header" align="center">  
                                   FORMULIR SASARAN KERJA PEGAWAI NEGERI SIPIL       
                            </div>

                           <div class="table-responsive">     
                           <table id="perencanaanskp"  class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="center" width="5%">NO</th>
                                    <th class="center" colspan="2" width="40%">PEJABAT PENILAI</th>
                                    <th class="center" width="5%">NO</th>
                                    <th class="center" colspan="6">PEGAWAI NEGERI SIPIL YANG DINILAI</th>
                                </tr>
                            </thead>       
                            <tr>
                                    <td align="center"> 1</td>
                                    <td align="left" width="15%">Nama</td>
                                    <th align="left"><?php  echo $pejabat_penilai_nama; ?></th>    
                                    <td align="center">1</td>
                                    <td align="left" width="15%" >Nama</td> 
                                    <th colspan="5" align="left">&nbsp;&nbsp; <?php  echo $nama; ?></th>   
                            </tr>

                                <tr>
                                    <td align="center">2</td>
                                    <td align="left" width="15%">NIP</td>
                                    <th align="center"><?php  echo $pejabat_penilai_nip; ?></th>    
                                    <td align="center">2</td>
                                    <td align="left" width="15%">NIP</td> 
                                    <td colspan="5" align="left" ><b>&nbsp;&nbsp;&nbsp;<?= $this->session->userdata('nip') ?></b></td>  
                                </tr>
                                <tr>
                                    <td align="center">3</td>
                                    <td align="left" width="15%">Pangkat/Gol.Ruang</td>
                                    <th align="left"><?php  echo $pangkat; ?></th>    
                                    <td align="center">3</td>
                                    <td align="left" width="15%">Pangkat/Gol.Ruang</td> 
                                    <th colspan="5" align="left">&nbsp;&nbsp; <?php  echo $pangkat_peg; ?></th>  
                                </tr>

                                <tr>
                                    <td align="center">4</td>
                                    <td align="left" width="15%">Jabatan</td>
                                    <th align="left">   
                                        <?php  echo $penilai; ?>
                                    </th>    
                                    <td align="center">4</td>
                                    <td align="left" width="15%">Jabatan</td> 
                                    <th colspan="5" align="left">        
                                       &nbsp;&nbsp;
                                       <?php echo $jabatan;?>
                                    </th>   

                                </tr>
                                <tr>
                                    <td align="center">5</td>
                                    <td align="left" width="15%">Unit Kerja</td>
                                    <th align="left"><?php  echo $unit; ?></th>    
                                    <td align="center">5</td>
                                    <td align="left" width="15%">Unit Kerja</td> 
                                    <th colspan="5" align="left">&nbsp;&nbsp; <?php  echo $unit_organisasi; ?></th>   
                                </tr>
                            </table>
                         </div>


                <div class="widget-header"><h5> <i class="icon-user"></i> INPUT SKP</h5></div>  

                <form method="post" action="<?php echo $action; ?>">
                <div class="table-responsive"> 
                <table id="perencanaanskp"  class="table table-striped table-bordered table-hover">

                            <tr>
                                <td class="center bolder" rowspan="2">KEGIATAN TUGAS JABATAN</td>
                                <td class="center bolder" rowspan="2">AK</td>
                                <td class="center bolder" colspan="6">TARGET</td>
                                <td class="center bolder" rowspan="2">Action</td>
                            </tr>
                            <tr>          
                                <td colspan="2" class="center bolder">Kuant/Output</td>
                                <td class="center bolder">Kual/Mutu</td>
                                <td colspan="2" class="center bolder">Waktu</td>
                                <td align="left" class="center bolder">Biaya</td> 

                            </tr>



                <?php
                        $list = explode("-", $parameter);
                        //print_r($list); //for debuging
                        //echo '<br> ini parameternya '. $parameter;	
                        if (count($list)==1) echo "<tr class=''><td colspan=8>Belum ada Perencanaan SKP<td></tr>"; //tidak ada data perbaikan
                        for($i=1;$i<count($list);$i+=8){
                ?>
                <tbody> 
                  <tr>
                    <td><input name="textfield" type="text"  id="textfield"  size="40"  value="<?php echo $list[$i]?>"  readonly /></td>
                    <td><input name="textfield1" type="text" id="textfield1" size="5"   value="<?php echo $list[$i+1] ?>" readonly /></td>
                    <td><input name="textfield2" type="text" id="textfield2" size="5"   value="<?php echo $list[$i+2] ?>"  readonly /></td>
                    <td><input name="textfield3" type="text" id="textfield3" size="5"   value="<?php echo $list[$i+3] ?>" readonly /></td>
                    <td><input name="textfield4" type="text" id="textfield4" size="5"   value="<?php echo $list[$i+4] ?>"  readonly /></td>
                    <td><input name="textfield5" type="text" id="textfield5" size="5"   value="<?php echo $list[$i+5] ?>"  readonly /></td>
                    <td><input name="textfield6" type="text" id="textfield6" size="10"   value="<?php echo $list[$i+6] ?>"  readonly /></td>
                    <td><input name="textfield7" type="text" id="textfield7" size="5"   value="<?php echo $list[$i+7] ?>"  readonly /></td>

                    <td>    
                      <input type="hidden" name="urutan" value="<?php echo $i ?>" />
                      <input type="hidden" name="parameter" value="<?php echo $parameter?>" />
                      <div>
                                <button class="btn btn-sm btn-danger"  name="hapus" id="hapus"rel="tooltip">
                                     <i class="icon-remove-circle"></i>
                                     Hapus</button>
                      </div>
                      <!--<input type="submit" name="hapus" id="hapus" value="Hapus" /> -->
                    </td>
                  </tr>
                </tbody>

                <?php	
                        }
                ?>

                <tbody
                <tr>   
                        <td>
                          <div class="col-sm-6">
                                <select id="nama_kegiatan" name ="nama_kegiatan" style="width: 300px;" onchange="changeValue(this.value)" >
                                                <option value='' selected='selected'> -- Pilih Kegiatan -- </option>
                                        <?php foreach($nama_kegiatan->result() as $opt){
                                              echo "<option value='".$opt->id."'> ".$opt->kegiatan." </option>";                              
                                              $jsArray .= "prdName['" . $opt->id. "'] = {name:'" . addslashes($opt->satuan_kuantitas) . "'};\n";   
                                            }?>         
                               </select>


                          </div>
                            <div  align='center' style=" margin-top: 5px; margin-right: -160px;"> 
                                <a href="#tambahkegiatan"  data-toggle="modal">
                                   <i class="icon-plus"></i>
                                </a>
                            </div>
                        </td>
                        <td>
                            <input name="target_angka_kredit" type="text" id="target_angka_kredit" size="5"  autocomplete="off"/>

                        </td>
                        <td>
                            <input type="text" id="target_kuantitas"  name="target_kuantitas" size="5" autocomplete="off"/>

                        </td>
                         <td>
                              <input type="text" id="satuan_kuantitas"  name="satuan_kuantitas" size="5" readonly autocomplete="off"/>
                        </td>
                         <td>
                            <input name="target_kualitas" type="text" id="target_kualitas" size="5" autocomplete="off"/>
                        </td>
                         <td>
                            <input name="target_waktu" type="text" id="target_waktu" size="5" autocomplete="off"/>
                        </td>
                        <td>
                            <select id="satuan_waktu" name ="satuan_waktu" style="width: 100px;" > 
                                                <option value='Bulan' selected='selected'>Bulan</option>
                                                <option value='Minggu'>Minggu</option>
                                                <option value='Hari'>Hari</option>
                             </select>    
                        </td>
                        <td>
                            <input name="target_biaya" type="text" id="target_biaya" size="5" autocomplete="off"/>
                        </td>

                        <td>
                            <input type="hidden" name="parameter" value="<?php echo $parameter?>" />
                            <!--<input type="submit" name="kirim" id="kirim" value="Tambah" />-->
                            <div>
                                <button class="btn btn-primary btn-sm padding-20" rel="tooltip" btn-success" name ="kirim" id="kirim" rel="tooltip">
                                     <i class="icon-plus"></i>
                                     Tambah</button>
                            </div>
                            <input type="hidden" name="parameter" value="<?php echo $parameter?>" />
                        </td>
                    </tr>
                    </tbody>

                    </table>
                        <!--   <input type="submit"  name="simpan" id="simpan" value="Simpan" /> -->       
                        <div style="margin-left: 25px; margin-bottom:10px;">
                          <button class="btn btn-primary btn-sm padding-20" rel="tooltip" btn-danger" data-dismiss="modal" name="submit" id="submit" rel="tooltip">
                             <i class="icon-save"></i>
                              Simpan
                           </button>
                         <button id="LaporkanRealisasi" class="btn btn-primary btn-sm padding-20" rel="tooltip" title="Laporkan Realisasi" data-placement="bottom">
                        <i class="icon-file"></i>
                        Laporkan Perencanaan SKP
                            </button>

                        </div>

                </form> 


                     </div>
                    
                    
<?php }
else 
    { ?>
  <div class="table-responsive">  
  <table id=""  class="table">
   <tr>
     <td class="center">
           Anda Tidak Memiliki Perencanaan SKP
     <td>
   </tr>
   <tr>
    <td>
     <form method="post" action="<?php echo $post; ?>">
       <div>
       <button class="btn btn-primary btn-sm padding-20"  data-dismiss="modal" name="new"  id="new">Buat Perencanaan Baru
       </button>
       <input  type="hidden" size="30" name="status" value="1" id="status" />        
       </div>
     </form> 
    </td>
   </tr>
   <?php }?>
  </table>
  </div>

            </div>
            </div>
       </div>
    <br>
    <br>
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
                                          <div class="col-xs-12 col-sm-5">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="hidden" id="id_jabatan" name="id_jabatan" class="width-80-uppercase" readonly="readonly" value="<?php echo $id_jabatan; ?>"/>
                                                            <input type="text" id="" name="" size="27" readonly="readonly" value="<?php echo $jabatan; ?>"/>
                                                            <i id="nama_remove_sign" class="icon-remove-sign hidden"></i>
                                                        </span>
                                         </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nama Kegiatan</label>
                                        <div class="col-sm-8">
                                            <input  type="text" size="30" rel="tooltip" title="nama Kegiatan"   id="kegiatan" placeholder="Nama Kegiatan"  /> <span style="font-size:12px; color:red;">*</span> <br>


                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Satuan Kuantitas </label>
                                        <div class="col-sm-8">
                                            <input  type="text" size="30" id="satuan_kuantitas1" name="satuan_kuantitas1"  rel="tooltip" maxlength="11" title="Satuan satuan_kuantitas" onkeyup="return satuan_kuantitas();" placeholder="satuan_kuantitas"  id="satuan_kuantitas"  />   
                                            <span style="font-size:12px; color:red;">*</span>  <br>
                                        </div>
                                </div>	
                        </div>
                 </div>

                            <div class="modal-footer">
                                <button class="btn btn-sm btn-primary" rel="tooltip" title="Tambah" id="simpan"> <i class="icon-plus"></i>Tambah</button>
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




<?php $this->load->view('vfooter'); ?>
                <script src="<?= base_url() ?>/assets/js/jquery.dataTables.min.js"></script>
		<script src="<?= base_url() ?>/assets/js/jquery.dataTables.bootstrap.js"></script>

                <script type="text/javascript">
      
                    $("#tambahkegiatan").on("show", function() { // wire up the OK button to dismiss the modal when shown
                    $("#tambahkegiatan a.btn").on("click", function(e) {
                    console.log("button pressed"); // just as an example...
                    $("#tambahkegiatan").modal('hide'); // dismiss the dialog
                    });
                    });
                </script>
                
                <script type="text/javascript">
                    $(document).ready(function(){
                    $("#simpan").click(function(){
                      
                    var kegiatan=$("#kegiatan").val();
                    var id_jabatan=$("#id_jabatan").val();
                    var satuan_kuantitas=$("#satuan_kuantitas1").val();
                
                 
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
                          url:siteUrl+'/skp/simpanKegiatan',
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
<?php echo $jsArray; ?>
function changeValue(id){
document.getElementById('satuan_kuantitas').value = prdName[id].name;
};
</script>
