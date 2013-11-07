	<!-- Top Navbar -->
	<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
		
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><?php echo SITE_NAME;?></a>
			</div>
		
			<div class="collapse navbar-collapse navbar-responsive-collapse">
				<p class="navbar-text pull-right"><a href="<?php echo site_url('logout');?>" class="navbar-link"><i class="icon-signout"></i>&nbsp;<?php echo lang('global_log_out');?></a></p>
			</div>
		</div>
		
	</nav>
	<!-- End Top Navbar -->
	
	<!-- Page Layout -->
	<div class="container">
		<h1><?php echo lang('projects_projects');?></h1>
		
		<div class="text-right"><a href="<?php echo site_url('projects/add');?>" class="btn btn-primary project_add" data-toggle="modal"><i class="icon-plus"></i>&nbsp;<?php echo lang('projects_add_new_project');?></a></div>
		
		<br />
		
		<div>
			<ul class="nav nav-tabs" id="department_id">
				<li class="active"><a href="#agency" data-toggle="tab"><b><?php echo lang('global_agency');?></b></a></li>
				<li><a href="#altitude" data-toggle="tab"><b><?php echo lang('global_altitude');?></b></a></li>
				<li><a href="#gondola" data-toggle="tab"><b><?php echo lang('global_gondola');?></b></a></li>
				<li><a href="#burner" data-toggle="tab"><b><?php echo lang('global_burner');?></b></a></li>
				<li><a href="#envelope" data-toggle="tab"><b><?php echo lang('global_envelope');?></b></a></li>
			</ul>
		</div>
		
		<div class="tab-content">
			<!-- Agency -->
			<div class="tab-pane active" id="agency">
			
			<?php if ($project_list_agency): ?>
				<ul class="btn-group btn-group-sm pull-right">
					<li class="btn btn-default agency-filter" data-filter="<?php echo url_title(lang('projects_status_all'),'_',true);?>"><?php echo lang('projects_status_all');?></li>
					<li class="btn btn-default agency-filter" data-filter="<?php echo url_title(lang('projects_status_opportunity'),'_',true);?>"><?php echo lang('projects_status_opportunity');?></li>
					<li class="btn btn-default agency-filter" data-filter="<?php echo url_title(lang('projects_status_sent'),'_',true);?>"><?php echo lang('projects_status_sent');?></li>
					<li class="btn btn-default agency-filter" data-filter="<?php echo url_title(lang('projects_status_for_revision'),'_',true);?>"><?php echo lang('projects_status_for_revision');?></li>
					<li class="btn btn-default agency-filter" data-filter="<?php echo url_title(lang('projects_status_positive_feedback'),'_',true);?>"><?php echo lang('projects_status_positive_feedback');?></li>
					<li class="btn btn-default agency-filter" data-filter="<?php echo url_title(lang('projects_status_waiting_for_signed_ce'),'_',true);?>"><?php echo lang('projects_status_waiting_for_signed_ce');?></li>
					<li class="btn btn-default agency-filter" data-filter="<?php echo url_title(lang('projects_status_closed'),'_',true);?>"><?php echo lang('projects_status_closed');?></li>
					<li class="btn btn-default agency-filter" data-filter="<?php echo url_title(lang('projects_status_lost'),'_',true);?>"><?php echo lang('projects_status_lost');?></li>
				</ul>
				<div class="clearfix"></div>
				
				<?php
				/*
				<input type="search" id="search_agency_projects" class="form-control input-sm" placeholder="<?php echo lang('projects_search_project');?>">
				<br />
				*/
				?>
				
				<div id="agency_projects">
				<?php foreach ($project_list_agency as $k => $v): ?>
					<div class="panel panel-primary agency-project <?php echo url_title($project_list_agency[$k]->status,'_',true);?>" id="project_panel_<?php echo $project_list_agency[$k]->project_id;?>">
						<div class="panel-heading"><?php echo lang('projects_project_name');?>: <b class="project-name"><?php echo $project_list_agency[$k]->name;?></b> <p class="pull-right text-left"><?php echo lang('projects_project_budget');?>: <b class="number-format"><?php echo number_format($project_list_agency[$k]->budget);?></b></p></div>
						<div class="panel-body">
							
							<div class="row">
								<div class="col-sm-5">
									<dl class="dl-horizontal">
										<dt><?php echo lang('projects_project_name');?></dt>
										<dd><?php echo $project_list_agency[$k]->name;?></dd>
										
										<dt><?php echo lang('projects_project_code');?></dt>
										<dd><?php echo $project_list_agency[$k]->code;?></dd>
										
										<dt><?php echo lang('projects_project_budget');?></dt>
										<dd><?php echo number_format($project_list_agency[$k]->budget);?></dd>
										
										<dt><?php echo lang('projects_client');?></dt>
										<dd><?php echo $project_list_agency[$k]->client_name;?></dd>
										
										<dt><?php echo lang('projects_agency');?></dt>
										<dd><?php echo $project_list_agency[$k]->agency_name;?></dd>
										
										<dt><?php echo lang('projects_account_manager');?></dt>
										<dd><?php echo $project_list_agency[$k]->account_manager_name;?></dd>
									</dl>
								</div>
								
								<div class="col-sm-5">
									<dl class="dl-horizontal">
										<dt><?php echo lang('projects_campaign_start');?></dt>
										<dd><?php echo $project_list_agency[$k]->campaign_start;?></dd>
										
										<dt><?php echo lang('projects_campaign_end');?></dt>
										<dd><?php echo $project_list_agency[$k]->campaign_end;?></dd>
										
										<dt><?php echo lang('projects_date_filed');?></dt>
										<dd><?php echo $project_list_agency[$k]->date_filed;?></dd>
										
										<dt><?php echo lang('projects_date_closed');?></dt>
										<dd><?php echo $project_list_agency[$k]->date_closed;?></dd>
										
										<dt><?php echo lang('projects_status');?></dt>
										<dd><?php echo $project_list_agency[$k]->status;?></dd>
									</dl>
								</div>
								
								<div class="col-sm-2">
									<div class="btn-group btn-group-sm pull-right">
										<a href="<?php echo site_url('projects/cos');?>" class="btn btn-primary btn-sm project_view_cos" id="project_view_<?php echo $project_list_agency[$k]->project_id;?>" data-project-id="<?php echo $project_list_agency[$k]->project_id;?>"><i class="icon-list"></i></a>
										<a href="<?php echo site_url('projects/edit');?>" class="btn btn-primary btn-sm project_edit" id="project_edit_<?php echo $project_list_agency[$k]->project_id;?>" data-project-id="<?php echo $project_list_agency[$k]->project_id;?>"><i class="icon-edit"></i></a>
										<a href="<?php echo site_url('projects/delete');?>" class="btn btn-primary btn-sm project_delete" id="project_delete_<?php echo $project_list_agency[$k]->project_id;?>" data-project-id="<?php echo $project_list_agency[$k]->project_id;?>"><i class="icon-remove"></i></a>
									</div>
								</div>
							</div>
							
							<div id="project_cost_of_sales_wrap_<?php echo $project_list_agency[$k]->project_id;?>" style="display:none;"></div>
							
						</div>
					</div>
					
					<div class="clearfix"></div>
				<?php endforeach; ?>
				</div>
			<?php else: ?>
				<div class="well" style="margin-bottom:0;">
					<center>
						<strong><?php echo lang('projects_no_project');?></strong>
						<br />
						<br />
						<a href="<?php echo site_url('projects/add');?>" class="btn btn-primary btn-sm project_add" data-toggle="modal"><i class="icon-plus"></i>&nbsp;<?php echo lang('projects_add_new_project');?></a>
					</center>
				</div>
			<?php endif; ?>
				
			</div>
			
			<!-- Altitude -->
			<div class="tab-pane" id="altitude">
			
			<?php if ($project_list_altitude): ?>
				<ul class="btn-group btn-group-sm pull-right">
					<li class="btn btn-default altitude-filter" data-filter="<?php echo url_title(lang('projects_status_all'),'_',true);?>"><?php echo lang('projects_status_all');?></li>
					<li class="btn btn-default altitude-filter" data-filter="<?php echo url_title(lang('projects_status_opportunity'),'_',true);?>"><?php echo lang('projects_status_opportunity');?></li>
					<li class="btn btn-default altitude-filter" data-filter="<?php echo url_title(lang('projects_status_sent'),'_',true);?>"><?php echo lang('projects_status_sent');?></li>
					<li class="btn btn-default altitude-filter" data-filter="<?php echo url_title(lang('projects_status_for_revision'),'_',true);?>"><?php echo lang('projects_status_for_revision');?></li>
					<li class="btn btn-default altitude-filter" data-filter="<?php echo url_title(lang('projects_status_positive_feedback'),'_',true);?>"><?php echo lang('projects_status_positive_feedback');?></li>
					<li class="btn btn-default altitude-filter" data-filter="<?php echo url_title(lang('projects_status_waiting_for_signed_ce'),'_',true);?>"><?php echo lang('projects_status_waiting_for_signed_ce');?></li>
					<li class="btn btn-default altitude-filter" data-filter="<?php echo url_title(lang('projects_status_closed'),'_',true);?>"><?php echo lang('projects_status_closed');?></li>
					<li class="btn btn-default altitude-filter" data-filter="<?php echo url_title(lang('projects_status_lost'),'_',true);?>"><?php echo lang('projects_status_lost');?></li>
				</ul>
				<div class="clearfix"></div>
				
				<?php
				/*
				<input type="search" id="search_altitude_projects" class="form-control input-sm" placeholder="<?php echo lang('projects_search_project');?>">
				<br />
				*/
				?>
				
				<div id="altitude_projects">
				<?php foreach ($project_list_altitude as $k => $v): ?>
					<div class="panel panel-primary altitude-project <?php echo url_title($project_list_altitude[$k]->status,'_',true);?>" id="project_panel_<?php echo $project_list_altitude[$k]->project_id;?>">
						<div class="panel-heading"><?php echo lang('projects_project_name');?>: <b class="project-name"><?php echo $project_list_altitude[$k]->name;?></b> <p class="pull-right text-left"><?php echo lang('projects_project_budget');?>: <b class="number-format"><?php echo number_format($project_list_altitude[$k]->budget);?></b></p></div>
						<div class="panel-body">
							
							<div class="row">
								<div class="col-sm-5">
									<dl class="dl-horizontal">
										<dt><?php echo lang('projects_project_name');?></dt>
										<dd><?php echo $project_list_altitude[$k]->name;?></dd>
										
										<dt><?php echo lang('projects_project_code');?></dt>
										<dd><?php echo $project_list_altitude[$k]->code;?></dd>
										
										<dt><?php echo lang('projects_project_budget');?></dt>
										<dd><?php echo number_format($project_list_altitude[$k]->budget);?></dd>
										
										<dt><?php echo lang('projects_client');?></dt>
										<dd><?php echo $project_list_altitude[$k]->client_name;?></dd>
										
										<dt><?php echo lang('projects_agency');?></dt>
										<dd><?php echo $project_list_altitude[$k]->agency_name;?></dd>
										
										<dt><?php echo lang('projects_account_manager');?></dt>
										<dd><?php echo $project_list_altitude[$k]->account_manager_name;?></dd>
									</dl>
								</div>
								
								<div class="col-sm-5">
									<dl class="dl-horizontal">
										<dt><?php echo lang('projects_campaign_start');?></dt>
										<dd><?php echo $project_list_altitude[$k]->campaign_start;?></dd>
										
										<dt><?php echo lang('projects_campaign_end');?></dt>
										<dd><?php echo $project_list_altitude[$k]->campaign_end;?></dd>
										
										<dt><?php echo lang('projects_date_filed');?></dt>
										<dd><?php echo $project_list_altitude[$k]->date_filed;?></dd>
										
										<dt><?php echo lang('projects_date_closed');?></dt>
										<dd><?php echo $project_list_altitude[$k]->date_closed;?></dd>
										
										<dt><?php echo lang('projects_status');?></dt>
										<dd><?php echo $project_list_altitude[$k]->status;?></dd>
									</dl>
								</div>
								
								<div class="col-sm-2">
									<div class="btn-group btn-group-sm pull-right">
										<a href="<?php echo site_url('projects/cos');?>" class="btn btn-primary btn-sm project_view_cos" id="project_view_<?php echo $project_list_altitude[$k]->project_id;?>" data-project-id="<?php echo $project_list_altitude[$k]->project_id;?>"><i class="icon-list"></i></a>
										<a href="<?php echo site_url('projects/edit');?>" class="btn btn-primary btn-sm project_edit" id="project_edit_<?php echo $project_list_altitude[$k]->project_id;?>" data-project-id="<?php echo $project_list_altitude[$k]->project_id;?>"><i class="icon-edit"></i></a>
										<a href="<?php echo site_url('projects/delete');?>" class="btn btn-primary btn-sm project_delete" id="project_delete_<?php echo $project_list_altitude[$k]->project_id;?>" data-project-id="<?php echo $project_list_altitude[$k]->project_id;?>"><i class="icon-remove"></i></a>
									</div>
								</div>
							</div>
							
							<div id="project_cost_of_sales_wrap_<?php echo $project_list_altitude[$k]->project_id;?>" style="display:none;"></div>
							
						</div>
					</div>
					
					<div class="clearfix"></div>
				<?php endforeach; ?>
				</div>
			<?php else: ?>
				<div class="well" style="margin-bottom:0;">
					<center>
						<strong><?php echo lang('projects_no_project');?></strong>
						<br />
						<br />
						<a href="<?php echo site_url('projects/add');?>" class="btn btn-primary btn-sm project_add" data-toggle="modal"><i class="icon-plus"></i>&nbsp;<?php echo lang('projects_add_new_project');?></a>
					</center>
				</div>
			<?php endif; ?>
			
			</div>
			
			<!-- Gondola -->
			<div class="tab-pane" id="gondola">
			
			<?php if ($project_list_gondola): ?>
				<ul class="btn-group btn-group-sm pull-right">
					<li class="btn btn-default gondola-filter" data-filter="<?php echo url_title(lang('projects_status_all'),'_',true);?>"><?php echo lang('projects_status_all');?></li>
					<li class="btn btn-default gondola-filter" data-filter="<?php echo url_title(lang('projects_status_opportunity'),'_',true);?>"><?php echo lang('projects_status_opportunity');?></li>
					<li class="btn btn-default gondola-filter" data-filter="<?php echo url_title(lang('projects_status_sent'),'_',true);?>"><?php echo lang('projects_status_sent');?></li>
					<li class="btn btn-default gondola-filter" data-filter="<?php echo url_title(lang('projects_status_for_revision'),'_',true);?>"><?php echo lang('projects_status_for_revision');?></li>
					<li class="btn btn-default gondola-filter" data-filter="<?php echo url_title(lang('projects_status_positive_feedback'),'_',true);?>"><?php echo lang('projects_status_positive_feedback');?></li>
					<li class="btn btn-default gondola-filter" data-filter="<?php echo url_title(lang('projects_status_waiting_for_signed_ce'),'_',true);?>"><?php echo lang('projects_status_waiting_for_signed_ce');?></li>
					<li class="btn btn-default gondola-filter" data-filter="<?php echo url_title(lang('projects_status_closed'),'_',true);?>"><?php echo lang('projects_status_closed');?></li>
					<li class="btn btn-default gondola-filter" data-filter="<?php echo url_title(lang('projects_status_lost'),'_',true);?>"><?php echo lang('projects_status_lost');?></li>
				</ul>
				<div class="clearfix"></div>
				
				<?php
				/*
				<input type="search" id="search_gondola_projects" class="form-control input-sm" placeholder="<?php echo lang('projects_search_project');?>">
				<br />
				*/
				?>
				
				<div id="gondola_projects">
				<?php foreach ($project_list_gondola as $k => $v): ?>
					<div class="panel panel-primary gondola-project <?php echo url_title($project_list_gondola[$k]->status,'_',true);?>" id="project_panel_<?php echo $project_list_gondola[$k]->project_id;?>">
						<div class="panel-heading"><?php echo lang('projects_project_name');?>: <b class="project-name"><?php echo $project_list_gondola[$k]->name;?></b> <p class="pull-right text-left"><?php echo lang('projects_project_budget');?>: <b class="number-format"><?php echo number_format($project_list_gondola[$k]->budget);?></b></p></div>
						<div class="panel-body">
							
							<div class="row">
								<div class="col-sm-5">
									<dl class="dl-horizontal">
										<dt><?php echo lang('projects_project_name');?></dt>
										<dd><?php echo $project_list_gondola[$k]->name;?></dd>
										
										<dt><?php echo lang('projects_project_code');?></dt>
										<dd><?php echo $project_list_gondola[$k]->code;?></dd>
										
										<dt><?php echo lang('projects_project_budget');?></dt>
										<dd><?php echo number_format($project_list_gondola[$k]->budget);?></dd>
										
										<dt><?php echo lang('projects_client');?></dt>
										<dd><?php echo $project_list_gondola[$k]->client_name;?></dd>
										
										<dt><?php echo lang('projects_agency');?></dt>
										<dd><?php echo $project_list_gondola[$k]->agency_name;?></dd>
										
										<dt><?php echo lang('projects_account_manager');?></dt>
										<dd><?php echo $project_list_gondola[$k]->account_manager_name;?></dd>
									</dl>
								</div>
								
								<div class="col-sm-5">
									<dl class="dl-horizontal">
										<dt><?php echo lang('projects_campaign_start');?></dt>
										<dd><?php echo $project_list_gondola[$k]->campaign_start;?></dd>
										
										<dt><?php echo lang('projects_campaign_end');?></dt>
										<dd><?php echo $project_list_gondola[$k]->campaign_end;?></dd>
										
										<dt><?php echo lang('projects_date_filed');?></dt>
										<dd><?php echo $project_list_gondola[$k]->date_filed;?></dd>
										
										<dt><?php echo lang('projects_date_closed');?></dt>
										<dd><?php echo $project_list_gondola[$k]->date_closed;?></dd>
										
										<dt><?php echo lang('projects_status');?></dt>
										<dd><?php echo $project_list_gondola[$k]->status;?></dd>
									</dl>
								</div>
								
								<div class="col-sm-2">
									<div class="btn-group btn-group-sm pull-right">
										<a href="<?php echo site_url('projects/cos');?>" class="btn btn-primary btn-sm project_view_cos" id="project_view_<?php echo $project_list_gondola[$k]->project_id;?>" data-project-id="<?php echo $project_list_gondola[$k]->project_id;?>"><i class="icon-list"></i></a>
										<a href="<?php echo site_url('projects/edit');?>" class="btn btn-primary btn-sm project_edit" id="project_edit_<?php echo $project_list_gondola[$k]->project_id;?>" data-project-id="<?php echo $project_list_gondola[$k]->project_id;?>"><i class="icon-edit"></i></a>
										<a href="<?php echo site_url('projects/delete');?>" class="btn btn-primary btn-sm project_delete" id="project_delete_<?php echo $project_list_gondola[$k]->project_id;?>" data-project-id="<?php echo $project_list_gondola[$k]->project_id;?>"><i class="icon-remove"></i></a>
									</div>
								</div>
							</div>
							
							<div id="project_cost_of_sales_wrap_<?php echo $project_list_gondola[$k]->project_id;?>" style="display:none;"></div>
							
						</div>
					</div>
					
					<div class="clearfix"></div>
				<?php endforeach; ?>
				</div>
			<?php else: ?>
				<div class="well" style="margin-bottom:0;">
					<center>
						<strong><?php echo lang('projects_no_project');?></strong>
						<br />
						<br />
						<a href="<?php echo site_url('projects/add');?>" class="btn btn-primary btn-sm project_add" data-toggle="modal"><i class="icon-plus"></i>&nbsp;<?php echo lang('projects_add_new_project');?></a>
					</center>
				</div>
			<?php endif; ?>
			
			</div>
			
			<!-- Burner -->
			<div class="tab-pane" id="burner">
			
			<?php if ($project_list_burner): ?>
				<ul class="btn-group btn-group-sm pull-right">
					<li class="btn btn-default burner-filter" data-filter="<?php echo url_title(lang('projects_status_all'),'_',true);?>"><?php echo lang('projects_status_all');?></li>
					<li class="btn btn-default burner-filter" data-filter="<?php echo url_title(lang('projects_status_opportunity'),'_',true);?>"><?php echo lang('projects_status_opportunity');?></li>
					<li class="btn btn-default burner-filter" data-filter="<?php echo url_title(lang('projects_status_sent'),'_',true);?>"><?php echo lang('projects_status_sent');?></li>
					<li class="btn btn-default burner-filter" data-filter="<?php echo url_title(lang('projects_status_for_revision'),'_',true);?>"><?php echo lang('projects_status_for_revision');?></li>
					<li class="btn btn-default burner-filter" data-filter="<?php echo url_title(lang('projects_status_positive_feedback'),'_',true);?>"><?php echo lang('projects_status_positive_feedback');?></li>
					<li class="btn btn-default burner-filter" data-filter="<?php echo url_title(lang('projects_status_waiting_for_signed_ce'),'_',true);?>"><?php echo lang('projects_status_waiting_for_signed_ce');?></li>
					<li class="btn btn-default burner-filter" data-filter="<?php echo url_title(lang('projects_status_closed'),'_',true);?>"><?php echo lang('projects_status_closed');?></li>
					<li class="btn btn-default burner-filter" data-filter="<?php echo url_title(lang('projects_status_lost'),'_',true);?>"><?php echo lang('projects_status_lost');?></li>
				</ul>
				<div class="clearfix"></div>
				
				<?php
				/*
				<input type="search" id="search_gondola_projects" class="form-control input-sm" placeholder="<?php echo lang('projects_search_project');?>">
				<br />
				*/
				?>
				
				<div id="burner_projects">
				<?php foreach ($project_list_burner as $k => $v): ?>
					<div class="panel panel-primary burner-project <?php echo url_title($project_list_burner[$k]->status,'_',true);?>" id="project_panel_<?php echo $project_list_burner[$k]->project_id;?>">
						<div class="panel-heading"><?php echo lang('projects_project_name');?>: <b class="project-name"><?php echo $project_list_burner[$k]->name;?></b> <p class="pull-right text-left"><?php echo lang('projects_project_budget');?>: <b class="number-format"><?php echo number_format($project_list_burner[$k]->budget);?></b></p></div>
						<div class="panel-body">
							
							<div class="row">
								<div class="col-sm-5">
									<dl class="dl-horizontal">
										<dt><?php echo lang('projects_project_name');?></dt>
										<dd><?php echo $project_list_burner[$k]->name;?></dd>
										
										<dt><?php echo lang('projects_project_code');?></dt>
										<dd><?php echo $project_list_burner[$k]->code;?></dd>
										
										<dt><?php echo lang('projects_project_budget');?></dt>
										<dd><?php echo number_format($project_list_burner[$k]->budget);?></dd>
										
										<dt><?php echo lang('projects_client');?></dt>
										<dd><?php echo $project_list_burner[$k]->client_name;?></dd>
										
										<dt><?php echo lang('projects_agency');?></dt>
										<dd><?php echo $project_list_burner[$k]->agency_name;?></dd>
										
										<dt><?php echo lang('projects_account_manager');?></dt>
										<dd><?php echo $project_list_burner[$k]->account_manager_name;?></dd>
									</dl>
								</div>
								
								<div class="col-sm-5">
									<dl class="dl-horizontal">
										<dt><?php echo lang('projects_campaign_start');?></dt>
										<dd><?php echo $project_list_burner[$k]->campaign_start;?></dd>
										
										<dt><?php echo lang('projects_campaign_end');?></dt>
										<dd><?php echo $project_list_burner[$k]->campaign_end;?></dd>
										
										<dt><?php echo lang('projects_date_filed');?></dt>
										<dd><?php echo $project_list_burner[$k]->date_filed;?></dd>
										
										<dt><?php echo lang('projects_date_closed');?></dt>
										<dd><?php echo $project_list_burner[$k]->date_closed;?></dd>
										
										<dt><?php echo lang('projects_status');?></dt>
										<dd><?php echo $project_list_burner[$k]->status;?></dd>
									</dl>
								</div>
								
								<div class="col-sm-2">
									<div class="btn-group btn-group-sm pull-right">
										<a href="<?php echo site_url('projects/cos');?>" class="btn btn-primary btn-sm project_view_cos" id="project_view_<?php echo $project_list_burner[$k]->project_id;?>" data-project-id="<?php echo $project_list_burner[$k]->project_id;?>"><i class="icon-list"></i></a>
										<a href="<?php echo site_url('projects/edit');?>" class="btn btn-primary btn-sm project_edit" id="project_edit_<?php echo $project_list_burner[$k]->project_id;?>" data-project-id="<?php echo $project_list_burner[$k]->project_id;?>"><i class="icon-edit"></i></a>
										<a href="<?php echo site_url('projects/delete');?>" class="btn btn-primary btn-sm project_delete" id="project_delete_<?php echo $project_list_burner[$k]->project_id;?>" data-project-id="<?php echo $project_list_burner[$k]->project_id;?>"><i class="icon-remove"></i></a>
									</div>
								</div>
							</div>
							
							<div id="project_cost_of_sales_wrap_<?php echo $project_list_burner[$k]->project_id;?>" style="display:none;"></div>
							
						</div>
					</div>
					
					<div class="clearfix"></div>
				<?php endforeach; ?>
				</div>
			<?php else: ?>
				<div class="well" style="margin-bottom:0;">
					<center>
						<strong><?php echo lang('projects_no_project');?></strong>
						<br />
						<br />
						<a href="<?php echo site_url('projects/add');?>" class="btn btn-primary btn-sm project_add" data-toggle="modal"><i class="icon-plus"></i>&nbsp;<?php echo lang('projects_add_new_project');?></a>
					</center>
				</div>
			<?php endif; ?>
			
			</div>
			
			<!-- Envelope -->
			<div class="tab-pane" id="envelope">
			
			<?php if ($project_list_envelope): ?>
				<ul class="btn-group btn-group-sm pull-right">
					<li class="btn btn-default envelope-filter" data-filter="<?php echo url_title(lang('projects_status_all'),'_',true);?>"><?php echo lang('projects_status_all');?></li>
					<li class="btn btn-default envelope-filter" data-filter="<?php echo url_title(lang('projects_status_opportunity'),'_',true);?>"><?php echo lang('projects_status_opportunity');?></li>
					<li class="btn btn-default envelope-filter" data-filter="<?php echo url_title(lang('projects_status_sent'),'_',true);?>"><?php echo lang('projects_status_sent');?></li>
					<li class="btn btn-default envelope-filter" data-filter="<?php echo url_title(lang('projects_status_for_revision'),'_',true);?>"><?php echo lang('projects_status_for_revision');?></li>
					<li class="btn btn-default envelope-filter" data-filter="<?php echo url_title(lang('projects_status_positive_feedback'),'_',true);?>"><?php echo lang('projects_status_positive_feedback');?></li>
					<li class="btn btn-default envelope-filter" data-filter="<?php echo url_title(lang('projects_status_waiting_for_signed_ce'),'_',true);?>"><?php echo lang('projects_status_waiting_for_signed_ce');?></li>
					<li class="btn btn-default envelope-filter" data-filter="<?php echo url_title(lang('projects_status_closed'),'_',true);?>"><?php echo lang('projects_status_closed');?></li>
					<li class="btn btn-default envelope-filter" data-filter="<?php echo url_title(lang('projects_status_lost'),'_',true);?>"><?php echo lang('projects_status_lost');?></li>
				</ul>
				<div class="clearfix"></div>
				
				<?php
				/*
				<input type="search" id="search_gondola_projects" class="form-control input-sm" placeholder="<?php echo lang('projects_search_project');?>">
				<br />
				*/
				?>
				
				<div id="envelope_projects">
				<?php foreach ($project_list_envelope as $k => $v): ?>
					<div class="panel panel-primary envelope-project <?php echo url_title($project_list_envelope[$k]->status,'_',true);?>" id="project_panel_<?php echo $project_list_envelope[$k]->project_id;?>">
						<div class="panel-heading"><?php echo lang('projects_project_name');?>: <b class="project-name"><?php echo $project_list_envelope[$k]->name;?></b> <p class="pull-right text-left"><?php echo lang('projects_project_budget');?>: <b class="number-format"><?php echo number_format($project_list_envelope[$k]->budget);?></b></p></div>
						<div class="panel-body">
							
							<div class="row">
								<div class="col-sm-5">
									<dl class="dl-horizontal">
										<dt><?php echo lang('projects_project_name');?></dt>
										<dd><?php echo $project_list_envelope[$k]->name;?></dd>
										
										<dt><?php echo lang('projects_project_code');?></dt>
										<dd><?php echo $project_list_envelope[$k]->code;?></dd>
										
										<dt><?php echo lang('projects_project_budget');?></dt>
										<dd><?php echo number_format($project_list_envelope[$k]->budget);?></dd>
										
										<dt><?php echo lang('projects_client');?></dt>
										<dd><?php echo $project_list_envelope[$k]->client_name;?></dd>
										
										<dt><?php echo lang('projects_agency');?></dt>
										<dd><?php echo $project_list_envelope[$k]->agency_name;?></dd>
										
										<dt><?php echo lang('projects_account_manager');?></dt>
										<dd><?php echo $project_list_envelope[$k]->account_manager_name;?></dd>
									</dl>
								</div>
								
								<div class="col-sm-5">
									<dl class="dl-horizontal">
										<dt><?php echo lang('projects_campaign_start');?></dt>
										<dd><?php echo $project_list_envelope[$k]->campaign_start;?></dd>
										
										<dt><?php echo lang('projects_campaign_end');?></dt>
										<dd><?php echo $project_list_envelope[$k]->campaign_end;?></dd>
										
										<dt><?php echo lang('projects_date_filed');?></dt>
										<dd><?php echo $project_list_envelope[$k]->date_filed;?></dd>
										
										<dt><?php echo lang('projects_date_closed');?></dt>
										<dd><?php echo $project_list_envelope[$k]->date_closed;?></dd>
										
										<dt><?php echo lang('projects_status');?></dt>
										<dd><?php echo $project_list_envelope[$k]->status;?></dd>
									</dl>
								</div>
								
								<div class="col-sm-2">
									<div class="btn-group btn-group-sm pull-right">
										<a href="<?php echo site_url('projects/cos');?>" class="btn btn-primary btn-sm project_view_cos" id="project_view_<?php echo $project_list_envelope[$k]->project_id;?>" data-project-id="<?php echo $project_list_envelope[$k]->project_id;?>"><i class="icon-list"></i></a>
										<a href="<?php echo site_url('projects/edit');?>" class="btn btn-primary btn-sm project_edit" id="project_edit_<?php echo $project_list_envelope[$k]->project_id;?>" data-project-id="<?php echo $project_list_envelope[$k]->project_id;?>"><i class="icon-edit"></i></a>
										<a href="<?php echo site_url('projects/delete');?>" class="btn btn-primary btn-sm project_delete" id="project_delete_<?php echo $project_list_envelope[$k]->project_id;?>" data-project-id="<?php echo $project_list_envelope[$k]->project_id;?>"><i class="icon-remove"></i></a>
									</div>
								</div>
							</div>
							
							<div id="project_cost_of_sales_wrap_<?php echo $project_list_envelope[$k]->project_id;?>" style="display:none;"></div>
							
						</div>
					</div>
					
					<div class="clearfix"></div>
				<?php endforeach; ?>
				</div>
			<?php else: ?>
				<div class="well" style="margin-bottom:0;">
					<center>
						<strong><?php echo lang('projects_no_project');?></strong>
						<br />
						<br />
						<a href="<?php echo site_url('projects/add');?>" class="btn btn-primary btn-sm project_add" data-toggle="modal"><i class="icon-plus"></i>&nbsp;<?php echo lang('projects_add_new_project');?></a>
					</center>
				</div>
			<?php endif; ?>
			
			</div>
		</div>
	</div>
	<!-- End Page Layout -->
	
	<!-- Modal Wrapper -->
	<div id="remote_modal_project" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true"></div>
	<!-- End Modal Wrapper -->
	
	<!-- Script -->
	<?php echo script_tag(TEMPLATES_DIR.VERSION_DIR.JS_DIR.'jquery.mixitup.min.js');?>
	<?php echo script_tag(TEMPLATES_DIR.VERSION_DIR.JS_DIR.'jquery.prettynumber.js');?>
	<?php #echo script_tag(TEMPLATES_DIR.VERSION_DIR.JS_DIR.'jquery.quicksearch.js');?>
	<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		// Sort agency projects
		$("#agency_projects").mixitup({
			targetSelector: '.agency-project',
			filterSelector: '.agency-filter',
			effects: ['fade'],
			layoutMode: 'list',
			targetDisplayList: 'block',
			transitionSpeed: 100,
		});
		
		// Sort altitude projects
		$("#altitude_projects").mixitup({
			targetSelector: '.altitude-project',
			filterSelector: '.altitude-filter',
			effects: ['fade'],
			layoutMode: 'list',
			targetDisplayList: 'block',
			transitionSpeed: 100,
		});
		
		// Sort gondola projects
		$("#gondola_projects").mixitup({
			targetSelector: '.gondola-project',
			filterSelector: '.gondola-filter',
			effects: ['fade'],
			layoutMode: 'list',
			targetDisplayList: 'block',
			transitionSpeed: 100,
		});
		
		// Sort burner projects
		$("#burner_projects").mixitup({
			targetSelector: '.burner-project',
			filterSelector: '.burner-filter',
			effects: ['fade'],
			layoutMode: 'list',
			targetDisplayList: 'block',
			transitionSpeed: 100,
		});
		
		// Sort envelope projects
		$("#envelope_projects").mixitup({
			targetSelector: '.envelope-project',
			filterSelector: '.envelope-filter',
			effects: ['fade'],
			layoutMode: 'list',
			targetDisplayList: 'block',
			transitionSpeed: 100,
		});
		
		/*
		// Live search agency projects
		$("#search_agency_projects").quicksearch('#agency_projects .agency-project',{
			selector: 'div.panel-heading > b.project-name'
		});
		
		// Live search altitude projects
		$("#search_altitude_projects").quicksearch('#altitude_projects .altitude-project',{
			selector: 'div.panel-heading > b.project-name'
		});
		
		// Live search gondola projects
		$("#search_gondola_projects").quicksearch('#gondola_projects .gondola-project',{
			selector: 'div.panel-heading > b.project-name'
		});
		
		// Live search burner projects
		$("#search_burner_projects").quicksearch('#burner_projects .burner-project',{
			selector: 'div.panel-heading > b.project-name'
		});
		
		// Live search envelope projects
		$("#search_envelope_projects").quicksearch('#envelope_projects .envelope-project',{
			selector: 'div.panel-heading > b.project-name'
		});
		*/
		
		// Number formats
		$(".number-format").prettynumber();
	
		// Projects
		$("#department_id a").on('click',function(e){
			e.preventDefault();
			$(this).tab('show');
			return false;
		});
		$(".project_add").on('click',function(e){
			e.preventDefault();
			$("#remote_modal_project").modal({
				'backdrop': 'static',
				'keyboard': false,
				'remote': $(this).attr('href') + '?ajax_session_id=<?php echo $ajax_session_id;?>&ajax_id=<?php echo $ajax_id;?>&is_ajax=true&is_modal=true',
			}).on('hidden.bs.modal',function(){
				$(this).removeData('bs.modal');
			});
			return false;
		});
		$(".project_edit").on('click',function(e){
			e.preventDefault();
			project_id = $(this).attr('data-project-id');
			$("#remote_modal_project").modal({
				'backdrop': 'static',
				'keyboard': false,
				'remote': $(this).attr('href') + '?ajax_session_id=<?php echo $ajax_session_id;?>&ajax_id=<?php echo $ajax_id;?>&is_ajax=true&project_id=' + project_id + '&is_modal=true',
			}).on('hidden.bs.modal',function(){
				$(this).removeData('bs.modal');
			});
			return false;
		});
		$(".project_view_cos").on('click',function(e){
			e.preventDefault();
			project_id = $(this).attr('data-project-id');
			if (!$("#project_cost_of_sales_wrap_" + project_id).is(':visible'))
			{
				$(this).addClass('active');
				$.get($(this).attr('href'),{
					'ajax_session_id': '<?php echo $ajax_session_id;?>',
					'ajax_id': '<?php echo $ajax_id;?>',
					'is_ajax': true,
					'project_id': project_id
				},function(data_){
					$("#project_cost_of_sales_wrap_" + project_id).html(data_);
					$("#project_cost_of_sales_wrap_" + project_id).toggle(true);
				});
			}
			else
			{
				$(this).removeClass('active');
				$("#project_cost_of_sales_wrap_" + project_id).toggle(false);
				$("#project_cost_of_sales_wrap_" + project_id).html('');
			}
			return false;
		});
	});
	
	<?php
	/*
	$(function(){
		// Mock Jax
		$.mockjaxSettings.responseTime = 500; 
		$.mockjax({
			url: '<?php echo site_url('projects/budget_track');?>?ajax_session_id=<?php echo $ajax_session_id;?>&ajax_id=<?php echo $ajax_id;?>&is_ajax=true',
			//status: 500,
			response: function(settings) {
				//log(settings, this);
				//console.log(settings);
				this.is_error = true;
				this.error = 'Hey!';
				console.log(this);
			}
		});
		function log(settings, response)
		{
			var s = [], str;
			s.push(settings.type.toUpperCase() + ' url = "' + settings.url + '"');
			for(var a in settings.data)
			{
				if(settings.data[a] && typeof settings.data[a] === 'object')
				{
					str = [];
					for(var j in settings.data[a])
					{
						str.push(j+': "'+settings.data[a][j]+'"');
					}
					str = '{ '+str.join(', ')+' }';
				}
				else
				{
					str = '"'+settings.data[a]+'"';
				}
				s.push(a + ' = ' + str);
			}
			s.push('RESPONSE: status = ' + response.status);
			
			if(response.responseText)
			{
				if($.isArray(response.responseText))
				{
					s.push('[');
					$.each(response.responseText, function(i, v){
						s.push('{value: ' + v.value+', text: "'+v.text+'"}');
					});
					s.push(']');
				}
				else
				{
					s.push($.trim(response.responseText));
				}
			}
			s.push('--------------------------------------\n');
			$('#console').val(s.join('\n') + $('#console').val());
		}
	});
	*/
	?>
	</script>
	<!-- End Script -->