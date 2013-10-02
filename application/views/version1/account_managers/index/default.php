			<div class="panel panel-default">
				<div class="panel-body">
					<h2 class="panel-title"><?php echo lang('projects_projects_overview');?></h2>
					<br />
					<ul class="list-unstyled">
						<li><?php echo lang('projects_total');?>: 42</li>
						<li><?php echo lang('projects_closed');?>: 42</li>
						<li><?php echo lang('projects_ongoing');?>: 42</li>
						<li><?php echo lang('projects_lost');?>: 42</li>
					</ul>
				</div>
			</div>
			
			<div><a href="#add_new_project_modal" class="btn btn-primary btn-small" data-toggle="modal"><i class="icon-plus"></i>&nbsp;<?php echo lang('projects_add_new_project');?></a></div>
			<br />
			
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title"><?php echo lang('projects_project_list');?></h2>
				</div>
				<div class="panel-body">
					
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th><?php echo lang('projects_project_name');?></th>
								<th><?php echo lang('projects_client');?></th>
								<th><?php echo lang('projects_status');?></th>
								<th><?php echo lang('projects_date_filed');?></th>
								<th><?php echo lang('projects_action');?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>Anchor Home Chef 2014 - Media</td>
								<td>Anchor Butter</td>
								<td>Waiting for Signed CE</td>
								<td>16-Jul-13</td>
								<td>
									<a href="<?php echo site_url('projects/edit');?>" class="tip btn btn-primary btn-small" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo lang('projects_edit_project');?>" title="<?php echo lang('projects_edit_project');?>"><i class="icon-pencil"></i></a>
									<a href="<?php echo site_url('projects/delete');?>" class="tip btn btn-primary btn-small" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo lang('projects_delete_project');?>" title="<?php echo lang('projects_delete_project');?>"><i class="icon-trash"></i></a>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td>Anchor Home Chef 2014 - Media</td>
								<td>Anchor Butter</td>
								<td>Waiting for Signed CE</td>
								<td>16-Jul-13</td>
								<td>
									<a href="<?php echo site_url('projects/edit');?>" class="tip btn btn-primary btn-small" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo lang('projects_edit_project');?>" title="<?php echo lang('projects_edit_project');?>"><i class="icon-pencil"></i></a>
									<a href="<?php echo site_url('projects/delete');?>" class="tip btn btn-primary btn-small" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo lang('projects_delete_project');?>" title="<?php echo lang('projects_delete_project');?>"><i class="icon-trash"></i></a>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>Anchor Home Chef 2014 - Media</td>
								<td>Anchor Butter</td>
								<td>Waiting for Signed CE</td>
								<td>16-Jul-13</td>
								<td>
									<a href="<?php echo site_url('projects/edit');?>" class="tip btn btn-primary btn-small" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo lang('projects_edit_project');?>" title="<?php echo lang('projects_edit_project');?>"><i class="icon-pencil"></i></a>
									<a href="<?php echo site_url('projects/delete');?>" class="tip btn btn-primary btn-small" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo lang('projects_delete_project');?>" title="<?php echo lang('projects_delete_project');?>"><i class="icon-trash"></i></a>
								</td>
							</tr>
						</tbody>
					</table>
					
				</div>
			</div>
			
			<!-- Modal Add New Project -->
			<div id="add_new_project_modal" class="modal fade" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					<div class="modal-content">
					
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title"><?php echo lang('projects_add_new_project');?></h4>
						</div>
						
						<div class="modal-body">
							asdadsa
						</div>
						
					</div>
				</div>
			</div>