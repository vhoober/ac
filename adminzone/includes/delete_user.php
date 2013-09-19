<?php
	$db = new DBQuery();


// Delete record for table
   $delUser = "DELETE FROM users WHERE ID = '".trim($_GET['id'])."'";
   $db->executeNonQuery($delUser, $connectionParameters);

   header('location:website.php?act=action&mod=listuser');
?>