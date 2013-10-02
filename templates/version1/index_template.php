<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en-US"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="en-US"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en-US"> <!--<![endif]-->
<html lang="en">
<head>
	<title><?php echo SITE_NAME.' | '.$page_title;?></title>
	<?php
		echo meta(array('name' => 'robots', 'content' => 'noindex,nofollow'));
		echo meta(array('name' => 'robots', 'content' => 'noarchive'));
		echo meta(array('name' => 'googlebot', 'content' => 'noarchive'));
		echo meta(array('name' => 'content-type', 'content' => 'text/html; charset='.SITE_ENCODING, 'type' => 'equiv'));
		echo meta(array('name' => 'charset', 'content' => SITE_ENCODING));
		echo meta(array('name' => 'description', 'content' => SITE_DESCRIPTION));
		echo meta(array('name' => 'keywords', 'content' => SITE_KEYWORDS));
		
		echo meta(array('name' => 'HandheldFriendly', 'content' => 'True'));
		echo meta(array('name' => 'MobileOptimized', 'content' => '320'));
		echo meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0'));
		echo meta(array('name' => 'format-detection', 'content' => 'telephone=no'));
		
		echo meta(array('name' => 'apple-mobile-web-app-capable', 'content' => 'yes'));
		echo meta(array('name' => 'apple-mobile-web-app-status-bar-style', 'content' => 'black'));
		echo meta(array('name' => 'apple-mobile-web-app-title', 'content' => SITE_NAME.' | '.$page_title));
		
		echo link_tag(array('href' => 'favicon.ico','rel' => 'shortcut icon'));
		
		// Bootstrap CSS Framework
		echo link_tag(array('href' => TEMPLATES_DIR.VERSION_DIR.CSS_DIR.'bootstrap.min.css','rel' => 'stylesheet','type' => 'text/css'));
		echo link_tag(array('href' => TEMPLATES_DIR.VERSION_DIR.CSS_DIR.'font-awesome.min.css','rel' => 'stylesheet','type' => 'text/css')); // Font Awesome (alternative for glyphicons)
		
		// Main CSS
		echo link_tag(array('href' => TEMPLATES_DIR.VERSION_DIR.CSS_DIR.'fonts.css','rel' => 'stylesheet','type' => 'text/css'));
		echo link_tag(array('href' => TEMPLATES_DIR.VERSION_DIR.CSS_DIR.'layout.css','rel' => 'stylesheet','type' => 'text/css'));
		echo link_tag(array('href' => TEMPLATES_DIR.VERSION_DIR.CSS_DIR.'icons.css','rel' => 'stylesheet','type' => 'text/css'));
		
		// Modernizr JS
		echo script_tag(TEMPLATES_DIR.VERSION_DIR.JS_DIR.'modernizr-2.6.2.min.js');
		
		// Jquery JS
		//echo script_tag('http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js');
		echo script_tag(TEMPLATES_DIR.VERSION_DIR.JS_DIR.'jquery-2.0.3.min.js');
		
		// Bootstrap JS
		echo script_tag(TEMPLATES_DIR.VERSION_DIR.JS_DIR.'bootstrap.min.js');
		
		// Slim Scroll
		echo script_tag(TEMPLATES_DIR.VERSION_DIR.JS_DIR.'jquery.slimscroll.min.js');
		
		//Includes (JS/CSS)
		echo (isset($includes) ? $includes : null);
	?>
</head>
<body>

	<?php
	echo $content;
	?>
	
</body>
</html>