	<?php $this->load->view('vheader'); ?>
    
	<div class="widget-body">
		<p>
		<div class="alert alert-block alert-danger">
		<button type="button" class="close" data-dismiss="alert">
			<i class="icon-remove"></i>
		</button>
		<p>
			<strong>
				<i class="icon-remove"></i>
			</strong>
			&nbsp;
			ERROR: <?php echo $error;?>
		</p>
	</div>
	</div>
	<?php $this->load->view('vfooter'); ?>
