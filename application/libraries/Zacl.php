<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Zacl
{
	protected $CI;
	
	function __construct()
	{
		// Get the instance
		$this->CI =& get_instance();
		
		// Append Zend's folder in PHP's include path
		set_include_path(get_include_path() . PATH_SEPARATOR . APPPATH . 'libraries');
		
		// Set the include path and require the needed files
		require_once(APPPATH . '/libraries/Zend/Acl.php');
		require_once(APPPATH . '/libraries/Zend/Acl/Role.php');
		require_once(APPPATH . '/libraries/Zend/Acl/Resource.php');
		
		// Create a new Acl object
		$this->acl = new Zend_Acl();
		
		// Add roles
		$this->acl->addRole(new Zend_Acl_Role('super')); // Super
		#$this->acl->addRole(new Zend_Acl_Role('director')); // Director
		#$this->acl->addRole(new Zend_Acl_Role('executive')); // Executive
		#$this->acl->addRole(new Zend_Acl_Role('manager')); // Manager
		#$this->acl->addRole(new Zend_Acl_Role('employee')); // Employee
		
		// Add resources
			// Ajax
			$this->acl->add(new Zend_Acl_Resource('ajax'));
			
			// Projects
			$this->acl->add(new Zend_Acl_Resource('projects'));
			$this->acl->add(new Zend_Acl_Resource('projects/add'));
			$this->acl->add(new Zend_Acl_Resource('projects/edit'));
			$this->acl->add(new Zend_Acl_Resource('projects/cos'));
			$this->acl->add(new Zend_Acl_Resource('projects/add_cos'));
			$this->acl->add(new Zend_Acl_Resource('projects/edit_cos'));
			$this->acl->add(new Zend_Acl_Resource('projects/budget_track'));
			
		
		// Set permission to Super
		$this->acl->allow('super',
			array(
				'ajax', // Ajax
				'projects', // Projects
					'projects/add',
					'projects/edit',
					'projects/cos',
					'projects/add_cos',
					'projects/edit_cos',
					'projects/budget_track',
			)
		);
	}
	
	// Function to add a preset role access to a resource
	function allow_acl($resource = null,$role = null)
	{
		if (!$resource || !$this->acl->has($resource))
		{
			return false;
		}
		else if (!$role || !$this->acl->hasRole($role))
		{
			return false;
		}
		else
		{
			$this->acl->allow($role,$resource);
		}
	}
	
	// Function to remove a preset role access to a resource
	function deny_acl($resource = null,$role = null)
	{
		if (!$resource || !$this->acl->has($resource))
		{
			return false;
		}
		else if (!$role || !$this->acl->hasRole($role))
		{
			return false;
		}
		else
		{
			$this->acl->deny($role,$resource);
		}
	}

	// Function to check if the current or a preset role has access to a resource
	function check_acl($resource = null,$role = null)
	{
		if (!$resource || !$this->acl->has($resource))
		{
			return false;
		}
		else if (!$role || !$this->acl->hasRole($role))
		{
			return false;
		}
		else
		{
			return $this->acl->isAllowed($role,$resource);
		}
	}
}

/* End of file Zacl.php */
/* Location: ./application/third_party/Zend_acl.php */