<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_clients extends CI_Model
{
	var $table_name = 'clients';
	
	function __construct()
	{
		parent::__construct();

		return $this->db->table_exists($this->table_name); //Check if table exists
	}
	
	
	
	
	/* =Setters
	-------------------------------------------------------------- */
	function setNewClient($client_data = array())
	{
		$this->db->set('client_id',$client_data['client_id']);
		$this->db->set('name',$client_data['name']);
		$this->db->set('department_id',$client_data['department_id']);
		$this->db->set('created',date('Y-m-d G:i:s'));
		
		if ($user_data['active'])
		{
			$this->db->set('active',$client_data['active']);
		}
		
		$this->db->insert($this->table_name);
		return $client_data['client_id'];
	}
	

	
	
	
	/* =Getters
	-------------------------------------------------------------- */
	function getAllClient()
	{
		$this->db->select("name");
		$this->db->distinct("name");
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function getClientByName($name,$department_id)
	{
		$this->db->select("client_id, name, department_id");
		$this->db->where("name",$name);
		$this->db->where("department_id",$department_id);
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function getClientByIdAndProjectId($client_id,$project_id)
	{
		$this->db->where("client_id",$client_id);
		$this->db->where("project_id",$project_id);
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	
	
	
	/* =Checkers
	-------------------------------------------------------------- */
	function clientNameExists($name,$department_id)
	{
		$this->db->select('client_id');
		$this->db->where('name',$name);
		$this->db->where('department_id',$department_id);
		$result = $this->db->get($this->table_name);
		return ($result->num_rows() == 1) ? true : false;
	}
}