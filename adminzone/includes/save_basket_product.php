<?php
require_once '../configuration/config.php';
require_once '../../includes/class/DBQuery.php';

$db = new DBQuery();
$continue  = 0;

if(isset($_GET['CustomerID']) && $_GET['CustomerID'] > 0)
{
    // Customer existe - Posibility to update customer details
    $updateCustomer = "UPDATE customer 
                        SET ContactTitle = '".$_GET['title']."',
                        Address = '".addslashes(trim($_GET['address']))."',
                        City = '".addslashes(trim($_GET['city']))."',
                        PhoneNo = '".addslashes(trim($_GET['phoneNo']))."',
                        MobileNo = '".addslashes(trim($_GET['mobileNo']))."',
                        FaxNo = '".addslashes(trim($_GET['faxNo']))."',
                        EmailAddress = '".addslashes(trim($_GET['email']))."',
                        ContactName = '".addslashes(trim($_GET['contactName']))."',
                        VATNo = '".addslashes(trim($_GET['vatNo']))."'
                      WHERE CustomerID = '".trim($_GET['CustomerID'])."'";
    $db->executeNonQuery($updateCustomer, $connectionParameters);
    
    $custID = trim($_GET['CustomerID']);
}    
else
{
    // Create new customer
    $insertCustomer = "INSERT INTO customer(Name, Address, City, PhoneNo, MobileNo, FaxNo, EmailAddress, ContactTitle, ContactName, VATNo)
                       VALUES('".addslashes(trim($_GET['Name']))."', '".addslashes(trim($_GET['address']))."', '".addslashes(trim($_GET['city']))."',
                              '".addslashes(trim($_GET['phoneNo']))."', '".addslashes(trim($_GET['mobileNo']))."', '".addslashes(trim($_GET['faxNo']))."',
                              '".addslashes(trim($_GET['email']))."', '".$_GET['title']."', '".addslashes(trim($_GET['contactName']))."', '".addslashes(trim($_GET['vatNo']))."')";
    $custID = $db->executeNonQuery($insertCustomer, $connectionParameters);
}

// Get next invoice ID
$queryNextInvoiceID = "SELECT InvoiceID FROM invoice WHERE ID = (SELECT MAX(ID) FROM invoice)";
$resultNextInvoiceID = $db->executeQuery($queryNextInvoiceID, $connectionParameters);

$id = explode('-', $resultNextInvoiceID[0]['InvoiceID']);
$nextInvoiceID = "INV-".((int)$id[1] + 1);

// Insert invoice
if(trim($_GET['paymentType']) == "Credit")
{
    $status = "Credit";
    
}    
 else {
    $status = "Paid";
}

$cols = "InvoiceID, CustomerID, InvoiceDate, ConnectedUserID, SubTotal, Total, Status, PaymentType, IsVoid, Branch";
$values = "'".$nextInvoiceID."', '".$custID."', '".date("Y-m-d H:i:s", strtotime(trim($_GET['invoiceDate'])))."', '".addslashes(trim($_GET['salesPerson']))."',
          '".trim($_GET['subtotal'])."', '".trim($_GET['total'])."', '".$status."', '".trim($_GET['paymentType'])."', '1', '".trim($_GET['branchID'])."'";

if(trim($_GET['discount']) > 0)
{ 
    $discountPercent = (trim($_GET['discount']) * 100)/trim($_GET['subtotal']);
    $cols .= ", DiscountPercent, DiscountAmount";
    $values .= ", '".$discountPercent."', '".trim($_GET['discount'])."'";
}    

if(isset($_GET['chequeNo']) && trim($_GET['chequeNo']) > 0)
{
    $cols .= ", ChequeNo";
    $values .= ", '".trim($_GET['chequeNo'])."'";
}

$insertInvoice = "INSERT INTO invoice(".$cols.")
                  VALUES(".$values.")";

$invoiceID = $db->executeNonQuery($insertInvoice, $connectionParameters);

// Invoice details
if($invoiceID > 0)
{
    $insertInvoiceDetails = "INSERT INTO invoice_details(`InvoiceID`, `ProductID`, `Quantity`, `UnitPrice`, `Total`, `UnitPriceBeforeVAT`, `TotalBeforeVAT`, `VAT`, `TotalVAT`)
                                SELECT ".$invoiceID." as invoiceID, 
                                TB.productID, 
                                TB.quantity, 
                                TB.unit_selling_price AS UP,
                                TB.sub_total AS TOTAL, 
                                (TB.unit_selling_price/(1 + ".$VAT.")) AS UnitPriceBeforeVAT,
                                ((TB.unit_selling_price/(1 + ".$VAT.")) * TB.quantity) AS TotalBeforeVAT,
                                (TB.unit_selling_price - (TB.unit_selling_price/(1 + ".$VAT.")))  AS VAT,
                                (TB.sub_total  - ((TB.unit_selling_price/(1 + ".$VAT.")) * TB.quantity))  AS TotalVAT 
                             FROM tmp_basket TB";
    $db->executeNonQuery($insertInvoiceDetails, $connectionParameters);
    $continue = 1;
}    

// Insert transport in invoice details
if(isset($_GET['transport']) && strlen(trim($_GET['transport'])) > 0)
{
    $insertTransport = "INSERT INTO invoice_details(`InvoiceID`, `ProductID`, `Quantity`, `UnitPrice`, `Total`, `UnitPriceBeforeVAT`, `TotalBeforeVAT`, `VAT`, `TotalVAT`)
                        VALUES('".$invoiceID."', '1922', '1', '".trim($_GET['transport'])."', '".trim($_GET['transport'])."', '".(trim($_GET['transport'])/(1 + $VAT))."',
                        '".((trim($_GET['transport'])/(1 + $VAT))*1)."', '".(trim($_GET['transport']) - trim($_GET['transport'])/(1 + $VAT))."', '".(trim($_GET['transport']) - ((trim($_GET['transport'])/(1 + $VAT))*1))."')";
    $db->executeNonQuery($insertTransport, $connectionParameters);
}

// Update product level
if($continue == 1)
{
    $queryTmpBasket = "SELECT productID, quantity FROM tmp_basket";
    $resultTmpBasket = $db->executeQuery($queryTmpBasket, $connectionParameters);
    
    if(count($resultTmpBasket) > 0)
    {
        for($x=0; $x<count($resultTmpBasket); $x++)
        {
            // Update table products
            $updateProductQty = "UPDATE products SET Quantity = (Quantity - ".trim($resultTmpBasket[$x]['quantity']).")
                                 WHERE ID = '".trim($resultTmpBasket[$x]['productID'])."'";
            $db->executeNonQuery($updateProductQty , $connectionParameters);
        }
        
        $continue = 1;
    }
    else 
    {
        $continue  = 0;
    }
}

// Truncate table tmp_basket
if($continue == 1)
{
    $truncateTmpBasket = "TRUNCATE TABLE tmp_basket";
    $db->executeNonQuery($truncateTmpBasket, $connectionParameters);
}

// If credit sales, insert record in debtors table
if($continue == 1)
{
	if(trim($_GET['paymentType']) == "Credit" && strlen(trim($_GET['paymentAmt'])) > 0)
	{
	  $insertDebtors = "INSERT INTO debtors(InvoiceID, PaymentDate, Amount, Status)
			    VALUES('".$invoiceID."', now(), '".trim($_GET['paymentAmt'])."', 'Open')";
	  $db->executeNonQuery($insertDebtors, $connectionParameters);
	}
}

// After saving successfully display success msg, disable save, add button and enable print button
if($continue == 1)
{
    // GenerateInvoice(\"invoice_region\", \"".$invoiceID."\", \"".trim($_GET['branchID'])."\");
	echo "<input type='button' name='btnPrint' id='btnPrint' value='Print' onclick=\"window.open('report/invoice_receipt.php?invoiceID=".$invoiceID."&branchID=".trim($_GET['branchID'])."')\" />&nbsp;&nbsp;&nbsp;Invoice details saved successfully<script>
document.getElementById('invoice_region').style.display = 'none';
document.getElementById('btnSave').disabled=true;
</script>";
}

?>
