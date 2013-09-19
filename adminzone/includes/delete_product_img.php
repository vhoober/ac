<?php
	$db = new DBQuery();

 // Get product image format
 	$queryImg = "SELECT format FROM product_photo
                     WHERE product_id = '".trim($_GET['pid'])."'
                         AND product_photo_id = '".trim($_GET['gid'])."'";
   	$resultImg = $db->executeQuery($queryImg, $connectionParameters);

 // Delete image if exists
   	$format = $resultImg[0]['format'];
  	$img_path = "images/product/";
   	$original = $img_path."original/".$_GET['pid']."_".$_GET['gid'].".".$format;
   	$thumb    = $img_path."thumbnail/".$_GET['pid']."_".$_GET['gid'].".".$format;

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
   $delProduct = "DELETE FROM product_photo
                  WHERE product_id = '".trim($_GET['pid'])."'
                    AND product_photo_id = '".trim($_GET['gid'])."'";
   
   $db->executeNonQuery($delProduct, $connectionParameters);

   header('location:website.php?act=action&mod=listproduct');
?>