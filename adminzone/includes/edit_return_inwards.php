<form method="POST" action="website.php?act=action&mod=proceedreturn" name="form2" id="form2">
	<div align="left">
            <fieldset><legend>Return Inwards</legend>
	<table border="0" id="table40" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border-style: none; border-width: medium; " bordercolor="#666666" width="430" valign="top" height="20">
							<p style="margin: 5px 20px">
										</td>
						</tr>
                                                <tr>
							<td style="border-style: none; border-width: medium; " bordercolor="#666666" width="100" align="center" height="47">
<?php
						//$db = new DBQuery();
                                                
        $conn = mysql_connect($connectionParameters['host'],$connectionParameters['username'],$connectionParameters['password']);
	if(!$conn) die("Failed to connect to database!");
	$status = mysql_select_db($connectionParameters['database'], $conn);
	if(!$status) die("Failed to select database!");
						
	$queryInvoice  = "SELECT invoice_details.*, products.ProductName, invoice.InvoiceID as INV_ID FROM invoice_details, products, invoice WHERE invoice_details.InvoiceID = '".trim($_GET['id'])."' AND invoice.ID=invoice_details.InvoiceID AND products.ID=invoice_details.ProductID";
						//$resultInvoice = $db->executeQuery($queryInvoice, $connectionParameters);
                                                
        $count = mysql_num_rows(mysql_db_query($connectionParameters['database'], $queryInvoice));
        
        if($count > 0)
	{
$pager = new PS_Pagination($conn, $queryInvoice, $count, 5, "act=action&mod=editreturninwards");

	/*
	 * The paginate() function returns a mysql result set
	 * or false if no rows are returned by the query
	*/
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
	
$output = '<label class="contentHeader">'.$count.' Return(s) Possible</label><br>';
$output .= '<table id="tableList" width="100%" border="0" cellpadding="5" cellspacing="0">';
    $output .= '<tr align="left">
                    <th>Select to Proceed</th>
    		    <th>Invoice ID</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                    <th>UnitPriceBeforeVAT</th>
                    <th>Total Before VAT</th>
                    <th>VAT</th>
                    <th>TotalVAT</th>
                    <th width="8%">Action</th>
                                    </tr>';
    
		while($row = mysql_fetch_assoc($rs)) {

                $index++;

                if(($index%2)==0)
                {$output .= '<tr bgcolor="#f0f0f0" valign="top">';}
                else
                {$output .= '<tr valign="top">';}

                 $output .= '<td><input type="checkbox" name="bestseller" tabindex="7" value="1"></td>
                         <td>'.$row['INV_ID'].'</td>
                             <td>'.$row['ProductName'].'</td>
                             <td>'.$row['Quantity'].'</td>
                        <td>'.number_format($row['UnitPrice'], 2, '.', '').'</td>
                            <td>'.number_format($row['Total'], 2, '.', '').'</td>
                            <td>'.number_format($row['UnitPriceBeforeVAT'], 2, '.', '').'</td>
                        <td>'.number_format($row['TotalBeforeVAT'], 2, '.', '').'</td>
                            <td>'.number_format($row['VAT'], 2, '.', '').'</td>
                                <td>'.number_format($row['TotalVAT'], 2, '.', '').'</td>
                                    <td><a href="website.php?act=action&mod=proceedreturn&id='.$row['ID'].'">Confirm</a></td>
                    </tr>
                    <tr><td colspan="99">
                    
                    <table id="prod_pic_'.$row['ID'].'" style="display:none" cellspacing="0" cellpadding="0">
                    ';

            
                 $output .= '
                    </table>
                    </td></tr>';

		} // end while loop
		
		// Add spacing
		$output .= '</table><br><br>';
	
		echo $output;
	}
        else
        {
            echo '<label class="contentHeader">No Invoice Details yet!</label>';
        }
	
                                                
						?>
				
                                    </td>
				</tr>
			</table>
               </fieldset>
	</div>
</form>