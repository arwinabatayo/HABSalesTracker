<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_sessions extends CI_Model
{
	var $table_name = 'sessions';
	
	function __construct()
	{
		parent::__construct();
		
		return $this->db->table_exists($this->table_name); //Check if table exists
	}
	
	
	
	
	
	/* =Getters
	-------------------------------------------------------------- */
	function getSessionById($session_id)
	{
		$this->db->where('session_id',$session_id);
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	
	
	
		
	/* =Getters
	-------------------------------------------------------------- */
	function sessionExists($session_id)
	{
		$this->db->select('session_id');
		$this->db->where('session_id',$session_id);
		$result = $this->db->get($this->table_name);
		return ($result->num_rows() == 1) ? true : false;
	}
}