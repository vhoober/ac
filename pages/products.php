<?php
require_once 'adminzone/configuration/config.php';
require_once 'includes/class/DBQuery.php';
require_once 'includes/class/ps_pagination.php';

	//Connect to mysql db
	$conn = mysql_connect($connectionParameters['host'],$connectionParameters['username'],$connectionParameters['password']);
	if(!$conn) die("Failed to connect to database!");
	$status = mysql_select_db($connectionParameters['database'], $conn);
	if(!$status) die("Failed to select database!");
	$sql = "SELECT * FROM products";

		/*
	 * Create a PS_Pagination object
	 * 
	 * $conn = MySQL connection object
	 * $sql = SQl Query to paginate
	 * 10 = Number of rows per page
	 * 5 = Number of links
	 * "param1=valu1&param2=value2" = You can append your own parameters to paginations links
	 */
   
   $count = mysql_num_rows(mysql_query($sql));

	if($count > 0)
	{

	$pager = new PS_Pagination($conn, $sql, 20, 5, "spid=1");
	
	/*
	 * Enable debugging if you want o view query errors
	*/
	$pager->setDebug(true);
	
	/*
	 * The paginate() function returns a mysql result set
	 * or false if no rows are returned by the query
	*/
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());

	$output = '';
	$output .= '<table border="0" width="100%">';

	// Add some space
	$output .= '<tr><td colspan="99" height="15">&nbsp;</td></tr>';
$counter = 0;
while($row = mysql_fetch_assoc($rs)) {

			if(file_exists("adminzone/images/product/thumbnail/".$row['ID'].".".$row['format']))
                            {$thumb_img = "adminzone/images/product/thumbnail/".$row['ID'].".".$row['format'];}
			else 
                            {$thumb_img = "adminzone/images/product/thumbnail/noimage.gif";}

 			if(file_exists("adminzone/images/product/original/".$row['ID'].".".$row['format']))
                            {$orig_img = "adminzone/images/product/original/".$row['ID'].".".$row['format'];}
			else
                            {$orig_img = "adminzone/images/product/original/noimage.gif";}
	
	$output .= '<tr>
			<td valign="top" width="135px"><a href="'.$orig_img.'" rel="lightbox[stoneproproduct]" title="'.$row['ProductName'].'"><img src="'.$thumb_img.'" border="0" /></a></td>	
			<td width="5px">&nbsp;</td>
			<td valign="top">
				<table>
					<tr>
						<td>Name</td>
						<td> : <b>'.strtoupper($row['ProductName']).'</b></td>
					</tr>
					<tr>
						<td>Description</td>
						<td> : '.$row['Description'].'</td>
					</tr>
                                        <tr>
						<td>Size</td>
						<td> : '.$row['ProductSize'].'</td>
					</tr>';
                // Chek if additional images exist for this product
                 $db = new DBQuery();
                 $addtional_img = "SELECT * FROM product_photo WHERE product_id = '".$row['ID']."'";
                 $result_img = $db->executeQuery($addtional_img, $connectionParameters);
/*
                 if(count($result_img) > 0)
                 {
                     $output .= '<tr><td><a href="javascript:void(0)" onclick="toggleMe(\'prod_pic_'.$row['ID'].'\')">Show more pictures</a></td></tr>';
                 }
*/
//		<tr><td align="right"><a href="index.php?spid=3&prodname='.$row['ProductName'].'"><img border="0" src="images/ordernow.gif" /></a></td></tr>
	$output .= '</table>
			</td>
		   </tr>';
/*
$output .= '<tr><td colspan="99">
                    <table id="prod_pic_'.$row['ID'].'" style="display:none" cellspacing="0" cellpadding="0" width="100%">
                    ';

                 $count_img = 0;
                 for($xxx=0; $xxx<count($result_img); $xxx++)
                 {
			if(file_exists("adminzone/images/product/original/".$row['ID']."_".$result_img[$xxx]['product_photo_id'].".".$result_img[$xxx]['format']))
                            {$add_prod_img_orig = "adminzone/images/product/original/".$row['ID']."_".$result_img[$xxx]['product_photo_id'].".".$result_img[$xxx]['format'];}
			else
                            {$add_prod_img_orig = "adminzone/images/product/original/noimage.gif";}

			if(file_exists("adminzone/images/product/thumbnail/".$row['ID']."_".$result_img[$xxx]['product_photo_id'].".".$result_img[$xxx]['format']))
                            {$add_prod_img_thumb = "adminzone/images/product/thumbnail/".$row['ID']."_".$result_img[$xxx]['product_photo_id'].".".$result_img[$xxx]['format'];}
			else
                            {$add_prod_img_thumb = "adminzone/images/product/thumbnail/noimage.gif";}

                       if($count_img == 0)
                       {
                        $output .= '<tr>';
                       }

                        $count_img++;
                        $output .= '<td width="10%"><a href="'.$add_prod_img_orig.'" rel="lightbox[stoneproprodimg_'.$row['ID'].']" title="'.$row['ProductName'].'"><img src="'.$add_prod_img_thumb.'" border="0" /></a></td>';

                        if($count_img == 4)
                        {
                            $output .= '</tr>';
                            $count_img = 0;
                        }
                 }
                 $output .= '
                    </table>
                    </td></tr>';
*/

$counter++;
		if($counter < mysql_num_rows($rs))
		{
			$output .= '<tr><td colspan="99"><hr /></td></tr>';
		}


}

$output .= '<tr><td colspan="99" height="10">&nbsp;</td></tr>';
$output .= '<tr><td colspan="99" align="center">'.$pager->renderFullNav().'</td></tr>';
$output .= "</table><br><br>";
echo $output;
}
else
{
	echo '<table style="margin-left: 10px;">
			<tr><td class="alertmsg" valign="top" height="100">No products yet!</td></tr>			
		</table>';
}
?>
