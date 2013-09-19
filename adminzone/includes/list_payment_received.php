<?php

	//Connect to mysql db
	$conn = mysql_connect($connectionParameters['host'],$connectionParameters['username'],$connectionParameters['password']);
	if(!$conn) die("Failed to connect to database!");
	$status = mysql_select_db($connectionParameters['database'], $conn);
	if(!$status) die("Failed to select database!");
	$sql = 'SELECT distinct debtors.ID,
            invoice.InvoiceID, 
            customer.Name, 
            invoice.InvoiceDate, 
            invoice.SubTotal, 
            invoice.DiscountAmount, 
            invoice.Total, 
            debtors.Amount,
            invoice.Total - debtors.Amount as Due,
            debtors.Status 
            FROM invoice, debtors, customer 
            WHERE customer.CustomerID=invoice.CustomerID
            AND invoice.ID=debtors.InvoiceID';

		/*
	 * Create a PS_Pagination object
	 * 
	 * $conn = MySQL connection object
	 * $sql = SQl Query to paginate
	 * 10 = Number of rows per page
	 * 5 = Number of links
	 * "param1=valu1&param2=value2" = You can append your own parameters to paginations links
	 */

        $count = mysql_num_rows(mysql_db_query($connectionParameters['database'], $sql));

	if($count > 0)
	{

	$pager = new PS_Pagination($conn, $sql, 20, 5, "act=action&mod=listpaymentreceived");

	/*
	 * The paginate() function returns a mysql result set
	 * or false if no rows are returned by the query
	*/
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
        
    $output = '<label class="contentHeader">'.$count.' Payment(s) Received Available</label><br>';
    $output .= '<table id="tableList" width="100%" border="0" cellpadding="5" cellspacing="0">';
    $output .= '<tr align="left">
                    <th>Invoice ID</th>
                    <th>Customer Name</th>
                    <th>Invoice Date</th>
                    <th>Sub Total</th>
                    <th>Discount</th>
                    <th>Total</th>
                    <th>Deposit</th>
                    <th>Due</th>
                    <th>Status</th>
                    <th width="8%">Action</th>
                </tr>';
    
		while($row = mysql_fetch_assoc($rs)) {

                $index++;

                if(($index%2)==0)
                {$output .= '<tr bgcolor="#f0f0f0" valign="top">';}
                else
                {$output .= '<tr valign="top">';}

                 $db = new DBQuery();
                 
                 if ($row['Status']=="Settled") {
                     
                     //make link disable
                     
                 }
                 
                 $output .= '<td>'.$row['InvoiceID'].'</td>
                             <td>'.$row['Name'].'</td>
                             <td>'.$row['InvoiceDate'].'</td>
                             <td>'.$row['SubTotal'].'</td>
                             <td>'.$row['Discount'].'</td>
                             <td>'.$row['Total'].'</td>
                             <td>'.$row['Amount'].'</td>
                             <td>'.$row['Due'].'</td>
                             <td>'.$row['Status'].'</td>
                             <td><a href="website.php?act=action&mod=processpaymentreceived&id='.$row['ID'].'">Proceed with payment</a></td>
                    </tr>';
		} // end while loop
		
		// Add spacing
		$output .= '</table><br><br>';
		
	   //Display the full navigation in one go
		$output .= '<table width="100%"><tr><td><center style="font-family: Arial; font-size: 9pt">'.$pager->renderFullNav().'</center></td></tr>';
		
		$output .= '</table>';
		
		echo $output;
	}
        else
        {
            echo '<label class="contentHeader">No Received Payment yet yet!</label>';
        }
	
?>
