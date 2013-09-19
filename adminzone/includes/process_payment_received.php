<script type="text/javascript">
    function formReset()
    {
        document.getElementById("form2").reset();
    }
</script>
<form method="POST" action="website.php?act=action&mod=confirmpaymentreceived" name="form2" id="form2">
    <div align="center">
        <fieldset><legend>Process Payment Received</legend>
            <table border="0" width="440" id="table40" height="101" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="430" valign="top" height="20">
                        <p style="margin: 5px 20px">
                        <p style="margin: 0 20px">
                            <span style="font-weight: 700; text-transform: uppercase">
                            </span></p>
                    </td>
                </tr>
                <?php
                $db = new DBQuery();

                $queryDebtors = "SELECT debtors.*, invoice.InvoiceID FROM debtors, invoice WHERE debtors.ID = '" . trim($_GET['id']) . "' AND invoice.ID=debtors.InvoiceID";
                $resultDebtors = $db->executeQuery($queryDebtors, $connectionParameters);
                ?>
                <tr>
                    <td height="47">
                        <table border="0" id="table41" cellpadding="0" width="300">
                            <tr>
                                <td align="right" valign="top">
                                    <font face="Arial" style="font-size: 9pt">
                                    Invoice ID:</font></p>
                                </td>
                                <td width="50" valign="top">
                                    <input type="hidden" name="InvoiceID" value="<?php echo $_GET['id']; ?>" />
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo $resultDebtors[0]['InvoiceID'] ?>" type="text" name="invoiceId" size="10" tabindex="3" disabled="disabled"></td>

                            </tr>

                            <tr>
                                <td align="right" valign="top">
                                    <p>
                                        <font face="Arial" style="font-size: 9pt">
                                        Amount Paid:</font></p>
                                </td>
                                <td valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo $resultDebtors[0]['Amount'] ?>" type="text" name="amount" size="10" tabindex="3" disabled="disabled"></td>
                                <td align="right" valign="top">
                                    <p>
                                        <font face="Arial" style="font-size: 9pt">
                                        New amount paid:</font></p>
                                </td>
                                <td valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input type="text" name="newamount" size="10" tabindex="3"></td>	
                            </tr>
                            <tr>
                                <td align="right" valign="top">
                                    <p>
                                        <font face="Arial" style="font-size: 9pt">
                                        Status:</font></p>
                                </td>
                                <td valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input value="<?php echo $resultDebtors[0]['Status'] ?>" type="text" name="status" size="20" tabindex="3" disabled="disabled"></td>
                                <td align="right" valign="top">
                                    <p>
                                        <font face="Arial" style="font-size: 9pt">
                                        New Status:</font></p>
                                </td>
                                <td valign="top">
                                    <!--webbot bot="Validation" b-value-required="TRUE" --><input type="text" name="newstatus" size="10" tabindex="3"></td>	
                            </tr>    

                            <tr><td colspan="2" height="10">&nbsp;</td></tr>
                            <tr>
                                <td height="35" >
                                    <input type="submit" value="Save" name="save" style="float: right" tabindex="9"></td>
                                <td height="35" colspan="2"><input type="reset" value="Clear" onclick="formReset()" style="float: left" tabindex="9"/></td>

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