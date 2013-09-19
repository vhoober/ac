<?php
// GALLERY
	//Connect to mysql db
	$conn = mysql_connect($connectionParameters['host'],$connectionParameters['username'],$connectionParameters['password']);
	if(!$conn) die("Failed to connect to database!");
	$status = mysql_select_db($connectionParameters['database'], $conn);
	if(!$status) die("Failed to select database!");
	$sql1 = 'SELECT * FROM gallery';

		/*
	 * Create a PS_Pagination object
	 *
	 * $conn = MySQL connection object
	 * $sql = SQl Query to paginate
	 * 10 = Number of rows per page
	 * 5 = Number of links
	 * "param1=valu1&param2=value2" = You can append your own parameters to paginations links
	 */

        $count_gallery = mysql_num_rows(mysql_db_query($connectionParameters['database'], $sql1));

	if($count_gallery > 0)
	{
            
        // Pagination configuration
        $numrowsperpage = 20;
        $numlinks = 5;

	$pager1 = new PS_Pagination($conn, $sql1, $numrowsperpage, $numlinks, "act=action&mod=browsegallery");

	/*
	 * The paginate() function returns a mysql result set
	 * or false if no rows are returned by the query
	*/
	$rs1 = $pager1->paginate();
	if(!$rs1) die(mysql_error());

    $output1 = '<label class="contentHeader">'.$count_gallery.' Pictures in Gallery</label><br>';
    $output1 .= '<table id="tableList" width="100%" border="0" cellpadding="5" cellspacing="0">';
    $output1 .= '<tr align="left">
    				<th width="15%">Thumbnail</th>
                    <th>Photo Name</th>
                    <th>Photo Description</th>
                    <th width="8%">Action</th>
                </tr>';

		while($row1 = mysql_fetch_assoc($rs1)) {

                $index1++;

                if(($index1%2)==0)
                {$output1 .= '<tr bgcolor="#f0f0f0" valign="top">';}
                else
                {$output1 .= '<tr valign="top">';}

			if(file_exists("images/gallery/thumbnail/".$row1['gallery_id'].".".$row1['format']))
                            {$thumb_img1 = "images/gallery/thumbnail/".$row1['gallery_id'].".".$row1['format'];}
			else
                            {$thumb_img1 = "images/gallery/thumbnail/noimage.gif";}

 			if(file_exists("images/gallery/original/".$row1['gallery_id'].".".$row1['format']))
                            {$orig_img1 = "images/gallery/original/".$row1['gallery_id'].".".$row1['format'];}
			else
                            {$orig_img1 = "images/gallery/original/noimage.gif";}

       		 $output1 .= '
       		 	<td><a href="'.$orig_img1.'" rel="lightbox[stoneprogallery1]" title="'.$row1['photo_name'].'"><img src="'.$thumb_img1.'" border="0" /></a></td>
                        <td>'.$row1['photo_name'].'</td>
                        <td>'.$row1['photo_desc'].'</td>
                        <td><a href="website.php?act=action&mod=editgallery&id='.$row1['gallery_id'].'">Edit</a> | <a href="website.php?act=action&mod=deletegallery&id='.$row1['gallery_id'].'" onclick="return confirm(\'You are about to delete this record.\nProceed?\')">Delete</a></td>
                    </tr>';
		}

		// Add spacing
		$output1 .= '</table><br><br>';

	   //Display the full navigation in one go
		$output1 .= '<table width="100%"><tr><td><center style="font-family: Arial; font-size: 9pt">'.$pager1->renderFullNav().'</center></td></tr>';

		$output1 .= '</table>';

		echo $output1;
	} // end if gallery count
        else
        {
            echo '<label class="contentHeader">No pictures available!</label>';
        }
// END GALLERY

?>
