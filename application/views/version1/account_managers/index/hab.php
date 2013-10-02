			<h1><?php echo lang('account_managers_account_managers');?></h1>
			
			<div><a href="<?php echo site_url('account_managers/add');?>" id="add_account_manager" class="btn btn-primary btn-small" data-toggle="modal"><i class="icon-plus"></i>&nbsp;<?php echo lang('account_managers_add_new_account_manager');?></a></div>
			
			<!-- Modal Add New Project -->
			<div id="add_new_project_manager" class="modal fade" data-backdrop="static" data-keyboard="false">
				<div class="modal-dialog">
					<div class="modal-content">
					
						<div class="modal-header">
							<h4 class="modal-title"><?php echo lang('account_managers_add_new_account_manager');?></h4>
						</div>
						
						<div class="modal-body"></div>
						
					</div>
				</div>
			</div>
			
			<!-- Script -->
			<script language="javascript" type="text/javascript">
			$(document).ready(function(){
				$("#add_account_manager").click(function(e){
					e.preventDefault();
					$("#add_new_project_manager").modal({
						'backdrop': 'static',
						'keyboard': false,
						'remote': $(this).attr('href') + '?is_ajax=true',
					});
					return false;
				});
			});
			</script>