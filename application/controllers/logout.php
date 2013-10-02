<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends MY_Controller
{
	protected $assign = array();
	
	function __construct()
	{
		parent::__construct();
		
		//Check user status
		if (!$this->isUserLoggedIn()) //Not Logged In? Proceed to remove session
		{
			$this->userLoggedout();
		}
	}
	
	function index()
	{
		if ($this->isUserLoggedIn())
		{
			$this->authLogout();
		}
		$this->userLoggedout();
		redirect(site_url('login'));
	}
}