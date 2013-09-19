<form method="POST" action="website.php?act=action&mod=saveuser" name="form1">
    <div align="left">
        <fieldset><legend>Create New User</legend>
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table border="0" cellpadding="0" >
                            <tr>
                                <td align="right" valign="top">
                                    Name:
                                </td>
                                <td valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input type="text" name="name" tabindex="3"></td>
                                <td align="right" valign="top">
                                    Username:                           </td>
                                <td valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input type="text" name="username" tabindex="3"></td>
                            </tr>

                            <tr>
                                <td align="right" valign="top">
                                        Address:
                                </td>
                                <td valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input type="text" name="address" tabindex="3"></td>
                                <td  align="right" valign="top">
                                    Password:</p>
                                </td>
                                <td valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input type="password" name="password" tabindex="3"></td>	
                            </tr>
                            <tr>
                                <td align="right" valign="top">
                                        Title:
                                </td>
                                <td valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><select id="txtTitle" name="title">
                                        <option value="">Please select Title</option>
                                        <option value="Management">Management</option>
                                        <option value="Administrator">Administrator</option>
                                        <option value="Sales Person">Sales Person</option>
                                        </select> </td>
                                <td align="right" valign="top">
                                        User Level:</td>
                                <td valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><select  name="userlevel">
                                        <option value="000" selected="selected">Please select User Level</option>
                                        <?php
                                        $db = new DBQuery();
        $queryUser = "SELECT userLevelId, name FROM user_level";
                                        $resultUser = $db->executeQuery($queryUser, $connectionParameters);

                                        for ($x = 0; $x < count($resultUser); $x++) {
                                            echo "<option value='" . $resultUser[$x]['userLevelId'] . "'>" . $resultUser[$x]['name'] . "</option>";
                                        }
                                        ?>
                                    </select></td>	
                            </tr>
                            <tr>
                            <tr>
                                <td align="right" valign="top">
                                        Phone No:
                                </td>
                                <td valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input type="text" name="phoneno"  tabindex="3"></td>
                                <td align="right" valign="top">
                                        Display Name:
                                </td>
                                <td width="204" valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input type="text" name="displayname" tabindex="3"></td>
                                </td>	
                            </tr>
                            <tr>
                            <tr>
                                <td align="right" valign="top">
                                        Mobile No:
                                </td>
                                <td valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input type="text" name="mobileno"  tabindex="3"></td>
                                </td>	
                            </tr>
                            <tr>
                                <td height="35">
                                    <input type="submit" value="Save" name="Save" style="float: right" tabindex="9"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
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
    frmvalidator.addValidation("username", "req", "Please enter the Username");
    frmvalidator.addValidation("address", "req", "Please enter the Address");
    frmvalidator.addValidation("password", "req", "Please enter the Password");
    frmvalidator.addValidation("title", "req", "Please enter the Title");
    frmvalidator.addValidation("userlevel", "req", "Please enter the User Level");
    frmvalidator.addValidation("phoneno", "req", "Please enter the Phone No");
    frmvalidator.addValidation("mobileno", "req", "Please enter the Mobile No");
    frmvalidator.addValidation("displayedname", "req", "Please enter the Displayed Name");
</script>