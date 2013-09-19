<?php
$db = new DBQuery();

$updateGallery = "UPDATE gallery SET photo_name ='".trim($_POST['photoname'])."',
				  	photo_desc = '".trim($_POST['description'])."'
				  WHERE gallery_id = '".trim($_POST['galleryID'])."'";

$db->executeNonQuery($updateGallery, $connectionParameters);

header('location:website.php?act=action&mod=browsegallery');
?>