<?php
$db = new DBQuery();

$updateSupplier = "UPDATE supplier SET name ='".trim($_POST['name'])."',
				  	emailAddress = '".trim($_POST['emailadd'])."',
                                        address1 = '".trim($_POST['address'])."',
                                        faxNo = '".trim($_POST['fax'])."',
                                        country = '".trim($_POST['country'])."',
                                        supplierTypeId = '".trim($_POST['suppliertype'])."',
                                        phoneNo = '".trim($_POST['phoneno'])."',
                                        DateCreated = '".date("Y-m-d H:i:s")."',
                                        vatNo = '".trim($_POST['VATNo'])."',
                                        mobileNo = '".trim($_POST['mobileno'])."'
				  WHERE supplierId = '".trim($_POST['supplierId'])."'";

$db->executeNonQuery($updateSupplier, $connectionParameters);

header('location:website.php?act=action&mod=listsupplier');

?>
