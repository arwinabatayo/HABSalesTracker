<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('script_tag'))
{
	function script_tag($src = '', $language = 'javascript', $type = 'text/javascript', $index_page = FALSE)
	{
		$CI =& get_instance();
		
		$script = '<script';
		
		if (is_array($src))
		{
			foreach ($src as $k=>$v)
			{
				if ($k == 'src' AND strpos($v, '://') === FALSE)
				{
					if ($index_page === TRUE)
					{
						$script .= ' src="'.$CI->config->site_url($v).'?'.strtotime('now').'"';
					}
					else
					{
						$script .= ' src="'.$CI->config->slash_item('base_url').$v.'?'.strtotime('now').'"';
					}
				}
				else
				{
					$script .= "$k=\"$v\"?".strtotime('now');
				}
			}
			$script .= "></script>\n";
		}
		else
		{
			if (strpos($src, '://') !== FALSE)
			{
				$script .= ' src="'.$src.'?'.strtotime('now').'" ';
			}
			elseif ($index_page === TRUE)
			{
				$script .= ' src="'.$CI->config->site_url($src).'?'.strtotime('now').'" ';
			}
			else
			{
				$script .= ' src="'.$CI->config->slash_item('base_url').$src.'?'.strtotime('now').'" ';
			}
			$script .= 'language="'.$language.'" type="'.$type.'"';
			$script .= " /></script>\n";
		}
		
		return $script;
	}
}

/* End of file download_helper.php */
/* Location: ./application/helpers/MY_html_helper.php */