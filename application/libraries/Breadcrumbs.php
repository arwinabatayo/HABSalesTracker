<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Breadcrumbs
{
	protected $breadcrumbs = array();
	protected $_divider = ' &nbsp;<span style="font-weight:normal;">&raquo;</span>&nbsp;';
	protected $_tag_open = '<div class="breadcrumbs">';
	protected $_tag_close = '</div>';
	
	public function __construct($params = array())
	{
		if (count($params) > 0)
		{
			$this->initialize($params);
		}
		//log_message('debug', "Breadcrumb Class Initialized");
	}
	
	private function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->{'_' . $key}))
				{
					$this->{'_' . $key} = $val;
				}
			}
		}
	}
			
	public function append_crumb($title, $href)
	{
		// no title or href provided
		if (!$title || !$href)
		{
			return;
		}
		
		// add to end
		$this->breadcrumbs[] = array('title' => $title, 'href' => $href);
	}
	
	public function prepend_crumb($title, $href)
	{
		// no title or href provided
		if (!$title || !$href)
		{
			return;
		}
		
		// add to start
		array_unshift($this->breadcrumbs, array('title' => $title, 'href' => $href));
	}
		
	public function output()
	{
		// breadcrumb found
		if ($this->breadcrumbs)
		{
			// set output variable
			$output = $this->_tag_open;
			
			// add html to output
			foreach ($this->breadcrumbs as $key => $crumb)
			{
				// add divider
				if ($key)
				{
					$output .= $this->_divider;
				}
				
				// if last element
				if (end(array_keys($this->breadcrumbs)) == $key)
				{
					$output .= '<span>' . $crumb['title'] . '</span>';
				}
				// else add link and divider
				else
				{
					$output .= '<a href="' . $crumb['href'] . '">' . $crumb['title'] . '</a>';
				}
			}
			
			// return html
			return $output . $this->_tag_close . PHP_EOL;
		}
		
		// return blank string
		return;
	}

}

/* End of file Breadcrumb.php */
/* Location: ./application/libraries/Breadcrumb.php */