<?php
require_once '../configuration/config.php';
require_once '../../includes/class/DBQuery.php';

$db = new DBQuery();

$query = "DELETE FROM tmp_basket WHERE basketID = '".$_GET['basketID']."'";	
$result = $db->executeNonQuery($query, $connectionParameters);

echo "<script>GetProductInBasket('added_product', 0);</script>";
?>
