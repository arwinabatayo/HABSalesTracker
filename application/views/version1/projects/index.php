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
		
		<div class="text-right"><a href="<?php echo site_url('projects/add');?>" class="btn btn-primary btn-sm project_add" data-toggle="modal"><i class="icon-plus"></i>&nbsp;<?php echo lang('projects_add_new_project');?></a></div>
		
		<br />
		
		<div>
			<ul class="nav nav-tabs" id="department_id">
				<li class="active"><a href="#agency" data-toggle="tab"><b><?php echo lang('global_agency');?></b></a></li>
				<?php
				/*
				<li><a href="#altitude" data-toggle="tab"><b><?php echo lang('global_altitude');?></b></a></li>
				<li><a href="#gondola" data-toggle="tab"><b><?php echo lang('global_gondola');?></b></a></li>
				<li><a href="#burner" data-toggle="tab"><b><?php echo lang('global_burner');?></b></a></li>
				<li><a href="#envelope" data-toggle="tab"><b><?php echo lang('global_envelope');?></b></a></li>
				*/
				?>
			</ul>
		</div>
		
		<div class="tab-content">
			<!-- Agency -->
			<div class="tab-pane active" id="agency">
			
				<ul class="btn-group btn-group-sm pull-right">
					<li class="btn btn-default btn-small agency-filter" data-filter="<?php echo url_title(lang('projects_status_all'),'_',true);?>"><?php echo lang('projects_status_all');?></li>
					<li class="btn btn-default btn-small agency-filter" data-filter="<?php echo url_title(lang('projects_status_opportunity'),'_',true);?>"><?php echo lang('projects_status_opportunity');?></li>
					<li class="btn btn-default btn-small agency-filter" data-filter="<?php echo url_title(lang('projects_status_sent'),'_',true);?>"><?php echo lang('projects_status_sent');?></li>
					<li class="btn btn-default btn-small agency-filter" data-filter="<?php echo url_title(lang('projects_status_for_revision'),'_',true);?>"><?php echo lang('projects_status_for_revision');?></li>
					<li class="btn btn-default btn-small agency-filter" data-filter="<?php echo url_title(lang('projects_status_positive_feedback'),'_',true);?>"><?php echo lang('projects_status_positive_feedback');?></li>
					<li class="btn btn-default btn-small agency-filter" data-filter="<?php echo url_title(lang('projects_status_waiting_for_signed_ce'),'_',true);?>"><?php echo lang('projects_status_waiting_for_signed_ce');?></li>
					<li class="btn btn-default btn-small agency-filter" data-filter="<?php echo url_title(lang('projects_status_closed'),'_',true);?>"><?php echo lang('projects_status_closed');?></li>
					<li class="btn btn-default btn-small agency-filter" data-filter="<?php echo url_title(lang('projects_status_lost'),'_',true);?>"><?php echo lang('projects_status_lost');?></li>
				</ul>
				<div class="clearfix"></div>
				<?php
				/*
				<input type="search" id="search_agency_projects" class="form-control input-sm" placeholder="<?php echo lang('projects_search_project');?>">
				*/
				?>
				<br />
			
			<?php if ($project_list): ?>
				<div id="agency_projects">
				<?php foreach ($project_list as $k => $v): ?>
					<div class="panel panel-default agency-project <?php echo url_title($project_list[$k]->status,'_',true);?>" id="project_panel_<?php echo $project_list[$k]->project_id;?>">
						<div class="panel-heading"><?php echo lang('projects_project_name');?>: <b class="project-name"><?php echo $project_list[$k]->name;?></b> <p class="pull-right text-left"><?php echo lang('projects_project_budget');?>: <b class="number-format"><?php echo number_format($project_list[$k]->budget);?></b></p></div>
						<div class="panel-body">
							
							<div class="row">
								<div class="col-sm-5">
									<dl class="dl-horizontal">
										<dt><?php echo lang('projects_project_name');?></dt>
										<dd><?php echo $project_list[$k]->name;?></dd>
										
										<dt><?php echo lang('projects_project_code');?></dt>
										<dd><?php echo $project_list[$k]->code;?></dd>
										
										<dt><?php echo lang('projects_project_budget');?></dt>
										<dd><?php echo number_format($project_list[$k]->budget);?></dd>
										
										<dt><?php echo lang('projects_client');?></dt>
										<dd><?php echo $project_list[$k]->client_name;?></dd>
										
										<dt><?php echo lang('projects_agency');?></dt>
										<dd><?php echo $project_list[$k]->agency_name;?></dd>
										
										<dt><?php echo lang('projects_account_manager');?></dt>
										<dd><?php echo $project_list[$k]->account_manager_name;?></dd>
									</dl>
								</div>
								
								<div class="col-sm-5">
									<dl class="dl-horizontal">
										<dt><?php echo lang('projects_campaign_start');?></dt>
										<dd><?php echo $project_list[$k]->campaign_start;?></dd>
										
										<dt><?php echo lang('projects_campaign_end');?></dt>
										<dd><?php echo $project_list[$k]->campaign_end;?></dd>
										
										<dt><?php echo lang('projects_date_filed');?></dt>
										<dd><?php echo $project_list[$k]->date_filed;?></dd>
										
										<dt><?php echo lang('projects_date_closed');?></dt>
										<dd><?php echo $project_list[$k]->date_closed;?></dd>
										
										<dt><?php echo lang('projects_status');?></dt>
										<dd><?php echo $project_list[$k]->status;?></dd>
									</dl>
								</div>
								
								<div class="col-sm-2">
									<div class="btn-group btn-group-sm pull-right">
										<a href="<?php echo site_url('projects/cos');?>" class="btn btn-primary btn-sm project_view_cos" data-project-id="<?php echo $project_list[$k]->project_id;?>"><i class="icon-list"></i></a>
										<a href="<?php echo site_url('projects/edit');?>"" class="btn btn-primary btn-sm project_edit" data-project-id="<?php echo $project_list[$k]->project_id;?>"><i class="icon-edit"></i></a>
										<a href="#" id="project_delete_<?php echo $project_list[$k]->project_id;?>" class="btn btn-primary btn-sm" data-id="<?php echo $project_list[$k]->project_id;?>"><i class="icon-remove"></i></a>
									</div>
								</div>
							</div>
							
							<div id="project_cost_of_sales_wrap_<?php echo $project_list[$k]->project_id;?>"></div>
							
						</div>
					</div>
					
					<div class="clearfix"></div>
				<?php endforeach; ?>
				</div>
			<?php else: ?>
			
				<div class="alert alert-success" style="margin-bottom:0;"><?php echo lang('projects_no_project');?></div>
				
			<?php endif; ?>
				
			</div>
			
			<?php
			/*
			<!-- Altitude -->
			<div class="tab-pane" id="altitude">
				
			</div>
			
			<!-- Gondola -->
			<div class="tab-pane" id="gondola">
				
			</div>
			
			<!-- Burner -->
			<div class="tab-pane" id="burner">
				
			</div>
			
			<!-- Envelope -->
			<div class="tab-pane" id="envelope">
				
			</div>
			*/
			?>
		</div>
	</div>
	<!-- End Page Layout -->
	
	<!-- Modal Add New Project -->
	<div id="add_new_project" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><?php echo lang('projects_add_new_project');?></h4>
				</div>
				<div class="modal-body"></div>
			</div>
		</div>
	</div>
	<!-- End Modal Add New Project -->
	
	<!-- Modal Edit Project -->
	<div id="edit_project" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"><?php echo lang('projects_edit_project');?></h4>
				</div>
				<div class="modal-body"></div>
			</div>
		</div>
	</div>
	<!-- End Modal Edit Project -->
	
	<!-- Script -->
	<?php echo script_tag(TEMPLATES_DIR.VERSION_DIR.JS_DIR.'jquery.mixitup.min.js');?>
	<?php echo script_tag(TEMPLATES_DIR.VERSION_DIR.JS_DIR.'jquery.prettynumber.js');?>
	<?php echo script_tag(TEMPLATES_DIR.VERSION_DIR.JS_DIR.'jquery.quicksearch.js');?>
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
		
		// Live search agency projects
		/*
		$("#search_agency_projects").quicksearch('#agency_projects .agency-project',{
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
			$("#add_new_project").modal({
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
			$("#edit_project").modal({
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
			$.get($(this).attr('href'),{
				'ajax_session_id': '<?php echo $ajax_session_id;?>',
				'ajax_id': '<?php echo $ajax_id;?>',
				'is_ajax': true,
				'project_id': project_id
			},function(data_){
				$("#project_cost_of_sales_wrap_" + project_id).html(data_);
			});
			return false;
		});
	});
	</script>
	<!-- End Script -->