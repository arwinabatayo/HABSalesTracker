<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		
		//$this->output->enable_profiler(TRUE);
		//$this->output->cache(2);
		
		// Set Template
		$this->load->theme(SITE_VERSION);
		
		// Activity session logs
		$this->session->set_userdata('last_activity',time());
	}
	
	
	
	
	
	/* =Authentication
	-------------------------------------------------------------- */
	function userLoggedIn($id,$role)
	{
		$this->session->set_userdata(
			array(
				'id' => $id,
				'is_logged_in' => true,
				'is_page' => 'projects',
			)
		);
	}
	
	function userLoggedOut()
	{
		$this->session->set_userdata(
			array(
				'id' => '',
				'is_logged_in' => '',
				'is_page' => '',
			)
		);
		
		$this->session->sess_destroy();
	}
	
	function isUserLoggedIn($if_bool = true,$activated = true,$goto_link = null)
	{
		if ($activated)
		{
			if ($this->session->userdata('is_logged_in') === $activated && $this->session->userdata('id'))
			{
				// Check session database first
				if ($this->model_sessions->sessionExists($this->session->userdata('session_id')))
				{
					$sessionData = $this->model_sessions->getSessionById($this->session->userdata('session_id'));
					
					// Check if session userdata has value
					if ($sessionData[0]->user_data)
					{
						// Unserialize userdata
						$userSessionData = unserialize($sessionData[0]->user_data);
						
						// Then check if the user id exists
						if ($userSessionData['is_logged_in'] && $userSessionData['id'] == $this->session->userdata('id') && $this->model_users->userIdActive($this->session->userdata('id')))
						{
							// Check if need to return TRUE or redirect
							if (!$if_bool)
							{
								// Redirect overrides
								if ($goto_link)
								{
									redirect(site_url($goto_link));
									exit;
								}
								else if ($this->session->userdata('is_page'))
								{
									redirect(site_url($this->session->userdata('is_page')));
									exit;
								}
							}
														
							return true;
						}
					}
				}
			}
		}
		
		return false;
	}
	
	function isUserActive($user_id)
	{
		if ($this->model_users->userIdActive($user_id))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function authLogin($email,$password)
	{
		if ($this->model_users->userEmailExists($email))
		{
			if ($this->model_users->userLoginByEmail($email,$password))
			{
				$user_data = $this->model_users->getUserByEmail($email);
				
				// Set as logged in
				$this->userLoggedIn($user_data[0]->id);
				
				// Record date of login
				$this->model_users->setLastLogin($user_data[0]->id,$this->input->ip_address());
				
				// Record activity
				$this->model_activities->setUserActivity(
					array(
						'user_id' => $user_data[0]->id,
						'type' => 'login',
						'data' => '',
					)
				);
				
				// Record date of last_activity
				$this->model_users->setLastActivity($user_data[0]->id);
				
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	function authLogout()
	{
		$user_data = $this->model_users->getUserById($this->session->userdata('id'));
		
		if (count($user_data))
		{
			// Record date of logged out
			$this->model_users->setLastLogout($user_data[0]->id,$this->input->ip_address());
			
			// Record activity
			$this->model_activities->setUserActivity(
				array(
					'user_id' => $user_data[0]->id,
					'type' => 'logout',
					'data' => ''
				)
			);
			
			// Record date of last_activity
			$this->model_users->setLastActivity($user_data[0]->id);
		}
		
		return true;
	}
	
	
	
	
	
	/* =Get User Details
	-------------------------------------------------------------- */
	function getUserDetails($id)
	{
		return $this->model_users->getUserById($id);
	}
	
	
	
	
	
	/* =Set Cookies
	-------------------------------------------------------------- */
	function setPage($page)
	{
		$this->session->set_userdata('is_page',$page);
	}
}