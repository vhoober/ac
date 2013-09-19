<?php
if($_POST['Save'] == "Save") {

$name	= trim($_POST['name']);
$emailaddress	= trim($_POST['emailadd']);   
$address	= trim($_POST['address']);
$fax	= trim($_POST['fax']);
$title	= trim($_POST['title']);
$vatno	= trim($_POST['vatno']);
$mobileno	= trim($_POST['mobileno']);
$phoneno	= trim($_POST['phoneno']);
  
	
	$db = new DBQuery();
        
	$insertCustomerSQL = "INSERT INTO `customer`(`CustomerID`, `Name`, `Address`, `PhoneNo`, `MobileNo`, `FaxNo`, `EmailAddress`, `TaxNo`, `ContactTitle`, `ContactName`, `VATNo`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13])";
	$ID = $db->executeNonQuery($insertCustomerSQL, $connectionParameters);
	$_SESSION['ID']	= $ID;
	
header('location:website.php?act=action&mod=listuser&msg=Successfully added user');	
}
?>
