<?php 
$msg = $_GET['msg'];
if(isset($msg) && trim($msg) != "")
{
	echo "<div class='contentHeader' style='color:green'>".$msg."</div>";
}
?>
<fieldset><legend>Search Product</legend>
<form action="website.php?act=action&mod=listproduct" method="post">
Search Product by : <select name="search_criteria" id="search_criteria">
	<option value="">Select search criteria</option>
	<option value="Supplier">Supplier</option>
	<option value="ProductCode">Code</option>
	<option value="ProductName">Name</option>	
	<option value="Description">Description</option>
	<option value="ProductSize">Product Size</option>
	<option value="Quantity">Quantity</option>
	<option value="Is_Obsolete">Obsolete[0 - false, 1 - true]</option>
</select>&nbsp;&nbsp;
Search Parameter : <select name="search_parameter" id="search_parameter">
	<option value="">Select search parameter</option>
	<option value="=">Equals</option>
	<option value="&gt;">Greater than</option>
	<option value="&lt;">Less than</option>	
	<option value="like">Like</option>
</select>&nbsp;&nbsp;
Search Value : <input type="text" name="search_value" id="search_value" />&nbsp;&nbsp;
<input type="submit" name="submit" value="Search" /> 
</form>
</fieldset>
<p />
<?php

	//Connect to mysql db
	$conn = mysql_connect($connectionParameters['host'],$connectionParameters['username'],$connectionParameters['password']);
	if(!$conn) die("Failed to connect to database!");
	$status = mysql_select_db($connectionParameters['database'], $conn);
	if(!$status) die("Failed to select database!");
	
	if($_POST['submit'] == "Search")
	{
		if(isset($_SESSION['list_product'])){unset($_SESSION['list_product']);}
		
		//$select = "SELECT P.*, S.name ";
		//$from = "FROM products AS P, supplier AS S ";
		$select = "SELECT P.* ";
		$from = "FROM products AS P ";
				
		$where = "WHERE IsApprove=1";
		
		if($_POST['search_criteria'] == "" && $_POST['search_parameter'] == "" && trim($_POST['search_value']) == "")
		{
			$sql = $select.$from.$where;
		}
		else 
		{
			$where .= " AND ".$_POST['search_criteria']." ".$_POST['search_parameter'];
			
			if($_POST['search_parameter'] == "like")
			{
				$where .= " '%".addslashes(trim($_POST['search_value']))."%'";
			}
			else
			{
				$where .= " '".addslashes(trim($_POST['search_value']))."'";
			}
			
			$sql = $select.$from.$where;
			$_SESSION['list_product'] = $sql;			
		}
		
	}	
	else 
	{	if(isset($_SESSION['list_product']))
		{
			$sql = $_SESSION['list_product'];
		}
		else 
		{
			$sql = 'SELECT * FROM products WHERE IsApprove=1';
		}
	}
//echo $sql;//exit;
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

	$pager = new PS_Pagination($conn, $sql, $rowPerPage, 5, "act=action&mod=listproduct");

	/*
	 * The paginate() function returns a mysql result set
	 * or false if no rows are returned by the query
	*/
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());
        
    $output = '<label class="contentHeader"><font color="brown">'.$count.'</font> Product(s) Available';
    $db = new DBQuery();
    
    $queryLowLevelProduct = $sql." AND Quantity < ReorderLevel";
    $resultLowLevelProduct = $db->executeQuery($queryLowLevelProduct, $connectionParameters);
    
	if(count($resultLowLevelProduct) > 0)
	{
		$output .= ' [<img border="0" src="images/alert.gif" alt="Alert icon" height="23px" valign="bottom" /> - Low level product(s) found. <a href="website.php?act=action&mod=displaylowstockproducts">Click here for more details...</a>]';
	}
	
    $output .= '</label> <br><table id="tableList" width="100%" border="0" cellpadding="5" cellspacing="0">';
    $output .= '<tr align="left">
    		    <th width="15%">Thumbnail</th>
                    <th>Supplier</th>
                    <th>Code</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Best Seller</th>
                    <th>Unit S.P</th>
                    <th width="8%">Action</th>
                </tr>';
    
		while($row = mysql_fetch_assoc($rs)) {
			if($row['Is_Obsolete'] == 1)
			{
				$output .= '<tr bgcolor="#ff7673" valign="top">';
			}
			else 
			{
                $index++;

                if(($index%2)==0)
                {$output .= '<tr bgcolor="#f0f0f0" valign="top">';}
                else
                {$output .= '<tr valign="top">';}
			}

			if(file_exists("images/product/thumbnail/".$row['ID'].".".$row['format']))
                            {$thumb_img = "images/product/thumbnail/".$row['ID'].".".$row['format'];}
			else 
                            {$thumb_img = "images/product/thumbnail/noimage.gif";}

 			if(file_exists("images/product/original/".$row['ID'].".".$row['format']))
                            {$orig_img = "images/product/original/".$row['ID'].".".$row['format'];}
			else
                            {$orig_img = "images/product/original/noimage.gif";}
			
             // <a href="'.$orig_img.'" rel="lightbox[stoneprogallery]" title="'.$row['ProductName'].'">...... </a>
       		 $output .= '
       		 	<td><span id="product_img_'.$row['ID'].'"><a href="#" onclick="toggleMe(\'product_'.$row['ID'].'\');"><img src="'.$thumb_img.'" border="0" title="'.strtoupper($row['ProductName']).'" /></a></span></td>';

                 // Chek if additional images exist for this product
                 $db = new DBQuery();


                 if($row['BestSeller'] == 1){$checked ="checked";}else{$checked = "";}
                 
                 if($row['Is_Obsolete'] == 1)
                 	{$obsolete=0;$obsoleteText="Not Obsolete";}
                 else 
                 	{$obsolete=1;$obsoleteText="Obsolete";}
                 
                 $output .= '<td>'.$row['Supplier'].'</td>
                             <td>'.$row['ProductCode'].'</td>
                             <td>'.strtoupper($row['ProductName']).'</td>
                             <td>'.$row['Description'].'</td>
                             <td>'.$row['ProductSize'].'</td>
                             <td>'.$row['Quantity'].'</td>
                             <td><input type="checkbox" disabled name="bestseller" tabindex="7" value="1" checked="'.$checked.'"></td>
                             <td>'.number_format($row['UnitSellingPrice'], 2, '.', '').'</td>
                             <td><a href="website.php?act=action&mod=editproduct&id='.$row['ID'].'">Edit</a> | <a title="Click on link to make product '.$obsoleteText.'" href="website.php?act=action&mod=changeproductstatus&id='.$row['ID'].'&isobsolete='.$obsolete.'" onclick="return confirm(\'You are about to change status of this product.\n Proceed?\')">'.$obsoleteText.'</a></td>
                    </tr>
                 	<tr id="product_'.$row['ID'].'" style="display:none;">
                 		<td colspan="10" style="width:100%;">
                 			<form id="form_'.$row['ID'].'" action="includes/upload_product_image.php" method="post" enctype="multipart/form-data">
                 			<span id="upload_product_img_'.$row['ID'].'"><input type="hidden" name="prodid" id="prodid" value="'.$row['ID'].'" />
                 			Upload product image : <input type="file" name="img_prod" id="img_prod" />&nbsp;<input type="submit" name="submit" value="Upload" />	
                 		</span></form></td>
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
            echo '<label class="contentHeader">No products yet!</label>';
        }
	
?>
