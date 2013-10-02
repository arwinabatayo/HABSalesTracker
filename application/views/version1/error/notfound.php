<div class="container page">
	<div class="jumbotron">
		<div class="container text-center">
			<h1><?php echo lang('error_page_not_found');?></h1>
			<div>
				<?php echo lang('error_error_404');?>
				<br />
				<a href="<?php echo site_url($this->session->userdata('is_page'));?>" class="btn btn-primary btn-lg"><i class="icon-hand-left"></i>&nbsp;&nbsp;<?php echo lang('error_send_me_back');?></a>
			</div>
		</div>
	</div>
</div>