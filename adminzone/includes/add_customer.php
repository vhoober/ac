<hr />
<table  border="0" cellpadding="15" cellspacing="0" width="100%">
    <tr>
        <td>
            <table  border="0">
                <tr>
                    <td>TITLE</td>
                    <td> : 
<select id="txtTitle" name="txtTitle" class="validate[required]">
    <option value>Please select Title</option>
    <option value="Mr">Mr</option>
    <option value="Mrs">Mrs</option>
    <option value="Ms">Ms</option>
    <option value="Dr">Dr</option>
</select>*</td>
                </tr>
                <tr>
                    <td>NAME</td>
                    <td> : <input type="text" size="50" name="txtName" id="txtName" class="validate[required,custom[onlyLetterSp]]" />*</td>
                </tr>                
                <tr>
                    <td>ADDRESS</td>
                    <td> : <input type="text" size="50" name="txtAddress" id="txtAddress" class="validate[required]" />*</td>
                </tr>
                <tr>
                    <td>CITY</td>
                    <td> : <input type="text" size="50" name="txtCity" id="txtCity" class="validate[required,custom[onlyLetterSp]]" />*</td>
                </tr>
                <tr>
                    <td>PHONE NO.</td>
                    <td> : <input type="text" name="txtPhoneNo" id="txtPhoneNo" class="validate[required,custom[integer]]" />*</td>
                </tr>              
            </table>
        </td>
        <td valign="top">
            <table  border="0">
                <tr>
                    <td>MOBILE NO.</td>
                    <td> : <input type="text" name="txtMobileNo" id="txtMobileNo" class="validate[optional,custom[integer]]" /></td>
                </tr>                
                <tr>
                    <td>FAX NO.</td>
                    <td> : <input type="text" name="txtFaxNo" id="txtFaxNo" class="validate[optional,custom[integer]]" /></td>
                </tr>
                <tr>
                    <td>EMAIL</td>
                    <td> : <input type="text" size="25" name="txtEmail" id="txtEmail" class="validate[optional,custom[email]]" /></td>
                </tr>
                <tr>
                    <td>CONTACT NAME</td>
                    <td> : <input type="text" size="50" name="txtContactName" id="txtContactName" class="validate[optional,custom[onlyLetterSp]]" /></td>
                </tr>
                <tr>
                    <td>VAT NO.</td>
                    <td> : <input type="text" name="txtVatNo" id="txtVatNo" class="validate[optional,custom[integer]]" /></td>
                </tr>                        
            </table>            
        </td>
    </tr>
</table>
