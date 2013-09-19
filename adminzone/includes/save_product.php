<?php
if($_POST['update'] == "update") {

	$add_to_gallery = (isset($_POST['addtogallery']) ? $_POST['addtogallery'] : 0);
        $best_seller = (isset($_POST['bestseller']) ? $_POST['bestseller'] : 0);
        
        $ProductName=trim($_POST['productname']);
				  	$Description = trim($_POST['description']);
                                        $Supplier = trim($_POST['supplier']);
                                        $ProductCode = trim($_POST['productcode']);
                                        $ProductSize = trim($_POST['productsize']);
                                        $UnitCostPrice = trim($_POST['unitcostprice']);
                                        $UnitSellingPrice = trim($_POST['unitsellingprice']);
                                        $UnitWholesalePrice = trim($_POST['unitwholesaleprice']);
                                        $Quantity = trim($_POST['quantity']);
                                        $ReorderLevel = trim($_POST['reorderlevel']);
                                       
                                        
	
	$db = new DBQuery();

	$insertProductSQL = "INSERT INTO Products (ProductName,
				  	Description,
                                        Supplier,
                                        ProductCode,
                                        ProductSize,
                                        UnitCostPrice,
                                        UnitSellingPrice,
                                        UnitWholesalePrice,
                                        Quantity,
                                        ReorderLevel,
                                        BestSeller,
                                        add_to_gallery,
                                        date) VALUES ('$ProductName', '$Description', '$Supplier', '$ProductCode', '$ProductSize', '$UnitCostPrice', '$UnitSellingPrice', '$UnitWholesalePrice', '$Quantity', '$ReorderLevel', '$best_seller', '$add_to_gallery', '".date("Y-m-d H:i:s")."')";
	$product_id = $db->executeNonQuery($insertProductSQL, $connectionParameters);
	$_SESSION['ID']	= $product_id;
}

/*
 * $add_to_gallery = (isset($_POST['addtogallery']) ? $_POST['addtogallery'] : 0);
$best_seller = (isset($_POST['bestseller']) ? $_POST['bestseller'] : 0);
$updateProduct = "UPDATE Products SET ProductName ='".trim($_POST['productname'])."',
				  	Description = '".trim($_POST['description'])."',
                                        Supplier = '".trim($_POST['supplier'])."',
                                        ProductCode = '".trim($_POST['productcode'])."',
                                        ProductSize = '".trim($_POST['productsize'])."',
                                        UnitCostPrice = '".trim($_POST['unitcostprice'])."',
                                        UnitSellingPrice = '".trim($_POST['unitsellingprice'])."',
                                        UnitWholesalePrice = '".trim($_POST['unitwholesaleprice'])."',
                                        Quantity = '".trim($_POST['quantity'])."',
                                        ReorderLevel = '".trim($_POST['reorderlevel'])."',
                                        BestSeller = '".$best_seller."',
                                        add_to_gallery = '".$add_to_gallery."'
				  WHERE ID = '".trim($_POST['productID'])."'";
 * if($_POST['Save'] == "Save") {

$username	= trim($_POST['username']);
$password	= trim($_POST['password']);   
$name	= trim($_POST['name']);
$address	= trim($_POST['address']);
$title	= trim($_POST['TitleAbreviation']);
$phoneno	= trim($_POST['phoneno']);
$mobileno	= trim($_POST['mobileno']);
$userlevel	= trim($_POST['userlevel']);
  
	
	$db = new DBQuery();

	$insertUserSQL = "INSERT INTO Users (Username, Password, Name, Address, Title, PhoneNo, MobileNo, DateCreated, UserLevel) VALUES ('$username', '".md5($password)."', '$name', '$address', '$title', '$phoneno', '$mobileno', '".date("Y-m-d H:i:s")."', $userlevel)";
	$ID = $db->executeNonQuery($insertUserSQL, $connectionParameters);
	$_SESSION['ID']	= $ID;
 * */
 


?>
<form name="form" enctype="multipart/form-data" method="post" action="website.php?act=action&mod=saveproduct">
<div align="center">
    <p>&nbsp;</p>
<p>&nbsp;</p>
<table  border="0" cellpadding="0" cellspacing="0" id="table8">
    <tr>
      <td width="16">
		<img src="images/top_lef.gif" width="16" height="16"></td>
      <td height="16" background="images/top_mid.gif">
		<img src="images/top_mid.gif" width="16" height="16"></td>
      <td width="24">
		<img src="images/top_rig.gif" width="24" height="16"></td>
    </tr>
    <tr>
      <td width="16" background="images/cen_lef.gif">
		<img src="images/cen_lef.gif" width="16" height="11"></td>
      <td align="center" valign="top" bgcolor="#FFFFFF">
								<div align="center">
									<table border="0" width="532" id="table35" cellspacing="0" cellpadding="0" height="299" style="border-width: 0px">
										<tr>
											<td style="border-style: none; border-width: medium" bordercolor="#000000" bgcolor="#333333" height="20" width="532">
											<p style="margin:0 20px; ">
											<font color="#FFFFFF" face="Arial">
											<span style="font-weight: 700; font-size: 9pt; text-transform:uppercase">
											upload product </span>
											<span style="font-weight: 700; font-size: 9pt">
											(Upload picture)</span></font></td>
										</tr>
										<tr>
											<td height="251" width="532">
											<div align="center">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td width="262"><table border="0" width="262" id="table36" cellspacing="0" cellpadding="0">
												<tr>
													<td width="262">
													<p style="margin: 0 10px">
													<font size="1" color="#000000" face="Arial">
													Click BROWSE to locate the
													picture you want to upload.
													Once selected click on
													UPLOAD PICTURE. After
													uploading the picture click
													on FINISH to return to go to
													the main member panel</font></td>
												</tr>
												<tr>
													<td width="262">&nbsp;
													</td>
												</tr>
												<tr>
													<td width="262" height="50">
													<p style="margin:0 10px; ">
			<font face="Arial" style="font-size: 8pt" color="#999999">
	picture to upload</font>
	<span style="font-size: 8pt">
	<font face="Arial" color="#999999">
	<input type="file" name="upload" size="30" style="font-family: Arial; font-size: 9pt" ></font></span></td>
												</tr>
												<tr>
													<td width="262">
													<p style="margin-top: 0; margin-bottom: 0" align="right">
													<font size="1" face="Arial"><?php if(isset($_POST['addtogallery'])){$checked ="checked";}else{$checked = "";}?>
                                                                                                        Display Photo in Gallery<input type="checkbox" name="addtogallery" tabindex="7" value="1" <?php echo $checked;?>>
													</font></p>
													</td>
												</tr>
												<tr>
													<td width="262" valign="bottom">
													<p style="margin-left: 10px; margin-right: 10px">
								<input type="submit" value="upload picture" name="Submit" tabindex="8">&nbsp; <?php if($_POST['Submit'] == "upload picture"){?><input type="button" value="finish" name="B4" onClick="window.location='website.php?act=action&mod=listproduct'" tabindex="8"><?php }?></td>
												</tr>
												</table></td>
				<td><?php
                                // Process image upload and display thumbnail
                                if($_POST['Submit'] == "upload picture")
                                {
                                    // retrieve eventual CLI parameters
                                    $cli = (isset($argc) && $argc > 1);
                                    if ($cli) {
                                        if (isset($argv[1])) $_GET['file'] = $argv[1];
                                        if (isset($argv[2])) $_GET['dir'] = $argv[2];
                                        if (isset($argv[3])) $_GET['pics'] = $argv[3];
                                    }

                                    // set variables
                                    // Original picture
                                    $dir_dest_orig = (isset($_GET['dir']) ? $_GET['dir'] : 'images/product/original/');
                                    $dir_pics_orig = (isset($_GET['pics']) ? $_GET['pics'] : $dir_dest_orig);

                                    // Thumbnail picture
                                    $dir_dest_thumb = (isset($_GET['dir']) ? $_GET['dir'] : 'images/product/thumbnail/');
                                    $dir_pics_thumb = (isset($_GET['pics']) ? $_GET['pics'] : $dir_dest_thumb);

                                    $handle = new Upload($_FILES['upload']);

                                        $handle->file_max_size = '10000000000';


                                        // then we check if the file has been uploaded properly
                                        // in its *temporary* location in the server (often, it is /tmp)
                                        if ($handle->uploaded) {

                                            // now, we start the upload 'process'. That is, to copy the uploaded file
                                            // from its temporary location to the wanted location
                                            // It could be something like $handle->Process('/home/www/my_uploads/');
                                            $handle->allowed = array('image/*');
                                            $handle->file_new_name_body = $_SESSION['ID'];
                                            $handle->Process($dir_dest_orig);


                                            // we check if everything went OK - upload original file
                                            if ($handle->processed) {
                                                // everything was fine !

                                                // resize and upload thumbnail
                                                // we now process the image a second time, with thumbnail image
                                                $handle->image_resize            = true;
                                                $handle->image_ratio             = true;
                                                $handle->image_x                 = 130;
                                                $handle->image_y                 = 100;

                                                $handle->allowed = array('image/*');
                                                $handle->file_new_name_body = $_SESSION['ID'];
                                                $handle->Process($dir_dest_thumb);

                                                // we check if everything went OK
                                                if ($handle->processed) {
                                                    // everything was fine !
                                                    echo '<fieldset>';
                                                    echo '  <legend><font size="1" color="#000000" face="Arial">Thumbnail Image</font></legend>';
                                                    echo '  <img src="'.$dir_pics_thumb.'/' . $handle->file_dst_name . '" />';
                                                    echo '</fieldset>';

                                                    // Update database
                                                    // Get file extension to update table
                                                    $file = explode(".", $_FILES['upload']['name']);

                                                    $add_to_gallery = (isset($_POST['addtogallery']) ? $_POST['addtogallery'] : 0);

                                                    $db = new DBQuery();

                                                    $updateProductImgFormat = "UPDATE Products SET format = '".strtolower($file[1])."', add_to_gallery = '".$add_to_gallery."'
                                                                               WHERE ID = '".$_SESSION['ID']."'";
                                                    $db->executeNonQuery($updateProductImgFormat, $connectionParameters);
                                                } else {
                                                    // one error occured
                                                    echo '<fieldset>';
                                                    echo '  <legend>file not uploaded to the wanted location</legend>';
                                                    echo '  Error: ' . $handle->error . '';
                                                    echo '</fieldset>';
                                                }

                                            } else {
                                                // one error occured
                                                echo '<fieldset>';
                                                echo '  <legend>file not uploaded to the wanted location</legend>';
                                                echo '  Error: ' . $handle->error . '';
                                                echo '</fieldset>';
                                            }



                                            // we delete the temporary files
                                            $handle-> Clean();

                                        } else {
                                            // if we're here, the upload file failed for some reasons
                                            // i.e. the server didn't receive the file
                                            echo '<fieldset>';
                                            echo '  <legend>file not uploaded on the server</legend>';
                                            echo '  Error: ' . $handle->error . '';
                                            echo '</fieldset>';
                                        }
                                }
                                ?></td>
			</tr>
			</table>
					<p style="margin-left: 10px; margin-right: 10px">
					</div>
					</td>
				</tr>
			</table>
		</div>
	</td>
      <td width="24" background="images/cen_rig.gif">
		<img src="images/cen_rig.gif" width="24" height="11"></td>
    </tr>
    <tr>
      <td width="16" height="16">
		<img src="images/bot_lef.gif" width="16" height="16"></td>
      <td height="16" background="images/bot_mid.gif">
		<img src="images/bot_mid.gif" width="16" height="16"></td>
      <td width="24" height="16">
		<img src="images/bot_rig.gif" width="24" height="16"></td>
     </tr>
</table>
</div>
</form>