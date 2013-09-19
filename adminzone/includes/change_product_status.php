<?php
if(isset($_GET['id']) && isset($_GET['isobsolete']) && trim($_GET['id']) != "" && trim($_GET['isobsolete'] != ""))
{
	$db = new DBQuery();
	
	$updateProductStatus = "UPDATE products SET Is_Obsolete = '".$_GET['isobsolete']."' WHERE ID = '".$_GET['id']."'";
	$db->executeNonQuery($updateProductStatus, $connectionParameters);
	
	header('location:website.php?act=action&mod=listproduct&msg=Product status changed successfully!');
}	
?>