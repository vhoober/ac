<form method="POST" action="website.php?act=action&mod=updatesupplier" name="form1">
    <div align="left">
        <fieldset><legend>Update existing Supplier</legend>
            <table border="0" width="100%" cellspacing="2">
                <?php
                $db = new DBQuery();

                $querySupplier = "SELECT * FROM supplier WHERE supplierId = '" . trim($_GET['id']) . "'";
                $resultSupplier = $db->executeQuery($querySupplier, $connectionParameters);
                ?>
                <tr>
                    <td>
                        <table border="0">
                            <tr>
                                <td>Name</td>
                                <td> : <input type="hidden" name="supplierId" value="<?php echo $_GET['id']; ?>"/><input value="<?php echo stripslashes($resultSupplier[0]['name']) ?>" type="text" name="name" tabindex="3">                                   
                                </td>
                            </tr>	
                            <tr>
                                <td>Address</td>
                                <td> : <textarea rows="2" name="address" cols="20" tabindex="5"><?php echo stripslashes($resultSupplier[0]['address1']) ?></textarea></td>	
                            </tr>
                            <td>Country</td>
                            <td> : <input value="<?php echo stripslashes($resultSupplier[0]['country']) ?>" type="text" name="country" tabindex="7"></td>
                            <tr>
                                <td valign="top">Phone No</td>
                                <td> : <input value="<?php echo $resultSupplier[0]['phoneNo'] ?>" type="text" name="phoneno" tabindex="9"></td>
                            </tr>
                            <tr>
                                <td>Mobile No</td>
                                <td> : <input value="<?php echo $resultSupplier[0]['mobileNo'] ?>" type="text" name="mobileno" tabindex="11"></td>		
                            </tr>	
                            <tr>
                                <td align="right" colspan="2">
                                    <input type="submit" value="Update" name="update" tabindex="12" />&nbsp;
                                    <input type="reset" value="Reset" tabindex="13" />&nbsp;
                                    <input type="button" name="Close" value="Cancel" onclick="history.go(-1);" tabindex="14" />
                                </td>                                                                                                       
                            </tr>		
                        </table>	
                    </td>						
                    <td valign="top">
                        <table border="0">
                            <tr>
                                <td>Email Address</td>
                                <td> : <input value="<?php echo stripslashes($resultSupplier[0]['emailAddress']) ?>" type="text" name="emailadd" tabindex="2"></td>	
                            </tr>                                                                                                        
                            <tr>
                                <td>Fax No</td>
                                <td> : <input value="<?php echo stripslashes($resultSupplier[0]['faxNo']) ?>" type="text" name="fax" tabindex="4"></td>	
                            </tr>
                            <tr>
                                <td>Supplier Type</td>
                                <td> : <select name="suppliertype" tabindex="6">
                                        <option value="000" selected="selected">Please select Supplier</option>
                                        <?php
                                        $db = new DBQuery();

                                        $querySupplierType = "SELECT supplierTypeId, type FROM supplier_type";
                                        $resultSupplierType = $db->executeQuery($querySupplierType, $connectionParameters);

                                        for ($x = 0; $x < count($resultSupplierType); $x++) {
                                            if ($resultSupplier[0]['supplierTypeId'] == $resultSupplierType[$x]['supplierTypeId']) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            echo "<option value='" . $resultSupplierType[$x]['supplierTypeId'] . "' " . $selected . ">" . $resultSupplierType[$x]['type'] . "</option>";
                                        }
                                        ?>
                                    </select></td>	
                            </tr>    
                            <tr>
                                <td>VAT No</td>
                                <td> : <input value="<?php echo $resultSupplier[0]['vatNo'] ?>" type="text" name="VATNo" tabindex="8"></td>	
                            </tr>
                            <tr>

                            </tr>
                            <tr>

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
                                         var frmvalidator = new Validator("form1");
                                        frmvalidator.addValidation("name", "req", "Please enter the name");
                                        frmvalidator.addValidation("emailadd", "req", "Please enter the Email Address");
                                        frmvalidator.addValidation("address", "req", "Please enter the Address");
                                        frmvalidator.addValidation("country", "req", "Please enter the Country");
                                        frmvalidator.addValidation("suppliertype", "req", "Please enter the Supplier Type");
                                        frmvalidator.addValidation("phoneno", "req", "Please enter the Phone No");
</script>