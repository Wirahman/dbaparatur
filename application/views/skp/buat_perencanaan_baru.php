	<?php $this->load->view('vheader'); ?>
    
	<div class="widget-header"><h5> <i class="icon-user"></i> PERENCANAAN SKP</h5></div>
	<div class="widget-body">
		<span id="form_error" style="color:red;"></span>
		<div class="row">
			<div class="col-xs-12">
				<div class="table-responsive">  
					<table id="" class="table">
						<tr>
							<td class="center">
							   Anda Tidak Memiliki Perencanaan SKP
							<td>
						</tr>
						<tr>
							<td>
								<form method="post">
								   <div class='form-group'>
										<label>Tahun SKP&nbsp;&nbsp;</label>
										<select id="tahun" name="tahun" class="select2style">
											<?php
											$tahun = (date("m") == "12") ? date("Y") + 1 : date("Y"); 		
											for($t=date("Y");$t<= date("Y")+1;$t++) {
												$selected = ($t == $tahun) ? "selected" : "";
												echo '<option value="'. $t . '"' . $selected. '>' . $t . '</option>';
											}
											?>
										</select>
										&nbsp;&nbsp;
									   <button class="btn btn-primary btn-sm padding-20" name="new"  id="new">Buat Perencanaan Baru</button>
									   <input type="hidden" size="30" name="status" value="1" id="status"/>        
								   </div>
								</form> 
							</td>
						</tr>
					</table>
				</div>
			</div>
        </div>
	</div>
	<?php $this->load->view('vfooter'); ?>
