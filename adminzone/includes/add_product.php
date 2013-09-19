<form method="POST" action="website.php?act=action&mod=saveproduct" name="form1">
	<div align="left">
            <fieldset><legend>Add Product</legend>
	<table border="0" width="100%" cellspacing="2">					
						<tr>
							<td>
								<table border="0">
									<tr>
										<td>Supplier</td>
										<td> : 
											<?php 
												$db = new DBQuery();
												
												$querySupplier = "SELECT supplierId, name FROM supplier ORDER BY name ASC";
												$resultSupplier = $db->executeQuery($querySupplier, $connectionParameters);
												
												if(count($resultSupplier) > 0)
												{?>
													<select name="supplier" tabindex="1">
														<option value="">Please select supplier</option>
													
												<?php 
													for($s=0; $s<count($resultSupplier); $s++)
													{?>
														<option value="<?php echo $resultSupplier[$s]['supplierId'];?>"><?php echo strtoupper($resultSupplier[$s]['name']);?></option>
													<?php 	
													}
													?>
													</select>
												<?php 													
												}
												else 
												{echo "No supplier in database!";}
											?>
										</td>
									</tr>	
									<tr>
										<td>Product Code</td>
										<td> : <input type="text" name="productcode" tabindex="3"></td>	
									</tr>
										<td>Product Name</td>
										<td> : <input type="text" name="productname" tabindex="5"></td>
									<tr>
										<td valign="top">Description</td>
										<td> : <textarea rows="2" name="description" cols="20" tabindex="7"></textarea></td>
									</tr>
									<tr>
										<td>Product Size</td>
										<td> : <input type="text" name="productsize" tabindex="9"></td>		
									</tr>	
									<tr>
										<td align="right" colspan="2">
											<input type="submit" value="Save" name="save" tabindex="12" />&nbsp;
											<input type="reset" value="Reset" tabindex="13" />&nbsp;
											<input type="button" name="Close" value="Cancel" onclick="history.go(-1);" tabindex="14" />
										</td>                                                                                                       
									</tr>		
									</table>															
							</td>						
							<td valign="top">
								<table border="0">
									<tr>
										<td>Unit Price:</td>
										<td> : <input type="text" name="unitcostprice" tabindex="2"></td>	
                                    </tr>                                                                                                        
									<tr>
										<td>Unit Selling Price</td>
										<td> : <input type="text" name="unitsellingprice" tabindex="4"></td>	
                                    </tr>
                                    <tr>
										<td>Unit Wholesale Price</td>
										<td> : <input type="text" name="unitwholesaleprice" tabindex="6"></td>	
                                    </tr>    
                                    <tr>
										<td>Quantity</td>
										<td> : <input type="text" name="quantity" tabindex="8"></td>	
                                   </tr>
                                    <tr>
										<td>Re-Order Level</td>
										<td> : <input type="text" name="reorderlevel" tabindex="10"></td>	
                                    </tr>
									<tr>
                                        <td align="right" colspan="2">Best Seller <input type="checkbox" name="bestseller" tabindex="11" value="1"></td>
									</tr>
							</table>
						</td>
					</tr>
				</table>			
		 </fieldset>
	</div>
	<p>&nbsp;</p>
</form>
<script type="text/javascript">
 var frmvalidator  = new Validator("form1");
 frmvalidator.addValidation("product","req","Please enter the Product Title");
 frmvalidator.addValidation("description","req","Please enter the Product Description");
</script>