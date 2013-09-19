<script type="text/javascript">
function formReset()
{
document.getElementById("form2").reset();
}
</script>
<form method="POST" action="website.php?act=action&mod=updateproduct" name="form2" id="form2">
	<div align="center">
            <fieldset><legend>Update Product</legend>
	<table border="0" width="440" id="table40" height="101" cellspacing="0" cellpadding="0">
						<tr>
							<td style="border-style: none; border-width: medium; " bordercolor="#666666" width="430" valign="top" height="20">
							<p style="margin: 5px 20px">
							<p style="margin: 0 20px">
							<span style="font-weight: 700; text-transform: uppercase">
							<font face="Arial" style="font-size: 9pt" color="#333333">
							Update product<br>
&nbsp;</font></span></p>
							</td>
						</tr>
						<?php
						$db = new DBQuery();
						
						$queryProduct  = "SELECT * FROM products WHERE ID = '".trim($_GET['id'])."'";
						$resultProduct = $db->executeQuery($queryProduct, $connectionParameters);
						?>
						<tr>
							<td style="border-style: none; border-width: medium; " bordercolor="#666666" width="100" align="center" height="47">
											<table border="0" id="table41" cellpadding="0" width="300">
												<tr>
													<td width="100" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Supplier:</font></p>
													</td>
													<td width="50" valign="top">
													<input type="hidden" name="productID" value="<?php echo $_GET['id'];?>" />
													<!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo $resultProduct[0]['Supplier']?>" type="text" name="supplier" size="10" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>
												<td width="100" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Unit Price:</font></p>
													</td>
													<td width="150" valign="top">
													<input value="<?php echo $resultProduct[0]['UnitCostPrice']?>" type="text" name="unitcostprice" size="10" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>	
                                                                                                </tr>
                                                                                                        
												<tr>
													<td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Product Code:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo $resultProduct[0]['ProductCode']?>" type="text" name="productcode" size="10" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>
												<td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Unit Selling Price:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo $resultProduct[0]['UnitSellingPrice']?>" type="text" name="unitsellingprice" size="10" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>	
                                                                                                </tr>
                                                                                                    <tr>
													<td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Product Name:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo $resultProduct[0]['ProductName']?>" type="text" name="productname" size="20" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>
												<td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Unit Wholesale Price:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo $resultProduct[0]['UnitWholesalePrice']?>" type="text" name="unitwholesaleprice" size="10" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>	
                                                                                                    </tr>    
                                                                                                <tr>
													<td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Description:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><textarea rows="2" name="description" cols="20" style="font-family: Arial; font-size: 8pt; width:400; height:100" tabindex="4"><?php echo $resultProduct[0]['Description']?></textarea></td>
												<td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Quantity:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo $resultProduct[0]['Quantity']?>" type="text" name="quantity" size="10" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>	
                                                                                                </tr>
                                                                                                <tr>
													<td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Product Size:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo $resultProduct[0]['ProductSize']?>" type="text" name="productsize" size="10" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>
												<td width="114" align="right" valign="top">
													<p style="margin-top:0; margin-bottom:0; margin-right:10px">
													<font face="Arial" style="font-size: 9pt">
													Re-Order Level:</font></p>
													</td>
													<td width="204" valign="top">
													<!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo $resultProduct[0]['ReorderLevel']?>" type="text" name="reorderlevel" size="10" style="font-family: Arial; font-size: 8pt; width:400; height:20" tabindex="3"></td>	
                                                                                                </tr>
												<tr>
                                                                                                    <td colspan="2">
													<p style="margin-top: 0; margin-bottom: 0" align="right">
													<font size="1" face="Arial"><?php if($resultProduct[0]['add_to_gallery'] == 1){$checked ="checked";}else{$checked = "";}?>
                                                                                                        Display Photo in Gallery<input type="checkbox" name="addtogallery" tabindex="7" value="1" <?php echo $checked;?>>
													</font></p>
													</td>
                                                                                                        <td colspan="2">
													<p style="margin-top: 0; margin-bottom: 0" align="right">
													<font size="1" face="Arial"><?php if($resultProduct[0]['BestSeller'] == 1){$checked ="checked";}else{$checked = "";}?>
                                                                                                        Best Seller<input type="checkbox" name="bestseller" tabindex="7" value="1" <?php echo $checked;?>>
													</font></p>
													</td>
												</tr>
                                                                                                <tr><td colspan="2" height="10">&nbsp;</td></tr>
												<tr>
													<td height="35" colspan="2">
													<input type="submit" value="Update" name="update" style="float: right" tabindex="9"></td>
                                                                                                        <td height="35" colspan="2"><input type="reset" value="Clear" onclick="formReset()" style="float: left" tabindex="9"/></td>
                                                                                                        <td height="35" colspan="2"><input type="button" name="Close" value="Close" onclick="history.go(-1);" tabindex="16" /></td>
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
		                                                        </fieldset>
								</div>
	<p>&nbsp;</p>
</form>