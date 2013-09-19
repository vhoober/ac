<?php

	//Connect to mysql db
	$conn = mysql_connect($connectionParameters['host'],$connectionParameters['username'],$connectionParameters['password']);
	if(!$conn) die("Failed to connect to database!");
	$status = mysql_select_db($connectionParameters['database'], $conn);
	if(!$status) die("Failed to select database!");
	$sql = 'SELECT S.*, ST.type FROM supplier AS S, supplier_type AS ST WHERE S.supplierTypeId = ST.supplierTypeId';

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

	$pager = new PS_Pagination($conn, $sql, $rowPerPage, 5, "act=action&mod=listsupplier");

	/*
	 * The paginate() function returns a mysql result set
	 * or false if no rows are returned by the query
	*/
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
        
    $output = '<label class="contentHeader"><font color="brown">'.$count.'</font> Supplier(s) Available</label><br>';
    $output .= '<table id="tableList" width="100%" border="0" cellpadding="5" cellspacing="0">';
    $output .= '<tr align="left">
                    <th>Name</th>
                    <th>Type</th>
                    <th>Address</th>
                    <th>Country</th>
                    <th>Phone No</th>
                    <th>Mobile No</th>
                    <th>Fax No</th>
                    <th>Email Address</th>
                    <th>VAT No</th>
                    <th width="8%">Action</th>
                </tr>';
    
		while($row = mysql_fetch_assoc($rs)) {

                $index++;

                if(($index%2)==0)
                {$output .= '<tr bgcolor="#f0f0f0" valign="top">';}
                else
                {$output .= '<tr valign="top">';}

                 $output .= '<td>'.strtoupper($row['name']).'</td>
                             <td>'.$row['type'].'</td>
                             <td>'.$row['address1'].'</td>
                             <td>'.$row['country'].'</td>
                             <td>'.$row['phoneNo'].'</td>
                             <td>'.$row['mobileNo'].'</td>
                             <td>'.$row['faxNo'].'</td>
                             <td>'.$row['emailAddress'].'</td>
                             <td>'.$row['vatNo'].'</td>
                             <td><a href="website.php?act=action&mod=editsupplier&id='.$row['supplierId'].'">Edit</a></td>
                    </tr>';
		} // end while loop
		// | <a href="website.php?act=action&mod=deletesupplier&id='.$row['supplierId'].'" onclick="return confirm(\'You are about to delete this record.\n Proceed?\')">Delete</a>
		// Add spacing
		$output .= '</table><br><br>';
		
	   //Display the full navigation in one go
		$output .= '<table width="100%"><tr><td><center style="font-family: Arial; font-size: 9pt">'.$pager->renderFullNav().'</center></td></tr>';
		
		$output .= '</table>';
		
		echo $output;
	}
        else
        {
            echo '<label class="contentHeader">No Supplier yet!</label>';
        }
	
?>
