<form method="POST" action="website.php?act=action&mod=updateuser" name="form1">
    <div align="left">
        <fieldset><legend>Update existing User</legend>
            <table border="0" cellspacing="0" cellpadding="0">
                <?php
                $db = new DBQuery();

                $queryUser = "SELECT * FROM users WHERE ID = '" . trim($_GET['id']) . "'";
                $resultUser = $db->executeQuery($queryUser, $connectionParameters);
                ?>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" >
                            <tr>
                                <td align="right" valign="top">
                                    Name:</p>
                                </td>
                                <td valign="top">
                                    <input type="hidden" name="ID" value="<?php echo $_GET['id']; ?>" />
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo stripslashes($resultUser[0]['Name']) ?>" type="text" name="name" tabindex="3"></td>
                                <td align="right" valign="top">
                                    Username:
                                </td>
                                <td valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo stripslashes($resultUser[0]['Username']) ?>" type="text" name="username" tabindex="3"></td>
                            </tr>

                            <tr>
                                <td align="right" valign="top">
                                    Address:
                                </td>
                                <td valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo stripslashes($resultUser[0]['Address']) ?>" type="text" name="address" tabindex="3"></td>

                            </tr>
                            <tr>
                                <td align="right" valign="top">
                                    Title:
                                </td>
                                <td  valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><select id="txtTitle" name="title">
                                        <option value="">Please select Title</option>
                                        <?php 
                                        if($resultUser[0]['Title'] == "Management")
                                        {$mgt="selected";$admin="";$sales="";}
                                        elseif($resultUser[0]['Title'] == "Administrator")
                                        {$mgt="";$admin="selected";$sales="";}
                                        elseif($resultUser[0]['Title'] == "Sales Person")
                                        {$mgt="";$admin="";$sales="selected";}
                                        else
                                        {$mgt="";$admin="";$sales="";}                                        
                                        ?>
                                        <option value="Management" <?php echo $mgt;?>>Management</option>
                                        <option value="Administrator" <?php echo $admin;?>>Administrator</option>
                                        <option value="Sales Person" <?php echo $sales;?>>Sales Person</option>
                                    </select> </td>

                                <td align="right" valign="top">
                                    User Level:
                                </td>
                                <td valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><select name="userlevel">
                                        <option value="000" selected="selected">Please select User Level</option>
                                        <?php
                                        $db = new DBQuery();

                                        $queryUserLevel = "SELECT userLevelId, name FROM user_level";
                                        $resultUserLevel = $db->executeQuery($queryUserLevel, $connectionParameters);

                                        for ($x = 0; $x < count($resultUserLevel); $x++) {
                                            if ($resultUser[0]['UserLevel'] == $resultUserLevel[$x]['userLevelId']) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            echo "<option value='" . $resultUserLevel[$x]['userLevelId'] . "' " . $selected . ">" . $resultUserLevel[$x]['name'] . "</option>";
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
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo $resultUser[0]['PhoneNo'] ?>" type="text" name="phoneno" tabindex="3"></td>
                                <td width="114" align="right" valign="top">
                                    Display Name:
                                </td>
                                <td valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo $resultUser[0]['displayedname'] ?>" type="text" name="displayedname" tabindex="3"></td>	
                                </td>	
                            </tr>
                            <tr>
                            <tr>
                                <td align="right" valign="top">
                                    Mobile No:
                                </td>
                                <td valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo $resultUser[0]['MobileNo'] ?>" type="text" name="mobileno" tabindex="3"></td>
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
            </table>                        </fieldset>
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