<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_account_managers extends CI_Model
{
	var $table_name = 'account_managers';
	
	function __construct()
	{
		parent::__construct();

		return $this->db->table_exists($this->table_name); //Check if table exists
	}
	
	
	
	
	/* =Setters
	-------------------------------------------------------------- */
	function setNewAccountManager($account_manager_data = array())
	{
		$this->db->set('account_manager_id',$account_manager_data['account_manager_id']);
		$this->db->set('name',$account_manager_data['name']);
		$this->db->set('department_id',$account_manager_data['department_id']);
		$this->db->set('created',date('Y-m-d G:i:s'));
		
		if ($user_data['active'])
		{
			$this->db->set('active',$account_manager_data['active']);
		}
		
		$this->db->insert($this->table_name);
		return $account_manager_data['account_manager_id'];
	}
	

	
	
	
	/* =Getters
	-------------------------------------------------------------- */
	function getAllAccountManager()
	{
		$this->db->select("name");
		$this->db->distinct("name");
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function getAccountManagerByName($name,$department_id)
	{
		$this->db->select("account_manager_id, name, department_id");
		$this->db->where("name",$name);
		$this->db->where("department_id",$department_id);
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	
	
	
	/* =Checkers
	-------------------------------------------------------------- */
	function accoutManagerNameExists($name,$department_id)
	{
		$this->db->select('account_manager_id');
		$this->db->where('name',$name);
		$this->db->where('department_id',$department_id);
		$result = $this->db->get($this->table_name);
		return ($result->num_rows() == 1) ? true : false;
	}
}