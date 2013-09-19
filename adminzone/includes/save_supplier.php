<?php
if($_POST['Save'] == "Save") {

$name	= trim($_POST['name']);
$emailaddress	= trim($_POST['emailadd']);   
$address	= trim($_POST['address']);
$country	= trim($_POST['country']);
$fax	= trim($_POST['fax']);
$vatno	= trim($_POST['VATNo']);
$mobileno	= trim($_POST['mobileno']);
$phoneno	= trim($_POST['phoneno']);
$suppliertype	= trim($_POST['suppliertype']);
  
	
	$db = new DBQuery();
        
	$insertSupplierSQL = "INSERT INTO `supplier`(`name`, `supplierTypeId`, `address1`, `country`, `phoneNo`, `mobileNo`, `faxNo`, `emailAddress`, `vatNo`, `dateCreated`) VALUES ('$name','$suppliertype','$address','$country','$phoneno','$mobileno','$fax','$emailaddress','$vatno', '".date("Y-m-d H:i:s")."')";
	$ID = $db->executeNonQuery($insertSupplierSQL, $connectionParameters);
	$_SESSION['supplierId']	= $ID;
	
header('location:website.php?act=action&mod=listsupplier&msg=Successfully added supplier');	
}
?>
