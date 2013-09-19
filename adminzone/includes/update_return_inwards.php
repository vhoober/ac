<?php
$dba = new DBQuery();
$dbb = new DBQuery();
						$queryInvoice  = "SELECT InvoiceDetails.*, Invoice.CustomerID FROM InvoiceDetails, Invoice WHERE InvoiceDetails.ID = '".trim($_GET['id'])."' AND Invoice.ID=Invoicedetails.InvoiceID";
						$resultInvoice = $dba->executeQuery($queryInvoice, $connectionParameters);
					
                                                $resultInvoice[0]['Username'];
//INSERT INTO `returninwards`(`InvoiceID`, `CustomerID`, `ReturnDate`, `InvoiceDetailsID`, `Quantity`, `Amount`, `CreditNoteIssue`, `IsWriteOff`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9]);
$InsertReturn = "INSERT INTO `returninwards`(`InvoiceID`, `CustomerID`, `ReturnDate`, `InvoiceDetailsID`, `Quantity`, `Amount`) VALUES ('".trim($resultInvoice[0]['InvoiceID'])."',
				  	'".trim($resultInvoice[0]['CustomerID'])."',
                                        '".date("Y-m-d H:i:s")."',
                                        '".trim($resultInvoice[0]['ID'])."',
                                        '".trim($resultInvoice[0]['Total'])."'";

$dbb->executeNonQuery($InsertReturn, $connectionParameters);

header('location:website.php?act=action&mod=editreturn');
?>
