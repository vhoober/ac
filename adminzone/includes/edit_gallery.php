<form method="POST" action="website.php?act=action&mod=updategallery" name="form2">
	<div align="center">
									&nbsp;<p>&nbsp;</p>

                                                                        <table  border="0" cellpadding="0" cellspacing="0" id="table39">
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

	<table border="0" width="440" id="table40" height="101" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border-style: none; border-width: medium; " bordercolor="#666666" width="430" valign="top" height="20">
							<p style="margin: 5px 20px">
							<p style="margin: 0 20px">
							<span style="font-weight: 700; text-transform: uppercase">
							<font face="Arial" style="font-size: 9pt" color="#333333">
							Update Gallery<br>
&nbsp;</font></span></p>
							</td>
						</tr>
						<?php
						$db = new DBQuery();

						$queryGallery  = "SELECT * FROM gallery WHERE gallery_id = '".trim($_GET['id'])."'";
						$resultGallery = $db->executeQuery($queryGallery, $connectionParameters);
						?>
						<tr>
							<td style="border-style: none; border-width: medium; " bordercolor="#666666" width="161" align="center" height="47">
											<table border="0" id="table41" cellpadding="0" width="324">
												<tr>
													<td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Photo Name:</font></p>
													</td>
													<td width="204" valign="top">
													<input type="hidden" name="galleryID" value="<?php echo $_GET['id'];?>" />
													<!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo $resultGallery[0]['photo_name']?>" type="text" name="photoname" size="20" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>
													</tr>
												<tr>
													<td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Photo
													Description:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><textarea rows="2" name="Description" cols="20" style="font-family: Arial; font-size: 8pt; width:400; height:100" tabindex="4"><?php echo $resultGallery[0]['photo_desc']?></textarea></td>
												</tr>
                                                                                                <tr><td colspan="2" height="10">&nbsp;</td></tr>
												<tr>
													<td height="35" colspan="2">
													<input type="submit" value="Update" name="update" style="float: right" tabindex="9"></td>
												</tr>
												</table>
											</td>
						</tr>
						<tr>
							<td style="border-style: none; border-width: medium; " bordercolor="#666666" valign="top">
											<font face="Arial" size="1">please
											note that all fields are compulsory</font></td>
						</tr>
					</table>
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
	<p>&nbsp;</p>
</form>