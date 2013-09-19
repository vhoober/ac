<?php
error_reporting(0);
ob_start();  // open output buffer to counter header error
session_start();

if (!isset($_SESSION['currentuserinfo']) || ($_SESSION['currentuserinfo'][2] != 2)) {header("location:index.php");exit;}

require_once 'configuration/config.php';
require_once '../includes/class/DBQuery.php';

$db = new DBQuery();

if($_POST['submit'] == "1")
{
	$update = "UPDATE page 
		SET title='".addslashes(trim($_POST['title']))."',
		pagetitle='".addslashes(trim($_POST['pagetitle']))."',
		description='".addslashes(trim($_POST['description']))."',
		keyword='".addslashes(trim($_POST['keyword']))."',
		body='".addslashes(trim($_POST['editor1']))."'
		WHERE pageid='1'";
$db->executeNonQuery($update, $connectionParameters);		
}

$mySQL			= "SELECT * FROM page WHERE pageid = '1'";
$resultPage = $db->executeQuery($mySQL, $connectionParameters);

$title			= stripslashes($resultPage[0]['title']);
$pagetitle		= stripslashes($resultPage[0]['pagetitle']);
$description	= stripslashes($resultPage[0]['description']);
$keyword		= stripslashes($resultPage[0]['keyword']);
$body			= stripslashes($resultPage[0]['body']);
?>
<html>
  <head>
    <title>Atchia Ceramica - Online Editor</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../js/form_validator.js"></script>
  </head>
  <body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0" bgcolor="#E6E6E6">
  <?php if($_POST['submit'] == "1"){?>
<div style="color:green"><h2>Homepage update successfully</h2></div>
<?php }?>
      <form action="homepage.php" method="post" name="frmeditor" id="frmeditor">
	  <input type="hidden" name="submit" value="1" />
<table border="0" id="table1" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td width="80%" style="border-right: medium none #000000" valign="top">
			<textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="50">
<?php echo $body?></textarea>
</td>
		<td bgcolor="#E6E6E6" style="border-left-style: none; border-left-width: medium" valign="top">
		<table border="0" width="100%" id="table2" cellspacing="0" cellpadding="0">
			<tr>
				<td>
				<p style="margin-left: 20px">&nbsp;</td>
			</tr>
			<tr>
				<td>
				<p style="margin-left: 20px; margin-right: 10px">
				<font face="Arial" size="4">Welcome to your online page editor</font></td>
			</tr>
			<tr>
				<td>
				<p style="margin-left: 20px; margin-right: 10px">
				<font face="Arial" size="1">This editor will allow you to put 
				almost any type of content online. Moreover it is wise to point 
				out that some of the function might differ on how to perform 
				certain task.</font></td>
			</tr>
			<tr>
				<td><span style="font-size: 8pt">&nbsp;</span></td>
			</tr>
			<tr>
				<td>
				<p style="margin-left: 20px; margin-right: 10px">
				<span style="text-transform: uppercase">
				<font face="Arial" style="font-size: 8pt; font-weight: 700">Page 
				title</font></span></td>
			</tr>
			<tr>
				<td>
				<p style="margin-left: 20px"><font size="1" face="Arial">
<span style="font-size: 9pt">
<input type="text" name="pagetitle" size="112" style="font-family: Arial; font-size: 8pt; width:173; height:19; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px; background-color:#FFFFFF" value="<?php echo $pagetitle ?>"></span></font></td>
			</tr>
			<tr>
				<td><span style="font-size: 8pt">&nbsp;</span></td>
			</tr>
			<tr>
				<td>
				<p style="margin-left: 20px; margin-right: 10px"><b>
				<font face="Arial">What are meta tags?</font></b></td>
			</tr>
			<tr>
				<td>
				<p style="margin-left: 20px; margin-right: 10px">
				<font face="Arial" size="1">Basically having your meta tags up 
				to date will help your rank in search result on search engine</font></td>
			</tr>
			<tr>
				<td><font size="1">&nbsp;</font></td>
			</tr>
			<tr>
				<td>
				<p style="margin-left: 20px; margin-right: 10px">
				<span style="text-transform: uppercase">
				<font face="Arial" size="1">Title </font><b>
				<font face="Verdana" style="font-size: 7pt">&nbsp;(meta tag)</font></b></span>
				</td>
			</tr>
			<tr>
				<td>
				<p style="margin-left: 20px; margin-right: 10px"><font size="1" face="Arial">
<span style="font-size: 9pt">
<input type="text" name="title" size="112" style="font-family: Arial; font-size: 8pt; width:173; height:19; padding-left:4px; padding-right:4px; padding-top:1px; padding-bottom:1px; background-color:#FFFFFF" value="<?php echo $title ?>">
</span></font></td>
			</tr>
			<tr>
				<td>
				<p style="margin-left: 20px; margin-right: 10px">
				<span style="text-transform: uppercase">
				<font face="Arial" size="1">Description </font><b>
				<font face="Verdana" style="font-size: 7pt">&nbsp;(meta tag)</font></b></span></td>
			</tr>
			<tr>
				<td>
				<p style="margin-left: 20px; margin-right: 10px"><font size="1" face="Arial">
<span style="font-size: 9pt">
<textarea rows="2" name="description" cols="20" style="font-family: Arial; font-size: 8pt; width:175; height:74; background-color:#FFFFFF"><?php echo $description ?></textarea></span></font></td>
			</tr>
			<tr>
				<td>
				<p style="margin-left: 20px; margin-right: 10px">
				<span style="text-transform: uppercase">
				<font face="Arial" size="1">Keyword </font><b>
				<font face="Verdana" style="font-size: 7pt">&nbsp;(meta tag)</font></b></span></td>
			</tr>
			<tr>
				<td>
				<p style="margin-left: 20px; margin-right: 10px"><font size="1" face="Arial">
<span style="font-size: 9pt">
<textarea rows="2" name="keyword" cols="20" style="font-family: Arial; font-size: 8pt; width:175; height:73; background-color:#FFFFFF"><?php echo $keyword ?></textarea></span></font></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>
				<p style="margin-left: 20px">
				<input type="image" border="0" src="ckeditor/images/Image24.gif" width="71" height="19">&nbsp;&nbsp;<input type="image" border="0" src="ckeditor/images/Image11.gif" onclick="javascript:window.close();">
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>
    </form>
<script type="text/javascript">
 var frmvalidator  = new Validator("frmeditor");
 frmvalidator.addValidation("pagetitle","req","Please enter the Page Title");
 frmvalidator.addValidation("title","req","Please enter the Title");
</script>
  </body>
</html>
<?php
ob_end_flush();  // turn off output buffer
?>