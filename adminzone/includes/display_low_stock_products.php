<?php

	//Connect to mysql db
	$conn = mysql_connect($connectionParameters['host'],$connectionParameters['username'],$connectionParameters['password']);
	if(!$conn) die("Failed to connect to database!");
	$status = mysql_select_db($connectionParameters['database'], $conn);
	if(!$status) die("Failed to select database!");
	$sql = 'SELECT * FROM products WHERE Quantity < ReorderLevel';

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

	$pager = new PS_Pagination($conn, $sql, $rowPerPage, 5, "act=action&mod=displaylowstockproducts");

	/*
	 * The paginate() function returns a mysql result set
	 * or false if no rows are returned by the query
	*/
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
        
    $output = '<label class="contentHeader"><font color="brown">'.$count.'</font> Low level product(s) identified</label><br>';
    $output .= '<table id="tableList" width="100%" border="0" cellpadding="5" cellspacing="0">';
    $output .= '<tr align="left">
                    <th>Product Code</th>
                    <th>Product Name</th>
                    <th>Product Desc</th>
                    <th>Product Size</th>
                    <th>Quantity</th>
                    <th>Re-Order Level</th>
                </tr>';
    
		while($row = mysql_fetch_assoc($rs)) {

                $index++;

                if(($index%2)==0)
                {$output .= '<tr bgcolor="#f0f0f0" valign="top">';}
                else
                {$output .= '<tr valign="top">';}

                 $output .= '<td>'.$row['ProductCode'].'</td>
                             <td>'.$row['ProductName'].'</td>
                             <td>'.$row['Description'].'</td>
                             <td>'.$row['ProductSize'].'</td>
                             <td><b style="color:#FF0000;">'.$row['Quantity'].'</b></td>
                             <td><b>'.$row['ReorderLevel'].'</b></td>
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
            echo '<label class="contentHeader">No low level products found!</label>';
        }
	
?>
