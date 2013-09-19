<form name="form" enctype="multipart/form-data" method="post" action="website.php?act=action&mod=saveproductmainimage">
    <input type="hidden" name="productID" value="<?php echo $_GET['id'];?>" />  
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
											replace main product image </span></font></td>
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
			<font face="Arial" style="font-size: 8pt" color="#999999">picture to upload</font>
	<span style="font-size: 8pt">
	<font face="Arial" color="#999999">
	<input type="file" name="upload" size="30" style="font-family: Arial; font-size: 9pt" ></font></span></td>
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
                                            $handle->file_new_name_body = $_POST['productID'];
                                            $handle->file_overwrite = true;
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
                                                $handle->file_new_name_body = $_POST['productID'];
                                                $handle->file_overwrite = true;
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

                                                   $db = new DBQuery();

                                                    $updateProductImgFormat = "UPDATE Products SET format = '".strtolower($file[1])."'
                                                                               WHERE ID = '".$_POST['productID']."'";
                                                    $db->executeNonQuery($updateProductImgFormat, $connectionParameters);
                                                    
                                                   // header('location:website.php?act=action&mod=listproduct');
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