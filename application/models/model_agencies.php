<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_agencies extends CI_Model
{
	var $table_name = 'agencies';
	
	function __construct()
	{
		parent::__construct();

		return $this->db->table_exists($this->table_name); //Check if table exists
	}
	
	
	
	
	/* =Setters
	-------------------------------------------------------------- */
	function setNewAgency($agency_data = array())
	{
		$this->db->set('agency_id',$agency_data['agency_id']);
		$this->db->set('name',$agency_data['name']);
		$this->db->set('created',date('Y-m-d G:i:s'));
		
		if ($user_data['active'])
		{
			$this->db->set('active',$agency_data['active']);
		}
		
		$this->db->insert($this->table_name);
		return $agency_data['agency_id'];
	}
	

	
	
	
	/* =Getters
	-------------------------------------------------------------- */
	function getAllAgency()
	{
		$this->db->select("name");
		$this->db->distinct("name");
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function getAgencyByName($name)
	{
		$this->db->select("agency_id, name");
		$this->db->where("name",$name);
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	
	
	
	/* =Checkers
	-------------------------------------------------------------- */
	function agencyNameExists($name)
	{
		$this->db->select('agency_id');
		$this->db->where('name',$name);
		$result = $this->db->get($this->table_name);
		return ($result->num_rows() == 1) ? true : false;
	}
}