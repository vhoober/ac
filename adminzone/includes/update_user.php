<?php
$db = new DBQuery();

$updateUser = "UPDATE users SET Username ='".trim($_POST['username'])."',
				  	Name = '".trim($_POST['name'])."',
                                        Address = '".trim($_POST['address'])."',
                                        Title = '".trim($_POST['title'])."',
                                        PhoneNo = '".trim($_POST['phoneno'])."',
                                        MobileNo = '".trim($_POST['mobileno'])."',
                                        DateCreated = '".date("Y-m-d H:i:s")."',
                                        CreatedBy = '".$_SESSION['currentuserinfo'][0]."',
                                        UserLevel = '".trim($_POST['userlevel'])."',
                                        displayedname = '".trim($_POST['displayedname'])."'
				  WHERE ID = '".trim($_POST['ID'])."'";

$db->executeNonQuery($updateUser, $connectionParameters);

header('location:website.php?act=action&mod=listuser');
?>
