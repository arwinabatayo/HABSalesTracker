<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Carbon Date Extensions
 * 
 * URL API: https://github.com/briannesbitt/Carbon
 *
 * Example: $this->carbon->create(2012, 9, 5, 23, 26, 11);
 */

class Nesbot_carbon
{
	protected $CI;
	
	function __construct()
	{
		// Get the instance
		$this->CI =& get_instance();
		
		//Append Zend's folder in PHP's include path
		set_include_path(get_include_path() . PATH_SEPARATOR . APPPATH . 'third_party');
		
		// Set the include path and require the needed files
		require_once(APPPATH . '/third_party/Nesbot/Carbon.php');
	}
}

/* End of file Zacl.php */
/* Location: ./application/third_party/Nesbot_carbon.php */