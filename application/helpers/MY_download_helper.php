<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function force_download($filename = '', $data = '')
{
	if ($filename == '' OR $data == '')
	{
		return FALSE;
	}
	
	//Try to determine if the filename includes a file extension.
	//We need it in order to set the MIME type
	if (FALSE === strpos($filename, '.'))
	{
		return FALSE;
	}

	//Grab the file extension
	$x = explode('.', $filename);
	$extension = end($x);

	//Load the mime types
	if (defined('ENVIRONMENT') AND is_file(APPPATH.'config/'.ENVIRONMENT.'/mimes.php'))
	{
		include(APPPATH.'config/'.ENVIRONMENT.'/mimes.php');
	}
	elseif (is_file(APPPATH.'config/mimes.php'))
	{
		include(APPPATH.'config/mimes.php');
	}

	//Set a default mime if we can't find it
	if ( ! isset($mimes[$extension]))
	{
		$mime = 'application/octet-stream';
	}
	else
	{
		$mime = (is_array($mimes[$extension])) ? $mimes[$extension][0] : $mimes[$extension];
	}

	//Generate the server headers
	if (strpos($_SERVER['HTTP_USER_AGENT'], "MSIE") !== FALSE)
	{
		header('Content-Type: "'.$mime.'"');
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header("Content-Transfer-Encoding: binary");
		header('Pragma: public');
		//header("Content-Length: ".strlen($data));
	}
	else
	{
		header('Content-Type: "'.$mime.'"');
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		header("Content-Transfer-Encoding: binary");
		header('Expires: 0');
		header('Pragma: no-cache');
		//header("Content-Length: ".strlen($data));
	}

	readfile(output_stream($data));
	return TRUE;
}

if (!function_exists('readfile_chunked'))
{
	function readfile_chunked($filename, $retbytes = TRUE)
	{
		$buffer = '';
		$cnt =0;
	    //$handle = fopen($filename, 'rb');
		$handle = fopen($filename, 'rb');
		if ($handle === false)
		{
			return false;
	    }
		while (!feof($handle))
		{
			$buffer = fread($handle, 1024*1024);
			echo $buffer;
			ob_flush();
			flush();
			if ($retbytes)
			{
				$cnt += strlen($buffer);
			}
		}
	    $status = fclose($handle);
		if ($retbytes && $status)
	    {
			return $cnt; //return num. bytes delivered like readfile() does.
		}
	    return $status;
	}
}


if (!function_exists('output_stream'))
{
	function output_stream($filename)
	{
		$filesize = filesize($filename);
		$chunksize = 4096;
		if($filesize > $chunksize)
		{
			$srcStream = fopen($filename, 'rb');
			$dstStream = fopen('php://output', 'wb');
	
			$offset = 0;
			while(!feof($srcStream))
			{
				$offset += stream_copy_to_stream($srcStream, $dstStream, $chunksize, $offset);
			}
			fclose($dstStream);
			fclose($srcStream);
		}
		else
		{
			//stream_copy_to_stream behaves() strange when filesize > chunksize.
			//Seems to never hit the EOF.
			//On the other handside file_get_contents() is not scalable.
			//Therefore we only use file_get_contents() on small files.
			return file_get_contents($filename);
		}
	}
}

/* End of file download_helper.php */
/* Location: ./application/helpers/MY_download_helper.php */