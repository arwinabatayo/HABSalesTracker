<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends MY_Controller
{
	protected $assign = array();
	
	function __construct()
	{
		parent::__construct();
		
		// Set Languages
		$this->lang->load('projects');
		
		// Set Assignments
		$this->assign['page_title'] = $this->lang->line('projects_projects');
		
		// Set ajax request tokens
		$this->assign['ajax_session_id'] = $this->session->userdata('session_id');
		$this->assign['ajax_id'] = $this->session->userdata('id');
		
		// Action
		if ($this->session->flashdata('action_success'))
		{
			$this->assign['action_success'] = $this->session->flashdata('action_success');
		}
		if ($this->session->flashdata('action_error'))
		{
			$this->assign['action_error'] = $this->session->flashdata('action_error');
		}
		
		// Check user status
		if (!$this->isUserLoggedIn(true)) // Logged In?
		{
			if ($this->input->is_ajax_request() && $this->input->get('is_modal'))
			{
				echo '<script type="text/javascript">location.href="'.site_url('logout').'";</script>';
			}
			else
			{
				redirect(site_url('logout'));
			}
			exit;
		}
		
		// Set cookie page
		$this->setPage('projects');
		
		// Assign cookies
		$this->assign['is_page'] = $this->session->userdata('is_page');
		
		// Get User Data
		$this->assign['is_user'] = $this->getUserDetails($this->session->userdata('id'));
	}
	
	
	
	
	
	function index() // Static page
	{
		// Check permission
		if (!$this->zacl->check_acl('projects',$this->assign['is_user'][0]->role))
		{
			redirect(site_url('error/notfound'));
		}
		
		// Agency
		$this->assign['project_list_agency'] = $this->model_projects->getProjectByDepartment('agency');
		
		// Altitude
		$this->assign['project_list_altitude'] = $this->model_projects->getProjectByDepartment('altitude');
		
		// Gondola
		$this->assign['project_list_gondola'] = $this->model_projects->getProjectByDepartment('gondola');
		
		// Burner
		$this->assign['project_list_burner'] = $this->model_projects->getProjectByDepartment('burner');
		
		// Envelope
		$this->assign['project_list_envelope'] = $this->model_projects->getProjectByDepartment('envelope');
		
		//echo '<pre>';
		//print_r($this->assign);
		//exit;
		
		$this->load->view('projects/index',$this->assign);
	}
	
	
	
	
	
	function add() // Always ajax
	{
		// Check if ajax request
		if (!$this->input->is_ajax_request())
		{
			// Redirect to not found
			redirect(site_url('error/notfound'));
		}
		
		// Check permission
		if (!$this->zacl->check_acl('projects/add',$this->assign['is_user'][0]->role))
		{
			// Throw error
			echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning"><p>'.$this->lang->line('global_error_page_not_found').'</p></div>'));
			exit;
		}
		
		// Check session
		if (!$this->input->get('is_ajax') || $this->input->get('ajax_id') != $this->assign['ajax_id'] || $this->input->get('ajax_session_id') != $this->assign['ajax_session_id'])
		{
			// Throw error
			echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning"><p>'.$this->lang->line('global_error_session_timeout').'</p></div>'));
			exit;
		}
		
		// Set as Ajax
		$this->assign['is_ajax'] = true;
		
		// Set Form
		$this->assign['project_name'] = array( // Name
			'type' => 'text',
			'name' => 'project_name',
			'id' => 'project_name',
			'placeholder' => $this->lang->line('projects_project_name'),
			'title' => $this->lang->line('projects_project_name'),
			'class' => 'form-control verifyText'
		);
		$this->assign['project_code'] = array( // Code
			'type' => 'text',
			'name' => 'project_code',
			'id' => 'project_code',
			'placeholder' => $this->lang->line('projects_project_code'),
			'title' => $this->lang->line('projects_project_code'),
			'class' => 'form-control verifyText'
		);
		$this->assign['project_budget'] = array( // Budget
			'type' => 'number',
			'name' => 'project_budget',
			'id' => 'project_budget',
			'placeholder' => $this->lang->line('projects_project_budget'),
			'title' => $this->lang->line('projects_project_budget'),
			'class' => 'form-control verifyInteger'
		);
		$this->assign['project_department'] = array( // Department
			'name' => 'project_department',
			'id' => 'project_department'
		);
		$this->assign['project_client'] = array( // Client
			'type' => 'text',
			'name' => 'project_client',
			'id' => 'project_client',
			'placeholder' => $this->lang->line('projects_client'),
			'title' => $this->lang->line('projects_client'),
			'class' => 'form-control verifyText'
		);
		$this->assign['project_agency'] = array( // Agency
			'type' => 'text',
			'name' => 'project_agency',
			'id' => 'project_agency',
			'placeholder' => $this->lang->line('projects_agency'),
			'title' => $this->lang->line('projects_agency'),
			'class' => 'form-control verifyText'
		);
		$this->assign['project_account_manager'] = array( // Account Manager
			'type' => 'text',
			'name' => 'project_account_manager',
			'id' => 'project_account_manager',
			'placeholder' => $this->lang->line('projects_account_manager'),
			'title' => $this->lang->line('projects_account_manager'),
			'class' => 'form-control verifyText'
		);
		$this->assign['project_campaign_start'] = array( // Campaign Start
			'type' => 'hidden',
			'name' => 'project_campaign_start',
			'id' => 'project_campaign_start',
			'placeholder' => $this->lang->line('projects_date_format'),
			'title' => $this->lang->line('projects_campaign_start'),
			'value' => date('Y-m-d'),
			'class' => 'form-control verifyText',
			'readonly' => 'readonly'
		);
		$this->assign['project_campaign_end'] = array( // Campaign End
			'type' => 'hidden',
			'name' => 'project_campaign_end',
			'id' => 'project_campaign_end',
			'placeholder' => $this->lang->line('projects_date_format'),
			'title' => $this->lang->line('projects_campaign_end'),
			'value' => date('Y-m-d'),
			'class' => 'form-control verifyText',
			'readonly' => 'readonly'
		);
		$this->assign['project_date_filed'] = array( // Date Filed
			'type' => 'hidden',
			'name' => 'project_date_filed',
			'id' => 'project_date_filed',
			'placeholder' => $this->lang->line('projects_date_format'),
			'title' => $this->lang->line('projects_date_filed'),
			'value' => date('Y-m-d'),
			'class' => 'form-control verifyText',
			'readonly' => 'readonly'
		);
		$this->assign['project_date_closed'] = array( // Date Closed
			'type' => 'hidden',
			'name' => 'project_date_closed',
			'id' => 'project_date_closed',
			'placeholder' => $this->lang->line('projects_date_format'),
			'title' => $this->lang->line('projects_date_closed'),
			'value' => date('Y-m-d'),
			'class' => 'form-control verifyText',
			'readonly' => 'readonly'
		);
		$this->assign['project_status'] = array( // Status
			'name' => 'project_status',
			'id' => 'project_status'
		);
		
		$this->assign['client_list'] = $this->model_clients->getAllClient(); // Client List
		$this->assign['agency_list'] = $this->model_agencies->getAllAgency(); // Agency List
		$this->assign['account_manager_list'] = $this->model_account_managers->getAllAccountManager(); // Account Manager List
		
		// If request post sent
		if ($_POST)
		{
			#echo json_encode(array('is_error' => true,'errors' => '<pre>'.var_export($_POST,true).'</pre>'));
			#exit;
			
			$this->form_validation->set_rules('project_name',$this->lang->line('projects_project_name'),'trim|required');
			$this->form_validation->set_rules('project_code',$this->lang->line('projects_project_code'),'trim|required');
			$this->form_validation->set_rules('project_budget',$this->lang->line('projects_project_budget'),'trim|is_natural_no_zero|required');
			$this->form_validation->set_rules('project_department',$this->lang->line('projects_department'),'trim|alpha|required');
			$this->form_validation->set_rules('project_client',$this->lang->line('projects_client'),'trim|required');
			$this->form_validation->set_rules('project_agency',$this->lang->line('projects_agency'),'trim|required');
			$this->form_validation->set_rules('project_account_manager',$this->lang->line('projects_account_manager'),'trim|required');
			$this->form_validation->set_rules('project_campaign_start',$this->lang->line('projects_campaign_start'),'trim|exact_length[10]|required');
			$this->form_validation->set_rules('project_campaign_end',$this->lang->line('projects_campaign_end'),'trim|exact_length[10]|required');
			$this->form_validation->set_rules('project_date_filed',$this->lang->line('projects_date_filed'),'trim|exact_length[10]|required');
			$this->form_validation->set_rules('project_date_closed',$this->lang->line('projects_date_closed'),'trim|exact_length[10]|required');
			$this->form_validation->set_rules('project_status',$this->lang->line('projects_status'),'trim|required');
			
			if (!$this->form_validation->run())
			{
				// Throw error
				echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning">'.validation_errors().'</div>'));
				exit;
			}
			else
			{
				// Save new clients name first
				if (!$this->model_clients->clientNameExists($this->input->post('project_client'),$this->input->post('project_department')))
				{
					$projectClientIdRequest = $this->model_clients->setNewClient(
						array(
							'client_id' => $this->session->userdata('id').time(),
							'name' => $this->input->post('project_client'),
							'department_id' => $this->input->post('project_department'),
						)
					);
				}
				else
				{
					$clientData = $this->model_clients->getClientByName($this->input->post('project_client'),$this->input->post('project_department'));
					$projectClientIdRequest = $clientData[0]->client_id;
				}
				
				
				
				
				
				// Save new agency name first
				if (!$this->model_agencies->agencyNameExists($this->input->post('project_agency')))
				{
					$projectAgencyIdRequest = $this->model_agencies->setNewAgency(
						array(
							'agency_id' => $this->session->userdata('id').time(),
							'name' => $this->input->post('project_agency')
						)
					);
				}
				else
				{
					$agencyData = $this->model_agencies->getAgencyByName($this->input->post('project_agency'));
					$projectAgencyIdRequest = $agencyData[0]->agency_id;
				}
				
				
				
				
				
				// Save new account manager name first
				if (!$this->model_account_managers->accoutManagerNameExists($this->input->post('project_account_manager'),$this->input->post('project_department')))
				{
					$projectAccountManagerIdRequest = $this->model_account_managers->setNewAccountManager(
						array(
							'account_manager_id' => $this->session->userdata('id').time(),
							'name' => $this->input->post('project_account_manager'),
							'department_id' => $this->input->post('project_department'),
						)
					);
				}
				else
				{
					$accountManagerData = $this->model_account_managers->getAccountManagerByName($this->input->post('project_account_manager'),$this->input->post('project_department'));
					$projectAccountManagerIdRequest = $accountManagerData[0]->account_manager_id;
				}
				
				
				
				
				
				// Save new project
				$projectIdRequest = $this->model_projects->setNewProject(
					array(
						'project_id' => $this->session->userdata('id').time(),
						'name' => $this->input->post('project_name'),
						'code' => $this->input->post('project_code'),
						'budget' => $this->input->post('project_budget'),
						'department_id' => $this->input->post('project_department'),
						'client_id' => $projectClientIdRequest,
						'agency_id' => $projectAgencyIdRequest,
						'account_manager_id' => $projectAccountManagerIdRequest,
						'campaign_start' => $this->input->post('project_campaign_start'),
						'campaign_end' => $this->input->post('project_campaign_end'),
						'date_filed' => $this->input->post('project_date_filed'),
						'date_closed' => $this->input->post('project_date_closed'),
						'status' => $this->input->post('project_status')
					)
				);
				
				// Throw success
				echo json_encode(array('is_success' => true,'project_id' => $projectIdRequest));
				exit;
			}
		}
		
		$this->load->view('projects/add',$this->assign);
	}
	
	
	
	
	function edit() // Always ajax
	{
		// Check if ajax request
		if (!$this->input->is_ajax_request())
		{
			// Redirect to not found
			redirect(site_url('error/notfound'));
		}
		
		// Check permission
		if (!$this->zacl->check_acl('projects/edit',$this->assign['is_user'][0]->role))
		{
			// Throw error
			echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning"><p>'.$this->lang->line('global_error_page_not_found').'</p></div>'));
			exit;
		}
		
		// Check session
		if (!$this->input->get('is_ajax') || $this->input->get('ajax_id') != $this->assign['ajax_id'] || $this->input->get('ajax_session_id') != $this->assign['ajax_session_id'])
		{
			// Throw error
			echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning"><p>'.$this->lang->line('global_error_session_timeout').'</p></div>'));
			exit;
		}
		
		// Check if project exists
		if (!$this->input->get('project_id') || !$this->model_projects->projectIdExists($this->input->get('project_id')))
		{
			// Throw error
			echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning"><p>'.$this->lang->line('global_error_page_not_found').'</p></div>'));
			exit;
		}
		
		// Set as Ajax
		$this->assign['is_ajax'] = true;
		
		// Set project info
		$this->assign['project_data'] = $this->model_projects->getProjectById($this->input->get('project_id'));
		
		// Set form
		$this->assign['project_name'] = array( // Name
			'type' => 'text',
			'name' => 'project_name',
			'id' => 'project_name',
			'placeholder' => $this->lang->line('projects_project_name'),
			'title' => $this->lang->line('projects_project_name'),
			'class' => 'form-control verifyText',
			'value' => $this->assign['project_data'][0]->name
		);
		$this->assign['project_code'] = array( // Code
			'type' => 'text',
			'name' => 'project_code',
			'id' => 'project_code',
			'placeholder' => $this->lang->line('projects_project_code'),
			'title' => $this->lang->line('projects_project_code'),
			'class' => 'form-control verifyText',
			'value' => $this->assign['project_data'][0]->code
		);
		$this->assign['project_budget'] = array( // Budget
			'type' => 'number',
			'name' => 'project_budget',
			'id' => 'project_budget',
			'placeholder' => $this->lang->line('projects_project_budget'),
			'title' => $this->lang->line('projects_project_budget'),
			'class' => 'form-control verifyInteger',
			'value' => $this->assign['project_data'][0]->budget
		);
		$this->assign['project_department'] = array( // Department
			'name' => 'project_department',
			'id' => 'project_department',
			'value' => $this->assign['project_data'][0]->department_id
		);
		$this->assign['project_client'] = array( // Client
			'type' => 'text',
			'name' => 'project_client',
			'id' => 'project_client',
			'placeholder' => $this->lang->line('projects_client'),
			'title' => $this->lang->line('projects_client'),
			'class' => 'form-control verifyText',
			'value' => $this->assign['project_data'][0]->client_name
		);
		$this->assign['project_agency'] = array( // Agency
			'type' => 'text',
			'name' => 'project_agency',
			'id' => 'project_agency',
			'placeholder' => $this->lang->line('projects_agency'),
			'title' => $this->lang->line('projects_agency'),
			'class' => 'form-control verifyText',
			'value' => $this->assign['project_data'][0]->agency_name
		);
		$this->assign['project_account_manager'] = array( // Account Manager
			'type' => 'text',
			'name' => 'project_account_manager',
			'id' => 'project_account_manager',
			'placeholder' => $this->lang->line('projects_account_manager'),
			'title' => $this->lang->line('projects_account_manager'),
			'class' => 'form-control verifyText',
			'value' => $this->assign['project_data'][0]->account_manager_name
		);
		$this->assign['project_campaign_start'] = array( // Campaign Start
			'type' => 'hidden',
			'name' => 'project_campaign_start',
			'id' => 'project_campaign_start',
			'placeholder' => $this->lang->line('projects_date_format'),
			'title' => $this->lang->line('projects_campaign_start'),
			'value' => $this->assign['project_data'][0]->campaign_start,
			'class' => 'form-control verifyText',
			'readonly' => 'readonly'
		);
		$this->assign['project_campaign_end'] = array( // Campaign End
			'type' => 'hidden',
			'name' => 'project_campaign_end',
			'id' => 'project_campaign_end',
			'placeholder' => $this->lang->line('projects_date_format'),
			'title' => $this->lang->line('projects_campaign_end'),
			'value' => $this->assign['project_data'][0]->campaign_end,
			'class' => 'form-control verifyText',
			'readonly' => 'readonly'
		);
		$this->assign['project_date_filed'] = array( // Date Filed
			'type' => 'hidden',
			'name' => 'project_date_filed',
			'id' => 'project_date_filed',
			'placeholder' => $this->lang->line('projects_date_format'),
			'title' => $this->lang->line('projects_date_filed'),
			'value' => $this->assign['project_data'][0]->date_filed,
			'class' => 'form-control verifyText',
			'readonly' => 'readonly'
		);
		$this->assign['project_date_closed'] = array( // Date Closed
			'type' => 'hidden',
			'name' => 'project_date_closed',
			'id' => 'project_date_closed',
			'placeholder' => $this->lang->line('projects_date_format'),
			'title' => $this->lang->line('projects_date_closed'),
			'value' => $this->assign['project_data'][0]->date_closed,
			'class' => 'form-control verifyText',
			'readonly' => 'readonly'
		);
		$this->assign['project_status'] = array( // Status
			'name' => 'project_status',
			'id' => 'project_status',
			'value' => $this->assign['project_data'][0]->status
		);
		
		$this->assign['client_list'] = $this->model_clients->getAllClient(); // Client List
		$this->assign['agency_list'] = $this->model_agencies->getAllAgency(); // Agency List
		$this->assign['account_manager_list'] = $this->model_account_managers->getAllAccountManager(); // Account Manager List
		
		#echo '<pre>';
		#print_r($this->assign);
		#exit;
		
		// If request post sent
		if ($_POST)
		{
			#echo json_encode(array('is_error' => true,'errors' => '<pre>'.var_export($_POST,true).'</pre>'));
			#exit;
			
			$this->form_validation->set_rules('project_name',$this->lang->line('projects_project_name'),'trim|required');
			$this->form_validation->set_rules('project_code',$this->lang->line('projects_project_code'),'trim|required');
			$this->form_validation->set_rules('project_budget',$this->lang->line('projects_project_budget'),'trim|is_natural_no_zero|required');
			$this->form_validation->set_rules('project_department',$this->lang->line('projects_department'),'trim|alpha|required');
			$this->form_validation->set_rules('project_client',$this->lang->line('projects_client'),'trim|required');
			$this->form_validation->set_rules('project_agency',$this->lang->line('projects_agency'),'trim|required');
			$this->form_validation->set_rules('project_account_manager',$this->lang->line('projects_account_manager'),'trim|required');
			$this->form_validation->set_rules('project_campaign_start',$this->lang->line('projects_campaign_start'),'trim|exact_length[10]|required');
			$this->form_validation->set_rules('project_campaign_end',$this->lang->line('projects_campaign_end'),'trim|exact_length[10]|required');
			$this->form_validation->set_rules('project_date_filed',$this->lang->line('projects_date_filed'),'trim|exact_length[10]|required');
			$this->form_validation->set_rules('project_date_closed',$this->lang->line('projects_date_closed'),'trim|exact_length[10]|required');
			$this->form_validation->set_rules('project_status',$this->lang->line('projects_status'),'trim|required');
			
			if (!$this->form_validation->run())
			{
				// Throw error
				echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning">'.validation_errors().'</div>'));
				exit;
			}
			else
			{
				// Save new clients name first
				if (!$this->model_clients->clientNameExists($this->input->post('project_client'),$this->input->post('project_department')))
				{
					$projectClientIdRequest = $this->model_clients->setNewClient(
						array(
							'client_id' => $this->session->userdata('id').time(),
							'name' => $this->input->post('project_client'),
							'department_id' => $this->input->post('project_department'),
						)
					);
				}
				else
				{
					$clientData = $this->model_clients->getClientByName($this->input->post('project_client'),$this->input->post('project_department'));
					$projectClientIdRequest = $clientData[0]->client_id;
				}
				
				
				
				
				
				// Save new agency name first
				if (!$this->model_agencies->agencyNameExists($this->input->post('project_agency')))
				{
					$projectAgencyIdRequest = $this->model_agencies->setNewAgency(
						array(
							'agency_id' => $this->session->userdata('id').time(),
							'name' => $this->input->post('project_agency')
						)
					);
				}
				else
				{
					$agencyData = $this->model_agencies->getAgencyByName($this->input->post('project_agency'));
					$projectAgencyIdRequest = $agencyData[0]->agency_id;
				}
				
				
				
				
				
				// Save new account manager name first
				if (!$this->model_account_managers->accoutManagerNameExists($this->input->post('project_account_manager'),$this->input->post('project_department')))
				{
					$projectAccountManagerIdRequest = $this->model_account_managers->setNewAccountManager(
						array(
							'account_manager_id' => $this->session->userdata('id').time(),
							'name' => $this->input->post('project_account_manager'),
							'department_id' => $this->input->post('project_department'),
						)
					);
				}
				else
				{
					$accountManagerData = $this->model_account_managers->getAccountManagerByName($this->input->post('project_account_manager'),$this->input->post('project_department'));
					$projectAccountManagerIdRequest = $accountManagerData[0]->account_manager_id;
				}
				
				
				
				
				
				// Save updated project
				$projectAffectedRows = $this->model_projects->setUpdateProject(
					$this->input->get('project_id'),
					array(
						'name' => $this->input->post('project_name'),
						'code' => $this->input->post('project_code'),
						'budget' => $this->input->post('project_budget'),
						'department_id' => $this->input->post('project_department'),
						'client_id' => $projectClientIdRequest,
						'agency_id' => $projectAgencyIdRequest,
						'account_manager_id' => $projectAccountManagerIdRequest,
						'campaign_start' => $this->input->post('project_campaign_start'),
						'campaign_end' => $this->input->post('project_campaign_end'),
						'date_filed' => $this->input->post('project_date_filed'),
						'date_closed' => $this->input->post('project_date_closed'),
						'status' => $this->input->post('project_status')
					)
				);
				
				// Throw success
				echo json_encode(array('is_success' => true,'project_id' => $projectAffectedRows));
				exit;
			}
		}
		
		$this->load->view('projects/edit',$this->assign);
	}
	
	
	
	
	
	function cos() // Always ajax
	{
		// Check if ajax request
		if (!$this->input->is_ajax_request())
		{
			// Redirect to not found
			redirect(site_url('error/notfound'));
		}
		
		// Check permission
		if (!$this->zacl->check_acl('projects/cos',$this->assign['is_user'][0]->role))
		{
			// Throw error
			echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning"><p>'.$this->lang->line('global_error_page_not_found').'</p></div>'));
			exit;
		}
		
		// Check session
		if (!$this->input->get('is_ajax') || $this->input->get('ajax_id') != $this->assign['ajax_id'] || $this->input->get('ajax_session_id') != $this->assign['ajax_session_id'])
		{
			// Throw error
			echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning"><p>'.$this->lang->line('global_error_session_timeout').'</p></div>'));
			exit;
		}
		
		// Check if project exists
		if (!$this->input->get('project_id') || !$this->model_projects->projectIdExists($this->input->get('project_id')))
		{
			// Throw error
			echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning"><p>'.$this->lang->line('global_error_page_not_found').'</p></div>'));
			exit;
		}
		
		// Set as Ajax
		$this->assign['is_ajax'] = true;
		
		// Set project info
		$this->assign['project_data'] = $this->model_projects->getProjectById($this->input->get('project_id'));
		
		// Cost of sales
		$cost_of_sales_all = $this->model_cost_of_sales->getCostOfSaleByProjectId($this->input->get('project_id'));
		foreach($cost_of_sales_all as $k => $v)
		{
			$this->assign['project_data'][0]->cost_of_sales[$cost_of_sales_all[$k]->type] = $this->model_cost_of_sales->getCostOfSaleByTypeAndProjectId($cost_of_sales_all[$k]->type,$this->input->get('project_id'));
		}
		
		// Cost of sales budget track
		foreach($this->assign['project_data'][0]->cost_of_sales as $k => $v)
		{
			foreach($v as $i => $j)
			{
				//print_r($j);
				//echo $j->source.'<br />';
				for($yearCount = YEAR_START; $yearCount <= YEAR_CONS; $yearCount++)
				{
					//$j->budget_track[$yearCount] = $this->model_cost_of_sales->getCostOfSalesBudgetTrackByCostOfSalesIdAndProjectIdAndYear($j->cost_of_sale_id,$j->project_id,$yearCount);
					$temp = $this->model_cost_of_sales_budget_track->getCostOfSalesBudgetTrackByCostOfSalesIdAndProjectIdAndYear($j->cost_of_sale_id,$j->project_id,$yearCount);
					foreach($temp as $tp => $tt)
					{
						$j->budget_track[$yearCount][$temp[$tp]->month] = $temp[$tp];
					}
					//echo $yearCount.'<br />';
				}
			}
		}
		
		//$this->assign['project_data'][0]->cost_of_sales;
		//echo '<pre>';
		//print_r($this->assign['project_data']);
		//exit;
		
		$this->load->view('projects/cos',$this->assign);
	}
	
	
	
	
	
	function add_cos() // Always ajax
	{
		// Check if ajax request
		if (!$this->input->is_ajax_request())
		{
			// Redirect to not found
			redirect(site_url('error/notfound'));
		}
		
		// Check permission
		if (!$this->zacl->check_acl('projects/add_cos',$this->assign['is_user'][0]->role))
		{
			// Throw error
			echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning"><p>'.$this->lang->line('global_error_page_not_found').'</p></div>'));
			exit;
		}
		
		// Check session
		if (!$this->input->get('is_ajax') || $this->input->get('ajax_id') != $this->assign['ajax_id'] || $this->input->get('ajax_session_id') != $this->assign['ajax_session_id'])
		{
			// Throw error
			echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning"><p>'.$this->lang->line('global_error_session_timeout').'</p></div>'));
			exit;
		}
		
		// Check if project exists
		if (!$this->input->get('project_id') || !$this->model_projects->projectIdExists($this->input->get('project_id')))
		{
			// Throw error
			echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning"><p>'.$this->lang->line('global_error_page_not_found').'</p></div>'));
			exit;
		}
		
		// Set as Ajax
		$this->assign['is_ajax'] = true;
		
		// Set project id
		$this->assign['project_data'] = $this->model_projects->getProjectById($this->input->get('project_id'));
		
		$this->assign['project_cos_source'] = array( // Source
			'type' => 'text',
			'name' => 'project_cos_source_'.$this->assign['project_data'][0]->project_id,
			'id' => 'project_cos_source_'.$this->assign['project_data'][0]->project_id,
			'placeholder' => $this->lang->line('projects_cost_of_sale_source'),
			'title' => $this->lang->line('projects_cost_of_sale_source'),
			'class' => 'form-control verifyText'
		);
		$this->assign['project_cos_budget'] = array( // Budget
			'type' => 'number',
			'name' => 'project_cos_budget_'.$this->assign['project_data'][0]->project_id,
			'id' => 'project_cos_budget_'.$this->assign['project_data'][0]->project_id,
			'placeholder' => $this->lang->line('projects_cost_of_sale_budget'),
			'title' => $this->lang->line('projects_cost_of_sale_budget'),
			'class' => 'form-control verifyInteger'
		);
		$this->assign['project_cos_type'] = array( // COS Type
			'name' => 'project_cos_type_'.$this->assign['project_data'][0]->project_id,
			'id' => 'project_cos_type_'.$this->assign['project_data'][0]->project_id
		);
		
		// If request post sent
		if ($_POST)
		{
			$this->form_validation->set_rules('project_cos_source_'.$this->assign['project_data'][0]->project_id,$this->lang->line('projects_cost_of_sale_source'),'trim|required');
			$this->form_validation->set_rules('project_cos_budget_'.$this->assign['project_data'][0]->project_id,$this->lang->line('projects_cost_of_sale_budget'),'trim|is_natural_no_zero|required');
			$this->form_validation->set_rules('project_cos_type_'.$this->assign['project_data'][0]->project_id,$this->lang->line('projects_cost_of_sale_type'),'trim|required');
			
			if (!$this->form_validation->run())
			{
				// Throw error
				echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning">'.validation_errors().'</div>'));
				exit;
			}
			else
			{
				// Save new cost of sale
				$costOfSaleIdRequest = $this->model_cost_of_sales->setNewCostOfSale(
					array(
						'cost_of_sale_id' => $this->session->userdata('id').time(),
						'project_id' => $this->assign['project_data'][0]->project_id,
						'source' => $this->input->post('project_cos_source_'.$this->assign['project_data'][0]->project_id),
						'budget' => $this->input->post('project_cos_budget_'.$this->assign['project_data'][0]->project_id),
						'type' => $this->input->post('project_cos_type_'.$this->assign['project_data'][0]->project_id),
					)
				);
				
				// Get new cost sale info
				$costOfSaleRequestData = $this->model_cost_of_sales->getCostOfSaleByIdAndProjectId($costOfSaleIdRequest,$this->assign['project_data'][0]->project_id);
				
				// Throw success
				echo json_encode(array('is_success' => true,'content' => $costOfSaleRequestData));
				exit;
			}
		}
		
		//echo '<pre>';
		//print_r($this->assign);
		//exit;
		
		$this->load->view('projects/add_cos',$this->assign);
	}
	
	
	
	
	
	function edit_cos() // Always ajax
	{
		// Check if ajax request
		if (!$this->input->is_ajax_request())
		{
			// Redirect to not found
			redirect(site_url('error/notfound'));
		}
		
		// Check permission
		if (!$this->zacl->check_acl('projects/edit_cos',$this->assign['is_user'][0]->role))
		{
			// Throw error
			echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning"><p>'.$this->lang->line('global_error_page_not_found').'</p></div>'));
			exit;
		}
		
		// Check session
		if (!$this->input->get('is_ajax') || $this->input->get('ajax_id') != $this->assign['ajax_id'] || $this->input->get('ajax_session_id') != $this->assign['ajax_session_id'])
		{
			// Throw error
			echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning"><p>'.$this->lang->line('global_error_session_timeout').'</p></div>'));
			exit;
		}
		
		// Check if project exists
		if (!$this->input->get('project_id') || !$this->model_projects->projectIdExists($this->input->get('project_id')))
		{
			// Throw error
			echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning"><p>'.$this->lang->line('global_error_page_not_found').'</p></div>'));
			exit;
		}
		
		// Check if cost of sale exists
		if (!$this->input->get('cost_of_sale_id') || !$this->model_cost_of_sales->costOfSaleIdExists($this->input->get('cost_of_sale_id')))
		{
			// Throw error
			echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning"><p>'.$this->lang->line('global_error_page_not_found').'</p></div>'));
			exit;
		}
		
		// Set as Ajax
		$this->assign['is_ajax'] = true;
		
		// Set project info
		$this->assign['project_data'] = $this->model_projects->getProjectById($this->input->get('project_id'));
		
		// Set cost of sale info
		$this->assign['cost_of_sale_data'] = $this->model_cost_of_sales->getCostOfSaleByIdAndProjectId($this->input->get('cost_of_sale_id'),$this->input->get('project_id'));
		
		$this->assign['project_cos_source'] = array( // Source
			'type' => 'text',
			'name' => 'project_cos_source_'.$this->assign['cost_of_sale_data'][0]->cost_of_sale_id,
			'id' => 'project_cos_source_'.$this->assign['cost_of_sale_data'][0]->cost_of_sale_id,
			'placeholder' => $this->lang->line('projects_cost_of_sale_source'),
			'title' => $this->lang->line('projects_cost_of_sale_source'),
			'class' => 'form-control verifyText',
			'value' => $this->assign['cost_of_sale_data'][0]->source,
		);
		
		$this->assign['project_cos_budget'] = array( // Budget
			'type' => 'number',
			'name' => 'project_cos_budget_'.$this->assign['cost_of_sale_data'][0]->cost_of_sale_id,
			'id' => 'project_cos_budget_'.$this->assign['cost_of_sale_data'][0]->cost_of_sale_id,
			'placeholder' => $this->lang->line('projects_cost_of_sale_budget'),
			'title' => $this->lang->line('projects_cost_of_sale_budget'),
			'class' => 'form-control verifyInteger',
			'value' => $this->assign['cost_of_sale_data'][0]->budget,
		);
		
		$this->assign['project_cos_type'] = array( // COS Type
			'name' => 'project_cos_type_'.$this->assign['cost_of_sale_data'][0]->cost_of_sale_id,
			'id' => 'project_cos_type_'.$this->assign['cost_of_sale_data'][0]->cost_of_sale_id,
			'value' => $this->assign['cost_of_sale_data'][0]->type,
		);
		
		// If request post sent
		if ($_POST)
		{
			#echo json_encode(array('is_error' => true,'errors' => '<pre>'.var_export($_POST,true).'</pre>'));
			#echo json_encode(array('is_success' => true));
			#exit;
			
			$this->form_validation->set_rules('project_cos_source_'.$this->assign['cost_of_sale_data'][0]->cost_of_sale_id,$this->lang->line('projects_cost_of_sale_source'),'trim|required');
			$this->form_validation->set_rules('project_cos_budget_'.$this->assign['cost_of_sale_data'][0]->cost_of_sale_id,$this->lang->line('projects_cost_of_sale_budget'),'trim|is_natural_no_zero|required');
			$this->form_validation->set_rules('project_cos_type_'.$this->assign['cost_of_sale_data'][0]->cost_of_sale_id,$this->lang->line('projects_cost_of_sale_type'),'trim|required');
			
			if (!$this->form_validation->run())
			{
				// Throw error
				echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning">'.validation_errors().'</div>'));
				exit;
			}
			else
			{
				// Save updated cost of sale
				$this->model_cost_of_sales->setUpdateCostOfSale(
					$this->input->get('cost_of_sale_id'),
					array(
						'source' => $this->input->post('project_cos_source_'.$this->assign['cost_of_sale_data'][0]->cost_of_sale_id),
						'budget' => $this->input->post('project_cos_budget_'.$this->assign['cost_of_sale_data'][0]->cost_of_sale_id),
						'type' => $this->input->post('project_cos_type_'.$this->assign['cost_of_sale_data'][0]->cost_of_sale_id),
					)
				);
				
				// Get new cost sale info
				$costOfSaleRequestData = $this->model_cost_of_sales->getCostOfSaleByIdAndProjectId($this->assign['cost_of_sale_data'][0]->cost_of_sale_id,$this->assign['cost_of_sale_data'][0]->project_id);
				
				// Throw success
				echo json_encode(array('is_success' => true,'content' => $costOfSaleRequestData));
				exit;
			}
		}
		
		//echo '<pre>';
		//print_r($this->assign);
		//exit;
		
		$this->load->view('projects/edit_cos',$this->assign);
	}
	
	
	
	
	
	function budget_track() // Always ajax
	{
		// Check if ajax request
		if (!$this->input->is_ajax_request())
		{
			// Redirect to not found
			redirect(site_url('error/notfound'));
		}
		
		// Check permission
		if (!$this->zacl->check_acl('projects/budget_track',$this->assign['is_user'][0]->role))
		{
			// Throw error
			//echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning"><p>'.$this->lang->line('global_error_page_not_found').'</p></div>'));
			//exit;
			header('HTTP/1.1 404 Not Found');
			exit($this->lang->line('global_error_page_not_found'));
		}
		
		// Check session
		if (!$this->input->get('is_ajax') || $this->input->get('ajax_id') != $this->assign['ajax_id'] || $this->input->get('ajax_session_id') != $this->assign['ajax_session_id'])
		{
			// Throw error
			//echo json_encode(array('is_error' => true,'errors' => '<div class="alert alert-warning"><p>'.$this->lang->line('global_error_session_timeout').'</p></div>'));
			//exit;
			header('HTTP/1.1 404 Not Found');
			exit($this->lang->line('global_error_session_timeout'));
		}
		
		// Check if project exists
		if (!$this->input->post('project_id') || !$this->model_projects->projectIdExists($this->input->post('project_id')))
		{
			// Throw error
			//echo json_encode(array('is_error' => true,'errors' => $this->lang->line('global_error_page_not_found')));
			//exit;
			header('HTTP/1.1 404 Not Found');
			exit($this->lang->line('global_error_page_not_found'));
		}
		
		// Check if cost of sale exists
		if (!$this->input->post('cost_of_sale_id') || !$this->model_cost_of_sales->costOfSaleIdExists($this->input->post('cost_of_sale_id')))
		{
			// Throw error
			//echo json_encode(array('is_error' => true,'errors' => $this->lang->line('global_error_page_not_found')));
			//exit;
			header('HTTP/1.1 404 Not Found');
			exit($this->lang->line('global_error_page_not_found'));
		}
		
		//echo json_encode(array('is_error' => true,'post' => var_export($_POST,true),'get' => var_export($_GET,true)));
		//exit;
		
		if ($_POST)
		{
			$this->form_validation->set_rules('value',$this->lang->line('projects_cost_of_sale_enter_budget'),'trim|is_natural|required');
			$this->form_validation->set_rules('month',$this->lang->line('projects_cost_of_sale_enter_month'),'trim|is_natural_no_zero|required');
			$this->form_validation->set_rules('year',$this->lang->line('projects_cost_of_sale_enter_year'),'trim|is_natural_no_zero|required');
			
			if (!$this->form_validation->run())
			{
				// Throw error
				header('HTTP/1.1 404 Not Found');
				exit($this->lang->line('projects_cost_of_sale_budget_not_number'));
			}
			else
			{
				// Save new cost of sale budget track
				if (!$this->input->post('pk') || $this->input->post('pk') == 0)
				{
					$costOfSaleBudgetTrackIdRequest = $this->model_cost_of_sales_budget_track->setNewCostOfSalesBudgetTrack(
						array(
							'cost_of_sale_budget_track_id' => $this->session->userdata('id').time(),
							'cost_of_sale_id' => $this->input->post('cost_of_sale_id'),
							'project_id' => $this->input->post('project_id'),
							'month' => $this->input->post('month'),
							'year' => $this->input->post('year'),
							'budget' => $this->input->post('value'),
						)
					);
					
					// Throw success
					echo json_encode(array('is_success' => true,'cost_of_sale_budget_track_id' => $costOfSaleBudgetTrackIdRequest));
					exit;
				}
				
				// Edit cost of sale budget track
				else if ($this->input->post('pk') && $this->model_cost_of_sales_budget_track->costOfSalesBudgetTrackIdExists($this->input->post('pk')))
				{
					// Save updated cost of sale
					$this->model_cost_of_sales_budget_track->setUpdateCostOfSalesBudgetTrack(
						$this->input->post('pk'),
						array(
							'budget' => $this->input->post('value'),
						)
					);
					
					// Get new cost sale info
					$costOfSaleBudgetTrackContent = $this->model_cost_of_sales_budget_track->getCostOfSalesBudgetTrackById($this->input->post('pk'));
					
					// Throw success
					echo json_encode(array('is_success' => true,'content' => $costOfSaleBudgetTrackContent));
					exit;
				}
				
				// Budget track doesnt exists
				else
				{
					header('HTTP/1.1 404 Not Found');
					exit($this->lang->line('projects_cost_of_sale_budget_not_exists'));
				}
			}
		}
	}
}