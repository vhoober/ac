<?php
// PRODUCTS ASSOCIATED WITH GALLERY
	//Connect to mysql db
	$conn = mysql_connect($connectionParameters['host'],$connectionParameters['username'],$connectionParameters['password']);
	if(!$conn) die("Failed to connect to database!");
	$status = mysql_select_db($connectionParameters['database'], $conn);
	if(!$status) die("Failed to select database!");
	$sql = 'SELECT * FROM Products WHERE add_to_gallery = 1';

		/*
	 * Create a PS_Pagination object
	 *
	 * $conn = MySQL connection object
	 * $sql = SQl Query to paginate
	 * 10 = Number of rows per page
	 * 5 = Number of links
	 * "param1=valu1&param2=value2" = You can append your own parameters to paginations links
	 */


        $count_prod = mysql_num_rows(mysql_db_query($connectionParameters['database'], $sql));

	if($count_prod > 0)
	{

        // Pagination configuration
        $numrowsperpage = 20;
        $numlinks = 5;

	$pager = new PS_Pagination($conn, $sql, $numrowsperpage, $numlinks, "act=action&mod=productassocgallery");

	/*
	 * The paginate() function returns a mysql result set
	 * or false if no rows are returned by the query
	*/
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());

    $output = '<label class="contentHeader">'.$count_prod.' Products associated with Gallery</label><br>';
    $output .= '<table id="tableList" width="100%" border="0" cellpadding="5" cellspacing="0">';
    $output .= '<tr align="left">
    				<th width="15%">Thumbnail</th>
                    <th>Title</th>
                    <th>Description</th>
                </tr>';

		while($row = mysql_fetch_assoc($rs)) {

                $index++;

                if(($index%2)==0)
                {$output .= '<tr bgcolor="#f0f0f0" valign="top">';}
                else
                {$output .= '<tr valign="top">';}

			if(file_exists("images/product/thumbnail/".$row['ID'].".".$row['format']))
                            {$thumb_img = "images/product/thumbnail/".$row['ID'].".".$row['format'];}
			else
                            {$thumb_img = "images/product/thumbnail/noimage.gif";}

 			if(file_exists("images/product/original/".$row['ID'].".".$row['format']))
                            {$orig_img = "images/product/original/".$row['ID'].".".$row['format'];}
			else
                            {$orig_img = "images/product/original/noimage.gif";}

       		 $output .= '
       		 	<td><a href="'.$orig_img.'" rel="lightbox[stoneprogallery]" title="'.$row['ProductName'].'"><img src="'.$thumb_img.'" border="0" /></a></td>
                        <td>'.$row['ProductName'].'</td>
                        <td>'.$row['Description'].'</td>
                    </tr>';
		}

		// Add spacing
		$output .= '</table><br><br>';

	   //Display the full navigation in one go
		$output .= '<table width="100%"><tr><td><center style="font-family: Arial; font-size: 9pt">'.$pager->renderFullNav().'</center></td></tr>';

		$output .= '</table>';

		echo $output;
} // end if product count
else
{
    echo '<label class="contentHeader">No products associated with gallery</label>';
}
// END PRODUCTS ASSOCIATED WITH GALLERY

?>
