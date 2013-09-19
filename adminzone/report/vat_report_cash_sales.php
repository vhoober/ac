<?php
require_once('config.php');
require_once('../../includes/class/DBQuery.php');
require_once('generate_report.php');


$db = new DBQuery();

$output = '';

// Header
$output = '<font align="center" color="#000000"><b>VAT REPORT ON CASH SALES REPORT FROM : 2000-01-01 TO 2013-07-04 BRANCH : PORT LOUIS</b></font><hr><br><br>';

// table header
$output .= '<table width="100%" border="1">
		<tr>
			<td><b>INV ID</b></td>
			<td><b>CUSTOMER NAME</b></td>
			<td><b>TOTAL</b></td>
			<td><b>VAT AMOUNT</b></td>
		</tr>';

// Query
$query = "SELECT I.InvoiceID, C.Name, I.Total
FROM Invoice as I, Customer as C
WHERE I.CustomerID = C.CustomerID
AND I.Status = 'Paid'
AND I.Branch = 1
AND (I.InvoiceDate BETWEEN '2013-01-01' and '2013-07-04');";

$result = $db->executeQuery($query, $connectionParameters);

if(count($result) > 0)
{
	$grandTotal = 0.00;
	for($i=0;$i<count($result);$i++)
	{
		if ($i % 2){$bgcolor="dedede";}else{$bgcolor="ffffff";}

		$vat=0.00;
		$nett = $result[$i]['Total'] / 1.15;
		$vat=$result[$i]['Total']-$nett;
		
		$output .= '<tr bgcolor="#'.$bgcolor.'">
				<td>'.$result[$i]['InvoiceID'].'</td>
				<td>'.$result[$i]['Name'].'</td>
				<td>'.number_format($result[$i]['Total'], 2, '.', ',').'</td>
				<td>'.number_format($vat, 2, '.', ',').'</td>
				</tr>';
		$grandTotal += $vat;
	}
}

$output .= '</table>
<table width="100%" border="0">
<tr>
	<td colspan="3"></td>
	<td><b>GRAND TOTAL</b></td>
	<td><b>'.number_format($grandTotal, 2, '.', ',').'</b></td>
</tr>
</table>';

$msg = generate_report("VAT Cash Sales Report", "VAT Cash Sales Report", "P", $output);
echo $msg;
?>
