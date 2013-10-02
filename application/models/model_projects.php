<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_projects extends CI_Model
{
	var $table_name = 'projects';
	
	function __construct()
	{
		parent::__construct();

		return $this->db->table_exists($this->table_name); //Check if table exists
	}
	
	
	
	
	/* =Setters
	-------------------------------------------------------------- */
	function setNewProject($project_data = array())
	{
		$this->db->set('project_id',$project_data['project_id']);
		$this->db->set('name',$project_data['name']);
		$this->db->set('code',$project_data['code']);
		$this->db->set('budget',$project_data['budget']);
		$this->db->set('department_id',$project_data['department_id']);
		$this->db->set('client_id',$project_data['client_id']);
		$this->db->set('agency_id',$project_data['agency_id']);
		$this->db->set('account_manager_id',$project_data['account_manager_id']);
		$this->db->set('campaign_start',$project_data['campaign_start']);
		$this->db->set('campaign_end',$project_data['campaign_end']);
		$this->db->set('date_filed',$project_data['date_filed']);
		$this->db->set('date_closed',$project_data['date_closed']);
		$this->db->set('status',$project_data['status']);
		$this->db->set('created',date('Y-m-d G:i:s'));
		$this->db->insert($this->table_name);
		return $project_data['project_id'];
	}
	
	function setUpdateProject($project_id,$project_data = array())
	{
		$this->db->where('project_id',$project_id);
		$this->db->set('name',$project_data['name']);
		$this->db->set('code',$project_data['code']);
		$this->db->set('budget',$project_data['budget']);
		$this->db->set('department_id',$project_data['department_id']);
		$this->db->set('client_id',$project_data['client_id']);
		$this->db->set('agency_id',$project_data['agency_id']);
		$this->db->set('account_manager_id',$project_data['account_manager_id']);
		$this->db->set('campaign_start',$project_data['campaign_start']);
		$this->db->set('campaign_end',$project_data['campaign_end']);
		$this->db->set('date_filed',$project_data['date_filed']);
		$this->db->set('date_closed',$project_data['date_closed']);
		$this->db->set('status',$project_data['status']);
		$this->db->update($this->table_name);
		return $this->db->affected_rows();
	}
	
	
	
	
	
	/* =Getters
	-------------------------------------------------------------- */
	function getAllProjects()
	{
		$this->db->select('vnt_projects.*');
		$this->db->select('vnt_clients.name AS client_name');
		$this->db->select('vnt_agencies.name AS agency_name');
		$this->db->select('vnt_account_managers.name AS account_manager_name');
		
		$this->db->join('vnt_clients','vnt_projects.client_id = vnt_clients.client_id','left');
		$this->db->join('vnt_agencies','vnt_projects.agency_id = vnt_agencies.agency_id','left');
		$this->db->join('vnt_account_managers','vnt_projects.account_manager_id = vnt_account_managers.account_manager_id','left');
		
		$this->db->group_by('vnt_projects.project_id');
		$this->db->order_by('vnt_projects.created DESC');
		$query = $this->db->get($this->table_name);
		
		return $query->result();
	}
	
	function getProjectById($project_id)
	{
		$this->db->select('vnt_projects.*');
		$this->db->select('vnt_clients.name AS client_name');
		$this->db->select('vnt_agencies.name AS agency_name');
		$this->db->select('vnt_account_managers.name AS account_manager_name');
		
		$this->db->join('vnt_clients','vnt_projects.client_id = vnt_clients.client_id','left');
		$this->db->join('vnt_agencies','vnt_projects.agency_id = vnt_agencies.agency_id','left');
		$this->db->join('vnt_account_managers','vnt_projects.account_manager_id = vnt_account_managers.account_manager_id','left');
		
		$this->db->group_by('vnt_projects.project_id');
		$this->db->where('vnt_projects.project_id',$project_id);
		$this->db->order_by('vnt_projects.created DESC');
		$query = $this->db->get($this->table_name);
		
		return $query->result();
	}
	
	function getProjectByDepartment($department_id)
	{
		$this->db->select('vnt_projects.*');
		$this->db->select('vnt_clients.name AS client_name');
		$this->db->select('vnt_agencies.name AS agency_name');
		$this->db->select('vnt_account_managers.name AS account_manager_name');
		
		$this->db->join('vnt_clients','vnt_projects.client_id = vnt_clients.client_id','left');
		$this->db->join('vnt_agencies','vnt_projects.agency_id = vnt_agencies.agency_id','left');
		$this->db->join('vnt_account_managers','vnt_projects.account_manager_id = vnt_account_managers.account_manager_id','left');
		
		$this->db->group_by('vnt_projects.project_id');
		$this->db->where('vnt_projects.department_id',$department_id);
		$this->db->order_by('vnt_projects.created DESC');
		$query = $this->db->get($this->table_name);
		
		return $query->result();
	}
	
	
	
	
	/* =Checkers
	-------------------------------------------------------------- */
	function projectIdExists($project_id)
	{
		$this->db->select('project_id');
		$this->db->where('project_id',$project_id);
		$result = $this->db->get($this->table_name);
		return ($result->num_rows() == 1) ? true : false;
	}
}