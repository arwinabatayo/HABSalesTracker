<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');



#---------------
# Site Settings
#---------------
define('SITE_NAME',			'Sales Tracker');
define('SITE_URL',			'http://dev.test-unit/HABSalesTracker'); //Changeable according to domain
define('SITE_ENCODING',		'utf-8');
define('SITE_KEYWORDS',		'this,are,keywords,meta,whatever');
define('SITE_DESCRIPTION',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent fermentum odio sed purus pharetra, sit amet ultrices lacus sodales. Duis auctor, turpis rutrum mollis consequat, ipsum sem lobortis urna, vel aliquet urna mi egestas neque.');
define('SITE_ADMIN_MAIL',	'arwin.abatayo@gmail.com');
define('SITE_SECRET_KEY',	'ME940Y6QzeX209YBYd2NzBB8y47RLDXu');
define('SITE_VERSION',		'version1');

#----------------------
# Email Default Set-up
#---------------------- 
define('SMTP_HOST',			'');
define('SMTP_USERNAME',		'');
define('SMTP_PASSWORD',		'');
define('SMTP_PORT',			'');

//Changeable according to domain
define('SUPPORT_EMAIL',		'support@example.com');
define('NOREPLY_EMAIL',		'no-reply@example.com');
define('INFO_EMAIL',		'info@example.com');


#--------------
# Folder Paths
#--------------
define('ADMIN_DIR',			'admin/');

define('TEMPLATES_DIR',		'templates/');
define('VERSION_DIR',		SITE_VERSION.'/');
define('BROWSER_DIR',		'browser/');
define('MOBILE_DIR',		'mobile/');
define('IOS_DIR',			'ios/');
define('ANDRIOD_DIR',		'andriod/');

define('CSS_DIR',			'css/');
define('IMAGES_DIR',		'images/');
define('FONTS_DIR',			'fonts/');
define('JAVASCRIPT_DIR',	'javascript/');

define('JS_DIR',			'js/');
define('IMG_DIR',			'img/');

#-------------------
# Avatar Attributes
#-------------------
define('AVATARS_MAX_FILESIZE_LABEL',	1048576); //Maximum File Size (MB) [1MB]
define('AVATARS_MAX_FILESIZE',			1024); //Maximum File Size (KB) [1MB]
define('AVATARS_MAX_WIDTH',				1024); //Maximum Width (PX) [1024PX]
define('AVATARS_MAX_HEIGHT',			1024); //Maximum Height (PX) [1024PX]
define('AVATARS_RESIZE_BIG',			73); //Resize 73 (PX) [73PX]
define('AVATARS_RESIZE_NORMAL',			48); //Resize 48 (PX) [48PX]
define('AVATARS_RESIZE_SMALL',			24); //Resize 24 (PX) [24PX]

#-------------------
# Semaphore API key
#-------------------
define('SEMAPHORE_API_KEY', 'HwJDGY5PySCPGFYFEonJ');

#-------------------
# Constants
#-------------------
define('YEAR_START', 2013);
define('YEAR_CONS', date('Y'));

/* End of file constants.php */
/* Location: ./application/config/constants.php */