<?php
require_once '../configuration/config.php';
require_once '../../includes/class/DBQuery.php';

$db = new DBQuery();

$query = "SELECT * FROM customer WHERE CustomerID = '".trim($_GET['customerID'])."'";	
$result = $db->executeQuery($query, $connectionParameters);
?>
<hr />
<table  border="0" cellpadding="15" cellspacing="0" width="100%">
    <tr>
        <td>
            <table  border="0">
                <tr>
                    <td>TITLE</td>
                    <td> : 
                        <?php
                        if($result[0]['ContactTitle'] != ""){
                            if($result[0]['ContactTitle'] == "Mr")
                                {$mr="selected";$mrs="";$ms="";$dr="";}
                            else if($result[0]['ContactTitle'] == "Mrs")
                                {$mr="";$mrs="selected";$ms="";$dr="";}  
                            else if($result[0]['ContactTitle'] == "Ms")
                                {$mr="";$mrs="";$ms="selected";$dr="";}
                            else
                                {$mr="";$mrs="";$ms="";$dr="selected";}    
                        }
                        ?>
<select id="txtTitle" name="txtTitle" class="validate[required]">
    <option value>Please select Title</option>
    <option value="Mr" <?php echo $mr?>>Mr</option>
    <option value="Mrs" <?php echo $mrs?>>Mrs</option>
    <option value="Ms" <?php echo $ms?>>Ms</option>
    <option value="Dr" <?php echo $dr?>>Dr</option>
</select>*                        
                        <input type="hidden" name="txtCustomerID" id="txtCustomerID" value="<?php echo trim($_GET['customerID'])?>" /></td>
                </tr>
                <tr>
                    <td>ADDRESS</td>
                    <td> : <input type="text" size="50" name="txtAddress" id="txtAddress" class="validate[required]" value="<?php echo $result[0]['Address']?>" />*</td>
                </tr>
                <tr>
                    <td>CITY</td>
                    <td> : <input type="text" size="50" name="txtCity" id="txtCity" class="validate[required,custom[onlyLetterSp]]" value="<?php echo $result[0]['City']?>" />*</td>
                </tr>
                <tr>
                    <td>PHONE NO.</td>
                    <td> : <input type="text" name="txtPhoneNo" id="txtPhoneNo" class="validate[required,custom[integer]]" value="<?php echo $result[0]['PhoneNo']?>" />*</td>
                </tr>
                <tr>
                    <td>MOBILE NO.</td>
                    <td> : <input type="text" name="txtMobileNo" id="txtMobileNo"  class="validate[optional,custom[integer]]" value="<?php echo $result[0]['MobileNo']?>" /></td>
                </tr>                
            </table>
        </td>
        <td valign="top">
            <table  border="0">
                <tr>
                    <td>FAX NO.</td>
                    <td> : <input type="text" name="txtFaxNo" id="txtFaxNo" class="validate[optional,custom[integer]]" value="<?php echo $result[0]['FaxNo']?>" /></td>
                </tr>
                <tr>
                    <td>EMAIL</td>
                    <td> : <input type="text" size="25" name="txtEmail" id="txtEmail" class="validate[optional,custom[email]]" value="<?php echo $result[0]['EmailAddress']?>" /></td>
                </tr>
                <tr>
                    <td>CONTACT NAME</td>
                    <td> : <input type="text" size="50" name="txtContactName" id="txtContactName" class="validate[optional,custom[onlyLetterSp]]" value="<?php echo $result[0]['ContactName']?>" /></td>
                </tr>
                <tr>
                    <td>VAT NO.</td>
                    <td> : <input type="text" name="txtVatNo" id="txtVatNo" class="validate[optional,custom[integer]]" value="<?php echo $result[0]['VATNo']?>" /></td>
                </tr>             
            </table>            
        </td>
    </tr>
</table>
    