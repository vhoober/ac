<?php
	$db = new DBQuery();
						
	$queryUser  = "SELECT CustomerID, Name FROM customer ORDER BY Name";
	$resultAllContacts = $db->executeQuery($queryUser, $connectionParameters);
        
?>
<script>
var contactarray=new Array();
<?php
	for($zc=0; $zc<count($resultAllContacts); $zc++)
	{
?>
contactarray.push(<?php echo "\"".$resultAllContacts[$zc]['Name']." ".$resultAllContacts[$zc]['Name']."\"";?>);
<?php }?>
</script>	

<script>
					var obj = actb(document.getElementById('dummycontact'),contactarray);
					</script>
<form id="theform" name="dummysearch">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr><td>
					
<script>
var contactarray=new Array();
<?php
	for($zc=0; $zc<count($resultAllContacts); $zc++)
	{
?>
contactarray.push(<?php echo "\"".$resultAllContacts[$zc]['Name']." ".$resultAllContacts[$zc]['Name']."\"";?>);
<?php }?>
</script>				Enter Customer Name	
					<input type="text" class="cmbdate" id="dummycontact" name="dummycontact" onKeyDown="if(event.keyCode==13) jumpto('scontact','dummycontact');" onkeyup="matchFieldSelect(this, 'scontact');" onchange="jumpto('scontact','dummycontact');" />
					<script>
					var obj = actb(document.getElementById('dummycontact'),contactarray);
					</script>					
					<select style="width:300px" name="searchcontact" id="scontact" onchange="jumpto('scontact','dummycontact')">
						<option value="">Search Customer Name
						
						<?php

						for($i=0;$i<count($resultAllContacts);$i++)
						{
							echo '<option value="'.$resultAllContacts[$i]['CustomerID'].'">'.$resultAllContacts[$i]['Name']."</option>";
						}

						?>
					</select>
				
					</td></tr>

				</table>
				</form>
                                        </td></tr>
<!-- ------------------- search account / contact -------------------- -->

				<tr><td colspan="99">
				<div id="scrollmeEVENT">
				
<?php

	//Connect to mysql db
	$conn = mysql_connect($connectionParameters['host'],$connectionParameters['username'],$connectionParameters['password']);
	if(!$conn) die("Failed to connect to database!");
	$status = mysql_select_db($connectionParameters['database'], $conn);
	if(!$status) die("Failed to select database!");
	$sql = 'SELECT ID, invoice.InvoiceID, customer.Name, invoice.InvoiceDate, invoice.SubTotal, invoice.DiscountAmount, invoice.Total
FROM invoice, customer
WHERE customer.CustomerID = invoice.CustomerID';

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

	$pager = new PS_Pagination($conn, $sql, $rowPerPage, 5, "act=action&mod=returninwards");

	/*
	 * The paginate() function returns a mysql result set
	 * or false if no rows are returned by the query
	*/
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());

$output = '<table id="tableList" width="100%" border="0" cellpadding="5" cellspacing="0">';
    $output .= '<tr align="left">
    		    <th>Invoice ID</th>
                    <th>Customer Name</th>
                    <th>Invoice Date</th>
                    <th>Sub Total</th>
                    <th>Discount</th>
                    <th>Total</th>
                    <th width="8%">Action</th>
                                    </tr>';
    
		while($row = mysql_fetch_assoc($rs)) {

                $index++;

                if(($index%2)==0)
                {$output .= '<tr bgcolor="#f0f0f0" valign="top">';}
                else
                {$output .= '<tr valign="top">';}

                 $output .= '<td>'.$row['InvoiceID'].'</td>
                             <td>'.$row['Name'].'</td>
                             <td>'.$row['InvoiceDate'].'</td>
                        <td>'.number_format($row['SubTotal'], 2, '.', '').'</td>
                            <td>'.number_format($row['DiscountAmount'], 2, '.', '').'</td>
                            <td>'.number_format($row['Total'], 2, '.', '').'</td>
                        <td><a href="website.php?act=action&mod=editreturninwards&id='.$row['ID'].'">Proceed</a></td>
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
		
	   //Display the full navigation in one go
		$output .= '<table width="100%"><tr><td><center style="font-family: Arial; font-size: 9pt">'.$pager->renderFullNav().'</center></td></tr>';
		
		$output .= '</table>';
		
		echo $output;
	}
        else
        {
            echo '<label class="contentHeader">No products yet!</label>';
        }
	
?>
