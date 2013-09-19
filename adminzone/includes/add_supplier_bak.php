<form method="POST" action="website.php?act=action&mod=saveuser" name="form1">
	<div align="left">
             <fieldset><legend>Add Supplier</legend><table  border="0" cellpadding="0" cellspacing="0" id="table39">
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
							<td style="border-style: none; border-width: medium; " bordercolor="#666666" width="161" align="center" height="47">
											<table border="0" id="table41" cellpadding="0" width="324">
												<tr>
													<td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Name:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><input type="text" name="name" size="20" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>
                                                                                                        <td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Email Address:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><input type="text" name="emailadd" size="20" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>
													</tr>
												
                                                                                                <tr>
													<td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Address:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><input type="text" name="address" size="20" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>
												<td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Fax No:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><input type="text" name="fax" size="20" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>	
                                                                                                </tr>
                                                                                                <tr>
													<td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Address 2:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><input type="text" name="address2" size="20" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>
												<td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Supplier Type:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><select style="width:300px;" name="productID">
                                        	    			<option value="000" selected="selected">Please select Supplier</option>
                                        	    			<?php
                                        	    			$db = new DBQuery();
                                        	    			
                                        	    			$querySupplier = "SELECT supplierTypeId, type FROM supplier_type";
                                        	    			$resultSupplier = $db->executeQuery($querySupplier, $connectionParameters);
                                        	    			
                                        	    			for($x=0; $x<count($resultSupplier); $x++)
                                        	    			{
                                        	    				echo "<option value='".$resultSupplier[$x]['supplierTypeId']."'>".$resultSupplier[$x]['type']."</option>";
                                        	    			}
                                        	    			?>
                                        	    		</select></td>	
                                                                                                </tr>
                                                                                                <tr>
												                                            <tr>
													<td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Phone No:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><input type="text" name="phoneno" size="20" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>
                                                                                                        <td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													VAT No:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><input type="text" name="phoneno" size="20" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>
												</td>	
                                                                                                </tr>
																								<tr>
												                                            <tr>
													<td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Mobile No:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><input type="text" name="mobileno" size="20" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>
												</td>	
                                                                                                </tr>
												<tr>
													<td height="35" colspan="2">
													<input type="submit" value="Save" name="Save" style="float: right" tabindex="9"></td>
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
                                                                        </fieldset>
								</div>
	<p>&nbsp;</p>
</form>
<script type="text/javascript">
 var frmvalidator  = new Validator("form1");
 frmvalidator.addValidation("name","req","Please enter the name");
 frmvalidator.addValidation("username","req","Please enter the Username");
 frmvalidator.addValidation("address","req","Please enter the Address");
 frmvalidator.addValidation("password","req","Please enter the Password");
 frmvalidator.addValidation("title","req","Please enter the Title");
 frmvalidator.addValidation("userlevel","req","Please enter the User Level");
 frmvalidator.addValidation("phoneno","req","Please enter the Phone No");
 frmvalidator.addValidation("mobileno","req","Please enter the Mobile No");
 frmvalidator.addValidation("displayedname","req","Please enter the Displayed Name");
</script>