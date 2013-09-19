<?php
if($_POST['Save'] == "Save") {

$amount	= trim($_POST['newamount']);
$status	= trim($_POST['newstatus']);   
$invoiceid	= trim($_POST['invoiceId']);


  
	
	$db = new DBQuery();
        
	$insertDebtorsSQL = "INSERT INTO `debtors`(`InvoiceID`, `PaymentDate`, `Amount`, `Status`) VALUES ('$invoiceid', '".date("Y-m-d H:i:s")."','$amount','$status')";
	$ID = $db->executeNonQuery($insertDebtorsSQL, $connectionParameters);
	$_SESSION['ID']	= $ID;
	
header('location:website.php?act=action&mod=listpaymentreceived&msg=Successfully added supplier');	
}
?>
