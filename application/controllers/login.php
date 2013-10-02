<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller
{
	protected $assign = array();
	
	function __construct()
	{
		parent::__construct();
		
		// Set Languages
		$this->lang->load('login');
		
		// Set Assignments
		$this->assign['page_title'] = $this->lang->line('login_login');
		
		// Check user status
		$this->isUserLoggedIn(false);
	}
	
	function index()
	{
		//Set Form
		$this->assign['login_email'] = array( //Email
			'type' => 'email',
			'name' => 'login_email',
			'id' => 'login_email',
			'placeholder' => $this->lang->line('login_email_address'),
			'title' => $this->lang->line('login_email_address'),
			'class' => 'form-control verifyMail'
		);
		$this->assign['login_password'] = array( //Password
			'type' => 'password',
			'name' => 'login_password',
			'id' => 'login_password',
			'placeholder' => $this->lang->line('login_password'),
			'title' => $this->lang->line('login_password'),
			'class' => 'form-control verifyText'
		);
		
		if ($_POST)
		{
			$this->form_validation->set_rules('login_email',$this->lang->line('login_email_address'),'trim|valid_email|required');
			$this->form_validation->set_rules('login_password',$this->lang->line('login_password'),'trim|min_length[4]|max_length[15]|required');
			
			if (!$this->form_validation->run())
			{
				$this->assign['login_email']['value'] = $this->input->post('login_email');
			}
			else
			{
				$email = $this->input->post('login_email');
				$password = $this->input->post('login_password');
				
				if ($this->authLogin($email,$password))
				{
					redirect(site_url('login'));
				}
				else
				{
					$this->assign['action_error'] = $this->lang->line('login_invalid');
				}
			}
		}
		
		$this->load->js(TEMPLATES_DIR.VERSION_DIR.JS_DIR.'jquery.formvalidation.js');
		$this->load->view('login',$this->assign);
	}
}