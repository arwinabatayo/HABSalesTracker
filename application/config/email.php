<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
	'protocol'	=> 'smtp',
	'smtp_host'	=> 'ssl://smtp.googlemail.com',
	'smtp_user'	=> 'user',
	'smtp_pass'	=> 'pass',
	'smtp_port'	=> '465',
	'wordwrap'	=> false,
	'mailtype'	=> 'html',
	'charset'	=> 'utf-8',
	'newline'	=> '\r\n',
);

/* End of file email.php */
/* Location: ./application/config/email.php */