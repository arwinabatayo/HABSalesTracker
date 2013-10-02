<?php echo $breadcrumbs;?>
<div id="users" class="global-wrap users">
	<div class="global-header"><h3><?php echo lang('users_users');?></h3></div>
	<div class="global-content">
		<?php echo ($action_success ? '<div class="success"><p>'.$action_success.'</p></div>' : null);?>
		<?php echo ($action_error ? '<div class="alert"><p>'.$action_error.'</p></div>' : null);?>
		
		<h4><?php echo $header_text;?></h4>
		
		<div>
			<?php
			echo ($userRequest[0]->photo && $userRequest[0]->photo_ext && file_exists(MAINPATH.AVATARS_DIR.$userRequest[0]->photo.'_big'.$userRequest[0]->photo_ext) ? img(array('src' => base_url().AVATARS_DIR.$userRequest[0]->photo.'_big'.$userRequest[0]->photo_ext,'class' => 'left','style' => 'margin-right:10px;margin-bottom:25px;')) : img(array('src' => base_url().AVATARS_DIR.'no_image_big.jpg','class' => 'left','style' => 'margin-right:10px;margin-bottom:25px;')));
			echo ($show_username ? '<p>'.lang('users_username').':'.nbs(1).$userRequest[0]->username.'</p>' : null);
			echo '<p>'.lang('users_member_since').':'.nbs(1).date('M/d/Y',strtotime($userRequest[0]->created)).'</p>';
			echo '<p>'.lang('users_email').':'.nbs(1).$userRequest[0]->email.'</p>';
			echo '<p>'.lang('users_active').':'.nbs(1).($userRequest[0]->active === 'true' ? "Yes" : "No").'</p>';
			?>
			<?php if ($show_edit_button || $show_delete_button): ?>
			<div class="clear"">
				<div>
					<div class="left" style="padding-right:10px;"><?php echo form_button(array('id' => 'edit_user','value' => $userRequest[0]->id,'content' => lang('users_edit')));?></div>
					<?php if ($show_delete_button): ?>
					<div class="left" style="padding-right:10px;"><?php echo form_button(array('id' => 'delete_user','value' => $userRequest[0]->id,'content' => lang('users_delete')));?></div>
					<?php endif; ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php endif; ?>
		</div>
		
		<?php echo br(2);?>
		
		<?php if ($show_permission): ?>
		<div style="float:left;width:471px;margin-right:10px;" class="shadowbox">
			<div class="global-content-header"><b><?php echo lang('users_permissions');?></b></div>
			<div class="global-content-content">
				<div>
					<p><strong><?php echo lang('users_manage_folders');?></strong></p>
					<ul>
						<li><?php echo ($userRequest[0]->manage_folders_administer === 'true' ? img(base_url().TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR.'check.png') : img(base_url().TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR.'uncheck.png')).nbs(1).lang('users_manage_folders_administer');?></li>
						<li><?php echo ($userRequest[0]->manage_folders_permission === 'true' ? img(base_url().TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR.'check.png') : img(base_url().TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR.'uncheck.png')).nbs(1).lang('users_manage_folders_permission');?></li>
						<li><?php echo ($userRequest[0]->manage_folders_file_types === 'true' ? img(base_url().TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR.'check.png') : img(base_url().TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR.'uncheck.png')).nbs(1).lang('users_manage_folders_file_types');?></li>
					</ul>
				</div>
				<div>
					<p><strong><?php echo lang('users_manage_files');?></strong></p>
					<ul>
						<li><?php echo ($userRequest[0]->manage_files_administer === 'true' ? img(base_url().TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR.'check.png') : img(base_url().TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR.'uncheck.png')).nbs(1).lang('users_manage_files_administer');?></li>
						<li><?php echo ($userRequest[0]->manage_files_permission === 'true' ? img(base_url().TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR.'check.png') : img(base_url().TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR.'uncheck.png')).nbs(1).lang('users_manage_files_permission');?></li>
					</ul>
				</div>
			</div>
		</div>
		<?php endif; ?>
		
		<?php if ($show_logs): ?>
		<div style="float:left;width:471px;" class="shadowbox">
			<div class="global-content-header"><b><?php echo lang('users_recent_logs');?></b></div>
			<div class="clear" id="userLogStats">
				<table cellpadding="0" cellspacing="0" class="itemsTable">
					<thead>
						<tr>
							<th style="width:405px;"><?php echo lang('users_log_action');?></th>
							<th style="width:118px;"><?php echo lang('users_log_time_activity');?></th>
						</tr>
					</thead>
					<tbody>
					<?php if (count($userRequestLogs)): ?>
						<?php foreach ($userRequestLogs as $k => $v): ?>
						<tr>
							<?php if ($userRequestLogs[$k]->target_user_id && !$userRequestLogs[$k]->target_folder_id && !$userRequestLogs[$k]->target_file_id && !$userRequestLogs[$k]->target_note_id) { ?>
							<td><?php echo sprintf(lang($userRequestLogs[$k]->log_label),$userRequestLogs[$k]->target_user_id,$userRequestLogs[$k]->target_user_name);?></td>
							
							<?php } else if ($userRequestLogs[$k]->target_user_id && $userRequestLogs[$k]->target_folder_id && !$userRequestLogs[$k]->target_file_id && !$userRequestLogs[$k]->target_note_id) { ?>
							<td><?php echo sprintf(lang($userRequestLogs[$k]->log_label),$userRequestLogs[$k]->target_user_id,$userRequestLogs[$k]->target_folder_id,$userRequestLogs[$k]->target_folder_name);?></td>
							
							<?php } else if ($userRequestLogs[$k]->target_user_id && $userRequestLogs[$k]->target_folder_id && $userRequestLogs[$k]->target_file_id && !$userRequestLogs[$k]->target_note_id) { ?>
							<td><?php echo sprintf(lang($userRequestLogs[$k]->log_label),$userRequestLogs[$k]->target_file_name,$userRequestLogs[$k]->target_user_id,$userRequestLogs[$k]->target_folder_id,$userRequestLogs[$k]->target_folder_name);?></td>
							
							<?php } else if ($userRequestLogs[$k]->target_user_id && ($userRequestLogs[$k]->target_folder_id || $userRequestLogs[$k]->target_file_id) && $userRequestLogs[$k]->target_note_id) { ?>
								
								<?php if ($userRequestLogs[$k]->target_folder_id) { ?>
								<td><?php echo sprintf(lang($userRequestLogs[$k]->log_label),$userRequestLogs[$k]->target_user_id,$userRequestLogs[$k]->target_folder_id,$userRequestLogs[$k]->target_note_id);?></td>
								
								<?php } else if ($userRequestLogs[$k]->target_file_id) { ?>
								<td><?php echo sprintf(lang($userRequestLogs[$k]->log_label),$userRequestLogs[$k]->target_user_id,$userRequestLogs[$k]->target_file_id,$userRequestLogs[$k]->target_note_id);?></td>
								
								<?php } ?>
								
							<?php } else { ?>
								<td><?php echo sprintf(lang($userRequestLogs[$k]->log_label));?></td>
								
							<?php } ?>
							<td><?php echo sprintf(lang('site_log_label_timespan'),timespan($userRequestLogs[$k]->time_activity,time()));?></td>
						</tr>
						<?php endforeach; ?>
					<?php else: ?>
						<tr>
							<td colspan="2"><?php echo lang('site_no_logs_data_error');?></td>
						</tr>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php endif; ?>
		
		<div class="clear"></div>
		
		<?php if ($show_folders_files): ?>
		<?php echo br(1);?>
		<div class="shadowbox">
			<div class="global-content-header"><b><?php echo lang('users_folders_files');?></b></div>
			<div class="global-content-content">
				<?php echo ul($userRequestFoldersFiles,array('id' => 'user_folders','class' => 'filetree'));?>
			</div>
		</div>
		<?php endif; ?>
		
	</div>
</div>
<?php if ($show_edit_button): ?>
<script type="text/javascript">
$(document).ready(function(){
	if ($("#edit_user")[0])
	{
		$("#edit_user").click(function(){
			if (confirm("<?php echo $lang_edit_confirm;?>"))
			{
				location.href="<?php echo site_url('users/edit');?>/" + $(this).val();
			}
		});
	}
	if ($("#delete_user")[0])
	{
		$("#delete_user").click(function(){
			if (confirm("<?php echo $lang_delete_confirm;?>"))
			{
				location.href="<?php echo site_url('users/delete');?>/" + $(this).val();
			}
		});
	}
	if ($("#user_folders")[0])
	{
		$("#user_folders").treeview({animated: "fast"});
	}
});
</script>
<?php endif; ?>