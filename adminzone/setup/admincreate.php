<?php
//#################################### configuration files ###################################
require_once '../configuration/config.php';
require_once '../../includes/class/DBQuery.php';
//##########################################################################################

$db = new DBQuery();
$tablenames = "";

// Create table login and insert default value for admin to login
$mySQL = "CREATE TABLE IF NOT EXISTS `login` (
  `loginid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(40) NOT NULL,
  `displayedname` varchar(50) NOT NULL,
  PRIMARY KEY (`loginid`)
)";

$db->executeNonQuery($mySQL, $connectionParameters);

$mySQL = "INSERT INTO `login` (`loginid`, `username`, `password`, `displayedname`) VALUES
(1, 'stoneproadmin', 'f561aaf6ef0bf14d4208bb46a4ccb3ad', 'Stone Pro Admin')";

$db->executeNonQuery($mySQL, $connectionParameters);
$tablenames .= "login";

// Create table page
$mySQL = "CREATE TABLE `page` (
`pageid` INT NOT NULL AUTO_INCREMENT ,
`type` VARCHAR( 15 ) NOT NULL ,
`title` VARCHAR( 255 ) NOT NULL ,
`pagetitle` VARCHAR( 255 ) NOT NULL ,
`description` TEXT NOT NULL ,
`keyword` TEXT NOT NULL ,
`body` BLOB NOT NULL ,
`status` VARCHAR( 10 ) NOT NULL ,
`version` VARCHAR( 25 ) NOT NULL ,
`date` DATETIME NOT NULL,
PRIMARY KEY ( `pageid` )
)";

$db->executeNonQuery($mySQL, $connectionParameters);
$tablenames .= ", page";

// Create table product
$mySQL = "CREATE TABLE `product` (
`product_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`title` VARCHAR( 255 ) NOT NULL ,
`description` TEXT NOT NULL ,
`format` VARCHAR( 5 ) NOT NULL ,
`add_to_gallery` CHAR( 1 ) NOT NULL COMMENT '0 - dont add to gallery, 1 - add to gallery',
`date` DATETIME NOT NULL
)";

$db->executeNonQuery($mySQL, $connectionParameters);
$tablenames .= ", product";

// Create table gallery
$mySQL = "CREATE TABLE `gallery` (
`gallery_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`photo_name` VARCHAR( 255 ) NOT NULL ,
`photo_desc` TEXT NOT NULL ,
`format` VARCHAR( 5 ) NOT NULL ,
`date` DATETIME NOT NULL
)";

$db->executeNonQuery($mySQL, $connectionParameters);
$tablenames .= ", gallery";

// Create table product_photo
$mySQL - 'CREATE TABLE `product_photo` (
`product_id` INT NOT NULL ,
`product_photo_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`format` VARCHAR( 5 ) NOT NULL ,
`date` DATETIME NOT NULL
)';

$db->executeNonQuery($mySQL, $connectionParameters);
$tablenames .= ", product_photo";
?>



<head>
<meta http-equiv="Content-Language" content="en-us">
</head>


<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center"><font face="Arial">Tables : <b><?php echo $tablenames;?></b> have been created
successfully</font></p>
