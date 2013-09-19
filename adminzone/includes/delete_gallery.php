<?php
	$db = new DBQuery();

 // Get gallery image
 	$queryImg = "SELECT format FROM gallery WHERE gallery_id = '".trim($_GET['id'])."'";
   	$resultImg = $db->executeQuery($queryImg, $connectionParameters);

 // Delete image if exists
   	$format = $resultImg[0]['format'];
  	$img_path = "images/gallery/";
   	$original = $img_path."original/".$_GET['id'].".".$format;
   	$thumb    = $img_path."thumbnail/".$_GET['id'].".".$format;

 //original
   if(file_exists($original))
   {
    	unlink($original);
   }

// thumbnail
   if(file_exists($thumb))
   {
    	unlink($thumb);
   }

// Delete record for table
   $delGallery = "DELETE FROM gallery WHERE gallery_id = '".trim($_GET['id'])."'";
   $db->executeNonQuery($delGallery, $connectionParameters);

   header('location:website.php?act=action&mod=browsegallery');
?>