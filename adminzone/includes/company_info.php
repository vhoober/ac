<?php
if(isset($_GET['msg']) && trim($_GET['msg'] != ""))
{
	echo "<div>".$_GET['msg']."</div>";
}
?>
<div align="left" id="showBranches">
	<ul>
	<li><a href="javascript:void(0)" onclick="toggleMe('headBranch')" title="Click on the link to display details">HEAD BRANCH - PORT LOUIS</a></li>
<?php
$db = new DBQuery();

// Get all branches except head branch
$queryBranches = "SELECT * FROM branch WHERE ID > 1";
$resultBranches = $db->executeQuery($queryBranches, $connectionParameters);
for($branch=0;$branch<count($resultBranches);$branch++)
{
?>
<li><a href="javascript:void(0)" title="Click on the link to display details" onclick="toggleMe('Branch<?php echo str_replace(" ", "", $resultBranches[$branch]['BranchName'])?>')">BRANCH - <?php echo strtoupper($resultBranches[$branch]['BranchName'])?></a></li>
<?php
}
?>
	</ul>
</div>
<form method="POST" action="website.php?act=action&mod=savecompanyinfo" name="form2">
<!-- Main branch - Port Louis -->
	<div align="left" id="headBranch" style="display:none">
	<input type="hidden" name="mainbranch" value="1" />
<fieldset><legend>HEAD BRANCH - PORT LOUIS</legend>	
<?php
$queryCompInfo  = "SELECT * FROM company_info WHERE ID = '1'";
$resultCompInfo = $db->executeQuery($queryCompInfo, $connectionParameters);
?>		
<table  border="0" cellpadding="0" cellspacing="0" id="tableBranch">
    <tr>
      	<td>Company Name</td>
      	<td> : <input type="text" name="txtCompanyName" size="50" tabindex="1" value="<?php echo stripslashes($resultCompInfo[0]['CompName'])?>" />&nbsp;*</td>
     </tr>
    <tr>
      	<td>VAT Reg No</td>
      	<td> : <input type="text" name="txtVatRegNo" tabindex="2" value="<?php echo stripslashes($resultCompInfo[0]['CompVATNo'])?>" />&nbsp;*</td>
     </tr>
    <tr>
      	<td>Business Registration Number</td>
      	<td> : <input type="text" name="txtBRN" tabindex="3" value="<?php echo stripslashes($resultCompInfo[0]['CompBRN'])?>" />&nbsp;*</td>
     </tr>
    <tr>
      	<td>Address 1</td>
      	<td> : <input type="text" name="txtAddress1" size="50" tabindex="4" value="<?php echo stripslashes($resultCompInfo[0]['CompAddress1'])?>" />&nbsp;*</td>
     </tr>
    <tr>
      	<td>Address 2</td>
      	<td> : <input type="text" name="txtAddress2" size="50" tabindex="5" value="<?php echo stripslashes($resultCompInfo[0]['CompAddress2'])?>" /></td>
     </tr>
    <tr>
      	<td>Address 3</td>
      	<td> : <input type="text" name="txtAddress3" size="50" tabindex="6" value="<?php echo stripslashes($resultCompInfo[0]['CompAddress3'])?>" /></td>
     </tr>
    <tr>
      	<td>Country</td>
      	<td>: <input type="text" name="txtCountry" tabindex="7" value="<?php echo stripslashes($resultCompInfo[0]['CompCountry'])?>" />&nbsp;*</td>
     </tr>
    <tr>
      	<td>Email Address 1</td>
      	<td> : <input type="text" name="txtEmailAddresss1" size="50" tabindex="8" value="<?php echo stripslashes($resultCompInfo[0]['CompEmailAddress1'])?>" />&nbsp;*</td>
     </tr>
    <tr>
      	<td>Email Address 2</td>
      	<td> : <input type="text" name="txtEmailAddress2" size="50" tabindex="9" value="<?php echo stripslashes($resultCompInfo[0]['CompEmailAddress2'])?>" /></td>
     </tr>
    <tr>
      	<td>Phone No 1</td>
      	<td> : (+230)<input type="text" name="txtPhoneNo1" tabindex="10" value="<?php echo stripslashes($resultCompInfo[0]['CompPhone1'])?>" />&nbsp;*</td>
     </tr>
    <tr>
      	<td>Phone No 2</td>
      	<td> : (+230)<input type="text" name="txtPhoneNo2" tabindex="11" value="<?php echo stripslashes($resultCompInfo[0]['CompPhone2'])?>" /></td>
     </tr>
    <tr>
      	<td>Phone No 3</td>
      	<td> : (+230)<input type="text" name="txtPhoneNo3" tabindex="12" value="<?php echo stripslashes($resultCompInfo[0]['CompPhone3'])?>" /></td>
     </tr>
    <tr>
      	<td>Fax No 1</td>
      	<td> : (+230)<input type="text" name="txtFaxNo1" tabindex="13" value="<?php echo stripslashes($resultCompInfo[0]['CompFax1'])?>" />&nbsp;*</td>
     </tr>
    <tr>
      	<td>Fax No 2</td>
      	<td> : (+230)<input type="text" name="txtFaxNo2" tabindex="14" value="<?php echo stripslashes($resultCompInfo[0]['CompFax2'])?>" /></td>
     </tr>
    <tr>
      	<td colspan="2" align="right">&nbsp;* - denotes mandatory field</td>
     </tr>
    <tr>
      	<td>&nbsp;</td>
      	<td><input type="Submit" name="Submit" value="Save" tabindex="15" />&nbsp;&nbsp;<input type="button" name="Cancel" value="Cancel" onclick="toggleMe('headBranch');" tabindex="16" /></td>
     </tr>
</table>
</fieldset>
	</div>
</form>
<!-- End main branch -->

<!-- Other branches -->
<?php
for($branch=0;$branch<count($resultBranches);$branch++)
{
?>
<form method="POST" action="website.php?act=action&mod=savecompanyinfo" name="form<?php echo $branch?>">
	<div align="left" id="Branch<?php echo str_replace(" ", "", $resultBranches[$branch]['BranchName'])?>" style="display:none">
<fieldset><legend>BRANCH - <?php echo strtoupper($resultBranches[$branch]['BranchName'])?></legend>	
<input type="hidden" name="branchID" value="<?php echo $resultBranches[$branch]['ID']?>" />
<table  border="0" cellpadding="0" cellspacing="0" id="tableBranch">
    <tr>
      	<td>Address 1</td>
      	<td> : <input type="text" name="txtAddress1<?php echo $resultBranches[$branch]['ID']?>" size="50" tabindex="1" value="<?php echo stripslashes($resultBranches[$branch]['CompAddress1'])?>" /></td>
     </tr>
    <tr>
      	<td>Address 2</td>
      	<td> : <input type="text" name="txtAddress2<?php echo $resultBranches[$branch]['ID']?>" size="50" tabindex="2" value="<?php echo stripslashes($resultBranches[$branch]['CompAddress2'])?>" /></td>
     </tr>
    <tr>
      	<td>Address 3</td>
      	<td> : <input type="text" name="txtAddress3<?php echo $resultBranches[$branch]['ID']?>" size="50" tabindex="3" value="<?php echo stripslashes($resultBranches[$branch]['CompAddress3'])?>" /></td>
     </tr>
    <tr>
      	<td>Phone No 1</td>
      	<td> : (+230)<input type="text" name="txtPhoneNo1<?php echo $resultBranches[$branch]['ID']?>" tabindex="4" value="<?php echo stripslashes($resultBranches[$branch]['CompPhone1'])?>" /></td>
     </tr>
    <tr>
      	<td>Phone No 2</td>
      	<td> : (+230)<input type="text" name="txtPhoneNo2<?php echo $resultBranches[$branch]['ID']?>" tabindex="5" value="<?php echo stripslashes($resultBranches[$branch]['CompPhone2'])?>" /></td>
     </tr>
    <tr>
      	<td>Phone No 3</td>
      	<td> : (+230)<input type="text" name="txtPhoneNo3<?php echo $resultBranches[$branch]['ID']?>" tabindex="6" value="<?php echo stripslashes($resultBranches[$branch]['CompPhone3'])?>" /></td>
     </tr>
    <tr>
      	<td>Fax No 1</td>
      	<td> : (+230)<input type="text" name="txtFaxNo1<?php echo $resultBranches[$branch]['ID']?>" tabindex="7" value="<?php echo stripslashes($resultBranches[$branch]['CompFax1'])?>" /></td>
     </tr>
    <tr>
      	<td>Fax No 2</td>
      	<td> : (+230)<input type="text" name="txtFaxNo2<?php echo $resultBranches[$branch]['ID']?>" tabindex="8" value="<?php echo stripslashes($resultBranches[$branch]['CompFax2'])?>" /></td>
     </tr>
    <tr>
      	<td>Email Address 1</td>
      	<td> : <input type="text" name="txtEmailAddresss1<?php echo $resultBranches[$branch]['ID']?>" size="50" tabindex="9" value="<?php echo stripslashes($resultBranches[$branch]['CompEmailAddress1'])?>" /></td>
     </tr>
    <tr>
      	<td>Email Address 2</td>
      	<td> : <input type="text" name="txtEmailAddress2<?php echo $resultBranches[$branch]['ID']?>" size="50" tabindex="10" value="<?php echo stripslashes($resultBranches[$branch]['CompEmailAddress2'])?>" /></td>
     </tr>
    <tr>
      	<td>&nbsp;</td>
      	<td>&nbsp;&nbsp;<input type="Submit" name="Submit" value="Save" tabindex="11" />&nbsp;&nbsp;<input type="button" name="Cancel" value="Cancel" onclick="toggleMe('Branch<?php echo str_replace(" ", "", $resultBranches[$branch]['BranchName'])?>');" tabindex="12" /></td>
     </tr>
</table>
</fieldset>
</div>
</form>
<?php }?>
<script type="text/javascript">
 var frmvalidator  = new Validator("form2");
 frmvalidator.addValidation("txtCompanyName","req","Please enter the company name");
 frmvalidator.addValidation("txtVatRegNo","req","Please enter the VAT registration number");
 frmvalidator.addValidation("txtVatRegNo","numeric", "VAT registration number should be numeric");

 frmvalidator.addValidation("txtBRN","req","Please enter the Business registration number");
 frmvalidator.addValidation("txtAddress1","req","Please enter address");
 frmvalidator.addValidation("txtCountry","req","Please enter country");

 frmvalidator.addValidation("txtEmailAddresss1","req","Please enter email address");
 frmvalidator.addValidation("txtEmailAddresss1","email");
 frmvalidator.addValidation("txtEmailAddresss2","email");

 frmvalidator.addValidation("txtPhoneNo1","req","Please enter phone number");
 frmvalidator.addValidation("txtPhoneNo1","numeric", "Phone number should be numeric");
 frmvalidator.addValidation("txtPhoneNo2","numeric", "Phone number should be numeric");
 frmvalidator.addValidation("txtPhoneNo3","numeric", "Phone number should be numeric");

 frmvalidator.addValidation("txtFaxNo1","req","Please enter fax number");
 frmvalidator.addValidation("txtFaxNo1","numeric", "Fax number should be numeric");
 frmvalidator.addValidation("txtFaxNo2","numeric", "Fax number should be numeric");


<?php
for($branch=0;$branch<count($resultBranches);$branch++)
{
?>
 var frmvalidator<?php echo $branch?>  = new Validator("form<?php echo $branch?>");
 frmvalidator<?php echo $branch?>.addValidation("txtPhoneNo1<?php echo $resultBranches[$branch]['ID']?>","numeric", "Phone number should be numeric");
 frmvalidator<?php echo $branch?>.addValidation("txtPhoneNo2<?php echo $resultBranches[$branch]['ID']?>","numeric", "Phone number should be numeric");
 frmvalidator<?php echo $branch?>.addValidation("txtPhoneNo3<?php echo $resultBranches[$branch]['ID']?>","numeric", "Phone number should be numeric");

 frmvalidator<?php echo $branch?>.addValidation("txtFaxNo1<?php echo $resultBranches[$branch]['ID']?>","numeric", "Fax number should be numeric");
 frmvalidator<?php echo $branch?>.addValidation("txtFaxNo2<?php echo $resultBranches[$branch]['ID']?>","numeric", "Fax number should be numeric");

 frmvalidator<?php echo $branch?>.addValidation("txtEmailAddresss1<?php echo $resultBranches[$branch]['ID']?>","email");
 frmvalidator<?php echo $branch?>.addValidation("txtEmailAddresss2<?php echo $resultBranches[$branch]['ID']?>","email");
<?php
}
?>
</script>
