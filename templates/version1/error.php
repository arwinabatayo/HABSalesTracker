<head>
<title><?php echo SITE_NAME.' - '.$page_title;?></title>
<?php
echo meta(array('name' => 'robots', 'content' => 'noindex,nofollow'));
echo meta(array('name' => 'robots', 'content' => 'noarchive'));
echo meta(array('name' => 'googlebot', 'content' => 'noarchive'));
echo meta(array('name' => 'content-type', 'content' => 'text/html; charset='.SITE_ENCODING, 'type' => 'equiv'));
echo meta(array('name' => 'charset', 'content' => SITE_ENCODING));
echo meta(array('name' => 'description', 'content' => SITE_DESCRIPTION));
echo meta(array('name' => 'keywords', 'content' => SITE_KEYWORDS));
echo meta(array('name' => 'language', 'content' => LANG));

//Blueprint CSS Framework
echo link_tag(array('href' => TEMPLATES_DIR.VERSION_DIR.CSS_DIR.'screen.css','rel' => 'stylesheet','type' => 'text/css','media' => 'screen, projection'));
echo link_tag(array('href' => TEMPLATES_DIR.VERSION_DIR.CSS_DIR.'print.css','rel' => 'stylesheet','type' => 'text/css','media' => 'print'));

//User Defined CSS
echo link_tag(array('href' => TEMPLATES_DIR.VERSION_DIR.CSS_DIR.'stylec.css','rel' => 'stylesheet','type' => 'text/css'));

//Includes (JS/CSS)
echo (isset($includes) ? $includes : null);
?>
</head>
<body>
	<div id="wrapper">
	
		<div class="body">
			<div class="global-wrap">
				<div class="global-header"><h3><?php echo lang('error_error_404');?></h3></div>
				<div class="global-content"><?php echo lang('error_page_not_found');?></div>
			</div>
		</div>
		
	</div>
</body>
</html>