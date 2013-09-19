<?php
$db = new DBQuery();

// Add category
if(isset($_GET['operation']))
{
    if($_GET['operation'] == 0){
    $insertCategory = "INSERT INTO category(name) VALUES('".addslashes($_POST['categoryname'])."')";
    $db->executeNonQuery($insertCategory, $connectionParameters);
    
    $msg = "Category added successfully";
    }
    
    if($_GET['operation'] == 1){
        $updateCategory = "UPDATE category SET name = '".addslashes($_POST['categoryname'])."' WHERE category_id = '".trim($_GET['catid'])."'";
        $db->executeNonQuery($updateCategory, $connectionParameters);
        $msg = "Category updated successfully";
    }
}

// Edit category
if(isset($_GET['id']) && $_GET['id'] > 0)
{
    $msg = "";
    $operation = "1&catid=".$_GET['id']; 
    $queryCategory = "SELECT name FROM category WHERE category_id = '".$_GET['id']."'";
    $result = $db->executeQuery($queryCategory, $connectionParameters);
    $value = "value='".stripslashes($result[0]['name'])."'";
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
<div align="left" id="addcategory">
    <form method="post" name="form2" action="website.php?act=action&mod=category&operation=<?php echo $operation?>">
        <table class="contentText">
            <tr>
                <td>Category Name : <input type="text" onKeyUp="ValidateAlphabets('categoryname');" id="categoryname" name="categoryname" <?php echo $value?> /></td>
                <td><input type="submit" name="submit" value="<?php echo $mode?>" /></td>
            </tr>
        </table>
    </form>
</div>
<hr>
<?php
$queryCategory = "SELECT * FROM category ORDER BY name ASC";
$resultCategory = $db->executeQuery($queryCategory, $connectionParameters);
?>
<label class="contentHeader"><font color="brown"><?php echo count($resultCategory)?></font> Categories Available</label><br>
<table id="tableList" border="0" cellpadding="5" cellspacing="0">
    <tr align="left">
        <th>Category Name</th>
        <th>Action</th>
    </tr>
    <?php
        for($i=0;$i<count($resultCategory);$i++)
        {
            if(($i%2)==0)
            {?>
                <tr bgcolor="#f0f0f0" valign="top">
            <?php }
            else
            {?>            
                <tr valign="top">
            <?php }?> 
            
                    <td><?php echo strtoupper(stripslashes($resultCategory[$i]['name']));?></td>
                    <td><a href="website.php?act=action&mod=category&id=<?php echo $resultCategory[$i]['category_id']?>" title="Edit category">Edit</a> </td>
                </tr>
        <?php }
    ?>
</table>
<script type="text/javascript">
 var frmvalidator  = new Validator("form2");
 frmvalidator.addValidation("categoryname","req","Please enter category name");
 </script>
