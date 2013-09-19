-- Modification table Users
UPDATE  `atchia_ceramica`.`Users` SET  `UserLevel` =  '' WHERE `Users`.`ID` =1;

UPDATE  `atchia_ceramica`.`Users` SET  `UserLevel` =  '' WHERE `Users`.`ID` =4;

UPDATE  `atchia_ceramica`.`Users` SET  `UserLevel` =  '' WHERE `Users`.`ID` =5;

UPDATE  `atchia_ceramica`.`Users` SET  `UserLevel` =  '' WHERE `Users`.`ID` =6;

ALTER TABLE  `Users` CHANGE  `UserLevel`  `UserLevel` INT NULL DEFAULT NULL ;

-- Modification on table CompanyInfo
ALTER TABLE  `CompanyInfo` ADD  `CompAddress3` VARCHAR( 50 ) NULL AFTER  `CompAddress2`

ALTER TABLE  `CompanyInfo` ADD  `CompPhone3` INT NULL AFTER  `CompPhone2`

ALTER TABLE  `CompanyInfo` ADD  `CompBRN` VARCHAR( 50 ) NOT NULL AFTER  `CompVATNo`

UPDATE  `atchia_ceramica`.`CompanyInfo` SET  `CompAddress2` =  '',
`CompPhone1` =  '2401882',
`CompPhone2` =  '2404106',
`CompPhone3` =  '',
`CompFax1` =  '2401471',
`CompFax2` =  '',
`CompBRN` =  'P-l Brn C08063203'
`CompEmailAddress2` =  '' WHERE  `CompanyInfo`.`ID` =1;


ALTER TABLE  `CompanyInfo` CHANGE  `CompPhone1`  `CompPhone1` INT NOT NULL ,
CHANGE  `CompPhone2`  `CompPhone2` INT NULL DEFAULT NULL ,
CHANGE  `CompFax1`  `CompFax1` INT NOT NULL ,
CHANGE  `CompFax2`  `CompFax2` INT( 50 ) NULL DEFAULT NULL

ALTER TABLE  `CompanyInfo` CHANGE  `CompName`  `CompName` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
CHANGE  `CompAddress1`  `CompAddress1` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
CHANGE  `CompCountry`  `CompCountry` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
CHANGE  `CompEmailAddress1`  `CompEmailAddress1` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
CHANGE  `CompVATNo`  `CompVATNo` VARCHAR( 50 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
CHANGE  `CreatedBy`  `CreatedBy` INT NOT NULL

UPDATE  `atchia_ceramica`.`CompanyInfo` SET  `CreatedBy` =  '5' WHERE  `CompanyInfo`.`ID` =1;
