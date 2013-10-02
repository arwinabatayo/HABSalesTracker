	<!-- Page Layout -->
	<div class="modal" style="display:inline;">
		
		<div class="modal-dialog login">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title"><?php echo lang('login_login');?></h3>
				</div>
				<div class="modal-body">
				
					<?php echo ($action_error ? '<div class="alert alert-danger">'.$action_error.'</div>' : null);?>
					<?php echo (validation_errors() ? '<div class="alert alert-warning">'.validation_errors().'</div>' : null); ?>
					
					<?php echo form_open(site_url('login'),array('role' => 'form'));?>
						
						<div class="form-group required">
							<label for="<?php echo $login_email['id'];?>"><?php echo lang('login_email_address');?></label>
							<?php echo form_input($login_email); ?>
						</div>
						
						<div class="form-group required">
							<label for="<?php echo $login_password['id'];?>"><?php echo lang('login_password');?></label>
							<?php echo form_input($login_password); ?>
						</div>
						
						<br />
						
						<?php echo form_submit('submit',lang('login_submit'),'class="btn btn-primary btn-block"');?>
						
					<?php echo form_close();?>
					
				</div>
			</div>
		</div>
		
	</div>
	<div class="modal-backdrop fade in"></div>
	<!-- Page Layout -->