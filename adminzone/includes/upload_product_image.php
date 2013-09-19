<?php
if($_POST['prodid'] > 0 && isset($_FILES['img_prod']) && !empty($_FILES['img_prod']['name']))
{
require_once '../configuration/config.php';
require_once '../../includes/class/DBQuery.php';
require_once 'class/class.upload.php';

//*************************
/**
 * Create a thumbnail image from $inputFileName no taller or wider than
 * $maxSize. Returns the new image resource or false on error.
 * Author: mthorn.net
 */
function thumbnail($inputFileName, $maxSize = 100)
{
	$info = getimagesize($inputFileName);

	$type = isset($info['type']) ? $info['type'] : $info[2];

	// Check support of file type
	if ( !(imagetypes() & $type) )
	{
		// Server does not support file type
		return false;
	}

	$width  = isset($info['width'])  ? $info['width']  : $info[0];
	$height = isset($info['height']) ? $info['height'] : $info[1];

	// Calculate aspect ratio
	$wRatio = $maxSize / $width;
	$hRatio = $maxSize / $height;

	// Using imagecreatefromstring will automatically detect the file type
	$sourceImage = imagecreatefromstring(file_get_contents($inputFileName));

	// Calculate a proportional width and height no larger than the max size.
	if ( ($width <= $maxSize) && ($height <= $maxSize) )
	{
		// Input is smaller than thumbnail, do nothing
		return $sourceImage;
	}
	elseif ( ($wRatio * $height) < $maxSize )
	{
		// Image is horizontal
		$tHeight = ceil($wRatio * $height);
		$tWidth  = $maxSize;
	}
	else
	{
		// Image is vertical
		$tWidth  = ceil($hRatio * $width);
		$tHeight = $maxSize;
	}

	$thumb = imagecreatetruecolor($tWidth, $tHeight);

	if ( $sourceImage === false )
	{
		// Could not load image
		return false;
	}

	// Copy resampled makes a smooth thumbnail
	imagecopyresampled($thumb, $sourceImage, 0, 0, 0, 0, $tWidth, $tHeight, $width, $height);
	imagedestroy($sourceImage);

	return $thumb;
}

/**
 * Save the image to a file. Type is determined from the extension.
 * $quality is only used for jpegs.
 * Author: mthorn.net
 */
function imageToFile($im, $fileName, $quality = 80)
{
	if ( !$im || file_exists($fileName) )
	{
		return false;
	}

	$ext = strtolower(substr($fileName, strrpos($fileName, '.')));

	switch ( $ext )
	{
		case '.gif':
			imagegif($im, $fileName);
			break;
		case '.jpg':
		case '.jpeg':
			imagejpeg($im, $fileName, $quality);
			break;
		case '.png':
			imagepng($im, $fileName);
			break;
		case '.bmp':
			imagewbmp($im, $fileName);
			break;
		default:
			return false;
	}

	return true;
}


$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["img_prod"]["name"]);
$extension = end($temp);
if ((($_FILES["img_prod"]["type"] == "image/gif")
		|| ($_FILES["img_prod"]["type"] == "image/jpeg")
		|| ($_FILES["img_prod"]["type"] == "image/jpg")
		|| ($_FILES["img_prod"]["type"] == "image/pjpeg")
		|| ($_FILES["img_prod"]["type"] == "image/x-png")
		|| ($_FILES["img_prod"]["type"] == "image/png"))
		&& ($_FILES["img_prod"]["size"] < 2000000)
		&& in_array($extension, $allowedExts))
{
	if ($_FILES["file"]["error"] > 0)
	{
		echo "Return Code: " . $_FILES["img_prod"]["error"] . "<br>";
	}
	else
	{
		$base_path = "../images/product/thumbnail/";
		$file_new_name = trim($_POST['prodid']).".".$extension;
		if (file_exists($base_path.$file_new_name))
		{
			unlink($base_path.$file_new_name);
		}

		if(move_uploaded_file($_FILES["img_prod"]["tmp_name"], $base_path.$file_new_name))
		{
			$im = thumbnail($base_path.$file_new_name, 100);
			imageToFile($im, $base_path.$file_new_name);
			
			$db = new DBQuery();
		
			// Delete previous image 
			$queryExistingImg = "SELECT format FROM products WHERE ID = '".$_POST['prodid']."'";
			$resultExisingImg = $db->executeQuery($queryExistingImg, $connectionParameters);
			
			if (file_exists($base_path.$_POST['prodid'].".".$resultExisingImg[0]['format']))
			{
				unlink($base_path.$_POST['prodid'].".".$resultExisingImg[0]['format']);
			}
			
			
			$updateProductImgFormat = "UPDATE products SET format = '".$extension."' WHERE ID = '".$_POST['prodid']."'";
			$db->executeNonQuery($updateProductImgFormat, $connectionParameters);
		}
		header("location:../website.php?act=action&mod=listproduct");

	}
}
else
{
	echo "Invalid file";
}

//***************************
/*

	echo "first <br>"; // debug
// Upload and resize image. If image exists overite it
	// retrieve eventual CLI parameters
	$cli = (isset($argc) && $argc > 1);
	if ($cli) {
		if (isset($argv[1])) $_GET['file'] = $argv[1];
		if (isset($argv[2])) $_GET['dir'] = $argv[2];
		if (isset($argv[3])) $_GET['pics'] = $argv[3];
	}
	echo "second <br>"; // debug
	// set variables
	// Thumbnail picture
	$dir_dest_thumb = (isset($_GET['dir']) ? $_GET['dir'] : '../images/product/thumbnail/');
	$dir_pics_thumb = (isset($_GET['pics']) ? $_GET['pics'] : $dir_dest_thumb);
	
	$handle = new Upload($_FILES['img_prod_'.trim($_POST['prodid'])]);
	
	$handle->file_max_size = '10000000000';
	echo $dir_dest_thumb."<br>";
	echo "third <br>"; // debug
			// resize and upload thumbnail
			// we now process the image a second time, with thumbnail image
			$handle->image_resize            = true;
			$handle->image_ratio             = true;
			$handle->image_x                 = 130;
			$handle->image_y                 = 100;
	
			$handle->allowed = array('image/*');
			$handle->file_new_name_body = $_POST['prodid'];
			$handle->file_overwrite = true;
			$handle->Process($dir_dest_thumb);
	
			// we check if everything went OK
			if ($handle->processed) {
				echo "fourth <br>"; // debug
				// Update database
				// Get file extension to update table
				$file = explode(".", $_FILES['img_prod']['name']);
	
				$db = new DBQuery();
	
				$updateProductImgFormat = "UPDATE products SET format = '".strtolower($file[1])."' WHERE ID = '".$_POST['prodid']."'";
				$db->executeNonQuery($updateProductImgFormat, $connectionParameters);

			} else {
				// one error occured
				echo '<fieldset>';
				echo '  <legend>file not uploaded to the wanted location</legend>';
				echo '  Error: ' . $handle->error . '';
				echo '</fieldset>';
			}
	
			echo "fifth <br>"; // debug
		// we delete the temporary files
		$handle-> Clean();exit;	
		header("location:../website.php?act=action&mod=listproduct");
		*/
}
?>