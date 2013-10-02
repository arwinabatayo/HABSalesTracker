<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends MY_Controller
{
	protected $assign = array();
	
	function __construct()
	{
		parent::__construct();
		
		//Set Assignments
		$this->assign['page_title'] = $this->lang->line('error_error_page');
		$this->assign['is_index_template'] = true;
	}
	
	function index()
	{
		redirect(site_url('error/notfound'));
	}
	
	function notfound()
	{
		$this->load->view('error/notfound',$this->assign);
	}
}