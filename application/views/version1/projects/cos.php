							<!-- Page Layout -->
							<div class="panel panel-primary" style="margin-bottom: 0px;">
								<div class="panel-heading" style="margin-bottom: 0px;">
									<b class="pull-left"><?php echo lang('projects_cost_of_sale');?></b>
									<div class="btn-group pull-right">
										<a href="<?php echo site_url('projects/add_cos');?>" class="btn btn-default btn-xs project_add_new_cost_of_sale" data-project-id="<?php echo $project_data[0]->project_id;?>"><i class="icon-plus"></i></a>
									</div>
									<div class="clearfix"></div>
								</div>
								<ul class="list-group" id="project_cost_of_sales_list_<?php echo $project_data[0]->project_id;?>" style="margin-top: 0px;">
									
								<?php if ($project_data[0]->cost_of_sales): ?>
									<li class="list-group-item">
									
									<?php if ($project_data[0]->cost_of_sales) { ?>
										<div class="panel-group accordion" id="project_accordion_<?php echo $project_data[0]->project_id;?>">
										
										<?php foreach($project_data[0]->cost_of_sales as $cost_of_sales_type => $cost_of_sales_type_array): ?>
											<div class="panel panel-primary">
												<div class="panel-heading">
													<div class="panel-title">
														<a class="accordion-toggle" data-toggle="collapse" data-parent="#project_accordion_<?php echo $project_data[0]->project_id;?>" href="#<?php echo url_title($cost_of_sales_type,'_',TRUE).'_'.$project_data[0]->project_id; ?>"><strong><?php echo $cost_of_sales_type; ?></strong></a>
													</div>
												</div>
												
												
												<div id="<?php echo url_title($cost_of_sales_type,'_',TRUE).'_'.$project_data[0]->project_id; ?>" class="panel-collapse collapse">
													<div class="panel-body">
														
													<?php foreach($cost_of_sales_type_array as $k => $v) { ?>
													
														<div class="well well-sm well-margin-bottom">
															<?php echo lang('projects_cost_of_sale_source');?>: <b><?php echo $cost_of_sales_type_array[$k]->source;?></b> (<a href="<?php echo site_url('projects/edit_cos');?>" class="project_edit_cost_of_sale" data-project-id="<?php echo $project_data[0]->project_id;?>" data-cost-of-sale-id="<?php echo $cost_of_sales_type_array[$k]->cost_of_sale_id;?>">edit</a>)
															<br />
															<?php echo lang('projects_cost_of_sale_budget');?>: <b class="number-format"><?php echo number_format($cost_of_sales_type_array[$k]->budget);?></b>
															
														<?php if(count($cost_of_sales_type_array[$k]->budget_track)) { ?>
															
															<br />
															<br />
															<div>
																<ul class="nav nav-tabs year-count">
																<?php foreach($cost_of_sales_type_array[$k]->budget_track as $budget_year => $budget_month) { ?>
																	<li<?php echo ($budget_year == YEAR_CONS ? ' class="active"' : null) ;?>><a href="#<?php echo url_title($cost_of_sales_type,'_',TRUE).'_'.$project_data[0]->project_id.$budget_year; ?>" data-toggle="tab"><?php echo $budget_year;?></a></li>
																<?php } ?>
																<?php if ($budget_year != YEAR_CONS) { ?>
																	<li class="active"><a href="#<?php echo url_title($cost_of_sales_type,'_',TRUE).'_'.$project_data[0]->project_id.YEAR_CONS; ?>" data-toggle="tab"><?php echo YEAR_CONS;?></a></li>
																<?php } ?>
																</ul>
															</div>
															
															<div class="tab-content">
																<?php foreach($cost_of_sales_type_array[$k]->budget_track as $budget_year => $budget_month) { ?>
																<div class="tab-pane<?php echo ($budget_year == YEAR_CONS ? ' active' : null) ;?>" id="<?php echo url_title($cost_of_sales_type,'_',TRUE).'_'.$project_data[0]->project_id.$budget_year; ?>">
																	
																	<div class="table-responsive">
																		<table class="table table-bordered table-striped">
																			
																			<thead>
																				<tr>
																					<th><?php echo lang('projects_cost_of_sale_jan');?></th>
																					<th><?php echo lang('projects_cost_of_sale_feb');?></th>
																					<th><?php echo lang('projects_cost_of_sale_mar');?></th>
																					<th><?php echo lang('projects_cost_of_sale_apr');?></th>
																					<th><?php echo lang('projects_cost_of_sale_may');?></th>
																					<th><?php echo lang('projects_cost_of_sale_jun');?></th>
																					<th><?php echo lang('projects_cost_of_sale_jul');?></th>
																					<th><?php echo lang('projects_cost_of_sale_aug');?></th>
																					<th><?php echo lang('projects_cost_of_sale_sep');?></th>
																					<th><?php echo lang('projects_cost_of_sale_oct');?></th>
																					<th><?php echo lang('projects_cost_of_sale_nov');?></th>
																					<th><?php echo lang('projects_cost_of_sale_dec');?></th>
																				</tr>
																			</thead>
																			
																			<tbody>
																				<tr>
																					<?php for($i=1; $i<=12; $i++) { ?>
																					<td>
																						<?php if ($budget_month[$i]->month == $i) { ?>
																						<a href="#" class="editable editable-click editable-empty" data-type="text" data-pk="<?php echo $budget_month[$i]->cost_of_sale_budget_track_id;?>" data-cost-of-sale-id="<?php echo $budget_month[$i]->cost_of_sale_id;?>" data-project-id="<?php echo $budget_month[$i]->project_id;?>" data-month="<?php echo $budget_month[$i]->month;?>" data-year="<?php echo  $budget_month[$i]->year;?>" id="cost_of_sale_budget_track_<?php echo $cost_of_sales_type_array[$k]->cost_of_sale_id.$i;?>"><?php echo $budget_month[$i]->budget;?></a>
																						<?php } else { ?>
																						<a href="#" class="editable editable-click editable-empty" data-type="text" data-pk="0" data-cost-of-sale-id="<?php echo $cost_of_sales_type_array[$k]->cost_of_sale_id;?>" data-project-id="<?php echo $cost_of_sales_type_array[$k]->project_id;?>" data-month="<?php echo $i ;?>" data-year="<?php echo $budget_year;?>" id="cost_of_sale_budget_track_<?php echo $cost_of_sales_type_array[$k]->cost_of_sale_id.$i;?>">0</a>
																						<?php } ?>
																					</td>
																					<?php } ?>
																				</tr>
																			</tbody>
																			
																		</table>
																	</div>
																	
																</div>
																<?php } ?>
																<?php if ($budget_year != YEAR_CONS) { ?>
																<div class="tab-pane active" id="<?php echo url_title($cost_of_sales_type,'_',TRUE).'_'.$project_data[0]->project_id.YEAR_CONS; ?>">
																	
																	<div class="table-responsive">
																		<table class="table table-bordered table-striped">
																			
																			<thead>
																				<tr>
																					<th><?php echo lang('projects_cost_of_sale_jan');?></th>
																					<th><?php echo lang('projects_cost_of_sale_feb');?></th>
																					<th><?php echo lang('projects_cost_of_sale_mar');?></th>
																					<th><?php echo lang('projects_cost_of_sale_apr');?></th>
																					<th><?php echo lang('projects_cost_of_sale_may');?></th>
																					<th><?php echo lang('projects_cost_of_sale_jun');?></th>
																					<th><?php echo lang('projects_cost_of_sale_jul');?></th>
																					<th><?php echo lang('projects_cost_of_sale_aug');?></th>
																					<th><?php echo lang('projects_cost_of_sale_sep');?></th>
																					<th><?php echo lang('projects_cost_of_sale_oct');?></th>
																					<th><?php echo lang('projects_cost_of_sale_nov');?></th>
																					<th><?php echo lang('projects_cost_of_sale_dec');?></th>
																				</tr>
																			</thead>
																			
																			<tbody>
																				<tr>
																					<?php for($i=1; $i<=12; $i++) { ?>
																					<td>
																						<a href="#" class="editable editable-click editable-empty" data-type="text" data-pk="0" data-cost-of-sale-id="<?php echo $cost_of_sales_type_array[$k]->cost_of_sale_id;?>" data-project-id="<?php echo $cost_of_sales_type_array[$k]->project_id;?>" data-month="<?php echo $i ;?>" data-year="<?php echo YEAR_CONS;?>" id="cost_of_sale_budget_track_<?php echo $cost_of_sales_type_array[$k]->cost_of_sale_id.$i;?>">0</a>
																					</td>
																					<?php } ?>
																				</tr>
																			</tbody>
																			
																		</table>
																	</div>
																	
																</div>
																<?php } ?>
															</div>
																
																
														<?php } else { ?>
															
															<br />
															<br />
															<div>
																<ul class="nav nav-tabs year-count">
																	<li class="active"><a href="#<?php echo url_title($cost_of_sales_type,'_',TRUE).'_'.$project_data[0]->project_id.YEAR_CONS; ?>" data-toggle="tab"><?php echo YEAR_CONS;?></a></li>
																</ul>
															</div>
															
															<div class="tab-content">
																<div class="tab-pane active" id="<?php echo url_title($cost_of_sales_type,'_',TRUE).'_'.$project_data[0]->project_id.YEAR_CONS; ?>">
																	
																	<div class="table-responsive">
																		<table class="table table-bordered table-striped">
																			
																			<thead>
																				<tr>
																					<th><?php echo lang('projects_cost_of_sale_jan');?></th>
																					<th><?php echo lang('projects_cost_of_sale_feb');?></th>
																					<th><?php echo lang('projects_cost_of_sale_mar');?></th>
																					<th><?php echo lang('projects_cost_of_sale_apr');?></th>
																					<th><?php echo lang('projects_cost_of_sale_may');?></th>
																					<th><?php echo lang('projects_cost_of_sale_jun');?></th>
																					<th><?php echo lang('projects_cost_of_sale_jul');?></th>
																					<th><?php echo lang('projects_cost_of_sale_aug');?></th>
																					<th><?php echo lang('projects_cost_of_sale_sep');?></th>
																					<th><?php echo lang('projects_cost_of_sale_oct');?></th>
																					<th><?php echo lang('projects_cost_of_sale_nov');?></th>
																					<th><?php echo lang('projects_cost_of_sale_dec');?></th>
																				</tr>
																			</thead>
																			
																			<tbody>
																				<tr>
																					<?php for($i=1; $i<=12; $i++) { ?>
																					<td>
																						<a href="#" class="editable editable-click editable-empty" data-type="text" data-pk="0" data-cost-of-sale-id="<?php echo $cost_of_sales_type_array[$k]->cost_of_sale_id;?>" data-project-id="<?php echo $cost_of_sales_type_array[$k]->project_id;?>" data-month="<?php echo $i ;?>" data-year="<?php echo YEAR_CONS;?>" id="cost_of_sale_budget_track_<?php echo $cost_of_sales_type_array[$k]->cost_of_sale_id.$i;?>">0</a>
																					</td>
																					<?php } ?>
																				</tr>
																			</tbody>
																			
																		</table>
																	</div>
																	
																</div>
															</div>
															
														<?php } ?>
														
														</div>
														
													<?php } ?>
																						
													</div>
												</div>
												
												
											</div>
										<?php endforeach; ?>
										
										</div>
									<?php } ?>
									
									</li>
								<?php endif; ?>
								
								</ul>
							</div>
							<!-- End Page Layout -->
							
							<!-- Modal Wrapper -->
							<div id="remote_modal_cost_of_sale" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true"></div>
							<!-- End Modal Wrapper -->
							
							<!-- Script -->
							<script language="javascript" type="text/javascript">
							$(document).ready(function(){
								// Years
								$(".year-count a").on('click',function(e){
									e.preventDefault();
									$(this).tab('show');
									return false;
								}).on('shown.bs.tab',function(e){
									e.preventDefault();
									$(e.target.hash).show();
									$(e.relatedTarget.hash).hide();
									return false;
								});
								
								// Cost Of Sale
								$("a.editable").editable({
									url: '<?php echo site_url('projects/budget_track');?>?ajax_session_id=<?php echo $ajax_session_id;?>&ajax_id=<?php echo $ajax_id;?>&is_ajax=true',
									title: '<?php echo lang('projects_cost_of_sale_enter_budget');?>',
									ajaxOptions: {
										type: 'post',
										dataType: 'json'
									},
									validate: function(value){
										if (isNaN(value))
										{
											return '<?php echo lang('projects_cost_of_sale_budget_not_number');?>';
										}
									},
									params: function(params){
										params.cost_of_sale_id = $(this).attr('data-cost-of-sale-id');
										params.project_id = $(this).attr('data-project-id');
										params.month = $(this).attr('data-month');
										params.year = $(this).attr('data-year');
										params.id = $(this).attr('id');
										params.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
										return params;
									},
									success: function(response, newValue){
										console.log(newValue);
										console.log(response);
									},
									error: function(response){
										if (response.status == 200)
										{
											location.reload(true);
										}
										else
										{
											alert('Error: (' + response.status + ' ' + response.responseText + ')');
										}
									}
								});
								$(".project_add_new_cost_of_sale").on('click',function(e){
									e.preventDefault();
									project_id = $(this).attr('data-project-id');
									$("#remote_modal_cost_of_sale").modal({
										'backdrop': 'static',
										'keyboard': false,
										'remote': $(this).attr('href') + '?ajax_session_id=<?php echo $ajax_session_id;?>&ajax_id=<?php echo $ajax_id;?>&is_ajax=true&project_id=' + project_id + '&is_modal=true',
									}).on('hidden.bs.modal',function(){
										$(this).removeData('bs.modal');
									});
									return false;
								});
								$(".project_edit_cost_of_sale").on('click',function(e){
									e.preventDefault();
									project_id = $(this).attr('data-project-id');
									cost_of_sale_id = $(this).attr('data-cost-of-sale-id');
									$("#remote_modal_cost_of_sale").modal({
										'backdrop': 'static',
										'keyboard': false,
										'remote': $(this).attr('href') + '?ajax_session_id=<?php echo $ajax_session_id;?>&ajax_id=<?php echo $ajax_id;?>&is_ajax=true&project_id=' + project_id + '&cost_of_sale_id=' +  cost_of_sale_id + '&is_modal=true',
									}).on('hidden.bs.modal',function(){
										$(this).removeData('bs.modal');
									});
									return false;
								});
							});
							</script>
							<!-- End Script -->