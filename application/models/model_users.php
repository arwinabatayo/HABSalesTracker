<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_users extends CI_Model
{
	var $table_name = 'users';
	
	function __construct()
	{
		parent::__construct();

		return $this->db->table_exists($this->table_name); //Check if table exists
	}
	
	
	
	
	/* =Setters
	-------------------------------------------------------------- */
	function setNewUser($user_data = array())
	{
		$this->db->set('email',$user_data['email']);
		$this->db->set('password',"AES_ENCRYPT('{$user_data['password']}','".SITE_SECRET_KEY."')",false);
		$this->db->set('name',$user_data['name']);
		$this->db->set('role',$user_data['role']);
		$this->db->set('last_ip',$user_data['last_ip']);
		$this->db->set('created',date('Y-m-d G:i:s'));
		
		if ($user_data['active'])
		{
			$this->db->set('active',$user_data['active']);
		}
		
		$this->db->insert($this->table_name);
		return $this->db->insert_id();
	}
	
	function setLastActivity($user_id)
	{
		$this->db->where('id',$user_id);
		$this->db->set('last_activity',time()); 
		$this->db->update($this->table_name);
		return $this->db->affected_rows();
	}
	
	function setLastLogin($user_id)
	{
		$this->db->where('id',$user_id);
		$this->db->set('last_login',date("Y-m-d H:i:s")); 
		$this->db->update($this->table_name);
		return $this->db->affected_rows();
	}
	
	function setLastLogout($user_id)
	{
		$this->db->where('id',$user_id);
		$this->db->set('last_logout',date("Y-m-d H:i:s")); 
		$this->db->update($this->table_name);
		return $this->db->affected_rows();
	}
	
	
	
	
	/* =Getters
	-------------------------------------------------------------- */
	function getUserById($user_id)
	{
		$this->db->where('id',$user_id);
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function getUserByEmail($email)
	{
		$this->db->where('email',$email);
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function getUserByPassword($user_id,$password)
	{
		$this->db->select("id,AES_DECRYPT(password,'".SITE_SECRET_KEY."') as password",false);
		$this->db->where('id',$user_id);
		$this->db->where('password',"AES_ENCRYPT('{$password}','".SITE_SECRET_KEY."')",false);
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function getUserPassword($user_id)
	{
		$this->db->select("AES_DECRYPT(password,'".SITE_SECRET_KEY."') as password",false);
		$this->db->where('id',$user_id);
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	
	
	
	/* =Checkers
	-------------------------------------------------------------- */
	function userLoginByEmail($email,$password)
	{
		$this->db->select('id');
		$this->db->where('email',$email);
		$this->db->where('password',"AES_ENCRYPT('{$password}','".SITE_SECRET_KEY."')",false);
		$this->db->where('active','true');
		$result = $this->db->get($this->table_name);
		return ($result->num_rows() == 1) ? true : false;
	}
	
	function userEmailExists($email)
	{
		$this->db->select('id');
		$this->db->where('email',$email);
		$result = $this->db->get($this->table_name);
		return ($result->num_rows() == 1) ? true : false;
	}
	
	function userIdExists($user_id)
	{
		$this->db->select('id');
		$this->db->where('id',$user_id);
		$result = $this->db->get($this->table_name);
		return ($result->num_rows() == 1) ? true : false;
	}
	
	function userIdActive($user_id)
	{
		$this->db->select('id');
		$this->db->where('id',$user_id);
		$this->db->where('active','true');
		$result = $this->db->get($this->table_name);
		return ($result->num_rows() == 1) ? true : false;
	}
}