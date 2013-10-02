<?php echo $breadcrumbs;?>
<div id="users" class="global-wrap users">
	<div class="global-header"><h3><?php echo lang('users_users');?></h3></div>
	<div class="global-content">
		<?php echo form_open_multipart(current_url());?>
		<?php echo form_hidden($user_hidden);?>
		
		<div class="global-content-left">
			<h4><?php echo (!$user_edit ? lang('users_add_user_project_name') : lang('users_edit_user'));?></h4>
		
			<div style="width:318px;">
				<?php echo ($action_success ? '<div class="success"><p>'.$action_success.'</p></div>' : null);?>
				<?php echo ($action_error ? '<div class="alert"><p>'.$action_error.'</p></div>' : null);?>
				<?php echo (validation_errors() ? '<div class="notice">'.validation_errors().'</div>' : null); ?>
				
				<?php if (!$user_edit): ?>
				<div class="required"><?php echo form_input($user_username); ?></div>
				<?php endif; ?>
				
				<div <?php echo (!$user_edit ? ' class="required"' : ' class="optional"');?>><?php echo form_password($user_password); ?></div>
				<div <?php echo (!$user_edit ? ' class="required"' : ' class="optional"');?>><?php echo form_password($user_confirm_password); ?></div>
				
				<div class="required"><?php echo form_input($user_name); ?></div>
				<div class="required"><?php echo form_input($user_email); ?></div>
				
				<?php if ($show_user_logo) : ?>
				<div>
					<p><strong><?php echo lang('users_logo');?></strong> (<?php echo lang('users_logo_validations');?>)</p>
					<div<?php #echo (!$user_edit ? ' class="required"' : null);?>><?php echo form_upload($user_logo);?></div>
				</div>
				<?php endif; ?>
				
				<?php if ($show_radios) : ?>
					<?php if ($show_user_type_choices) : ?>
					<div>
						<p><strong><?php echo lang('users_type');?></strong></p>
						<?php echo form_radio($user_type_user).form_label(lang('users_type_user'),'user_type_user'); ?>
						<?php echo form_radio($user_type_admin).form_label(lang('users_type_admin'),'user_type_admin'); ?>
					</div>
					<?php endif; ?>
					
					<div id="user_options">
						<?php if ($show_user_active_choices) : ?>
						<div>
							<p><strong><?php echo lang('users_active');?></strong></p>
							<?php echo form_radio($user_active_yes).form_label(lang('users_yes'),'user_active_yes'); ?>
							<?php echo form_radio($user_active_no).form_label(lang('users_no'),'user_active_no'); ?>
						</div>
						<?php endif; ?>
						
						<?php if ($show_user_notify) : ?>
						<div><?php echo (!$user_edit ? form_checkbox($user_notify).form_label(lang('users_notify_user'),'user_notify') : null); ?></div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<div><?php echo nbs(1);?></div>
				<div><?php echo form_submit('submit',(!$user_edit ? lang('users_add_user') : lang('users_save_changes')));?></div>
			</div>
		</div>
		
		<?php if ($show_permission) : ?>
		<div class="global-content-right shadowbox" id="user_permissions">
			<div class="global-content-header"><b><?php echo lang('users_permissions');?></b></div>
			<div class="global-content-content">
				<div>
					<p><strong><?php echo lang('users_manage_folders');?></strong></p>
					<ul>
						<li><?php echo form_checkbox($user_manage_folders_administer).form_label(lang('users_manage_folders_administer'),'user_manage_folders_administer');?></li>
						<li><?php echo form_checkbox($user_manage_folders_permission).form_label(lang('users_manage_folders_permission'),'user_manage_folders_permission');?></li>
						<li><?php echo form_checkbox($user_manage_folders_file_types).form_label(lang('users_manage_folders_file_types'),'user_manage_folders_file_types');?></li>
					</ul>
				</div>
				<div>
					<p><strong><?php echo lang('users_manage_files');?></strong></p>
					<ul>
						<li><?php echo form_checkbox($user_manage_files_administer).form_label(lang('users_manage_files_administer'),'user_manage_files_administer');?></li>
						<li><?php echo form_checkbox($user_manage_files_permission).form_label(lang('users_manage_files_permission'),'user_manage_files_permission');?></li>
					</ul>
				</div>
			</div>
		</div>
		<?php endif; ?>
		
		<div class="clear"></div>
		
		<?php echo form_close();?>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	if ($("#user_password")[0])
	{
		$("#user_password").password_strength();
	}
	if ($("#user_type_user")[0])
	{
		$("#user_type_user").click(function() {
			if ($(this).is(":checked"))
			{
				$("#user_permissions").fadeIn("slow");
				$("#user_options").slideDown();
			}
		});
	}
	if ($("#user_type_admin")[0])
	{
		$("#user_type_admin").click(function() {
			if ($(this).is(":checked"))
			{
				$("#user_permissions").fadeOut("slow");
				$("#user_options").slideUp();
			}
		});
	}
});
</script>