<?php
if(trim($_SERVER['SERVER_NAME']) != "localhost")
{
    $absoluteURL = $_SERVER['DOCUMENT_ROOT'];
}
else 
{
    $absoluteURL = $_SERVER['DOCUMENT_ROOT']."/ac";    
}

$invoiceID = trim($_GET['invoiceID']);
$branchID = trim($_GET['branchID']);

if(trim($invoiceID) > 0 && trim($branchID) > 0)
{    
require_once($absoluteURL.'/adminzone/configuration/config.php');
require_once($absoluteURL.'/includes/class/DBQuery.php');
require_once($absoluteURL.'/adminzone/report/functions/generate_report.php');

require_once($absoluteURL.'/adminzone/report/tcpdf/config/lang/eng.php');
require_once($absoluteURL.'/adminzone/report/tcpdf/tcpdf.php');

$db = new DBQuery();

$queryBranchName = "SELECT BranchName FROM branch WHERE ID = '".$branchID."'";
$resultBranchName = $db->executeQuery($queryBranchName, $connectionParameters);
$branchName = $resultBranchName[0]['BranchName'];

// Query
$queryName = "SELECT C.Name, C.Address, C.PhoneNo, I.ConnectedUserID, I.PaymentType, C.VATNo, I.InvoiceID 
              FROM customer AS C, invoice AS I
              WHERE I.ID = '".$invoiceID."' 
                AND C.CustomerID=I.CustomerID";

$resultName = $db->executeQuery($queryName, $connectionParameters);

$output = '';

// Header
$output = '<font align="center" color="#000000"><b>Invoice Generated</b></font><hr><br><br>';

// table header
$output .= '<table width="100%" border="0">
<tr>
	
	<td><b>DATE</b></td>
	<td><b>'.date("m/d/Y").'</b></td>
	<td><b>SALESMAN</b></td>
	<td><b>'.$resultName[0]['ConnectedUserID'].'</b></td>
</tr>
<tr>
	
	<td><b>NAME</b></td>
	<td><b>'.$resultName[0]['Name'].'</b></td>
	<td><b>VAT REG.</b></td>
	<td><b>'.number_format($result[$i]['DiscountAmount'], 2, '.', ',').'</b></td>

	
</tr>
<tr>
	<td><b>ADDRESS</b></td>
	<td><b>'.$resultName[0]['Address'].'</b></td>
	<td><b>INVOICE NO</b></td>
	<td><b>'.$resultName[0]['InvoiceID'].'</b></td>
	
	
</tr>
<tr>
	<td><b>TEL</b></td>
	<td><b>'.$resultName[0]['PhoneNo'].'</b></td>
	<td><b>CLIENT VAT,</b></td>
	<td><b>'.$resultName[0]['VATNo'].'</b></td>
	
	
</tr>
</table>';
$output .= '<table width="100%" border="1">
		<tr>
                    <td><b>CODE</b></td>
                    <td><b>DESCRIPTION</b></td>
                    <td><b>SIZE</b></td>
                    <td><b>QUANTITY</b></td>
                    <td><b>UNIT PRICE</b></td>
                    <td><b>TOTAL</b></td>
		</tr>';

// Query
$query = "SELECT P.ProductCode, P.ProductName, P.ProductSize, IDE.Quantity, IDE.UnitPrice, IDE.Total, I.DiscountAmount 
          FROM invoice_details AS IDE, products AS P, invoice AS I 
          WHERE I.ID = '".$invoiceID."' 
            AND I.ID=IDE.InvoiceID 
            AND P.ID=IDE.ProductID";

$result = $db->executeQuery($query, $connectionParameters);
$numRows = 10 - (count($result) + 1);

if(count($result) > 0)
{
	$grandTotal = 0.00;
	for($i=0;$i<count($result);$i++)
	{
		if ($i % 2){$bgcolor="dedede";}else{$bgcolor="ffffff";}

		$output .= '<tr bgcolor="#'.$bgcolor.'">
				<td>'.$result[$i]['ProductCode'].'</td>
				<td>'.$result[$i]['ProductName'].'</td>
				<td>'.$result[$i]['ProductSize'].'</td>
				<td>'.$result[$i]['Quantity'].'</td>
				<td>'.substr($result[$i]['UnitPrice'], 0, strlen($result[$i]['UnitPrice']) - 2).'</td>
				<td>'.substr($result[$i]['Total'], 0, strlen($result[$i]['Total']) - 2).'</td>
				</tr>';
		$grandTotal += $result[$i]['Total'];
	}
}
$vat=0.00;
		$nett = $grandTotal / (1 + $VAT);
		$vat=$grandTotal-$nett;
$output .= '</table>
<table width="100%" border="1">';
for($row=0;$row<$numRows;$row++)
{
	$output .= '<tr><td>&nbsp;</td></tr>';
}
$output .= '</table>
<table width="100%" border="0">
<tr>
	<td colspan="3"></td>
	<td><b>TOTAL</b></td>
	<td><b>'.number_format($nett, 2, '.', ',').'</b></td>
</tr>
<tr>
	<td colspan="3"></td>
	<td><b>VAT ('.($VAT * 100).'%)</b></td>
	<td><b>'.number_format($vat, 2, '.', ',').'</b></td>
</tr>
<tr>
	<td colspan="3"></td>
	<td><b>DISCOUNT AMOUNT</b></td>
	<td><b>'.number_format($result[$i]['DiscountAmount'], 2, '.', ',').'</b></td>
</tr>
<tr>
	<td colspan="3"></td>
	<td><b>TOTAL</b></td>
	<td><b>'.number_format($grandTotal, 2, '.', ',').'</b></td>
</tr>
</table>';

//$msg = generate_report("Invoice Receipt", "Invoice Receipt", "P", $output, $branchName, date('d-m-Y'), date('d-m-Y'));
$pdfTitle = "Invoice Receipt";
$pdfFileName = "Invoice Receipt";
$Orientation = "P";
$companyBranchName = $branchName;
$fromDate = $toDate = date('d-m-Y');
//*********** GENERATION PDF

// PDF CREATION
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ATCHIA CERAMICA');
$pdf->SetTitle($pdfTitle);
$pdf->SetSubject($pdfTitle);
$pdf->SetKeywords($pdfTitle);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "");

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page - l- landscape 
$pdf->AddPage($Orientation);


// output the HTML content
$pdf->writeHTML($output, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------
// Change To Avoid the PDF Error
 ob_end_clean();

 // Check if path exists
 $pdfpath = "";
 $pdfpath .= $absoluteURL."/adminzone/";
 $pdfpath .= "report/filemanager/generated_report/files/".str_replace(' ', '_', $companyBranchName)."/".str_replace(' ', '_', $pdfFileName)."/".date("Y")."/".date("M")."/".date("d")."/";
 
	if(!file_exists($pdfpath))
	{
		mkdir($pdfpath, 0777, true);
		chmod($pdfpath, 0777);
	}
 
// Close and output PDF document
$pdf->Output($pdfpath.str_replace(' ', '_', $pdfFileName)."_".date('d-m-Y', strtotime($fromDate))."_".date('d-m-Y', strtotime($toDate)).".pdf", 'F');
$msg = "PDF successfully generated, pdf filename : ".str_replace(' ', '_', $pdfFileName)."_".date('d-m-Y', strtotime($fromDate))."_".date('d-m-Y', strtotime($toDate)).".pdf";
//********** END GENERATION PDF

echo "<script>alert('".$msg."');window.close();</script>";
}
else
{
   echo "<script>alert('Branch ID and invoice ID not set');</script>"; 
}    
?>
