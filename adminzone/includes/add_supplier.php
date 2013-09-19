<form method="POST" action="website.php?act=action&mod=savesupplier" name="form1">
    <div align="left">
        <fieldset><legend>Add Supplier</legend>
            <table border="0" width="100%" cellspacing="2">					
                <tr>
                    <td>
                        <table border="0">
                            <tr>
                                <td>Name</td>
                                <td> : <input type="text" name="name" tabindex="3">                                   
                                </td>
                            </tr>	
                            <tr>
                                <td>Address</td>
                                <td> : <textarea rows="2" name="address" cols="20" tabindex="5"></textarea></td>	
                            </tr>
                            <td>Country</td>
                            <td> : <input type="text" name="country" tabindex="7"></td>
                            <tr>
                                <td valign="top">Phone No</td>
                                <td> : <input type="text" name="phoneno" tabindex="9"></td>
                            </tr>
                            <tr>
                                <td>Mobile No</td>
                                <td> : <input type="text" name="mobileno" tabindex="11"></td>		
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
                                <td>Email Address</td>
                                <td> : <input type="text" name="emailadd" tabindex="2"></td>	
                            </tr>                                                                                                        
                            <tr>
                                <td>Fax No</td>
                                <td> : <input type="text" name="fax" tabindex="4"></td>	
                            </tr>
                            <tr>
                                <td>Supplier Type</td>
                                <td> : <select name="suppliertype" tabindex="6">
                                        <option value="000" selected="selected">Please select Supplier</option>
                                        <?php
                                        $db = new DBQuery();

                                        $querySupplier = "SELECT supplierTypeId, type FROM supplier_type";
                                        $resultSupplier = $db->executeQuery($querySupplier, $connectionParameters);

                                        for ($x = 0; $x < count($resultSupplier); $x++) {
                                            echo "<option value='" . $resultSupplier[$x]['supplierTypeId'] . "'>" . $resultSupplier[$x]['type'] . "</option>";
                                        }
                                        ?>
                                    </select></td>	
                            </tr>    
                            <tr>
                                <td>VAT No</td>
                                <td> : <input type="text" name="VATNo" tabindex="8"></td>	
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