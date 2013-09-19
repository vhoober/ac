<?php
//#################################### configuration files ###################################
require_once '../configuration/config.php';
require_once '../../includes/class/DBQuery.php';
//##########################################################################################

$db = new DBQuery();
$tablenames = "";


/** CREATE NEW TABLE AND ADD COLUMNS TO EXISTING ONES **/

// Create table supplier type
$mySQL = "CREATE TABLE IF NOT EXISTS `supplierType` (
  `supplierTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(25) NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`supplierTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3";

$db->executeNonQuery($mySQL, $connectionParameters);

$mySQL = "INSERT INTO `supplierType` (`supplierTypeId`, `type`, `dateCreated`) VALUES
(1, 'Individual', '2013-06-30 17:35:00'),
(2, 'Company', '2013-06-30 17:35:00')";

$db->executeNonQuery($mySQL, $connectionParameters);
$tablenames .= "supplierType";

// Create table supplier
$mySQL = "CREATE TABLE IF NOT EXISTS `supplier` (
  `supplierId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `supplierTypeId` int(11) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `address3` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phoneNo` varchar(25) NOT NULL,
  `mobileNo` varchar(25) NOT NULL,
  `faxNo` varchar(25) NOT NULL,
  `emailAddress` varchar(50) NOT NULL,
  `contactPerson` varchar(50) NOT NULL,
  `vatNo` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`supplierId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1";

$db->executeNonQuery($mySQL, $connectionParameters);
$tablenames .= ", supplier";

//Create table user level
$mySQL = "CREATE TABLE IF NOT EXISTS `userLevel` (
  `userLevelId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`userLevelId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3";

$db->executeNonQuery($mySQL, $connectionParameters);

$mySQL = "INSERT INTO `userLevel` (`userLevelId`, `name`, `dateCreated`) VALUES
(1, 'User', '2013-06-30 18:00:00'),
(2, 'Admin', '2013-06-30 18:00:00')";

$db->executeNonQuery($mySQL, $connectionParameters);
$tablenames .= ", userLevel";
?>

<head>
<meta http-equiv="Content-Language" content="en-us">
</head>


<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center">&nbsp;</p>
<p align="center"><font face="Arial">Tables : <b><?php echo $tablenames;?></b> have been created
successfully</font></p>
