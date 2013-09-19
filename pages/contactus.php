<?php
require_once 'adminzone/configuration/config.php';
require_once 'includes/class/DBQuery.php';

$queryCompanyInfo = "SELECT * FROM company_info";
$resultCompanyInfo = $db->executeQuery($queryCompanyInfo, $connectionParameters);

$queryBranch = "SELECT * FROM branch";
$resultBranch = $db->executeQuery($queryBranch, $connectionParameters);
?>
<div style="background-image: url(images/branches.png);background-repeat:no-repeat;background-position:99% 7%;">
<?php for($i=0; $i<count($resultBranch); $i++){?>
    <table border="0" width="<?php if($i==(count($resultBranch) -1)){?>100<?php }else{?>55<?php }?>%" cellpadding="5" cellspacing="0">
<tr>
	<td><fieldset><legend><?php if($i==0){?>Head Office<?php }else{?>Branch<?php }?> : <?php echo $resultBranch[$i]['BranchName']?></legend>
		<?php if($i==0){?>
			<?php if($resultCompanyInfo[$i]['CompName'] != ""){echo $resultCompanyInfo[$i]['CompName'];}?>
			<?php if($resultCompanyInfo[$i]['CompAddress1'] != ""){echo "<br>Address : ".$resultCompanyInfo[$i]['CompAddress1'];}?>
			<?php if($resultCompanyInfo[$i]['CompAddress2'] != ""){echo "<br>".$resultCompanyInfo[$i]['CompAddress2'];}?>			
			<?php if($resultCompanyInfo[$i]['CompAddress3'] != ""){echo "<br>".$resultCompanyInfo[$i]['CompAddress3'];}?>			
			<?php if($resultCompanyInfo[$i]['CompCountry'] != ""){echo "<br>Country : ".$resultCompanyInfo[$i]['CompCountry'];}?>			
			<?php if($resultCompanyInfo[$i]['CompPhone1'] != 0){echo "<br>Telephone : (+230)".$resultCompanyInfo[$i]['CompPhone1'];}?>			
			<?php if($resultCompanyInfo[$i]['CompPhone2'] != 0){echo " / (+230)".$resultCompanyInfo[$i]['CompPhone2'];}?>			
			<?php if($resultCompanyInfo[$i]['CompPhone3'] != 0){echo " / (+230)".$resultCompanyInfo[$i]['CompPhone3'];}?>			
			<?php if($resultCompanyInfo[$i]['CompFax1'] != 0){echo "<br>Fax : (+230)".$resultCompanyInfo[$i]['CompFax1'];}?>			
			<?php if($resultCompanyInfo[$i]['CompFax2'] != 0){echo " / (+230)".$resultCompanyInfo[$i]['CompFax2'];}?>			
			<?php if($resultCompanyInfo[$i]['CompEmailAddress1'] != ""){echo "<br>Email : <a href=\"mailto:".$resultCompanyInfo[$i]['CompEmailAddress1']."\">".$resultCompanyInfo[$i]['CompEmailAddress1']."</a>";}?>
			<?php if($resultCompanyInfo[$i]['CompEmailAddress2'] != ""){echo "<br>Email : <a href=\"mailto:".$resultCompanyInfo[$i]['CompEmailAddress2']."\">".$resultCompanyInfo[$i]['CompEmailAddress2']."</a>";}?>
		<?php }else{?>
			<?php if($resultBranch[$i]['CompAddress1'] != ""){echo "Address : ".$resultBranch[$i]['CompAddress1'];}?>
			<?php if($resultBranch[$i]['CompAddress2'] != ""){echo "<br>".$resultBranch[$i]['CompAddress2'];}?>			
			<?php if($resultBranch[$i]['CompAddress3'] != ""){echo "<br>".$resultBranch[$i]['CompAddress3'];}?>					
			<?php if($resultBranch[$i]['CompPhone1'] != 0){echo "<br>Telephone : (+230)".$resultBranch[$i]['CompPhone1'];}?>			
			<?php if($resultBranch[$i]['CompPhone2'] != 0){echo " / (+230)".$resultBranch[$i]['CompPhone2'];}?>			
			<?php if($resultBranch[$i]['CompPhone3'] != 0){echo " / (+230)".$resultBranch[$i]['CompPhone3'];}?>			
			<?php if($resultBranch[$i]['CompFax1'] != 0){echo "<br>Fax : (+230)".$resultBranch[$i]['CompFax1'];}?>			
			<?php if($resultBranch[$i]['CompFax2'] != 0){echo " / (+230)".$resultBranch[$i]['CompFax2'];}?>			
			<?php if($resultBranch[$i]['CompEmailAddress1'] != ""){echo "<br>Email : <a href=\"mailto:".$resultBranch[$i]['CompEmailAddress1']."\">".$resultBranch[$i]['CompEmailAddress1']."</a>";}?>
			<?php if($resultBranch[$i]['CompEmailAddress2'] != ""){echo "<br>Email : <a href=\"mailto:".$resultBranch[$i]['CompEmailAddress2']."\">".$resultBranch[$i]['CompEmailAddress2']."</a>";}?>		
		<?php }?>
	</fieldset></td>
</tr>
<?php if($i==(count($resultBranch) -1)){?>
<tr>
	<td height="5">&nbsp;</td>
</tr>
<?php } ?>
</table>
<?php
}?>

</div>


