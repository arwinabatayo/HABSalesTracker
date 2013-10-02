<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Image_Resize
{
	//Class variables
	private $image;
	private $width;
	private $height;
	private $imageResized;
	
	function __construct($fileName)
	{
		//Open up the file
		$this->image = $this->openImage($fileName);
	}
	
	private function openImage($file)
	{
		//Image info
		$info = getimagesize($file);
		$this->width = $info[0];
		$this->height = $info[1];
		if ($info)
		{
			switch ($info[2])
			{
				case IMAGETYPE_PNG:
					return imagecreatefrompng($file);
				case IMAGETYPE_JPEG:
 					return imagecreatefromjpeg($file);
				case IMAGETYPE_GIF:
					return imagecreatefromgif($file);
			}
		}
		return false;
	}
	
	public function resizeImage($newWidth, $newHeight, $option="auto")
	{
		//Get optimal width and height - based on $option
		$optionArray = $this->getDimensions($newWidth, $newHeight, $option);
		
		if(!$optionArray)
		{
			return false;
		}

		$optimalWidth = $optionArray['optimalWidth'];
		$optimalHeight = $optionArray['optimalHeight'];
		
		//Resample - create image canvas of x, y size
		$this->imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);
		if (imagetypes() & IMG_PNG)
		{
			imagesavealpha($this->imageResized, true);
			imagealphablending($this->imageResized, false);
		}
		imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $this->width, $this->height);
		
		//if option is 'crop', then crop too
		if ($option == 'crop')
        {
			$this->crop($optimalWidth, $optimalHeight, $newWidth, $newHeight);
		}
		return true;
    }
    
    private function getDimensions($newWidth, $newHeight, $option)
    {
    	$ret = array();
		switch ($option)
		{
			case 'exact':
				$ret['optimalWidth'] = $newWidth;
				$ret['optimalHeight'] = $newHeight;
			break;
			case 'portrait':
				$ret['optimalWidth'] = $this->getSizeByFixedHeight($newHeight);
				$ret['optimalHeight'] = $newHeight;
			break;
			case 'landscape':
				$ret['optimalWidth'] = $newWidth;
				$ret['optimalHeight'] = $this->getSizeByFixedWidth($newWidth);
			break;
			case 'auto':
				$optionArray = $this->getSizeByAuto($newWidth, $newHeight);
				$ret['optimalWidth'] = $optionArray['optimalWidth'];
				$ret['optimalHeight'] = $optionArray['optimalHeight'];
			break;
			case 'crop':
				$optionArray = $this->getOptimalCrop($newWidth, $newHeight);
				$ret['optimalWidth'] = $optionArray['optimalWidth'];
				$ret['optimalHeight'] = $optionArray['optimalHeight'];
			break;
			default:
				return false;
		}
		return $ret;
	}
	
	private function getSizeByFixedHeight($newHeight)
	{
		$ratio = $this->width / $this->height;
		$newWidth = $newHeight * $ratio;
		return $newWidth;
	}
	
	private function getSizeByFixedWidth($newWidth)
	{
		$ratio = $this->height / $this->width;
		$newHeight = $newWidth * $ratio;
		return $newHeight;
	}
	
	private function getSizeByAuto($newWidth, $newHeight)
	{
		$heightRatio = $this->height / $newHeight;
		$widthRatio = $this->width / $newWidth;
		
		$optimalRatio = max($heightRatio, $widthRatio);
		//If < 1, don't resize
		$optimalRatio = max(1, $optimalRatio);
		
		$optimalHeight = $this->height / $optimalRatio;
		$optimalWidth = $this->width / $optimalRatio;
		
		return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}
	
	private function getOptimalCrop($newWidth, $newHeight)
	{
		$heightRatio = $this->height / $newHeight;
		$widthRatio = $this->width / $newWidth;
		
		$optimalRatio = min($heightRatio, $widthRatio);
		//If < 1, don't resize
		$optimalRatio = max(1, $optimalRatio);
		
		$optimalHeight = $this->height / $optimalRatio;
		$optimalWidth = $this->width / $optimalRatio;
		
		return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}
	
	private function crop($optimalWidth, $optimalHeight, $newWidth, $newHeight)
	{
		//Find center - this will be used for the crop
		$cropStartX = ( $optimalWidth / 2) - ( $newWidth / 2 );
		//$cropStartY = ( $optimalHeight / 2) - ( $newHeight / 2 );
		$cropStartY = 0; // Make it to top
		
		$crop = $this->imageResized;
		//imagedestroy($this->imageResized);
		//Now crop from center to exact requested size
		$this->imageResized = imagecreatetruecolor($newWidth, $newHeight);
		if (imagetypes() & IMG_PNG)
		{
			imagesavealpha($this->imageResized, true);
			imagealphablending($this->imageResized, false);
		}
		imagecopyresampled($this->imageResized, $crop, 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight, $newWidth, $newHeight);
	}
	
	public function setGrayscale()
	{
		imagefilter($this->imageResized, IMG_FILTER_GRAYSCALE);
	}
	
	public function saveImage($savePath, $imageQuality="100")
	{
		//Get extension
		$extension = strrchr($savePath, '.');
		$extension = strtolower($extension);
		$ok = false;
		switch ($extension)
		{
			case '.jpg':
			case '.jpeg':
				if (imagetypes() & IMG_JPG)
				{
					$ok = imagejpeg($this->imageResized, $savePath, $imageQuality);
				}
			break;
			case '.gif':
				if (imagetypes() & IMG_GIF)
				{
					$ok = imagegif($this->imageResized, $savePath);
				}
			break;
			case '.png':
				//Scale quality from 0-100 to 0-9
				$scaleQuality = round(($imageQuality / 100) * 9);
				
				//Invert quality setting as 0 is best, not 9
				$invertScaleQuality = 9 - $scaleQuality;
				if (imagetypes() & IMG_PNG)
				{
					$ok = imagepng($this->imageResized, $savePath, $invertScaleQuality);
				}
			break;
			default:
			break;
		}
		imagedestroy($this->imageResized);
		return $ok;
	}
}

/* End of file Breadcrumb.php */
/* Location: ./application/libraries/Image_Resize.php */