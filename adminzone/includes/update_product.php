<?php
$db = new DBQuery();

$add_to_gallery = (isset($_POST['addtogallery']) ? $_POST['addtogallery'] : 0);
$best_seller = (isset($_POST['bestseller']) ? $_POST['bestseller'] : 0);
$updateProduct = "UPDATE Products SET ProductName ='".trim($_POST['productname'])."',
				  	Description = '".trim($_POST['description'])."',
                                        Supplier = '".trim($_POST['supplier'])."',
                                        ProductCode = '".trim($_POST['productcode'])."',
                                        ProductSize = '".trim($_POST['productsize'])."',
                                        UnitCostPrice = '".trim($_POST['unitcostprice'])."',
                                        UnitSellingPrice = '".trim($_POST['unitsellingprice'])."',
                                        UnitWholesalePrice = '".trim($_POST['unitwholesaleprice'])."',
                                        Quantity = '".trim($_POST['quantity'])."',
                                        ReorderLevel = '".trim($_POST['reorderlevel'])."',
                                        BestSeller = '".$best_seller."',
                                        add_to_gallery = '".$add_to_gallery."'
				  WHERE ID = '".trim($_POST['productID'])."'";

$db->executeNonQuery($updateProduct, $connectionParameters);

header('location:website.php?act=action&mod=listproduct');
?>
