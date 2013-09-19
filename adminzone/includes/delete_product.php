<?php
	$db = new DBQuery();

 // Get product image
 	$queryImg = "SELECT format FROM products WHERE ID = '".trim($_GET['id'])."'";	
   	$resultImg = $db->executeQuery($queryImg, $connectionParameters);	
       	
 // Delete image if exists
   	$format = $resultImg[0]['format'];
  	$img_path = "images/product/";
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
   $delProduct = "DELETE FROM products WHERE ID = '".trim($_GET['id'])."'";
   $db->executeNonQuery($delProduct, $connectionParameters);


   // Delete associated product images
   $querySubImage = "SELECT product_photo_id, format
                     FROM product_photo
                     WHERE product_id = '".$_GET['id']."'";
   $resultSubImage = $db->executeQuery($querySubImage, $connectionParameters);

   if(count($resultSubImage) > 0)
   {
       for($i=0; $i<count($resultSubImage); $i++)
       {
         // Delete image if exists
            $format = $resultSubImage[$i]['format'];
            $img_path = "images/product/";
            $original = $img_path."original/".$_GET['id']."_".$resultSubImage[$i]['product_photo_id'].".".$format;
            $thumb    = $img_path."thumbnail/".$_GET['id']."_".$resultSubImage[$i]['product_photo_id'].".".$format;

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
       }
   }

   // Delete sub product image
   $delProduct = "DELETE FROM product_photo WHERE product_id = '".trim($_GET['id'])."'";
   $db->executeNonQuery($delProduct, $connectionParameters);

   header('location:website.php?act=action&mod=listproduct');
?>