<?php $this->load->view('vheader'); ?>
    <script src="<?= base_url() ?>assets/js/select2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery_form.js"></script>
    <script language="text/javascript">
<script src="<?=base_url()?>assets/liscroll/jquery.li-scroller.1.0.js"></script>
    <script type="text/javascript">
          $(document).ready(function() { 
              $("#nama_kegiatan").select2()

    });
    
</script>

<div class="widget-header"><h5> <i class="icon-user"></i> PERENCANAAN SKP</h5></div>
<div class="widget-body">
    <span id="form_error" style="color:red;"></span>

    <div class="row">
      <div class="col-xs-12">

            <div class="table-header" align="center">  
                   FORMULIR SASARAN KERJA PEGAWAI NEGERI SIPIL       
            </div>
          
            <div class="table-responsive">     
            <table id="sample-table-1"  class="table table-striped table-bordered table-hover">
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
                    <td align="center"></td>    
                    <td align="center">1</td>
                    <td align="left" width="15%" >Nama</td> 
                    <td colspan="5" align="center"></td>   
            </tr>
           
                <tr>
                    <td align="center">2</td>
                    <td align="left" width="15%">NIP</td>
                    <td align="center"></td>    
                    <td align="center">2</td>
                    <td align="left" width="15%">NIP</td> 
                    <td colspan="5" align="left"><b><?= $this->session->userdata('nip') ?></b></td>  
                </tr>
                <tr>
                    <td align="center">3</td>
                    <td align="left" width="15%">Pangkat/Gol.Ruang</td>
                    <td align="center"></td>    
                    <td align="center">3</td>
                    <td align="left" width="15%">Pangkat/Gol.Ruang</td> 
                    <td colspan="5" align="center"></td>  
                </tr>

                <tr>
                    <td align="center">4</td>
                    <td align="left" width="15%">Jabatan</td>
                    <td align="center"></td>    
                    <td align="center">4</td>
                    <td align="left" width="15%">Jabatan</td> 
                    <td colspan="5" align="center"></td>   

                </tr>
                <tr>
                    <td align="center">5</td>
                    <td align="left" width="15%">Unit Kerja</td>
                    <td align="center"></td>    
                    <td align="center">5</td>
                    <td align="left" width="15%">Unit Kerja</td> 
                    <td colspan="5" align="center"></td>   
                </tr>
            </table>
         </div>
   
          
<div class="widget-header"><h5> <i class="icon-user"></i> INPUT SKP</h5></div>  

<div class="table-responsive">   
<form method="post" action="perencanaanSkp">  
<table id=""  class="table table-striped table-bordered table-hover">
     <thead>
              <tr>
                <th width="5%" class="center" rowspan="2">NO</th>
                <th class="left" rowspan="2">KEGIATAN TUGAS JABATAN</th>
                <th class="center" rowspan="2">AK</th>
                <th class="center" colspan="4">TARGET</th>
                <th class="center" rowspan="2">Action</th>
              </tr>
       </thead>
       <thead>
            <tr>  
                <th class="center" width="2%" ></th>
                <th align="left"></th>
                <th align="left"></th>
                <th align="center">Kuant/ Output</th>
                <th align="center">Kual/Mutu</th>
                <th align="center">Waktu</th>
                <th align="left">Biaya</th>      
            </tr>
       </thead>
       
<?php
	$list = explode("-", $parameter);
        $j=1; 
	//print_r($list); //for debuging
	//echo '<br> ini parameternya '. $parameter;	
	for($i=1;$i<count($list);$i+=7){
?>
<tbody> 
  <tr>
    <td><input name="textfield" type="text" id="textfield"  size="2"   value="<?php echo $list[$i]?> <?php echo $j;?>"  readonly /></td>
    <td><input name="textfield2" type="text" id="textfield2" size="20" value="<?php echo $list[$i+1] ?>" readonly /></td>
    <td><input name="textfield3" type="text" id="textfield3"  size="5"   value="<?php echo $list[$i+2] ?>"  readonly /></td>
    <td><input name="textfield4" type="text" id="textfield4" size="10"   value="<?php echo $list[$i+3] ?>" readonly /></td>
    <td><input name="textfield5" type="text" id="textfield5" size="10"  value="<?php echo $list[$i+4] ?>"  readonly /></td>
    <td><input name="textfield6" type="text" id="textfield6" size="10"  value="<?php echo $list[$i+5] ?>"  readonly /></td>
    <td><input name="textfield7" type="text" id="textfield7" size="10"  value="<?php echo $list[$i+6] ?>"  readonly /></td>
    <td>    
      <input type="hidden" name="urutan" value="<?php echo $i ?>" />
      <input type="hidden" name="parameter" value="<?php echo $parameter?>" />
      <input type="submit" name="hapus" id="hapus" value="Hapus" />
    </td>
  </tr>
</tbody> 
<?php	
   $j++; 
	}
      
    
?>

<tbody
<tr>   
	<td class="center">
             <input name="data1" type="hidden"  id="data1" size="2" readonly dautocomplete="off"/>
	</td>
	<td>
          <div class="col-sm-6">
                <select id="nama_kegiatan" name ="nama_kegiatan" tyle="width: 200px;">
                                <option value='' selected='selected'> -- Pilih Kegiatan -- </option>
                        <?php foreach($nama_kegiatan->result() as $opt)
                             echo "<option value='".$opt->id."'> ".$opt->nama_kegiatan." </option>";
                        ?>
                          
               </select>
          </div>
	</td>
	<td>
            <input name="data3" type="text" id="data3" size="5"  autocomplete="off"/>
	</td>
        <td>
            <input name="data4" type="text" id="data4"  size="10" autocomplete="off"/>
	</td>
         <td>
            <input name="data5" type="text" id="data5" size="10" autocomplete="off"/>
	</td>
         <td>
            <input name="data6" type="text" id="data6" size="10" autocomplete="off"/>
	</td>
         <td>
            <input name="data7" type="text" id="data7" size="10" autocomplete="off"/>
	</td>
	<td>
            <input type="hidden" name="parameter" value="<?php echo $parameter?>" />
            <input type="submit" name="kirim" id="kirim" value="Tambah" />
            <input type="hidden" name="parameter" value="<?php echo $parameter?>" />
            <input type="submit" name="simpan" id="simpan" value="Simpan" />
	</td>
</tr>
</tbody>
</table>	
	
</form>
                
    
                        
                     </div>
             
    </div>
      </div>
          
      </div>
      </div>
</div>     

<br>
<br>
<div class="row">
   <div class="col-sm-12">

   </div>


<script type="text/javascript">
    /*
   function pindah(url)
   {
   window.location = url;
   }*/
</script>

<?php $this->load->view('vfooter'); ?>

