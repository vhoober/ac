<?php
require_once '../configuration/config.php';
require_once '../../includes/class/DBQuery.php';

$db = new DBQuery();

if(isset($_GET['prodID']) && trim($_GET['prodID']) > 0)
{
    
    $query = "SELECT ProductCode, ProductName, Quantity, UnitSellingPrice FROM products WHERE ID = '".$_GET['prodID']."'";	
    $result = $db->executeQuery($query, $connectionParameters);

    if($_GET['prodQty'] > $result[0]['Quantity'])
    {
        echo "<script>alert('Inserted product quantity cannot be greater than stock level');</script>";        // Clear quantity
        echo "<script>$('#product_qty').val('');$('#product_qty').focus();</script>";
    }
    else    
    {
        // Insert product in temp table
        $sub_total = $_GET['prodQty'] * $result[0]['UnitSellingPrice'];
        $insert = "INSERT INTO tmp_basket(productID, product_code, product_name, quantity, unit_selling_price, sub_total)
                   VALUES('".trim($_GET['prodID'])."', '".$result[0]['ProductCode']."', '".$result[0]['ProductName']."', '".$_GET['prodQty']."', '".$result[0]['UnitSellingPrice']."', '".$sub_total."')";
        $db->executeNonQuery($insert, $connectionParameters);
        
        // Clear quantity
        echo "<script>$('#product_qty').val('');</script>";
    }   
}
    // Display values in temp table
    $query_basket = "SELECT * FROM tmp_basket";
    $result_basket = $db->executeQuery($query_basket, $connectionParameters);
    
    if(count($result_basket) > 0)
    {?>
        <table border="1" width="100%" id="tableList">
            <tr bgcolor="#ffffff">
                <td><b>PRODUCT CODE</b></td>
                <td><b>PRODUCT NAME</b></td>
                <td><b>QUANTITY</b></td>
                <td><b>UNIT PRICE</b></td>
                <td><b>SUB TOTAL</b></td>
				<td><b>ACTION</b></td>
            </tr>
        <?php
        for($i=0; $i<count($result_basket); $i++)
        {       if(($i%2)==0)
                {?>
                <tr bgcolor="#bbeeff" valign="top">
                <?php }
                else
                {?>
                <tr bgcolor="#ffffff" valign="top"><?php                
                }?>
                    <td><?php echo $result_basket[$i]['product_code']?></td>
                    <td><?php echo strtoupper($result_basket[$i]['product_name'])?></td>
                    <td><?php echo $result_basket[$i]['quantity']?></td>
                    <td><?php echo number_format($result_basket[$i]['unit_selling_price'], 2, '.', '')?></td>
                    <td><?php echo number_format($result_basket[$i]['sub_total'], 2, '.', '')?></td>
		    <td width="1%"><input title="Delete product from basket" type="image" src="images/delete.png" id="deleteBasketProduct" onClick="DeleteProductInBasket('added_product', <?php echo $result_basket[$i]['basketID']?>);" /></td>
                </tr>
        <?php }
        ?>
        </table>
<?php
    }
    else    
    {
        echo "No product in basket";
    }
?>
