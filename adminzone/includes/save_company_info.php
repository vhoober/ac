 <?php
$db = new DBQuery();

if($_POST['mainbranch'] == "1")
{
	$updateCompanyInfo = "UPDATE CompanyInfo 
				  SET CompName ='".addslashes(trim($_POST['txtCompanyName']))."',
				CompAddress1 = '".addslashes(trim($_POST['txtAddress1']))."',
				CompAddress2 = '".addslashes(trim($_POST['txtAddress2']))."',
				CompAddress3 = '".addslashes(trim($_POST['txtAddress3']))."',
				CompCountry = '".addslashes(trim($_POST['txtCountry']))."',
				CompPhone1 = '".addslashes(trim($_POST['txtPhoneNo1']))."',
				CompPhone2 = '".addslashes(trim($_POST['txtPhoneNo2']))."',
				CompPhone3 = '".addslashes(trim($_POST['txtPhoneNo3']))."',
				CompFax1 = '".addslashes(trim($_POST['txtFaxNo1']))."',
				CompFax2 = '".addslashes(trim($_POST['txtFaxNo2']))."',
				CompEmailAddress1 = '".addslashes(trim($_POST['txtEmailAddresss1']))."',
				CompEmailAddress2 = '".addslashes(trim($_POST['txtEmailAddresss2']))."',
				CompVATNo = '".addslashes(trim($_POST['txtVatRegNo']))."',
				CompBRN = '".addslashes(trim($_POST['txtBRN']))."'
				  WHERE ID = '1'";

	$db->executeNonQuery($updateCompanyInfo, $connectionParameters);
}
else
{
	$updateBranch = "UPDATE branch
					  SET CompAddress1 = '".addslashes(trim($_POST['txtAddress1'.$_POST['branchID']]))."',
				CompAddress2 = '".addslashes(trim($_POST['txtAddress2'.$_POST['branchID']]))."',
				CompAddress3 = '".addslashes(trim($_POST['txtAddress3'.$_POST['branchID']]))."',
				CompPhone1 = '".addslashes(trim($_POST['txtPhoneNo1'.$_POST['branchID']]))."',
				CompPhone2 = '".addslashes(trim($_POST['txtPhoneNo2'.$_POST['branchID']]))."',
				CompPhone3 = '".addslashes(trim($_POST['txtPhoneNo3'.$_POST['branchID']]))."',
				CompFax1 = '".addslashes(trim($_POST['txtFaxNo1'.$_POST['branchID']]))."',
				CompFax2 = '".addslashes(trim($_POST['txtFaxNo2'.$_POST['branchID']]))."',
				CompEmailAddress1 = '".addslashes(trim($_POST['txtEmailAddresss1'.$_POST['branchID']]))."',
				CompEmailAddress2 = '".addslashes(trim($_POST['txtEmailAddresss2'.$_POST['branchID']]))."',
				DateCreated = now()
				  WHERE ID = '".$_POST['branchID']."'";

	$db->executeNonQuery($updateBranch, $connectionParameters);				  
}

header('location:website.php?act=action&mod=companyinfo&msg=Successfully updated company information');
?>
