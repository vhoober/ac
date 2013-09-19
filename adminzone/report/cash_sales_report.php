<?php
//echo "ici sa ".$_SERVER['HTTP_REFERER'];
echo preg_replace("/website.php+", "", $_SERVER['HTTP_REFERER']);
ini_set('memory_limit', '-1');
ini_set('max_execution_time', '36000');

require_once('functions/generate_report.php');

$db = new DBQuery();
?>
<form name="frmreport" action="website.php?act=action&mod=cash_sales" method="post">
<fieldset><legend>Cash sales criteria</legend>	
<table border="0" width="100%">
<tr>
	<td>From</td>
	<td> : <input type="text" name="txtFromDate" value="<?php echo date("d-m-Y");?>" onfocus="this.select();lcs(this)" onclick="event.cancelBubble=true;this.select();lcs(this)" /></td>
	<td>&nbsp;</td>
	<td>Branch</td>
	<td> : <select name="cboBranch">
<?php
$queryBranch = "SELECT * FROM branch";
$resultBranch = $db->executeQuery($queryBranch, $connectionParameters);

if(count($resultBranch) > 0)
{
	for($branch=0;$branch<count($resultBranch);$branch++)
	{?>
		<option value="<?php echo $resultBranch[$branch]['ID'].'*'.str_replace(' ', '_', $resultBranch[$branch]['BranchName'])?>"><?php echo $resultBranch[$branch]['BranchName']?></option>
	<?php }
}
?>			
	</select></td>
</tr>
<tr>
	<td>To</td>
	<td> : <input type="text" name="txtToDate" value="<?php echo date("d-m-Y");?>" onfocus="this.select();lcs(this)" onclick="event.cancelBubble=true;this.select();lcs(this)" /></td>
	<td>&nbsp;</td>
	<td colspan="2"><input type="submit" name="generate" value="Generate" /></td>
</tr>
</table>
</fieldset>
</form>
<label>
<?php 
if($_POST['generate'] == "Generate")
{
$output = '';

list($branchId, $branchName) = explode('*', trim($_POST['cboBranch']));

$fromDate = trim($_POST['txtFromDate']);
$toDate = trim($_POST['txtToDate']);

// Header
$output = '<font align="center" color="#000000"><b>CASH SALES REPORT FROM : '.date('jS-M-Y', strtotime($fromDate)).' TO '.date('jS-M-Y', strtotime($toDate)).' BRANCH : '.strtoupper(str_replace('_', ' ', $branchName)).'</b></font><hr><br><br>';

// table header
$output .= '<table width="100%" border="1">
		<tr>
			<td><b>INV ID</b></td>
			<td><b>CUSTOMER NAME</b></td>
			<td><b>SUB-TOTAL</b></td>
			<td><b>DISCOUNT</b></td>
			<td><b>TOTAL</b></td>
		</tr>';

// Query
$query = "SELECT I.InvoiceID, C.Name, I.SubTotal, I.DiscountAmount, I.Total
FROM invoice as I, customer as C
WHERE I.CustomerID = C.CustomerID
AND I.Status = 'Paid'
AND I.Branch = '".$branchId."'
AND (I.InvoiceDate BETWEEN '".date('Y-m-d', strtotime($fromDate))."' and '".date('Y-m-d', strtotime($toDate))."')
ORDER BY I.InvoiceID";
echo $query;
$result = $db->executeQuery($query, $connectionParameters);

if(count($result) > 0)
{
	$grandTotal = 0.00;
	$dataArray = "";
	for($i=0;$i<count($result);$i++)
	{
		if ($i % 2){$bgcolor="dedede";}else{$bgcolor="ffffff";}

		$output .= '<tr bgcolor="#'.$bgcolor.'">
				<td>'.$result[$i]['InvoiceID'].'</td>
				<td>'.$result[$i]['Name'].'</td>
				<td>'.number_format($result[$i]['SubTotal'], 2, '.', ',').'</td>
				<td>'.number_format($result[$i]['DiscountAmount'], 2, '.', ',').'</td>
				<td>'.number_format($result[$i]['Total'], 2, '.', ',').'</td>
			   </tr>';
		$grandTotal += $result[$i]['Total'];

		// Listing
                $dataArray .= '{"InvoiceID":"'.stripslashes($result[$i]['InvoiceID']).'","Name":"'.stripslashes($result[$i]['Name']).'","Sub_Total":"'.number_format($result[$i]['SubTotal'], 2, '.', ',').'","Discount_Amount":"'.number_format($result[$i]['DiscountAmount'], 2, '.', ',').'","Total":"'.number_format($result[$i]['Total'], 2, '.', ',').'"}';
                if($i != count($result) -1){$dataArray.=',';}
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

$listing = '';
$listing .= '<fieldset><legend align="left">Cash Sales Listing</legend>';
$listing .= '<div id="container8"><script type="text/javascript" language="JavaScript">
    data2 = new Array('.$dataArray.');
    new TableOrderer(\'container8\',{data : data2, search:\'top\', pagination:\'top\', pageCount:25});
    </script></div>';
$listing .= '</fieldset>';
echo $listing;
//$msg = generate_report("Cash_Sales_Report", "Cash_Sales_Report", "P", $output, $branchName, $fromDate, $toDate);
//echo $msg;
/*
$pdfpath = $_SERVER['SERVER_NAME']."/atchia_ceramica/adminzone/report/generated_report/".str_replace(' ', '_', $branchName)."/".str_replace(' ', '_', 'Cash_Sales_Report')."/".date("Y")."/".date("M")."/".date("d")."/";
$pdfname = "Cash_Sales_Report.pdf";
$file_url = $pdfpath/$pdfname; 
echo $file_url;exit;
header('Content-Type: application/pdf'); 
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=".$pdfname); 
readfile($file_url);
*/
}
?>
</label>
