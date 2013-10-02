<?php
// Ajax
if ($is_ajax)
{
	echo $content;
	exit;
}

// Base Template
else
{
	include('index_template'.EXT);
	exit;
}
?>