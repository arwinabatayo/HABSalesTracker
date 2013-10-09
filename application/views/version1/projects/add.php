 	<!-- Page Layout -->
	<div id="project_form_wrapper_<?php echo $ajax_session_id;?>" class="ajax-wrapper">
		<div id="project_error_wrapper_<?php echo $ajax_session_id;?>"></div>
		
		<?php echo form_open(site_url('projects/add'),array('role' => 'form','id' => 'project_form_'.$ajax_session_id));?>
						
		<div class="form-group required">
			<label for="<?php echo $project_name['id'];?>"><?php echo lang('projects_project_name');?></label>
			<?php echo form_input($project_name); ?>
		</div>
		
		<div class="form-group required">
			<label for="<?php echo $project_code['id'];?>"><?php echo lang('projects_project_code');?></label>
			<?php echo form_input($project_code); ?>
		</div>
		
		<div class="form-group required">
			<label for="<?php echo $project_budget['id'];?>"><?php echo lang('projects_project_budget');?></label>
			<?php echo form_input($project_budget); ?>
		</div>
		
		<div class="form-group required">
			<label for="<?php echo $project_department['id'];?>"><?php echo lang('projects_department');?></label>
			<select name="<?php echo $project_department['name'];?>" id="<?php echo $project_department['id'];?>" class="form-control">
				<option value="agency"><?php echo lang('global_agency');?></option>
				<option value="altitude"><?php echo lang('global_altitude');?></option>
				<option value="gondola"><?php echo lang('global_gondola');?></option>
				<option value="burner"><?php echo lang('global_burner');?></option>
				<option value="envelope"><?php echo lang('global_envelope');?></option>
			</select>
		</div>
		
		<div class="form-group required">
			<label for="<?php echo $project_client['id'];?>"><?php echo lang('projects_client');?></label>
			<?php echo form_input($project_client); ?>
		</div>
		
		<div class="form-group required">
			<label for="<?php echo $project_agency['id'];?>"><?php echo lang('projects_agency');?></label>
			<?php echo form_input($project_agency); ?>
		</div>
		
		<div class="form-group required">
			<label for="<?php echo $project_account_manager['id'];?>"><?php echo lang('projects_account_manager');?></label>
			<?php echo form_input($project_account_manager); ?>
		</div>
		
		<div class="clearfix">
			<div class="pull-left margin-modal-calendar">
				<div class="form-group required">
					<label for="<?php echo $project_campaign_start['id'];?>"><?php echo lang('projects_campaign_start');?></label>
					<?php echo form_input($project_campaign_start); ?>
					
					<div class="panel panel-default">
						<div class="panel-body">
							<div id="<?php echo $project_campaign_start['id'];?>_inline" data-date="<?php echo date('Y-m-d',time());?>" data-date-format="<?php echo lang('projects_date_format');?>"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="pull-left">
				<div class="form-group required">
					<label for="<?php echo $project_campaign_end['id'];?>"><?php echo lang('projects_campaign_end');?></label>
					<?php echo form_input($project_campaign_end); ?>
					
					<div class="panel panel-default">
						<div class="panel-body">
							<div id="<?php echo $project_campaign_end['id'];?>_inline" data-date="<?php echo date('Y-m-d',time());?>" data-date-format="<?php echo lang('projects_date_format');?>"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="clearfix"></div>
		</div>
		
		<div class="clearfix">
			<div class="pull-left margin-modal-calendar">
				<div class="form-group required">
					<label for="<?php echo $project_date_filed['id'];?>"><?php echo lang('projects_date_filed');?></label>
					<?php echo form_input($project_date_filed); ?>
					
					<div class="panel panel-default">
						<div class="panel-body">
							<div id="<?php echo $project_date_filed['id'];?>_inline" data-date="<?php echo date('Y-m-d',time());?>" data-date-format="<?php echo lang('projects_date_format');?>"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="pull-left">
				<div class="form-group required">
					<label for="<?php echo $project_date_closed['id'];?>"><?php echo lang('projects_date_closed');?></label>
					<?php echo form_input($project_date_closed); ?>
					
					<div class="panel panel-default">
						<div class="panel-body">
							<div id="<?php echo $project_date_closed['id'];?>_inline" data-date="<?php echo date('Y-m-d',time());?>" data-date-format="<?php echo lang('projects_date_format');?>"></div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="clearfix"></div>
		</div>
		
		<div class="form-group required">
			<label for="<?php echo $project_status['id'];?>"><?php echo lang('projects_status');?></label>
			<select name="<?php echo $project_status['name'];?>" id="<?php echo $project_status['id'];?>" class="form-control">
				<option value="<?php echo lang('projects_status_opportunity');?>"><?php echo lang('projects_status_opportunity');?></option>
				<option value="<?php echo lang('projects_status_sent');?>"><?php echo lang('projects_status_sent');?></option>
				<option value="<?php echo lang('projects_status_for_revision');?>"><?php echo lang('projects_status_for_revision');?></option>
				<option value="<?php echo lang('projects_status_positive_feedback');?>"><?php echo lang('projects_status_positive_feedback');?></option>
				<option value="<?php echo lang('projects_status_waiting_for_signed_ce');?>"><?php echo lang('projects_status_waiting_for_signed_ce');?></option>
				<option value="<?php echo lang('projects_status_closed');?>"><?php echo lang('projects_status_closed');?></option>
				<option value="<?php echo lang('projects_status_lost');?>"><?php echo lang('projects_status_lost');?></option>
			</select>
		</div>
		
		<br />
		
		<div class="text-right">
			<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('global_cancel');?></button>
			<?php echo form_submit('submit',lang('global_submit'),'class="btn btn-primary"');?>
		</div>
							
		<?php echo form_close();?>
	</div>
	<!-- End Page Layout -->
	
	<!-- Script -->
	<?php echo link_tag(TEMPLATES_DIR.VERSION_DIR.CSS_DIR.'bootstrap-datepicker.css');?>
	<?php echo script_tag(TEMPLATES_DIR.VERSION_DIR.JS_DIR.'bootstrap-datepicker.js');?>
	<?php echo script_tag(TEMPLATES_DIR.VERSION_DIR.JS_DIR.'bootstrap-typeahead.min.js');?>
	<?php echo script_tag(TEMPLATES_DIR.VERSION_DIR.JS_DIR.'jquery.formvalidation.js');?>
	<script type="text/javascript">
	$(document).ready(function(){
		<?php if ($client_list):?>
		// Clients
		$("#<?php echo $project_client['id'];?>").typeahead({
			name: "<?php echo lang('projects_client');?>",
			local: [<?php foreach($client_list as $k => $v){echo '"'.$client_list[$k]->name.'",';} ?>]
		});
		<?php endif;?>
		
		<?php if ($agency_list):?>
		// Agency
		$("#<?php echo $project_agency['id'];?>").typeahead({
			name: "<?php echo lang('projects_agency');?>",
			local: [<?php foreach($agency_list as $k => $v){echo '"'.$agency_list[$k]->name.'",';} ?>]
		});
		<?php endif;?>
		
		<?php if ($account_manager_list):?>
		// Account Manager
		$("#<?php echo $project_account_manager['id'];?>").typeahead({
			name: "<?php echo lang('projects_account_manager');?>",
			local: [<?php foreach($account_manager_list as $k => $v){echo '"'.$account_manager_list[$k]->name.'",';} ?>]
		});
		<?php endif;?>
		
		// Campaign Start
		$("#<?php echo $project_campaign_start['id'];?>_inline").datepicker({
			format: 'yyyy-mm-dd'
		}).on('changeDate',function(ev){
			isoToDate = ev.date.toISOString().match(/(\d{4}-\d{2}-\d{2})/);
			$("#<?php echo $project_campaign_start['id'];?>").val(isoToDate[0]);
		});
		
		// Campaign End
		$("#<?php echo $project_campaign_end['id'];?>_inline").datepicker({
			format: 'yyyy-mm-dd'
		}).on('changeDate',function(ev){
			isoToDate = ev.date.toISOString().match(/(\d{4}-\d{2}-\d{2})/);
			$("#<?php echo $project_campaign_end['id'];?>").val(isoToDate[0]);
		});
		
		// Date Filed
		$("#<?php echo $project_date_filed['id'];?>_inline").datepicker({
			format: 'yyyy-mm-dd'
		}).on('changeDate',function(ev){
			isoToDate = ev.date.toISOString().match(/(\d{4}-\d{2}-\d{2})/);
			$("#<?php echo $project_date_filed['id'];?>").val(isoToDate[0]);
		});
		
		// Date Closed
		$("#<?php echo $project_date_closed['id'];?>_inline").datepicker({
			format: 'yyyy-mm-dd'
		}).on('changeDate',function(ev){
			isoToDate = ev.date.toISOString().match(/(\d{4}-\d{2}-\d{2})/);
			$("#<?php echo $project_date_closed['id'];?>").val(isoToDate[0]);
		});
		
		// Ajax send
		$("#project_form_<?php echo $ajax_session_id;?>").on('submit',function(e){
			if (validationPass)
			{
				errorPass = false;
				$.ajax({
					type: 'post',
					url:  $('#project_form_<?php echo $ajax_session_id;?>').attr('action') + '?ajax_session_id=<?php echo $ajax_session_id;?>&ajax_id=<?php echo $ajax_id;?>&is_ajax=true',
					data: {
						'<?php echo $project_name['name'];?>': $('#<?php echo $project_name['id'];?>').val(),
						'<?php echo $project_code['name'];?>': $('#<?php echo $project_code['id'];?>').val(),
						'<?php echo $project_budget['name'];?>': $('#<?php echo $project_budget['id'];?>').val(),
						'<?php echo $project_department['name'];?>': $('#<?php echo $project_department['id'];?>').val(),
						'<?php echo $project_client['name'];?>': $('#<?php echo $project_client['id'];?>').val(),
						'<?php echo $project_agency['name'];?>': $('#<?php echo $project_agency['id'];?>').val(),
						'<?php echo $project_account_manager['name'];?>': $('#<?php echo $project_account_manager['id'];?>').val(),
						'<?php echo $project_campaign_start['name'];?>': $('#<?php echo $project_campaign_start['id'];?>').val(),
						'<?php echo $project_campaign_end['name'];?>': $('#<?php echo $project_campaign_end['id'];?>').val(),
						'<?php echo $project_date_filed['name'];?>': $('#<?php echo $project_date_filed['id'];?>').val(),
						'<?php echo $project_date_closed['name'];?>': $('#<?php echo $project_date_closed['id'];?>').val(),
						'<?php echo $project_status['name'];?>': $('#<?php echo $project_status['id'];?>').val(),
						'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
					},
					dataType: 'json',
					beforeSend: function() {
						$("<div/>", {
							id: "project_ajax_wrapper_<?php echo $ajax_session_id;?>",
							class: 'append-ajax',
							html: '<img src="<?php echo TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR;?>ajax-loader.gif" /><br /><p><?php echo lang('global_loading');?></p>',
						}).appendTo($('#project_form_wrapper_<?php echo $ajax_session_id;?>'));
					},
					success: function(data) {
						if (data.is_error)
						{
							$("#project_error_wrapper_<?php echo $ajax_session_id;?>").html(data.errors);
						}
						else if (data.is_success)
						{
							errorPass = true;
						}
					},
					complete: function() {
						$("#project_ajax_wrapper_<?php echo $ajax_session_id;?>").remove();
						if (errorPass)
						{
							$("#add_new_project").modal('hide');
							window.location.href = '<?php echo site_url('projects');?>';
						}
					},
					error: function (xhr, ajaxOptions, thrownError) {
						if (xhr.status == 200)
						{
							location.reload(true);
						}
						else
						{
							alert('Error: (' + xhr.status + ' ' + thrownError + ')');
						}
					},
				});
			}
			e.preventDefault();
			return false;
		});
	});
	</script>
	<!-- End Script -->