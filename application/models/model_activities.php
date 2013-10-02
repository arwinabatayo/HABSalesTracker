<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_activities extends CI_Model
{
	var $table_name = 'activities';
	
	function __construct()
	{
		parent::__construct();

		return $this->db->table_exists($this->table_name); //Check if table exists
	}
	
	
	
	
	
	/* =Setters
	-------------------------------------------------------------- */
	function setUserActivity($activity_data = array())
	{
		$this->db->set('activity_id',$activity_data['user_id'].time());
		$this->db->set('user_id',$activity_data['user_id']);
		$this->db->set('type',$activity_data['type']);
		$this->db->set('time',time());
		$this->db->set('data',$activity_data['data']);
		$this->db->insert($this->table_name);
		return $this->db->insert_id();
	}
	
	
	
	
	
	/* =Getters
	-------------------------------------------------------------- */
	
}