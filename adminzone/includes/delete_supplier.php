<?php
	$db = new DBQuery();

// Delete record for table
   $delProduct = "DELETE FROM supplier WHERE ID = '".trim($_GET['id'])."'";
   $db->executeNonQuery($delProduct, $connectionParameters);

   header('location:website.php?act=action&mod=listsupplier');
?>