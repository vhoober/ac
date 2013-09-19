<?php
if($_POST['Save'] == "Save") {

$username	= trim($_POST['username']);
$password	= trim($_POST['password']);   
$name	= trim($_POST['name']);
$address	= trim($_POST['address']);
$title	= trim($_POST['title']);
$phoneno	= trim($_POST['phoneno']);
$mobileno	= trim($_POST['mobileno']);
$userlevel	= trim($_POST['userlevel']);
$displayname = trim($_POST['displayname']);
  
	
	$db = new DBQuery();

	$insertUserSQL = "INSERT INTO users (Username, Password, Name, Address, Title, PhoneNo, MobileNo, DateCreated, CreatedBy, UserLevel, displayedname) VALUES ('$username', '".md5($password)."', '$name', '$address', '$title', '$phoneno', '$mobileno', '".date("Y-m-d H:i:s")."','".$_SESSION['currentuserinfo'][0]."', '$userlevel', '$displayname')";
	$ID = $db->executeNonQuery($insertUserSQL, $connectionParameters);
	$_SESSION['ID']	= $ID;
	
header('location:website.php?act=action&mod=listuser&msg=Successfully added user');	
}
?>
