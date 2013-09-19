<?php
$db = new DBQuery();

// Add Region
if(isset($_GET['operation']))
{
    if($_GET['operation'] == 0){
    $insertRegion = "INSERT INTO transport(region, fees) VALUES('".addslashes(trim($_POST['region_name']))."', '".trim($_POST['fees'])."')";
    $db->executeNonQuery($insertRegion, $connectionParameters);
    
    $msg = "Region added successfully";
    }
    
    if($_GET['operation'] == 1){
        $updateRegion = "UPDATE transport SET region = '".addslashes(trim($_POST['region_name']))."', fees = '".$_POST['fees']."' WHERE region_id = '".trim($_GET['regionid'])."'";
        $db->executeNonQuery($updateRegion, $connectionParameters);
        $msg = "Region updated successfully";
    }
}

// Edit Region
if(isset($_GET['id']) && $_GET['id'] > 0)
{
    $msg = "";
    $operation = "1&regionid=".$_GET['id']; 
    $queryRegion = "SELECT region, fees FROM transport WHERE region_id = '".$_GET['id']."'";
    $result = $db->executeQuery($queryRegion, $connectionParameters);
    $region_value = "value='".stripslashes($result[0]['region'])."'";
    $fees_value = "value='".$result[0]['fees']."'";
    $mode="Update";
}
 else {
$operation = "0";   
$value = "";
$mode="Create";
}

if(isset($msg) && trim($msg) != "")
{
	echo "<div class='contentHeader' style='color:green'>".$msg."</div>";
}
?>
<div align="left" id="addregion">
    <form method="post" name="form7" action="website.php?act=action&mod=transport&operation=<?php echo $operation?>">
        <table class="contentText" cellspacing="5" cellpadding="5">
            <tr>
                <td>Region Name : <input type="text" onKeyUp="ValidateAlphabets('region_name');" id="region_name" name="region_name" <?php echo $region_value?> /></td>
		<td>Fees : <input type="text" onKeyUp="ValidateNumeric('fees');" id="fees" name="fees" <?php echo $fees_value?> /></td>
                <td><input type="submit" name="submit" value="<?php echo $mode?>" /></td>
            </tr>
        </table>
    </form>
</div>
<hr>
<?php
//$queryRegion = "SELECT * FROM transport ORDER BY region ASC";
//$resultRegion = $db->executeQuery($queryRegion, $connectionParameters);

//Connect to mysql db
$conn = mysql_connect($connectionParameters['host'],$connectionParameters['username'],$connectionParameters['password']);
if(!$conn) die("Failed to connect to database!");
$status = mysql_select_db($connectionParameters['database'], $conn);
if(!$status) die("Failed to select database!");
$sqlRegion = 'SELECT * FROM transport ORDER BY region ASC';
$count = mysql_num_rows(mysql_db_query($connectionParameters['database'], $sqlRegion));
?>
<label class="contentHeader"><font color="brown"><?php echo $count?></font> Transport Region(s) Recorded</label><br>
<table id="tableList" border="0" cellpadding="5" cellspacing="0">
    <tr align="left">
        <th>Region Name</th>
	<th>Fees (Rs)</th>
        <th>Action</th>
    </tr>
    <?php
	if($count > 0)
	{

	$pager = new PS_Pagination($conn, $sqlRegion, $rowPerPage, 5, "act=action&mod=transport");

	/*
	 * The paginate() function returns a mysql result set
	 * or false if no rows are returned by the query
	*/
	$rs = $pager->paginate();
	if(!$rs) die(mysql_error());    

		while($row = mysql_fetch_assoc($rs)) {

                $index++;

                if(($index%2)==0)        
            {?>
                <tr bgcolor="#f0f0f0" valign="top">
            <?php }
            else
            {?>            
                <tr valign="top">
            <?php }?> 
            
                    <td><?php echo strtoupper(stripslashes($row['region']));?></td>
		    <td><?php echo $row['fees'];?></td>
                    <td><a href="website.php?act=action&mod=transport&id=<?php echo $row['region_id']?>" title="Edit region">Edit</a> </td>
                </tr>
        <?php }}
    ?>
                <tr><td colspan="3"><center style="font-family: Arial; font-size: 9pt"><?php echo $pager->renderFullNav();?></center></td></tr>
</table>
<script type="text/javascript">
 var frmvalidator  = new Validator("form7");
 frmvalidator.addValidation("region_name","req","Please enter region name");
 frmvalidator.addValidation("fees","req","Please enter fees amount");s
 </script>
