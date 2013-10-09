							<!-- Page Layout -->
							<div class="panel panel-default hover" style="margin-bottom: 0px;">
								<div class="panel-heading" style="margin-bottom: 0px;">
									<b class="pull-left"><?php echo lang('projects_cost_of_sale');?></b>
									<div class="btn-group pull-right">
										<a href="<?php echo site_url('projects/add_cos');?>" class="btn btn-primary btn-xs project_add_new_cost_of_sale" data-project-id="<?php echo $project_data[0]->project_id;?>"><i class="icon-plus"></i></a>
									</div>
									<div class="clearfix"></div>
								</div>
								<ul class="list-group" id="project_cost_of_sales_list_<?php echo $project_data[0]->project_id;?>" style="margin-top: 0px;">
									<li class="list-group-item cos-type-form ajax-wrapper" id="project_cost_of_sales_form_wrapper_<?php echo $project_data[0]->project_id;?>"></li>
								<?php if ($project_data[0]->cost_of_sales): ?>
									
									<?php foreach($project_data[0]->cost_of_sales as $k => $v): ?>
									<li class="list-group-item" id="project_cost_of_sale_type_<?php echo $project_data[0]->cost_of_sales[$k]->cost_of_sale_id;?>">
										<b><?php echo $project_data[0]->cost_of_sales[$k]->type;?></b>
										<p class="pull-right text-left" id="project_cost_of_sale_budget_<?php echo $project_data[0]->cost_of_sales[$k]->cost_of_sale_id;?>">
											<b class="number-format"><?php echo $project_data[0]->cost_of_sales[$k]->budget;?></b>
											<a href="<?php echo site_url('projects/edit_cos');?>" class="btn btn-primary btn-xs project_edit_cost_of_sale" data-project-id="<?php echo $project_data[0]->project_id;?>" data-cost-of-sale-id="<?php echo $project_data[0]->cost_of_sales[$k]->cost_of_sale_id;?>" style="margin-left: 10px;"><i class="icon-edit"></i></a>
										</p>
										
										 <div class="table-responsive">
										 	<h4>2013</h4>
											<table class="table table-bordered">
												
												<thead>
													<tr>
														<th>#</th>
														<th>Source</th>
														<th>Jan</th>
														<th>Table heading</th>
														<th>Table heading</th>
														<th>Table heading</th>
														<th>Table heading</th>
													</tr>
												</thead>
										
												<tbody>
													<tr>
														<td>1</td>
														<td>Table cell</td>
														<td>Table cell</td>
														<td>Table cell</td>
														<td>Table cell</td>
														<td>Table cell</td>
														<td>Table cell</td>
													</tr>
												</tbody>
												
											</table>
										</div>
									</li>
									<?php endforeach; ?>
									
								<?php endif; ?>
								</ul>
							</div>
							<!-- End Page Layout -->
							
							<!-- Modal Cost Of Sale -->
							<div id="edit_cost_of_sale" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title"><?php echo lang('projects_edit_cost_of_sale');?></h4>
										</div>
										<div class="modal-body"></div>
									</div>
								</div>
							</div>
							<!-- End Modal Cost Of Sale -->
							
							<!-- Script -->
							<script language="javascript" type="text/javascript">
							$(document).ready(function(){
								// Number formats
								$(".number-format").prettynumber();
								
								// Cost Of Sale
								$(".project_add_new_cost_of_sale").on('click',function(e){
									e.preventDefault();
									project_id = $(this).attr('data-project-id');
									$.get($(this).attr('href'),{
										'ajax_session_id': '<?php echo $ajax_session_id;?>',
										'ajax_id': '<?php echo $ajax_id;?>',
										'is_ajax': true,
										'project_id': project_id
									},function(data){
										$("#project_cost_of_sales_form_wrapper_" + project_id).html(data);
									});
									return false;
								});
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
							});
							</script>
							<!-- End Script -->