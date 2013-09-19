<?php
if(trim($_SERVER['SERVER_NAME']) == "localhost")
{
	$connectionParameters['host'] = "localhost";
	$connectionParameters['username'] = "root";
	$connectionParameters['password'] = "";
	$connectionParameters['database'] = "atchia_ceramica";
}
else
{
	$connectionParameters['host'] = "localhost";
	$connectionParameters['username'] = "yaseen";
	$connectionParameters['password'] = "qd4hwai2zqgM";
	$connectionParameters['database'] = "yaseen_atchiaceramica";
	$adminEmail = "viraj@virajtech.com";
}

// admin email address - to inform admin when stock level is low
$adminEmail = "viraj@virajtech.com";

// Percentage vat - for the time being its 15% (15/100)
$VAT = 0.15; 

// number of records to display in listing
$rowPerPage=20;
?>
