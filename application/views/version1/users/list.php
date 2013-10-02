<?php echo $breadcrumbs;?>
<div id="users" class="global-wrap users">
	<div class="global-header"><h3><?php echo lang('users_users');?></h3></div>
	<div class="global-content">
		<?php echo ($action_success ? '<div class="success"><p>'.$action_success.'</p></div>' : null);?>
		<?php echo ($action_error ? '<div class="alert"><p>'.$action_error.'</p></div>' : null);?>
		
		<div><?php echo anchor(site_url('users/add'),img(base_url().TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR.'add.png').nbs(1).lang('users_add_user'))?></div>
		<br />
		<div class="tabs">
			<ul class="idTabs">
				<li><?php echo anchor(site_url('users#user'),lang('users_type_user'));?></li>
				<li><?php echo anchor(site_url('users#admin'),lang('users_type_admin'));?></li>
			</ul>
			<div class="clear"></div>
		</div> 
		<div class="shadowbox">
			<div id="user">
				<table cellpadding="0" cellspacing="0" class="itemsTable">
					<thead>
						<tr>
							<th style="width:285px;"><?php echo lang('users_name');?></th>
							<th style="width:284px;"><?php echo lang('users_email');?></th>
							<th style="width:40px;"><?php echo lang('users_active');?></th>
							<th style="width:87px;"><?php echo lang('users_member_since');?></th>
							<th style="width:85px;"><?php echo lang('users_last_updated');?></th>
							<th style="width:82px;"><?php echo lang('users_actions');?></th>
						</tr>
					</thead>
					<?php if (count($allUsers)) { ?>
					<tbody>
						<?php foreach ($allUsers as $key => $value) : ?>
						<tr>
							<td><?php echo anchor(site_url('users/view/'.$allUsers[$key]->id),($allUsers[$key]->photo && $allUsers[$key]->photo_ext && file_exists(MAINPATH.AVATARS_DIR.$allUsers[$key]->photo.$allUsers[$key]->photo_ext) ? img(base_url().AVATARS_DIR.$allUsers[$key]->photo.'_small'.$allUsers[$key]->photo_ext) : img(base_url().AVATARS_DIR.'no_image_small.jpg')).nbs(2).$allUsers[$key]->name);?></td>
							<td><?php echo anchor(site_url('users/view/'.$allUsers[$key]->id),$allUsers[$key]->email);?></td>
							<td><?php echo anchor(site_url('users/view/'.$allUsers[$key]->id),img(base_url().TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR.($allUsers[$key]->active == "true" ? 'check.png' : 'uncheck.png')));?></td>
							<td><?php echo anchor(site_url('users/view/'.$allUsers[$key]->id),date('M/d/Y',strtotime($allUsers[$key]->created)));?></td>
							<td><?php echo anchor(site_url('users/view/'.$allUsers[$key]->id),date('M/d/Y',strtotime($allUsers[$key]->modified)));?></td>
							<td><?php echo anchor(site_url('users/edit/'.$allUsers[$key]->id),img(base_url().TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR.'edit.png').nbs(1).lang('users_edit'),array('onclick' => 'if(confirm(\''.sprintf(lang('users_edit_user_confirm'),$allUsers[$key]->name).'\')){return true;}else{return false;}'));?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<?php } else { ?>
					<tbody>
						<tr>
							<td colspan="9"><?php echo lang('users_no_user_data_error');?></td>
						</tr>
					</tbody>
					<?php } ?>
				</table>
			</div>
			<div id="admin">
				<table cellpadding="0" cellspacing="0" class="itemsTable">
					<thead>
						<tr>
							<th style="width:285px;"><?php echo lang('users_name');?></th>
							<th style="width:284px;"><?php echo lang('users_email');?></th>
							<th style="width:40px;"><?php echo lang('users_active');?></th>
							<th style="width:87px;"><?php echo lang('users_member_since');?></th>
							<th style="width:85px;"><?php echo lang('users_last_updated');?></th>
							<th style="width:82px;"><?php echo lang('users_actions');?></th>
						</tr>
					</thead>
					<?php if (count($allAdmins)) { ?>
					<tbody>
						<?php foreach ($allAdmins as $key => $value) : ?>
						<tr>
							<td><?php echo anchor(site_url('users/view/'.$allAdmins[$key]->id),($allAdmins[$key]->photo && $allAdmins[$key]->photo_ext && file_exists(MAINPATH.AVATARS_DIR.$allAdmins[$key]->photo.$allAdmins[$key]->photo_ext) ? img(base_url().AVATARS_DIR.$allAdmins[$key]->photo.'_small'.$allAdmins[$key]->photo_ext) : img(base_url().AVATARS_DIR.'no_image_small.jpg')).nbs(2).$allAdmins[$key]->name);?></td>
							<td><?php echo anchor(site_url('users/view/'.$allAdmins[$key]->id),$allAdmins[$key]->email);?></td>
							<td><?php echo anchor(site_url('users/view/'.$allAdmins[$key]->id),img(base_url().TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR.($allAdmins[$key]->active == "true" ? 'check.png' : $image_url.'uncheck.png')));?></td>
							<td><?php echo anchor(site_url('users/view/'.$allAdmins[$key]->id),date('M/d/Y',strtotime($allAdmins[$key]->created)));?></td>
							<td><?php echo anchor(site_url('users/view/'.$allAdmins[$key]->id),date('M/d/Y',strtotime($allAdmins[$key]->modified)));?></td>
							<td><?php echo anchor(site_url('users/edit/'.$allAdmins[$key]->id),img(base_url().TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR.'edit.png').nbs(1).lang('users_edit'),array('onclick' => 'if(confirm(\''.sprintf(lang('users_edit_user_confirm'),$allAdmins[$key]->name).'\')){return true;}else{return false;}'));?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<?php } else { ?>
					<tbody>
						<tr>
							<td colspan="9"><?php echo lang('users_no_admin_data_error');?></td>
						</tr>
					</tbody>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
</div>