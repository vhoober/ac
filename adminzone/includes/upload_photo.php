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
									<table border="0" width="430" id="table35" cellspacing="0" cellpadding="0" height="150" style="border-width: 0px">
										<tr>
											<td style="border-style: none; border-width: medium" bordercolor="#000000" bgcolor="#333333" height="20" width="440">
											<p style="margin:0 20px;">
											<font color="#FFFFFF" face="Arial">
											<span style="font-weight: 700; font-size: 9pt; text-transform:uppercase">
											Select Photo for - step 1 of 2 </span>
										</tr>
										<tr>
											<td width="430" valign="top">
											<p style="margin:20 0; ">
											<div align="center">
											<table border="0" width="100%" cellspacing="0" cellpadding="0">
												<tr>
													<td>
													<table border="0" cellspacing="0" cellpadding="0">
                                        	    		<tr>
                                        	    			<td align="left" valign="top"><p style="margin-top:0; margin-bottom:0; margin-right:10px">
                                        	    			<font face="Arial" style="font-size: 9pt">Product <input type="radio" onclick="toggleMeAgain('product_section')" name="image_type" value="0" />&nbsp;&nbsp;Gallery <input type="radio" name="image_type" value="1"  onclick="toggleMeAgain('gallery_section')" /></font>
                                        	    			</td>
                                        	   			</tr>
                                        	   			<tr>
                                        	    			<td width="440"><hr></td>
                                        	   			 </tr>
                                        	   		<tr id="product_section" style="display:none">
													<td><form name="form1" method="post" action="website.php?act=action&mod=saveuploadphoto">
														<table width="100%" cellspacing="0" cellpadding="0">
														<tr>                                        	    
                                        	    	<td align="left" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">Select Product : <select style="width:300px;" name="productID">
                                        	    			<option value="000" selected="selected">Please select Product</option>
                                        	    			<?php
                                        	    			$db = new DBQuery();
                                        	    			
                                        	    			$queryProduct = "SELECT ID, ProductName FROM Products";
                                        	    			$resultProduct = $db->executeQuery($queryProduct, $connectionParameters);
                                        	    			
                                        	    			for($x=0; $x<count($resultProduct); $x++)
                                        	    			{
                                        	    				echo "<option value='".$resultProduct[$x]['ID']."'>".$resultProduct[$x]['ProductName']."</option>";
                                        	    			}
                                        	    			?>
                                        	    		</select> </font></p>
                                        	    	</td>
                                        	    	</tr>
                                        	    	<tr>
                                        	    		<td><p style="margin:10px 10px; "><input type="submit" name="submit" value="Continue" title="Click on continue to proceed" /></td>
                                        	    	</tr>
                                        	    	</table>
                                        	    	</form>
                                        	    	</td>
                                        	    </tr>
                                        	    <tr id="gallery_section" style="display:none">
                                        	    	<td><form name="form2" method="post" action="website.php?act=action&mod=saveuploadphoto">
                                        	    	<table>
                                 				<tr>
													<td align="left" valign="top"><p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Photo Name:</font></p>
													</td>
													<td valign="top">
													<input type="text" name="name" size="20" style="font-family: Arial; font-size: 8pt; width:300; height:20" tabindex="3"></td>
												</tr>
												<tr>
													<td align="left" valign="top"><p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Photo
													Description:</font></p>
													</td>
													<td valign="top">
													<textarea rows="2" name="Description" cols="20" style="font-family: Arial; font-size: 8pt; width:300; height:100" tabindex="4"></textarea></td>
												</tr>       	    	
                                        	    <tr><td>&nbsp;</td>
                                        	    	<td>
                                        	    	<p style="margin: 0 10px"><input type="hidden" name="galleryimg" value="1" />
                                        	    	<input type="submit" name="submit" value="Continue" title="Click on continue to proceed" />
                                        	    	</td>
                                        	    </tr>	
                                        	    	</table>
                                        	    	</form>
<!-- validation upload image for product -->
    <script type="text/javascript">
    var frmvalidator  = new Validator("form1");
    frmvalidator.addValidation("productID","dontselect=000");
    </script>
 <!-- end validation upload image for product -->


<!-- validation upload image for gallery -->
    <script type="text/javascript">
     var frmvalidator  = new Validator("form2");
     frmvalidator.addValidation("name","req","Please enter the Photo Name");
     frmvalidator.addValidation("Description","req","Please enter the Photo Description");
    </script>
<!-- end validation upload image for gallery -->

                                                        </td>
                                        	    </tr>
                                        	   		</table>
                                        	   		</td>
                                        	   	</tr>
                                        	 </table>  	
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
