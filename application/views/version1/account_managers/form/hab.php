 			<?php if ($is_ajax): ?>
			
			<div id="ajax-form-<?php echo $ajax_session_id;?>" class="ajax-wrapper">
				<div id="ajax-error-<?php echo $ajax_session_id;?>"></div>
				
				<?php echo form_open(site_url('account_managers/add'),array('role' => 'form','id' => 'form-'.$ajax_session_id));?>
								
				<div class="form-group required">
					<label for="<?php echo $account_manager_name['id'];?>"><?php echo lang('account_managers_name');?></label>
					<?php echo form_input($account_manager_name); ?>
				</div>
								
				<div class="form-group required">
					<label for="<?php echo $account_manager_department['id'];?>"><?php echo lang('account_managers_department');?></label>
					<select name="<?php echo $account_manager_department['name'];?>" id="<?php echo $account_manager_department['id'];?>" class="form-control">
						<option value="agency"><?php echo lang('global_agency');?></option>
						<option value="altitude"><?php echo lang('global_altitude');?></option>
						<option value="gondola"><?php echo lang('global_gondola');?></option>
						<option value="burner"><?php echo lang('global_burner');?></option>
						<option value="envelope"><?php echo lang('global_envelope');?></option>
					</select>
				</div>
				
				<br />
				
				<div class="text-right">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<?php echo form_submit('submit',lang('account_managers_submit'),'class="btn btn-primary"');?>
				</div>
								
				<?php echo form_close();?>
			</div>
			
			<?php echo script_tag(TEMPLATES_DIR.VERSION_DIR.JS_DIR.'jquery.formvalidation.js');?>
			<script type="text/javascript">
			$(document).ready(function() {
				$('#form-<?php echo $ajax_session_id;?>').submit(function(e){
					if (validationPass) {
						errorPass = false;
						$.ajax({
							type: 'post',
							url: $('#form-<?php echo $ajax_session_id;?>').attr('action'),
							data: {
								'<?php echo $account_manager_name['id'];?>': $('#<?php echo $account_manager_name['id'];?>').val(),
								'<?php echo $account_manager_department['id'];?>': $('#<?php echo $account_manager_department['id'];?>').val(),
							},
							dataType: 'json',
							beforeSend: function() {
								$('<div/>', {
									id: "append-<?php echo $ajax_session_id;?>",
									class: 'append-ajax',
									html: '<img src="<?php echo TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR;?>ajax-loader.gif" /><br /><p><?php echo lang('global_loading');?></p>',
								}).appendTo($('#ajax-form-<?php echo $ajax_session_id;?>')).fadeIn(500);
							},
							success: function(data) {
								alert('success');
								errorPass = true;
							},
							complete: function() {
								$('#append-<?php echo $ajax_session_id;?>').remove();
								if (errorPass){
									$("#add_new_project_manager").modal('hide');
									window.location.href = '<?php echo site_url('account_managers');?>';
								}
							},
							error: function (xhr, ajaxOptions, thrownError) {
								alert('Error: (' + xhr.status + ' ' + thrownError + ')');
							},
						});
					}
					e.preventDefault();
					return false;
				});
			});
			</script>
			
			<?php else: ?>
			
			<h1><?php echo lang('account_managers_account_managers');?></h1>
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title"><?php echo lang('account_managers_add_new_account_manager');?></h4>
				</div>
				<div class="panel-body">
			
					<?php echo ($action_error ? '<div class="alert alert-danger">'.$action_error.'</div>' : null);?>
					<?php echo (validation_errors() ? '<div class="alert alert-warning">'.validation_errors().'</div>' : null); ?>
					
					<?php echo form_open(site_url('account_managers/add'),array('role' => 'form'));?>
									
					<div class="form-group required">
						<label for="<?php echo $account_manager_name['id'];?>"><?php echo lang('account_managers_name');?></label>
						<?php echo form_input($account_manager_name); ?>
					</div>
									
					<div class="form-group required">
						<label for="<?php echo $account_manager_department['id'];?>"><?php echo lang('account_managers_department');?></label>
						<select name="<?php echo $account_manager_department['name'];?>" id="<?php echo $account_manager_department['id'];?>" class="form-control">
							<option value="agency"><?php echo lang('global_agency');?></option>
							<option value="altitude"><?php echo lang('global_altitude');?></option>
							<option value="gondola"><?php echo lang('global_gondola');?></option>
							<option value="burner"><?php echo lang('global_burner');?></option>
							<option value="envelope"><?php echo lang('global_envelope');?></option>
						</select>
					</div>
					
					<div class="text-right">
						<?php echo form_submit('submit',lang('account_managers_submit'),'class="btn btn-primary"');?>
					</div>
									
					<?php echo form_close();?>
				</div>
			</div>
			
			<?php endif; ?>