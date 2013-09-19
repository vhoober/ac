<?php
require_once '../configuration/config.php';
require_once '../../includes/class/DBQuery.php';

$db = new DBQuery();

$query = "SELECT UnitSellingPrice FROM products WHERE ID = '".$_GET['prodID']."'";	
$result = $db->executeQuery($query, $connectionParameters);

echo number_format($result[0]['UnitSellingPrice'], 2, '.', '')."<input type='hidden' name='product_id' id='product_id' value='".$_GET['prodID']."' />";
?>
