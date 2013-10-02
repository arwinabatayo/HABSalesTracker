											<!-- Page Layout -->
											<div id="project_cost_of_sale_form_wrapper_<?php echo $ajax_session_id.$cost_of_sale_data[0]->cost_of_sale_id;?>" class="ajax-wrapper">
												<div id="project_cost_of_sale_form_error_wrapper_<?php echo $ajax_session_id.$cost_of_sale_data[0]->cost_of_sale_id;?>"></div>
												
												<?php echo form_open(site_url('projects/edit_cos'),array('role' => 'form','id' => 'project_cost_of_sale_form_'.$ajax_session_id.$cost_of_sale_data[0]->cost_of_sale_id));?>
												
												<div class="form-group required">
													<label for="<?php echo $project_cos_type['id'];?>"><?php echo lang('projects_cost_of_sale_type');?></label>
													<select name="<?php echo $project_cos_type['name'];?>" id="<?php echo $project_cos_type['id'];?>" class="form-control">
														<option value="<?php echo lang('projects_cost_of_sale_display_media');?>"<?php echo ($project_cos_type['value'] == lang('projects_cost_of_sale_display_media') ? ' selected="selected"' : null);?>><?php echo lang('projects_cost_of_sale_display_media');?></option>
														<option value="<?php echo lang('projects_cost_of_sale_social_media');?>"<?php echo ($project_cos_type['value'] == lang('projects_cost_of_sale_social_media') ? ' selected="selected"' : null);?>><?php echo lang('projects_cost_of_sale_social_media');?></option>
														<option value="<?php echo lang('projects_cost_of_sale_production');?>"<?php echo ($project_cos_type['value'] == lang('projects_cost_of_sale_production') ? ' selected="selected"' : null);?>><?php echo lang('projects_cost_of_sale_production');?></option>
														<option value="<?php echo lang('projects_cost_of_sale_mobile');?>"<?php echo ($project_cos_type['value'] == lang('projects_cost_of_sale_mobile') ? ' selected="selected"' : null);?>><?php echo lang('projects_cost_of_sale_mobile');?></option>
														<option value="<?php echo lang('projects_cost_of_sale_digital_ooh');?>"<?php echo ($project_cos_type['value'] == lang('projects_cost_of_sale_digital_ooh') ? ' selected="selected"' : null);?>><?php echo lang('projects_cost_of_sale_digital_ooh');?></option>
														<option value="<?php echo lang('projects_cost_of_search');?>"<?php echo ($project_cos_type['value'] == lang('projects_cost_of_search') ? ' selected="selected"' : null);?>><?php echo lang('projects_cost_of_search');?></option>
														<option value="<?php echo lang('projects_cost_of_manhours');?>"<?php echo ($project_cos_type['value'] == lang('projects_cost_of_manhours') ? ' selected="selected"' : null);?>><?php echo lang('projects_cost_of_manhours');?></option>
														<option value="<?php echo lang('projects_cost_of_tools');?>"<?php echo ($project_cos_type['value'] == lang('projects_cost_of_tools') ? ' selected="selected"' : null);?>><?php echo lang('projects_cost_of_tools');?></option>
														<option value="<?php echo lang('projects_cost_of_reserved');?>"<?php echo ($project_cos_type['value'] == lang('projects_cost_of_reserved') ? ' selected="selected"' : null);?>><?php echo lang('projects_cost_of_reserved');?></option>
													</select>
												</div>
												
												<div class="form-group required">
													<label for="<?php echo $project_cos_budget['id'];?>"><?php echo lang('projects_cost_of_sale_budget');?></label>
													<?php echo form_input($project_cos_budget); ?>
												</div>
												
												<div class="text-right">
													<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('global_cancel');?></button>
													<?php echo form_submit('submit',lang('global_submit'),'class="btn btn-primary"');?>
												</div>
												
												<?php echo form_close();?>
											</div>
											<!-- End Page Layout -->
											
											<!-- Script -->
											<?php echo script_tag(TEMPLATES_DIR.VERSION_DIR.JS_DIR.'jquery.formvalidation.js');?>
											<script type="text/javascript">
											$(document).ready(function(){
												// Ajax send
												$("#project_cost_of_sale_form_<?php echo $ajax_session_id.$cost_of_sale_data[0]->cost_of_sale_id;?>").on('submit',function(e){
													if (validationPass)
													{
														errorPass = false;
														$.ajax({
															type: 'post',
															url:  $(this).attr('action') + '?ajax_session_id=<?php echo $ajax_session_id;?>&ajax_id=<?php echo $ajax_id;?>&project_id=<?php echo $project_data[0]->project_id;?>&cost_of_sale_id=<?php echo $cost_of_sale_data[0]->cost_of_sale_id;?>&is_ajax=true&is_modal=true',
															data: {
																'<?php echo $project_cos_type['name'];?>': $('#<?php echo $project_cos_type['id'];?>').val(),
																'<?php echo $project_cos_budget['name'];?>': $('#<?php echo $project_cos_budget['id'];?>').val(),
																'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
															},
															dataType: 'json',
															beforeSend: function() {
																$("<div/>", {
																	id: "project_cost_of_sale_ajax_wrapper_<?php echo $ajax_session_id.$cost_of_sale_data[0]->cost_of_sale_id;?>",
																	class: 'append-ajax',
																	html: '<img src="<?php echo TEMPLATES_DIR.VERSION_DIR.IMAGES_DIR;?>ajax-loader.gif" /><br /><p><?php echo lang('global_loading');?></p>',
																}).appendTo($('#project_cost_of_sale_form_wrapper_<?php echo $ajax_session_id.$cost_of_sale_data[0]->cost_of_sale_id;?>'));
															},
															success: function(data) {
																if (data.is_error)
																{
																	$("#project_cost_of_sale_form_error_wrapper_<?php echo $ajax_session_id.$cost_of_sale_data[0]->cost_of_sale_id;?>").html(data.errors);
																}
																else if (data.is_success)
																{
																	errorPass = true;
																	
																	$("#project_cost_of_sale_type_" + data.content[0].cost_of_sale_id).html(data.content[0].type + '<p class="pull-right text-left" id="project_cost_of_sale_budget_' + data.content[0].cost_of_sale_id + '"><b class="number-format">' + data.content[0].budget + '</b> <a href="<?php echo site_url('projects/edit_cos');?>" class="btn btn-primary btn-xs project_edit_cost_of_sale" data-project-id="' + data.content[0].project_id + '" data-cost-of-sale-id="' + data.content[0].cost_of_sale_id + '" style="margin-left: 10px;"><i class="icon-edit"></i></a></p>');
																	$(".number-format").prettynumber();
																	$(".project_edit_cost_of_sale").on('click',function(e){
																		e.preventDefault();
																		project_id = $(this).attr('data-project-id');
																		cost_of_sale_id = $(this).attr('data-cost-of-sale-id');
																		$("#edit_cost_of_sale").modal({
																			'backdrop': 'static',
																			'keyboard': false,
																			'remote': $(this).attr('href') + '?ajax_session_id=<?php echo $ajax_session_id;?>&ajax_id=<?php echo $ajax_id;?>&is_ajax=true&project_id=' + project_id + '&cost_of_sale_id=' +  cost_of_sale_id + '&is_modal=true',
																		}).on('hidden.bs.modal',function(){
																			$(this).removeData('bs.modal');
																		});
																		return false;
																	});
																}
															},
															complete: function() {
																$("#project_cost_of_sale_ajax_wrapper_<?php echo $ajax_session_id.$cost_of_sale_data[0]->cost_of_sale_id;?>").remove();
																if (errorPass)
																{
																	$("#edit_cost_of_sale").modal('hide').on('hidden.bs.modal',function(){
																		$(this).removeData('bs.modal');
																	});
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
											<!-- End Script -->